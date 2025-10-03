<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $recentEvents = Event::with('user')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        
        // Statistics for recent period (last 30 days)
        $recentEventsCount = Event::where('created_at', '>=', now()->subDays(30))->count();
        $recentUsersCount = User::where('created_at', '>=', now()->subDays(30))->count();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalEvents', 
            'recentEvents', 
            'recentUsers',
            'recentEventsCount',
            'recentUsersCount'
        ));
    }

    /**
     * Show all users
     */
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user creation form
     */
    public function createUser()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    /**
     * Show user edit form
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
        ]);

        $user->update($request->only('name', 'email', 'role'));

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    /**
     * Show all events
     */
    public function events()
    {
        $events = Event::with('user')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Delete event
     */
    public function deleteEvent(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events')->with('success', 'Event deleted successfully.');
    }
}
