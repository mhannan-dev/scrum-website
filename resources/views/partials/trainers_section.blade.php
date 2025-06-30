<div class="container">
    <div class="row">
        @foreach ($trainers as $trainer)
            <div class="col-lg-3 col-md-6">
                <div class="team-member">
                    <div class="main-content">
                        <img src="{{ $trainer->image ? url('storage/' . $trainer->image) : asset('frontend/assets/images/profile_blank.png') }}"
                            alt="{{ $trainer->name }}" style="width: 100%; height: auto; object-fit: cover;">

                        <span class="category">{{ $trainer->category->title ?? 'No Category' }}</span>
                        <h4>{{ $trainer->name ?? '' }}</h4>


                        @if (!empty($trainer->social_links))
                            <ul class="social-icons">
                                @foreach ($trainer->social_links as $social)
                                    <li>
                                        <a href="{{ $social->link }}" target="_blank">
                                            @if ($social->social_name == 'Facebook')
                                                <i class="fab fa-facebook"></i>
                                            @endif

                                            @if ($social->social_name == 'Youtube')
                                                <i class="fab fa-youtube"></i>
                                            @endif

                                            @if ($social->social_name == 'Twitter')
                                                <i class="fab fa-twitter"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
