# Event Management System - Setup Instructions

## Overview
This is a comprehensive Laravel-based Event Management System with role-based authentication, featuring separate dashboards for administrators and regular users.

## Features

### Authentication & Authorization
- **Role-based Access Control**: Admin and User roles with middleware protection
- **Custom Authentication**: Login/Register system with role selection
- **Hero Page**: Beautiful landing page with 3/4 image content and 1/4 authentication forms

### Admin Features
- **Admin Dashboard**: Overview of users, events, and recent activity statistics
- **User Management**: Create, edit, delete users with role assignment
- **Event Management**: View and manage all events created by users
- **Analytics**: View summaries of recent period events and users (30-day stats)

### User Features
- **User Dashboard**: Personal dashboard showing user's events and statistics
- **Event CRUD**: Create, view, edit, and delete personal events
- **Event Details**: Comprehensive event information with status tracking

### Technical Features
- **Laravel 10**: Latest version of Laravel framework
- **MySQL Database**: Robust database with proper relationships
- **Bootstrap 5**: Modern, responsive UI framework
- **Form Validation**: Comprehensive validation for all inputs
- **Middleware Protection**: Route protection based on user roles
- **RESTful Routes**: Proper HTTP methods (GET, POST, PUT/PATCH, DELETE)

## Installation & Setup

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js (optional, for asset compilation)

### Step 1: Database Configuration
1. Create a MySQL database for the project
2. Update the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Generate Application Key
```bash
php artisan key:generate
```

### Step 4: Run Migrations
```bash
php artisan migrate
```

### Step 5: Seed Database (Optional)
```bash
php artisan db:seed
```

This will create sample users and events:
- **Admin User**: admin@example.com / password
- **Regular User**: user@example.com / password
- **Regular User 2**: jane@example.com / password

### Step 6: Start Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Usage Guide

### For Administrators
1. **Login**: Use admin@example.com / password (if seeded)
2. **Dashboard**: View system statistics and recent activity
3. **User Management**: Navigate to Users section to manage all users
4. **Event Management**: View and manage all events in the system
5. **Create Events**: Admins can also create events like regular users

### For Regular Users
1. **Login**: Use user@example.com / password (if seeded)
2. **Dashboard**: View personal event statistics
3. **Create Events**: Click "Create New Event" to add events
4. **Manage Events**: View, edit, or delete your own events
5. **Event Details**: Click on any event to see full details

### Registration
- New users can register from the hero page
- Choose between "User" and "Admin" roles during registration
- All form inputs include proper validation

## Database Structure

### Users Table
- `id`: Primary key
- `name`: User's full name
- `email`: Unique email address
- `password`: Hashed password
- `role`: Enum (admin, user)
- `created_at`, `updated_at`: Timestamps

### Events Table
- `id`: Primary key
- `title`: Event title
- `description`: Event description
- `event_date`: Date and time of event
- `location`: Event location
- `max_participants`: Maximum participants (nullable)
- `status`: Enum (active, cancelled, completed)
- `user_id`: Foreign key to users table
- `created_at`, `updated_at`: Timestamps

## Routes Overview

### Public Routes
- `GET /` - Hero page with login/register
- `POST /login` - Handle login
- `POST /register` - Handle registration
- `POST /logout` - Handle logout

### Admin Routes (Protected by admin middleware)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/users` - User management
- `GET /admin/events` - Event management
- User CRUD operations under `/admin/users/`

### User Routes (Protected by user middleware)
- `GET /user/dashboard` - User dashboard

### Event Routes (Protected by auth middleware)
- Resource routes for events under `/events/`

## Security Features

### Middleware Protection
- **AdminMiddleware**: Ensures only admin users can access admin routes
- **UserMiddleware**: Ensures only regular users can access user-specific routes
- **Auth Middleware**: Protects all authenticated routes

### Form Security
- CSRF protection on all forms
- Input validation and sanitization
- Password hashing using Laravel's Hash facade

### Access Control
- Users can only manage their own events
- Admins can view and manage all events
- Proper authorization checks in controllers

## Customization

### Styling
The application uses Bootstrap 5 with custom CSS. You can modify the styling in:
- `resources/views/layouts/app.blade.php` - Main layout and styles
- Individual view files for component-specific styling

### Adding Features
- **Email Notifications**: Add event reminders
- **Event Categories**: Categorize events
- **File Uploads**: Add event images
- **Event Registration**: Allow users to register for events
- **Calendar Integration**: Add calendar views

## Troubleshooting

### Common Issues
1. **Database Connection**: Ensure MySQL is running and credentials are correct
2. **Permission Errors**: Check file permissions for storage and bootstrap/cache
3. **Composer Issues**: Run `composer install` if dependencies are missing
4. **Migration Errors**: Use `php artisan migrate:fresh` to reset database

### Development Tips
- Use `php artisan tinker` to interact with the application
- Check logs in `storage/logs/laravel.log` for debugging
- Use `php artisan route:list` to see all available routes

## Production Deployment

### Environment Setup
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Configure proper database credentials
4. Set up web server (Apache/Nginx)

### Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

## License
This project is open-sourced software licensed under the MIT license.
