@php
    $course = $course ?? null;
@endphp

@csrf
<div class="row">
    <div class="mb-3 col-md-4">
        <label for="name" class="form-label">Course Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" id="name"
            value="{{ old('name', $course->name ?? '') }}" required>
    </div>

    <div class="mb-3 col-md-4">
        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
        <select name="category_id" id="category_id" class="form-control select2" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $course->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-4">
        <label for="user_id" class="form-label">Trainer <span class="text-danger">*</span></label>
        <select name="user_id" id="user_id" class="form-control select2" required>
            <option value="">Select a trainer</option>
            @foreach ($trainers as $id => $name)
                <option value="{{ $id }}"
                    {{ old('user_id', $course->user_id ?? '') == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3 col-md-4">
        <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
        <input type="file" name="image" id="image" class="form-control" {{ isset($course) ? '' : 'required' }}>
        @if(isset($course) && $course->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" height="80">
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="mb-3 col-md-4">
        <label for="sub_title" class="form-label">Sub Title</label>
        <input type="text" class="form-control" name="sub_title" id="sub_title"
            value="{{ old('sub_title', $course->sub_title ?? '') }}">
    </div>

    <div class="mb-3 col-md-4">
        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
        <input type="number" class="form-control" step="0.01" name="price" id="price"
            value="{{ old('price', $course->price ?? '') }}" required>
    </div>

    <div class="mb-3 col-md-4">
        <label for="special_price" class="form-label">Special Price</label>
        <input type="number" class="form-control" step="0.01" name="special_price" id="special_price"
            value="{{ old('special_price', $course->special_price ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label for="short_description" class="form-label">Short Description <span class="text-danger">*</span></label>
    <textarea class="form-control summernote" name="short_description" id="short_description" rows="3">{{ old('short_description', $course->short_description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
    <textarea class="form-control summernote" name="description" id="description" rows="6">{{ old('description', $course->description ?? '') }}</textarea>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('dashboard.courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
