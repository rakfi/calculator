@extends('layouts.main')

@section('title', 'Home')

@section('content')

<!-- Hero Slider Section -->
<section class="hero-slider position-relative">
    <!-- Bubbles -->
    <ul class="bubbles">
        @for ($i = 0; $i < 20; $i++)
            <li></li>
        @endfor
    </ul>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach([
                'hero-1.jpg',
                'hero-2.jpg',
                'hero-3.jpg'
            ] as $hero)
            <div class="swiper-slide position-relative" style="background: url('{{ asset('assets/images/'.$hero) }}') center/cover no-repeat; min-height:90vh;">
                <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
                <div class="container d-flex justify-content-center align-items-center h-100 position-relative">
                    <div class="text-center text-white hero-content" data-aos="fade-up">
                        <h1 class="display-3 fw-bold mb-3">Grow Your Business with SIYENRO</h1>
                        <p class="lead mb-4">Professional consulting, tax services, and financial guidance for modern businesses.</p>
                        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill fw-semibold px-5">Get Started</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Swiper Controls -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- About Section -->
<section class="py-5" style="background-color:#fff; color:#000;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <h2 class="fw-bold mb-3">Who We Are</h2>
                <p>SIYENRO combines industry expertise with tailored strategies to help businesses thrive. From taxation to financial planning and strategic consulting, we deliver results-driven solutions.</p>
                <a href="{{ route('about') }}" class="btn btn-outline-dark rounded-pill fw-semibold px-4 mt-3" data-aos="fade-up" data-aos-delay="400">Learn More</a>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-delay="300">
                <img src="{{ asset('assets/images/about-us.jpg') }}" class="img-fluid rounded shadow-sm" alt="About Us">
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5" style="background-color:#f8f8f8;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Our Services</h2>
            <p>Helping you achieve success</p>
        </div>
        <div class="row g-4">
            @foreach([
                ['icon'=>'bi-briefcase','img'=>'service-business.jpg','title'=>'Business Consulting','desc'=>'Customized strategies for market success.'],
                ['icon'=>'bi-currency-dollar','img'=>'service-tax.jpg','title'=>'Tax Planning','desc'=>'Efficient tax solutions that save money.'],
                ['icon'=>'bi-bar-chart','img'=>'service-finance.jpg','title'=>'Financial Advisory','desc'=>'Expert financial planning & advice.']
            ] as $index => $service)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
                <div class="card service-card border-0 shadow-sm hover-animate">
                    <img src="{{ asset('assets/images/'.$service['img']) }}" class="card-img-top rounded" alt="{{ $service['title'] }}">
                    <div class="card-body text-center">
                        <i class="bi {{ $service['icon'] }} fs-1 mb-2 service-icon"></i>
                        <h5 class="fw-bold">{{ $service['title'] }}</h5>
                        <p>{{ $service['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Tax Calculators Section -->
<section class="py-5" style="background-color:#fff;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Tax Calculators</h2>
            <p>Estimate your taxes with ease</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach([
                ['icon'=>'bi-calculator','title'=>'Personal Income Tax','desc'=>'Quick personal tax estimates'],
                ['icon'=>'bi-briefcase','title'=>'Business Tax','desc'=>'Business tax overview in minutes'],
                ['icon'=>'bi-receipt','title'=>'VAT / GST','desc'=>'Value Added Tax / GST calculations']
            ] as $index => $calc)
            <div class="col-md-4" data-aos="flip-left" data-aos-delay="{{ $index * 200 }}">
                <div class="card text-center p-4 border-0 shadow-sm hover-animate" style="background-color:#f8f8f8;">
                    <i class="bi {{ $calc['icon'] }} fs-2 mb-3 service-icon"></i>
                    <h5 class="fw-bold">{{ $calc['title'] }}</h5>
                    <p>{{ $calc['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5" style="background-color:#f8f8f8;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">What Our Clients Say</h2>
            <p>Real stories from businesses we've helped</p>
        </div>
        <div class="swiper-container testimonial-slider">
            <div class="swiper-wrapper">
                @foreach([
                    ['quote'=>'Excellent consulting services. Helped me grow our revenue!', 'name'=>'Anna Williams','img'=>'client1.jpg'],
                    ['quote'=>'Tax advice was spot on. Highly professional team.', 'name'=>'James Carter','img'=>'client2.jpg'],
                    ['quote'=>'Financial planning gave us clarity and direction.', 'name'=>'Sophie Lee','img'=>'client3.jpg']
                ] as $test)
                <div class="swiper-slide">
                    <div class="card text-center p-4 shadow-sm hover-animate">
                        <img src="{{ asset('assets/images/'.$test['img']) }}" class="rounded-circle mb-3" width="80" alt="{{ $test['name'] }}">
                        <p class="fst-italic">“{{ $test['quote'] }}”</p>
                        <h6 class="fw-bold mt-2">{{ $test['name'] }}</h6>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Latest Insights Section -->
<section class="py-5" style="background-color:#fff;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Latest Insights</h2>
            <p>Stay updated with our articles</p>
        </div>
        <div class="row g-4">
            @foreach([
                ['title'=>'Changes in 2026 Tax Law','excerpt'=>'Key tax updates & what they mean for you.'],
                ['title'=>'Scaling Your SME','excerpt'=>'Strategies for sustainable growth.'],
                ['title'=>'Financial Planning Tips','excerpt'=>'Long‑term wealth building advice.']
            ] as $index => $news)
            <div class="col-md-4" data-aos="fade-right" data-aos-delay="{{ $index * 200 }}">
                <div class="card border-0 shadow-sm p-4 hover-animate">
                    <h5 class="fw-bold">{{ $news['title'] }}</h5>
                    <p>{{ $news['excerpt'] }}</p>
                    <a href="#" class="text-dark hover-link">Read More →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 text-center" style="background-color:#000; color:#fff;" data-aos="zoom-in">
    <div class="container">
        <h2 class="fw-bold mb-3">Ready to Elevate Your Business?</h2>
        <p class="lead mb-4">Contact our expert team and start transforming today.</p>
        <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill fw-semibold px-5">Contact Us</a>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Hero overlay */
.hero-slider .overlay {
    background: rgba(0,0,0,0.6);
}

/* Hero content center */
.hero-slider .hero-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    z-index: 2;
    position: relative;
}

/* Bubble animation */
.bubbles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
    pointer-events: none;
}

.bubbles li {
    position: absolute;
    list-style: none;
    display: block;
    width: 20px;
    height: 20px;
    background-color: rgba(255, 255, 255, 0.15);
    bottom: -50px;
    border-radius: 50%;
    animation: bubble 25s infinite;
}

.bubbles li:nth-child(odd) { background-color: rgba(255,255,255,0.2);}
.bubbles li:nth-child(even) { background-color: rgba(255,255,255,0.1);}

.bubbles li:nth-child(1){left:5%; animation-delay:0s; animation-duration:20s;}
.bubbles li:nth-child(2){left:15%; animation-delay:2s; animation-duration:18s;}
.bubbles li:nth-child(3){left:25%; animation-delay:4s; animation-duration:22s;}
.bubbles li:nth-child(4){left:35%; animation-delay:1s; animation-duration:24s;}
.bubbles li:nth-child(5){left:45%; animation-delay:3s; animation-duration:20s;}
.bubbles li:nth-child(6){left:55%; animation-delay:2s; animation-duration:23s;}
.bubbles li:nth-child(7){left:65%; animation-delay:4s; animation-duration:21s;}
.bubbles li:nth-child(8){left:75%; animation-delay:0s; animation-duration:19s;}
.bubbles li:nth-child(9){left:85%; animation-delay:1s; animation-duration:22s;}
.bubbles li:nth-child(10){left:95%; animation-delay:3s; animation-duration:20s;}

@keyframes bubble {
    0% { transform: translateY(0) scale(1); opacity:1;}
    100% { transform: translateY(-1000px) scale(0.5); opacity:0;}
}

/* Card hover animations */
.hover-animate {
    transition: transform 0.5s ease, box-shadow 0.5s ease;
}
.hover-animate:hover {
    transform: translateY(-15px) scale(1.03);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

/* Icon hover */
.service-icon {
    transition: transform 0.5s ease, color 0.5s ease;
}
.service-icon:hover {
    transform: scale(1.3) rotate(15deg);
    color: #000;
}

/* Buttons hover */
.hero-btn, .about-btn, .hover-link {
    transition: transform 0.4s ease, background 0.4s ease, color 0.4s ease;
}
.hero-btn:hover, .about-btn:hover {
    transform: translateY(-5px);
    background-color: #fff;
    color: #000;
}
.hover-link:hover {
    transform: translateX(8px);
    text-decoration: underline;
}
</style>
@endpush

@push('scripts')
<!-- AOS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1200, easing: 'ease-in-out', once: false, mirror: true });
</script>

<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
var heroSwiper = new Swiper('.hero-slider .swiper-container', {
    loop: true,
    autoplay: { delay: 5000 },
    effect: 'fade',
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }
});

var testimonialSwiper = new Swiper('.testimonial-slider', {
    loop: true,
    autoplay: { delay: 6000 },
    slidesPerView: 1,
    spaceBetween: 30,
    pagination: { el: '.swiper-pagination', clickable: true },
    breakpoints: {
      768: { slidesPerView: 2 },
      992: { slidesPerView: 3 }
    }
});
</script>
@endpush
