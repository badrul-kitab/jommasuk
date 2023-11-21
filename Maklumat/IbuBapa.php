<?php
include('config.php');
// Initialize the session
session_start();
$username = $_SESSION['username'];

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}

//initialize empty to variable
$NamaBapa = $ICBapa = $ICDepanBapa = $AlamatBapa = $PoskodBapa = $negeriBapa = $TempohMenetapBapa = $TelefonBapa = $PekerjaanBapa = $NamaMajikanBapa = $AlamatMajikanBapa = $PendapatanBersihBapa = $Tanggungan = $SlipGajiBapa = '';
$NamaIbu = $ICIbu = $ICDepanIbu = $AlamatIbu = $PoskodIbu = $negeriIbu = $TempohMenetapIbu = $TelefonIbu = $PekerjaanIbu = $AlamatMajikanIbu = $PendapatanBersihIbu = $NamaPenuh = $SlipGajiIbu = '';

// For passing the data into database and redirect to the next page
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Set parameters Bapa
    $NamaBapa = $_POST["NamaBapa"];
    $ICBapa = $_POST["ICBapa"];
    // $ICDepanBapa = '';
    $AlamatBapa = $_POST["AlamatBapa"];
    $PoskodBapa = $_POST["PoskodBapa"];
    $negeriBapa = $_POST["negeriBapa"];
    $TempohMenetapBapa = $_POST["TempohMenetapBapa"];
    $TelefonBapa = $_POST["TelefonBapa"];
    $PekerjaanBapa = $_POST["PekerjaanBapa"];
    $NamaMajikanBapa = $_POST["NamaMajikanBapa"];
    $AlamatMajikanBapa = $_POST["AlamatMajikanBapa"];
    $PendapatanBersihBapa = $_POST["PendapatanBersihBapa"];
    $Tanggungan = $_POST["Tanggungan"];

    // set up to upload ICDepanBapa and SlipGajiBapa
    $statusMsg = '';

    // File upload directory 
    $targetDir = "../image/";

    if (!empty($_FILES["ICDepanBapa"]["name"])) {
        $fileName = basename($_FILES["ICDepanBapa"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["ICDepanBapa"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $ICDepanBapa = $fileName;
                //$insert = $link->query("INSERT INTO maklumatdiripelajar (ICDepanPelajar) VALUES ('" . $fileName . "'");
                if ($insert) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    if (!empty($_FILES["SlipGajiBapa"]["name"])) {
        $fileName = basename($_FILES["SlipGajiBapa"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["SlipGajiBapa"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $SlipGajiBapa = $fileName;
                //$insert = $link->query("INSERT INTO maklumatdiripelajar (GambarPassport) VALUES ('" . $fileName . "'");
                if ($insert) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    // Set parameters Ibu
    $NamaIbu = $_POST["NamaIbu"];
    $ICIbu = $_POST["ICIbu"];
    $ICDepanIbu = '';
    $AlamatIbu = $_POST["AlamatIbu"];
    $PoskodIbu = $_POST["PoskodIbu"];
    $negeriIbu = $_POST["negeriIbu"];
    $TempohMenetapIbu = $_POST["TempohMenetapIbu"];
    $TelefonIbu = $_POST["TelefonIbu"];
    $PekerjaanIbu = $_POST["PekerjaanIbu"];
    $AlamatMajikanIbu = $_POST["AlamatMajikanIbu"];
    $PendapatanBersihIbu = $_POST["PendapatanBersihIbu"];

    //set up to upload ICDepanIbu and SlipGajiIbu
    if (!empty($_FILES["ICDepanIbu"]["name"])) {
        $fileName = basename($_FILES["ICDepanIbu"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["ICDepanIbu"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $ICDepanIbu = $fileName;
                //$insert = $link->query("INSERT INTO maklumatdiripelajar (ICDepanPelajar) VALUES ('" . $fileName . "'");
                if ($insert) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    if (!empty($_FILES["SlipGajiIbu"]["name"])) {
        $fileName = basename($_FILES["SlipGajiIbu"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["SlipGajiIbu"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $SlipGajiIbu = $fileName;
                //$insert = $link->query("INSERT INTO maklumatdiripelajar (GambarPassport) VALUES ('" . $fileName . "'");
                if ($insert) {
                    $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                } else {
                    $statusMsg = "File upload failed, please try again.";
                }
            } else {
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select a file to upload.';
    }

    // Insert the value into database
    $sql = "INSERT INTO maklumatibubapapelajar ( NamaBapa, ICBapa, AlamatBapa, PoskodBapa, negeriBapa, TempohMenetapBapa, TelefonBapa, PekerjaanBapa, NamaMajikanBapa, AlamatMajikanBapa, PendapatanBersihBapa, Tanggungan,
    NamaIbu, ICIbu, AlamatIbu, PoskodIbu, negeriIbu, TempohMenetapIbu, TelefonIbu, PekerjaanIbu, AlamatMajikanIbu, PendapatanBersihIbu, username, status, ICDepanBapa, ICDepanIbu, SlipGajiBapa, SlipGajiIbu) VALUES ('$NamaBapa', '$ICBapa', '$AlamatBapa', '$PoskodBapa',
     '$negeriBapa', '$TempohMenetapBapa', '$TelefonBapa', '$PekerjaanBapa', '$NamaMajikanBapa', '$AlamatMajikanBapa', '$PendapatanBersihBapa', '$Tanggungan', '$NamaIbu', '$ICIbu', '$AlamatIbu', '$PoskodIbu',
     '$negeriIbu', '$TempohMenetapIbu', '$TelefonIbu', '$PekerjaanIbu', '$AlamatMajikanIbu', '$PendapatanBersihIbu', '$username','1', '$ICDepanBapa', '$ICDepanIbu', '$SlipGajiBapa', '$SlipGajiIbu')";

    // Prepare the sql and connect with database
    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to next page
            header("location: sekolah.php");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            //echo "Error: " . $stmt . "<br>" . $link->error;
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($link);
}

$query = "SELECT * FROM maklumatdiripelajar WHERE username = '$username'";
$result = $link->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $NamaPenuh = $row['NamaPenuh'];
    }
}

$status = "SELECT maklumatdiripelajar.status as status_pelajar, maklumatibubapapelajar.status as status_ibubapa, maklumatakademikpelajar.status as status_akademik FROM maklumatdiripelajar, maklumatibubapapelajar, maklumatakademikpelajar WHERE maklumatdiripelajar.username = maklumatibubapapelajar.username AND maklumatdiripelajar.username='$username'";

$result2 = $link->query($status);

if ($result2->num_rows > 0) {

    while ($row2 = $result2->fetch_assoc()) {

        $status_diri = $row2['status_pelajar'];

        $status_ibubapa = $row2['status_ibubapa'];

        $status_akademik = $row2['status_akademik'];
    }
}

$kursus = "SELECT * FROM pilihankursuspelajar WHERE username = '$username'";
$result2 = $link->query($kursus);
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $StatusPermohonan = $row2['StatusPermohonan'];
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

    <style>
        .required::after {
            content: ' *';
            color: red;
        }
    </style>
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
                        <?php

                        // if ($status_diri == '' && $status_ibubapa == '' && $status_akademik == '') {
                        if ($StatusPermohonan == '') {
                        ?>
                            <a class="nav-link" href="#">

                                <div class="sb-nav-link-icon">

                                    <i class="fas fa-tachometer-alt"></i>

                                </div>

                                Permohonan Baru

                            </a>

                            <a class="nav-link" href="#">

                                <div class="sb-nav-link-icon">

                                    <i class="fas fa-tachometer-alt"></i>

                                </div>

                                Status Permohonan

                            </a>

                        <?php
                        } else {
                        ?>
                            <a class="nav-link" href="kemasukan/permohonan.php">

                                <div class="sb-nav-link-icon">

                                    <i class="fas fa-tachometer-alt"></i>

                                </div>

                                Permohonan Baru

                            </a>

                            <a class="nav-link" href="kemasukan/status.php">

                                <div class="sb-nav-link-icon">

                                    <i class="fas fa-tachometer-alt"></i>

                                </div>

                                Status Permohonan

                            </a>
                        <?php
                        }
                        ?>
                        <div class="sb-sidenav-menu-heading">Maklumat</div>
                        <a class="nav-link" href="../surat/dokumen.php">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dokumen
                        </a>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?= $NamaPenuh; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="main-body">
                    <div class="col-xl-12">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Maklumat Keluarga</div>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                    <!-- Form Group (nama penuh Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nama Penuh Bapa/Penjaga/Suami Seperti Di Dalam Kad Pengenalan<span class="required"></span></label>
                                        <input class="form-control" name="NamaBapa" id="NamaBapa" type="text" placeholder="Nama Penuh" required value="<?php echo $NamaBapa; ?>">
                                    </div>
                                    <!-- Form Group (number ic Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nombor Kad Pengenalan Bapa/Penjaga/Suami<span class="required"></span></label>
                                        <input class="form-control" name="ICBapa" id="ICBapa" type="text" placeholder="No. Kad Pengenalan" required value="<?php echo $ICBapa; ?>">
                                    </div>
                                    <!-- Form Group (gambar IC Bapa)-->
                                    <div class="mb-3">
                                        <label for="formFile" class="small mb-1">Gambar Kad Pengenalan, Pastikan Kad Pengenalan Muka Depan dan Belakang di Dalam 1 Muka Surat<span class="required"></label>
                                        <input class="form-control" name="ICDepanBapa" type="file" id="ICDepanBapa" value="<?php echo $ICDepanBapa; ?>">
                                    </div>
                                    <!-- Form Group (alamat Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Alamat Bapa/Penjaga/Suami<span class="required"></span></label>
                                        <input class="form-control" name="AlamatBapa" id="AlamatBapa" type="text" placeholder="Alamat" required value="<?php echo $AlamatBapa; ?>">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (poskod Bapa)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1">Poskod Bapa/Penjaga/Suami<span class="required"></span></label>
                                            <input class="form-control" name="PoskodBapa" id="PoskodBapa" type="text" placeholder="Poskod" required value="<?php echo $PoskodBapa; ?>">
                                        </div>
                                        <!-- Form Group (negeri Bapa)-->
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label small mb-1">Negeri Bapa/Penjaga/Suami<span class="required"></span></label>
                                            <select id="inputState" class="form-select" name='negeriBapa'>
                                                <option value="Pulau Pinang">Pulau Pinang</option>
                                                <option value="Kedah">Kedah</option>
                                                <option value="Perlis">Perlis</option>
                                                <option value="Perak">Perak</option>
                                                <option value="Selangor">Selangor</option>
                                                <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
                                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                <option value="Melaka">Melaka</option>
                                                <option value="Johor">Johor</option>
                                                <option value="Pahang">Pahang</option>
                                                <option value="Terengganu">Terengganu</option>
                                                <option value="Kelantan">Kelantan</option>
                                                <option value="Sabah">Sabah</option>
                                                <option value="Sarawak">Sarawak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Form Group (tempoh menetap di pulau pinang Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Tempoh Menetap Bapa/Penjaga/Suami di Pulau Pinang<span class="required"></span></label>
                                        <input class="form-control" Name="TempohMenetapBapa" id="TempohMenetapBapa" type="num" placeholder="Tahun" required value="<?php echo $TempohMenetapBapa; ?>">
                                    </div>
                                    <!-- Form Group (no phone Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nombor Telefon Bimbit Bapa/Penjaga/Suami<span class="required"></span></label>
                                        <input class="form-control" Name="TelefonBapa" id="TelefonBapa" type="tel" placeholder="No. Telefon Bimbit" required value="<?php echo $TelefonBapa; ?>">
                                    </div>
                                    <!-- Form Group (Pekerjaan Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Pekerjaan Bapa/Penjaga/Suami<span class="required"></span></label>
                                        <input class="form-control" Name="PekerjaanBapa" id="PekerjaanBapa" type="text" placeholder="Pekerjaan" required value="<?php echo $PekerjaanBapa; ?>">
                                    </div>
                                    <!-- Form Group (Nama majikan Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nama Majikan Bapa/Penjaga/Suami<span class="required"></span></label>
                                        <input class="form-control" Name="NamaMajikanBapa" id="NamaMajikanBapa" type="text" placeholder="Nama Majikan" required value="<?php echo $NamaMajikanBapa; ?>">
                                    </div>
                                    <!-- Form Group (Alamat majikan Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Alamat Majikan Bapa/Penjaga/Suami<span class="required"></span></label>
                                        <input class="form-control" name="AlamatMajikanBapa" id="AlamatMajikanBapa" type="text" placeholder="Alamat Majikan" required value="<?php echo $AlamatMajikanBapa; ?>">
                                    </div>
                                    <!-- Form Group (Pendapatan Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Pendapatan Bersih Bapa/Penjaga/Suami (Jika tiada pendapatan isikan N/A)<span class="required"></span></label>
                                        <input class="form-control" name="PendapatanBersihBapa" id="PendapatanBersihBapa" type="num" placeholder="Pendapatan Bersih" required value="<?php echo $PendapatanBersihBapa; ?>">
                                    </div>
                                    <!-- Form Group (Tanggungan Bapa)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Jumlah Tanggungan Bapa/Penjaga/Suami<span class="required"></span></label>
                                        <input class="form-control" name="Tanggungan" id="Tanggungan" type="num" placeholder="Jumlah Tanggungan" required value="<?php echo $Tanggungan; ?>">
                                    </div>
                                    <!-- Form Group (gambar slip gaji bapa)-->
                                    <div class="mb-3">
                                        <label for="formFile" class="small mb-1">Gambar Slip Gaji Bapa/Penjaga/Suami<span class="required"></span></label>
                                        <input class="form-control" name="SlipGajiBapa" type="file" id="SlipGajiBapa" value="<?php echo $SlipGajiBapa; ?>">
                                    </div>

                                    <!-- Form Group (nama penuh Ibu)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nama Penuh Ibu/Penjaga Seperti Di Dalam Kad Pengenalan<span class="required"></span></label>
                                        <input class="form-control" name="NamaIbu" id="NamaIbu" type="text" placeholder="Nama Penuh" required value="<?php echo $NamaIbu; ?>">
                                    </div>
                                    <!-- Form Group (number ic Ibu)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nombor Kad Pengenalan Ibu/Penjaga<span class="required"></span></label>
                                        <input class="form-control" name="ICIbu" id="ICIbu" type="text" placeholder="No. Kad Pengenalan" required value="<?php echo $ICIbu; ?>">
                                    </div>
                                    <!-- Form Group (gambar IC Ibu)-->
                                    <div class="mb-3">
                                        <label for="formFile" class="small mb-1">Gambar Kad Pengenalan, Pastikan Kad Pengenalan Muka Depan dan Belakang di Dalam 1 Muka Surat<span class="required"></label>
                                        <input class="form-control" name="ICDepanIbu" type="file" id="ICDepanIbu" value="<?php echo $ICDepanIbu; ?>">
                                    </div>
                                    <!-- Form Group (alamat Ibu)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Alamat Ibu/Penjaga<span class="required"></span></label>
                                        <input class="form-control" name="AlamatIbu" id="AlamatIbu" type="text" placeholder="Alamat" required value="<?php echo $AlamatIbu; ?>">
                                    </div>
                                    <!-- Form Row-->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (poskod Ibu)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1">Poskod Ibu/Penjaga<span class="required"></span></label>
                                            <input class="form-control" name="PoskodIbu" id="inputFirstName" type="text" placeholder="Poskod" required value="<?php echo $PoskodIbu; ?>">
                                        </div>
                                        <!-- Form Group (negeri Ibu)-->
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label small mb-1">Negeri Ibu/Penjaga<span class="required"></span></label>
                                            <select id="inputState" class="form-select" name='negeriIbu'>
                                                <option value="Pulau Pinang">Pulau Pinang</option>
                                                <option value="Kedah">Kedah</option>
                                                <option value="Perlis">Perlis</option>
                                                <option value="Perak">Perak</option>
                                                <option value="Selangor">Selangor</option>
                                                <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
                                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                <option value="Melaka">Melaka</option>
                                                <option value="Johor">Johor</option>
                                                <option value="Pahang">Pahang</option>
                                                <option value="Terengganu">Terengganu</option>
                                                <option value="Kelantan">Kelantan</option>
                                                <option value="Sabah">Sabah</option>
                                                <option value="Sarawak">Sarawak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Form Group (tempoh menetap di pulau pinang Ibu)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Tempoh Menetap Ibu/Penjaga di Pulau Pinang<span class="required"></span></label>
                                        <input class="form-control" name="TempohMenetapIbu" id="TempohMenetapIbu" type="num" placeholder="Tahun" required value="<?php echo $TempohMenetapIbu; ?>">
                                    </div>
                                    <!-- Form Group (no phone Ibu)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nombor Telefon Bimbit Ibu/Penjaga<span class="required"></span></label>
                                        <input class="form-control" name="TelefonIbu" id="TelefonIbu" type="tel" placeholder="No. Telefon Bimbit" required value="<?php echo $TelefonIbu; ?>">
                                    </div>
                                    <!-- Form Group (Pekerjaan Ibu)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Pekerjaan Ibu/Penjaga (Jika tidak bekerja isikan N/A)<span class="required"></span></label>
                                        <input class="form-control" name="PekerjaanIbu" id="PekerjaanIbu" type="text" placeholder="Pekerjaan" required value="<?php echo $PekerjaanIbu; ?>">
                                    </div>
                                    <!-- Form Group (Alamat majikan Ibu)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Alamat Majikan Ibu/Penjaga (Jika tidak bekerja isikan N/A)<span class="required"></span></label>
                                        <input class="form-control" name="AlamatMajikanIbu" id="AlamatMajikanIbu" type="text" placeholder="Alamat Majikan" required value="<?php echo $AlamatMajikanIbu; ?>">
                                    </div>
                                    <!-- Form Group (Pendapatan Ibu)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Pendapatan Bersih Ibu/Penjaga (Jika tiada pendapatan isikan N/A)</label>
                                        <input class="form-control" name="PendapatanBersihIbu" id="PendapatanBersihIbu" type="num" placeholder="Pendapatan Bersih" required value="<?php echo $PendapatanBersihIbu; ?>">
                                    </div>
                                    <!-- Form Group (gambar slip gaji ibu)-->
                                    <div class="mb-3">
                                        <label for="formFile" class="small mb-1">Gambar Slip Gaji Ibu/Penjaga (Jika tiada pendapatan tidak perlu muat naik)</label>
                                        <input class="form-control" name="SlipGajiIbu" type="file" id="SlipGajiIbu" value="<?php echo $SlipGajiIbu; ?>">
                                    </div>
                                    <!-- Save changes button-->
                                    <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                                </form>
                            </div>
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
</body>

</html>