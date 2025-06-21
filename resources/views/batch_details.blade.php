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


        .test {
            color: red;
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
            justify-content: space-between; /* Distributes space between logo, search-input, and nav links */
        }

        .header-area .main-nav .search-input {
            display: flex; /* Enable flexbox for inner alignment */
            align-items: center; /* Vertically center the h3 inside */
            width: 100%;
            margin-left: 10px;
        }

        .header-area .main-nav .search-input h3 {
            margin-bottom: 0; /* Remove default bottom margin from h3 */
        }
    </style>
@endpush

@section('content')
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="http://localhost:8001" class="logo">
                            <img src="http://localhost:8001/frontend/assets/images/logo.png" style="width:90px" alt="">
                        </a>
                        <div class="search-input">
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
                    <h1 class="fw-bold mb-3">Full Stack Web Development - Batch #25</h1>
                    <div class="d-flex align-items-center mb-3">
                        {{-- This badge will now use #7a6ad8 due to .bg-primary override --}}
                        <span class="badge bg-primary me-3">Web Development</span>
                        {{-- This text will now use #7a6ad8 due to .text-primary override --}}
                        <span><i class="fas fa-chalkboard-teacher text-primary me-2"></i>Instructor: John Smith</span>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">About This Batch</h3>
                        <p>This intensive Full Stack Web Development batch will take you from beginner to professional
                            level. You'll learn HTML, CSS, JavaScript, React, Node.js, Express, and MongoDB to build
                            complete web applications.</p>
                        <p>By the end of this batch, you'll have a portfolio of projects and the skills needed to work as a
                            full-stack developer.</p>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Schedule & Timing</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    {{-- These icons will now use #7a6ad8 due to .text-primary override --}}
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <strong>Start Date:</strong> July 15, 2025
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <strong>End Date:</strong> October 7, 2025
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-clock text-primary me-2"></i>
                                    <strong>Class Time:</strong> 7:00 PM - 9:00 PM
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-calendar-week text-primary me-2"></i>
                                    <strong>Schedule:</strong> Mon & Wed
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <strong>Duration:</strong> 12 Weeks
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="fas fa-globe text-primary me-2"></i>
                                    <strong>Timezone:</strong> GMT+6
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
                            <img src="https://via.placeholder.com/300x200" alt="Course Image"
                                class="img-fluid rounded mb-3">

                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <h3 class="text-danger mb-0 me-3">৳15,000</h3>
                                <del class="text-muted">৳18,000</del>
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
                                    <strong>Location:</strong> Online (Zoom)
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <strong>Seats Available:</strong> 12/25
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-language text-primary me-2"></i>
                                    <strong>Language:</strong> English
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-certificate text-primary me-2"></i>
                                    <strong>Certificate:</strong> Yes
                                </li>
                            </ul>
                        </div>

                        <hr>

                        <div class="instructor-info">
                            <h5 class="fw-bold mb-3">Instructor</h5>
                            <div class="d-flex align-items-start">
                                <img src="https://via.placeholder.com/80" alt="Instructor" class="rounded-circle me-3"
                                    width="80">
                                <div>
                                    <h6 class="mb-1">John Smith</h6>
                                    <p class="text-muted small mb-2">Senior Web Developer</p>
                                    <div class="d-flex">
                                        <span class="badge bg-light text-dark me-2 small">
                                            <i class="fas fa-star text-warning"></i> 4.9
                                        </span>
                                        <span class="badge bg-light text-dark small test">
                                            <i class="fas fa-users"></i> 1,200+ students
                                        </span>
                                    </div>
                                </div>
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
