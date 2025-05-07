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

        <form action="{{ route('dashboard.courses.store') }}" method="POST">
            @csrf
            

            <div class="mb-3">
                <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                <select name="category_id" id="category_id" class="form-control select2" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Trainer <span class="text-danger">*</span></label>
                <select name="user_id" id="user_id" class="form-control select2" required>
                    <option value="">Select a trainer</option>
                    @foreach ($trainers as $id => $name)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="sub_title" class="form-label">Sub Title</label>
                <input type="text" class="form-control" name="sub_title" id="sub_title"
                    value="{{ old('sub_title') }}">
            </div>

 
            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="short_description" id="short_description" rows="3">{{ old('short_description') }}</textarea>
            </div>

  
            <div class="mb-3">
                <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" id="description" rows="6">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                <input type="number" class="form-control" step="0.01" name="price" id="price"
                    value="{{ old('price') }}">
            </div>

   
            <div class="mb-3">
                <label for="special_price" class="form-label">Special Price</label>
                <input type="number" class="form-control" step="0.01" name="special_price" id="special_price"
                    value="{{ old('special_price') }}">
            </div>

            

            <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
            <a href="{{ route('dashboard.courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>

    </div>
@endsection
