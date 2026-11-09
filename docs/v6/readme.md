# Dokumentasi HTML Versi 6 (v6) — Oceanic Navy & Electric Cyan Glow

## 📌 Ringkasan Versi
Dibuat berdasarkan permintaan pengguna dengan **referensi layout dari Versi 4 (v4)** dan **referensi skema warna dari gambar tangkapan layar website Madrasah Pembangunan**. Menampilkan kombinasi warna biru samudra (*Oceanic Navy*), biru toska berpendar (*Electric Cyan Glow*), dan aksen oranye terang (*Vibrant Orange*).

---

## 🎨 Identitas Visual & Desain
- **Palet Warna Utama**:
  - Biru Samudra (*Oceanic Navy*): `#1e4976`
  - Biru Laut Gelap (*Hover*): `#153658`
  - Biru Muda Lembut (*Light Tint*): `#e8f3fc`
  - Biru Elektrik (*Electric Cyan*): `#0284c7`
  - Biru Sian Pendar (*Cyan Glow*): `#38bdf8`
  - Aksen Oranye Menyala (*Vibrant Orange*): `#ff8700` & `#e06d00`
  - Gelap Latar / Dark Section: `#162238` & `#2c4766`
  - Latar Halaman: `#f0f5fa`
- **Tipografi**: `Plus Jakarta Sans` (400, 500, 600, 700, 800) untuk seluruh heading dan teks isi.
- **Gaya Tampilan**: Bersih, modern, berwawasan riset dan teknologi, dilengkapi banner biru berpendar dan kartu bento 6 pilar.

---

## 🚀 Fitur & Komponen Khas Versi 6
1. **Banner Berpendar Ikonik (*Cyan Glowing Title Banner*)**:
   - Menampilkan tulisan kapital tegas `"MADRASAH PEMBANGUNAN TSANAWIYAH"` dengan subjudul *"Lembaga Pendidikan Islam Modern Terpadu Berwawasan Riset dan Teknologi"* diapit garis berpendar biru elektrik.
2. **6 Bento Tiles Keunggulan Madrasah**:
   - Enam kartu nilai dengan ikon lingkaran oranye terang: *Tahfidz Al-Qur'an*, *Madrasah Riset Sains*, *Digital & Robotika*, *Bilingual Habit*, *Adab & Akhlaq*, dan *Talenta & Minat*.
3. **Hero Section Beraksen Riset & Prestasi**:
   - Menampilkan tag tahun pelajaran, badge akreditasi melayang (*Terakreditasi A BAN-S/M*), serta tombol aksi bergradasi oranye.
4. **Stats Bar Interaktif**:
   - Rasio guru 1:12, 88% lulusan ke SMA/MA favorit, 2.192 peserta didik aktif, dan 337 pendidik & tenaga ahli.
5. **Implementasi Lengkap Layout v4**:
   - Menyertakan seluruh keunggulan fungsional v4 (step cards PPDB 5 langkah, tabel biaya transparan, form interaktif, dan FAQ).

---

## 📂 Struktur Berkas
1. [`index.html`](index.html) — Beranda dengan glowing title banner, 6 bento tiles, dan statistik lengkap.
2. [`profil.html`](profil.html) — Profil madrasah, sejarah singkat, visi-misi, fasilitas riset & teknologi, dan pimpinan.
3. [`akademik.html`](akademik.html) — Jenjang VII–IX, kurikulum merdeka terpadu, peminatan riset & tahfidz, serta ekstrakurikuler.
4. [`berita.html`](berita.html) — Sorotan berita utama, filter warta, agenda kegiatan bertanggal, dan unduhan PDF.
5. [`pendaftaran.html`](pendaftaran.html) — Kuota PPDB, alur pendaftaran 5 langkah, tabel biaya transparan, dan form online.
6. [`kontak.html`](kontak.html) — Kanal kontak, form pertanyaan, peta responsif kampus, dan direktori sekretariat.
7. [`style.css`](style.css) — Lembar gaya CSS dengan implementasi skema warna Oceanic Navy & Electric Cyan.

---

## 📱 Tipografi Responsif (Desktop, Tablet, Mobile)
Sistem tipografi telah dimutakhirkan menggunakan variabel CSS modular (`:root`) yang secara otomatis beradaptasi secara dinamis di setiap breakpoint perangkat:

