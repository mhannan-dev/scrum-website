@extends('layouts.app')

@section('pageContent')
<div class=" py-4">
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

    <form action="{{ route('dashboard.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Participant/User <span class="text-danger">*</span></label>
            <select name="user_id" id="user_id" class="form-control select2" required>
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Comment <span class="text-danger">*</span></label>
            <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" name="designation" id="designation" class="form-control" value="{{ old('designation') }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Profile Photo</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
        <a href="{{ route('dashboard.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection
