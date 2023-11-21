<?php

use PgSql\Result;

include('config.php');
// Initialize the session
session_start();
$username = $_SESSION['username'];

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /login.php");
    exit;
}

$nama_pelajar = $jumlah_terima = $jumlah_tolak = $jumlah = '';
$intake = $modProg = '';
$jumlah_terima_syariah = $jumlah_tolak_syariah = $jumlah_syariah = $jumlah_terima_tahfiz  = $jumlah_tolak_tahfiz = $jumlah_tahfiz = $jumlah_terima_kewangan = $jumlah_tolak_kewangan = $jumlah_kewangan = '';
$jumlah_terima_halal = $jumlah_tolak_halal = $jumlah_halal = $jumlah_terima_kaunseling = $jumlah_tolak_kaunseling = $jumlah_kaunseling = $jumlah_terima_islam = $jumlah_tolak_islam = $jumlah_islam = '';
$jumlah_terima_muamalat = $jumlah_tolak_muamalat = $jumlah_muamalat = $jumlah_terima_sosial = $jumlah_tolak_sosial = $jumlah_sosial = '';
$jumlah_sijilTahfiz = $jumlah_terima_sijilTahfiz = $jumlah_tolak_sijilTahfiz = $jumlah_sijilBahasa = $jumlah_terima_sijilBahasa = $jumlah_tolak_sijilBahasa = '';

// Get the information
$query = "SELECT NamaPenuh FROM maklumatdiripelajar WHERE username = '$username'";
$result = $link->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nama_pelajar = $row['NamaPenuh'];
    }
}

$queryIntake = "SELECT KemasukanPelajar FROM pilihankursuspelajar WHERE username = '$username'";
$resultIntake = $link->query($queryIntake);
if ($resultIntake->num_rows > 0) {
    while ($intakerow = $resultIntake->fetch_assoc()) {
        $intake = $intakerow['$KemasukanPelajar'];
        // $modProg = $intakerow['modProg'];
    }
}

// query for syariah
$js1 = "SELECT COUNT(NoKP) as jumlah_syariah FROM pilihankursuspelajar WHERE KursusPelajar='DIPLOMA SYARIAH (A6171)';";
$resultjs1 = $link->query($js1);
if ($resultjs1->num_rows > 0) {
    while ($row2 = $resultjs1->fetch_assoc()) {
        $jumlah_syariah = $row2['jumlah_syariah'];
    }
}

$js2 = "SELECT COUNT(NoKP) as jumlah_terima_syariah FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='DIPLOMA SYARIAH (A6171)';";
$resultjs2 = $link->query($js2);
if ($resultjs2->num_rows > 0) {
    while ($row3 = $resultjs2->fetch_assoc()) {
        $jumlah_terima_syariah = $row3['jumlah_terima_syariah'];
    }
}

$js3 = "SELECT COUNT(NoKP) as jumlah_tolak_syariah FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='DIPLOMA SYARIAH (A6171)';";
$resultjs3 = $link->query($js3);
if ($resultjs3->num_rows > 0) {
    while ($row4 = $resultjs3->fetch_assoc()) {
        $jumlah_tolak_syariah = $row4['jumlah_tolak_syariah'];
    }
}

//query for tahfiz
$jt1 = "SELECT COUNT(NoKP) as jumlah_tahfiz FROM pilihankursuspelajar WHERE KursusPelajar='DIPLOMA TAHFIZ AL-QURAN (A6327)';";
$resultjt1 = $link->query($jt1);
if ($resultjt1->num_rows > 0) {
    while ($row5 = $resultjt1->fetch_assoc()) {
        $jumlah_tahfiz = $row5['jumlah_tahfiz'];
    }
}

$jt2 = "SELECT COUNT(NoKP) as jumlah_terima_tahfiz FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='DIPLOMA TAHFIZ AL-QURAN (A6327)';";
$resultjt2 = $link->query($jt2);
if ($resultjt2->num_rows > 0) {
    while ($row6 = $resultjt2->fetch_assoc()) {
        $jumlah_terima_tahfiz = $row6['jumlah_terima_tahfiz'];
    }
}