| Elemen UI / Komponen | CSS Variable | Desktop (> 992px) | Tablet (768px – 992px) | Mobile (< 768px) | Small Mobile (≤ 480px) | Karakteristik & Penerapan |
| :--- | :--- | :---: | :---: | :---: | :---: | :--- |
| **Hero Heading (`h1`)** | `--font-h1` | `2.5rem` (40px) | `2.1rem` (33.6px) | `1.75rem` (28px) | `1.55rem` (24.8px) | Bold 800, tajuk utama hero banner |
| **Section Heading (`h2`)** | `--font-h2` | `2.0rem` (32px) | `1.7rem` (27.2px) | `1.4rem` (22.4px) | `1.28rem` (20.5px) | Bold 700, pemisah tema tiap seksi |
| **Card / Sub Heading (`h3`)** | `--font-h3` | `1.25rem` (20px) | `1.15rem` (18.4px) | `1.05rem` (16.8px) | `1.0rem` (16px) | Semi-bold 700, judul modul program & kartu |
| **Item / Small Heading (`h4`)** | `--font-h4` | `1.05rem` (16.8px) | `1.0rem` (16px) | `0.95rem` (15.2px) | `0.92rem` (14.7px) | Semi-bold 600, kontak perorangan & meta item |
| **Body / Paragraf Isi (`p`, `li`)** | `--font-body` | `1.0rem` (16px) | `0.95rem` (15.2px) | `0.9rem` (14.4px) | `0.88rem` (14.1px) | Regular 400, line-height 1.6 untuk keterbacaan |
| **Lead / Subtitle (`.hero p`, `.sec-desc`)** | `--font-lead` | `1.1rem` (17.6px) | `1.02rem` (16.3px) | `0.95rem` (15.2px) | `0.92rem` (14.7px) | Medium 500, deskripsi pengantar judul |
| **Table Header (`th`)** | `--font-th` | `0.95rem` (15.2px) | `0.9rem` (14.4px) | `0.85rem` (13.6px) | `0.82rem` (13.1px) | Bold 700, kapital kecil, header kolom tabel |
| **Table Data Cells (`td`)** | `--font-td` | `0.92rem` (14.7px) | `0.88rem` (14.0px) | `0.82rem` (13.1px) | `0.80rem` (12.8px) | Regular 400/500, isi sel tabel informasi |
| **Navigasi Menu (`nav a`)** | `--font-nav` | `0.92rem` (14.7px) | `0.88rem` (14.0px) | `0.85rem` (13.6px) | `0.85rem` (13.6px) | Semi-bold 600, link navigasi bar |
| **Tombol Aksi (`.btn`)** | `--font-btn` | `0.95rem` (15.2px) | `0.9rem` (14.4px) | `0.88rem` (14.0px) | `0.85rem` (13.6px) | Bold 700, touch-friendly min-height 44px |
| **Angka Metrik / Stat (`.stat-num`)** | `--font-stat-num` | `2.25rem` (36px) | `1.85rem` (29.6px) | `1.6rem` (25.6px) | `1.45rem` (23.2px) | Extra-bold 800, penegas capaian data |
| **Label Metrik (`.stat-label`)** | `--font-stat-label`| `0.9rem` (14.4px) | `0.85rem` (13.6px) | `0.8rem` (12.8px) | `0.75rem` (12.0px) | Regular 500, keterangan angka statistik |
| **Tanggal / Meta Post (`.meta-date`)** | `--font-meta` | `0.84rem` (13.4px) | `0.8rem` (12.8px) | `0.78rem` (12.5px) | `0.75rem` (12.0px) | Regular 400, timestamp publikasi berita |
| **Pill Badge / Tag (`.tag`)** | `--font-badge`| `0.76rem` (12.2px) | `0.74rem` (11.8px) | `0.72rem` (11.5px) | `0.70rem` (11.2px) | Bold 700, penanda status gelombang/jalur |
| **Topbar Info** | *(CSS Rule)* | `0.85rem` (13.6px) | `0.82rem` (13.1px) | `0.78rem` (12.5px) | `0.75rem` (12.0px) | Medium 500, baris telepon/email di atas header |
| **Footer Base Text** | *(CSS Rule)* | `0.92rem` (14.7px) | `0.88rem` (14.0px) | `0.84rem` (13.4px) | `0.80rem` (12.8px) | Regular 400, keterangan copyright & alamat footer |

