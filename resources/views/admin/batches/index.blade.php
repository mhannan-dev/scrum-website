@extends('layouts.app')

@section('pageContent')
<div class="container-fluid py-4">
    <h1 class="h3 mb-3 text-gray-800">{{ $pageTitle ?? 'Batch List' }}</h1>

    <!-- Batches Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Batches</h6>
            <a href="{{ route('dashboard.batches.create') }}" class="btn btn-sm btn-success">+ Add Batch</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Batch Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($batches as $index => $batch)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $batch->course->name ?? '—' }}</td>
                                <td>{{ $batch->title }}</td>
                                <td>{{ $batch->start_date ? \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') : '—' }}</td>
                                <td>{{ $batch->end_date ? \Carbon\Carbon::parse($batch->end_date)->format('M d, Y') : '—' }}</td>
                                <td>
                                    <span class="text-white badge bg-{{ $batch->status ? 'success' : 'danger' }}">
                                        {{ $batch->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.batches.edit', $batch->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                    <form action="{{ route('dashboard.batches.destroy', $batch->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Are you sure you want to delete this batch?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-warning">No batches found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
