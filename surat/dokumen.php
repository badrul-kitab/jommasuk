<?php

include('config.php');

// Initialize the session

session_start();

$username = $_SESSION['username'];



// Check if the user is logged in, if not then redirect him to login page

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {

    header("location: login.php");

    exit;
}



$PilihanPelajar = $Biasiswa = $Asrama = $NamaPenuh = $status_biasiswa = $program = '';



// Get the student application information

$query = "SELECT * FROM pilihankursuspelajar WHERE username = '$username'";

$result = $link->query($query);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $PilihanPelajar = $row['PilihanPelajar'];

        $Biasiswa = $row['Biasiswa'];

        $Asrama = $row['Asrama'];

        $status_biasiswa = $row['StatusBiasiswa'];

        $program = $row['KursusPelajar'];
    }
}



$query = "SELECT * FROM maklumatdiripelajar WHERE username = '$username'";

$result = $link->query($query);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $NamaPenuh = $row['NamaPenuh'];
    }
}



?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="Kitab Intergrated Management System" content="" />

    <meta name="Badrul Hisham - Unit IT KITAB" content="" />

    <title>Jom Masuk Kitab!</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <link href="css/styles.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>



<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

        <!-- Navbar Brand-->

        <a class="navbar-brand ps-3" href="../index.php">Jom Masuk Kitab</a>

        <!-- Sidebar Toggle-->

        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">

            <i class="fas fa-bars"></i>

        </button>

        <!-- Navbar -->

        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>

                <!-- Profile Dropdown-->

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <li><a class="dropdown-item" href="../documentation/documentation.html">Manual Jom Masuk</a></li>

                    <li><a class="dropdown-item" href="https://wa.me/60193932471">Hubungi IT</a></li>

                    <li>

                        <hr class="dropdown-divider" />

                    </li>

                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>

                </ul>

            </li>

        </ul>

    </nav>

    <!-- Sidebar -->

    <div id="layoutSidenav">

        <div id="layoutSidenav_nav">

            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

                <div class="sb-sidenav-menu">

                    <div class="nav">

                        <!-- Sidebar Content -->

                        <div class="sb-sidenav-menu-heading">Peribadi</div>

                        <a class="nav-link" href="../index.php">

                            <div class="sb-nav-link-icon">

                                <i class="fas fa-tachometer-alt"></i>

                            </div>

                            Maklumat Diri

                        </a>

                        <div class="sb-sidenav-menu-heading">Permohonan</div>

                        <a class="nav-link" href="../kemasukan/permohonan.php">

                            <div class="sb-nav-link-icon">

                                <i class="fas fa-tachometer-alt"></i>

                            </div>

                            Permohonan Baru

                        </a>

                        <a class="nav-link" href="../kemasukan/status.php">

                            <div class="sb-nav-link-icon">

                                <i class="fas fa-tachometer-alt"></i>

                            </div>

                            Status Permohonan

                        </a>

                        <div class="sb-sidenav-menu-heading">Maklumat</div>

                        <a class="nav-link" href="dokumen.php">

                            <div class="sb-nav-link-icon">

                                <i class="fas fa-tachometer-alt"></i>

                            </div>

                            Dokumen

                        </a>

                    </div>

                    <div class="sb-sidenav-footer">

                        <div class="small">Logged in as:

                            <?php

                            echo "$NamaPenuh";

                            ?>

                        </div>

                    </div>

                </div>

            </nav>

        </div>

        <div id="layoutSidenav_content">

            <main>

                <!--main content-->

                <div class="container-fluid px-4">

                    <div class="main-body">



                        <!-- Breadcrumb -->

                        <nav aria-label="breadcrumb" class="main-breadcrumb">

                            <ol class="breadcrumb">

                                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>

                                <li class="breadcrumb-item active" aria-current="page">Senarai Dokumen</li>

                            </ol>

                        </nav>

                        <!-- /Breadcrumb -->

                        <!-- display the table based on student eligibility -->

                        <?php

                        // echo $PilihanPelajar, $Biasiswa, $Asrama;

                        // die;

                        if ($PilihanPelajar == "Terima" && $Biasiswa == "YA" && $Asrama == "YA") {

                        ?>

                            <?php

                            // echo $status_biasiswa, $program;

                            // die;

                            if ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA SYARIAH (A6171)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <!-- <tr>

                                                <th scope="row">3</th>

                                                <td>Surat Akuan Penerimaan ke KITAB</td>

                                                <td><a href='#' class="button-link" onclick="displayTerima('suratTerima.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr> -->

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA SYARIAH (A6171)</td>

                                                <td><a href="../dokumen/DS K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <!-- <tr>

                                                <th scope="row">6</th>

                                                <td>Buku Peraturan Kewangan</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr> -->

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Isi Maklumat</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA TAHFIZ AL-QURAN (A6327)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA TAHFIZ AL-QURAN (A6327)</td>

                                                <td><a href="../dokumen/DTQ K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Isi Maklumat</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA KEWANGAN (A8304)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA KEWANGAN (A8304)</td>

                                                <td><a href="../dokumen/DKE K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)</td>

                                                <td><a href="../dokumen/DPH K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA KAUNSELING (MQA/PA 14550)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA KAUNSELING (MQA/PA 14550)</td>

                                                <td><a href="../dokumen/DKA K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)</td>

                                                <td><a href="../dokumen/DPI K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)</td>

                                                <td><a href="../dokumen/DPM K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)</td>

                                                <td><a href="../dokumen/DPISI K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA SYARIAH (A6171)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA SYARIAH (A6171)</td>

                                                <td><a href="../dokumen/DS K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA TAHFIZ AL-QURAN (A6327)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA TAHFIZ AL-QURAN (A6327)</td>

                                                <td><a href="../dokumen/DTQ K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA KEWANGAN (A8304)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA KEWANGAN (A8304)</td>

                                                <td><a href="../dokumen/DKE K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)</td>

                                                <td><a href="../dokumen/DPH K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row"></th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA KAUNSELING (MQA/PA 14550)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA KAUNSELING (MQA/PA 14550)</td>

                                                <td><a href="../dokumen/DKA K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)</td>

                                                <td><a href="../dokumen/DPI K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)</td>

                                                <td><a href="../dokumen/DPM K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)</td>

                                                <td><a href="../dokumen/DPISI K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA SYARIAH (A6171)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA TAHFIZ AL-QURAN (A6327)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>


                                        </tbody>

                                    </table>

                                </div>

                            <?php

                                // echo $status_biasiswa, $program;

                                // die;

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA KEWANGAN (A8304)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>


                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>


                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA KAUNSELING (MQA/PA 14550)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>


                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>


                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>


                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">6</th>

                                                <td>Berkaitan Asrama</td>

                                                <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            }
                        } elseif ($PilihanPelajar == "Terima" && $Biasiswa == "YA" && $Asrama == "TIDAK") {

                            ?>

                            <?php

                            if ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA SYARIAH (A6171)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <!-- <tr>

                                                <th scope="row">3</th>

                                                <td>Surat Akuan Penerimaan ke KITAB</td>

                                                <td><a href='#' class="button-link" onclick="displayTerima('suratTerima.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr> -->

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA SYARIAH (A6171)</td>

                                                <td><a href="../dokumen/DS K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA TAHFIZ AL-QURAN (A6327)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA TAHFIZ AL-QURAN (A6327)</td>

                                                <td><a href="../dokumen/DTQ K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA KEWANGAN (A8304)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA KEWANGAN (A8304)</td>

                                                <td><a href="../dokumen/DKE K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)</td>

                                                <td><a href="../dokumen/DPH K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA KAUNSELING (MQA/PA 14550)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA KAUNSELING (MQA/PA 14550)</td>

                                                <td><a href="../dokumen/DKA K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)</td>

                                                <td><a href="../dokumen/DPI K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)</td>

                                                <td><a href="../dokumen/DPM K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Pertama)" && $program == "DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)</td>

                                                <td><a href="../dokumen/DPISI K1.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA SYARIAH (A6171)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA SYARIAH (A6171)</td>

                                                <td><a href="../dokumen/DS K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA TAHFIZ AL-QURAN (A6327)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA TAHFIZ AL-QURAN (A6327)</td>

                                                <td><a href="../dokumen/DTQ K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA KEWANGAN (A8304)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA KEWANGAN (A8304)</td>

                                                <td><a href="../dokumen/DKE K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)</td>

                                                <td><a href="../dokumen/DPH K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA KAUNSELING (MQA/PA 14550)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA KAUNSELING (MQA/PA 14550)</td>

                                                <td><a href="../dokumen/DKA K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)</td>

                                                <td><a href="../dokumen/DPI K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>
                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)</td>

                                                <td><a href="../dokumen/DPM K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Kedua)" && $program == "DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Dokumen Perjanjian Biasiswa DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)</td>

                                                <td><a href="../dokumen/DPISI K2.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA SYARIAH (A6171)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA TAHFIZ AL-QURAN (A6327)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>
                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA KEWANGAN (A8304)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA KAUNSELING (MQA/PA 14550)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>
                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            } elseif ($status_biasiswa == "ZPP-KITAB (Kategori Ketiga)" && $program == "DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)") {

                            ?>

                                <div class="col-md-15">

                                    <table class="table" id="surat">

                                        <thead>

                                            <tr>

                                                <th scope="col">Bil</th>

                                                <th scope="col">Surat</th>

                                                <th scope="col">Muat Turun</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <th scope="row">1</th>

                                                <td>Surat Tawaran</td>

                                                <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">2</th>

                                                <td>Surat Tawaran Biasiswa</td>

                                                <!-- <td><a href='#' onclick="popupwindow('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>',1000,700)>1)">Muat turun</a></td> -->

                                                <td><a href='#' class="button-link" onclick="displayBiasiswa('suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>'>2)">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">3</th>

                                                <td>Rayuan Biasiswa</td>

                                                <td><a href="https://forms.gle/TjD1Bi1wUiVXUntY8">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">4</th>

                                                <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                                <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                            </tr>

                                            <tr>

                                                <th scope="row">5</th>

                                                <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                                <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            <?php

                            }
                        } elseif ($PilihanPelajar == "Terima" && $Biasiswa == "TIDAK" && $Asrama == "YA") {

                            ?>

                            <div class="col-md-15">

                                <table class="table" id="surat">

                                    <thead>

                                        <tr>

                                            <th scope="col">Bil</th>

                                            <th scope="col">Surat</th>

                                            <th scope="col">Muat Turun</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <th scope="row">1</th>

                                            <td>Surat Tawaran</td>

                                            <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                        </tr>

                                        <tr>

                                            <th scope="row">2</th>

                                            <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                            <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                        </tr>

                                        <tr>

                                            <th scope="row">3</th>

                                            <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                            <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                        </tr>

                                        <tr>

                                            <th scope="row">4</th>

                                            <td>Berkaitan Asrama</td>

                                            <td><a href="https://form.jotform.com/halehwalpelajar_alumni/asrama-kolej-islam-teknologi-antara">Muat turun</a></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        <?php

                        } elseif ($PilihanPelajar == "Terima" && $Biasiswa == "TIDAK" && $Asrama == "TIDAK") {

                        ?>

                            <div class="col-md-15">

                                <table class="table" id="surat">

                                    <thead>

                                        <tr>

                                            <th scope="col">Bil</th>

                                            <th scope="col">Surat</th>

                                            <th scope="col">Muat Turun</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <th scope="row">1</th>

                                            <td>Surat Tawaran</td>

                                            <td><a href='#' class="button-link" onclick="displayTawaran('suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>'>1)">Muat turun</a></td>

                                        </tr>

                                        <tr>

                                            <th scope="row">2</th>

                                            <td>Dokumen Berkaitan Jabatan Pengurusan Akademik</td>

                                            <td><a href="../dokumen/Dokumen-JPA.pdf">Muat turun</a></td>

                                        </tr>

                                        <tr>

                                            <th scope="row">3</th>

                                            <td>Dokumen Berkaitan Jabatan Bendahari</td>

                                            <td><a href="../dokumen/BUKU PERATURAN KEWANGAN (PELAJAR)-BARU.pdf">Muat turun</a></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        <?php

                        } else {

                        ?>

                            <div class="col-md-15">

                                <table class="table" id="surat">

                                    <thead>

                                        <tr>

                                            <th scope="col">Bil</th>

                                            <th scope="col">Surat</th>

                                            <th scope="col">Muat Turun</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <th scope="row">1</th>

                                            <td>Tiada</td>

                                            <td>Tiada</td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        <?php

                        }

                        ?>

                        <!-- /display the table based on student eligibility -->

            </main>

            <!-- Footer -->

            <footer class="py-4 bg-light mt-auto">

                <div class="container-fluid px-4">

                    <div class="d-flex align-items-center justify-content-between small">

                        <div class="text-muted">Copyright &copy; Jommasuk 2023</div>

                        <div>

                            <a href="#">Privacy Policy</a>

                            &middot;

                            <a href="#">Terms &amp; Conditions</a>

                        </div>

                    </div>

                </div>

            </footer>

            <!-- /Footer -->

        </div>

        <script>
            function displayBiasiswa(suratB) {

                // alert(suratB);

                window.open(suratB, "_blank", "width=1000,height=700");

            }
        </script>

        <script>
            function displayTawaran(suratT) {

                // alert(suratB);

                window.open(suratT, "_blank", "width=1000,height=700");

            }
        </script>

        <script>
            function displayTerima(suratTerima) {

                // alert(suratB);

                window.open(suratTerima, "_blank", "width=1000,height=700");

            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <script src="js/scripts.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script src="assets/demo/chart-area-demo.js"></script>

        <script src="assets/demo/chart-bar-demo.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

        <script src="js/datatables-simple-demo.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>







</body>



</html>