@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="bi bi-calendar-plus me-2"></i>Create New Event
                </h1>
                <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Events
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Event Details</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required
                                   placeholder="Enter a descriptive title for your event">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required
                                      placeholder="Provide a detailed description of your event">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="event_date" class="form-label">Event Date & Time <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('event_date') is-invalid @enderror" 
                                       id="event_date" name="event_date" value="{{ old('event_date') }}" required
                                       min="{{ now()->format('Y-m-d\TH:i') }}">
                                @error('event_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Event must be scheduled for a future date and time.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location') }}" required
                                       placeholder="Event venue or address">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="max_participants" class="form-label">Maximum Participants</label>
                                <input type="number" class="form-control @error('max_participants') is-invalid @enderror" 
                                       id="max_participants" name="max_participants" value="{{ old('max_participants') }}" 
                                       min="1" placeholder="Leave empty for unlimited">
                                @error('max_participants')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty for unlimited participants.</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" value="Active" readonly>
                                <input type="hidden" name="status" value="active">
                                <div class="form-text">New events are automatically set to Active status.</div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Note:</strong> Once created, you can edit or delete this event from your events dashboard.
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Create Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    // Set minimum date to current date and time
    document.addEventListener('DOMContentLoaded', function() {
        const eventDateInput = document.getElementById('event_date');
        const now = new Date();
        
        // Add 1 minute buffer to ensure we're always in the future
        now.setMinutes(now.getMinutes() + 1);
        
        // Format for datetime-local input (YYYY-MM-DDTHH:MM)
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        
        const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
        eventDateInput.min = minDateTime;
        
        // Add real-time validation
        eventDateInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const currentDate = new Date();
            
            if (selectedDate <= currentDate) {
                this.setCustomValidity('Please select a future date and time.');
                this.reportValidity();
            } else {
                this.setCustomValidity('');
            }
        });
    });
</script>
@endpush
@endsection
