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
$NamaPenuh = $AlamatPelajar = $PoskodPelajar = $negeri = $KursusPelajar = $kemasukan_pelajar = $kuliah = $tempoh_pengajian = $pkp_id = '';

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
        $kemasukan_pelajar = $row['KemasukanPelajar'];
        $kuliah = $row['kuliah'];
        $tempoh_pengajian = $row['TempohPengajian'];
        $pkp_id = $row['pkp_id'];
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
            <img src="../assets/img/letterh.png" width="100%" alt="" />

            <table width="100%" border="0">

                <tbody>

                    <tr>

                        <td>Tarikh</td>

                        <!-- <td>: <?= date("d/m/Y", strtotime($tarikhkemaskinijpa)); ?></td> -->
                        <td>: <?= date("d/m/Y"); ?></td>

                    </tr>

                    <tr>

                        <td>Rujukan</td>

                        <!-- <td>: KITAB/JPA/KEMASUKAN/<?= date("Y", strtotime($tarikhkemaskinijpa)); ?>(<?= $nosurat; ?>)</td> -->
                        <td>: KITAB/JPA/KEMASUKAN/<?= date("Y"); ?>(2-23/24)</td>

                    </tr>

                </tbody>

            </table>  <br>

            <?= $NamaPenuh; ?><br>

            <?php if (!empty($AlamatPelajar)) {
                echo $AlamatPelajar . ",";
            } ?><br>

            <?php if (!empty($PoskodPelajar)) {
                echo $PoskodPelajar;
            } ?>
            <br>

            <?php if (!empty($negeri)) {
                echo $negeri . ",";
            } ?><br>



            <strong>
                <div style="font-family: 'Freestyle Script';font-size: 20pt">Syabas dan Tahniah !!!</div>
            </strong>



            <strong>TAWARAN KEMASUKAN KE KOLEJ ISLAM TEKNOLOGI ANTARABANGSA (KITAB) PULAU PINANG SESI PENGAJIAN AKADEMIK <?= $kemasukan_pelajar; ?></strong><br>

            <br>



            Sekalung tahniah diucapkan kepada saudara/saudari kerana terpilih mengikuti program pengajian di Kolej Islam Teknologi Antarabangsa (KITAB) Pulau Pinang, Malaysia. Maklumat program pengajian adalah seperti berikut:

            <table width="100%" border="1" cellpadding="3" cellspacing="3">

                <tbody>

                    <tr>
                        <td width="178" valign="top">Sesi Pengajian</td>
                        <!-- this should be changed to dynamic, but for now will stick with manual -->
                        <td colspan="3">Semester 2 Sesi 2023/2024</td>
                    </tr>
                    <tr>

                        <td>Program Ditawarkan</td>

                        <td colspan="3"><?= $KursusPelajar; ?></td>

                    </tr>

                    <tr>

                        <td>Kuliah</td>

                        <td colspan="3"><?= $kuliah; ?></td>

                    </tr>

                    <tr>

                        <td>Yuran Pengajian</td>

                        <td colspan="3"> Sila rujuk lampiran struktur yuran pengajian.</td>

                    </tr>

                    <tr>

                        <td>Tempoh Pengajian</td>

                        <td colspan="3"><?= $tempoh_pengajian; ?></td>

                    </tr>

                    <tr>
                        <!-- this should be dynamic but for now we will stick with manual -->
                        <td>Tarikh Pendaftaran</td>

                        <td>30 JULAI 2023 (AHAD)</td>

                    </tr>

                    <tr>

                        <td>Masa</td>

                        <td>8.30 pagi - 4.00 petang</td>

                    </tr>

                    <tr>

                        <td>Tempat&nbsp;</td>

                        <td colspan="3">Bangunan Akademik, KITAB Pulau Pinang</td>

                    </tr>

                    <tr>

                        <td>Penginapan</td>

                        <td colspan="3">Disediakan (Pelajar semester 1 sahaja)&nbsp;</td>

                    </tr>

                    <tr>

                        <td>Maklumat Lanjut sila hubungi </td>

                        <td colspan="3">010-4535482 (JPA)<br>

                            Emel : pengurusan_akademik@kitab.edu.my</td>

                    </tr>

                </tbody>

            </table>

            <p><strong><u>Bayaran</u></strong><br>

                Calon hendaklah membuat pembayaran yuran pendaftaran sebanyak RM600.00 melalui Perbankan Internet atas nama <strong>KOLEJ ISLAM TEKNOLOGI ANTARABANGSA (KITAB) (KUTIPAN) </strong> di <strong>nombor akaun 1102 14 6008 (Bank Rakyat Malaysia Berhad)</strong>sebelum atau pada hari pendaftaran. Sila emailkan slip atau bukti pembayaran ke unithasil@kitab.edu.my (Rujuk Tatacara Bayaran di dalam http://kitab.edu.my).</p>

            <strong><u>PENTING:</u></strong><br>

            Anda dikehendaki memenuhi syarat-syarat tawaran seperti berikut:

            <ol>

                <li>Anda perlu menjawab tawaran ini melalui (http://jommasuk.kitab.edu.my) dengan kadar segera bagi memudahkan urusan penerimaan pelajar.</li>

                <li>Sila sediakan dokumen berikut <strong>DENGAN PENGESAHAN</strong> sebelum mendaftar:
                    <ol>
                        <li>Salinan surat tawaran</li>
                        <li>Salinan kad pengenalan pelajar</li>
                        <li>Salinan kad pengenalan ibu/ penjaga dan bapa/penjaga.</li>
                        <li>Salinan Sijil atau Slip Keputusan SPM/ Percubaan SPM/ STPM / STAM / Setaraf. </li>
                        <li>Salinan sijil berhenti sekolah </li>
                        <li>Gambar berukuran pasport (4 keping)</li>
                        <li>Slip pendapatan/pengesahan pendapatan ibu bapa atau waris terkini</li>
                        <li>Borang Pemeriksaan Kesihatan Pelajar</li>
                    </ol>
                </li>

                <li>Sekiranya anda didapati melakukan apa-apa pemalsuan dokumen, pihak KITAB berhak untuk membatalkan tawaran ini.</li>
                <li>Bagi pelajar yang tidak berjaya mendapat tawaran Biasiswa ZPP-KITAB, boleh memohon pembiayaan seperti berikut:
                    <ol>
                        <li>Dermasiswa/ Biasiswa : Biasiswa Pendidikan ZPP- KITAB, Dermasiswa Pengajian Zakat Pulau Pinang (Zakat Pulau Pinang)</li>
                        <li>Bantuan Pengajian : Bantuan Permulaan IPT (Zakat Pulau Pinang)</li>
                        <li>Pinjaman : Perbadanan Tabung Pendidikan Tinggi Nasional (PTPTN), Pinjaman Pendidikan ditawarkan oleh bank-bank komersil, Pinjaman Pendidikan Kerajaan Negeri Pulau Pinang</li>
                        <li>Simpanan/ Pembiayaan Sendiri : Kumpulan Wang Simpanan Pekerja (KWSP), Ibu bapa/ penjaga, Wang Simpanan Peribadi</li>

                    </ol>



                </li>
            </ol>

            <p>Pihak kolej mengucapkan selamat datang dan mengalu-alukan kedatangan saudara/saudari ke Kolej Islam Teknologi Antarabangsa (KITAB) Pulau Pinang. </p>

            Sekian, terima kasih.

            <div style="font-family: 'Freestyle Script';font-size: 20pt"><strong>Memacu Legasi Tarbiah</strong> <br>

                <strong>Ke Arah Melahirkan Ulul Albab</strong>
            </div>

            <p>Yang menjalankan tugas,<br>

                <img src="../assets/img/sign-jpa-fariza.png" width="167" height="107" alt="" /><br>

                <strong>WAN NURFARIZA BINTI WAN MAZLAN</strong><br>

                KETUA JABATAN PENGURUSAN AKADEMIK<br>
                KOLEJ ISLAM TEKNOLOGI ANTARABANGSA (KITAB)<br>
                PULAU PINANG<br>

                <br>



                <button class="noprint" onclick="window.print()">Cetak Surat</button>
        </div>
    </div>
</body>

</html>