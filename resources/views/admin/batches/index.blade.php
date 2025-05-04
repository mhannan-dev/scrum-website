@extends('layouts.app')

@section('pageContent')
<div class="container-fluid py-4">
    <h1 class="h3 mb-3 text-gray-800">{{ $pageTitle }}</h1>
    <!-- Categories Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-success">+ Add Category</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Parent</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($batches as $index => $batch)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->parent?->title ?? '—' }}</td>
                                <td>{{ $category->title }}</td>
                                <td>
                                    <span class="text-white badge bg-{{ $category->status ? 'success' : 'danger' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                    <form action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                        method="POST" style="display:inline-block;"
                                        onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-warning">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
