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

        <form action="{{ route('dashboard.trainers.update', $trainer['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-4">
                    <label for="category_id" class="form-label">Parent Category (optional)</label>
                    <select name="category_id" id="category_id" class="form-control select2">
                        <option value="">None</option>
                        @foreach ($parentCategories as $parent)
                            {{-- Use ?? '' for safe access --}}
                            <option value="{{ $parent->id }}"
                                {{ old('category_id', $trainer['category_id'] ?? '') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    {{-- Use ?? '' for safe access --}}
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ old('name', $trainer['name'] ?? '') }}" required>
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    {{-- Use ?? '' for safe access --}}
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{ old('email', $trainer['email'] ?? '') }}" required>
                </div>

                <div class="col-md-4">
                    <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                    {{-- Use ?? '' for safe access --}}
                    <input type="text" class="form-control" name="position" id="position"
                        value="{{ old('position', $trainer['position'] ?? '') }}" required>
                </div>

                <div class="col-md-4">
                    <label for="image" class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" name="image" id="image">
                    {{-- Use !empty() for checking image existence --}}
                    @if (!empty($trainer['image']))
                        <div class="mt-2">
                            <img src="{{ Storage::url($trainer['image']) }}" alt="Profile Photo" class="img-thumbnail"
                                style="max-width: 100px;">
                            <p class="text-muted mt-1">Current Image</p>
                        </div>
                    @endif
                </div>




                <div class="col-12">
                    <label class="form-label">Social Media Links</label>
                    <div id="social-links-container">

                        @foreach ($trainerSocialLinks['social_links'] ?? [] as $index => $socialLink)
                            <div class="row g-2 social-link-group align-items-center mb-3">
                                <div class="col-md-4">
                                    <select name="social_name[]" class="form-control social-name-select">
                                        <option value="">Select</option>
                                        <option value="Facebook"
                                            {{ $socialLink['social_name'] == 'Facebook' ? 'selected' : '' }}>Facebook
                                        </option>
                                        <option value="Twitter"
                                            {{ $socialLink['social_name'] == 'Twitter' ? 'selected' : '' }}>Twitter
                                        </option>
                                        <option value="LinkedIn"
                                            {{ $socialLink['social_name'] == 'LinkedIn' ? 'selected' : '' }}>LinkedIn
                                        </option>
                                        <option value="Instagram"
                                            {{ $socialLink['social_name'] == 'Instagram' ? 'selected' : '' }}>Instagram
                                        </option>
                                        <option value="Youtube"
                                            {{ $socialLink['social_name'] == 'Youtube' ? 'selected' : '' }}>Youtube
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="url" name="link[]" class="form-control" placeholder="Social link"
                                        value="{{ old('link', $socialLink['link'] ?? '') }}">
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex gap-2">
                                        @if ($loop->last)
                                            <button type="button" class="btn btn-success add-social-link w-100">+</button>
                                        @endif
                                        @if (!$loop->first || count($trainerSocialLinks['social_links'] ?? []) > 1)
                                            <button type="button"
                                                class="btn btn-danger remove-social-link w-100">-</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-md-4 form-check form-switch d-flex align-items-center mt-4 ms-2">

                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status"
                            value="1" {{ old('status', $trainer['status'] ?? '') ? 'checked' : '' }}>
                        <label class="form-check-label ms-2" for="status">Active Status</label>
                    </div>
                </div>

            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
                <a href="{{ route('dashboard.trainers.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>

        </form>
    </div>

@endsection
@push('scripts')
    <script>
        $(function() {
            function addSocialLinkRow(socialName = '', link = '') {
                let $container = $('#social-links-container');
                let newRowHtml = `
                    <div class="row g-2 social-link-group align-items-center mb-3">
                        <div class="col-md-4">
                            <select name="social_name[]" class="form-control social-name-select">
                                <option value="">Select</option>
                                <option value="Facebook" ${socialName === 'Facebook' ? 'selected' : ''}>Facebook</option>
                                <option value="Twitter" ${socialName === 'Twitter' ? 'selected' : ''}>Twitter</option>
                                <option value="LinkedIn" ${socialName === 'LinkedIn' ? 'selected' : ''}>LinkedIn</option>
                                <option value="Instagram" ${socialName === 'Instagram' ? 'selected' : ''}>Instagram</option>
                                <option value="Youtube" ${socialName === 'Youtube' ? 'selected' : ''}>Youtube</option>
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
                updateButtonsAndSelect2(); // Update buttons and Select2 after adding
            }

            function updateButtonsAndSelect2() {
                let $container = $('#social-links-container');
                let $socialLinkGroups = $container.find('.social-link-group');

                $container.find('.add-social-link').remove();

                // Add an add button to the last group if there are any groups
                if ($socialLinkGroups.length > 0) {
                    $socialLinkGroups.last().find('.col-md-2 .d-flex').prepend(
                        '<button type="button" class="btn btn-success add-social-link w-100">+</button>'
                    );
                }

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

            } else {
                addSocialLinkRow();
            }

            $(document).on('click', '.add-social-link', function() {
                addSocialLinkRow();
            });

            // Handle Remove button click
            $(document).on('click', '.remove-social-link', function() {
                let $container = $('#social-links-container');
                let $groupToRemove = $(this).closest('.social-link-group');

                if ($container.find('.social-link-group').length > 1) {
                    $groupToRemove.remove();
                } else {
                    $groupToRemove.find('input[name="link[]"]').val('');
                    $groupToRemove.find('select[name="social_name[]"]').val('').trigger('change'); // Clear Select2
                }
                updateButtonsAndSelect2(); // Update buttons and Select2 after removing
            });

            $('#category_id').select2({ // Target only the specific category select
                placeholder: 'None',
                allowClear: true
            });

            updateButtonsAndSelect2();
        });
    </script>
@endpush
