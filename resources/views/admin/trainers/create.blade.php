@extends('layouts.app')

@section('pageContent')
    <div class="py-4">
        <h2 class="mb-4">{{ $pageTitle }} </h2>

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

        <form action="{{ route('dashboard.trainers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category_id">Parent Category (optional)</label>
                <select name="category_id" id="category_id" class="form-control select2">
                    <option value="">None</option>
                    @foreach ($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Profile Photo</label>
                <input type="file" class="form-control" name="image" id="image"
                    value="{{ old('image') }}">
            </div>
            <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
@endsection
