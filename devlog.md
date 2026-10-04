# DEVELOPMENT LOG: LMS LATSAR CPNS (APKOM)
**Aplikasi Pengembangan Kompetensi - BKPSDM**
*Dokumen Riwayat Catatan Diskusi, Keputusan Arsitektur, dan Log Pengerjaan*

---

## Format Entri
Setiap entri memuat:
* **Tanggal & Waktu**
* **Kategori**: `[DISKUSI]`, `[ARSITEKTUR]`, `[FITUR]`, `[BUGFIX]`, `[OPTIMASI]`
* **Uraian & Ringkasan Keputusan**
* **Tindakan Lanjutan (Next Action)**

---

## Log Riwayat Pengembangan

### [2026-09-30 15:25] [DISKUSI & ARSITEKTUR] - Inisiasi Kebutuhan LMS Latsar CPNS
* **Latar Belakang**:
  - Pertemuan dengan Kepala Bidang Pengembangan Kompetensi (Bangkom) BKPSDM.
  - Arahan untuk menambahkan modul LMS terintegrasi pada APKOM khusus untuk Pelatihan Dasar (Latsar) CPNS.
* **Hasil Kesepakatan Kebutuhan Bisnis**:
  1. **Batas Waktu Pelatihan Global**: Batas waktu pengerjaan diatur untuk satu paket Latsar secara keseluruhan (bukan per agenda), memberikan fleksibilitas belajar bagi CPNS selama periode pelatihan aktif.
  2. **Struktur Kurikulum Fleksibel**: Admin dapat membuat banyak agenda belajar secara dinamis, dan di tiap agenda dapat berisi banyak materi (> 5 materi, berupa modul PDF, video pembelajaran, dan teks).
  3. **Alur Pembelajaran Berurutan (*Progression Gate*)**: Peserta wajib menuntaskan seluruh materi pada suatu agenda dengan tombol *"Tandai Selesai & Lanjutkan"* sebelum sistem membuka agenda berikutnya.
  4. **Satu Evaluasi Akhir Terpusat**: Seluruh agenda (Agenda 1 sampai Agenda terakhir) harus tuntas 100% terlebih dahulu, baru peserta dapat membuka dan mengerjakan Ujian Evaluasi Akhir.
  5. **Evaluasi Berdurasi 60 Menit**: Ujian berupa soal pilihan ganda dengan durasi waktu 60 menit terhitung mundur sejak peserta menekan tombol *"Mulai Evaluasi"*.
* **Keputusan Teknis & Infrastruktur (Server Constraint)**:
  - Lingkungan server memiliki batasan ketat: **`EP: 20`** (Entry Processes) dan **`NPROC: 40`** (Number of Processes).
  - Menghindari penggunaan Livewire di sisi peserta untuk mencegah lonjakan koneksi simultan (503 Service Unavailable).
  - Disepakati penggunaan tumpukan teknologi: **Inertia.js + Vue 3 (Composition API `<script setup>`) + Tailwind CSS** di sisi peserta.
  - Mode yang digunakan adalah **murni Client-Side Rendering (CSR)** tanpa SSR untuk menghemat RAM dan slot proses hosting.
  - Implementasi *Zero-Ping Exam Engine*: Timer 60 menit dan jawaban sementara dikelola di browser peserta (`localStorage`), sehingga server mencatat 0 beban PHP selama 60 menit ujian berjalan.
* **Tindakan yang Telah Dilakukan**:
  - Menyusun cetak biru arsitektur lengkap pada `devplan.md`.
  - Menginisialisasi buku catatan log pada `devlog.md`.
* **Tindakan Selanjutnya**:
  - Mempersiapkan instalasi dependensi Inertia.js dan Vue 3 di proyek Laravel saat siap memulai tahap pengkodean (Milestone 1).
