@extends('layouts.app')

@section('pageContent')
    <div class="py-4">
        <h2 class="mb-4">{{ $pageTitle }}</h2>

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

        {{-- Add enctype for file upload --}}
        <form action="{{ route('dashboard.slider.store') }}" method="POST" enctype="multipart/form-data">

            @include('admin.sliders._form')
        </form>
    </div>
@endsection
