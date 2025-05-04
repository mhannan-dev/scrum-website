@extends('layouts.app')

@section('pageContent')
<div class="container-fluid py-4">
    <h1 class="h3 mb-3 text-gray-800">{{ $pageTitle }}</h1>
    @include('../../inc/_messages')
    <!-- Categories Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            <a href="{{ route('dashboard.trainers.create') }}" class="btn btn-sm btn-success">+ Add Trainer</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trainers as $index => $trainer)

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $trainer->image) }}" alt="Photo" width="80;">


                                </td>
                                <td>{{ $trainer->name }}</td>
                                <td>{{ $trainer->category['title'] ?? '—' }}</td>
                                <td>
                                    <span class="text-white badge bg-{{ $trainer->status ? 'success' : 'danger' }}">
                                        {{ $trainer->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.trainers.edit', $trainer->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                    <form action="{{ route('dashboard.trainers.destroy', $trainer->id) }}"
                                          method="POST" style="display:inline-block;"
                                          onsubmit="return confirm('Are you sure you want to delete this trainer?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-warning">No trainers found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
