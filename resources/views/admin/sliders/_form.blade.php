@php
    $slider = $slider ?? null;
@endphp

@csrf
<div class="row">
    <div class="mb-3 col-md-4">
        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="title" id="title"
            value="{{ old('title', $slider->title ?? '') }}" required>
    </div>

    <div class="mb-3 col-md-4">
        <label for="top_button" class="form-label">Top Button Text</label>
        <input type="text" class="form-control" name="top_button" id="top_button"
            value="{{ old('top_button', $slider->top_button ?? '') }}">
    </div>



    <div class="mb-3 col-md-4">
        <label for="main_button" class="form-label">Main Button Text</label>
        <input type="text" class="form-control" name="main_button" id="main_button"
            value="{{ old('main_button', $slider->main_button ?? '') }}">
    </div>

    <div class="mb-3 col-md-4">
        <label for="main_button_link" class="form-label">Main Button Link</label>
        <input type="url" class="form-control" name="main_button_link" id="main_button_link"
            value="{{ old('main_button_link', $slider->main_button_link ?? '') }}">
    </div>

    <div class="mb-3 col-md-4">
        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" id="status" class="form-control" required>
            <option value="1" {{ old('status', $slider->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $slider->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <div class="mb-3 col-md-4">
        <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
        <input type="file" name="image" id="image" class="form-control" {{ isset($slider) ? '' : 'required' }}>
        @if(isset($slider) && $slider->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image" height="80">
            </div>
        @endif
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control summernote" name="description" id="description" rows="4">{{ old('description', $slider->description ?? '') }}</textarea>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('dashboard.slider.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
