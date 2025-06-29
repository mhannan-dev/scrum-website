<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Global Experts - IT Enable Training for All.</title>

    <!-- In your <head> section -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('frontend') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/templatemo-scholar.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/owl.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <style>
        #toast-container>.toast-success {
            background-color: #8519e3 !important;
            color: white;
        }

        #toast-container>.toast-error {
            background-color: #dc3545 !important;

            color: white;
        }

        /* Info */
        #toast-container>.toast-info {
            background-color: #17a2b8 !important;
            /* Teal */
            color: white;
        }

        /* Warning */
        #toast-container>.toast-warning {
            background-color: #ffc107 !important;
            /* Yellow */
            color: black;
        }

       /* Header Styles */
        .header-area {
            position: fixed;
            /* Changed from absolute to fixed */
            background-color: #7a6ad8;
            top: 0;
            /* Changed from 40px to 0 to remove space above */
            left: 0;
            right: 0;
            width: 100%;
            /* Ensure it spans the full width */
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
            align-items: center;
            /* Vertically centers items in the nav */
            justify-content: space-between;
            /* Distributes space between logo, company-brand-name, and nav links */
        }

        /* Updated class name for clarity */
        .header-area .main-nav .company-brand-name {
            display: flex;
            /* Enable flexbox for inner alignment */
            align-items: center;
            /* Vertically center the h3 inside */
            width: 100%;
            margin-left: 10px;
        }

        .header-area .main-nav .company-brand-name h3 {
            margin-bottom: 0;
            /* Remove default bottom margin from h3 */
        }
    </style>
    @stack('styles')

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('layouts.front_nav')
                </div>
            </div>
        </div>
    </header>
    <div class="container" style="margin-top: 10rem !important;">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url("/") }}">Courses</a></li>
                <li class="breadcrumb-item active" aria-current="page">Batch Details</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h1 class="fw-bold mb-3">{{ $batch->title ?? '' }}</h1>
                    <div class="d-flex align-items-center mb-3">
                        {{-- This badge will now use #7a6ad8 due to .bg-primary override --}}
                        <span class="badge bg-primary me-3">{{ $batch->course->name ?? 'N/A' }}</span>
                        {{-- This text will now use #7a6ad8 due to .text-primary override --}}
                        <span><i class="fas fa-chalkboard-teacher text-primary me-2"></i>Instructor:
                            {{ $batch->trainer->name ?? 'N/A' }}</span>
                    </div>
                </div>
                @if (!@empty($batch->course->description))
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="card-title mb-3">About Course</h3>
                            <p>{!! $batch->course->description !!}
                            </p>
                        </div>
                    </div>
                @endif

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h3 class="card-title mb-3">Schedule & Timing</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <strong>Start Date:</strong>
                                    {{ \Carbon\Carbon::parse($batch->start_date)->format('F j, Y') ?? 'N/A' }}

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>
                                    <strong>End Date:</strong>
                                    {{ \Carbon\Carbon::parse($batch->end_date)->format('F j, Y') ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-3 bg-light rounded">
                                    <i class="far fa-clock text-primary me-2"></i>
                                    <strong>Class Time:</strong> {{ $batch->start_time ?? 'N/A' }} -
                                    {{ $batch->end_time ?? 'N/A' }}
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


                            @if ($batch->course->image && file_exists(public_path('storage/' . $batch->course->image)))
                                <img src="{{ asset('storage/' . $batch->course->image) }}"
                                    alt="{{ $batch->course->name }}" class="img-fluid rounded mb-3">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif


                            <div class="d-flex justify-content-center align-items-center mb-3">
    @if (!empty($batch->discounted_price) && $batch->discounted_price > 0)
        {{-- Show discounted price --}}
        <h3 class="text-danger mb-0 me-3">
            ৳{{ number_format($batch->discounted_price, 0) }}
        </h3>
        @if (!empty($batch->price) && $batch->price > $batch->discounted_price)
            <del class="text-muted">৳{{ number_format($batch->price, 0) }}</del>
        @endif
    @else
        {{-- Show original price only --}}
        <h3 class="text-danger mb-0 me-3">
            ৳{{ number_format($batch->price ?? 0, 0) }}
        </h3>
    @endif
</div>


                            {{-- This button will now use #7a6ad8 due to .btn-primary override --}}
                            <a href="#" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-user-plus me-2"></i> Enroll Now
                            </a>

                        </div>



                        <div class="mb-4">
                            {{-- <h5 class="fw-bold mb-3">Course Details</h5> --}}
                            <p>{!! $batch->course->short_description !!}</p>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="col-lg-12">
                <p>Copyright © 2025 Global Experts Ltd.</p>
            </div>
        </div>
    </footer>
    <!-- Before closing </body> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('frontend') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/isotope.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/owl-carousel.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/counter.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/custom.js"></script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>
</body>

</html>
