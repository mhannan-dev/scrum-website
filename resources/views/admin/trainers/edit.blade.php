@extends('layouts.app')

@section('pageContent')
<div class="container py-4">
    <h2 class="mb-4">Edit Trainer</h2>

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

    <form action="{{ route('dashboard.trainers.update', $trainer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="category_id">Parent Category (optional)</label>
            <select name="category_id" id="category_id" class="form-control select2">
                <option value="">None</option>
                @foreach ($parentCategories as $parent)
                    <option value="{{ $parent->id }}" {{ $trainer->category_id == $parent->id ? 'selected' : '' }}>
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>
        

        <div class="mb-3">
            <label for="name" class="form-label">Trainer Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="name"
                value="{{ old('name', $trainer->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" id="email"
                value="{{ old('email', $trainer->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Photo</label>
            <input type="file" class="form-control" name="image" id="image">
            @if($trainer->image)
                <img src="{{ asset('storage/' . $trainer->image) }}" alt="Trainer Image" style="max-width: 100px;" class="mt-2">
            @endif
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="status"
                {{ old('status', $trainer->status) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">
                Active
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Update Trainer</button>
        <a href="{{ route('dashboard.trainers.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection
