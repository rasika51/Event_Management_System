@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="bi bi-speedometer2 me-2"></i>User Dashboard
                </h1>
                <span class="badge bg-success fs-6">User</span>
            </div>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading">
                    <i class="bi bi-person-circle me-2"></i>Welcome, {{ auth()->user()->name }}!
                </h4>
                <p class="mb-0">Manage your events and create new ones from this dashboard.</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 card-hover">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Events
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalEvents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-event fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 card-hover">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Upcoming Events
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $upcomingEvents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 card-hover">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Quick Actions
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('events.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i>New Event
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-lightning fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Events -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-calendar-event me-2"></i>Your Recent Events
                    </h6>
                    <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-primary">
                        View All <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if($userEvents->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($userEvents as $event)
                                <div class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $event->title }}</div>
                                        <p class="mb-1 text-muted">{{ Str::limit($event->description, 100) }}</p>
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                                            <i class="bi bi-calendar ms-2 me-1"></i>{{ $event->event_date->format('M d, Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span class="badge bg-{{ $event->status === 'active' ? 'success' : ($event->status === 'cancelled' ? 'danger' : 'secondary') }} mb-2">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-calendar-x display-4 text-muted"></i>
                            <h5 class="mt-3 text-muted">No Events Yet</h5>
                            <p class="text-muted">Start by creating your first event!</p>
                            <a href="{{ route('events.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Create Your First Event
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-lightning me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('events.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Create New Event
                        </a>
                        <a href="{{ route('events.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-list me-2"></i>View All Events
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">
                        <i class="bi bi-lightbulb me-2"></i>Tips
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Set clear event descriptions to attract more participants</small>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Schedule events well in advance for better planning</small>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Set participant limits to manage capacity</small>
                        </li>
                        <li>
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Update event status as needed</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
</style>
@endsection
