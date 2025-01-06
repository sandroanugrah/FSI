<?php
include '../config/databases.php';

if (!isset($_SESSION['ID_Admin'])) {
    setPesanKesalahan("Silahkan login terlebih dahulu!");
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Data Struktur Organisasi</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/1.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- SIDEBAR START -->
            <?php include '../partials/sidebar.php'; ?>
            <!-- SIDEBAR END -->

            <div class="layout-page">
                <!-- NAVBAR START -->
                <?php include '../partials/navbar.php'; ?>
                <!-- NAVBAR END -->

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data /</span> Struktur Organisasi
                        </h4>
                        <div class="card">
                            <h5 class="card-header">Data Struktur Organisasi</h5>
                            <div style="margin: -10px 40px 10px 0px;">
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambahStrukturOrganisasi">
                                    Tambah Data
                                </button>
                            </div>
                            <div class="table-responsive text-nowrap text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengelola</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Kasubag</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $strukturOrganisasiModel = new StrukturOrganisasi($koneksi);
                                    $strukturOrganisasiInfo = $strukturOrganisasiModel->tampilkanDataStrukturOrganisasi();
                                    ?>
                                    <tbody class="table-border-bottom-0">
                                        <?php if (!empty($strukturOrganisasiInfo)) : ?>
                                            <?php $nomor = 1; ?>
                                            <?php foreach ($strukturOrganisasiInfo as $strukturOrganisasi) : ?>
                                                <tr>
                                                    <td><?php echo $nomor++; ?></td>
                                                    <td>
                                                        <?php echo $strukturOrganisasi['Nama_Admin']; ?>
                                                    </td>
                                                    <td>
                                                        <img src="../../uploads/<?php echo $strukturOrganisasi['Foto_Dosen_Organisasi']; ?>" alt="Avatar" class="rounded-circle avatar avatar-xl" />
                                                    </td>
                                                    <td>
                                                        <strong><?php echo $strukturOrganisasi['Nama_Dosen_Organisasi']; ?></strong>
                                                    </td>
                                                    <td>
                                                        <?php echo $strukturOrganisasi['Jabatan_Dosen_Organisasi']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $strukturOrganisasi['Kasubag_Organisasi']; ?>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item buttonStrukturOrganisasi" data-bs-toggle="modal" data-id="<?php echo $strukturOrganisasi['ID_Organisasi']; ?>"><i class="bx bx-edit-alt me-1"></i>Sunting</a>
                                                                <a class="dropdown-item" onclick="konfirmasiHapusStrukturOrganisasi(<?php echo $strukturOrganisasi['ID_Organisasi']; ?>)"><i class="bx bx-trash me-1"></i>Hapus</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-danger fw-bold">Tidak ada data struktur organisasi!</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- FOOTER START -->
                        <?php include '../partials/footer.php'; ?>
                        <!-- FOOTER END -->

                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL START -->
        <?php include '../partials/add-modal-struktur-organisasi.php'; ?>
        <?php include '../partials/edit-modal-struktur-organisasi.php'; ?>
        <!-- MODAL END -->

        <!-- CORE JS START -->
        <script src="../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="../assets/vendor/js/menu.js"></script>
        <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/dashboards-analytics.js"></script>
        <script src="../assets/js/value-struktur-organisasi.js"></script>
        <script src="../assets/js/delete-struktur-organisasi.js"></script>
        <!-- CORE JS END -->

        <!-- ALERT -->
        <?php include '../partials/alert.php' ?>
</body>

</html>