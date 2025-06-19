@extends('layouts.app')

@section('pageContent')
<div class="py-4">
    <h2 class="mb-4">{{ $pageTitle ?? 'Edit Batch' }}</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.batches.update', $batch->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="course_id" class="form-label">Select Course <span class="text-danger">*</span></label>
                <select name="course_id" id="course_id" class="form-control select2" required>
                    <option value="">Select a course</option>
                    @foreach ($courses as $id => $name)
                        <option value="{{ $id }}" {{ old('course_id', $batch->course_id) == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-6">
                <label for="title" class="form-label">Batch Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" id="title"
                    value="{{ old('title', $batch->title) }}" required>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" id="duration" value="{{ old('duration', $batch->duration) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Schedule</label>
                        <input type="text" class="form-control" name="schedule" id="schedule" value="{{ old('schedule', $batch->schedule) }}">
                    </div>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date"
                    value="{{ old('start_date', $batch->start_date) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" name="end_date" id="end_date"
                    value="{{ old('end_date', $batch->end_date) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" name="start_time" id="start_time"
                    value="{{ old('start_time', $batch->start_time) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" class="form-control" name="end_time" id="end_time"
                    value="{{ old('end_time', $batch->end_time) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="timezone" class="form-label">Timezone</label>
                <input type="text" class="form-control" name="timezone" id="timezone"
                    value="{{ old('timezone', $batch->timezone) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" name="location" id="location"
                    value="{{ old('location', $batch->location) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" name="price" id="price" step="0.01"
                    value="{{ old('price', $batch->price) }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="discounted_price" class="form-label">Discounted Price</label>
                <input type="number" class="form-control" name="discounted_price" id="discounted_price" step="0.01"
                    value="{{ old('discounted_price', $batch->discounted_price) }}">
            </div>

            <div class="form-check mb-3 col-md-6">
                <input class="form-check-input" type="checkbox" name="status" id="status"
                    {{ old('status', $batch->status) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ $buttonText ?? 'Update Batch' }}</button>
        <a href="{{ route('dashboard.batches.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection
