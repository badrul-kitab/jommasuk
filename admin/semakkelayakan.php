<?php



include('config.php');

// Initialize the session

session_start();

// $nokpPelajar = '';



$noKP = $_GET['nokp'];

$username = $_SESSION['username'];



// Check if the user is logged in, if not then redirect him to login page

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {

    header("location: /login.php");

    exit;
}


$targetDir = "../image/";
$update_status = $nama_pelajar = $telefon_pelajar = $keputusan_BM = $keputusan_SEJ = $keputusan_MATH = $keputusan_BA = $pendapatan_bersih_bapa = $pendapatan_bersih_ibu = $pendapatan_bersih_isi_rumah = $username_pelajar = $kemasukan_kitab = $biasiswa_kitab = $biasiswaKitab = '';
$pendapatan_pelajar = $mod_pengajian = $dun_pelajar = $parlimen_pelajar = $KeputusanSPM = $SlipPendapatanBapa = $SlipPendapatanIbu = '';
$CatatanBendahari = $CatatanJPA = $NotaJPA = $NotaBendahari = '';
// Get the information

$query = "SELECT maklumatdiripelajar.DUNPelajar,maklumatdiripelajar.ParlimenPelajar,maklumatdiripelajar.NamaPenuh,maklumatdiripelajar.TelefonPelajar, maklumatdiripelajar.PendapatanPelajar, maklumatakademikpelajar.BM,maklumatakademikpelajar.SEJ,maklumatakademikpelajar.MATH,maklumatakademikpelajar.BA, maklumatdiripelajar.username FROM maklumatdiripelajar INNER JOIN maklumatakademikpelajar ON maklumatdiripelajar.username=maklumatakademikpelajar.username WHERE NoKP = '$noKP'";

$result = $link->query($query);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $nama_pelajar = $row['NamaPenuh'];

        $telefon_pelajar = $row['TelefonPelajar'];

        $keputusan_BM = $row['BM'];

        $keputusan_SEJ = $row['SEJ'];

        $keputusan_MATH = $row['MATH'];

        $keputusan_BA = $row['BA'];

        $username_pelajar = $row['username'];

        $pendapatan_pelajar = $row['PendapatanPelajar'];

        $dun_pelajar = $row['DUNPelajar'];

        $parlimen_pelajar = $row['ParlimenPelajar'];

        // $KeputusanSPM = $targetDir . $row['KeputusanSPM'];
    }
}



$query_pendapatan = "SELECT PendapatanBersihBapa, PendapatanBersihIbu FROM maklumatibubapapelajar WHERE username = '$username_pelajar'";

$result_pendapat = $link->query($query_pendapatan);

if ($result_pendapat->num_rows > 0) {

    while ($row2 = $result_pendapat->fetch_assoc()) {

        $pendapatan_bersih_bapa = $row2['PendapatanBersihBapa'];

        $pendapatan_bersih_ibu = $row2['PendapatanBersihIbu'];

        // $SlipPendapatanBapa = $targetDir . $row3['SlipGajiBapa'];

        // $SlipPendapatanIbu = $targetDir . $row3['SlipGajiIbu'];
    }
}



$pendapatan_bersih_isi_rumah = intval($pendapatan_bersih_bapa) + intval($pendapatan_bersih_ibu);

$query_biasiwa = "SELECT StatusBiasiswa, ModPengajian, CatatanJPA, CatatanBendahari FROM pilihankursuspelajar WHERE username = '$username_pelajar'";

$result_biasiswa = $link->query($query_biasiwa);

if ($result_biasiswa->num_rows > 0) {

    while ($row3 = $result_biasiswa->fetch_assoc()) {

        $biasiswa_kitab = $row3['StatusBiasiswa'];

        $mod_pengajian = $row3['ModPengajian'];

        $NotaJPA = $row3['CatatanJPA'];

        $NotaBendahari = $row3['CatatanBendahari'];
    }
}

$query_gambar = "SELECT maklumatibubapapelajar.SlipGajiBapa, maklumatibubapapelajar.SlipGajiIbu, maklumatakademikpelajar.KeputusanSPM FROM maklumatibubapapelajar INNER JOIN maklumatakademikpelajar WHERE maklumatibubapapelajar.username = maklumatakademikpelajar.username AND maklumatibubapapelajar.username='$username_pelajar'";
$result_gambar = $link->query($query_gambar);
if ($result_gambar->num_rows > 0) {
    while ($row4 = $result_gambar->fetch_assoc()) {
        $KeputusanSPM = '../image/' . $row4['KeputusanSPM'];
        $SlipPendapatanBapa = '../image/' . $row4['SlipGajiBapa'];
        $SlipPendapatanIbu = '../image/' . $row4['SlipGajiIbu'];
    }
}

// For passing the data into database and redirect to the next page

