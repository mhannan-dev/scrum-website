<div class="row g-3">
    <div class="col-md-4">
        <label for="category_id" class="form-label">Parent Category (optional)</label>
        <select name="category_id" id="category_id" class="form-control select2">
            <option value="">None</option>
            @foreach ($parentCategories as $parent)
                <option value="{{ $parent->id }}"
                    {{ old('category_id', @$trainer['category_id']) == $parent->id ? 'selected' : '' }}>
                    {{ $parent->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" id="name"
            value="{{ old('name', @$trainer['name']) }}" required>
    </div>

    <div class="col-md-4">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email" id="email"
            value="{{ old('email', @$trainer['email']) }}" required>
    </div>

    <div class="col-md-4">
        <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="position" id="position"
            value="{{ old('position', @$trainer['position']) }}" required>
    </div>

    <div class="col-md-4">
        <label for="image" class="form-label">Profile Photo</label>
        <input type="file" class="form-control" name="image" id="image">
        @if (@$trainer['image'])
            <div class="mt-2">
                <img src="{{ Storage::url(@$trainer['image']) }}" alt="Profile Photo" class="img-thumbnail"
                    style="max-width: 100px;">
                <p class="text-muted mt-1">Current Image</p>
            </div>
        @endif
    </div>



    <div class="col-12">
        <label class="form-label">Social Media Links</label>
        <div id="social-links-container">
            {{-- @dd($trainerSocialLinks['social_links']); --}}
            @forelse ($trainerSocialLinks['social_links'] ?? [] as $index => $socialLink)
                {{-- @dd($socialLink['platform']); --}}
                <div class="row g-2 social-link-group align-items-center mb-3">
                    <div class="col-md-4">
                        <select name="social_name[]" class="form-control select2">
                            <option value="">Select</option>
                            {{-- Access properties using -> for Eloquent models --}}
                            <option value="Facebook"
                                {{ old('social_name.' . $index, $socialLink['platform'] ?? '') == 'Facebook' ? 'selected' : '' }}>
                                Facebook</option>
                            <option value="Twitter"
                                {{ old('social_name.' . $index, $socialLink['platform'] ?? '') == 'Twitter' ? 'selected' : '' }}>
                                Twitter</option>
                            <option value="LinkedIn"
                                {{ old('social_name.' . $index, $socialLink['platform'] ?? '') == 'LinkedIn' ? 'selected' : '' }}>
                                LinkedIn</option>
                            <option value="Instagram"
                                {{ old('social_name.' . $index, $socialLink['platform'] ?? '') == 'Instagram' ? 'selected' : '' }}>
                                Instagram</option>
                            <option value="Youtube"
                                {{ old('social_name.' . $index, $socialLink['platform'] ?? '') == 'Youtube' ? 'selected' : '' }}>
                                Youtube</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input type="url" name="link[]" class="form-control" placeholder="Social link"
                            value="{{ old('link.' . $index, $socialLink['url'] ?? '') }}">
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            @if ($loop->last)
                                <button type="button" class="btn btn-success add-social-link w-100">+</button>
                            @endif
                            {{-- Use ->count() for collections --}}
                            @if (!$loop->first || count($trainerSocialLinks) > 1)
                                <button type="button" class="btn btn-danger remove-social-link w-100">-</button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="row g-2 social-link-group align-items-center mb-3">
                    <div class="col-md-4">
                        <select name="social_name[]" class="form-control select2">
                            <option value="">Select</option>
                            <option value="Facebook" {{ old('social_name.0') == 'Facebook' ? 'selected' : '' }}>
                                Facebook</option>
                            <option value="Twitter" {{ old('social_name.0') == 'Twitter' ? 'selected' : '' }}>Twitter
                            </option>
                            <option value="LinkedIn" {{ old('social_name.0') == 'LinkedIn' ? 'selected' : '' }}>
                                LinkedIn</option>
                            <option value="Instagram" {{ old('social_name.0') == 'Instagram' ? 'selected' : '' }}>
                                Instagram</option>
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
            @endforelse
        </div>
        <div class="col-md-4 form-check form-switch d-flex align-items-center mt-4 ms-2">
            {{-- Access status using -> for Eloquent model --}}
            <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1"
                {{ old('status', @$trainer['status']) ? 'checked' : '' }}>
            <label class="form-check-label ms-2" for="status">Active Status</label>
        </div>
    </div>

</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
    <a href="{{ route('dashboard.trainers.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
</div>


@push('scripts')
    <script>
        $(function() {
            // Function to add a social link row (no change needed here)
            function addSocialLinkRow(socialName = '', link = '') {
                let $container = $('#social-links-container');
                let newRowHtml = `
                    <div class="row g-2 social-link-group align-items-center mb-3">
                        <div class="col-md-4">
                            <select name="social_name[]" class="form-control social-name-select">
                                <option value="">Select</option>
                                <option value="Facebook" ${socialName == 'Facebook' ? 'selected' : ''}>Facebook</option>
                                <option value="Twitter" ${socialName == 'Twitter' ? 'selected' : ''}>Twitter</option>
                                <option value="LinkedIn" ${socialName == 'LinkedIn' ? 'selected' : ''}>LinkedIn</option>
                                <option value="Instagram" ${socialName == 'Instagram' ? 'selected' : ''}>Instagram</option>
                                <option value="Youtube" ${socialName == 'Youtube' ? 'selected' : ''}>Youtube</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="url" name="link[]" class="form-control" placeholder="Social link" value="${link}">
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-success add-social-link w-100">+</button>
                                <button type="button" class="btn btn-danger remove-social-link w-100">-</button>
                            </div>
                        </div>
                    </div>
                `;

                let $newGroup = $(newRowHtml);
                $container.append($newGroup);
                updateButtonsAndSelect2(); // Always call this after adding/removing
            }

            // Unified function to manage add/remove buttons and Select2 initialization (no change needed here)
            function updateButtonsAndSelect2() {
                let $container = $('#social-links-container');
                let $socialLinkGroups = $container.find('.social-link-group');

                // Remove all existing add buttons
                $container.find('.add-social-link').remove();

                // Add an add button to the last group if there are any groups
                if ($socialLinkGroups.length > 0) {
                    $socialLinkGroups.last().find('.col-md-2 .d-flex').prepend(
                        '<button type="button" class="btn btn-success add-social-link w-100">+</button>'
                    );
                }

                // Control visibility of remove buttons
                if ($socialLinkGroups.length === 1) {
                    $socialLinkGroups.find('.remove-social-link').hide();
                } else {
                    $socialLinkGroups.find('.remove-social-link').show();
                }

                $socialLinkGroups.find('.social-name-select:not(.select2-hidden-accessible)').select2({
                    placeholder: 'Select',
                    allowClear: true
                });
            }

            const initialSocialLinks = @json($trainerSocialLinks['social_links'] ?? []);

            if (initialSocialLinks.length > 0) {
                $('#social-links-container .social-link-group').remove();

                initialSocialLinks.forEach(function(socialLink) {
                    addSocialLinkRow(socialLink.platform || '', socialLink.url || '');
                });
            }


            $(document).on('click', '.add-social-link', function() {
                addSocialLinkRow();
            });

            // Handle Remove button click (no change needed here)
            $(document).on('click', '.remove-social-link', function() {
                let $container = $('#social-links-container');
                let $groupToRemove = $(this).closest('.social-link-group');

                if ($container.find('.social-link-group').length > 1) {
                    $groupToRemove.remove();
                } else {
                    // If it's the last row, just clear values instead of removing
                    $groupToRemove.find('input, select').val('');
                    $groupToRemove.find('.social-name-select').val('').trigger('change');
                }
                updateButtonsAndSelect2();
            });

            // Initial setup on document ready
            // Call updateButtonsAndSelect2 to correctly set up buttons and Select2
            // whether the page loaded with existing links or the empty block.
            updateButtonsAndSelect2();
        });
    </script>
@endpush
