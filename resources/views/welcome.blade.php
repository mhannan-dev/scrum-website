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
        /* Success */
        #toast-container>.toast-success {
            background-color: #8519e3 !important;
            /* Green */
            color: white;
        }

        /* Error */
        #toast-container>.toast-error {
            background-color: #dc3545 !important;
            /* Red */
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
    </style>

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
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="" class="logo">
                            <!-- <h1>Global Experts</h1> -->
                            <img src="{{ asset('frontend/assets/images/logo.png') }}" style="width:90px" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Serach Start ***** -->
                        <div class="search-input" style="width:100%; margin-top:25px;margin-left:10px;">
                        <h3 style="color: #fff;">Global Experts Ltd.</h3>
                            <!-- <form id="search" action="#">
                                <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword"
                                    onkeypress="handle" />
                                <i class="fa fa-search"></i>
                            </form> -->
                        </div>
                        <!-- ***** Serach Start ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <!--  <li class="scroll-to-section"><a href="#services">Services</a></li> -->
                            <li class="scroll-to-section"><a href="#courses">Courses</a></li>
                            <li class="scroll-to-section"><a href="#team">Team</a></li>
                            <li class="scroll-to-section"><a href="#events">Batch</a></li>
                            <li class="scroll-to-section"><a href="#contact">Register Now!</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-banner">

                        @foreach ($sliders as $slider)
                        <div class="item" style="background-image:  url({{ $slider->image ? asset('storage/' . $slider->image) : asset('frontend/assets/images/banner-item-02.jpg') }})">
                            <div class="header-text">
                                @if($slider->top_button_text)
                                <span class="category">{{ $slider->top_button_text }}</span>
                                @endif
                                <h2>{{ $slider->title }}</h2>
                                <p style="margin: 0 auto;">{!! $slider->description !!}</p>
                                @if($slider->main_button_text)
                                <div class="buttons">
                                    <div class="main-button">
                                        <a href="{{ $slider->main_button_link }}">{{ $slider->main_button_text }}</a>
                                    </div>
                            
                                </div>
                                @endif
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section events" id="events">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>Enroll Now</h6>
                        <h2>Upcoming Certification Trainings</h2>
                    </div>
                </div>

                @forelse ($upcomingBatches as $item)
                    <div class="col-lg-12 col-md-6">
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="image">
                                        <img src="{{ $item->course->image ? url('storage/' . $item->course->image) : asset('frontend/assets/images/profile_blank.png') }}"
                                            alt="">
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <ul>
                                        <li>
                                            <span class="category">{{ $item->course->category->title ?? '—' }}</span>
                                            <h4>{{ $item->title }}</h4>
                                        </li>
                                        <li>
                                            <span>Start Date:</span>
                                            <h6>{{ \Carbon\Carbon::parse($item->start_date)->format('d F Y') }}
                                            </h6>
                                        </li>
                                        <li>
                                            <span>Duration:</span>
                                            <h6>{{ $item->duration ?? '—' }}</h6>
                                        </li>
                                        <li>
                                            <span>Price:</span>
                                            <h6>৳{{ number_format($item->discounted_price > 0?  $item->discounted_price : $item->price, 2) }}
                                            </h6>
                                        </li>
                                    </ul>
                                    <a href="#"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>No upcoming batches found at the moment.</p>
                    </div>
                @endforelse


            </div>
        </div>
    </div>

    {{-- <div class="services section" id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="icon">
                            <img src="assets/images/service-01.png" alt="online degrees">
                        </div>
                        <div class="main-content">
                            <h4>Online Degrees</h4>
                            <p>Whenever you need free templates in HTML CSS, you just remember TemplateMo website.</p>
                            <div class="main-button">
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="icon">
                            <img src="assets/images/service-02.png" alt="short courses">
                        </div>
                        <div class="main-content">
                            <h4>Short Courses</h4>
                            <p>You can browse free templates based on different tags such as digital marketing, etc.</p>
                            <div class="main-button">
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="icon">
                            <img src="assets/images/service-03.png" alt="web experts">
                        </div>
                        <div class="main-content">
                            <h4>Web Experts</h4>
                            <p>You can start learning HTML CSS by modifying free templates from our website too.</p>
                            <div class="main-button">
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="section about-us">
        @include("partials.about_us")
    </div>

    <section class="section courses" id="courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>Latest Courses</h6>
                        <h2>Popular Courses</h2>
                    </div>
                </div>
            </div>

        
            <ul class="event_filter">
                <li><a class="is_active" href="#!" data-filter="*">Show All</a></li>
                @foreach ($categories as $category)
                    <li>
                        <a href="#!" data-filter=".{{ Str::slug($category->title) }}">
                            {{ $category->title }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="row event_box">
                @foreach ($courses as $course)
                    <div
                        class="col-lg-4 col-md-6 align-self-center mb-30 event_outer {{ Str::slug($course->category->title) }}">
                        <div class="events_item">
                            <div class="thumb">
                                <a href="#">
                                    <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->name }}">

                                </a>
                                <span class="category">{{ $course->category->title }}</span>
                                <!-- <span class="price">
                                    <h6><em>Tk</em>{{ $course->price ?? '--' }}</h6>
                                </span> -->
                            </div>
                            <div class="down-content">
                                <span class="author">{{ $course->trainer->name ?? 'Unknown' }}</span>
                                <h4>{{ $course->name }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="section fun-facts">
        @include("partials.happy_section")
    </div>
    @if (!empty($trainers))
        <div class="team section" id="team">
            @include("partials.trainers_section")
        </div>
    @endif

    @if (!empty($testimonials))
        <div class="section testimonials">
        @include("partials.testimonials")
        </div>
    @endif
    

    <div class="contact-us section" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6  align-self-center">
                    <div class="section-heading">
                        <h6>Contact Us</h6>
                        <h2>Feel free to contact us anytime</h2>
                        <p><strong>info@globalexpertsltd.com</strong></p>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-us-content">
                        <form id="contact-form" action="{{ url('registration-message') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="name" name="name" id="name"
                                            placeholder="Your Name..." autocomplete="on" required>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                            placeholder="Your E-mail..." required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" id="message" placeholder="Your Message"></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="orange-button">Send
                                            Message
                                            Now</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
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
