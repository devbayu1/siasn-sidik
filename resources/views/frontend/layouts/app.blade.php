<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="{{ asset('apple-touch-icon.png') }}" rel="apple-touch-icon">


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Perhatikan penulisan 'jsdelivr' yang benar --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">
    @include('frontend.components.header')
    <main class="main">
        @yield('content')
        @include('frontend.components.footer')
    </main>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- Perhatikan penulisan 'jsdelivr' yang benar --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('/frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('/frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('/frontend/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
