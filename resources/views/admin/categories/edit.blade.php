@extends('layouts.app')

@section('pageContent')
<div class="container py-4">
    <h2 class="mb-4">Edit Category</h2>

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

    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="parent_id">Parent Category (optional)</label>
            <select name="parent_id" id="parent_id" class="form-control select2">
                <option value="">None</option>
                @foreach ($parentCategories as $parent)
                    <option value="{{ $parent->id }}"
                        {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Category Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" id="title"
                value="{{ old('title', $category->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" name="meta_title" id="meta_title"
                value="{{ old('meta_title', $category->meta_title) }}">
        </div>

        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control" name="meta_description" id="meta_description"
                rows="3">{{ old('meta_description', $category->meta_description) }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="status" id="status"
                {{ old('status', $category->status) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">
                Active
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection
