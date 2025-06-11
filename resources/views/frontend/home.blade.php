{{-- Menggunakan layout utama dari resources/views/layouts/app.blade.php --}}
@extends('frontend.layouts.app')

{{-- Mengisi judul halaman (opsional, sesuai @yield('title') di layout) --}}
@section('title', 'Halaman Utama')

{{-- Mengisi konten utama halaman --}}
@section('content')


    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">

                    <h1 class="hero-title mb-4">Sistem Aplikasi Pengembangan Kompetensi (APKOM)</h1>

                    <p class="hero-description mb-4">Selamat datang di Website Sistem Aplikasi Pengembangan Kompetensi (APKOM) Badan Kepegawaian dan Pengembangan Sumber Daya Manusia.</p>

                    {{-- Hapus button dan ganti dengan wrapper untuk logo --}}
                    <div class="cta-wrapper d-flex align-items-center">

                        {{-- Logo pertama --}}
                        <img src="{{ asset('frontend/assets/img/logo_bm.png') }}" alt="Logo Bangga Melayani Bangsa" style="height: 45px;" class="me-4">

                        {{-- Logo kedua --}}
                        <img src="{{ asset('frontend/assets/img/logo_berakhlak.png') }}" alt="Logo BerAKHLAK" style="height: 45px;">

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="frontend/assets/img/illustration/illustration-16.webp" alt="Business Growth" class="img-fluid" loading="lazy">
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
            <p>APKOM adalah platform digital terpusat yang dirancang khusus untuk mengelola, memonitor, dan menganalisis seluruh riwayat pengembangan kompetensi bagi para pegawai di lingkungan Pemerintahan Kabupaten Pacitan</p>
        </div>
        <!-- End TENTANG APKOM -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center g-5">

                <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <div class="service-content">
                            <h3>Data Riwayat Pengembangan Kompetensi</h3>
                            <p>Sebagai upaya pemenuhan hak pengembangan kompetensi 20 JP serta pemenuhan pengukuran Indek Profesionalitas ASN</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-left" data-aos-delay="100">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-phone-fill"></i>
                        </div>
                        <div class="service-content">
                            <h3>Terintegrasi dengan SIASN</h3>
                            <p>Data Riwayat Pengembangan Kompetensi akan terintegrasi dengan data SIASN.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-palette2"></i>
                        </div>
                        <div class="service-content">
                            <h3>Monitoring Pencapaian Pengembangan Kompetensi</h3>
                            <p>Sebagai upaya memenuhi hak pengembangan kompetensi 20 JP bagi ASN Kabupaten Pacitan</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-bar-chart-line"></i>
                        </div>
                        <div class="service-content">
                            <h3>Dukungan Keputusan Strategis</h3>
                            <p>Menyediakan data yang valid dan terstruktur untuk mendukung pengambilan keputusan strategis dalam manajemen SDM.</p>
                        </div>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Services Section -->


    <!-- Jalur Pendidikan -->
    <section id="services" class="about section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>JENIS PENGEMBANGAN KOMPETENSI</h2>
        </div>
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-12 content" data-aos="fade-up" data-aos-delay="100">
                    <h4>Jalur Pendidikan</h4>
                    <p class="fst-italic">
                        Dilakukan dengan pemberian tugas belajar pada pendidikan formal dalam jenjang pendidikan tinggi sesuai dengan ketentuan peraturan perundangundangan.
                    </p>
                    <h4>Jalur Pelatihan</h4>
                    <p class="fst-italic">
                        dilakukan melalui kegiatan yang menekankan pada proses pembelajaran tatap muka di dalam kelas (pelatihan klasikal) dan pembelajaran praktik kerja dan/atau pembelajaran di luar kelas (pelatihan nonklasikal).
                    </p>
                    <ul>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Pelatihan Struktural Kepemimpinan</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Program peningkatan pengetahuan, keterampilan, dan sikap perilaku PNS untuk memenuhi Kompetensi kepemimpinan melalui proses pembelajaran secara intensif.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Pelatihan Manajerial</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Program peningkatan pengetahuan peningkatan pengetahuan, keterampilan dan sikap perilaku PNS untuk memenuhi Kompetensi teknis manajerial bidang kerja melalui proses pembelajaran secara intensif.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Pelatihan Teknis</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Program peningkatan pengetahuan, ketrampilan, dan sikap perilaku PNS untuk memenuhi Kompetensi penguasaan substantif bidang kerja melalui proses pembelajaran secara intensif.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Pelatihan Fungsional</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Program peningkatan pengetahuan, ketrampilan, dan sikap perilaku PNS untuk memenuhi Kompetensi bidang tugas yang terkait dengan JF melalui proses pembelajaran secara intensif.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Pelatihan Sosial Kultural</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Program peningkatan pengetahuan, ketrampilan, dan sikap perilaku PNS untuk memenuhi Kompetensi Sosial Kultural melalui proses pembelajaran secara intensif.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Seminar/Konferensi/Sarasehan/FGD</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Pertemuan ilmiah untuk meningkatkan Kompetensi terkait peningkatan kinerja dan karier yang diberikan oleh pakar/praktisi untuk memperoleh pendapat para ahli mengenai suatu permasalahan di bidang aktual tertentu yang relevan dengan bidang tugas atau kebutuhan pengembangan karier PNS. Fokus kegiatan ini untuk memperbarui pengetahuan terkini.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Workshop atau Lokakarya</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Pertemuan ilmiah untuk meningkatkan Kompetensi terkait peningkatan kinerja dan karier yang diberikan oleh pakar/praktisi. Fokus kegiatan ini untuk meningkatkan pengetahuan tertentu yang relevan dengan bidang tugas atau kebutuhan pengembangan karier dengan memberikan penugasan kepada peserta untuk menghasilkan produk tertentu selama kegiatan berlangsung dengan petunjuk praktis dalam penyelesaian produk.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Kursus</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Kegiatan pembelajaran terkait suatu pengetahuan atau ketrampilan dalam waktu yang relatif singkat, dan biasanya diberikan oleh lembaga nonformal.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Penataran</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Kegiatan pembelajaran untuk meningkatkan pengetahuan dan karakter PNS dalam bidang tertentu dalam rangka peningkatan kinerja organisasi.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Bimbingan Teknis</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Kegiatan Pembelajaran dalam rangka memberikan bantuan untuk menyelesaikan persoalan/masalah yang bersifat khusus dan teknis.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Sosialisasi</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Kegiatan ilmiah untuk memasyarakatkan sesuatu pengetahuan dan/atau kebijakan agar menjadi lebih dikenal, dipahami, dihayati oleh PNS.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Coaching</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Pembimbingan peningkatan kinerja melaui pembekalan kemampuan memecahkan permasalahan dengan mengoptimalkan potensi diri.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Mentoring</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Pembimbingan peningkatan kinerja melalui transfer pengetahuan, pengalaman dan keterampilan dari orang yang lebih berpengalaman pada bidang yang sama.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">E-Learning</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Pengembangan Kompetensi PNS yang dilaksanakan dalam bentuk pelatihan dengan mengoptimalkan penggunaan teknologi informasi dan komunikasi untuk mencapai tujuan pembelajaran dan peningkatan kinerja.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Pelatihan Jarak Jauh</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Proses pembelajaran secara terstruktur dengan dipandu oleh penyelenggara pelatihan secara jarak jauh.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Detasering (Secondment)</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Penugasan/ penempatan PNS pada suatu tempat untuk jangka waktu tertentu.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Pembelajaran Alam Terbuka (Outbond)</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Pembelajaran melalui simulasi yang diarahkan agar PNS mampu menunjukkan potensi dalam membangun semangat kebersamaan memaknai kebajikan dan keberhasilan bagi diri dan orang lain serta memaknai pentingnya peran kerja sama, sinergi, dan keberhasilan bersama.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Patok Banding (Benchmarking)</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Kegiatan untuk mengembangkan Kompetensi dengan cara membandingkan dan mengukur suatu kegiatan organisasi lain yang mempunyai karakteristik sejenis.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Pertukaran antara PNS dengan pegawai Swasta/Badan Usaha Milik Negara/ Badan Usaha Milik Daerah</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Kesempatan kepada PNS untuk menduduki jabatan tertentu di sektor swasta sesuai dengan persyaratan kompetens.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Belajar Mandiri (Self Development)</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Upaya individu PNS untuk mengembangkan kompetensinya melalui proses secara mandiri dengan memanfaatkan sumber pembelajaraan yang tersedia.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Komunitas Belajar (Community of Practices)</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Suatu perkumpulan beberapa orang PNS yang memiliki tujuan saling menguntungkan untuk berbagi pengetahuan, keterampilan, dan sikap perilaku PNS sehingga mendorong terjadinya proses pembelajaran.</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex flex-row">
                                <div><i class="bi bi-check"></i></div>
                                <div>
                                    <div style="font-weight:600">Magang/Praktik Kerja</div>
                                    <div style="font-size:0.8rem; color:#64748b; line-height: 1.2;">Proses pembelajaran untuk memperoleh dan menguasai keterampilan dengan melibatkan diri dalam proses pekerjaan tanpa atau dengan petunjuk orang yang sudahterampil dalam pekerjaan itu (learning by doing). Tempat magang adalah unit yang memiliki tugas dan fungsi yang relevan dengan bidang tugas PNS Praktik Kerja/Magang.</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </section>
    <!-- /Jalur Pendidikan -->


    <!-- Tabel Konversi Section -->
    <section id="pricing" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Tabel Konversi</h2>
            <p>Jika pelaksanaan Pengembangan Kompetensi tidak ada jumlah jam pelajaran, dapat dikonversikan menjadi Jam Pelajaran (JP).</p>
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
                        <div class="faq-item faq-active">
                            <div class="faq-header">
                                <h3>Bagaimana cara login ke SIDIK?</h3>
                                <i class="bi bi-chevron-down faq-toggle"></i>
                            </div>
                            <div class="faq-content">
                                <p>
                                    Nulla quis lorem ut libero malesuada feugiat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur aliquet quam id dui posuere blandit. Nulla porttitor accumsan tincidunt.
                                </p>
                            </div>
                        </div>
                        <!-- End FAQ Item-->

                        <div class="faq-item" data-aos="zoom-in" data-aos-delay="200">
                            <div class="faq-header">
                                <h3>Apa saja fitur yang dapat dimanfaatkan di SIDIK?</h3>
                                <i class="bi bi-chevron-down faq-toggle"></i>
                            </div>
                            <div class="faq-content">
                                <p>
                                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar.
                                </p>
                            </div>
                        </div><!-- End FAQ Item-->

                        <div class="faq-item">
                            <div class="faq-header">
                                <h3>Bagaimana jika pelaksanaan pengembangan kompetensi tidak ada sertifikatnya?</h3>
                                <i class="bi bi-chevron-down faq-toggle"></i>
                            </div>
                            <div class="faq-content">
                                <p>
                                    Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec sollicitudin molestie malesuada. Vestibulum ac diam sit amet quam vehicula elementum.
                                </p>
                            </div>
                        </div><!-- End FAQ Item-->

                        <div class="faq-item">
                            <div class="faq-header">
                                <h3>Bagaimana jika pelaksanaan pengembangan kompetensi tidak ada jam pelajarannya (JP)?</h3>
                                <i class="bi bi-chevron-down faq-toggle"></i>
                            </div>
                            <div class="faq-content">
                                <p>
                                    Donec sollicitudin molestie malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel.
                                </p>
                            </div>
                        </div><!-- End FAQ Item-->
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /Faq PANDUAN -->


@endsection
