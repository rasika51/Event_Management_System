@extends('layouts.app')

@section('content')

<!-- Quick Actions -->
<div class="row mb-5">
    <div class="col-12">
        <div class="recent-events-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold" style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Quick Actions
                </h5>
            </div>
            <div class="p-4">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.users.create') }}" class="action-btn btn-primary-gradient w-100 text-center">
                            <i class="bi bi-person-plus"></i>Add New User
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.users') }}" class="action-btn btn-outline-gradient w-100 text-center">
                            <i class="bi bi-people"></i>Manage Users
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.events') }}" class="action-btn btn-outline-gradient w-100 text-center">
                            <i class="bi bi-calendar-check"></i>Manage Events
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('events.create') }}" class="action-btn btn-primary-gradient w-100 text-center">
                            <i class="bi bi-calendar-plus"></i>Create Event
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Analytics Charts -->
<div class="row mb-5">
    <div class="col-lg-6 mb-4">
        <div class="recent-events-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold" style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    <i class="bi bi-graph-up me-2"></i>New Users (14 Days)
                </h5>
            </div>
            <div class="p-4">
                <canvas id="userChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-4">
        <div class="recent-events-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold" style="background: linear-gradient(45deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    <i class="bi bi-calendar-event me-2"></i>New Events (14 Days)
                </h5>
            </div>
            <div class="p-4">
                <canvas id="eventChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <!-- Recent Events -->
    <div class="col-lg-6 mb-4">
        <div class="recent-events-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="bi bi-calendar-event me-2"></i>Recent Events
                </h6>
                <a href="{{ route('admin.events') }}" class="btn-view-all">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body">
                @if($recentEvents->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentEvents as $event)
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ $event->title }}</div>
                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i>{{ $event->user->name }}
                                        <i class="bi bi-calendar ms-2 me-1"></i>{{ $event->event_date->format('M d, Y') }}
                                    </small>
                                </div>
                                <span class="badge bg-{{ $event->status === 'active' ? 'success' : ($event->status === 'cancelled' ? 'danger' : 'secondary') }} rounded-pill">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x display-4 text-muted mb-3"></i>
                        <p class="text-muted mt-2">
                            <i class="bi bi-info-circle me-2 text-primary"></i>No events found
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="col-lg-6 mb-4">
        <div class="recent-events-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="bi bi-people me-2"></i>Recent Users
                </h6>
                <a href="{{ route('admin.users') }}" class="btn-view-all">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body">
                @if($recentUsers->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentUsers as $user)
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <small class="text-muted">
                                        <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                                    </small>
                                </div>
                                <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }} rounded-pill">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-person-x display-4 text-muted mb-3"></i>
                        <p class="text-muted mt-2">
                            <i class="bi bi-info-circle me-2 text-primary"></i>No users found
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // User Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(userCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($userChartData, 'date')) !!},
            datasets: [{
                label: 'New Users',
                data: {!! json_encode(array_column($userChartData, 'count')) !!},
                borderColor: '#1e3a8a',
                backgroundColor: 'rgba(30, 58, 138, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#1e3a8a',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#1e3a8a'
                }
            }
        }
    });

    // Event Chart
    const eventCtx = document.getElementById('eventChart').getContext('2d');
    const eventChart = new Chart(eventCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($eventChartData, 'date')) !!},
            datasets: [{
                label: 'New Events',
                data: {!! json_encode(array_column($eventChartData, 'count')) !!},
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#10b981'
                }
            }
        }
    });
});
</script>
@endpush
