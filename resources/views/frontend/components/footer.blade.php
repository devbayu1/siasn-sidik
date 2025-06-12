<footer id="footer" class="footer">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-8 col-md-6 footer-about">
                <a href="#" class="logo d-flex align-items-center">
                    <span class="sitename">{!! setting('web-name') ?? '' !!}</span>
                </a>
                <p>{!! setting('tentang') ?? '' !!}</p>
                <div class="footer-contact pt-3">
                    <p>
                        {!! setting('address') ?? '' !!}
                    </p>
                    <p class="mt-3"><strong>Phone:</strong> <span>{!! setting('phone') ?? '' !!}</span></p>
                    <p><strong>Email:</strong> <span>{!! setting('email') ?? '' !!}</span></p>
                </div>
            </div>

            <div class="col-lg-2 footer-links">
                <h4>Informasi</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i><a href="#home">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i><a href="#about">Tentang APKOM</a></li>
                    <li><i class="bi bi-chevron-right"></i><a href="#jenis-pengembangan-kompetensi">Jenis Pengembangan Kompetensi</a></li>
                    <li><i class="bi bi-chevron-right"></i><a href="#tabel-konversi">Tabel Konversi</a></li>
                    <li><i class="bi bi-chevron-right"></i><a href="#faq">Panduan</a></li>
                    <li><i class="bi bi-chevron-right"></i><a href="/training">Form Diklat</a></li>
                </ul>
            </div>

            <div class="col-lg-2 footer-links">
                <h4>Sosial Media</h4>
                <div class="social-links d-flex mt-4">
                    <a href="{!! setting('twitter') ?? '#' !!}" target="_blank"><i class="bi bi-twitter-x"></i></a>
                    <a href="{!! normalize_url(setting('facebook')) ?? '#' !!}" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="{!! setting('instagram') ?? '#' !!}" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="{!! setting('youtube') ?? '#' !!}" target="_blank"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Badan Kepegawaian dan Pengembangan Sumber Daya
                Manusia</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            {{--            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
        </div>
    </div>

</footer>
