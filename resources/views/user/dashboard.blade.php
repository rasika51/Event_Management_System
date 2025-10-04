@extends('layouts.app')

@section('content')

<!-- Statistics Cards -->
<div class="row mb-2">
    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="stats-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stats-label mb-2">Total Events</div>
                    <div class="stats-number">{{ $totalEvents }}</div>
                </div>
                <div class="stats-icon icon-primary">
                    <i class="bi bi-calendar-event"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="stats-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stats-label mb-2">Upcoming Events</div>
                    <div class="stats-number">{{ $upcomingEvents }}</div>
                </div>
                <div class="stats-icon icon-success">
                    <i class="bi bi-calendar-plus"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="stats-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="stats-label mb-2">This Month</div>
                    <div class="stats-number">{{ $thisMonthEvents }}</div>
                </div>
                <div class="stats-icon icon-info">
                    <i class="bi bi-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-2">
    <div class="col-12">
        <div class="recent-events-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold" style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Quick Actions
                </h5>
            </div>
            <div class="p-2">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="{{ route('events.create') }}" class="action-btn btn-primary-gradient w-100 text-center">
                            <i class="bi bi-plus-circle"></i>
                            Create New Event
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="{{ route('events.index') }}" class="action-btn btn-outline-gradient w-100 text-center">
                            <i class="bi bi-list"></i>
                            View All Events
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="{{ route('events.index') }}?status=active" class="action-btn btn-outline-gradient w-100 text-center">
                            <i class="bi bi-calendar-check"></i>
                            Active Events
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <a href="{{ route('events.index') }}?filter=upcoming" class="action-btn btn-outline-gradient w-100 text-center">
                            <i class="bi bi-calendar-plus"></i>
                            Upcoming Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Events -->
<div class="row mt-2">
    <div class="col-12">
        <div class="recent-events-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold" style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Your Recent Events
                </h5>
                <a href="{{ route('events.index') }}" class="btn-view-all">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="p-0">
                @if($userEvents->count() > 0)
                    @foreach($userEvents as $event)
                        <div class="d-flex align-items-center p-4 border-bottom">
                            <div class="stats-icon icon-{{ $event->status === 'active' ? 'success' : ($event->status === 'cancelled' ? 'warning' : 'primary') }} me-4">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold text-dark">{{ $event->title }}</h6>
                                <p class="mb-2 text-muted">{{ Str::limit($event->description, 80) }}</p>
                                <div class="d-flex align-items-center text-muted small">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    <span class="me-3">{{ $event->location }}</span>
                                    <i class="bi bi-calendar me-1"></i>
                                    <span>{{ $event->event_date->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <span class="badge bg-{{ $event->status === 'active' ? 'success' : ($event->status === 'cancelled' ? 'danger' : 'secondary') }} mb-2 px-3 py-2">
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
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-calendar-x display-4 text-muted"></i>
                        </div>
                        <h5 class="text-dark mb-3">
                            <i class="bi bi-info-circle me-2 text-primary"></i>No Events Yet
                        </h5>
                        <p class="text-muted mb-4">Start by creating your first event and begin managing your activities!</p>
                        <a href="{{ route('events.create') }}" class="action-btn btn-primary-gradient">
                            <i class="bi bi-plus-circle me-2"></i>Create Your First Event
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
