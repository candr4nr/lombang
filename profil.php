<?php
include 'config.php'; // koneksi ke database

// Cek apakah pengguna sudah login
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Ambil data visi misi
$query = "SELECT * FROM profil WHERE id_profil = 1";
$result = mysqli_query($conn, $query);

// Edit profil desa
if (isset($_POST['edit'])) {
    $id_profil = $_POST['id_profil'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $alamat = $_POST['alamat'];
    $tanggal = date('Y-m-d H:i:s');

    $gambar_lama = $_POST['gambar_lama'];
    $gambar_struktur = $gambar_lama; // default

    if ($_FILES['gambar_baru']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['gambar_baru']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed)) {
            $gambar_baru = time() . '_' . $_FILES['gambar_baru']['name'];
            $target_file = "img/struktur/" . $gambar_baru;

            if (move_uploaded_file($_FILES['gambar_baru']['tmp_name'], $target_file)) {
                $gambar_struktur = $gambar_baru;
                // Optional: hapus file lama
                if (file_exists("img/struktur/" . $gambar_lama)) {
                    unlink("img/struktur/" . $gambar_lama);
                }
            }
        } else {
            echo "<script>alert('Format file tidak didukung!');</script>";
            exit;
        }
    }

    $stmt = $conn->prepare("UPDATE profil SET visi = ?, misi = ?, alamat = ?, gambar_struktur = ?, tanggal = ? WHERE id_profil = ?");
    $stmt->bind_param("sssssi", $visi, $misi, $alamat, $gambar_struktur, $tanggal, $id_profil);

    if ($stmt->execute()) {
        echo "<script>alert('Berhasil mengedit profil desa!'); window.location.href='profil.php';</script>";
    } else {
        echo "<script>alert('Gagal mengedit profil desa!');</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profil Desa</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
                .sidebar{
            background-color: #112D4E;
        }
        .sidebar-brand-icon, .nav-item i, .nav-item span{
            color: #F9F7F7;
        }

        #sidebarToggleTop i{
            color: #112D4E;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    LOMBANG
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="berita.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kirim Berita</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="profil.php">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Profil Desa</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Update Profil Desa</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Profil Desa</h6>
                                </div>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <form action="#" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_profil" value="<?= $row['id_profil'] ?>">
                                            <div class="row m-3">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="visi"><strong>Visi</strong></label>
                                                        <textarea type="text" class="form-control" id="visi" name="visi"
                                                            style="height: 150px;"><?= htmlspecialchars($row['visi']) ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gambar_baru"><strong>Struktur Desa</strong></label><br>
                                                        <img class="mb-1" src="img/struktur/<?= htmlspecialchars($row['gambar_struktur']); ?>" width="50" height="50" alt="Gambar Berita"><br>

                                                        <input type="file" name="gambar_baru" id="gambar_baru"><br>

                                                        <!-- Hidden input untuk gambar lama -->
                                                        <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($row['gambar_struktur']); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="misi"><strong>Misi</strong></label>
                                                        <textarea type="text" class="form-control" name="misi" id="misi"
                                                            style="height: 150px;"><?= htmlspecialchars($row['misi']) ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat"><strong>Alamat Desa</strong></label>
                                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                                            placeholder="Masukkan Alamat Desa" value="<?= htmlspecialchars($row['alamat']) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mx-4 mb-4">
                                                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>


                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; KKN UNWIR 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

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