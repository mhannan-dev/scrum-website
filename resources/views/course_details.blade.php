@extends('layouts.front_layout')

@push('styles')
    <style>
        body {
            padding-top: 120px;
        }

        /* --- Custom Color Overrides for Bootstrap Classes --- */
        .bg-primary {
            background-color: #7a6ad8 !important;
        }

        .text-primary {
            color: #7a6ad8 !important;
        }

        .btn-primary {
            background-color: #7a6ad8;
            border-color: #7a6ad8;
        }

        .btn-primary:hover {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }

        .btn-primary:focus,
        .btn-primary.focus {
            box-shadow: 0 0 0 0.25rem rgba(122, 106, 216, 0.5);
        }

        .btn-primary:active,
        .btn-primary.active,
        .show>.btn-primary.dropdown-toggle {
            background-color: #6c63ff;
            border-color: #6c63ff;
        }

        .btn-outline-primary {
            color: #7a6ad8;
            border-color: #7a6ad8;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #7a6ad8;
            border-color: #7a6ad8;
        }

        .btn-outline-primary:focus,
        .btn-outline-primary.focus {
            box-shadow: 0 0 0 0.25rem rgba(122, 106, 216, 0.5);
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(108, 99, 255, 0.1);
            color: #6c63ff;
        }

        .sticky-top {
            z-index: 1;
        }

        /* Header Styles */
        .header-area {
            position: fixed;
            background-color: #7a6ad8;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 100;
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
            transition: all .5s ease 0s;
        }

        .header-area .main-nav {
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-area .main-nav .company-brand-name {
            display: flex;
            align-items: center;
            width: 100%;
            margin-left: 10px;
        }

        .header-area .main-nav .company-brand-name h3 {
            margin-bottom: 0;
        }
    </style>
@endpush

@section('content')
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('layouts/front_nav')
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
                    <h1 class="fw-bold mb-3">Complete Web Development Bootcamp</h1>
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary me-3">Web Development</span>
                        <span><i class="fas fa-chalkboard-teacher text-primary me-2"></i>Instructor: John Smith</span>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">About Course</h3>
                        <p>This intensive bootcamp will take you from beginner to professional web developer. You'll learn HTML, CSS, JavaScript, React, Node.js, and much more through hands-on projects and exercises.</p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Schedule & Timing</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <strong>Start Date:</strong> June 15, 2023
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <strong>End Date:</strong> August 15, 2023
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-clock text-primary me-2"></i>
                                    <strong>Class Time:</strong> 10:00 AM - 1:00 PM
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-calendar-week text-primary me-2"></i>
                                    <strong>Schedule:</strong> Monday, Wednesday, Friday
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Duration:</strong> 3 months
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-globe text-primary me-2"></i>
                                    <strong>Timezone:</strong> Asia/Dhaka
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
                            <img src="https://via.placeholder.com/400x225" alt="Course Image" class="img-fluid rounded mb-3">

                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <h3 class="text-danger mb-0 me-3">৳12,999</h3>
                                <del class="text-muted">৳15,999</del>
                            </div>

                            <a href="#" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-user-plus me-2"></i> Enroll Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="height: 50px;"></div>
@endsection
