<?php 
    include ("templates/hariTanggalIndo.php");
    $b1 = format_bln_only($bln1);
    $b2 = format_bln_only($bln2);
?>
<html>
<head>
    <style>
        @page { margin: 0px; }
        body { margin: 60px 70px 40px 70px; }
    </style>
</head>
<body>
    <table style="text-align: center; vertical-align: middle; border-bottom: 3px solid black; width: 100%;">
        <tr>
            <td style="width: 80px; text-align: center; vertical-align: middle; padding: 0px; margin: 0px;">
                <img src="http://103.28.114.234/assets/img/logo-jatim-min.jpg" style="width: 92px; padding: 0px; margin: 0px;">
            </td>
            <td>
                <span style="font-size: 12pt;">PEMERINTAH PROVINSI JAWA TIMUR</span><br/>
                <span style="font-size: 12pt;">DINAS PENDIDIKAN</span><br/>
                <span style="font-weight: bold; font-size: 14pt;">SEKOLAH MENENGAH KEJURUAN NEGERI 1 NGANJUK</span><br/>
                <span style="font-size: 10pt;">Jl. Dr. Soetomo No. 61C Telp. (0358) 321483 Faks.(0358)329358 Nganjuk</span><br/>
                <span style="font-size: 10pt;">Website: www.smkn1nganjuk.sch.id E-Mail: smknegeri1nganjuk@gmail.com</span><br/>
                <span style="font-size: 12pt;">NGANJUK <span style="padding-left: 20px;">Kode Pos : 64411</span></span>
            </td>
        </tr>
    </table>

    <div style="width: 100%; text-align: center; font-size: 14pt; padding: 15px 0px 15px 0px; "><b><u>LAPORAN REKAP PRESENSI SISWA</u></b></div>
    <table style="margin-bottom: 10px;">
        <tr>
            <td style="padding-left: 15px;" >Kelas</td>
            <td><span style="margin-left: 100px;"><?=":  " . $kelas?></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;" >Bulan</td>
            <td><span style="margin-left: 100px;">: <b><?=($b1 == $b2)?$b1:$b1. " - " . $b2?></b></span></td>
        </tr>
    </table>
    
    <table style="font-size: 12pt; width: 100%; border: 1px solid black; margin: 0px 10px 10px 0px; border-collapse: collapse;">
        <tbody>
            <tr style="text-align: center; background-color: rgb(210, 210, 210); font-weight: bold;">
                <td style="width: 25px; border: 1px solid black; font-weight: bold;">NO</td>
                <td style="border: 1px solid black; font-weight: bold;">NAMA</td>
                <td style="width: 40px; border: 1px solid black; font-weight: bold;">H</td>
                <td style="width: 40px; border: 1px solid black; font-weight: bold;">S</td>
                <td style="width: 40px; border: 1px solid black; font-weight: bold;">I</td>
                <td style="width: 40px; border: 1px solid black; font-weight: bold;">A</td>
            </tr>
        <?php $i=0; foreach ($siswa as $dat) : $i++;?>
            <tr>
                <td style="width: 40px; border: 1px solid black; text-align: center;"><?=$i?></td>
                <td style="border: 1px solid black; padding-left: 10px;"><?=$dat['nama']?></td>
                <td style="margin: 0px; height: 23px; width: 40px; border: 1px solid black; text-align: center;">
                    <?=$dat['H']?>
                </td>
                <td style="margin: 0px; height: 20px; width: 40px; border: 1px solid black; text-align: center;">
                    <?=$dat['S']?>
                </td>
                <td style="margin: 0px; height: 20px; width: 40px; border: 1px solid black; text-align: center;">
                    <?=$dat['I']?>
                </td>
                <td style="margin: 0px; height: 20px; width: 40px; border: 1px solid black; text-align: center;">
                    <?=$dat['A']?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <table>
        <tr>
            <td style="text-align: center;">H</td>
            <td>: Hadir</td>
        </tr>
        <tr>
            <td style="text-align: center;">S</td>
            <td>: Sakit</td>
        </tr>
        <tr>
            <td style="text-align: center;">I</td>
            <td>: Izin</td>
        </tr>
        <tr>
            <td style="text-align: center;">A</td>
            <td>: Tanpa Keterangan</td>
        </tr>
    </table>

</body>
</html>



    