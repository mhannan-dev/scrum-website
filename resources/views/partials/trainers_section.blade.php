<div class="container">
    <div class="row">
        @foreach ($trainers as $trainer)
            <div class="col-lg-3 col-md-6">
                <div class="team-member">
                    <div class="main-content">
                        <img src="{{ $trainer->image ? url('storage/' . $trainer->image) : asset('frontend/assets/images/profile_blank.png') }}"
                            alt="{{ $trainer->name }}"
                            style="width: 100%; height: auto; object-fit: cover;">

                        <span class="category">{{ $trainer->category->title ?? 'No Category' }}</span>
                        <h4>{{ $trainer->name ?? '' }}</h4>

                        @php
                            $links = is_array($trainer->social_links)
                                ? $trainer->social_links
                                : json_decode($trainer->social_links, true);
                        @endphp

                        @if (!empty($links))
                            <ul class="social-icons">
                                @foreach ($links as $platform => $url)
                                    <li>
                                        <a href="{{ $url }}" target="_blank">
                                            <i class="fab fa-{{ strtolower($platform) }}"></i>
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