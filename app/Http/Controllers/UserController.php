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
        $totalEvents = $user->events()->count();
        $upcomingEvents = $user->events()->upcoming()->count();
        
        return view('user.dashboard', compact('userEvents', 'totalEvents', 'upcomingEvents'));
    }
}
