<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Booking;

class BookingController extends Controller {
    public function bookSession($sessionId) {
        $session = Classes::findOrFail($sessionId);

        // Check if session is full
        $currentBookings = $session->bookings()->count();
        if ($currentBookings >= $session->max_participants) {
            return back()->with('error', 'Session is fully booked!');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'classes_id' => $sessionId,
        ]);

        return back()->with('success', 'Successfully booked the session!');
    }
    public function showClass($id) {
        // Fetch the class by ID
        $class = Classes::findOrFail($id);

        // Return the view with the class data
        return view('bookingcheckout', compact('class'));
    }


    public function myBookings()
    {
           // Fetch all bookings for the authenticated user
            $bookings = Booking::with('class')->where('user_id', auth()->id())->get();
            // Return the view with the bookings data
            return view('book.dashboard', compact('bookings'));
    }
}
