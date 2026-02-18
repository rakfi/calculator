<footer class="footer py-5" style="background-color:#000; color:#fff;">
    <div class="container">
        <div class="row gy-4">
            <!-- Logo & About -->
            <div class="col-md-4" data-aos="fade-up">
                <h5 class="fw-bold mb-3">SIYENRO</h5>
                <p>Professional consulting, tax services, and financial guidance for modern businesses.</p>
                <div class="social-icons mt-3">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram fs-5"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <h5 class="fw-bold mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-white footer-link">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-white footer-link">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="text-white footer-link">Services</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white footer-link">Contact</a></li>
                    <li><a href="{{ route('news') }}" class="text-white footer-link">News</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <h5 class="fw-bold mb-3">Contact</h5>
                <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i>123 Business St, City, Country</p>
                <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i>+123 456 7890</p>
                <p class="mb-1"><i class="bi bi-envelope-fill me-2"></i>info@siyenro.com</p>
            </div>
        </div>

        <hr class="mt-4" style="border-color: rgba(255,255,255,0.1);">

        <div class="text-center mt-3">
            <p class="mb-0">&copy; {{ date('Y') }} SIYENRO. All Rights Reserved.</p>
        </div>
    </div>
</footer>

@push('styles')
<style>
.footer a.footer-link {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s, transform 0.3s;
}
.footer a.footer-link:hover {
    color: #0d6efd;
    transform: translateX(5px);
    text-decoration: none;
}
.footer .social-icons a {
    transition: color 0.3s, transform 0.3s;
}
.footer .social-icons a:hover {
    color: #0d6efd;
    transform: scale(1.2);
}
</style>
@endpush