### 📝 CSS Responsif Tipografi (`h1, h2, h3, p, small`)
Format kode CSS khusus untuk ukuran font dan *line-height* lintas breakpoint (Desktop, Tablet, Mobile, dan Layar Kecil):

```css
/* --- Base / Desktop (> 992px) --- */
h1 {
  font-size: 2.5rem;
  line-height: 1.2;
}

h2 {
  font-size: 2rem;
  line-height: 1.3;
}

h3 {
  font-size: 1.25rem;
  line-height: 1.4;
}

p {
  font-size: 1rem;
  line-height: 1.6;
}

small {
  font-size: 0.85rem;
  line-height: 1.4;
}

/* --- Tablet (768px - 992px) --- */
@media (max-width: 992px) {
  h1 {
    font-size: 2.1rem;
    line-height: 1.22;
  }

  h2 {
    font-size: 1.7rem;
    line-height: 1.3;
  }

  h3 {
    font-size: 1.15rem;
    line-height: 1.4;
  }

  p {
    font-size: 0.95rem;
    line-height: 1.6;
  }

  small {
    font-size: 0.82rem;
    line-height: 1.4;
  }
}

/* --- Mobile (< 768px) --- */
@media (max-width: 768px) {
  h1 {
    font-size: 1.75rem;
    line-height: 1.25;
  }

  h2 {
    font-size: 1.4rem;
    line-height: 1.35;
  }

  h3 {
    font-size: 1.05rem;
    line-height: 1.4;
  }

  p {
    font-size: 0.9rem;
    line-height: 1.55;
  }

  small {
    font-size: 0.78rem;
    line-height: 1.35;
  }
}

/* --- Small Mobile (<= 480px) --- */
@media (max-width: 480px) {
  h1 {
    font-size: 1.55rem;
    line-height: 1.3;
  }

  h2 {
    font-size: 1.28rem;
    line-height: 1.35;
  }

  h3 {
    font-size: 1.0rem;
    line-height: 1.4;
  }

  p {
    font-size: 0.88rem;
    line-height: 1.5;
  }

  small {
    font-size: 0.75rem;
    line-height: 1.35;
  }
}
```

---

## 📱 Desain Tabel Responsif (*Responsive Tables System*)
Seluruh tabel pada berkas HTML Versi 6 telah disesuaikan agar nyaman diakses di smartphone maupun tablet:
1. **Wadah Geser (`.table-wrap`)**:
   - Dilengkapi `overflow-x: auto;` dan `-webkit-overflow-scrolling: touch;` untuk pengalaman scrolling halus pada layar sentuh.
   - Memiliki batas sudut melengkung halus (*rounded corner*), border yang senada dengan palet samudra, serta scrollbar bergaya kustom (hover cyan).
2. **Indikator Geser Cerdas (`.table-scroll-hint`)**:
   - Bilah petunjuk interaktif *"↔ Geser ke samping untuk melihat tabel lengkap"* muncul otomatis pada tablet (`≤ 992px`) dan ponsel (`≤ 768px`).
   - Secara otomatis disembunyikan pada layar desktop (`> 992px`) guna mempertahankan estetika halaman yang lapang dan bersih.
3. **Proteksi Kolom Data Multi-Kolom**:
   - Seluruh tabel agenda, kalender, kurikulum, dan estimasi biaya menerapkan aturan `min-width: 580px;` pada mobile, mencegah konten teks terhimpit secara vertikal.
4. **Tabel Ringkas Khusus (`table.table-compact`)**:
   - Dikhususkan untuk tabel 2 kolom berbasis *key-value* (seperti identitas madrasah dan jam layanan loket).
   - Menjaga lebar 100% penuh tanpa memicu scroll horizontal yang tidak diperlukan.

---

## ⚙️ Catatan Teknis
- Dilengkapi tag `<meta name="robots" content="noindex">`.
- Seluruh gambar responsif dari `https://placehold.co/`.
- Bebas dari referensi path absolut lokal (menggunakan *clean relative paths*).

