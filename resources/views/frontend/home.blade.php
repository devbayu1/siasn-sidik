@extends('frontend.layouts.app')
@section('title', 'Halaman Utama')
@section('content')

    <!-- Hero Section -->
    <section id="home" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">

                    <h1 class="hero-title mb-4">Sistem Aplikasi Pengembangan Kompetensi (APKOM)</h1>

                    <p class="hero-description mb-4">Selamat datang di Website Sistem Aplikasi Pengembangan Kompetensi Badan Pendidikan dan Pelatihan Kabupaten Pacitan</p>

                    {{-- Hapus button dan ganti dengan wrapper untuk logo --}}
                    <div class="cta-wrapper d-flex align-items-center">

                        {{-- Logo pertama --}}
                        <img src="{{ asset('frontend/assets/img/logo_bm.png') }}" alt="Logo Bangga Melayani Bangsa"
                            style="height: 45px;" class="me-4">

                        {{-- Logo kedua --}}
                        <img src="{{ asset('frontend/assets/img/logo_berakhlak.png') }}" alt="Logo BerAKHLAK"
                            style="height: 45px;">

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="frontend/assets/img/illustration/illustration-16.webp" alt="Business Growth"
                            class="img-fluid" loading="lazy">
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Hero Section -->

    <!-- Services Section -->
    <section id="about" class="services section">

        <!-- TENTANG APKOM -->
        <div class="container section-title" data-aos="fade-up">
            <h2>TENTANG APKOM</h2>
            <p>{!! setting('tentang') ?? '' !!}</p>
        </div>
        <!-- End TENTANG APKOM -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center g-5">

                @if (count($abouts) > 0)
                    @foreach ($abouts as $item)
                        <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="bi {{$item->icon}}"></i>
                                </div>
                                <div class="service-content">
                                    <h3>{{$item->title}}</h3>
                                    <p>{{ $item->description }}</p>
                                </div>
                            </div>
                        </div><!-- End Service Item -->
                    @endforeach

                @endif


            </div>

        </div>

    </section><!-- /Services Section -->


    <!-- Jalur Pendidikan -->
    <section id="jenis-pengembangan-kompetensi" class="about section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>JENIS PENGEMBANGAN KOMPETENSI</h2>
        </div>
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-12 content" data-aos="fade-up" data-aos-delay="100">
                    <p>
                        {!! $pages->content !!}
                    </p>
                </div>

            </div>

        </div>
    </section>
    <!-- /Jalur Pendidikan -->


    <!-- Tabel Konversi Section -->
    <section id="tabel-konversi" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tabel Konversi</h2>
            <p>{!! setting('tabel-konversi') ?? '' !!}</p>
            <div class="text-center">
                Download <a href="{{ asset('storage/' . $tableConversion->file_path) }}" target="_blank">Disini</a>
            </div>
        </div><!-- End Section Title -->

    </section>
    <!-- /Tabel Konversi Section -->


    <!-- Faq PANDUAN -->
    <section id="faq" class="faq section  light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>PANDUAN</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-5">

                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="faq-accordion">
                        @if (count($faqs) > 0)
                            @foreach ($faqs as $item)
                                <div class="faq-item">
                                    <div class="faq-header">
                                        <h3>{{ $item->question }}</h3>
                                        <i class="bi bi-chevron-down faq-toggle"></i>
                                    </div>
                                    <div class="faq-content">
                                        <p>
                                            {!! $item->answer !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        @endif

                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /Faq PANDUAN -->


@endsection
