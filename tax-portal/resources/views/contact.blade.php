@extends('layouts.main')

@section('title', 'Contact Us')

@section('content')

<!-- Contact Hero -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Get In Touch</h1>
        <p class="hero-subtitle">We are ready to assist you. Reach out to CONSULT for professional support.</p>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Contact Us</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" placeholder="Subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Your message" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark px-5">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