$jt3 = "SELECT COUNT(NoKP) as jumlah_tolak_tahfiz FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='DIPLOMA TAHFIZ AL-QURAN (A6327)';";
$resultjt3 = $link->query($jt3);
if ($resultjt3->num_rows > 0) {
    while ($row7 = $resultjt3->fetch_assoc()) {
        $jumlah_tolak_tahfiz = $row7['jumlah_tolak_tahfiz'];
    }
}

//query for kewangan
$jk1 = "SELECT COUNT(NoKP) as jumlah_kewangan FROM pilihankursuspelajar WHERE KursusPelajar='DIPLOMA KEWANGAN (A8304)';";
$resultjk1 = $link->query($jk1);
if ($resultjk1->num_rows > 0) {
    while ($row8 = $resultjk1->fetch_assoc()) {
        $jumlah_kewangan = $row8['jumlah_kewangan'];
    }
}

$jk2 = "SELECT COUNT(NoKP) as jumlah_terima_kewangan FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='DIPLOMA KEWANGAN (A8304)';";
$resultjk2 = $link->query($jk2);
if ($resultjk2->num_rows > 0) {
    while ($row9 = $resultjk2->fetch_assoc()) {
        $jumlah_terima_kewangan = $row9['jumlah_terima_kewangan'];
    }
}

$jk3 = "SELECT COUNT(NoKP) as jumlah_tolak_kewangan FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='DIPLOMA KEWANGAN (A8304)';";
$resultjk3 = $link->query($jk3);
if ($resultjk3->num_rows > 0) {
    while ($row10 = $resultjk3->fetch_assoc()) {
        $jumlah_tolak_kewangan = $row10['jumlah_tolak_kewangan'];
    }
}

//query for halal
$jh1 = "SELECT COUNT(NoKP) as jumlah_halal FROM pilihankursuspelajar WHERE KursusPelajar='DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)';";
$resultjh1 = $link->query($jh1);
if ($resultjh1->num_rows > 0) {
    while ($row11 = $resultjh1->fetch_assoc()) {
        $jumlah_halal = $row11['jumlah_halal'];
    }
}

$jh2 = "SELECT COUNT(NoKP) as jumlah_terima_halal FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)';";
$resultjh2 = $link->query($jh2);
if ($resultjh2->num_rows > 0) {
    while ($row12 = $resultjh2->fetch_assoc()) {
        $jumlah_terima_halal = $row12['jumlah_terima_halal'];
    }
}

$jh3 = "SELECT COUNT(NoKP) as jumlah_tolak_halal FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)';";
$resultjh3 = $link->query($jh3);
if ($resultjh3->num_rows > 0) {
    while ($row13 = $resultjh3->fetch_assoc()) {
        $jumlah_tolak_halal = $row13['jumlah_tolak_halal'];
    }
}

//query for kaunseling
$jka1 = "SELECT COUNT(NoKP) as jumlah_kaunseling FROM pilihankursuspelajar WHERE KursusPelajar='DIPLOMA KAUNSELING (MQA/PA 14550)';";
$resultjka1 = $link->query($jka1);
if ($resultjka1->num_rows > 0) {
    while ($row14 = $resultjka1->fetch_assoc()) {
        $jumlah_kaunseling = $row14['jumlah_kaunseling'];
    }
}

$jka2 = "SELECT COUNT(NoKP) as jumlah_terima_kaunseling FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='DIPLOMA KAUNSELING (MQA/PA 14550)';";
$resultjka2 = $link->query($jka2);
if ($resultjka2->num_rows > 0) {
    while ($row15 = $resultjka2->fetch_assoc()) {
        $jumlah_terima_kaunseling = $row15['jumlah_terima_kaunseling'];
    }
}

$jka3 = "SELECT COUNT(NoKP) as jumlah_tolak_kaunseling FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='DIPLOMA KAUNSELING (MQA/PA 14550)';";
$resultjka3 = $link->query($jka3);
if ($resultjka3->num_rows > 0) {
    while ($row16 = $resultjka3->fetch_assoc()) {
        $jumlah_tolak_kaunseling = $row16['jumlah_tolak_kaunseling'];
    }
}