if ($_SERVER["REQUEST_METHOD"] == "POST") {



    // $noKP = $_GET['nokp'];

    $kemasukan_kitab = $_POST["Kemasukan"];

    $username_pelajar = $_POST["usernamePelajar"];

    $biasiswaKitab = $_POST['KelayakanBiasiswa'];

    $CatatanBendahari = $_POST['CatatanBendahari'];

    $CatatanJPA = $_POST['CatatanJPA'];

    // Update the value into database

    $sql = "UPDATE pilihankursuspelajar SET StatusPermohonan = '$kemasukan_kitab', StatusBiasiswa = '$biasiswaKitab',  CatatanJPA = '$CatatanJPA', CatatanBendahari = '$CatatanBendahari' WHERE username = '$username_pelajar'";



    if ($stmt = mysqli_prepare($link, $sql)) {



        // Attempt to execute the prepared statement

        if (mysqli_stmt_execute($stmt)) {

            // Redirect to next page

            echo "<script>window.close();</script>";

            //header("location: index.php");

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

        <a class="navbar-brand ps-3">Jom Masuk Kitab</a>

    </nav>

    </div>

    <div id="layoutSidenav_content">

        <main>

            <!--main content-->

            <div class="container-fluid px-4">

                <div class="main-body">

                    <!-- Paparan Maklumat Diri -->

                    <div class="col-md-15">

                        <br>

                        <br>

                        <br>

                        <h3>Maklumat Pemohon</h3>

                        <br>

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

                                        <h6 class="mb-0">Nombor Kad Pengenalan</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$noKP";

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

                                        <h6 class="mb-0">Keputusan SPM Bahasa Melayu</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$keputusan_BM";

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-sm-3">

                                        <h6 class="mb-0">Keputusan SPM Sejarah</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$keputusan_SEJ";

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-sm-3">

                                        <h6 class="mb-0">Keputusan SPM Matematik</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$keputusan_MATH";

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-sm-3">

                                        <h6 class="mb-0">Keputusan SPM Bahasa Arab</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$keputusan_BA";

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-sm-3">

                                        <h6 class="mb-0">Pendapatan Pelajar</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$pendapatan_pelajar";

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-sm-3">

                                        <h6 class="mb-0">Mod Pengajian</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        // echo "$mod_pengajian";
                                        if ($mod_pengajian == "SM") {
                                            echo "Sepenuh Masa";
                                        } elseif ($mod_pengajian == "HM") {
                                            echo "Hujung Minggu";
                                        }

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-sm-3">

                                        <h6 class="mb-0">Kawasan DUN Pelajar</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$dun_pelajar";

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-sm-3">

                                        <h6 class="mb-0">Kawasan Parlimen Pelajar</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$parlimen_pelajar";

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-sm-3">

                                        <h6 class="mb-0">Jumlah Pendapatan Bersih Isi Rumah</h6>

                                    </div>

                                    <div class="col-sm-9 text-secondary">

                                        <?php

                                        echo "$pendapatan_bersih_isi_rumah";

                                        ?>

                                    </div>

                                </div>

                                <hr>

                                <div>

                                    <img src="<?php echo $KeputusanSPM; ?>" height="400" width="400">

                                </div>

                                <hr>

                                <div>

                                    <img src="<?php echo $SlipPendapatanBapa; ?>" height="400" width="400">

                                </div>

                                <hr>

                                <div>

                                    <img src="<?php echo $SlipPendapatanIbu; ?>" height="400" width="400">

                                </div>

                                <hr>

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                    <div class=" row gx-3 mb-3">

                                        <div class=" col-md-6">

                                            <label for="inputState" class="form-label small mb-1">Kemasukan ke KITAB </label>

                                            <select id="inputState" class="form-select" name='Kemasukan'>

                                                <option value="Layak">Layak</option>

                                                <option value="Tidak Layak">Tidak Layak</option>

                                            </select>

                                        </div>

                                        <div class=" col-md-6">

                                            <label for="inputState" class="form-label small mb-1">Kelayakan Biasiswa</label>

                                            <select id="inputState" class="form-select" name='KelayakanBiasiswa'>

                                                <option value="ZPP-KITAB (Kategori Pertama)">ZPP-KITAB (Kategori Pertama)</option>

                                                <option value="ZPP-KITAB (Kategori Kedua)">ZPP-KITAB (Kategori Kedua)</option>

                                                <option value="ZPP-KITAB (Kategori Ketiga)">ZPP-KITAB (Kategori Ketiga)</option>

                                                <option value="Tidak Layak">Tidak Layak</option>

                                            </select>

                                        </div>

                                    </div>

                                    <div class=" row gx-3 mb-3">
                                        <!-- Form Group (Catatan JPA)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1">Catatan JPA</label>
                                            <input class="form-control" name="CatatanJPA" id="CatatanJPA" type="text" placeholder="<?php echo $NotaJPA; ?>" value="<?php echo $CatatanJPA; ?>">
                                        </div>
                                        <!-- Form Group (Catatan Bendahari)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1">Catatan Bendahari</label>
                                            <input class="form-control" name="CatatanBendahari" id="CatatanBendahari" type="text" placeholder="<?php echo $NotaBendahari; ?>" value="<?php echo $CatatanBendahari; ?>">
                                        </div>
                                    </div>

                                    <div>

                                        <!-- Save changes button-->

                                        <input type="submit" class="btn btn-primary" value="Submit" name="submit">

                                        <input type="hidden" value="<?= $username_pelajar; ?>" name="usernamePelajar">

                                        <!-- <input type="hidden" value="<?= $biasiswa_kitab; ?>" name="BiasiswaKitab"> -->
                                        <!-- <input type="hidden" value="<?= $KeputusanSPM; ?>" name="BiasiswaKitab"> -->



                                    </div>

                                </form>

                            </div>

                        </div>

                        <br>

                    </div>

                </div>

        </main>

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