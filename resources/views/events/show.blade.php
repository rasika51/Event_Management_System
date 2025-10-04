@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="bi bi-calendar-event me-2"></i>Event Details
                </h1>
                <div class="btn-group">
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.events') : route('events.index') }}" 
                       class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                    @if($event->user_id === auth()->id())
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Edit Event
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Event Information -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $event->title }}</h6>
                    <span class="badge bg-{{ $event->status === 'active' ? 'success' : ($event->status === 'cancelled' ? 'danger' : 'secondary') }} fs-6">
                        {{ ucfirst($event->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-calendar-event me-2"></i>Date & Time
                            </h6>
                            <p class="mb-0">{{ $event->event_date->format('l, F j, Y') }}</p>
                            <p class="text-muted">{{ $event->event_date->format('g:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-geo-alt me-2"></i>Location
                            </h6>
                            <p class="mb-0">{{ $event->location }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-person me-2"></i>Organizer
                            </h6>
                            <p class="mb-0">{{ $event->user->name }}</p>
                            <p class="text-muted">{{ $event->user->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-people me-2"></i>Participants
                            </h6>
                            @if($event->max_participants)
                                <p class="mb-0">Maximum: {{ $event->max_participants }}</p>
                            @else
                                <p class="mb-0 text-success">Unlimited</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">
                            <i class="bi bi-file-text me-2"></i>Description
                        </h6>
                        <div class="bg-light p-3 rounded">
                            <p class="mb-0">{{ $event->description }}</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-clock me-2"></i>Created
                            </h6>
                            <p class="mb-0">{{ $event->formatted_created_at }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">
                                <i class="bi bi-arrow-clockwise me-2"></i>Last Updated
                            </h6>
                            <p class="mb-0">{{ $event->formatted_updated_at }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Event Actions & Info -->
        <div class="col-lg-4 mb-4">
            <!-- Actions Card -->
            @if($event->user_id === auth()->id())
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="bi bi-gear me-2"></i>Event Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i>Edit Event
                            </a>
                            <form method="POST" action="{{ route('events.destroy', $event) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-trash me-2"></i>Delete Event
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Event Status Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-info-circle me-2"></i>Event Status
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        @if($event->status === 'active')
                            <i class="bi bi-check-circle display-4 text-success"></i>
                            <h5 class="mt-2 text-success">Active Event</h5>
                            <p class="text-muted">This event is currently active and accepting participants.</p>
                        @elseif($event->status === 'cancelled')
                            <i class="bi bi-x-circle display-4 text-danger"></i>
                            <h5 class="mt-2 text-danger">Cancelled Event</h5>
                            <p class="text-muted">This event has been cancelled.</p>
                        @else
                            <i class="bi bi-check-circle-fill display-4 text-secondary"></i>
                            <h5 class="mt-2 text-secondary">Completed Event</h5>
                            <p class="text-muted">This event has been completed.</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Time Information -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-clock me-2"></i>Time Information
                    </h6>
                </div>
                <div class="card-body">
                    @php
                        $now = now();
                        $eventDate = $event->event_date;
                        $isUpcoming = $eventDate->isFuture();
                        $isPast = $eventDate->isPast();
                        $diffForHumans = $eventDate->diffForHumans();
                    @endphp
                    
                    @if($isUpcoming)
                        <div class="text-center">
                            <i class="bi bi-calendar-plus display-6 text-info"></i>
                            <h6 class="mt-2 text-info">Upcoming Event</h6>
                            <p class="text-muted">{{ $diffForHumans }}</p>
                        </div>
                    @else
                        <div class="text-center">
                            <i class="bi bi-calendar-check display-6 text-muted"></i>
                            <h6 class="mt-2 text-muted">Past Event</h6>
                            <p class="text-muted">{{ $diffForHumans }}</p>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <div class="small text-muted">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Event Date:</span>
                            <span>{{ $eventDate->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Event Time:</span>
                            <span>{{ $eventDate->format('g:i A') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Timezone:</span>
                            <span>{{ $eventDate->format('T') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