//query for islam
$ji1 = "SELECT COUNT(NoKP) as jumlah_islam FROM pilihankursuspelajar WHERE KursusPelajar='DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)';";
$resultji1 = $link->query($ji1);
if ($resultji1->num_rows > 0) {
    while ($row17 = $resultji1->fetch_assoc()) {
        $jumlah_islam = $row17['jumlah_islam'];
    }
}

$ji2 = "SELECT COUNT(NoKP) as jumlah_terima_islam FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)';";
$resultji2 = $link->query($ji2);
if ($resultji2->num_rows > 0) {
    while ($row18 = $resultji2->fetch_assoc()) {
        $jumlah_terima_islam = $row18['jumlah_terima_islam'];
    }
}

$ji3 = "SELECT COUNT(NoKP) as jumlah_tolak_islam FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)';";
$resultji3 = $link->query($ji3);
if ($resultji3->num_rows > 0) {
    while ($row19 = $resultji3->fetch_assoc()) {
        $jumlah_tolak_islam = $row19['jumlah_tolak_islam'];
    }
}

//query for muamalat
$jm1 = "SELECT COUNT(NoKP) as jumlah_muamalat FROM pilihankursuspelajar WHERE KursusPelajar='DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)';";
$resultjm1 = $link->query($jm1);
if ($resultjm1->num_rows > 0) {
    while ($row20 = $resultjm1->fetch_assoc()) {
        $jumlah_muamalat = $row20['jumlah_muamalat'];
    }
}

$jm2 = "SELECT COUNT(NoKP) as jumlah_terima_muamalat FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)';";
$resultjm2 = $link->query($jm2);
if ($resultjm2->num_rows > 0) {
    while ($row21 = $resultjm2->fetch_assoc()) {
        $jumlah_terima_muamalat = $row21['jumlah_terima_muamalat'];
    }
}

$jm3 = "SELECT COUNT(NoKP) as jumlah_tolak_muamalat FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)';";
$resultjm3 = $link->query($jm3);
if ($resultjm3->num_rows > 0) {
    while ($row22 = $resultjm3->fetch_assoc()) {
        $jumlah_tolak_muamalat = $row22['jumlah_tolak_muamalat'];
    }
}

//query for sosial
$jso1 = "SELECT COUNT(NoKP) as jumlah_sosial FROM pilihankursuspelajar WHERE KursusPelajar='DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)';";
$resultjso1 = $link->query($jso1);
if ($resultjso1->num_rows > 0) {
    while ($row23 = $resultjso1->fetch_assoc()) {
        $jumlah_sosial = $row23['jumlah_sosial'];
    }
}

$jso2 = "SELECT COUNT(NoKP) as jumlah_terima_sosial FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)';";
$resultjso2 = $link->query($jso2);
if ($resultjso2->num_rows > 0) {
    while ($row24 = $resultjso2->fetch_assoc()) {
        $jumlah_terima_sosial = $row24['jumlah_terima_sosial'];
    }
}

$jso3 = "SELECT COUNT(NoKP) as jumlah_tolak_sosial FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)';";
$resultjso3 = $link->query($jso3);
if ($resultjso3->num_rows > 0) {
    while ($row25 = $resultjso3->fetch_assoc()) {
        $jumlah_tolak_sosial = $row25['jumlah_tolak_sosial'];
    }
}

//query for Sijil Tahfiz
$ST1 = "SELECT COUNT(NoKP) as jumlah_sijil_tahfiz FROM pilihankursuspelajar WHERE KursusPelajar='SIJIL PENGAJIAN TAHFIZ AL QURAN';";
$resultST1 = $link->query($ST1);
if ($resultST1->num_rows > 0) {
    while ($row50 = $resultST1->fetch_assoc()) {
        $jumlah_sijilTahfiz = $row50['jumlah_sijil_tahfiz'];
    }
}

