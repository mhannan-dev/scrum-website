@extends('layouts.app')

@section('pageContent')
    <div class="container py-4">
        <h2 class="mb-4">{{ $pageTitle }}</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
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

        {{-- Edit Course Form --}}
        <form action="{{ route('dashboard.courses.update', $course->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Course Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name', $course->name) }}" required>
            </div>

            {{-- Course Details --}}
            <div class="mb-3">
                <label for="details" class="form-label">Course Details</label>
                <textarea name="details" id="details" class="form-control" rows="4">{{ old('details', $course->details) }}</textarea>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                <select name="category_id" id="category_id" class="form-control select2" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $id => $title)
                        <option value="{{ $id }}" {{ old('category_id', $course->category_id) == $id ? 'selected' : '' }}>
                            {{ $title }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Trainer --}}
            <div class="mb-3">
                <label for="user_id" class="form-label">Trainer <span class="text-danger">*</span></label>
                <select name="user_id" id="user_id" class="form-control select2" required>
                    <option value="">Select a trainer</option>
                    @foreach ($trainers as $id => $name)
                        <option value="{{ $id }}" {{ old('user_id', $course->user_id) == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Submit & Cancel --}}
            <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
            <a href="{{ route('dashboard.courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
@endsection
