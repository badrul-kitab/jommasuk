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

// Query to fetch user detail in index, if there's not data it will show empty string 
$nama_pelajar = $email_pelajar = $nokp_pelajar = $telefon_pelajar = $alamat_pelajar = $negeriPelajar = $Kursus = $Kemasukan = $StatusPermohonan = $StatusBiasiswa = $Biasiswa = $Asrama = $kuliah = $tempoh_pengajian = '';
$pendapatanisirumah = $pendapatanibu = $pendapatanbapa = $negeriBapa = $negeriIbu = $tarikhmohon = $GuruKafa = '';

// Get the student information
$query = "SELECT * FROM maklumatdiripelajar WHERE username = '$username'";
$result = $link->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nama_pelajar = $row['NamaPenuh'];
        $email_pelajar = $row['EmailPelajar'];
        $nokp_pelajar = $row['NoKP'];
        $telefon_pelajar = $row['TelefonPelajar'];
        $alamat_pelajar = $row['AlamatPelajar'];
        $negeriPelajar = $row['negeri'];
    }
}

// Get parent information
$parent = "SELECT * FROM maklumatibubapapelajar WHERE username = '$username'";
$result3 = $link->query($parent);
if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $pendapatanbapa = $row3['PendapatanBersihBapa'];
        $pendapatanibu = $row3['PendapatanBersihIbu'];
        $negeriBapa = $row3['negeriBapa'];
        $negeriIbu = $row3['negeriIbu'];
    }
}

$pendapatanisirumah = intval($pendapatanbapa) + intval($pendapatanibu);

// Get the kursus information
$kursus = "SELECT * FROM pilihankursuspelajar WHERE username = '$username'";
$result2 = $link->query($kursus);
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $StatusPermohonan = $row2['StatusPermohonan'];
    }
}

