@extends('layouts.app')

@section('pageContent')
    <div class="container-fluid py-4">
        <h1 class="h3 mb-3 text-gray-800">{{ $pageTitle }}</h1>
        @include('../../inc/_messages')

        <!-- Courses Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                <a href="{{ route('dashboard.courses.create') }}" class="btn btn-sm btn-success">+ Add Course</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Trainer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses as $index => $course)
                                <tr>
                                    <td>{{ ($courses->currentPage() - 1) * $courses->perPage() + $index + 1 }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->category->title ?? '—' }}</td>
                                    <td>
                                        @if ($course->image && file_exists(public_path('storage/' . $course->image)))
                                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}"
                                                width="80" height="60">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif

                                    </td>
                                    <td>{{ $course->trainer->name ?? '—' }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.courses.edit', $course->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ route('dashboard.courses.destroy', $course->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this course?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-warning">No courses found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
