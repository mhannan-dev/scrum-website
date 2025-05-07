@extends('layouts.app')

@section('pageContent')
    <div class="py-4">
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

        <form action="{{ route('dashboard.batches.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="course_id" class="form-label">Course <span class="text-danger">*</span></label>
                    <select name="course_id" id="course_id" class="form-control select2" required>
                        <option value="">Select a course</option>
                        @foreach ($courses as $id => $name)
                            <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="user_id" class="form-label">Category (optional)</label>
                    <select name="user_id" id="user_id" class="form-control select2">
                        <option value="">Select a category</option>
                        @foreach ($parentCategories as $cat)
                            <option value="{{ $cat->id }}" {{ old('user_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Batch Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
            </div>



            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="time" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="time" class="form-control" name="end_time" id="end_time" value="{{ old('end_time') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="timezone" class="form-label">Timezone</label>
                <input type="text" class="form-control" name="timezone" id="timezone" value="{{ old('timezone') }}">
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ old('price', 0.00) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="discounted_price" class="form-label">Discounted Price</label>
                    <input type="number" step="0.01" class="form-control" name="discounted_price" id="discounted_price" value="{{ old('discounted_price', 0.00) }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
            <a href="{{ route('dashboard.batches.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>
@endsection
