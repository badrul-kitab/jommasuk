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

// Query to fetch user detail if there's not data it will show empty string 
$nama_pelajar =  $nokp_pelajar = $kursus_pelajar = $kemasukan_pelajar = $status_permohonan = $status_biasiswa = $PilihanPelajar = $NamaPenuh = $Asrama = $ModPengajian = $tarikhterima = '';

// Get the student appliucation information
$query = "SELECT * FROM pilihankursuspelajar WHERE username = '$username'";
$result = $link->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nama_pelajar = $row['NamaPenuh'];
        $nokp_pelajar = $row['NoKP'];
        $kursus_pelajar = $row['KursusPelajar'];
        $kemasukan_pelajar = $row['KemasukanPelajar'];
        $status_permohonan = $row['StatusPermohonan'];
        $PilihanPelajar = $row['PilihanPelajar'];
        $status_biasiswa = $row['StatusBiasiswa'];
        $Asrama = $row['Asrama'];
        $ModPengajian = $row['ModPengajian'];
    }
}

// For passing the data into database and redirect to the next page
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $PilihanPelajar = $_POST["PilihanPelajar"];
    $tarikhterima = date("d/m/Y");

    // Insert the value into database
    $sql = "UPDATE pilihankursuspelajar SET PilihanPelajar = '$PilihanPelajar', tarikhterima = '$tarikhterima' WHERE username = '$username' ";

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to next page
            header("location: ../surat/dokumen.php");
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
                                <li class="breadcrumb-item active" aria-current="page">Status Permohonan</li>
                            </ol>
                        </nav>
                        <!-- /Breadcrumb -->
                        <!-- Paparan Maklumat Diri -->
                        <div class="col-md-15">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Bil</th>
                                        <th scope="col">Nama Penuh</th>
                                        <th scope="col">Kad Pengenalan</th>
                                        <th scope="col">Pilihan Kursus</th>
                                        <th scope="col">Kemasukan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Status Biasiswa</th>
                                        <th scope="col">Asrama</th>
                                        <th scope="col">Mod Pengajian</th>
                                        <th scope="col">Pilihan Anda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><?php
                                            echo "$nama_pelajar";
                                            ?></td>
                                        <td><?php
                                            echo "$nokp_pelajar";
                                            ?></td>
                                        <td><?php
                                            echo "$kursus_pelajar";
                                            ?></td>
                                        <td><?php
                                            echo "$kemasukan_pelajar";
                                            ?></td>
                                        <td><?php
                                            echo "$status_permohonan";
                                            ?></td>
                                        <td><?php
                                            echo "$status_biasiswa";
                                            ?></td>
                                        <td><?php
                                            echo "$Asrama";
                                            ?></td>
                                        <td><?php
                                            //echo "$ModPengajian";
                                            if ($ModPengajian == "SM") {
                                                echo "Sepenuh Masa";
                                            } elseif ($ModPengajian == "HM") {
                                                echo "Hujung Minggu";
                                            }
                                            ?></td>
                                        <td><?php
                                            echo "$PilihanPelajar";
                                            ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <br>
                        <br>
                        <?php
                        $DisplayForm = true;
                        if (isset($_POST['submit'])) {
                            $DisplayForm = false;
                        }
                        if ($DisplayForm) {
                            if ($status_permohonan == 'Layak' && $PilihanPelajar == '') {
                        ?>
                                <div id="pilihanpelajar2" class="col-md-15">
                                    <h4> Tahniah! Anda layak untuk masuk ke KITAB. Sila sahkan kemasukan anda</h4>
                                    <form id="formpilihan" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class=" row gx-3 mb-3">
                                            <div class=" col-md-3">
                                                <label for="inputState" class="form-label small mb-1">Pilihan Saya</label>
                                                <select id="inputState" class="form-select" name='PilihanPelajar'>
                                                    <option value="Terima">Terima</option>
                                                    <option value="Tolak">Tolak</option>
                                                </select>
                                            </div>
                                            <div class=" col-md-3">
                                                <br>
                                                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php
                            } elseif ($status_permohonan == 'Layak' &&  $PilihanPelajar == 'Terima') {
                            ?>
                                <div class="col-md-15">
                                    <h4> Anda telah menerima tawaran</h4>
                                </div>
                            <?php
                            } elseif ($status_permohonan == 'Dalam Pertimbangan' &&  $PilihanPelajar == '') {
                            ?>
                                <div class="col-md-15">
                                    <h4>Permohonan anda masih dalam pertimbangan</h4>
                                </div>
                            <?php
                            } elseif ($status_permohonan == '') {
                            ?>
                                <div class="col-md-15">
                                    <!-- Tukar link bila dah di website -->
                                    <h4> Sila buat permohonan di https://jommasuk.kitab.edu.my/kemasukan/permohonan.php</h4>
                                </div>
                            <?php
                            } elseif ($status_permohonan == 'Layak' && $PilihanPelajar == 'Tolak') {
                            ?>
                                <div class="col-md-15">
                                    <h4> Anda telah menolak tawaran</h4>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-md-15">
                                    <h4> Maaf, permohonan anda tidak berjaya</h4>
                                </div>
                        <?php
                            }
                        }


                        ?>
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