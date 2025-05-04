@extends('layouts.app')

@section('pageContent')
<div class="container-fluid py-4">
    <h1 class="h3 mb-3 text-gray-800">{{ $pageTitle }}</h1>
    @include('../../inc/_messages')

    <!-- Testimonials Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <a href="{{ route('dashboard.testimonials.create') }}" class="btn btn-sm btn-success">+ Add Testimonial</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Participant Name</th>
                            <th>Comment</th>
                            <th>Designation</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->user->name ?? '—' }}</td>
                                <td>{{ Str::limit($item->comment, 50) }}</td>
                                <td>{{ $item->designation }}</td>
                                <td>
                                    <span class="text-white badge bg-{{ $item->status ? 'success' : 'danger' }}">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.testimonials.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                    <form action="{{ route('dashboard.testimonials.destroy', $item->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-warning">No testimonials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
