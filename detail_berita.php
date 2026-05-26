<?php
// Include config file
require_once 'config.php'; // pastikan koneksi tersedia

// Cek apakah ada ID berita yang diberikan
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM berita WHERE id_berita = $id")->fetch_assoc();

$judul_berita = htmlspecialchars($data['judul_berita']);
$isi_berita = htmlspecialchars_decode($data['isi_berita']);
$gambar_berita = htmlspecialchars($data['gambar_berita']);
$tanggal = htmlspecialchars($data['tanggal']);
$penulis_berita = htmlspecialchars($data['penulis_berita']);

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

        nav {
            background-color: #112D4E;
            color: #F9F7F7;
        }

        .btn-masuk {
            background-color: #F9F7F7;
            color: #112D4E;
        }

        .btn-masuk:hover {
            background-color: #112D4E;
            color: #F9F7F7;
        }

        .embed-16by9-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            /* Rasio 16:9 = 9/16 = 0.5625 */
            overflow: hidden;
            border-radius: 8px;
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

        article p {
            text-align: justify;
            text-indent: 30px;
            font-size: 16px;
            line-height: 1.6;
        }

        .card-title h3,
        article p {
            color: black;
        }

        .berita-item {
            display: flex;
            flex-direction: row;
            font-size: 12px;
            justify-content: center;
            align-items: center;
        }

        .berita-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 10px;
        }

        #page-top {
            background-color: #F9F7F7;
        }

        .card-title h3,
        .card-body h5,
        .berita-item p,
        .bagikan-artikel {
            color: #112D4E;
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
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand text-white" href="/"><strong>Desa Lombang</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#tentang">Profil Desa</a>
                    </li>
                </ul>
                <a href="login.php" type="button" class="btn btn-masuk ml-xl-2">Masuk</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="card shadow mb-4 mt-4 border-0">
                    <div class="card-body py-4 px-5">
                        <p style="color: black;">
                            <a href="/"><i class="fas fa-fw fa-home"></i></a> / Berita Desa Lombang
                        </p>
                        <div class="card-title">
                            <h3>
                                <strong><?= $judul_berita ?></strong>
                            </h3>
                            <p><em>
                                    <?= date('d F Y', strtotime($tanggal)); ?> | <?= $penulis_berita ?>
                                </em></p>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="embed-16by9-wrapper my-2">
                            <img src="img/uploads/<?= $gambar_berita ?>">
                        </div>
                        <article>
                            <p>
                                <?= $isi_berita ?>
                            </p>
                        </article>
                        <div class="mt-4">
                            <h5 class="bagikan-artikel"><strong>Bagikan artikel ini:</strong></h5>
                            <a class="btn btn-success btn-sm mr-2"
                                href="https://api.whatsapp.com/send?text=<?= urlencode($judul_berita . ' - https://example.com/berita.php?id=' . $data['id_berita']); ?>"
                                target="_blank">
                                <i class="fab fa-fw fa-whatsapp"></i> WhatsApp
                            </a>

                            <a class="btn btn-primary btn-sm mr-2"
                                href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('https://example.com/berita.php?id=' . $data['id_berita']); ?>"
                                target="_blank">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>

                            <a class="btn btn-danger btn-sm"
                                href="https://www.instagram.com/"
                                target="_blank">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="card shadow mb-4 mt-4 border-0">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Berita Terbaru</h5>
                        <div class="dropdown-divider"></div>
                        <?php
                        // Ambil 5 berita terbaru
                        $berita_terbaru = $conn->query("SELECT * FROM berita ORDER BY tanggal DESC LIMIT 5");
                        while ($berita = $berita_terbaru->fetch_assoc()) { ?>
                            <div class="col">
                                <div class="mb-3 berita-item">
                                    <img src="img/uploads/<?= htmlspecialchars($berita['gambar_berita']) ?>"
                                        class="img-fluid mb-2" alt="<?= htmlspecialchars($berita['judul_berita']) ?>">
                                    <div class="row mx-1">
                                        <a href="detail_berita.php?id=<?= $berita['id_berita'] ?>" class="text-dark">
                                            <p><strong><?= htmlspecialchars(substr($berita['judul_berita'], 0, 30)) ?>..</strong></p>
                                        </a>
                                        <p class="text-muted"><?= date('d F Y', strtotime($berita['tanggal'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="section-footer">
        <div class="container text-center py-4">
            <p class="mb-0">© 2025 Desa Lombang. All rights reserved.</p>
            <p>Developed by <a href="#" class="text-primary">KKN UNWIR 2025</a></p>
        </div>
    </section>



    <!-- navbar scrolled -->
    <script>
        window.addEventListener('scroll', function() {
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