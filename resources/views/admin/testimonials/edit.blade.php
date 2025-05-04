@extends('layouts.app')

@section('pageContent')
<div class="container py-4">
    <h2 class="mb-4">{{ $pageTitle }}</h2>

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

    <form action="{{ route('dashboard.testimonials.update', $testimonial->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="user_id" class="form-label">Participant <span class="text-danger">*</span></label>
            <select name="user_id" id="user_id" class="form-control select2" required>
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('user_id', $testimonial->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" class="form-control" name="designation" id="designation"
                value="{{ old('designation', $testimonial->designation) }}">
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Testimonial <span class="text-danger">*</span></label>
            <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment', $testimonial->comment) }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="status"
                {{ old('status', $testimonial->status) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">
                Active
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Update Testimonial</button>
        <a href="{{ route('dashboard.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection
