<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

        <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            {{--            <img src="frontend/assets/img/apkom.png" alt=""> --}}
            <h1 class="sitename">APKOM</h1><span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home') }}#home" class="active">Home</a></li>
                <li><a href="{{ route('home') }}#about">Tentang APKOM</a></li>
                <li><a href="{{ route('home') }}#jenis-pengembangan-kompetensi">Jenis Pengembangan Kompetensi</a></li>
                <li><a href="{{ route('home') }}#tabel-konversi">Tabel Konversi</a></li>
                <li><a href="{{ route('home') }}#faq">Panduan</a></li>
                <li><a href="{{ route('training') }}">Form Diklat</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
