<?php

include('config.php');

// Initialize the session

session_start();

$username = $_GET['username'];



// Check if the user is logged in, if not then redirect him to login page

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {

    header("location: login.php");

    exit;
}

// Setting up variable 

$NamaPenuh = $AlamatPelajar = $PoskodPelajar = $negeri = $KursusPelajar = $kuliah = $statusBiasiswa = $tarikhterima = '';



// Get student information 

$query = "SELECT * FROM maklumatdiripelajar WHERE username = '$username'";

$result = $link->query($query);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $NamaPenuh = $row['NamaPenuh'];

        $AlamatPelajar = $row['AlamatPelajar'];

        $PoskodPelajar = $row['PoskodPelajar'];

        $negeri = $row['negeri'];
    }
}



// Get course information 

$query = "SELECT * FROM pilihankursuspelajar WHERE username = '$username'";

$result = $link->query($query);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $KursusPelajar = $row['KursusPelajar'];

        $kuliah = $row['kuliah'];

        $statusBiasiswa = $row['StatusBiasiswa'];

        $tarikhterima = $row['tarikhterima'];
    }
}

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <style>
        @media print {



            .noprint {



                display: none;



            }



        }
    </style>



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

    <div class="container-fluid px-4">

        <div class="main-body">

            <!-- download letterhead then paste -->

            <img src="../assets/img/letterh.png" width="100%" alt="" />

            <table width="100%" border="0">

                <tbody>

                    <tr>

                        <td>Tarikh</td>

                        <td>: <?= $tarikhterima; ?></td>

                    </tr>

                    <tr>

                        <td>Rujukan</td>

                        <td>: KITAB/BEND/UBBP/2023(S2-23/24)</td>

                    </tr>

                </tbody>

            </table>  

            <br>

            <br>

            <?= $NamaPenuh; ?>

            <br>

            <?php if (!empty($AlamatPelajar)) {

                echo $AlamatPelajar . ",";
            } ?>

            <br>

            <!-- <?php if (!empty($PoskodPelajar)) {

                        echo $PoskodPelajar . ",";;
                    } ?> -->

            <?php if (!empty($negeri)) {

                echo $negeri . ",";
            } ?>

            <br>



            <p><strong>Saudara/i,</strong></p>

            <strong>

                <div style="font-family: 'Freestyle Script';font-size: 20pt">Syabas dan Tahniah !!!</div>

            </strong>

            <p><strong>SURAT TAWARAN BIASISWA PENDIDIKAN ZPP-KITAB UNTUK

                    <?= strtoupper($KursusPelajar); ?>

                </strong></p>



            Sukacita dimaklumkan bahawa saudara/i ditawarkan Biasiswa Pendidikan ZPP-KITAB untuk mengikuti pengajian seperti berikut:<br>

            <br>



            <table width="100%" border="0" cellpadding="0" cellspacing="0">

                <tbody>

                    <tr>

                        <td width="30%">PUSAT PENGAJIAN</td>

                        <td width="70%">&nbsp;: <?= $kuliah; ?></td>

                    </tr>

                    <tr>

                        <td>PROGRAM</td>

                        <td>&nbsp;: <?= $KursusPelajar; ?></td>



                    </tr>



                </tbody>

            </table>

            <p>2. Tawaran Biasiswa Pendidikan ZPP-KITAB adalah seperti berikut:</p>

            <table width="100%">



                <tr>

                    <!-- this will be based from admin page, will be fixed -->

                    <td>KATEGORI</td>

                    <td>&nbsp;: <?= $statusBiasiswa; ?></td>



                </tr>



            </table>







            <p>3. Kelulusan tawaran ini adalah tertakluk kepada syarat-syarat dan terma-terma seperti di dalam Garis Panduan Biasiswa Pendidikan ZPP-KITAB dan Perjanjian Biasiswa Pendidikan ZPP-KITAB yang ditandatangani di antara Pelajar, Penjamin I, Penjamin II dengan Pihak KITAB.<br>

                <br>



                4. Penerima yang menerima tawaran ini dikehendaki menandatangani Dokumen Perjanjian Biasiswa Pendidikan ZPP-KITAB Pulau Pinang dan mengembalikan kepada Unit Biasiswa dan Bantuan Pengajian dalam tempoh empat belas (14) hari bekerja dari tarikh surat tawaran biasiswa dikeluarkan. Sekiranya tidak dikembalikan dalam tempoh tersebut, maka surat tawaran ini adalah terbatal.

            </p>



            <p style="page-break-before: always;">&nbsp;</p>

            Sekian, terima kasih.<br>

            <br>

            <div style="font-family: 'Freestyle Script';font-size: 20pt"><strong>Memacu Legasi Tarbiah</strong> <br>

                <strong>Ke Arah Melahirkan Ulul Albab</strong>

            </div>

            <p><br>

                Yang menjalankan amanah,<br>

                <!-- download sign zameer then paste -->

                <img src="../assets/img/ZAMEER.png" width="100" height="92" alt="" /><br>

                <strong>MOHD ZAMEER BIN ABDUL TALIB</strong><br>

                Bendahari<br>

                Kolej Islam Teknologi Antarabangsa (KITAB)<br>

                Pulau Pinang<br>

            </p>

            Sk:-<br>

            Fail Pelajar<br>

            Unit Kemasukan dan Rekod Jabatan Pengurusan Akademik<br>



            <button class="noprint" onclick="window.print()">Cetak Surat</button>





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

        </div>

    </div>



</body>



</html>