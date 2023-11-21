<?php

include('config.php');

header("Content-Disposition: attachment; filename=SenaraiPelajar.xls");

header("Content-Type: application/vnd.ms-excel");

// $intake = $GET['intake'];

?>



<!doctype html>

<html>



<head>

    <meta charset="utf-8">

    <title>Untitled Document</title>







</head>



<body>

    <table width="100%" border="0">

        <tbody>

            <tr>

                <td>BIL</td>

                <td>NAMA</td>

                <td>NO KP</td>

                <td>EMAIL</td>

                <td>TELEFON</td>

                <td>ALAMAT</td>

                <td>POSKOD</td>

                <td>NEGERI</td>

                <td>BANGSA </td>

                <td>AGAMA</td>

                <td>KAHWIN</td>

                <td>OKU</td>

                <td>NAMA WARIS</td>

                <td>IC WARIS</td>

                <td>TELEFON WARIS</td>

                <td>NEGERI KELAHIRAN WARIS</td>

                <td>TEMPOH MENETAP WARIS</td>

                <td>ALAMAT MAJIKAN</td>

                <td>PEKERJAAN WARIS</td>

                <td>PENDAPATAN WARIS</td>

                <td>JUMLAH TANGGUNGAN</td>

                <td>NAMA WARIS 2</td>

                <td>IC WARIS 2</td>

                <td>TELEFON WARIS 2</td>

                <td>NEGERI KELAHIRAN WARIS 2</td>

                <td>TEMPOH MENETAP WARIS 2</td>

                <td>ALAMAT MAJIKAN WARIS 2</td>

                <td>PEKERJAAN WARIS 2</td>

                <td>PENDAPATAN WARIS 2</td>

                <td>PROGRAM</td>

                <td>ASRAMA</td>

                <td>TARIKH MOHON</td>

                <td>STATUS JPA</td>

                <td>STATUS BIASISWA</td>

                <td>JAWAB TAWARAN</td>



                <!-- <td>JANTINA</td> -->
                <!-- <td>BANDAR</td> -->
                <!-- <td>TARIKH KEMASKINI JPA</td> -->
                <!-- <td>TARIKH JAWAB TAWARAN</td> -->
                <!-- <td>TARIKH KEMASKINI BIASISWA</td> -->
                <!-- <td>CATATAN BIASISWA</td> -->
                <!-- <td>CATATAN JPA</td> -->
                <!-- <td>ALAMAT 2</td> -->

            </tr>

            <?php

            // $intake = $_SESSION['intake'];

            $bil = 1;

            //echo $sql3="SELECT b.nama,a.nokp,b.telefon,a.status,a.program, COUNT(*) FROM `permohonan` as a,`student` as b WHERE a.nokp=b.nokp GROUP BY a.nokp HAVING COUNT(*)>1";	

            $sql3 = "SELECT a.tarikhmohon, a.NoKp, a.KursusPelajar, a.Asrama, a.StatusPermohonan, a.Biasiswa, a.pkp_id, a.StatusBiasiswa, a.KemasukanPelajar, b.NamaPenuh, b.EmailPelajar, b.TelefonPelajar, b.AlamatPelajar, b.PoskodPelajar, b.negeri, b.bangsa, b.agama, b.TarafKahwin, b.TarafOku, c.NamaBapa, c.ICBapa, c.TelefonBapa, c.negeriBapa, c.TempohMenetapBapa, c.NamaMajikanBapa, c.AlamatMajikanBapa, c.PekerjaanBapa, c.PendapatanBersihBapa, c.Tanggungan, c.NamaIbu, c.ICIbu, c.TelefonIbu, c.negeriIbu, c.AlamatIbu, c.TempohMenetapIbu, c.AlamatMajikanIbu , c.PekerjaanIbu, c.PendapatanBersihIbu FROM pilihankursuspelajar as a, maklumatdiripelajar as b, maklumatibubapapelajar as c WHERE a.nokp=b.nokp AND b.username=c.username AND KemasukanPelajar='Disember 2023'";

            $result3 = $link->query($sql3);

            if ($result3->num_rows > 0) {

                // output data of each row

                while ($row3 = $result3->fetch_assoc()) {

                    extract($row3);



            ?>

                    <tr>

                        <td><?= $bil++; ?></td>

                        <td><?= $NamaPenuh; ?></td>

                        <td><?= $NoKp; ?></td>

                        <td><?= $EmailPelajar; ?></td>

                        <td><?= $TelefonPelajar; ?></td>

                        <td><?= $AlamatPelajar; ?></td>

                        <td><?= $PoskodPelajar; ?></td>

                        <td><?= $negeri; ?></td>

                        <td><?= $bangsa; ?></td>

                        <td><?= $agama; ?></td>

                        <td><?= $TarafKahwin; ?></td>

                        <td><?= $TarafOku; ?></td>

                        <td><?= $NamaBapa; ?></td>

                        <td><?= $ICBapa; ?></td>

                        <td><?= $TelefonBapa ?></td>

                        <td><?= $negeriBapa; ?></td>

                        <td><?= $TempohMenetapBapa; ?></td>

                        <td><?= $AlamatMajikanBapa; ?></td>

                        <td><?= $PekerjaanBapa; ?></td>

                        <td><?= $PendapatanBersihBapa; ?></td>

                        <td><?= $Tanggungan; ?></td>

                        <td><?= $NamaIbu; ?></td>

                        <td><?= $ICIbu ?></td>

                        <td><?= $TelefonIbu; ?></td>

                        <td><?= $negeriIbu; ?></td>

                        <td><?= $TempohMenetapIbu; ?></td>

                        <td><?= $AlamatMajikanIbu; ?></td>

                        <td><?= $PekerjaanIbu; ?></td>

                        <td><?= $PendapatanBersihIbu; ?></td>

                        <td><?= $KursusPelajar; ?></td>

                        <td><?= $Asrama; ?></td>

                        <td><?= $tarikhmohon; ?></td>

                        <td><?= $StatusPermohonan ?></td>

                        <td><?= $StatusBiasiswa; ?></td>

                        <td><?= $PilihanPelajar; ?></td>


                        <!-- <td><?= $bandar; ?></td> -->
                        <!-- <td><?= $jantina; ?></td> -->
                        <!-- <td><?= $alamat2; ?></td> -->
                        <!-- <td><?= $tarikhkemaskinibiasiswa; ?></td> -->
                        <!-- <td><?= $catatanbiasiswa; ?></td> -->
                        <!-- <td><?= $tarikhjawabtawaran ?></td> -->
                        <!-- <td><?= $catatanjpa; ?></td> -->
                        <!-- <td><?= $tarikhkemaskinijpa; ?></td> -->
                    </tr>

            <?php }
            } ?>

        </tbody>

    </table>

</body>



</html>