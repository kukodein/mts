# Indeks & Riwayat Versi Desain Website Madrasah (v1 – v8)

Direktori `docs/` ini memuat seluruh iterasi dan riwayat pengembangan antarmuka HTML/CSS untuk website **Madrasah Tsanawiyah (MTs)**. Setiap versi memiliki karakteristik visual, konsep tipografi, dan fokus pengalaman pengguna (*user experience*) yang berbeda.

---

## 📊 Tabel Perbandingan Seluruh Versi

| Versi | Tema & Karakter Desain | Palet Warna Utama | Tipografi | Status & Rujukan | Tautan Dokumentasi |
| :---: | :--- | :--- | :--- | :--- | :---: |
| **v1** | **Classic Traditional**<br>Sederhana, esensial, tanpa ornamen berlebih. | Hijau Hutan (`#1d4a3c`) & Emas (`#c79a2b`) | Literata + Public Sans | Versi rintisan awal | [README v1](v1/readme.md) |
| **v2** | **Refined Classic Minimalist**<br>Penambahan stats bar, kartu 3 kolom, dan agenda terdekat. | Hijau Hutan (`#1d4a3c`) & Emas (`#c79a2b`) | Literata + Public Sans | Iterasi penyempurnaan v1 | [README v2](v2/readme.md) |
| **v3** | **Madrasah Digital Terpadu**<br>Hero banner penuh, bento tiles nilai, dan ulasan santri. | Hijau Lumut (`#2f6b57`) & Emas (`#c79a2b`) | Literata + Public Sans | Eksplorasi tema digital | [README v3](v3/readme.md) |
| **v4** | **Modern Emerald & Warm Amber**<br>Tata letak kartu rapi, step cards, tabel transparan, dan FAQ. | Hijau Zamrud (`#065f46`) & Oranye (`#d97706`) | Plus Jakarta Sans | **Rujukan Utama Layout (Benchmark)** | [README v4](v4/readme.md) |
| **v5** | **Academic Royal Navy & Gold**<br>Estetika formal, berwibawa, dan bergaya kampus prestisius. | Biru Dongker (`#1e3a8a`) & Emas (`#d97706`) | Cinzel + Inter + Merriweather | Eksplorasi tema formal | [README v5](v5/readme.md) |
| **v6** | **Oceanic Navy & Cyan Glow**<br>Layout v4 + adaptasi warna dari screenshot web Madrasah Pembangunan. | Biru Samudra (`#1e4976`), Cyan (`#0284c7`), Oranye (`#ff8700`) | Plus Jakarta Sans | Rujukan Warna Screenshot | [README v6](v6/readme.md) |
| **v6-konten** | **Real Content MTsN Semarang**<br>Layout & warna v6 diintegrasikan dengan data konten & foto asli MTsN Semarang. | Biru Samudra (`#1e4976`), Cyan (`#0284c7`), Oranye (`#ff8700`) | Plus Jakarta Sans | **Data Asli MTsN Semarang** | [README v6-konten](v6-konten/readme.md) |
| **v7** | **Steel Slate Blue & Azure**<br>Layout v4 + nuansa warna biru baja yang tenang dan sejuk. | Biru Baja (`#415a79`), Azure (`#1d68b8`), Amber (`#f59e0b`) | Plus Jakarta Sans | Alternatif Warna Screenshot | [README v7](v7/readme.md) |
| **v8** | **Fresh & Dynamic MTs Edition**<br>Warna v6 + tampilan serba fresh, bento tiles, pill badges, dan glassmorphism. | Biru Samudra (`#1e4976`), Cyan (`#0284c7`), Oranye (`#ff8700`) | Plus Jakarta Sans | **Versi Termutakhir (Fresh Look)** | [README v8](v8/readme.md) |

---

## 🧭 Panduan Cepat Halaman (Setiap Versi)
Setiap folder versi di atas memuat 6 halaman web standar madrasah + 1 file CSS:
1. `index.html` — Halaman Beranda (Hero, Stats, Sambutan, Program, Warta, Testimoni, CTA)
2. `profil.html` — Profil Madrasah (Sejarah, Visi & Misi, Nilai Karakter, Fasilitas, Pimpinan)
3. `akademik.html` — Program Pendidikan (Jenjang VII–IX, Kurikulum Terpadu, Peminatan, Ekskul, Jadwal Harian)
4. `berita.html` — Warta & Agenda (Berita Utama, Arsip Artikel, Kalender Acara, Unduhan PDF)
5. `pendaftaran.html` — PPDB Online (Syarat, Alur 5 Langkah, Rincian Biaya Transparan, Form Daring, FAQ)
6. `kontak.html` — Kontak & Lokasi (4 Kanal Respon, Form Kirim Pesan, Jam Pelayanan TU, Peta Lokasi, Rute)
7. `style.css` — Lembar gaya CSS mandiri untuk masing-masing versi

---

