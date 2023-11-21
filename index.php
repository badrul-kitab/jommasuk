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

$nama_pelajar = $email_pelajar = $nokp_pelajar = $telefon_pelajar = $alamat_pelajar = $status_diri = $status_ibubapa = $status_akademik = $ICDepanPelajar = $GambarPassport = '';



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



$query = "SELECT * FROM maklumatdiripelajar WHERE username = '$username'";

$result = $link->query($query);

if ($result->num_rows > 0) {

  while ($row = $result->fetch_assoc()) {

    $NamaPenuh = $row['NamaPenuh'];

    //$ICDepanPelajar = 'image/' .$row['ICDepanPelajar'];

    $GambarPassport = 'image/' . $row['GambarPassport'];
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

          <li><a class="dropdown-item" href="documentation/documentation.html">Manual Jom Masuk</a></li>

          <li><a class="dropdown-item" href="https://wa.me/60193932471">Hubungi IT</a></li>

          <li>

            <hr class="dropdown-divider" />

          </li>

          <li><a class="dropdown-item" href="logout.php">Logout</a></li>

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

            <a class="nav-link" href="index.php">

              <div class="sb-nav-link-icon">

                <i class="fas fa-tachometer-alt"></i>

              </div>

              Maklumat Diri

            </a>

            <div class="sb-sidenav-menu-heading">Permohonan</div>

            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHR" aria-expanded="false" aria-controls="collapseHR">

              <div class="sb-nav-link-icon">

                <i class="fas fa-columns"></i>

              </div>

              Permohonan

              <div class="sb-sidenav-collapse-arrow">

                <i class="fas fa-angle-down"></i>

              </div>

            </a> -->

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

            <!-- <div class="collapse" id="collapseHR" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

              <nav class="sb-sidenav-menu-nested nav">

                <a class="nav-link" href="kemasukan/permohonan.php">Permohonan Baru</a>

                <a class="nav-link" href="kemasukan/status.php">Status Permohonan</a>

              </nav>

            </div> -->

            <div class="sb-sidenav-menu-heading">Maklumat</div>

            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAkademik" aria-expanded="false" aria-controls="collapseAkademik">

              <div class="sb-nav-link-icon">

                <i class="fas fa-columns"></i>

              </div>

              Kemasukan ke KITAB

              <div class="sb-sidenav-collapse-arrow">

                <i class="fas fa-angle-down"></i>

              </div>

            </a> -->

            <a class="nav-link" href="surat/dokumen.php">

              <div class="sb-nav-link-icon">

                <i class="fas fa-tachometer-alt"></i>

              </div>

              Dokumen

            </a>

            <div class="collapse" id="collapseAkademik" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">

              <nav class="sb-sidenav-menu-nested nav">

                <a class="nav-link" href="surat/dokumen.php">Dokumen yang perlu disediakan</a>

                <!-- <a class="nav-link" href="#">Barang kemasukan ke asrama</a> -->

                <!--<a class="nav-link" href="Akedemik/TambahKursusBaru.php">Tambah Kursus Baru</a>-->

              </nav>

            </div>

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

                <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                <li class="breadcrumb-item active" aria-current="page">Maklumat Diri</li>

              </ol>

            </nav>

            <!-- /Breadcrumb -->

            <!-- Personal Information -->

            <div class="row gutters-sm">

              <h3 class="text-primary">Maklumat Diri</h3>

              <div class="col-md-4 mb-3">

                <div class="card">

                  <div class="card-body">

                    <!-- <div class="gallery">

                      <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($ICDepanPelajar); ?>" />

                    </div> -->

                    <div class="d-flex flex-column align-items-center text-center">

                      <img src="<?php echo $GambarPassport; ?>" class="rounded-circle" width="200">

                      <div class="mt-3">

                        <h4>

                          <?php

                          echo "$nama_pelajar";

                          ?>

                        </h4>

                        <!-- <p class="text-secondary mb-1">Bakal Pelajar KITAB</p>

                        <p class="text-muted font-size-sm">Pulau Pinang</p> -->

                      </div>

                    </div>

                  </div>

                </div>

                <!--<div class="card mt-3">

                  <ul class="list-group list-group-flush">

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">

                          <circle cx="12" cy="12" r="10"></circle>

                          <line x1="2" y1="12" x2="22" y2="12"></line>

                          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>

                        </svg>Website</h6>

                      <span class="text-secondary">www.kitab.edu.my</span>

                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">

                          <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>

                        </svg>Github</h6>

                      <span class="text-secondary">N/A</span>

                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info">

                          <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>

                        </svg>Twitter</h6>

                      <span class="text-secondary">N/A</span>

                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">

                          <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>

                          <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>

                          <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>

                        </svg>Instagram</h6>

                      <span class="text-secondary">N/A</span>

                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary">

                          <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>

                        </svg>Facebook</h6>

                      <span class="text-secondary">N/A</span>

                    </li>

                  </ul>

                </div>-->

              </div>

              <div class="col-md-8">

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

                    <div class="row">

                      <div class="col-sm-12">

                        <?php

                        $DisplayForm = true;

                        if (isset($_POST['submit'])) {

                          $DisplayForm = false;
                        }

                        if ($DisplayForm) {

                          if ($status_diri == '' && $status_ibubapa == '' && $status_akademik == '') {

                        ?>

                            <a type="submit" class="btn btn-primary" value="Isi Maklumat Diri" name="submit" href="Maklumat\Diri.php">Isi Maklumat Diri</a>

                            <!-- <input type="submit" class="btn btn-primary" value="Submit" name="submit"> -->


                          <?php

                          } else {

                          ?>

                            <div class="col-md-15">

                              <h6> Anda telah mengisi maklumat diri, sila buat permohonan anda</h6>

                              <a class="btn btn-primary" href="kemasukan/permohonan.php">Permohonan</a>
                              <!-- <input type="hidden" value="<?= $GambarPassport; ?>" name="BiasiswaKitab"> -->
                            </div>

                        <?php

                          }
                        }

                        ?>

                        <!-- <a class="btn btn-primary" href="Maklumat/Diri.php">Isi Maklumat Diri</a> -->

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <!-- /Personal Information -->

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