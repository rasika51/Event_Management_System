<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create another regular user
        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create sample events
        Event::create([
            'title' => 'Laravel Workshop',
            'description' => 'A comprehensive workshop on Laravel development covering MVC architecture, Eloquent ORM, and advanced features.',
            'event_date' => now()->addDays(7)->setTime(14, 0),
            'location' => 'Tech Conference Center, Downtown',
            'max_participants' => 50,
            'status' => 'active',
            'user_id' => $user->id,
        ]);

        Event::create([
            'title' => 'Web Development Bootcamp',
            'description' => 'Intensive bootcamp covering HTML, CSS, JavaScript, and modern frameworks. Perfect for beginners.',
            'event_date' => now()->addDays(14)->setTime(9, 0),
            'location' => 'Innovation Hub, Main Street',
            'max_participants' => 30,
            'status' => 'active',
            'user_id' => $user2->id,
        ]);

        Event::create([
            'title' => 'Database Design Seminar',
            'description' => 'Learn about database design principles, normalization, and optimization techniques.',
            'event_date' => now()->addDays(21)->setTime(16, 30),
            'location' => 'University Auditorium',
            'max_participants' => null,
            'status' => 'active',
            'user_id' => $user->id,
        ]);

        Event::create([
            'title' => 'Mobile App Development Conference',
            'description' => 'Annual conference featuring the latest trends in mobile app development for iOS and Android.',
            'event_date' => now()->addDays(30)->setTime(10, 0),
            'location' => 'Convention Center',
            'max_participants' => 200,
            'status' => 'active',
            'user_id' => $user2->id,
        ]);

        Event::create([
            'title' => 'Past Event Example',
            'description' => 'This is an example of a completed event from the past.',
            'event_date' => now()->subDays(5)->setTime(14, 0),
            'location' => 'Community Center',
            'max_participants' => 25,
            'status' => 'completed',
            'user_id' => $user->id,
        ]);
    }
}
