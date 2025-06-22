@extends('layouts.front_layout')
@section('content')
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
                                    <a href="{{ route('upcoming.batch.details', $item->slug) }}"><i class="fa fa-angle-right"></i></a>
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
                                <a href="{{ route('course.details', $category->slug) }}">
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

@endsection
