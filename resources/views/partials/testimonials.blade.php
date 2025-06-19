<div class="container">
  <div class="row">
      <div class="col-lg-7">
          <div class="owl-carousel owl-testimonials">

              @foreach ($testimonials as $item)
                  <div class="item">
                      <p>{{ $item->comment }}</p>
                      <div class="author">
                          <img src="{{ asset('frontend/assets/images/testimonial-author.jpg') }}"
                              alt="">
                          <span class="category">{{ $item->designation ?? '' }}</span>
                          <h4>{{ $item->user->name ?? '' }}</h4>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
      <div class="col-lg-5 align-self-center">
          <div class="section-heading">
              <h6>TESTIMONIALS</h6>
              <h2>What they say about us?</h2>
              <p>At <strong>Global Experts Ltd.</strong>, our success is measured by the
                  achievements of
                  our
                  trainees. Here’s what professionals who have trained with us have to say.</p>
          </div>
      </div>
  </div>
</div>