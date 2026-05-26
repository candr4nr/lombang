-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Jul 2025 pada 17.59
-- Versi server: 5.7.33
-- Versi PHP: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lombang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `kat_berita` varchar(100) NOT NULL,
  `isi_berita` text NOT NULL,
  `gambar_berita` varchar(255) NOT NULL,
  `penulis_berita` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `kat_berita`, `isi_berita`, `gambar_berita`, `penulis_berita`, `tanggal`) VALUES
(6, 'Banjir Rendam Beberapa Wilayah Jakarta, Warga Diimbau Tetap Waspada', 'Umum', '<p>Hujan deras yang mengguyur wilayah Jakarta sejak dini hari mengakibatkan sejumlah kawasan terendam banjir. Berdasarkan data dari BPBD DKI Jakarta, ketinggian air bervariasi antara 30 hingga 100 cm, terutama di wilayah Jakarta Timur dan Jakarta Barat. Beberapa ruas jalan protokol pun mengalami kemacetan parah akibat genangan air.</p>\r\n\r\n<p>Pihak berwenang telah menurunkan personel gabungan dari Dinas Sumber Daya Air, Damkar, dan Satpol PP untuk membantu proses evakuasi dan penyedotan air. Hingga siang hari, tercatat lebih dari 200 warga telah dievakuasi ke tempat pengungsian yang telah disiapkan oleh pemerintah daerah. Sementara itu, beberapa sekolah dan perkantoran menghentikan aktivitas sementara.</p>\r\n\r\n<p>Gubernur DKI Jakarta mengimbau masyarakat untuk tetap waspada dan mengikuti informasi cuaca dari BMKG. Masyarakat juga diminta untuk tidak membuang sampah sembarangan yang bisa menyumbat saluran air. Pemerintah daerah berkomitmen terus memperbaiki sistem drainase guna mengantisipasi banjir serupa di masa mendatang.</p>\r\n', 'WhatsApp Image 2024-03-20 at 14.08.38_65ce70e9.jpg', 'Administrator', '2025-06-07 10:45:40'),
(7, 'Harga Cabai Meroket di Pasar Tradisional, Pedagang dan Konsumen Mengeluh', 'Umum', '<p>Harga cabai merah dan rawit di sejumlah pasar tradisional mengalami lonjakan tajam dalam sepekan terakhir. Di Pasar Induk Kramat Jati, harga cabai merah besar mencapai Rp90.000 per kilogram, naik signifikan dari harga sebelumnya yang berkisar Rp55.000. Sementara itu, harga cabai rawit merah bahkan tembus Rp100.000 per kilogram.</p>\r\n\r\n<p>Para pedagang mengeluhkan kenaikan harga ini karena menyebabkan penurunan daya beli masyarakat. Beberapa di antaranya mengaku harus mengurangi stok karena takut tidak laku dan mengalami kerugian. Konsumen pun merasa terbebani, terutama para ibu rumah tangga dan pelaku usaha kuliner kecil.</p>\r\n\r\n<p>Dinas Perdagangan DKI Jakarta menyatakan bahwa lonjakan harga dipicu oleh faktor cuaca ekstrem yang menghambat distribusi dari daerah penghasil. Pemerintah tengah berupaya menstabilkan harga dengan mempercepat pasokan dan meninjau jalur distribusi logistik pangan. Masyarakat diimbau tetap tenang dan tidak melakukan aksi borong.</p>\r\n', '654c97021ff67.jpg', 'Administrator', '2025-06-07 10:56:34'),
(8, 'BMKG: Waspadai Cuaca Ekstrem di Beberapa Wilayah Indonesia Pekan Ini', 'Umum', '<p>Jakarta, 12 Juni 2025 &mdash; Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) mengeluarkan peringatan dini terkait potensi cuaca ekstrem yang diperkirakan terjadi di sejumlah wilayah Indonesia sepanjang pekan ini. Cuaca ekstrem tersebut berupa hujan lebat disertai petir dan angin kencang yang dapat menyebabkan banjir, longsor, dan pohon tumbang.</p>\r\n\r\n<p>Wilayah yang diperkirakan terdampak antara lain Jawa Barat, Jawa Tengah, Sumatera Barat, Kalimantan Tengah, serta beberapa bagian Sulawesi dan Papua. BMKG meminta masyarakat agar tetap waspada dan menghindari aktivitas di luar ruangan jika tidak mendesak, terutama di daerah rawan bencana.</p>\r\n\r\n<p>Kepala BMKG, Dwikorita Karnawati, dalam konferensi pers mengatakan, &quot;Fenomena Madden-Julian Oscillation (MJO) serta suhu muka laut yang hangat turut meningkatkan potensi pembentukan awan hujan di sejumlah wilayah. Masyarakat diharapkan mengikuti perkembangan informasi cuaca secara berkala dari kanal resmi BMKG.&quot;</p>\r\n\r\n<p>Selain itu, BMKG juga mengimbau pemerintah daerah untuk menyiapkan langkah mitigasi dan penanganan cepat terhadap kemungkinan bencana hidrometeorologi. Warga juga diminta tidak menyebarkan informasi hoaks terkait bencana dan selalu mengandalkan sumber resmi.</p>\r\n\r\n<p>BMKG menyarankan masyarakat untuk mengunduh aplikasi <em>Info BMKG</em> guna mendapatkan peringatan dini dan prakiraan cuaca terkini secara langsung.</p>\r\n', 'cuaca-ekstrem-1_169.jpeg', 'Administrator', '2025-06-12 10:34:27'),
(9, 'Presiden Resmikan Tol Baru yang Menghubungkan Jakarta dan Cirebon', 'Umum', '<p>Cirebon, 12 Juni 2025 &mdash; Presiden Joko Widodo hari ini meresmikan jalan tol baru sepanjang 117 kilometer yang menghubungkan Jakarta dengan Cirebon, Jawa Barat. Peresmian dilakukan di Gerbang Tol Ciperna Timur dan disaksikan oleh Menteri PUPR Basuki Hadimuljono, Gubernur Jawa Barat Ridwan Kamil, serta sejumlah pejabat daerah dan masyarakat setempat.</p>\r\n\r\n<p>Tol yang diberi nama <em>Tol Pantura Ekspres</em> ini diharapkan dapat memangkas waktu tempuh antara kedua kota dari sebelumnya 4&ndash;5 jam menjadi hanya sekitar 2 jam. Selain meningkatkan konektivitas, tol ini juga ditujukan untuk mendukung distribusi logistik serta mendongkrak pertumbuhan ekonomi kawasan Pantura.</p>\r\n\r\n<p>&quot;Ini bukan hanya sekadar proyek infrastruktur, tapi fondasi untuk pemerataan pembangunan ekonomi. Sekarang, dari Jakarta ke Cirebon bisa lebih cepat dan lancar,&quot; ujar Presiden dalam sambutannya.</p>\r\n\r\n<p>Tol ini dilengkapi dengan fasilitas canggih seperti <em>automated toll payment</em>, rest area ramah lingkungan, serta jalur darurat dan CCTV di setiap 5 kilometer. Pihak pengelola memastikan tarif tol masih dalam tahap evaluasi dan akan diumumkan dalam waktu dekat.</p>\r\n\r\n<p>Masyarakat menyambut baik kehadiran tol ini, terutama pengusaha UMKM dan pelaku logistik yang selama ini mengeluhkan waktu tempuh dan kemacetan di jalur Pantura lama.</p>\r\n', '626941e2c71eb.jpg', 'Administrator', '2025-06-12 10:43:17'),
(10, 'Indonesia Luncurkan Satelit Internet Pertama Buatan Dalam Negeri: SATRIA-1', 'Teknologi', '<p>Jakarta, 12 Juni 2025 &mdash; Indonesia mencetak sejarah baru dalam dunia teknologi dan telekomunikasi dengan peluncuran satelit internet pertamanya yang sepenuhnya dirancang dan dibuat oleh para insinyur dalam negeri, yakni <strong>SATRIA-1</strong> (<em>Satelit Republik Indonesia untuk Akses Internet</em>). Peluncuran dilakukan dari Pusat Antariksa Nasional Biak, Papua, dan disiarkan secara langsung melalui kanal resmi Kementerian Komunikasi dan Informatika (Kominfo).</p>\r\n\r\n<p>SATRIA-1 bertujuan untuk menyediakan akses internet berkecepatan tinggi di lebih dari 150.000 titik layanan publik seperti sekolah, puskesmas, dan kantor desa di daerah tertinggal, terdepan, dan terluar (3T). Proyek ini digagas oleh Badan Aksesibilitas Telekomunikasi dan Informasi (BAKTI) Kominfo bekerja sama dengan PT LEN Industri dan berbagai institusi pendidikan teknologi di Indonesia.</p>\r\n\r\n<p>Menteri Kominfo, Budi Arie Setiadi, menyampaikan bahwa satelit ini menjadi simbol kemandirian teknologi bangsa. &ldquo;SATRIA-1 bukan hanya alat komunikasi, tapi wujud nyata tekad Indonesia untuk menjadi pemain teknologi global,&rdquo; ujarnya.</p>\r\n\r\n<p>Satelit ini memiliki kapasitas lebih dari 150 Gbps dan menggunakan teknologi High Throughput Satellite (HTS) yang memungkinkan distribusi koneksi lebih stabil dan cepat di wilayah terpencil yang sebelumnya tidak terjangkau jaringan fiber optik.</p>\r\n\r\n<p>Peluncuran ini disambut dengan antusias oleh masyarakat dan pelaku industri digital, terutama di wilayah timur Indonesia yang selama ini mengalami keterbatasan konektivitas. Pemerintah menargetkan bahwa SATRIA-1 mulai aktif melayani publik secara penuh pada kuartal keempat tahun 2025.</p>\r\n', '077576500_1443452912-o-SATELLITE-facebook.jpg', 'Administrator', '2025-06-12 12:35:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero`
--

CREATE TABLE `hero` (
  `id_hero` int(11) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `konten` text NOT NULL,
  `img_hero` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kat_berita`
--

CREATE TABLE `kat_berita` (
  `id_kat` int(11) NOT NULL,
  `kat_berita` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kat_berita`
--

INSERT INTO `kat_berita` (`id_kat`, `kat_berita`) VALUES
(1, 'Umum'),
(2, 'Pendidikan'),
(3, 'Kesehatan'),
(4, 'Teknologi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(11) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `gambar_struktur` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_profil`, `visi`, `misi`, `gambar_struktur`, `alamat`, `tanggal`) VALUES
(1, 'Desa Lombang memiliki tekad untuk menjadi desa yang mandiri dan sejahtera dengan mengedepankan nilai-nilai religius, pelestarian lingkungan, dan penguatan ekonomi masyarakat. Visi pembangunan desa diarahkan pada peningkatan kualitas hidup warga melalui pengelolaan potensi lokal, khususnya di bidang pertanian dan usaha kecil menengah yang menjadi tulang punggung ekonomi desa.', 'Desa Lombang menjalankan sejumlah misi strategis yang meliputi peningkatan pelayanan publik yang transparan dan partisipatif, pembangunan infrastruktur dasar yang merata, pengembangan sumber daya manusia melalui pendidikan dan pelatihan, serta pelestarian budaya dan nilai-nilai keagamaan sebagai identitas desa. Selain itu, desa juga berkomitmen menjaga kelestarian lingkungan melalui program penghijauan dan pengelolaan sampah berbasis masyarakat. Seluruh upaya ini didorong dengan semangat gotong royong dan partisipasi aktif warga demi menciptakan kehidupan desa yang lebih baik, adil, dan berkelanjutan.', '1749270778_struktur desa.png', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.8719001781083!2d108.40841287355727!3d-6.410497462691385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ec1ecf4f4bde5%3A0x13684b58677e957!2sBalai%20Desa%20Lombang!5e0!3m2!1sid!2sid!4v1749541097459!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2025-06-10 07:38:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$rDqsS5LosysR9p3Nb9.65uuEGmO0b4VoTLjKq8ujbdtx3nwqAfkCO');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id_hero`);

--
-- Indeks untuk tabel `kat_berita`
--
ALTER TABLE `kat_berita`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indeks untuk tabel `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `hero`
--
ALTER TABLE `hero`
  MODIFY `id_hero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kat_berita`
--
ALTER TABLE `kat_berita`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
