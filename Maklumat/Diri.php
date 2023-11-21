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
$NamaPenuh = $NoKP = $AlamatPelajar = $PoskodPelajar = $negeri = $TelefonPelajar = $EmailPelajar = $bangsa = $agama = $TarafKahwin = $TarafOku = $ICDepanPelajar = $GambarPassport = $BandarPelajar = $PendapatanPelajar = $DUNPelajar = $ParlimenPelajar = '';
$StatusPermohonan = '';
// setting up the parameter name

// For passing the data into database and redirect to the next page
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $NamaPenuh = $_POST["NamaPenuh"];
    $NoKP = $_POST["NoKP"];
    $AlamatPelajar = $_POST["AlamatPelajar"];
    $BandarPelajar = $_POST["BandarPelajar"];
    $PoskodPelajar = $_POST["PoskodPelajar"];
    $negeri = $_POST["negeri"];
    $TelefonPelajar = $_POST["TelefonPelajar"];
    $EmailPelajar = $_POST["EmailPelajar"];
    $PendapatanPelajar = $_POST["PendapatanPelajar"];
    $DUNPelajar = $_POST["DUNPelajar"];
    $ParlimenPelajar = $_POST["ParlimenPelajar"];
    $bangsa = $_POST["bangsa"];
    $agama = $_POST["agama"];
    $TarafKahwin = $_POST["TarafKahwin"];
    $TarafOku = $_POST["TarafOku"];

    // set up to upload ICDepanPelajar and GambarPassport
    $statusMsg = '';

    // File upload directory 
    $targetDir = "../image/";

    // if (isset($_POST["submit"])) {
    if (!empty($_FILES["ICDepanPelajar"]["name"])) {
        $fileName = basename($_FILES["ICDepanPelajar"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["ICDepanPelajar"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $ICDepanPelajar = $fileName;
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
    // }

    // Display status message 
    //echo $statusMsg;


    if (!empty($_FILES["GambarPassport"]["name"])) {
        $fileName = basename($_FILES["GambarPassport"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["GambarPassport"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $GambarPassport = $fileName;
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
    // }

    // Display status message 
    //echo $statusMsg;

    // Insert the value into database
    $sql = "INSERT INTO maklumatdiripelajar (NamaPenuh, NoKP, AlamatPelajar, BandarPelajar, PoskodPelajar, negeri, TelefonPelajar, EmailPelajar, PendapatanPelajar, DUNPelajar, ParlimenPelajar, bangsa, agama, TarafKahwin, TarafOku, ICDepanPelajar, GambarPassport, username, status) VALUES ('$NamaPenuh', '$NoKP', '$AlamatPelajar', '$BandarPelajar','$PoskodPelajar', '$negeri', '$TelefonPelajar', '$EmailPelajar',  '$PendapatanPelajar', '$DUNPelajar', '$ParlimenPelajar', '$bangsa', '$agama', '$TarafKahwin', '$TarafOku', '$ICDepanPelajar', '$GambarPassport', '$username','1')";

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to next page
            header("location: IbuBapa.php");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
            echo "Error: " . $stmt . "<br>" . $link->error;
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
    // Close connection
    mysqli_close($link);
}

$query = "SELECT * FROM maklumatdiripelajar WHERE username = '$username'";
$result = $link->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $NamaPenuh = $row['NamaPenuh'];
        //$ICDepanPelajar = $row['ICDepanPelajar'];
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
                            <div class="card-header">Maklumat Diri</div>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                    <!-- Form Group (nama penuh)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nama Penuh Seperti Di Dalam Kad Pengenalan<span class="required"></span></label>
                                        <input class="form-control" name="NamaPenuh" id="NamaPenuh" type="text" placeholder="Nama Penuh" required value="<?php echo $NamaPenuh; ?>">
                                    </div>
                                    <!-- Form Group (number ic)-->
                                    <div class=" mb-3">
                                        <label class="small mb-1">Nombor Kad Pengenalan<span class="required"></span></label>
                                        <input class="form-control" name="NoKP" id="NoKP" type="text" placeholder="No. Kad Pengenalan" required value="<?php echo $NoKP; ?>">
                                    </div>
                                    <!-- Form Group (gambar IC)-->
                                    <div class="mb-3">
                                        <label for="formFile" class="small mb-1">Gambar Kad Pengenalan, Pastikan Kad Pengenalan Muka Depan dan Belakang di Dalam 1 Muka Surat<span class="required"></span></label>
                                        <input class="form-control" name="ICDepanPelajar" type="file" id="ICDepanPelajar" value="<?php echo $ICDepanPelajar; ?>">
                                    </div>
                                    <!-- Form Group (gambar passport)-->
                                    <div class="mb-3">
                                        <label for="formFile" class="small mb-1">Gambar Berukuran Passport<span class="required"></span></label>
                                        <input class="form-control" name="GambarPassport" type="file" id="GambarPassport" value="<?php echo $GambarPassport; ?>">
                                    </div>
                                    <!-- Form Group (alamat)-->
                                    <div class=" mb-3">
                                        <label class="small mb-1">Alamat<span class="required"></span></label>
                                        <input class="form-control" name="AlamatPelajar" id="AlamatPelajar" type="text" placeholder="Alamat" required value="<?php echo $AlamatPelajar; ?>">
                                    </div>
                                    <!-- Form Group (bandar)-->
                                    <div class=" mb-3">
                                        <label class="small mb-1">Bandar<span class="required"></span></label>
                                        <input class="form-control" name="BandarPelajar" id="BandarPelajar" type="text" placeholder="Bandar" required value="<?php echo $BandarPelajar; ?>">
                                    </div>
                                    <!-- Form Row-->
                                    <div class=" row gx-3 mb-3">
                                        <!-- Form Group (poskod)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1">Poskod<span class="required"></span></label>
                                            <input class="form-control" name="PoskodPelajar" id="PoskodPelajar" type="text" placeholder="Poskod" required value="<?php echo $PoskodPelajar; ?>">
                                        </div>
                                        <!-- Form Group (negeri)-->
                                        <div class=" col-md-6">
                                            <label for="inputState" class="form-label small mb-1">Negeri<span class="required"></span></label>
                                            <select id="inputState" class="form-select" name='negeri'>
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
                                    <!-- Form Group (number phone)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nombor Telefon Bimbit<span class="required"></span></label>
                                        <input class="form-control" name="TelefonPelajar" id="TelefonPelajar" type="tel" placeholder="No. Telefon Bimbit" required value="<?php echo $TelefonPelajar; ?>">
                                    </div>
                                    <!-- Form Group (email)-->
                                    <div class=" mb-3">
                                        <label class="small mb-1">Email<span class="required"></span></label>
                                        <input class="form-control" name="EmailPelajar" id="EmailPelajar" type="email" placeholder="Email" required value="<?php echo $EmailPelajar; ?>">
                                    </div>
                                    <!-- Form Group (pendapatan pelajar)-->
                                    <div class=" mb-3">
                                        <label class="small mb-1">Pendapatan (Jika tiada pendapatan isikan N/A)<span class="required"></span></label>
                                        <input class="form-control" name="PendapatanPelajar" id="PendapatanPelajar" type="text" placeholder="Pendapatan" required value="<?php echo $PendapatanPelajar; ?>">
                                    </div>
                                    <div class=" row gx-3 mb-3">
                                        <!-- Form Group (DUN)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1">Kawasan DUN<span class="required"></span></label>
                                            <input class="form-control" name="DUNPelajar" id="DUNPelajar" type="text" placeholder="DUN" required value="<?php echo $DUNPelajar; ?>">
                                        </div>
                                        <!-- Form Group (Parlimen)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1">Kawasan Parlimen<span class="required"></span></label>
                                            <input class="form-control" name="ParlimenPelajar" id="ParlimenPelajar" type="text" placeholder="Parlimen" required value="<?php echo $ParlimenPelajar; ?>">
                                        </div>
                                    </div>
                                    <div class=" row gx-3 mb-3">
                                        <!-- Form Group (Bangsa)-->
                                        <div class="col-md-6">
                                            <label for="inputRace" class="form-label small mb-1">Bangsa<span class="required"></span></label>
                                            <select id="inputRace" class="form-select" name='bangsa'>
                                                <option value="Melayu">Melayu</option>
                                                <option value="Cina">Cina</option>
                                                <option value="India">India</option>
                                                <option value="Lain-Lain">Lain-Lain</option>
                                            </select>
                                        </div>
                                        <!-- Form Group (Agama)-->
                                        <div class="col-md-6">
                                            <label for="inputReligion" class="form-label small mb-1">Agama<span class="required"></span></label>
                                            <select id="inputRelion" class="form-select" name='agama'>
                                                <option value="Islam">Islam</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Lain-Lain">Lain-Lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (taraf kahwin)-->
                                        <div class="col-md-6">
                                            <label for="inputMarriage" class="form-label small mb-1">Taraf Perkahwinan<span class="required"></span></label>
                                            <select id="inputMarriage" class="form-select" name='TarafKahwin'>
                                                <option value="Berkahwin">Berkahwin</option>
                                                <option value="Bujang">Bujang</option>
                                                <option value="Bercerai">Bercerai</option>
                                                <option value="Lain-Lain">Lain-Lain</option>
                                            </select>
                                        </div>
                                        <!-- Form Group (oku)-->
                                        <div class="col-md-6">
                                            <label for="inputDisability" class="form-label small mb-1">Sebarang Kecacatan<span class="required"></span></label>
                                            <select id="inputDisability" class="form-select" name='TarafOku'>
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
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