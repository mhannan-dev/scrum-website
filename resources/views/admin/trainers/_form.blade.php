<div class="row g-3">
    <div class="col-md-4">
        <label for="category_id" class="form-label">Parent Category (optional)</label>
        <select name="category_id" id="category_id" class="form-control select2">
            <option value="">None</option>
            @foreach ($parentCategories as $parent)
                <option value="{{ $parent->id }}" {{ old('category_id') == $parent->id ? 'selected' : '' }}>
                    {{ $parent->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
    </div>

    <div class="col-md-4">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
    </div>

    <div class="col-md-4">
        <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="position" id="position" value="{{ old('position') }}"
            required>
    </div>

    <div class="col-md-4">
        <label for="image" class="form-label">Profile Photo</label>
        <input type="file" class="form-control" name="image" id="image">
    </div>

    {{-- Social Media Links --}}
    <div class="col-12">
        <label class="form-label">Social Media Links</label>
        <div id="social-links-container">
            <div class="row g-2 social-link-group align-items-center mb-3">
                <div class="col-md-4">
                    <select name="social_name[]" class="form-control select2">
                        <option value="">Select</option>
                        <option value="Facebook" {{ old('social_name.0') == 'Facebook' ? 'selected' : '' }}>Facebook
                        </option>
                        <option value="Twitter" {{ old('social_name.0') == 'Twitter' ? 'selected' : '' }}>Twitter
                        </option>
                        <option value="LinkedIn" {{ old('social_name.0') == 'LinkedIn' ? 'selected' : '' }}>LinkedIn
                        </option>
                        <option value="Instagram" {{ old('social_name.0') == 'Instagram' ? 'selected' : '' }}>Instagram
                        </option>
                        <option value="Youtube" {{ old('social_name.0') == 'Youtube' ? 'selected' : '' }}>Youtube
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="url" name="link[]" class="form-control" placeholder="Social link"
                        value="{{ old('link.0') }}">
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-success add-social-link w-100">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
</div>


@push('scripts')
    <script>
        $(function() {


            $(document).on('click', '.add-social-link', function() {
                let $container = $('#social-links-container');
                let $firstGroup = $container.find('.social-link-group').first();
                let $newGroup = $firstGroup.clone();

                // reset values
                $newGroup.find('input, select').val('');

                // remove any existing remove buttons in the clone
                $newGroup.find('.remove-social-link').remove();

                // Add remove button if not already present
                $newGroup.find('.col-md-2 .d-flex').append(
                    '<button type="button" class="btn btn-danger remove-social-link w-100">-</button>'
                );

                // Ensure only last group has the Add button
                $container.find('.add-social-link').remove();

                // Append the new group
                $container.append($newGroup);

                // Add Add button back to the last group
                $container.find('.social-link-group').last().find('.col-md-2 .d-flex').prepend(
                    '<button type="button" class="btn btn-success add-social-link w-100">+</button>'
                );

                // Re-initialize select2
                $newGroup.find('.select2').select2({
                    placeholder: 'Select',
                    allowClear: true
                });
            });

            $(document).on('click', '.remove-social-link', function() {
                $(this).closest('.social-link-group').remove();

                let $container = $('#social-links-container');

                // ensure Add button exists in the last group
                if ($container.find('.add-social-link').length === 0 && $container.find(
                        '.social-link-group').length > 0) {
                    $container.find('.social-link-group').last().find('.col-md-2 .d-flex').prepend(
                        '<button type="button" class="btn btn-success add-social-link w-100">+</button>'
                    );
                }
            });

            // Init select2 for any pre-existing selects
            $('.select2').select2({
                placeholder: 'Select',
                allowClear: true
            });
        });
    </script>
@endpush
