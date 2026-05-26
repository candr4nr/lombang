<?php
include 'config.php'; // koneksi ke database

// Cek apakah pengguna sudah login
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}
// Ambil data dari tabel berita
$sql = "SELECT * FROM berita ORDER BY tanggal ASC";
$result = $conn->query($sql);

// Tambah Berita Baru
if (isset($_POST['simpan'])) {
    $judul_berita = $_POST['judul_berita'];
    $kat_berita = $_POST['kat_berita'];
    $penulis_berita = $_POST['penulis_berita'];
    $isi_berita = $_POST['isi_berita'];
    $gambar_berita = $_FILES['gambar_berita']['name'];
    $tanggal = date('Y-m-d H:i:s');

    // Upload gambar
    if ($gambar_berita) {
        $target_dir = "img/uploads/";
        $target_file = $target_dir . basename($gambar_berita);
        move_uploaded_file($_FILES['gambar_berita']['tmp_name'], $target_file);
    }

    // Insert data ke database
    $stmt = $conn->prepare("INSERT INTO berita (judul_berita, kat_berita, isi_berita, penulis_berita, gambar_berita, tanggal) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $judul_berita, $kat_berita, $isi_berita, $penulis_berita, $gambar_berita, $tanggal);

    if ($stmt->execute()) {
        echo "<script>alert('Berhasil menambahkan berita!');</script>";
        echo "<script>window.location.href='berita.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan berita!');</script>";
    }

    $stmt->close();
}

// hapus Berita
if (isset($_POST['hapus'])) {
    $id_berita = $_POST['id_berita'];
    $stmt = $conn->prepare("DELETE FROM berita WHERE id_berita = ?");
    $stmt->bind_param("i", $id_berita);
    if ($stmt->execute()) {
        echo "<script>alert('Berhasil menghapus berita!');</script>";
        echo "<script>window.location.href='berita.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus berita!');</script>";
    }
    $stmt->close();
}

// Edit Berita
if (isset($_POST['edit'])) {
    $id_berita = $_POST['id_berita'];
    $judul_berita = $_POST['judul_berita'];
    $kat_berita = $_POST['kat_berita'];
    $penulis_berita = $_POST['penulis_berita'];
    $isi_berita = $_POST['isi_berita'];
    $tanggal = date('Y-m-d H:i:s');

    $gambar_lama = $_POST['gambar_lama'];
    $gambar_berita = $gambar_lama; // default

    if ($_FILES['gambar_baru']['error'] === 0) {
        $ext = strtolower(pathinfo($_FILES['gambar_baru']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed)) {
            $gambar_baru = time() . '_' . $_FILES['gambar_baru']['name'];
            $target_file = "img/uploads/" . $gambar_baru;

            if (move_uploaded_file($_FILES['gambar_baru']['tmp_name'], $target_file)) {
                $gambar_berita = $gambar_baru;
                // Optional: hapus file lama
                if (file_exists("img/uploads/" . $gambar_lama)) {
                    unlink("img/uploads/" . $gambar_lama);
                }
            }
        } else {
            echo "<script>alert('Format file tidak didukung!');</script>";
            exit;
        }
    }

    $stmt = $conn->prepare("UPDATE berita SET judul_berita = ?, kat_berita = ?, isi_berita = ?, penulis_berita = ?, gambar_berita = ?, tanggal = ? WHERE id_berita = ?");
    $stmt->bind_param("ssssssi", $judul_berita, $kat_berita, $isi_berita, $penulis_berita, $gambar_berita, $tanggal, $id_berita);

    if ($stmt->execute()) {
        echo "<script>alert('Berhasil mengedit berita!'); window.location.href='berita.php';</script>";
    } else {
        echo "<script>alert('Gagal mengedit berita!');</script>";
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

    <title>Kirim Berita</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
            <li class="nav-item active">
                <a class="nav-link collapsed" href="berita.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kirim Berita</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
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
                        <h1 class="h3 mb-0 text-gray-800">Kirim Berita</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalInput"><i class="fas fa-plus fa-sm fa-fw"></i>
                                Tambah</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Isi</th>
                                            <th>Penulis</th>
                                            <th>Gambar</th>
                                            <th>Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Isi</th>
                                            <th>Penulis</th>
                                            <th>Gambar</th>
                                            <th>Waktu</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="font-size: 12px;">
                                        <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?> <tr>
                                                    <td class="text-center"><?= htmlspecialchars($row['judul_berita']) ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($row['kat_berita']) ?></td>
                                                    <td><?= htmlspecialchars_decode(substr($row['isi_berita'], 0, 100)) ?>...</td>
                                                    <td class="text-center"><?= htmlspecialchars($row['penulis_berita']) ?></td>
                                                    <td class="text-center"><img class="mb-1" src="img/uploads/<?= htmlspecialchars($row['gambar_berita']); ?>" width="50" height="50" alt="Gambar Berita"></td>
                                                    <td class="text-center"><?= date('d-m-Y H:i', strtotime($row['tanggal']))  ?></td>
                                                    <td class="d-flex justify-content-center">
                                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                                            data-target="#modaledit<?= $row['id_berita'] ?>"><i class="fas fa-pen fa-xs fa-fw"></i></button>
                                                        <form action="#" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                                            <input type="hidden" name="id_berita" value="<?= $row['id_berita'] ?>">
                                                            <button type="submit" name="hapus" class="btn btn-sm btn-danger ml-1"><i class="fas fa-trash fa-xs fa-fw"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <!-- Modal Edit Berita-->
                                                <div class="modal fade" id="modaledit<?= $row['id_berita'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Kirim Berita</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="#" method="POST" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id_berita" value="<?= $row['id_berita'] ?>">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label for="judul">Judul Berita</label>
                                                                                <input type="text" class="form-control" id="judul" name="judul_berita" value="<?= htmlspecialchars($row['judul_berita']) ?>"
                                                                                    placeholder="Masukkan judul berita">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="kategori">Kategori</label>
                                                                                <select class="form-control" id="kategori" name="kat_berita">
                                                                                    <option value="">-- Pilih Kategori --</option>
                                                                                    <option value="Umum" <?= (isset($row['kat_berita']) && $row['kat_berita'] == 'Umum') ? 'selected' : '' ?>>Umum</option>
                                                                                    <option value="Pendidikan" <?= (isset($row['kat_berita']) && $row['kat_berita'] == 'Pendidikan') ? 'selected' : '' ?>>Pendidikan</option>
                                                                                    <option value="Kesehatan" <?= (isset($row['kat_berita']) && $row['kat_berita'] == 'Kesehatan') ? 'selected' : '' ?>>Kesehatan</option>
                                                                                    <option value="Teknologi" <?= (isset($row['kat_berita']) && $row['kat_berita'] == 'Teknologi') ? 'selected' : '' ?>>Teknologi</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label for="penulis">Penulis</label>
                                                                                <input type="text" class="form-control" name="penulis_berita" id="penulis" value="<?= htmlspecialchars($row['penulis_berita']) ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="gambar_baru">Gambar</label><br>
                                                                                <img class="mb-1" src="img/uploads/<?= htmlspecialchars($row['gambar_berita']); ?>" width="50" height="50" alt="Gambar Berita"><br>

                                                                                <input type="file" name="gambar_baru" id="gambar_baru"><br>

                                                                                <!-- Hidden input untuk gambar lama -->
                                                                                <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($row['gambar_berita']); ?>">
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label for="editor">Tulis Konten:</label>
                                                                                <textarea name="isi_berita" id="editor" rows="10"
                                                                                    class="form-control editor"><?= htmlspecialchars_decode($row['isi_berita']) ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php }
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.container-fluid -->

                <!-- Modal Input Berita-->
                <div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kirim Berita</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="judul">Judul Berita</label>
                                                <input type="text" class="form-control" name="judul_berita" id="judul"
                                                    placeholder="Masukkan judul berita">
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select class="form-control" name="kat_berita" id="kategori">
                                                    <option value="">-- Pilih Kategori --</option>
                                                    <option value="Umum">Umum</option>
                                                    <option value="Pendidikan">Pendidikan</option>
                                                    <option value="Kesehatan">Kesehatan</option>
                                                    <option value="Teknologi">Teknologi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="penulis">Penulis</label>
                                                <input type="text" class="form-control" name="penulis_berita" id="penulis"
                                                    placeholder="Masukkan nama penulis">
                                            </div>
                                            <div class="form-group">
                                                <label for="gambar">Gambar</label>
                                                <input type="file" class="form-control-file" name="gambar_berita" id="gambar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="editor">Tulis Konten:</label>
                                                <textarea name="isi_berita" id="editor" rows="10"
                                                    class="form-control editor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editors = document.querySelectorAll('.editor');
            editors.forEach((el) => {
                CKEDITOR.replace(el);
            });
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>