$ST2 = "SELECT COUNT(NoKP) as jumlah_terima_sijil_tahfiz FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='SIJIL PENGAJIAN TAHFIZ AL QURAN';";
$resultST2 = $link->query($ST2);
if ($resultST2->num_rows > 0) {
    while ($row51 = $resultST2->fetch_assoc()) {
        $jumlah_terima_sijilTahfiz = $row51['jumlah_terima_sijil_tahfiz'];
    }
}

$ST3 = "SELECT COUNT(NoKP) as jumlah_tolak_sijil_tahfiz FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='SIJIL PENGAJIAN TAHFIZ AL QURAN';";
$resultST3 = $link->query($ST3);
if ($resultST3->num_rows > 0) {
    while ($row52 = $resultST3->fetch_assoc()) {
        $jumlah_tolak_sijilTahfiz = $row52['jumlah_tolak_sijil_tahfiz'];
    }
}

//query for Sijil Bahasa
$SB1 = "SELECT COUNT(NoKP) as jumlah_sijil_bahasa FROM pilihankursuspelajar WHERE KursusPelajar='SIJIL PENGAJIAN BAHASA AL QURAN';";
$resultSB1 = $link->query($SB1);
if ($resultSB1->num_rows > 0) {
    while ($row53 = $resultSB1->fetch_assoc()) {
        $jumlah_sijilBahasa = $row53['jumlah_sijil_bahasa'];
    }
}

$SB2 = "SELECT COUNT(NoKP) as jumlah_terima_sijil_bahasa FROM pilihankursuspelajar WHERE PilihanPelajar='Terima' AND KursusPelajar='SIJIL PENGAJIAN BAHASA AL QURAN';";
$resultSB2 = $link->query($SB2);
if ($resultSB2->num_rows > 0) {
    while ($row54 = $resultSB2->fetch_assoc()) {
        $jumlah_terima_sijilBahasa = $row54['jumlah_terima_sijil_bahasa'];
    }
}

$SB3 = "SELECT COUNT(NoKP) as jumlah_tolak_sijil_bahasa FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak' AND KursusPelajar='SIJIL PENGAJIAN BAHASA AL QURAN';";
$resultSB3 = $link->query($SB3);
if ($resultSB3->num_rows > 0) {
    while ($row55 = $resultSB3->fetch_assoc()) {
        $jumlah_tolak_sijilBahasa = $row55['jumlah_tolak_sijil_bahasa'];
    }
}

//query for total
$j1 = "SELECT COUNT(NoKP) as jumlah FROM pilihankursuspelajar;";
$resultj1 = $link->query($j1);
if ($resultj1->num_rows > 0) {
    while ($row26 = $resultj1->fetch_assoc()) {
        $jumlah = $row26['jumlah'];
    }
}

$j2 = "SELECT COUNT(NoKP) as jumlah_tolak FROM pilihankursuspelajar WHERE PilihanPelajar='Tolak';";
$resultj2 = $link->query($j2);
if ($resultj2->num_rows > 0) {
    while ($row27 = $resultj2->fetch_assoc()) {
        $jumlah_tolak = $row27['jumlah_tolak'];
    }
}

