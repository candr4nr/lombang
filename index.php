<?php 
// Include config file
require_once 'config.php'; // pastikan koneksi tersedia

// ambil data visi dan misi dari database
$query = "SELECT * FROM profil WHERE id_profil = 1"; // ganti dengan query yang sesuai
$result = $conn->query($query);

// Pagination
$limit = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Ambil data
$sql = "SELECT * FROM berita ORDER BY tanggal DESC LIMIT $start, $limit";
$result = $conn->query($sql);

// Total halaman
$totalResult = $conn->query("SELECT COUNT(*) AS total FROM berita");
$row = $totalResult->fetch_assoc();
$totalPages = ceil($row['total'] / $limit);

// ambil data profil desa
$sqlProfil = "SELECT * FROM profil WHERE id_profil = 1";
$resultProfil = $conn->query($sqlProfil);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Desa Lombang</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- source leaflet js -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        

        body::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, and Opera */
        }

        .navbar-custom {
            background-color: transparent !important;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            transition: background-color 0.3s ease;
        }

        .navbar-custom.scrolled {
            background-color: #112D4E !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand, .nav-link{
            color: #F9F7F7 !important;
        }

        .btn-masuk{
            background-color: #F9F7F7;
            color: #112D4E;
        }

        .btn-masuk:hover {
            background-color: #112D4E;
            color: #F9F7F7;
        }

        .btn-lihat{
            background-color: #112D4E;
            color: #F9F7F7;
        }

        .hero-section {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        .hero-section::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            /* hitam dengan transparansi 50% */
            z-index: 1;
        }

        .hero-section img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .hero-text {
            color: #F9F7F7;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            z-index: 9;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.8);
        }

        .section-content {
            padding: 80px 20px;
            background-color: #F9F7F7;
        }

        .section-content h2{
            color: #112D4E;
            font-weight: bold;
        }

        .embed-16by9-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* Rasio 16:9 = 9/16 = 0.5625 */
            overflow: hidden;
        }

        .embed-16by9-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Gambar tetap memenuhi kotak */
        }

        .card{
            background-color: #ffffff;
        }
        .card-title{
            color: #112D4E;
            font-weight: bold;
            font-size: 16px;
        }

        .card-body p{
            color: black;
            font-size: 12px;
        }

        .pagination .page-item.active .page-link {
            background-color: #112D4E;
        }
        .page-link{
            color: #112D4E;
        }
        .page-link:hover{
            color: #3F72AF;
        }

        #mapid {
            height: 400px;
        }
        .section-footer {
            background-color: #112D4E;
            color: #F9F7F7;
            justify-content: center;
            align-items: center;
        }

    </style>

</head>

<body id="page-top">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#"><strong>Desa Lombang</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Profil Desa</a>
                    </li>
                </ul>
                <a href="login.php" type="button" class="btn btn-masuk ml-xl-2">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section with Image and Centered Text -->
    <section class="hero-section">
        <img src="img/balaidesa.png" alt="Background">
        <div class="hero-text">
            <h1 class="display-4"><strong>Selamat Datang di Desa Lombang</strong></h1>
            <p class="lead">Website Resmi Desa Lombang</p>
        </div>
    </section>
    <section class="section-content" id="berita">
        <div class="container">
            <h2 class="mb-4 text-center">Berita Terbaru</h2>
            <div class="row">
                <!-- loop data berita baru -->
                    <?php while($data = $result->fetch_assoc()):
                        $judul_berita = htmlspecialchars($data['judul_berita']);
                        $isi_berita = htmlspecialchars_decode($data['isi_berita']);
                        $gambar_berita = htmlspecialchars($data['gambar_berita']);
                        $tanggal = htmlspecialchars($data['tanggal']);
                        $penulis_berita = htmlspecialchars($data['penulis_berita']);
                    ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card shadow border-0">
                        <div class="embed-16by9-wrapper">
                            <img src="img/uploads/<?= $gambar_berita ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= substr($judul_berita, 0, 30) ?>...</h5>
                            <p class="card-text"><?= substr($isi_berita, 0, 100) ?>...</p>
                            <a href="detail_berita.php?id=<?php echo $data['id_berita']; ?>" class="btn btn-lihat">Lihat</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation example" class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php if($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">&laquo;</a></li>
            <?php endif; ?>

            <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php if($page == $i) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">&raquo;</a></li>
            <?php endif; ?>
                </ul>
            </nav>
        </div>
        
    </section>
    <section class="section-content" id="tentang">
        <div class="container">
            <h2 class="mb-4 text-center">Tentang Desa Lombang</h2>
            <?php 
                if ($resultProfil->num_rows > 0) {
                    // Output data of each row
                    while($row = $resultProfil->fetch_assoc()) {
            ?>
            <div class="row">
                <div class="col">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title text-center">Visi</h5>
                            <p class="card-text text-justify"><?= htmlspecialchars($row['visi']) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="card-title text-center">Misi</h5>
                            <p class="card-text text-justify"><?= htmlspecialchars($row['misi']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <h2 class="text-center">Struktur Desa</h2>
                    <img src="img/struktur/<?= htmlspecialchars($row['gambar_struktur']); ?>" alt="" class="img-fluid mx-auto d-block">
                </div>
            </div> 
        </div>
        <div class="container mt-3">
            <h2 class="mb-2 text-center">Peta Desa</h2>
            <div class="embed-responsive embed-responsive-16by9">
                <?= $row['alamat']  ?>
            </div>
        </div>
        <?php 
                    }
                }?>
    </section>
    <section class="section-footer" id="footer">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Desa Lombang. All rights reserved.</p>
            <p>Developed by <a href="#" class="text-primary">KKN UNWIR 2025</a></p>
        </div>

    </section>


    <!-- navbar scrolled -->
    <script>
        window.addEventListener('scroll', function () {
            var navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>