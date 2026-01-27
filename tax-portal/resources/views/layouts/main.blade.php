<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','CONSULT')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts: Poppins for headings, Roboto for body -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS Animate on Scroll CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom Black & White Theme -->
    <link rel="stylesheet" href="{{ asset('css/bw.css') }}">

    <style>
        /* Global font settings */
        body {
            font-family: 'Roboto', sans-serif;
            color: #000;
            background-color: #fff;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        /* Hero section text */
        .hero-title { font-family: 'Poppins', sans-serif; font-weight: 700; }
        .hero-subtitle { font-family: 'Roboto', sans-serif; font-weight: 400; }

        /* Buttons and links */
        .btn, .hover-link {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: transform 0.3s ease, background 0.3s ease, color 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-3px);
            background-color: #fff;
            color: #000;
        }
        .hover-link:hover {
            transform: translateX(5px);
            text-decoration: underline;
        }

        /* Card hover effect */
        .hover-animate {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        .hover-animate:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        /* Icon hover animation */
        .service-icon {
            transition: transform 0.4s ease, color 0.4s ease;
        }
        .service-icon:hover {
            transform: scale(1.2) rotate(10deg);
            color: #333;
        }
    </style>

    @stack('styles')
</head>
<body>

@include('partials.navbar')

@yield('content')

@include('partials.footer')

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animate on Scroll JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,     // animation duration
    easing: 'ease-in-out', 
    once: false,        // animate every time you scroll
    mirror: true        // animate out elements when scrolling past
  });
</script>

@stack('scripts')
</body>
</html>
