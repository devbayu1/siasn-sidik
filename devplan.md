# DEVELOPMENT PLAN: LMS LATSAR CPNS (APKOM)
**Aplikasi Pengembangan Kompetensi - BKPSDM**
*Dokumen Rencana Pengembangan Sistem Pembelajaran Mandiri & Evaluasi Akhir CPNS*

---

## 1. Ringkasan Eksekutif & Tujuan
Modul LMS Latsar CPNS pada APKOM dikembangkan untuk memfasilitasi proses pelatihan dasar bagi CPNS di lingkungan pemerintah daerah secara digital, terstruktur, dan terukur. Sistem ini menggantikan proses manual dengan alur pembelajaran sekuensial mandiri (*structured sequential learning*), pembatasan waktu global terpadu, serta evaluasi akhir berbasis *Computer-Based Test* (CBT).

### Sasaran Utama:
1. **Pembelajaran Bertahap Berurutan (*Progression Gating*)**: Peserta harus menuntaskan seluruh materi pada suatu agenda secara berurutan sebelum dapat membuka agenda berikutnya.
2. **Evaluasi Akhir Terpusat**: Seluruh agenda harus tuntas 100% sebelum peserta diizinkan menempuh Ujian Evaluasi Akhir pilihan ganda berdurasi 60 menit.
3. **Efisiensi Infrastruktur Maksimal**: Dirancang khusus agar sangat ringan dan stabil berjalan pada hosting dengan spesifikasi ketat (`EP: 20`, `NPROC: 40`), mencegah galat *503 Service Unavailable*.

---

## 2. Arsitektur & Tumpukan Teknologi (Tech Stack)

| Bagian | Teknologi | Keterangan & Alasan Pemilihan |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel 12 | Fondasi inti aplikasi eksisting, aman, modular, dan cepat. |
| **Database** | MySQL | Penyimpanan data relasional berindeks tinggi. |
| **Panel Admin BKPSDM** | Filament PHP 3.3 | Dashboard manajemen untuk panitia BKPSDM (CRUD Latsar, Agenda, Materi, Soal, dan Monitoring Nilai). |
| **Frontend Peserta CPNS** | **Inertia.js + Vue 3** | Single Page Application (SPA) murni *Client-Side Rendering* (CSR, tanpa SSR). Sangat responsif, minim konsumsi PHP execution time. |
| **Styling** | Tailwind CSS v4 | Utilitas CSS modern dan ringan, sudah terpasang via Vite. |
| **State & Reaktivitas** | Vue 3 Composition API (`<script setup>`) | Pengelolaan *state* ujian (nomor soal, jawaban, ragu-ragu, timer) yang presisi dan bebas *re-render* berlebih. |

### Prinsip Optimasi Server Hemat (`EP: 20`, `NPROC: 40`):
1. **Zero-Ping Exam Engine**: Selama 60 menit ujian berlangsung, timer dan jawaban disimpan di sisi klien (`localStorage`). Tidak ada request *heartbeat/polling* berkala ke server. Komunikasi hanya terjadi 2 kali: saat mengambil soal (`GET`) dan saat mengumpulkan jawaban (`POST`).
2. **Bypass PHP File Serving**: Dokumen materi PDF disajikan langsung oleh web server statis (Nginx/Apache via `storage:link`). Konten video disematkan (*embed*) via YouTube/Google Drive. Beban PHP EP = 0 saat membaca/menonton.
3. **Execution Time Kilat (< 30ms)**: Seluruh respons Inertia berupa JSON ringkas, memastikan setiap slot *Entry Process (EP)* langsung lepas seketika.

---

## 3. Spesifikasi Kebutuhan Fungsional

### A. Sisi Administrator & Pengelola (Filament Panel)
1. **Master Pelatihan Latsar**:
   - Judul Angkatan / Pelatihan (misal: *Latsar CPNS Angkatan I Tahun 2026*).
   - Pengaturan Batas Waktu Global (Tanggal Mulai & Tanggal Selesai Pelatihan).
   - Pengaturan Evaluasi Akhir: Durasi ujian (misal: 60 menit), KKM kelulusan (misal: 70), opsi acak soal & jawaban.
   - Kuota & penetapan peserta yang berhak mengikuti angkatan tersebut.
2. **Manajemen Kurikulum Dinamis**:
   - Manajemen Agenda: Tambah/ubah/hapus agenda belajar (Agenda I, II, III, dst.).
   - Manajemen Materi per Agenda: Tambah materi tanpa batasan jumlah (PDF, Link Video Embed, Teks Bacaan).
3. **Bank Soal Evaluasi Akhir**:
   - Pembuatan soal pilihan ganda (pertanyaan, opsi A s/d E, dan penentuan kunci jawaban).
4. **Monitoring & Rekapitulasi Real-Time**:
   - Memantau progres belajar setiap peserta (persentase agenda yang diselesaikan).
   - Rekap nilai evaluasi akhir, status kelulusan (Lulus / Tidak Lulus), dan ekspor Berita Acara ke Excel/PDF.

