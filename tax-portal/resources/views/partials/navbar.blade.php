<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3" style="backdrop-filter: blur(8px);">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-black" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 120px; width: 160px;"></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold' : '' }}" href="{{ route('about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services') ? 'active fw-bold' : '' }}" href="{{ route('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('payroll.calculators') ? 'active fw-bold' : '' }}" href="{{ route('payroll.calculators') }}">Payroll Calculators</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tax.calculators') ? 'active fw-bold' : '' }}" href="{{ route('tax.calculators') }}">Tax Calculators</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">More</a>
                    <ul class="dropdown-menu shadow-sm">
                        <li><a class="dropdown-item {{ request()->routeIs('news') ? 'active fw-bold' : '' }}" href="{{ route('news') }}">News</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('downloads') ? 'active fw-bold' : '' }}" href="{{ route('downloads') }}">Downloads</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active fw-bold' : '' }}" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-dark rounded-pill px-4 contact-btn" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('styles')
<style>
/* Navbar link hover effect */
.navbar-nav .nav-link {
    position: relative;
    transition: color 0.3s ease;
}
.navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #000;
    transition: width 0.3s ease;
}
.navbar-nav .nav-link:hover::after,
.navbar-nav .nav-link.active::after {
    width: 100%;
}

/* Dropdown hover shadow */
.navbar-nav .dropdown-menu {
    transition: transform 0.3s ease, opacity 0.3s ease;
}
.navbar-nav .dropdown-menu.show {
    transform: translateY(0);
    opacity: 1;
}

/* Contact button hover */
.contact-btn {
    transition: transform 0.3s ease, background-color 0.3s ease, color 0.3s ease;
}
.contact-btn:hover {
    transform: translateY(-3px);
    background-color: #fff;
    color: #000;
}

/* Add subtle hover effect on navbar */
.navbar-nav .nav-link:hover {
    color: #000;
}
</style>
@endpush
