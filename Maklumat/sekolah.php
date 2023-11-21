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
$NamaSekolah = $TahunSPM = $BM = $BA = $SEJ = $MATH = $KeputusanSPM = $SijilTamatSekolah = $NamaPenuh = '';

// For passing the data into database and redirect to the next page
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // set the parameters
    $NamaSekolah = $_POST["NamaSekolah"];
    $TahunSPM = $_POST["TahunSPM"];
    $BM = $_POST["BM"];
    $BA = $_POST["BA"];
    $SEJ = $_POST["SEJ"];
    $MATH = $_POST["MATH"];

    // set up to upload KeputusanSPM and SijilTamatSekolah
    $statusMsg = '';

    // File upload directory 
    $targetDir = "../image/";

    if (!empty($_FILES["KeputusanSPM"]["name"])) {
        $fileName = basename($_FILES["KeputusanSPM"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["KeputusanSPM"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $KeputusanSPM = $fileName;
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

    if (!empty($_FILES["SijilTamatSekolah"]["name"])) {
        $fileName = basename($_FILES["SijilTamatSekolah"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server 
            if (move_uploaded_file($_FILES["SijilTamatSekolah"]["tmp_name"], $targetFilePath)) {
                // Insert image file name into database 
                $SijilTamatSekolah = $fileName;
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
    $sql = "INSERT INTO maklumatakademikpelajar ( NamaSekolah, TahunSPM, BM, BA, SEJ, MATH, KeputusanSPM, SijilTamatSekolah, username, status) VALUES ('$NamaSekolah', '$TahunSPM', '$BM', '$BA',
    '$SEJ', '$MATH', '$KeputusanSPM', '$SijilTamatSekolah', '$username','1')";

    // Prepare the sql and connect with database
    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to next page
            header("location: ../index.php");
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
                            <div class="card-header">Maklumat Pendidikan</div>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                    <!-- Form Group (nama sekolah)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Nama Sekolah<span class="required"></span></label>
                                        <input class="form-control" name="NamaSekolah" id="NamaSekolah" type="text" placeholder="Nama Sekolah" required value="<?php echo $NamaSekolah; ?>">
                                    </div>
                                    <!-- Form Group (tahun SPM)-->
                                    <div class="mb-3">
                                        <label class="small mb-1">Tahun Lepasan SPM<span class="required"></span></label>
                                        <input class="form-control" name="TahunSPM" id="TahunSPM" type="text" placeholder="Tahun Lepasan SPM" required value="<?php echo $TahunSPM; ?>">
                                    </div>
                                    <!-- Form Group (Bahasa Melayu)-->
                                    <div class=" row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label small mb-1">Keputusan Bahasa Melayu<span class="required"></span></label>
                                            <select id="inputState" class="form-select" name='BM' value="<?php echo $BM; ?>">
                                                <option value="A+">A+</option>
                                                <option value="A">A</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B">B</option>
                                                <option value="C+">C+</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="G">G</option>
                                                <option value="TH">TH</option>
                                            </select>
                                        </div>
                                        <!-- Form Group (English)-->
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label small mb-1">Keputusan Bahasa Arab<span class="required"></span></label>
                                            <select id="inputState" class="form-select" name='BA' value="<?php echo $BA; ?>">
                                                <option value="A+">A+</option>
                                                <option value="A">A</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B">B</option>
                                                <option value="C+">C+</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="G">G</option>
                                                <option value="TH">TH</option>
                                                <option value="T">Tidak Mengambil Subjek</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Form Group (Sejarah)-->
                                    <div class=" row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label small mb-1">Keputusan Sejarah<span class="required"></span></label>
                                            <select id="inputState" class="form-select" name='SEJ' value="<?php echo $SEJ; ?>">
                                                <option value="A+">A+</option>
                                                <option value="A">A</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B">B</option>
                                                <option value="C+">C+</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="G">G</option>
                                                <option value="TH">TH</option>
                                            </select>
                                        </div>
                                        <!-- Form Group (Addmath)-->
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label small mb-1">Keputusan Matematik<span class="required"></span></label>
                                            <select id="inputState" class="form-select" name='MATH' value="<?php echo $MATH; ?>">
                                                <option value="A+">A+</option>
                                                <option value="A">A</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B">B</option>
                                                <option value="C+">C+</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                                <option value="G">G</option>
                                                <option value="TH">TH</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Form Group (gambar SPM)-->
                                    <div class="mb-3">
                                        <label for="formFile" class="small mb-1">Gambar Keputusan SPM<span class="required"></span></label>
                                        <input class="form-control" name="KeputusanSPM" type="file" id="KeputusanSPM" required value="<?php echo $KeputusanSPM; ?>">
                                    </div>
                                    <!-- Form Group (gambar sijil berhenti)-->
                                    <div class="mb-3">
                                        <label for="formFile" class="small mb-1">Gambar Sijil Tamat Persekolahan<span class="required"></span></label>
                                        <input class="form-control" name="SijilTamatSekolah" type="file" id="SijilTamatSekolah" required value="<?php echo $SijilTamatSekolah; ?>">
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