@extends('layouts.app')

@section('pageContent')
    <div class="container-fluid py-4">
        <h1 class="h3 mb-3 text-gray-800">{{ $pageTitle }}</h1>
        @include('../../inc/_messages')

        <!-- Sliders Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <a href="{{ route('dashboard.slider.create') }}" class="btn btn-sm btn-success">+ Add Slider</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Top Button</th>
                                <th>Main Button</th>
                                <th>Main Button Link</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $index => $slider)
                                <tr>
                                    <td>{{ $items->firstItem() + $index }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->top_button_text ?? '—' }}</td>
                                    <td>{{ $slider->main_button_text ?? '—' }}</td>
                                    <td>
                                        @if($slider->main_button_link)
                                            <a href="{{ $slider->main_button_link }}" target="_blank">Link</a>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($slider->description, 80) ?? '—' }}</td>
                                    <td>
                                        @if ($slider->image && file_exists(public_path('storage/' . $slider->image)))
                                            <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}"
                                                 width="80" height="60" class="rounded shadow-sm">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($slider->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.slider.edit', $slider->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('dashboard.slider.destroy', $slider->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this slider?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-warning">No sliders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
