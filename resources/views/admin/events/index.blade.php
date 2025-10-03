@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="bi bi-calendar-check me-2"></i>Event Management
                </h1>
                <a href="{{ route('events.create') }}" class="btn btn-primary">
                    <i class="bi bi-calendar-plus me-2"></i>Create New Event
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Events</h6>
        </div>
        <div class="card-body">
            @if($events->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Organizer</th>
                                <th>Date & Time</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Participants</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $event->title }}</div>
                                        <small class="text-muted">{{ Str::limit($event->description, 50) }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-circle me-2 text-muted"></i>
                                            {{ $event->user->name }}
                                        </div>
                                        <small class="text-muted">{{ $event->user->email }}</small>
                                    </td>
                                    <td>
                                        <div>{{ $event->event_date->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $event->event_date->format('H:i A') }}</small>
                                    </td>
                                    <td>
                                        <i class="bi bi-geo-alt me-1 text-muted"></i>
                                        {{ $event->location }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $event->status === 'active' ? 'success' : ($event->status === 'cancelled' ? 'danger' : 'secondary') }} px-2 py-1" style="min-width: 50px; text-align: center; display: inline-block; font-size: 0.75rem;">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($event->max_participants)
                                            <span class="badge bg-info">
                                                Max: {{ $event->max_participants }}
                                            </span>
                                        @else
                                            <span class="text-muted">Unlimited</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('events.show', $event) }}" 
                                               class="btn btn-outline-primary" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('events.edit', $event) }}" 
                                               class="btn btn-outline-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" 
                                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $events->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x display-4 text-muted"></i>
                    <h5 class="mt-3 text-muted">No Events Found</h5>
                    <p class="text-muted">No events have been created yet.</p>
                    <a href="{{ route('events.create') }}" class="btn btn-primary">
                        <i class="bi bi-calendar-plus me-2"></i>Create First Event
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