$j3 = "SELECT COUNT(NoKP) as jumlah_terima FROM pilihankursuspelajar WHERE PilihanPelajar='Terima';";
$resultj3 = $link->query($j3);
if ($resultj3->num_rows > 0) {
    while ($row28 = $resultj3->fetch_assoc()) {
        $jumlah_terima = $row28['jumlah_terima'];
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
        <a class="navbar-brand ps-3" href="index.php">Jom Masuk Kitab</a>
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
                        <div class="sb-sidenav-menu-heading">Data Permohonan</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>
                        <!-- <div class="sb-sidenav-menu-heading">Permohonan</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHR" aria-expanded="false" aria-controls="collapseHR">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-columns"></i>
                            </div>
                            Permohonan
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseHR" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="kemasukan/permohonan.php">Permohonan Baru</a>
                                <a class="nav-link" href="kemasukan/status.php">Status Permohonan</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Maklumat</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAkademik" aria-expanded="false" aria-controls="collapseAkademik">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-columns"></i>
                            </div>
                            Kemasukan ke KITAB
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseAkademik" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="surat/dokumen.php">Dokumen yang perlu disediakan</a>
                                 <a class="nav-link" href="#">Barang kemasukan ke asrama</a> 
                                <a class="nav-link" href="Akedemik/TambahKursusBaru.php">Tambah Kursus Baru</a>
                            </nav>
                        </div> -->
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:
                            <?php
                            echo "$username";
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
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                        <!-- /Breadcrumb -->
                        <div class="col-md-15">
                            <h4 class="text-primary">Jumlah Permohonan</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Bil</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">Terima</th>
                                        <th scope="col">Tolak</th>
                                        <th scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>DIPLOMA SYARIAH (A6171)</td>
                                        <td><?php echo "$jumlah_terima_syariah"; ?></td>
                                        <td><?php echo "$jumlah_tolak_syariah"; ?></td>
                                        <td><?php echo "$jumlah_syariah"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>DIPLOMA TAHFIZ AL-QURAN (A6327)</td>
                                        <td><?php echo "$jumlah_terima_tahfiz"; ?></td>
                                        <td><?php echo "$jumlah_tolak_tahfiz"; ?></td>
                                        <td><?php echo "$jumlah_tahfiz"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>DIPLOMA KEWANGAN (A8304)</td>
                                        <td><?php echo "$jumlah_terima_kewangan"; ?></td>
                                        <td><?php echo "$jumlah_tolak_kewangan"; ?></td>
                                        <td><?php echo "$jumlah_kewangan"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)</td>
                                        <td><?php echo "$jumlah_terima_halal"; ?></td>
                                        <td><?php echo "$jumlah_tolak_halal"; ?></td>
                                        <td><?php echo "$jumlah_halal"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>DIPLOMA KAUNSELING (MQA/PA 14550)</td>
                                        <td><?php echo "$jumlah_terima_kaunseling"; ?></td>
                                        <td><?php echo "$jumlah_tolak_kaunseling"; ?></td>
                                        <td><?php echo "$jumlah_kaunseling"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)</td>
                                        <td><?php echo "$jumlah_terima_islam"; ?></td>
                                        <td><?php echo "$jumlah_tolak_islam"; ?></td>
                                        <td><?php echo "$jumlah_islam"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)</td>
                                        <td><?php echo "$jumlah_terima_muamalat"; ?></td>
                                        <td><?php echo "$jumlah_tolak_muamalat"; ?></td>
                                        <td><?php echo "$jumlah_muamalat"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8</th>
                                        <td>DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)</td>
                                        <td><?php echo "$jumlah_terima_sosial"; ?></td>
                                        <td><?php echo "$jumlah_tolak_sosial"; ?></td>
                                        <td><?php echo "$jumlah_sosial"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">9</th>
                                        <td>SIJIL PENGAJIAN TAHFIZ AL QURAN</td>
                                        <td><?php echo "$jumlah_terima_sijilTahfiz"; ?></td>
                                        <td><?php echo "$jumlah_tolak_sijilTahfiz"; ?></td>
                                        <td><?php echo "$jumlah_sijilTahfiz"; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">10</th>
                                        <td>SIJIL PENGAJIAN BAHASA AL QURAN</td>
                                        <td><?php echo "$jumlah_terima_sijilBahasa"; ?></td>
                                        <td><?php echo "$jumlah_tolak_sijilBahasa"; ?></td>
                                        <td><?php echo "$jumlah_sijilBahasa"; ?></td>
                                    </tr>
                                    <tr>
                                        <th><strong>Jumlah</strong></th>
                                        <td>&nbsp;</td>
                                        <td><?php echo "$jumlah_terima"; ?></td>
                                        <td><?php echo "$jumlah_tolak"; ?></td>
                                        <td><?php echo "$jumlah"; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="col-md-15">
                            <h4 class="text-primary">Permohonan</h4>
                            <!-- Account page navigation-->
                            <!-- <nav class="nav nav-borders">
                                <a class="nav-link active ms-0" href="editProfile.php">Profile</a>
                                <a class="nav-link" href="updatePassword.php">Security</a>
                            </nav> -->
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <section class="panel">
                                        <div class="panel-body">
                                            <p>Jumlah Pendaftaran : <?= $jumlah; ?>
                                                <br>
                                                <a href="exportexcel.php?intake=<?= $intake; ?>">EXPORT TO EXCEL</a><br>
                                            </p>
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="index.php">Permohonan Baru</a>
                                                </li>
                                            </ul>
                                            <div align="left"></div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-condensed mb-none  table-hover ">
                                                    <thead>
                                                        <tr>
                                                            <th>Bil</th>
                                                            <th>Nama Pelajar</th>
                                                            <th>No Kad Pengenalan</th>
                                                            <th>Telefon</th>
                                                            <th>Program</th>
                                                            <th>Status Permohonan</th>
                                                            <th>Mod Pengajian</th>
                                                            <th>Status Biasiswa</th>
                                                            <th>Surat Tawaran</th>
                                                            <th>Surat Biasiswa</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $bil = 1;

                                                        $sql = "SELECT maklumatdiripelajar.username,maklumatdiripelajar.NamaPenuh,maklumatdiripelajar.NoKP,maklumatdiripelajar.TelefonPelajar,pilihankursuspelajar.KursusPelajar,pilihankursuspelajar.StatusPermohonan,pilihankursuspelajar.ModPengajian,pilihankursuspelajar.StatusBiasiswa,pilihankursuspelajar.PilihanPelajar FROM maklumatdiripelajar INNER JOIN pilihankursuspelajar WHERE maklumatdiripelajar.username=pilihankursuspelajar.username;";
                                                        $result = $link->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            // output data of each row
                                                            while ($row29 = $result->fetch_assoc()) {
                                                                $nokpPelajar = $row29['NoKP'];
                                                                $username = $row29['username'];
                                                        ?>
                                                                <tr>
                                                                    <td scope="row"><?= $bil++; ?></td>
                                                                    <td><?= $row29['NamaPenuh']; ?><br></td>
                                                                    <td><?= $nokpPelajar; ?></td>
                                                                    <td>&nbsp;<?= $row29['TelefonPelajar']; ?></td>
                                                                    <td>&nbsp;<?= $row29['KursusPelajar']; ?></td>
                                                                    <td>&nbsp;<?= $row29['StatusPermohonan']; ?></td>
                                                                    <td>&nbsp;<?= $row29['ModPengajian']; ?></td>
                                                                    <td>&nbsp;<?= $row29['StatusBiasiswa']; ?></td>
                                                                    <?php
                                                                    if ($row29['PilihanPelajar'] == "Terima") {
                                                                    ?>
                                                                        <td><a href='#' class="button-link" onclick="displayTawaran('../surat/suratTawaran.php?username=<?= $username; ?>','<?= $username; ?>')">Muat turun</a></td>
                                                                        <td><a href='#' class="button-link" onclick="displayBiasiswa('../surat/suratBiasiswa.php?username=<?= $username; ?>','<?= $username; ?>')">Muat turun</a></td>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <td>Tiada Rekod</td>
                                                                        <td>Tiada Rekod</td>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <td>
                                                                        <a onclick="popupwindow('semakkelayakan.php?nokp=<?= $row29['NoKP']; ?>','<?= $row29['NoKP']; ?>',1000,700)">
                                                                            <button class="btn btn-primary">Semakan Kelayakan</button></a>

                                                                    </td>
                                                                </tr>

                                                            <?php }
                                                        } else { ?>
                                                            <tr>
                                                                <td colspan='7'>Tiada Rekod</td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

        <script>
            function popupwindow(url, title, w, h) {
                var left = (screen.width / 2) - (w / 2);
                var top = (screen.height / 2) - (h / 2);
                return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

            }
        </script>
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
</body>

</html>