You're looking to display a `discounted_price` in addition to the `price` and `original_price`. I've updated the pricing section in the provided code to show the `discounted_price`.

-----

```html
@extends('layouts.front_layout')

@push('styles')
    <style>
        body {
            /* This padding-top will push the content down, clearing the fixed header.
               Adjust this value based on the final height of your fixed header.
               The .background-header has a height of 120px.
            */
            padding-top: 120px; /* Adjust this value as needed to clear your header */
        }

        /* --- Custom Color Overrides for Bootstrap Classes --- */
        /* Background Primary */
        .bg-primary {
            background-color: #7a6ad8 !important; /* Your custom color */
        }

        /* Text Primary */
        .text-primary {
            color: #7a6ad8 !important; /* Your custom color */
        }

        /* Button Primary */
        .btn-primary {
            background-color: #7a6ad8; /* Your custom color */
            border-color: #7a6ad8; /* Border matches background */
        }

        .btn-primary:hover {
            background-color: #6c63ff; /* Slightly darker/different shade for hover */
            border-color: #6c63ff;
        }

        .btn-primary:focus, .btn-primary.focus {
            box-shadow: 0 0 0 0.25rem rgba(122, 106, 216, 0.5); /* Custom focus ring color */
        }

        .btn-primary:active, .btn-primary.active,
        .show > .btn-primary.dropdown-toggle {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }


        /* Button Outline Primary */
        .btn-outline-primary {
            color: #7a6ad8; /* Text color */
            border-color: #7a6ad8; /* Border color */
        }

        .btn-outline-primary:hover {
            color: #fff; /* Text color on hover */
            background-color: #7a6ad8; /* Background on hover */
            border-color: #7a6ad8; /* Border on hover */
        }

        .btn-outline-primary:focus, .btn-outline-primary.focus {
            box-shadow: 0 0 0 0.25rem rgba(122, 106, 216, 0.5); /* Custom focus ring color */
        }
        /* --- End Custom Color Overrides --- */

        .accordion-button:not(.collapsed) {
            background-color: rgba(108, 99, 255, 0.1);
            color: #6c63ff;
        }

        .sticky-top {
            z-index: 1;
        }

        /* Header Styles */
        .header-area {
            position: fixed; /* Changed from absolute to fixed */
            background-color: #7a6ad8;
            top: 0; /* Changed from 40px to 0 to remove space above */
            left: 0;
            right: 0;
            width: 100%; /* Ensure it spans the full width */
            z-index: 100;
            -webkit-transition: all .5s ease 0s;
            -moz-transition: all .5s ease 0s;
            -o-transition: all .5s ease 0s;
            transition: all .5s ease 0s;
        }

        .background-header {
            background-color: #7a6ad8 !important;
            border-radius: 0px 0px 25px 25px;
            height: 120px !important;
            position: fixed !important;
            top: 0 !important;
            left: 0;
            right: 0;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.15) !important;
            -webkit-transition: all .5s ease 0s;
            -moz-transition: all .5s ease 0s;
            -o-transition: all .5s ease 0s;
            transition: all .5s ease 0s;
        }

        .header-area .main-nav {
            background: transparent;
            display: flex;
            align-items: center; /* Vertically centers items in the nav */
            justify-content: space-between; /* Distributes space between logo, company-brand-name, and nav links */
        }

        /* Updated class name for clarity */
        .header-area .main-nav .company-brand-name {
            display: flex; /* Enable flexbox for inner alignment */
            align-items: center; /* Vertically center the h3 inside */
            width: 100%;
            margin-left: 10px;
        }

        .header-area .main-nav .company-brand-name h3 {
            margin-bottom: 0; /* Remove default bottom margin from h3 */
        }
    </style>
@endpush

@section('content')
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav py-4">
                        <a href="http://localhost:8001" class="logo">
                            <img src="http://localhost:8001/frontend/assets/images/logo.png" style="width:90px" alt="">
                        </a>
                        {{-- Changed class name from search-input to company-brand-name for better semantics --}}
                        <div class="company-brand-name">
                            <h3 style="color: #fff;">Global Experts Ltd.</h3>
                        </div>
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#courses">Courses</a></li>
                            <li class="scroll-to-section"><a href="#team">Team</a></li>
                            <li class="scroll-to-section"><a href="#events">Batch</a></li>
                            <li class="scroll-to-section"><a href="#contact">Register Now!</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Courses</a></li>
                <li class="breadcrumb-item"><a href="#">Web Development</a></li>
                <li class="breadcrumb-item active" aria-current="page">Batch Details</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h1 class="fw-bold mb-3">{{ $batch->title ?? "" }}</h1>
                    <div class="d-flex align-items-center mb-3">
                        {{-- This badge will now use #7a6ad8 due to .bg-primary override --}}
                        <span class="badge bg-primary me-3">{{ $batch->course->name ?? 'N/A' }}</span>
                        {{-- This text will now use #7a6ad8 due to .text-primary override --}}
                        <span><i class="fas fa-chalkboard-teacher text-primary me-2"></i>Instructor: {{ $batch->trainer->name ?? "N/A" }}</span>
                    </div>
                </div>

                {{-- Uncommented and added dynamic content for About This Batch --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">About This Batch</h3>
                        <p>{{ $batch->description ?? 'No description available for this batch. This intensive batch will provide comprehensive training in relevant skills and technologies.' }}</p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Schedule & Timing</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($batch->start_date)->format('F j, Y') ?? 'N/A' }}

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <strong>End Date:</strong> {{ \Carbon\Carbon::parse($batch->end_date)->format('F j, Y') ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-clock text-primary me-2"></i>
                                    <strong>Class Time:</strong> {{ $batch->start_time ?? 'N/A' }} - {{ $batch->end_time ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-calendar-week text-primary me-2"></i>
                                    <strong>Schedule:</strong> {{ $batch->schedule ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Duration:</strong> {{ $batch->duration ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-globe text-primary me-2"></i>
                                    <strong>Timezone:</strong> {{ $batch->timezone ?? 'Asia/Dhaka' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 120px;">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            {{-- Dynamic course image --}}
                            <img src="{{ $batch->course->image_url ?? 'https://via.placeholder.com/300x200?text=Course+Image' }}" alt="Course Image"
                                class="img-fluid rounded mb-3">

                            <div class="d-flex justify-content-center align-items-center mb-3">
                                {{-- Display discounted_price if available and different from the regular price --}}
                                @if(isset($batch->discounted_price) && $batch->discounted_price < ($batch->price ?? 0))
                                    <h3 class="text-danger mb-0 me-3">৳{{ number_format($batch->discounted_price, 0) }}</h3>
                                    <del class="text-muted">৳{{ number_format($batch->price ?? 0, 0) }}</del>
                                @else
                                    {{-- If no discounted_price, or if it's not actually a discount, just show the regular price --}}
                                    <h3 class="text-danger mb-0 me-3">৳{{ number_format($batch->price ?? 0, 0) }}</h3>
                                    @if(isset($batch->original_price) && $batch->original_price > ($batch->price ?? 0))
                                        <del class="text-muted">৳{{ number_format($batch->original_price, 0) }}</del>
                                    @endif
                                @endif
                            </div>

                            {{-- This button will now use #7a6ad8 due to .btn-primary override --}}
                            <a href="#" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-user-plus me-2"></i> Enroll Now
                            </a>

                        </div>

                        <hr>

                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Batch Information</h5>
                            <ul class="list-unstyled">
                                {{-- These icons will now use #7a6ad8 due to .text-primary override --}}
                                <li class="mb-2">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <strong>Location:</strong> {{ $batch->location ?? 'Online (Zoom)' }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong>Seats Available:</strong> {{ $batch->enrolled_students ?? 0 }}/{{ $batch->max_students ?? 'N/A' }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-language text-primary me-2"></i>
                                    <strong>Language:</strong> {{ $batch->language ?? 'English' }}
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-certificate text-primary me-2"></i>
                                    <strong>Certificate:</strong> {{ $batch->certificate_included ? 'Yes' : 'No' }}
                                </li>
                            </ul>
                        </div>

                        {{-- <hr>

                        <div class="instructor-info">
                            <h5 class="fw-bold mb-3">Instructor</h5>
                            <div class="d-flex align-items-start">

                                <img src="{{ $batch->trainer->image_url ?? 'https://via.placeholder.com/80?text=Trainer' }}" alt="Instructor" class="rounded-circle me-3"
                                    width="80">
                                <div>
                                    <h6 class="mb-1">{{ $batch->trainer->name ?? 'N/A' }}</h6>
                                    <p class="text-muted small mb-2">{{ $batch->trainer->title ?? 'Instructor' }}</p>
                                    <div class="d-flex">
                                        <span class="badge bg-light text-dark me-2 small">
                                            <i class="fas fa-star text-warning"></i> {{ number_format($batch->trainer->rating ?? 0, 1) }}
                                        </span>
                                        <span class="badge bg-light text-dark small">
                                            <i class="fas fa-users"></i> {{ number_format($batch->trainer->total_students ?? 0, 0) }}+ students
                                        </span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add some space at the bottom before the footer --}}
    <div style="height: 50px;"></div>
@endsection
```
