# PANDUAN PENGGUNA (USER MANUAL)
## PENGELOLAAN KONTEN WEBSITE MADRASAH TSANAWIYAH (MTs)

> **Buku Petunjuk Operasional untuk Staf Tata Usaha, Guru, dan Pengelola Website Madrasah**  
> *Panduan ini dirancang untuk memudahkan siapa saja—termasuk pemula—dalam memperbarui berita, foto kegiatan, prestasi, sarana prasarana, serta halaman profil madrasah secara mandiri dan aman.*

---

## DAFTAR ISI
* [LEMBAR INFORMASI AKUN & KREDENSIAL AKSES (RAHASIA)](#lembar-informasi-akun--kredensial-akses-rahasia)
1. [BAB 1: Pengenalan & Akses Website Madrasah](#bab-1-pengenalan--akses-website-madrasah)
2. [BAB 2: Mengelola Berita, Informasi & Pengumuman (Menu: Pos / Posts)](#bab-2-mengelola-berita-informasi--pengumuman-menu-pos--posts)
3. [BAB 3: Mengelola Konten Khusus Madrasah (Prestasi, Fasilitas, Kegiatan)](#bab-3-mengelola-konten-khusus-madrasah-prestasi-fasilitas-kegiatan)
4. [BAB 4: Mengedit Halaman Profil & Statis (Menu: Laman / Pages & Elementor)](#bab-4-mengedit-halaman-profil--statis-menu-laman--pages--elementor)
5. [BAB 5: Mengatur Gambar Banner Header (Menu: Header Arsip)](#bab-5-mengatur-gambar-banner-header-menu-header-arsip)
6. [BAB 6: Mengelola Berkas Media (Foto & Dokumen PDF)](#bab-6-mengelola-berkas-media-foto--dokumen-pdf)
7. [BAB 7: Mengatur Menu Navigasi Website (Tampilan > Menu)](#bab-7-mengatur-menu-navigasi-website-tampilan--menu)
8. [BAB 8: Memeriksa Pesan Masuk dari Formulir Kontak](#bab-8-memeriksa-pesan-masuk-dari-formulir-kontak)
9. [BAB 9: Tips Penting & Pemecahan Masalah (Troubleshooting)](#bab-9-tips-penting--pemecahan-masalah-troubleshooting)
10. [BAB 10: Informasi Pengembang (Developer) & Bantuan Teknis](#bab-10-informasi-pengembang-developer--bantuan-teknis)

---

## LEMBAR INFORMASI AKUN & KREDENSIAL AKSES (RAHASIA)

> ⚠️ **PERHATIAN & KEAMANAN:**  
> Informasi di bawah ini bersifat **Sangat Rahasia (Confidential)**. Jangan membagikan dokumen atau halaman ini kepada pihak yang tidak berkepentingan di luar manajemen madrasah demi menjaga keamanan server dan keutuhan data website.

### A. Kredensial Akses Pengelola Website (WordPress Admin)
Bagian ini digunakan oleh staf tata usaha, guru, dan tim humas untuk mengelola konten harian website:

| Data Akses | Keterangan / Nilai |
| :--- | :--- |
| **Alamat Website (Front-End)** | `https://[namadomainmts.sch.id]` |
| **URL Login Dashboard** | `https://[namadomainmts.sch.id]/wp-admin` *(atau link khusus login)* |
| **Nama Pengguna (Username)** | `[Isikan Username Pengelola]` |
| **Kata Sandi (Password)** | `[Isikan Password WP]` |
| **Tingkatan Hak Akses (Role)** | `Administrator` / `Editor` / `Penulis (Author)` |
| **Nama Pemegang Akun** | `[Nama Guru / Pegawai Penanggung Jawab]` |

---

### B. Kredensial Akses Server Hosting & Domain (cPanel)
> ⛔ **PENTING:** Akses cPanel memegang kendali penuh atas server hosting, database, email institusi, dan file induk website. **Hanya boleh dipegang oleh Kepala Madrasah, Kepala Tata Usaha, atau Penanggung Jawab IT Inti Madrasah.** Jangan serahkan akses ini untuk operasional tulis-menulis berita harian!

| Data Akses Server | Keterangan / Nilai |
| :--- | :--- |
| **Penyedia Layanan Hosting** | `[Nama Penyedia Hosting, misal: Niagahoster / IDCloudHost / Rumahweb dll.]` |
| **URL Login cPanel** | `https://[namadomainmts.sch.id]:2083` *(atau cpanel.[namadomainmts.sch.id])* |
| **Username cPanel** | `[Isikan Username cPanel]` |
| **Password cPanel** | `[Isikan Password cPanel]` |
| **Alamat IP Server** | `[Isikan IP Server Hosting]` |
| **Akun Client Area / Billing** | `[Email Terdaftar untuk Perpanjangan Tahunan Hosting & Domain]` |
| **Jatuh Tempo Perpanjangan** | `[Tanggal / Bulan / Tahun Perpanjangan]` |

> 📸 **[IMAGE: Tangkapan layar formulir Login cPanel Hosting]**

---

## BAB 1: Pengenalan & Akses Website Madrasah

### 1.1. Cara Masuk (*Login*) ke Halaman Admin
Untuk memperbarui isi website, Anda harus masuk ke area pengelola yang disebut **Dashboard WordPress**.

1. Buka peramban internet (*browser*) di komputer atau laptop Anda (disarankan menggunakan **Google Chrome** atau **Mozilla Firefox**).
2. Ketik alamat login website madrasah pada kolom alamat (*address bar*):  
   `https://namadomainmts.sch.id/wp-admin` *(sesuaikan dengan URL website Anda)*.
3. Layar akan menampilkan halaman login.
4. Masukkan:
   * **Nama Pengguna / Email**: akun yang telah diberikan oleh admin sekolah.
   * **Kata Sandi (*Password*)**: kata sandi akun Anda.
5. Beri tanda centang pada opsi **Ingat Saya (*Remember Me*)** jika menggunakan laptop pribadi.
6. Klik tombol biru **Masuk (*Log In*)**.

> 📸 **[IMAGE: Tangkapan layar formulir Login WordPress dengan isian Nama Pengguna dan Sandi]**

---

### 1.2. Mengenal Bagian Dashboard Utama
Setelah berhasil masuk, Anda akan diarahkan ke halaman **Dashboard**. Area ini terdiri dari 3 bagian penting:

1. **Bilah Atas (*Top Admin Bar*)**: 
   * Tombol logo rumah (nama website): klik untuk melihat tampilan depan website yang dilihat pengunjung.
   * Ikon notifikasi & menu pembersihan cache (*LiteSpeed Cache*).
   * Bagian kanan atas: profil Anda untuk keluar (*Log Out*).
2. **Bilah Menu Kiri (*Left Sidebar*)**: 
   * Pusat kendali seluruh fitur (Pos, Media, Laman, Prestasi, Fasilitas, Kegiatan, Header Arsip, Tampilan, dll).
3. **Area Kerja Utama (Tengah)**: 
   * Menampilkan ringkasan status website, berita terbaru, atau formulir pengisian data yang sedang dibuka.

> 📸 **[IMAGE: Tangkapan layar tampilan Dashboard utama dengan penanda Bilah Kiri, Bilah Atas, dan Area Kerja]**

---

### 1.3. Cara Mengubah Kata Sandi & Profil Akun Sendiri
Demi keamanan, sangat disarankan untuk mengganti kata sandi secara berkala:

1. Pada menu bilah kiri, arahkan kursor ke menu **Pengguna (*Users*)** > klik **Profil Anda (*Profile*)**.
2. Gulir ke bawah hingga menemukan bagian **Manajemen Akun (*Account Management*)**.
3. Pada baris **Sandi Baru (*New Password*)**, klik tombol **Atur Sandi Baru (*Set New Password*)**.
4. Ketik kata sandi baru yang kuat (kombinasi huruf besar, kecil, angka, dan simbol).
5. Gulir ke bagian paling bawah, lalu klik tombol biru **Perbarui Profil (*Update Profile*)**.

> 📸 **[IMAGE: Tangkapan layar halaman profil akun pada opsi pergantian sandi baru]**

---

### 1.4. Cara Keluar (*Logout*) yang Aman
Jika selesai memperbarui konten:
1. Arahkan kursor mouse ke pojok kanan atas layar (pada tulisan *"Halo, [Nama Anda]"*).
2. Klik opsi **Keluar (*Log Out*)**.
3. Pastikan Anda selalu logout terutama jika menggunakan komputer bersama di kantor TU atau lab madrasah.

---

## BAB 2: Mengelola Berita, Informasi & Pengumuman (Menu: Pos / Posts)

Menu **Pos (*Posts*)** digunakan untuk konten artikel yang bersifat berkala, seperti berita upacara, info libur sekolah, pengumuman ujian, artikel keislaman, atau liputan prestasi umum.

### 2.1. Menulis Berita Baru
1. Pada menu bilah kiri, klik **Pos** > **Tambah Baru (*Add New Post*)**.
2. Anda akan masuk ke lembar kerja penulisan berita:
   * **Judul Berita**: Tulis judul yang jelas dan menarik pada kolom *"Tambahkan judul"*.
   * **Isi Berita**: Klik di bawah judul untuk mulai mengetik paragraf cerita/laporan kegiatan.
3. Untuk menambahkan paragraf baru, tekan tombol **Enter** pada keyboard.
4. Anda bisa menebalkan teks (**Bold**) atau memiringkan teks (*Italic*) menggunakan bilah alat kecil yang muncul di atas teks yang Anda sorot.

> 📸 **[IMAGE: Tangkapan layar editor penulisan berita dengan contoh pengisian judul dan paragraf]**

---

### 2.2. Menyisipkan Gambar di Dalam Teks Berita
1. Letakkan kursor pada posisi baris yang ingin disisipkan gambar.
2. Klik tanda **+ (Tambah Blok)** yang ada di sisi kanan atau kiri editor.
3. Pilih ikon **Gambar (*Image*)**.
4. Pilih salah satu tombol:
   * **Unggah (*Upload*)**: jika file gambar ada di laptop Anda.
   * **Pustaka Media (*Media Library*)**: jika gambar sudah pernah diunggah sebelumnya.
5. Tunggu hingga gambar muncul di lembar tulisan.

> 📸 **[IMAGE: Tangkapan layar pemilihan blok Gambar dan proses penyisipan foto ke dalam artikel]**

---

### 2.3. Menetapkan Gambar Unggulan (*Featured Image*)
> **PENTING:** Gambar Unggulan adalah gambar sampul utama yang akan muncul di halaman depan website, banner artikel, dan saat link berita dibagikan ke WhatsApp atau Facebook.

1. Perhatikan bilah pengaturan di sebelah kanan layar (tab **Pos / Post**).  
   *(Jika bilah kanan tertutup, klik ikon gerigi/setelan di pojok kanan atas).*
2. Gulir ke bawah dan cari menu **Gambar Unggulan (*Featured Image*)**.
3. Klik **Tetapkan gambar unggulan (*Set featured image*)**.
4. Pilih foto dokumentasi terbaik dari laptop Anda, lalu klik tombol biru **Pilih (*Select*)**.

> 📸 **[IMAGE: Tangkapan layar panel sisi kanan pada pengaturan Gambar Unggulan / Featured Image]**

---

### 2.4. Mengatur Kategori dan Tag
1. Masih di bilah sisi kanan, cari menu **Kategori (*Categories*)**.
2. Beri tanda centang pada kategori yang sesuai, misalnya: `Berita`, `Pengumuman`, `Kesiswaan`, atau `PPDB`.
3. *(Opsional)* Jika kategori belum ada, klik **+ Tambah Kategori Baru**.
4. Pada kolom **Tag**, ketik kata kunci terkait dipisahkan dengan koma (misal: *mts, ujian madrasah, kskk*).

> 📸 **[IMAGE: Tangkapan layar kotak centang pemilihan Kategori berita di panel sisi kanan]**

---

### 2.5. Menerbitkan (*Publish*) atau Menyimpan Draf
* **Jika tulisan belum selesai**: Klik tombol **Simpan Konsep (*Save Draft*)** di pojok kanan atas. Tulisan Anda tersimpan aman dan belum bisa dilihat oleh publik.
* **Jika tulisan sudah siap terbit**:
  1. Klik tombol biru **Terbitkan (*Publish*)** di pojok kanan atas.
  2. Klik sekali lagi tombol **Terbitkan** untuk konfirmasi.
  3. Klik link *"Lihat Pos"* untuk memeriksa hasilnya langsung di website.

---

### 2.6. Mengedit atau Menghapus Berita Lama
1. Klik menu **Pos** > **Semua Pos (*All Posts*)**.
2. Cari judul berita yang ingin diubah.
3. Arahkan mouse ke atas judul berita tersebut, maka akan muncul menu tersembunyi:
   * **Sunting (*Edit*)**: untuk membuka dan mengubah isi tulisan.
   * **Sampah (*Trash*)**: untuk menghapus berita.
4. Jika sudah selesai mengedit, jangan lupa klik tombol **Perbarui (*Update*)**.

> 📸 **[IMAGE: Tangkapan layar daftar Semua Pos dengan tombol aksi Sunting dan Sampah]**

---

## BAB 3: Mengelola Konten Khusus Madrasah (Prestasi, Fasilitas, Kegiatan)

Website MTs ini dilengkapi dengan modul khusus agar profil madrasah tampak terstruktur dan profesional. Modul ini terletak di bilah menu kiri: **Prestasi**, **Fasilitas**, dan **Kegiatan**.

---

### 3.1. Mengelola Data "Prestasi" (Siswa / Guru)
Menu ini digunakan untuk mendokumentasikan piala, medali, dan piagam yang diraih oleh warga madrasah.

1. Pada bilah menu kiri, klik **Prestasi** > **Tambah Baru (*Add New*)**.
2. **Judul Prestasi**: Isi dengan nama raihan juara, contoh:  
   *`Juara 1 Lomba Kaligrafi Tingkat Kabupaten 2026`*  
   *`Juara Harapan 2 KSM Matematika Terintegrasi Provinsi`*
3. **Kolom Deskripsi**: Tuliskan nama siswa/guru peraih prestasi, pembimbing, tanggal penyelenggaraan, dan narasi singkat kejuaraan.
4. **Kategori Prestasi** (di bilah sebelah kanan):  
   Beri tanda centang pada kategori, misalnya: `Akademik`, `Keagamaan`, `Olahraga`, atau `Seni & Budaya`.
5. **Gambar Prestasi (*Featured Image*)**:  
   Klik **Pilih foto prestasi** di bilah kanan. Unggah foto saat siswa/guru memegang piala, sertifikat, atau kalungan medali.
6. Klik tombol **Terbitkan (*Publish*)**.

> 📸 **[IMAGE: Tangkapan layar halaman tambah data Prestasi Baru lengkap dengan kategori dan foto piala]**

---

### 3.2. Mengelola Data "Fasilitas" Madrasah
Menu ini berfungsi menampilkan sarana prasarana penunjang belajar mengajar madrasah (Laboratorium Komputer, Lab IPA, Perpustakaan, Lapangan, Asrama, Masjid/Musholla).

1. Pada bilah menu kiri, klik **Fasilitas** > **Tambah Baru (*Add New*)**.
2. **Judul Fasilitas**: Isi dengan nama ruangan/sarana (misal: *Laboratorium Komputer & Multimedia*, *Perpustakaan Digital Daarul Ilmi*).
3. **Deskripsi Fasilitas**: Jelaskan kapasitas ruangan, kelengkapan alat (AC, proyektor, koleksi buku), serta pemanfaatannya bagi siswa.
4. **Kategori Fasilitas**: Centang kategori yang sesuai (misal: `Ruang Belajar`, `Sarana Olahraga`, `Penunjang Ibadah`).
5. **Foto Fasilitas (*Featured Image*)**: Unggah foto ruangan yang bersih, terang, dan menunjukkan aktivitas atau sarana yang rapi.
6. Klik tombol **Terbitkan (*Publish*)**.

> 📸 **[IMAGE: Tangkapan layar halaman tambah data Fasilitas dengan isian deskripsi dan foto ruangan]**

---

### 3.3. Mengelola Data "Kegiatan" Madrasah
Menu ini digunakan untuk agenda berkala seperti Masa Ta'aruf Siswa Madrasah (MATSAMA), Peringatan Hari Besar Islam (PHBI), Kemah Pramuka, Study Tour, atau Ekstrakurikuler mingguan.

1. Pada bilah menu kiri, klik **Kegiatan** > **Tambah Baru (*Add New*)**.
2. **Judul Kegiatan**: Tulis nama agenda (misal: *Peringatan Isra Mi'raj 1447 H dan Santunan Anak Yatim*).
3. **Deskripsi Kegiatan**: Tuliskan jalannya kegiatan, susunan acara, pemateri/penceramah, dan kesan peserta.
4. **Kategori Kegiatan**: Centang kategori (misal: `Ekstrakurikuler`, `Keagamaan`, `Kesiswaan`, `Upacara`).
5. **Foto Sampul Kegiatan**: Unggah foto utama dokumentasi kegiatan.
6. Klik tombol **Terbitkan (*Publish*)**.

> 📸 **[IMAGE: Tangkapan layar daftar Kegiatan Madrasah dan formulir pengisian kegiatan baru]**

---

## BAB 4: Mengedit Halaman Profil & Statis (Menu: Laman / Pages & Elementor)

Halaman (*Pages*) adalah konten statis yang jarang berubah setiap hari, seperti **Visi & Misi**, **Sejarah Madrasah**, **Struktur Organisasi**, **Kontak Kami**, dan **Beranda (Halaman Utama)**.

### 4.1. Membedakan Halaman Biasa dan Halaman Elementor
Di daftar menu **Laman (*Pages*) > Semua Laman**, perhatikan keterangan di samping judul halaman:
* **Halaman Biasa**: Tidak ada tulisan *— Elementor*. Bisa diedit langsung dengan klik nama judulnya.
* **Halaman Elementor**: Terdapat tanda tebal *— Elementor*. Halaman seperti ini **harus diedit melalui tombol "Sunting dengan Elementor"** agar susunan desainnya tidak rusak.

> 📸 **[IMAGE: Tangkapan layar daftar Semua Laman yang memperlihatkan perbedaan label halaman biasa vs label Elementor]**

---

### 4.2. Cara Mengedit Halaman dengan Elementor
Gunakan panduan ini jika Anda ingin mengubah teks di Halaman Utama (Beranda), Sambutan Kepala Madrasah, atau halaman promosi lainnya:

1. Buka menu **Laman** > **Semua Laman**.
2. Cari halaman yang ingin diedit (misal: `Beranda` atau `Profil`).
3. Klik tautan **Sunting dengan Elementor (*Edit with Elementor*)**.
4. Halaman editor Elementor akan terbuka dengan tampilan visual langsung:
   * **Bilah Kiri**: Panel widget (alat) Elementor.
   * **Layar Kanan**: Tampilan website persis seperti aslinya.

> 📸 **[IMAGE: Tangkapan layar antarmuka editor Elementor yang membagi panel alat kiri dan pratinjau halaman kanan]**

---

### 4.3. Mengubah Teks atau Tulisan di Elementor
1. Klik langsung pada teks atau paragraf yang ingin Anda ubah di layar sebelah kanan.
2. Di panel sebelah kiri, kotak teks **Judul (*Title*)** atau **Penyunting Teks (*Text Editor*)** akan terbuka otomatis.
3. Hapus atau ketik teks baru pada kotak di panel kiri tersebut.  
   *(Catatan: Sebaiknya ketik di panel kiri agar format kode tidak berantakan).*

> 📸 **[IMAGE: Tangkapan layar proses klik teks di layar pratinjau dan mengubah isinya di panel sebelah kiri]**

---

### 4.4. Mengganti Gambar atau Foto Kepala Madrasah di Elementor
1. Klik foto yang ingin diganti di layar sebelah kanan.
2. Perhatikan panel kiri, klik kotak thumbnail foto tersebut.
3. Jendela Pustaka Media akan terbuka.
4. Unggah foto baru dari laptop atau pilih foto yang sudah ada.
5. Klik tombol biru **Sisipkan Media (*Insert Media*)**.

> 📸 **[IMAGE: Tangkapan layar panel kiri Elementor saat mengganti gambar dengan tombol Choose Image]**

---

### 4.5. Mengubah Link Tautan pada Tombol (Button)
1. Klik tombol yang ingin diubah (misalnya tombol *"Daftar Sekarang"* atau *"Unduh Brosur"*).
2. Pada panel kiri di bagian **Tautan (*Link*)**, tempelkan (*paste*) alamat web baru yang dituju (misal: link Google Form PPDB atau link nomor WhatsApp).
3. Klik ikon gerigi kecil di samping kolom tautan, beri centang **Buka di jendela baru (*Open in new window*)** jika menuju ke web di luar madrasah.

---

### 4.6. Menyimpan Perubahan di Elementor
> **WAJIB:** Setelah selesai mengedit, selalu klik tombol hijau **PERBARUI (*UPDATE*)** di pojok kiri bawah panel Elementor.  
> Jika Anda langsung menutup peramban tanpa mengklik Perbarui, perubahan yang Anda buat tidak akan tersimpan!

Untuk kembali ke dashboard WordPress:  
* Klik ikon garis tiga (menu) di pojok kiri atas panel Elementor > klik **Keluar (*Exit to WordPress*)**.

> 📸 **[IMAGE: Tangkapan layar tombol hijau Update di pojok kiri bawah layar Elementor]**

---

## BAB 5: Mengatur Gambar Banner Header (Menu: Header Arsip)

Website MTs ini dilengkapi fitur khusus bernama **Header Arsip** untuk mengatur banner foto pemandangan/gedung sekolah di bagian paling atas halaman daftar Prestasi, Fasilitas, Kegiatan, serta Halaman Standar.

### 5.1. Membuka Menu Pengaturan Header Arsip
1. Pada bilah menu kiri dashboard admin, cari dan klik menu **Header Arsip** (dengan ikon gambar di urutan menu tengah).
2. Anda akan melihat halaman pengaturan yang berisi beberapa tab/kotak opsi:
   * **Header Arsip Prestasi**
   * **Header Arsip Fasilitas**
   * **Header Arsip Kegiatan**
   * **Header Halaman Umum / Default**

> 📸 **[IMAGE: Tangkapan layar menu "Header Arsip" di bilah menu kiri dan tampilan opsi pengaturannya]**

---

### 5.2. Mengganti Foto Banner Latar Belakang & Judul Header
1. Pilih bagian yang ingin diubah (contoh: bagian **Header Prestasi**).
2. **Gambar Latar Belakang (*Background Image*)**:
   * Jika sudah ada gambar lama, klik tombol **Hapus (*Remove*)** atau **Edit**.
   * Klik tombol **Tambah Gambar (*Add Image*)** untuk mengunggah banner baru (pilih foto lanskap/melebar dengan resolusi minimal 1920x600 piksel).
3. **Judul Utama (*Title*)**:
   * Tuliskan judul banner yang tampil di atas gambar (misal: *Galeri Prestasi MTs Hebat*).
4. **Deskripsi Singkat (*Subtitle/Description*)**:
   * Tuliskan kalimat pengantar singkat (misal: *Daftar pencapaian dan kejuaraan siswa-siswi madrasah tingkat regional hingga nasional*).
5. Setelah selesai mengatur, klik tombol biru **Simpan Pengaturan (*Update / Save Changes*)** di pojok kanan bawah atau atas halaman.

> 📸 **[IMAGE: Tangkapan layar formulir penggantian banner background image dan isian judul pada menu Header Arsip]**

---

## BAB 6: Mengelola Berkas Media (Foto & Dokumen PDF)

Pustaka Media (*Media Library*) adalah gudang penyimpanan semua foto, video pendek, brosur, dan dokumen PDF pengumuman madrasah.

### 6.1. Mengunggah Foto Dokumentasi Baru
1. Di menu bilah kiri, klik **Media** > **Tambah Baru (*Add New Media File*)**.
2. Seret (*drag & drop*) file foto dari komputer Anda ke dalam kotak putus-putus, atau klik tombol **Pilih Berkas (*Select Files*)**.
3. Tunggu hingga bilah progres warna biru selesai mengunggah 100%.

> 📸 **[IMAGE: Tangkapan layar area unggah berkas Media dengan kotak drop-zone berkas]**

---

### 6.2. Mengunggah Dokumen PDF & Mengambil Tautan Unduhan (*Link Download*)
Cara ini sering digunakan untuk membagikan file PDF Brosur PPDB, Kalender Akademik, SK Pembagian Tugas, atau Jadwal Ujian kepada wali murid dan siswa:

1. Klik **Media** > **Tambah Baru**.
2. Unggah file dokumen berformat `.pdf`.
3. Setelah proses unggah selesai, klik file PDF tersebut untuk membuka jendela **Rincian Lampiran (*Attachment Details*)**.
4. Di sisi sebelah kanan, cari baris **Salin URL ke papan klip (*Copy URL to clipboard*)** atau **Tautan Berkas (*File URL*)**.
5. Klik tombol **Salin URL** tersebut.
6. Tautan (*link*) ini sekarang bisa Anda tempelkan (*paste*) ke tombol di website, ke artikel pengumuman, atau langsung dibagikan ke grup WhatsApp wali murid.

> 📸 **[IMAGE: Tangkapan layar jendela rincian berkas PDF saat mengklik tombol Salin URL ke papan klip]**

---

### 6.3. Standar Ukuran Foto yang Disarankan (Agar Website Tidak Lemot)
Foto langsung dari kamera ponsel pintar (*smartphone*) saat ini umumnya berukuran 4 MB hingga 10 MB per foto. Jika diunggah langsung tanpa dikecilkan, website madrasah akan sangat lambat dibuka dari ponsel wali murid.

> 💡 **Panduan Ukuran Foto yang Dianjurkan:**
> * **Ukuran File Maksimal**: Usahakan di bawah **300 KB – 500 KB** per foto.
> * **Lebar Foto untuk Berita**: Antara **800 s/d 1200 piksel** (format lanskap).
> * **Lebar Foto untuk Banner Utama**: Antara **1600 s/d 1920 piksel**.
> * **Tips Praktis untuk Pegawai Non-IT**: Sebelum diunggah ke website, Anda bisa mengompres foto secara gratis dan mudah melalui situs web seperti [tinypng.com](https://tinypng.com) atau [iloveimg.com](https://www.iloveimg.com/id/kompres-gambar). Cukup masukkan foto, download hasil kompresinya, baru diunggah ke web.

---

## BAB 7: Mengatur Menu Navigasi Website (Tampilan > Menu)

Menu navigasi adalah barisan tombol navigasi yang ada di bagian paling atas (*Header*) dan paling bawah (*Footer*) website (contoh: Beranda | Profil | Prestasi | Fasilitas | Kontak).

### 7.1. Membuka Pengaturan Menu
1. Pada menu bilah kiri, klik **Tampilan (*Appearance*)** > **Menu**.
2. Pada bagian *Pilih menu untuk diedit*, pastikan memilih menu utama (biasanya bernama `Main Menu` atau `Primary Menu`), lalu klik tombol **Pilih (*Select*)**.

> 📸 **[IMAGE: Tangkapan layar halaman Tampilan > Menu dengan daftar struktur menu aktif]**

---

### 7.2. Menambahkan Halaman Baru ke Menu
1. Perhatikan kolom sebelah kiri pada kotak **Laman (*Pages*)**.
2. Klik tab **Lihat Semua (*View All*)**.
3. Beri tanda centang pada halaman yang ingin dimunculkan di menu (misal: halaman *Ekstrakurikuler* atau *PPDB 2026*).
4. Klik tombol **Tambah ke Menu (*Add to Menu*)**.
5. Halaman tersebut akan muncul di urutan paling bawah pada kolom struktur menu di sebelah kanan.

---

### 7.3. Mengatur Urutan dan Membuat Sub-Menu (*Dropdown*)
1. Untuk memindahkan urutan: Klik dan tahan (*drag*) kotak item menu ke atas atau ke bawah sesuai urutan yang diinginkan.
2. Untuk membuat **Sub-Menu (Menu Turunan / Melayang)**:
   * Geser kotak item sedikit ke arah **kanan** di bawah menu induknya hingga posisinya terlihat menjorok ke dalam.
   * *Contoh*: Kotak *Visi Misi* dan *Struktur Organisasi* digeser ke kanan di bawah kotak *Profil*, sehingga ketika kursor pengunjung menyentuh menu *Profil*, kedua menu tadi akan muncul ke bawah (*dropdown*).
3. Setelah selesai mengatur, selalu klik tombol biru **Simpan Menu (*Save Menu*)** di pojok kanan bawah.

> 📸 **[IMAGE: Tangkapan layar penataan posisi sub-menu (indentasi ke kanan) pada struktur menu]**

---

### 7.4. Menambahkan Tautan Eksternal (Link ke Aplikasi Kemenag / RDM)
Jika ingin menambahkan tombol yang langsung membuka link luar (misal: RDM Madrasah, Emis, Simpatika, atau Akun Instagram):

1. Pada kolom kiri halaman Menu, klik bagian **Tautan Tersuai (*Custom Links*)**.
2. Pada kolom **URL**, ketik alamat lengkap (contoh: `https://rdm.namamts.sch.id`).
3. Pada kolom **Teks Tautan (*Link Text*)**, ketik nama menu yang akan tampil (contoh: `Raport Digital (RDM)`).
4. Klik **Tambah ke Menu**, lalu atur posisinya dan klik **Simpan Menu**.

> 📸 **[IMAGE: Tangkapan layar penambahan Tautan Tersuai (Custom Links) dengan URL eksternal]**

---

## BAB 8: Memeriksa Pesan Masuk dari Formulir Kontak

Website madrasah Anda dilengkapi formulir online pada halaman *"Hubungi Kami"* / *"Buku Tamu"* sehingga wali murid dan masyarakat umum dapat mengirim pertanyaan secara online.

### 8.1. Membaca Pesan yang Masuk
1. Pada menu bilah kiri, cari menu **Pesan Kontak** atau **Contact Forms** / **CFDB7** (ikon amplop atau daftar surat).
2. Klik pada nama formulir (misalnya: *Form Kontak Madrasah* atau *Buku Tamu*).
3. Anda akan melihat tabel berisi daftar pesan masuk lengkap dengan:
   * Nama Pengirim
   * Nomor WhatsApp / Telepon
   * Alamat Email
   * Subjek & Tanggal Pengiriman
4. Klik pada nama pengirim untuk membaca isi pesan selengkapnya.

> 📸 **[IMAGE: Tangkapan layar tabel daftar pesan formulir masuk dari pengunjung website]**

---

### 8.2. Mengunduh (*Export*) Data Pesan ke File Excel
Jika pengelola ingin merekap pertanyaan atau data pendaftar tamu madrasah:
1. Masih di halaman daftar pesan formulir, perhatikan tombol di atas tabel: **Export to CSV** atau **Download Excel**.
2. Klik tombol tersebut, maka komputer Anda akan langsung mengunduh file spreadsheet yang dapat dibuka dengan Microsoft Excel.

> 📸 **[IMAGE: Tangkapan layar tombol Export to CSV untuk mengunduh rekap pesan ke Excel]**

---

## BAB 9: Tips Penting & Pemecahan Masalah (Troubleshooting)

### 9.1. Mengapa Perubahan di Web Belum Terlihat di HP/Browser? (*Hapus Cache*)
Seringkali setelah mengedit berita atau mengganti foto di website, saat dicek di handphone tampilannya masih menampilkan versi lama. Hal ini wajar karena sistem website mengaktifkan fitur percepatan penyimpanan sementara (*LiteSpeed Cache*).

**Cara Mengatasinya (Sangat Mudah):**
1. Di bilah menu paling atas (*Top Admin Bar* WordPress), cari ikon **Piksel Hijau / Gambar Petir (LiteSpeed Cache)**.
2. Arahkan kursor ke ikon tersebut hingga muncul menu dropdown.
3. Klik opsi **Hapus Semua (*Purge All*)**.
4. Buka kembali website madrasah di browser HP Anda, lalu lakukan *Refresh* (muat ulang halaman). Konten terbaru akan langsung muncul.

> 📸 **[IMAGE: Tangkapan layar menu LiteSpeed Cache di bilah atas saat memilih opsi Purge All]**

---

### 9.2. Tips Mengisi Judul & Keterangan untuk Google (Rank Math SEO)
Website madrasah Anda telah dilengkapi modul **Rank Math SEO** agar berita dan profil madrasah mudah dicari oleh masyarakat di Google.

Saat Anda menulis Berita (Pos) atau Halaman:
1. Di bawah lembar penulisan atau di bilah kanan atas, klik tombol skor **Rank Math** (ikon angka persentase merah/kuning/hijau).
2. Klik tombol **Sunting Cuplikan (*Edit Snippet*)**.
3. Periksa tampilan pratinjau Google:
   * **Judul Judul (*SEO Title*)**: Buat judul yang rapi (maksimal 60 karakter).
   * **Deskripsi Singkat (*Meta Description*)**: Tulis 1-2 kalimat ringkasan yang menarik agar orang tertarik mengklik tautan madrasah saat mencari di Google.
4. Pastikan teks deskripsi tidak terlalu panjang (hindari warna merah pada bar indikator).

> 📸 **[IMAGE: Tangkapan layar jendela Edit Snippet Rank Math SEO dengan kolom judul dan deskripsi Google]**

---

### 9.3. Tips Keamanan Sederhana untuk Admin & Guru Madrasah
1. **Jangan Membagikan Satu Akun untuk Bersama**:  
   Buat akun terpisah untuk masing-masing guru atau staf tata usaha dengan hak akses sesuai peran (misal: *Penulis/Author* hanya bisa menulis berita, sedangkan *Administrator* memegang kendali penuh).
2. **Hindari Sandi yang Mudah Ditebak**:  
   Jangan gunakan kata sandi seperti `admin123`, `mts12345`, `bismillah`, atau tanggal lahir sekolah. Gunakan kombinasi kata unik minimal 10 karakter.
3. **Waspadai File Dokumen Asing**:  
   Hanya unggah gambar berekstensi resmi (`.jpg`, `.jpeg`, `.png`, `.webp`) dan dokumen resmi (`.pdf`, `.docx`). Jangan pernah mengunggah file berekstensi `.exe`, `.zip`, atau `.php` dari sumber yang tidak jelas.
4. **Logout Setelah Selesai**:  
   Selalu pastikan Anda telah keluar dari dashboard admin sebelum meninggalkan komputer kantor.

---

### 9.4. Ringkasan Tombol Penting
| Nama Tombol / Istilah | Letak | Fungsi Utama |
| :--- | :--- | :--- |
| **Terbitkan (*Publish*)** | Pojok kanan atas editor pos | Meluncurkan tulisan baru agar bisa dibaca masyarakat di internet |
| **Perbarui (*Update*)** | Pojok kanan atas (Gutenberg) / Bawah kiri (Elementor) | Menyimpan segala perubahan yang baru saja diedit |
| **Simpan Konsep (*Save Draft*)** | Pojok kanan atas editor | Menyimpan tulisan sementara (belum tayang ke publik) |
| **Purge All (LiteSpeed)** | Bilah navigasi atas (ikon petir) | Membersihkan cache website agar editan terbaru langsung terlihat |
| **Tetapkan Gambar Unggulan** | Bilah sisi kanan editor artikel | Memilih foto sampul utama berita / kegiatan |

---

## BAB 10: Informasi Pengembang (Developer) & Bantuan Teknis

Apabila terjadi kendala sistem di luar panduan operasional ini (misalnya: website tidak bisa dibuka, terjadi kesalahan kode/database, atau butuh penambahan modul baru), silakan menghubungi tim pengembang website madrasah melalui kontak di bawah ini:

### 10.1. Data Pengembang Website
| Informasi | Keterangan Kontak |
| :--- | :--- |
| **Nama Pengembang / Agensi** | `[Isikan Nama Developer / Tim Pengembang]` |
| **Nama Narahubung (Contact Person)** | `[Nama PIC Developer]` |
| **Nomor WhatsApp / Telepon** | `[Isikan Nomor Telepon / WA]` |
| **Alamat Email Resmi** | `[Isikan Email Developer / Support]` |
| **Website Resmi Pengembang** | `[Isikan Website Portofolio / Agensi]` |
| **Alamat Kantor / Domisili** | `[Isikan Alamat Singkat]` |

---

### 10.2. Layanan Pemeliharaan & Masa Garansi (*Maintenance & SLA*)
* **Status Layanan**: `[Masa Garansi / Kontrak Maintenance Aktif / On-Call Support]`
* **Masa Berlaku Dukungan**: `[Tanggal Mulai] s/d [Tanggal Berakhir]`
* **Waktu Operasional Layanan**: Senin – Jumat, pukul `08.00 – 17.00 WIB` *(atau sesuaikan)*.
* **Cakupan Bantuan Teknis**:
  * Penanganan error server / hosting / domain.
  * Pemulihan cadangan data (*Restore Backup*) jika terjadi kehilangan data tak terduga.
  * Konsultasi teknis fitur website.

---

### 10.3. Prosedur Pelaporan Kendala Teknis (*Trouble Report*)
Agar pengembang dapat menyelesaikan masalah dengan cepat dan tepat sasaran, pihak madrasah diharapkan melaporkan kendala dengan format berikut:
1. **Tangkapan Layar (*Screenshot*) Kendala**: Ambil foto layar laptop atau pesan error yang muncul.
2. **Alamat Halaman (URL)**: Salin link halaman yang mengalami error (contoh: `https://namamts.sch.id/prestasi`).
3. **Kronologi Singkat**: Jelaskan apa yang dilakukan sebelum error terjadi (contoh: *"Setelah mengunggah file foto berukuran 10MB, tombol simpan tidak merespons"*).
4. Kirimkan laporan melalui grup WhatsApp koordinasi atau email dukungan resmi pengembang.

---

*Manual ini disusun khusus untuk pengelolaan operasional website MTs. Simpan dokumen ini atau cetak menjadi buku panduan meja kerja staf/guru pengelola website madrasah.*
