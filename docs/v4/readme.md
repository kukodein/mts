# Dokumentasi HTML Versi 4 (v4) — Modern Emerald & Warm Amber

## 📌 Ringkasan Versi
**Versi rujukan utama (Benchmark Layout)** yang sangat disukai pengguna karena tata letak komponennya yang rapi, bersih, berjenjang jelas, dan sangat responsif. Versi ini menjadi acuan tata letak (*layout reference*) bagi pengembangan Versi 6, 7, dan 8.

---

## 🎨 Identitas Visual & Desain
- **Palet Warna Utama**:
  - Hijau Zamrud (*Modern Emerald Green*): `#065f46`
  - Hijau Gelap (*Hover*): `#044e39`
  - Hijau Muda (*Light Emerald Tint*): `#ecfdf5`
  - Aksen Oranye Hangat (*Warm Amber*): `#d97706`
  - Latar Belakang Kartu: `#ffffff`
  - Latar Halaman: `#f8fafc`
  - Teks Utama: `#334155` / Gelap: `#0f172a`
- **Tipografi**: `Plus Jakarta Sans` (Sans-serif kontemporer, tajam, dan sangat nyaman dibaca di layar smartphone maupun desktop).
- **Gaya Tampilan**: Desain kartu modern dengan bayangan lembut (*subtle shadows*), border halus (`#e2e8f0`), pill tags, dan radius sudut membulat proporsional.

---

## 🚀 Fitur & Komponen Kunci (Dasar Layout v4)
1. **Topbar & Sticky Navigation Bar**:
   - Informasi kontak, alamat, dan badge pengumuman PPDB di bilah atas.
   - Header navigasi bersih dengan tombol aksi tegas ("PPDB Online").
2. **Hero Section Dinamis**:
   - Grid 2 kolom dengan teks inspiratif, tombol CTA ganda, dan visual santri berprestasi disertai kartu akreditasi melayang (*floating badge*).
3. **Floating Stats Bar**:
   - Bilah statistik 4 kolom yang melayang di bawah hero dengan angka besar dan gradasi lembut.
4. **Alur Pendaftaran Bernomor (Step Cards)**:
   - Kartu tahapan pendaftaran 5 langkah dengan nomor bulat yang mudah diikuti calon wali murid.
5. **Tabel Rincian Biaya Transparan**:
   - Tabel modern ber-radius dengan baris total berkontras jelas dan catatan beasiswa.
6. **Formulir Pendaftaran & Pesan Lengkap**:
   - Field form bersih dengan fokus warna, dropdown jalur, dan tombol kirim menonjol.
7. **Akordeon Pertanyaan Umum (FAQ)**:
   - Elemen `<details>` dan `<summary>` interaktif bawaan HTML5 tanpa dependensi library luar.

---

## 📂 Struktur Berkas
1. [`index.html`](index.html) — Beranda lengkap: hero, stats bar, sambutan, program peminatan, warta, testimoni, dan CTA.
2. [`profil.html`](profil.html) — Profil madrasah, visi misi, timeline sejarah, fasilitas terpadu, dan pimpinan.
3. [`akademik.html`](akademik.html) — Jenjang VII–IX, kurikulum merdeka + Kemenag, peminatan, ekskul, dan jadwal harian santri.
4. [`berita.html`](berita.html) — Berita utama, filter kategori, grid warta dengan paginasi, kalender agenda, dan unduhan dokumen PDF.
5. [`pendaftaran.html`](pendaftaran.html) — Kuota, alur 5 langkah, berkas persyaratan, tabel biaya transparan, form pendaftaran, dan FAQ.
6. [`kontak.html`](kontak.html) — 4 kanal kontak, form pesan, jam buka TU, direktori divisi, peta lokasi, dan panduan rute.
7. [`style.css`](style.css) — Lembar gaya modular dengan variabel CSS bertema Modern Emerald.

---

## ⚙️ Catatan Teknis
- Dilengkapi tag `<meta name="robots" content="noindex">`.
- Seluruh gambar menggunakan placeholder responsif dari `https://placehold.co/`.

