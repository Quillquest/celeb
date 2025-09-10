<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $priorityColors = [
            'low' => '#10B981',     // Green
            'normal' => '#F59E0B',  // Yellow
            'high' => '#EF4444'     // Red
        ];

        $priorityLabels = [
            'low' => 'Low Priority',
            'normal' => 'Normal Priority',
            'high' => 'Urgent Priority'
        ];

        return $this->subject('New Contact Message: ' . $this->contactData['subject'])
                    ->view('emails.contact-message')
                    ->with([
                        'contactData' => $this->contactData,
                        'priorityColor' => $priorityColors[$this->contactData['priority']] ?? $priorityColors['normal'],
                        'priorityLabel' => $priorityLabels[$this->contactData['priority']] ?? $priorityLabels['normal']
                    ]);
    }
}