### B. Sisi Peserta CPNS (Portal Inertia Vue 3)
1. **Dashboard Pelatihan**:
   - Informasi periode pelatihan dan hitung mundur batas akhir penutupan Latsar.
   - Daftar Agenda dalam bentuk kartu progres (*Completed*, *In Progress*, *Locked* 🔒).
2. **Ruang Belajar Materi**:
   - Membaca dokumen PDF / menyimak video pembelajaran.
   - Tombol **[Tandai Selesai & Lanjutkan]**: Mengirimkan status tuntas ke server secara asinkron dan otomatis membuka materi nomor berikutnya.
3. **Ruang Evaluasi Akhir (CBT)**:
   - Terbuka otomatis hanya jika seluruh agenda telah tuntas 100%.
   - Halaman briefing tata tertib & tombol **[Mulai Evaluasi]**.
   - Timer hitung mundur 60 menit dengan sinkronisasi jam server.
   - Papan navigasi nomor soal, penanda status (Sudah Dijawab, Ragu-ragu, Belum Dijawab).
   - Pengumpulan jawaban manual atau otomatis (*auto-submit*) saat timer mencapai 00:00.
   - Tampilan lembar hasil nilai ujian seketika setelah submit.

---

## 4. Desain Skema Basis Data (Database Schema)

```
[latsar_courses]
   ├── id, title, slug, start_date, end_date, is_active
   └── exam_duration_minutes (default: 60), passing_grade (default: 70)
          │
          ├── 1:N ──► [latsar_agendas]
          │              ├── id, course_id, title, order_number, description
          │              └── 1:N ──► [latsar_materials]
          │                             ├── id, agenda_id, title, type (pdf/video/text)
          │                             ├── content_url / file_path, order_number
          │                             └── 1:N ──► [latsar_material_progress]
          │                                            └── id, user_id, material_id, completed_at
          │
          └── 1:N ──► [latsar_questions]
                         ├── id, course_id, question_text, explanation
                         └── 1:N ──► [latsar_options]
                                        ├── id, question_id, option_label (A-E), option_text, is_correct
                                        └── Relasi ke [latsar_quiz_attempts] & [latsar_quiz_answers]
```

---

## 5. Rencana Tahapan Eksekusi (Milestones)

### Milestone 1: Fondasi Arsitektur & Instalasi Inertia Vue 3
- [ ] Instalasi dependensi Inertia.js Laravel (`inertiajs/inertia-laravel`).
- [ ] Instalasi Vue 3, `@inertiajs/vue3`, dan plugin `@vitejs/plugin-vue`.
- [ ] Konfigurasi `vite.config.js` dan middleware `HandleInertiaRequests`.
- [ ] Pembuatan root layout Blade (`app.blade.php`) untuk wadah aplikasi Inertia.

### Milestone 2: Perancangan Skema Database & Model
- [ ] Pembuatan migrasi tabel: `latsar_courses`, `latsar_agendas`, `latsar_materials`, `latsar_material_progress`.
- [ ] Pembuatan migrasi tabel evaluasi: `latsar_questions`, `latsar_options`, `latsar_quiz_attempts`, `latsar_quiz_answers`.
- [ ] Pembuatan Eloquent Model lengkap dengan relasi dan *business methods*.

### Milestone 3: Fitur Pengelolaan Admin (Filament Panel)
- [ ] Filament Resource untuk Kelola Kursus Latsar (Pengaturan Global & Durasi Ujian).
- [ ] Relation Manager untuk Agenda dan Materi bertingkat.
- [ ] Resource / Form Bank Soal Pilihan Ganda & Kunci Jawaban.
- [ ] Tabel Monitoring Progres Belajar Peserta & Riwayat Nilai Ujian.

### Milestone 4: Portal Peserta (Inertia + Vue 3)
- [ ] Halaman Beranda Pelatihan / Dashboard Peserta.
- [ ] Halaman Ruang Belajar Materi (Viewer Dokumen/Video) + Aksi "Tandai Selesai".
- [ ] Logika Penguncian Otomatis (*Progression Gating Middleware & Frontend Guards*).

### Milestone 5: Mesin Evaluasi Akhir CBT (60 Menit Zero-Ping)
- [ ] Halaman Persiapan Ujian & Inisialisasi Sesi Server-Side.
- [ ] Komponen Ujian Vue 3: Timer hitung mundur, Grid Nomor Soal, Opsi Jawaban Radio (`v-model`).
- [ ] Mekanisme Auto-Save lokal (`localStorage`) & Auto-Submit saat waktu habis.
- [ ] Endpoint Evaluasi & Kalkulasi Nilai Otomatis di Backend.

### Milestone 6: Pengujian Beban, Keamanan, & Finalisasi
- [ ] Validasi keamanan timer terhadap manipulasi waktu browser.
- [ ] Pengujian performa untuk menjamin penggunaan proses PHP di bawah limit `EP: 20`.
- [ ] Uji coba menyeluruh alur pengerjaan dari Agenda 1 hingga nilai evaluasi keluar.
