<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CelebrityBooking;
use App\Models\Celebrity;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get user's bookings
        $user = Auth::user();
        $bookings = CelebrityBooking::where('user_id', $user->id)
                                    ->with('celebrity')
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        // Get booking statistics
        $upcomingBookings = $bookings->where('event_date', '>=', Carbon::today())
                                     ->where('booking_status', 'approved')
                                     ->count();
        
        $pendingBookings = $bookings->where('booking_status', 'pending')->count();
        $completedBookings = $bookings->where('booking_status', 'completed')->count();

        // Get featured celebrities using the scope
        $featuredCelebrities = Celebrity::featured()
                                    ->take(3)
                                    ->get();

        return view('user.dashboard', [
            'title' => 'User Dashboard',
            'bookings' => $bookings,
            'upcomingBookings' => $upcomingBookings,
            'pendingBookings' => $pendingBookings,
            'completedBookings' => $completedBookings,
            'featuredCelebrities' => $featuredCelebrities,
        ]);
    }
}