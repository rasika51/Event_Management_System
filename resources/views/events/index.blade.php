@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="bi bi-calendar-event me-2"></i>My Events
                    @if(request('status') === 'active')
                        <small class="text-success">(Active Events)</small>
                    @elseif(request('filter') === 'upcoming')
                        <small class="text-info">(Upcoming Events)</small>
                    @endif
                </h1>
                <a href="{{ route('events.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Create New Event
                </a>
            </div>
        </div>
    </div>
    
    <!-- Filter Options -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm {{ !request('status') && !request('filter') ? 'active' : '' }}">
                            <i class="bi bi-list me-1"></i>All Events
                        </a>
                        <a href="{{ route('events.index', ['status' => 'active']) }}" class="btn btn-outline-success btn-sm {{ request('status') === 'active' ? 'active' : '' }}">
                            <i class="bi bi-calendar-check me-1"></i>Active Events
                        </a>
                        <a href="{{ route('events.index', ['filter' => 'upcoming']) }}" class="btn btn-outline-info btn-sm {{ request('filter') === 'upcoming' ? 'active' : '' }}">
                            <i class="bi bi-calendar-plus me-1"></i>Upcoming Events
                        </a>
                        <a href="{{ route('events.index', ['status' => 'cancelled']) }}" class="btn btn-outline-warning btn-sm {{ request('status') === 'cancelled' ? 'active' : '' }}">
                            <i class="bi bi-calendar-x me-1"></i>Cancelled Events
                        </a>
                        <a href="{{ route('events.index', ['status' => 'completed']) }}" class="btn btn-outline-secondary btn-sm {{ request('status') === 'completed' ? 'active' : '' }}">
                            <i class="bi bi-calendar-check-fill me-1"></i>Completed Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($events->count() > 0)
        <div class="row">
            @foreach($events as $event)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm card-hover">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="badge bg-{{ $event->status === 'active' ? 'success' : ($event->status === 'cancelled' ? 'danger' : 'secondary') }}">
                                {{ ucfirst($event->status) }}
                            </span>
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>{{ $event->created_at->setTimezone(config('app.timezone'))->format('M d, Y') }}
                            </small>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($event->description, 100) }}</p>
                            
                            <div class="mb-2">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $event->event_date->format('M d, Y \a\t H:i A') }}
                                </small>
                            </div>
                            
                            <div class="mb-2">
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                                </small>
                            </div>
                            
                            @if($event->max_participants)
                                <div class="mb-3">
                                    <small class="text-muted">
                                        <i class="bi bi-people me-1"></i>Max Participants: {{ $event->max_participants }}
                                    </small>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                    <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-warning">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                </div>
                                
                                <form method="POST" action="{{ route('events.destroy', $event) }}" 
                                      class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $events->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <div class="card shadow">
                <div class="card-body py-5">
                    <i class="bi bi-calendar-x display-4 text-muted"></i>
                    <h4 class="mt-3 text-muted">No Events Yet</h4>
                    <p class="text-muted">You haven't created any events yet. Start by creating your first event!</p>
                    <a href="{{ route('events.create') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Create Your First Event
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection
