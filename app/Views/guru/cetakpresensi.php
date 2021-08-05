<?php 
    include ("templates/hariTanggalIndo.php");
    $tanggal = format_hari_tanggal($tgl);
    $ttdtgl = format_ttd($tgl);
    $H=0; $S=0; $I=0; $A=0; 
?>
<html>
<head>
<style>
        @page { margin: 0px; }
        body { margin: 60px 70px 60px 70px; }
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
            <td style="padding-left: 15px;" >Nama</td>
            <td><span style="margin-left: 100px;"> : <b><?=$guru['nama']?></b></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;" >NIP / NUPTK</td>
            <td><span style="margin-left: 100px;"><?=":  " . $guru['nip']?></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;" >Mapel</td>
            <td><span style="margin-left: 100px;"><?=":  " . $mapel?></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;" >Kelas</td>
            <td><span style="margin-left: 100px;"><?=":  " . $kelas?></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;" >Tanggal</td>
            <td><span style="margin-left: 100px;">: <b><?=$tanggal?></b></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;" >Jam Pelajaran</td>
            <td><span style="margin-left: 100px;">: <b><?=$jam?></b></td>
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
                <td style="margin: 0px; height: 20px; width: 40px; border: 1px solid black; text-align: center;">
                    <input type="radio" style="margin-left: 12px; margin-bottom: 2px; color: #348ceb;" <?php if($dat['H']==1){$H++; echo "checked=\"checked\"";}?> required>
                </td>
                <td style="margin: 0px; height: 20px; width: 40px; border: 1px solid black; text-align: center;">
                    <input type="radio" style="margin-left: 12px; margin-bottom: 2px; color: #348ceb;" <?php if($dat['S']==1){$S++; echo "checked=\"checked\"";}?> required>
                </td>
                <td style="margin: 0px; height: 20px; width: 40px; border: 1px solid black; text-align: center;">
                    <input type="radio" style="margin-left: 12px; margin-bottom: 2px; color: #348ceb;" <?php if($dat['I']==1){$I++; echo "checked=\"checked\"";}?> required>
                </td>
                <td style="margin: 0px; height: 20px; width: 40px; border: 1px solid black; text-align: center;">
                    <input type="radio" style="margin-left: 12px; margin-bottom: 2px; color: #348ceb;" <?php if($dat['A']==1){$A++; echo "checked=\"checked\"";}?> required>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <span>Hadir : <?=$H?>, Sakit : <?=$S?>, Izin : <?=$I?>, Tanpa Keterangan : <?=$A?>

    <table style="margin-top: 40px; page-break-inside: avoid;">
        <tr>
            <td rowspan="5" style="vertical-align: top; width: 400px;">
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
            </td>
            <td><?=$ttdtgl?></td>
        </tr>
        <tr>
            <td>Guru Mapel</td>
        </tr>
        <tr>
            <td><img src="http://103.28.114.234/assets/img/signature/<?=$guru['ttd']?>" style="padding-left: 10px; width: 120px;"></td>
        </tr>
        <tr>
            <td><?=$guru['nama']?></td>
        </tr>
        <tr>
            <td style="border-top: 1.5px solid black">NIP. <?=$guru['nip']?></td>
        </tr>
    </table>

</body>
</html>



    