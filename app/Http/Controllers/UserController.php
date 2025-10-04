<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show user dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $userEvents = $user->events()->latest()->take(5)->get();
        
        // Total Events: All events created by the user
        $totalEvents = $user->events()->count();
        
        // Upcoming Events: All active events (not cancelled or completed)
        $upcomingEvents = $user->events()->where('status', 'active')->count();
        
        // This Month: Events happening this month (based on event_date, not created_at)
        $thisMonthEvents = $user->events()
            ->whereMonth('event_date', now()->month)
            ->whereYear('event_date', now()->year)
            ->count();
        
        return view('user.dashboard', compact('userEvents', 'totalEvents', 'upcomingEvents', 'thisMonthEvents'));
    }
}
