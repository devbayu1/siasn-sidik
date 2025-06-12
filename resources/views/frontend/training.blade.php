@extends('frontend.layouts.app')
@section('title', 'Formulir Input Data Pelatihan')


@section('content')


    <section id="contact" class="hero contact section">

        <div class="container section-title" data-aos="fade-up">
            <h2>Formulir Riwayat Pelatihan/Kompetensi</h2>
            <p>Silakan lengkapi data riwayat pelatihan atau pengembangan kompetensi Anda untuk SIASN Tahun {{ date('Y') }}.</p>
        </div><div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-wrapper" data-aos="fade-up" data-aos-delay="400">
                        {{-- ======================================================= --}}
                        {{-- PERUBAHAN UTAMA ADA DI BARIS <FORM> DI BAWAH INI --}}
                        {{-- ======================================================= --}}
                        {{-- Beri id pada form dan tombol submit --}}
                        <form id="training-form" action="{{ route('training.store') }}" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                {{-- Employee ID --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-list"></i></span>
                                        <select id="employee_id" name="employee_id" class="form-select" required>
                                            <option></option>
                                            @foreach($employee as $emp)
                                                <option value="{{ $emp->uuid }}">{{ $emp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Elemen untuk menampilkan error validasi --}}
                                    <small class="text-danger" id="employee_id-error"></small>
                                </div>

                                {{-- Diklat ID --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                                        <select id="diklat_id" name="diklat_id" class="form-select" required>
                                            <option></option>
                                            @foreach($diklat as $d)
                                                <option value="{{ $d->id }}" data-name="{{ $d->name }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small class="text-danger" id="diklat_id-error"></small>
                                </div>

                                {{-- Sub Diklat ID --}}
                                <div id="sub_diklat_container" class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-diagram-3"></i></span>
                                        <select id="diklat_sub_id" name="diklat_sub_id" class="form-select">
                                            <option></option>
                                            @foreach($diklatSubOne as $d)
                                                <option value="{{ $d->id }}" data-name="{{ $d->name }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small class="text-danger" id="diklat_sub_id-error"></small>
                                </div>

                                {{-- Training Name --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-journal-text"></i></span>
                                        <input type="text" id="training_name" name="training_name" class="form-control" placeholder="Nama Pelatihan.." required>
                                    </div>
                                    <small class="text-danger" id="training_name-error"></small>
                                </div>

                                {{-- Organizer --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                                        <input type="text" id="organizer" name="organizer" class="form-control" placeholder="Nama penyelenggara" required>
                                    </div>
                                    <small class="text-danger" id="organizer-error"></small>
                                </div>

                                {{-- Certificate Number --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-patch-check"></i></span>
                                        <input type="text" id="certificate_number" name="certificate_number" class="form-control" placeholder="Nomor pada sertifikat">
                                    </div>
                                    <small class="text-danger" id="certificate_number-error"></small>
                                </div>

                                {{-- Start Date --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                                    </div>
                                    <small class="text-danger" id="start_date-error"></small>
                                </div>

                                {{-- End Date --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                                    </div>
                                    <small class="text-danger" id="end_date-error"></small>
                                </div>

                                {{-- Year --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar3"></i></span>

                                        {{-- Mengganti input text menjadi dropdown (select) --}}
                                        <select id="year" name="year" class="form-select" required>
                                            <option value="" selected disabled>Pilih Tahun...</option>

                                            @php
                                                // Mengambil tahun saat ini, yaitu 2025
                                                $currentYear = date('Y');
                                            @endphp

                                            {{-- Membuat perulangan 10 kali dari tahun sekarang ke belakang --}}
                                            @for ($year = $currentYear; $year >= $currentYear - 9; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>

                                    </div>
                                    <small class="text-danger" id="year-error"></small>
                                </div>

                                {{-- Duration Hours --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                        <input type="number" id="duration_hours" name="duration_hours" class="form-control" placeholder="Total jam pelatihan" required>
                                    </div>
                                    <small class="text-danger" id="duration_hours-error"></small>
                                </div>

                                {{-- Certificate File --}}
                                <div class="col-md-6 form-group mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-file-earmark-arrow-up"></i></span>
                                        <input type="file" id="certificate_file" name="certificate_file" class="form-control">
                                    </div>
                                    <small class="text-danger" id="certificate_file-error"></small>
                                </div>

                                <div class="text-center">
                                    <button id="submit-button" type="submit">Kirim</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>@endsection


@push('scripts')
    <script>
        jQuery(document).ready(function($) {
            // Inisialisasi Select2 (tidak berubah)
            $('#employee_id, #diklat_id, #diklat_sub_id').select2({
                theme: 'bootstrap-5',
                placeholder: function() {
                    $(this).data('placeholder');
                }
            });
            $('#employee_id').select2({ theme: 'bootstrap-5', placeholder: 'Cari dan pilih nama pegawai...' });
            $('#diklat_id').select2({ theme: 'bootstrap-5', placeholder: 'Cari dan pilih nama diklat...' });
            $('#diklat_sub_id').select2({ theme: 'bootstrap-5', placeholder: 'Cari dan pilih nama sub diklat...' });


            // Logika hide/show (tidak berubah)
            const subDiklatContainer = $('#sub_diklat_container');
            const subDiklatSelect = $('#diklat_sub_id');
            const trainingNameInput = $('#training_name');

            subDiklatContainer.hide();

            $('#diklat_id').on('change', function() {
                const selectedDiklatName = $(this).find('option:selected').data('name');
                if (selectedDiklatName === 'Diklat Struktural') {
                    subDiklatContainer.slideDown();
                } else {
                    subDiklatContainer.slideUp();
                    subDiklatSelect.val(null).trigger('change');
                    trainingNameInput.val('').prop('disabled', false);
                }
            });

            subDiklatSelect.on('change', function() {
                const hasValue = $(this).val();
                if (hasValue) {
                    const selectedSubDiklatName = $(this).find('option:selected').data('name');
                    trainingNameInput.val(selectedSubDiklatName).prop('disabled', true);
                } else {
                    trainingNameInput.val('').prop('disabled', false);
                }
            });

            // ===================================================================
            // BARU: Logika Submit Form Menggunakan AJAX
            // ===================================================================
            $('#training-form').on('submit', function(e) {
                e.preventDefault(); // Mencegah form melakukan submit standar

                const form = $(this);
                const submitButton = $('#submit-button');
                const url = form.attr('action');

                // Menghapus pesan error sebelumnya
                form.find('.text-danger').text('');
                form.find('.is-invalid').removeClass('is-invalid');

                // Mengaktifkan kembali input yang disabled agar nilainya terbaca
                trainingNameInput.prop('disabled', false);

                const formData = new FormData(this);

                // Menonaktifkan kembali input setelah nilainya diambil
                if (subDiklatSelect.val()) {
                    trainingNameInput.prop('disabled', true);
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    contentType: false, // Wajib untuk FormData
                    processData: false, // Wajib untuk FormData
                    beforeSend: function() {
                        submitButton.prop('disabled', true).text('Menyimpan...');
                    },
                    success: function(response) {
                        // Jika berhasil, tampilkan notifikasi sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        });
                        // Reset form
                        form[0].reset();
                        // Reset semua select2
                        $('#employee_id, #diklat_id, #diklat_sub_id').val(null).trigger('change');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Jika terjadi error validasi (status 422)
                        if (jqXHR.status === 422) {
                            const errors = jqXHR.responseJSON.errors;
                            console.log(errors); // Debugging: tampilkan error di console
                            // Tampilkan setiap pesan error di bawah input yang sesuai
                            $.each(errors, function(key, value) {
                                $('#' + key + '-error').text(value[0]);
                                $('#' + key).addClass('is-invalid');
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terdapat kesalahan pada input Anda!',
                            });
                        } else {
                            // Untuk error lainnya (misal: 500)
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                text: 'Gagal menyimpan data. Silakan coba lagi.',
                            });
                        }
                    },
                    complete: function() {
                        submitButton.prop('disabled', false).text('Kirim');
                    }
                });
            });

        });
    </script>
@endpush