## 📱 Sistem Tipografi & Tabel Responsif (v6 & v6-konten)
Versi `v6` dan `v6-konten` telah dibekali standarisasi skala tipografi berbasis variabel CSS modular dan penanganan tabel responsif untuk pengalaman pengguna terbaik di semua ukuran layar:

### Skala Tipografi Multi-Breakpoint
| Elemen UI / Komponen | CSS Variable | Desktop (> 992px) | Tablet (768px – 992px) | Mobile (< 768px) | Small Mobile (≤ 480px) |
| :--- | :--- | :---: | :---: | :---: | :---: |
| **Hero Heading (`h1`)** | `--font-h1` | `2.5rem` (40px) | `2.1rem` (33.6px) | `1.75rem` (28px) | `1.55rem` (24.8px) |
| **Section Heading (`h2`)** | `--font-h2` | `2.0rem` (32px) | `1.7rem` (27.2px) | `1.4rem` (22.4px) | `1.28rem` (20.5px) |
| **Card / Sub Heading (`h3`)** | `--font-h3` | `1.25rem` (20px) | `1.15rem` (18.4px) | `1.05rem` (16.8px) | `1.0rem` (16px) |
| **Item / Small Heading (`h4`)** | `--font-h4` | `1.05rem` (16.8px) | `1.0rem` (16px) | `0.95rem` (15.2px) | `0.92rem` (14.7px) |
| **Body / Paragraf Isi (`p`, `li`)** | `--font-body` | `1.0rem` (16px) | `0.95rem` (15.2px) | `0.9rem` (14.4px) | `0.88rem` (14.1px) |
| **Lead / Subtitle (`.hero p`, `.sec-desc`)** | `--font-lead` | `1.1rem` (17.6px) | `1.02rem` (16.3px) | `0.95rem` (15.2px) | `0.92rem` (14.7px) |
| **Table Header (`th`)** | `--font-th` | `0.95rem` (15.2px) | `0.9rem` (14.4px) | `0.85rem` (13.6px) | `0.82rem` (13.1px) |
| **Table Data Cells (`td`)** | `--font-td` | `0.92rem` (14.7px) | `0.88rem` (14.0px) | `0.82rem` (13.1px) | `0.80rem` (12.8px) |
| **Navigasi Menu (`nav a`)** | `--font-nav` | `0.92rem` (14.7px) | `0.88rem` (14.0px) | `0.85rem` (13.6px) | `0.85rem` (13.6px) |
| **Tombol Aksi (`.btn`)** | `--font-btn` | `0.95rem` (15.2px) | `0.9rem` (14.4px) | `0.88rem` (14.0px) | `0.85rem` (13.6px) |
| **Angka Metrik / Stat (`.stat-num`)** | `--font-stat-num` | `2.25rem` (36px) | `1.85rem` (29.6px) | `1.6rem` (25.6px) | `1.45rem` (23.2px) |
| **Label Metrik (`.stat-label`)** | `--font-stat-label`| `0.9rem` (14.4px) | `0.85rem` (13.6px) | `0.8rem` (12.8px) | `0.75rem` (12.0px) |
| **Tanggal / Meta Post (`.meta-date`)** | `--font-meta` | `0.84rem` (13.4px) | `0.8rem` (12.8px) | `0.78rem` (12.5px) | `0.75rem` (12.0px) |
| **Pill Badge / Tag (`.tag`)** | `--font-badge`| `0.76rem` (12.2px) | `0.74rem` (11.8px) | `0.72rem` (11.5px) | `0.70rem` (11.2px) |
| **Topbar Info** | *(CSS Rule)* | `0.85rem` (13.6px) | `0.82rem` (13.1px) | `0.78rem` (12.5px) | `0.75rem` (12.0px) |
| **Footer Base Text** | *(CSS Rule)* | `0.92rem` (14.7px) | `0.88rem` (14.0px) | `0.84rem` (13.4px) | `0.80rem` (12.8px) |

### 📝 CSS Responsif Tipografi Inti (`h1, h2, h3, p, small`)
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

### Fitur Tabel Responsif
- **Container Geser `.table-wrap`**: Menggunakan `-webkit-overflow-scrolling: touch;` dan custom scrollbar cyan.
- **Indikator Interaktif `.table-scroll-hint`**: Muncul otomatis di tablet dan mobile (*"↔ Geser ke samping untuk melihat tabel lengkap"*).
- **Proteksi Lebar Minimum**: Tabel multi-kolom memiliki `min-width: 580px;` di mobile agar teks tidak terhimpit.
- **Tabel Ringkas `.table-compact`**: Tabel 2-kolom key-value (identitas madrasah & jam buka) tetap 100% fit tanpa scrollbar horizontal.

---

## 🔒 Kebijakan Keamanan & Media
- **Meta Robots**: Seluruh berkas HTML di direktori ini telah dilengkapi tag `<meta name="robots" content="noindex">` tepat setelah meta viewport.
- **Gambar Placeholder**: Menggunakan URL responsif terstandarisasi dari `https://placehold.co/`.

