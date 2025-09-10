<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use App\Models\Settings;
use App\Models\User;
use App\Mail\ContactReply;

class ContactMessagesController extends Controller
{
    /**
     * Display all contact messages
     */
    public function index(Request $request)
    {
        $query = Notification::query()
            ->where('title', 'LIKE', 'Contact Message:%')
            ->with('user')
            ->orderBy('created_at', 'desc');

        // Filter by status (read/unread)
        if ($request->has('status') && $request->status !== '') {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Filter by user type (guest/registered)
        if ($request->has('user_type') && $request->user_type !== '') {
            if ($request->user_type === 'guest') {
                $query->whereNull('user_id');
            } elseif ($request->user_type === 'registered') {
                $query->whereNotNull('user_id');
            }
        }

        // Filter by priority (extract from message content)
        if ($request->has('priority') && $request->priority !== '') {
            $query->where('message', 'LIKE', '%Priority: ' . ucfirst($request->priority) . '%');
        }

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('message', 'LIKE', "%{$search}%");
            });
        }

        $messages = $query->paginate(15)->appends($request->query());

        $title = 'Contact Messages - Admin Panel';

        return view('admin.contact-messages.index', compact('messages', 'title'));
    }

    /**
     * Show a specific contact message
     */
    public function show($id)
    {
        $message = Notification::where('title', 'LIKE', 'Contact Message:%')
            ->with('user')
            ->findOrFail($id);

        // Mark as read when viewed
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        // Parse the message content to extract details
        $messageData = $this->parseMessageContent($message->message);

        $title = 'Contact Message Details - Admin Panel';

        return view('admin.contact-messages.show', compact('message', 'messageData', 'title'));
    }

    /**
     * Show reply form for a contact message
     */
    public function reply($id)
    {
        $message = Notification::where('title', 'LIKE', 'Contact Message:%')
            ->with('user')
            ->findOrFail($id);

        $messageData = $this->parseMessageContent($message->message);
        
        $title = 'Reply to Contact Message - Admin Panel';

        return view('admin.contact-messages.reply', compact('message', 'messageData', 'title'));
    }

    /**
     * Send reply to a contact message
     */
    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'reply_subject' => 'required|string|max:255',
            'reply_message' => 'required|string|max:5000',
        ]);

        $message = Notification::where('title', 'LIKE', 'Contact Message:%')
            ->findOrFail($id);

        $messageData = $this->parseMessageContent($message->message);

        try {
            $settings = Settings::where('id', '=', '1')->first();

            // Prepare reply email data
            $replyData = [
                'customer_name' => $messageData['name'],
                'customer_email' => $messageData['email'],
                'original_subject' => str_replace('Contact Message: ', '', $message->title),
                'original_message' => $messageData['message'],
                'reply_subject' => $request->reply_subject,
                'reply_message' => $request->reply_message,
                'admin_name' => auth()->user()->name ?? 'Customer Support',
                'site_name' => $settings->site_title ?? 'Celebrity Booking',
                'sent_at' => now()->format('M j, Y \a\t g:i A')
            ];

            // Send reply email
            Mail::to($messageData['email'])->send(new ContactReply($replyData));

            // Mark original message as read
            $message->update(['is_read' => true]);

            // Log the reply
            Log::info('Contact message reply sent', [
                'message_id' => $id,
                'customer_email' => $messageData['email'],
                'reply_subject' => $request->reply_subject,
                'admin_user' => auth()->user()->email ?? 'unknown'
            ]);

            return redirect()->route('admin.contact-messages.show', $id)
                ->with('success', 'Reply sent successfully to ' . $messageData['email']);

        } catch (\Exception $e) {
            Log::error('Failed to send contact reply', [
                'message_id' => $id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to send reply: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Delete a contact message
     */
    public function destroy($id)
    {
        $message = Notification::where('title', 'LIKE', 'Contact Message:%')
            ->findOrFail($id);

        $messageData = $this->parseMessageContent($message->message);

        $message->delete();

        Log::info('Contact message deleted', [
            'message_id' => $id,
            'customer_email' => $messageData['email'] ?? 'unknown',
            'deleted_by' => auth()->user()->email ?? 'unknown'
        ]);

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Mark message as read/unread
     */
    public function toggleRead($id)
    {
        $message = Notification::where('title', 'LIKE', 'Contact Message:%')
            ->findOrFail($id);

        $message->update(['is_read' => !$message->is_read]);

        $status = $message->is_read ? 'read' : 'unread';

        return redirect()->back()
            ->with('success', "Message marked as {$status}.");
    }

    /**
     * Bulk actions (mark as read, delete)
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:mark_read,mark_unread,delete',
            'message_ids' => 'required|array|min:1',
            'message_ids.*' => 'exists:notifications,id'
        ]);

        $messages = Notification::where('title', 'LIKE', 'Contact Message:%')
            ->whereIn('id', $request->message_ids);

        switch ($request->action) {
            case 'mark_read':
                $messages->update(['is_read' => true]);
                $successMessage = 'Selected messages marked as read.';
                break;

            case 'mark_unread':
                $messages->update(['is_read' => false]);
                $successMessage = 'Selected messages marked as unread.';
                break;

            case 'delete':
                $count = $messages->count();
                $messages->delete();
                $successMessage = "{$count} messages deleted successfully.";
                break;
        }

        return redirect()->back()->with('success', $successMessage);
    }

    /**
     * Parse message content to extract structured data
     */
    private function parseMessageContent($messageContent)
    {
        $lines = explode("\n", $messageContent);
        $data = [];

        foreach ($lines as $line) {
            if (strpos($line, 'From: ') === 0) {
                // Extract name and email from "From: Name (email)"
                preg_match('/From: (.+) \((.+)\)/', $line, $matches);
                $data['name'] = $matches[1] ?? '';
                $data['email'] = $matches[2] ?? '';
            } elseif (strpos($line, 'Phone: ') === 0) {
                $data['phone'] = trim(str_replace('Phone: ', '', $line));
            } elseif (strpos($line, 'Priority: ') === 0) {
                $data['priority'] = trim(str_replace('Priority: ', '', $line));
            } elseif (strpos($line, 'Message:') === 0) {
                // Get everything after "Message:"
                $messageStart = strpos($messageContent, 'Message:') + 8;
                $data['message'] = trim(substr($messageContent, $messageStart));
                break;
            }
        }

        return $data;
    }
}