// For passing the data into database and redirect to the next page
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $NamaPenuh = $nama_pelajar;
    $NoKP = $nokp_pelajar;
    $AlamatPelajar = $alamat_pelajar;
    $TelefonPelajar = $telefon_pelajar;
    $EmailPelajar = $email_pelajar;
    $KursusPelajar = $_POST["Kursus"];
    $KemasukanPelajar = $_POST["Kemasukan"];
    $Biasiswa = $_POST["Biasiswa"];
    $Asrama = $_POST["Asrama"];
    $Mod = $_POST["Mod"];
    $GuruKafa = $_POST["GuruKafa"];
    $tarikhmohon = date("d/m/Y");

    if ($KursusPelajar == "DIPLOMA SYARIAH (A6171)") {
        $kuliah = "Pusat Pengajian Islam dan Ilmu Kontemporari";
        $tempoh_pengajian = "2 Tahun 6 Bulan";
    } elseif ($KursusPelajar == "DIPLOMA TAHFIZ AL-QURAN (A6327)") {
        $kuliah = "Pusat Pengajian Tahfiz Al-Quran";
        $tempoh_pengajian = "3 Tahun";
    } elseif ($KursusPelajar == "DIPLOMA KEWANGAN (A8304)") {
        $kuliah = "Pusat Pengajian Muamalat dan Sains Pengurusan";
        $tempoh_pengajian = "2 Tahun 6 Bulan";
    } elseif ($KursusPelajar == "DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)") {
        $kuliah = "Pusat Pengajian Muamalat dan Sains Pengurusan";
        $tempoh_pengajian = "2 Tahun 6 Bulan";
    } elseif ($KursusPelajar == "DIPLOMA KAUNSELING (MQA/PA 14550)") {
        $kuliah = "Pusat Pengajian Islam dan Ilmu Kontemporari";
        $tempoh_pengajian = "2 Tahun 6 Bulan";
    } elseif ($KursusPelajar == "DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)") {
        $kuliah = "Pusat Pengajian Islam dan Ilmu Kontemporari";
        $tempoh_pengajian = "2 Tahun 6 Bulan";
    } elseif ($KursusPelajar == "DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)") {
        $kuliah = "Pusat Pengajian Muamalat dan Sains Pengurusan";
        $tempoh_pengajian = "2 Tahun 6 Bulan";
    } elseif ($KursusPelajar == "DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)") {
        $kuliah = "Pusat Pengajian Muamalat dan Sains Pengurusan";
        $tempoh_pengajian = "2 Tahun";
    } elseif ($KursusPelajar == "SIJIL PENGAJIAN TAHFIZ AL QURAN") {
        $kuliah = "Pusat Pengajian Tahfiz Al-Quran";
        $tempoh_pengajian = "1 Tahun 5 Bulan";
    } elseif ($KursusPelajar == "SIJIL PENGAJIAN BAHASA AL QURAN") {
        $kuliah = "Pusat Bahasa dan Pengajian Umum";
        $tempoh_pengajian = "1 Tahun 6 Bulan";
    }


    if ($Mod == "SM") {
        if ($KursusPelajar == "SIJIL PENGAJIAN TAHFIZ AL QURAN") {
            $StatusBiasiswa = "Tidak Layak";
        } elseif ($KursusPelajar == "SIJIL PENGAJIAN BAHASA AL QURAN") {
            $StatusBiasiswa = "Tidak Layak";
        } elseif ($negeriPelajar == "Pulau Pinang") {
            if ($pendapatanisirumah <= 4850) {
                $StatusBiasiswa = "ZPP-KITAB (Kategori Pertama)";
            } elseif ($pendapatanisirumah > 4850 && $pendapatanisirumah <= 10970) {
                $StatusBiasiswa = "ZPP-KITAB (Kategori Kedua)";
            } else {
                $StatusBiasiswa = "ZPP-KITAB (Kategori Ketiga)";
            }
        } elseif ($negeriPelajar != "Pulau Pinang") {
            if ($negeriBapa == "Pulau Pinang") {
                if ($pendapatanisirumah <= 4850) {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Pertama)";
                } elseif ($pendapatanisirumah > 4850 && $pendapatanisirumah <= 10970) {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Kedua)";
                } else {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Ketiga)";
                }
            } elseif ($negeriIbu == "Pulau Pinang") {
                if ($pendapatanisirumah <= 4850) {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Pertama)";
                } elseif ($pendapatanisirumah > 4850 && $pendapatanisirumah <= 10970) {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Kedua)";
                } else {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Ketiga)";
                }
            } else {
                $StatusBiasiswa = "Tidak Layak";
            }
        }
    } elseif ($Mod == "HM") {
        if ($GuruKafa == "YA") {
            if ($negeriPelajar == "Pulau Pinang") {
                if ($pendapatanisirumah <= 4850) {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Pertama)";
                } elseif ($pendapatanisirumah > 4850 && $pendapatanisirumah <= 10970) {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Kedua)";
                } else {
                    $StatusBiasiswa = "ZPP-KITAB (Kategori Ketiga)";
                }
            } elseif ($negeriPelajar != "Pulau Pinang") {
                if ($negeriBapa == "Pulau Pinang") {
                    if ($pendapatanisirumah <= 4850) {
                        $StatusBiasiswa = "ZPP-KITAB (Kategori Pertama)";
                    } elseif ($pendapatanisirumah > 4850 && $pendapatanisirumah <= 10970) {
                        $StatusBiasiswa = "ZPP-KITAB (Kategori Kedua)";
                    } else {
                        $StatusBiasiswa = "ZPP-KITAB (Kategori Ketiga)";
                    }
                } elseif ($negeriIbu == "Pulau Pinang") {
                    if ($pendapatanisirumah <= 4850) {
                        $StatusBiasiswa = "ZPP-KITAB (Kategori Pertama)";
                    } elseif ($pendapatanisirumah > 4850 && $pendapatanisirumah <= 10970) {
                        $StatusBiasiswa = "ZPP-KITAB (Kategori Kedua)";
                    } else {
                        $StatusBiasiswa = "ZPP-KITAB (Kategori Ketiga)";
                    }
                } else {
                    $StatusBiasiswa = "Tidak Layak";
                }
            }
        } else {
            $StatusBiasiswa = "Tidak Layak";
        }
        //$StatusBiasiswa = "Tidak Layak";
    }


    // Insert the value into database
    //$sql = "INSERT INTO pilihankursuspelajar (NamaPenuh, NoKP, AlamatPelajar, TelefonPelajar, EmailPelajar, KursusPelajar, KemasukanPelajar, kuliah, TempohPengajian, username, StatusPermohonan, StatusBiasiswa, Biasiswa, Asrama) VALUES ('$NamaPenuh', '$NoKP', '$AlamatPelajar', '$TelefonPelajar', '$EmailPelajar', '$KursusPelajar', '$KemasukanPelajar', '$kuliah', '$tempoh_pengajian','$username', 'Dalam Pertimbangan', '$StatusBiasiswa', '$Biasiswa', '$Asrama')";

    //test sql
    $sql2 = "INSERT INTO pilihankursuspelajar (NamaPenuh,NoKP,KursusPelajar,KemasukanPelajar,Kuliah,TempohPengajian,Biasiswa,Asrama,ModPengajian,AlamatPelajar,TelefonPelajar,EmailPelajar,StatusPermohonan,StatusBiasiswa,GuruKafa,PilihanPelajar,CatatanJPA,CatatanBendahari,tarikhmohon, tarikhterima, username) VALUES ('$NamaPenuh', '$NoKP','$KursusPelajar', '$KemasukanPelajar', '$kuliah', '$tempoh_pengajian','$Biasiswa', '$Asrama', '$Mod', '$AlamatPelajar', '$TelefonPelajar', '$EmailPelajar','Dalam Pertimbangan','$StatusBiasiswa','$GuruKafa',NULL,NULL,NULL,'$tarikhmohon',NULL,'$username')";
    if ($stmt = mysqli_prepare($link, $sql2)) {

        // echo gettype($sql) . "<br>";
        // echo gettype($stmt) . "<br>";
        // //echo $sql;
        // die;
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to next page
            header("location: status.php");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            echo "Error: " . $stmt . "<br>" . $link->error;
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . $sql2 . "<br>" . $link->error;
    }
    // Close connection
    mysqli_close($link);
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
                        <a class="nav-link" href="permohonan.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Permohonan Baru
                        </a>
                        <a class="nav-link" href="status.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Status Permohonan
                        </a>
                        <div class="sb-sidenav-menu-heading">Maklumat</div>
                        <a class="nav-link" href="../surat/dokumen.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dokumen
                        </a>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:
                            <?php
                            echo "$nama_pelajar";
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
                                <li class="breadcrumb-item active" aria-current="page">Permohonan Baru</li>
                            </ol>
                        </nav>
                        <!-- /Breadcrumb -->
                        <!-- Paparan Maklumat Diri -->
                        <div class="col-md-15">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Penuh</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php
                                            echo "$nama_pelajar";
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php
                                            echo "$email_pelajar";
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nombor Kad Pengenalan</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php
                                            echo "$nokp_pelajar";
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nombor Telefon</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php
                                            echo "$telefon_pelajar";
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Alamat</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <?php
                                            echo "$alamat_pelajar";
                                            ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Button trigger modal -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?php
                                            $DisplayForm = true;
                                            if (isset($_POST['submit'])) {
                                                $DisplayForm = false;
                                            }
                                            if ($DisplayForm) {

                                                if ($StatusPermohonan == '') {
                                            ?>
                                                    <a type="submit" class="btn btn-primary" value="Isi Maklumat Diri" name="submit" data-toggle="modal" data-target="#exampleModal">Pemilihan Kursus</a>
                                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                        Pemilihan Kursus
                                                    </button> -->
                                                    <!-- <a type="submit" class="btn btn-primary" value="Isi Maklumat Diri" name="submit" href="Maklumat\Diri.php">Isi Maklumat Diri</a> -->
                                                    <!-- <input type="submit" class="btn btn-primary" value="Submit" name="submit"> -->
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-md-15">
                                                        <h6> Anda telah membuat permohonan, sila semak di status permohonan</h6>
                                                        <!-- <a class="btn btn-primary" href="kemasukan/permohonan.php">Permohonan</a> -->
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <!-- <a class="btn btn-primary" href="Maklumat/Diri.php">Isi Maklumat Diri</a> -->
                                        </div>
                                    </div>
                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Pemilihan Kursus
                                    </button> -->
                                </div>
                            </div>
                        </div>
                        <!-- Paparan Maklumat Diri -->
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pemilihan Program</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="sm-3">
                                                <h6 class="mb-0 text-secondary">Pemilihan program <strong>hanya boleh dibuat sekali sahaja</strong>. Sebarang <strong>pertukaran program hendaklah berurusan dengan Jabatan Pengurusan Akademik KITAB</strong>. Sila rujuk perincian kursus di laman web rasmi KITAB <strong><a href="https://www.kitab.edu.my">www.kitab.edu.my</a></strong></h6>
                                            </div>
                                            <br>
                                            <div class=" row gx-3 mb-3">
                                                <div class=" col-md-6">
                                                    <label for="inputState" class="form-label small mb-1">Program</label>
                                                    <select id="inputState" class="form-select" name='Kursus'>
                                                        <option value="DIPLOMA SYARIAH (A6171)">DIPLOMA SYARIAH (A6171)</option>
                                                        <option value="DIPLOMA TAHFIZ AL-QURAN (A6327)">DIPLOMA TAHFIZ AL-QURAN (A6327)</option>
                                                        <option value="DIPLOMA KEWANGAN (A8304)">DIPLOMA KEWANGAN (A8304)</option>
                                                        <option value="DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)">DIPLOMA PENGURUSAN HALAL (MQA/PA 14547)</option>
                                                        <option value="DIPLOMA KAUNSELING (MQA/PA 14550)">DIPLOMA KAUNSELING (MQA/PA 14550)</option>
                                                        <option value="DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)">DIPLOMA PENGAJIAN ISLAM (MQA/PA 14551)</option>
                                                        <option value="DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)">DIPLOMA PENTADBIRAN MUAMALAT (MQA/PA 14552)</option>
                                                        <option value="DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)">DIPLOMA PENGURUSAN INSTITUSI SOSIAL ISLAM (MQA/PA 15214)</option>
                                                        <option value="SIJIL PENGAJIAN BAHASA AL QURAN">SIJIL PENGAJIAN BAHASA AL QURAN</option>
                                                        <option value="SIJIL PENGAJIAN TAHFIZ AL QURAN">SIJIL PENGAJIAN TAHFIZ AL QURAN</option>
                                                    </select>
                                                </div>
                                                <div class=" col-md-6">
                                                    <label for="inputState" class="form-label small mb-1">Kemasukan</label>
                                                    <select id="inputState" class="form-select" name='Kemasukan'>
                                                        <option value="Disember 2023">Disember 2023</option>
                                                        <!-- <option value="Julai 2024">Julai 2024</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class=" row gx-3 mb-3">
                                                <div class=" col-md-6">
                                                    <label for="inputState" class="form-label small mb-1">Perlukan Biasiswa?</label>
                                                    <select id="inputState" class="form-select" name='Biasiswa'>
                                                        <option value="YA">YA</option>
                                                        <option value="TIDAK">TIDAK</option>
                                                    </select>
                                                </div>
                                                <div class=" col-md-6">
                                                    <label for="inputState" class="form-label small mb-1">Perlukan Asrama?</label>
                                                    <select id="inputState" class="form-select" name='Asrama'>
                                                        <option value="YA">YA</option>
                                                        <option value="TIDAK">TIDAK</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class=" row gx-3 mb-3">
                                                <div class=" col-md-6">
                                                    <label for="inputState" class="form-label small mb-1">Mod Pengajian</label>
                                                    <select id="inputState" class="form-select" name='Mod'>
                                                        <option value="HM">Hujung Minggu</option>
                                                        <option value="SM">Sepenuh Masa</option>
                                                    </select>
                                                </div>
                                                <div class=" col-md-6">
                                                    <label for="inputState" class="form-label small mb-1">Adakah anda guru KAFA?</label>
                                                    <select id="inputState" class="form-select" name='GuruKafa'>
                                                        <option value="YA">YA</option>
                                                        <option value="TIDAK">TIDAK</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Save changes button-->
                                            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal -->
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
</body>

</html>