<?php 
    include ("hariTanggalIndo.php");
    $date=date('Y-m-d');
    $tanggal = format_hari_tanggal($tgll);
?>
<html>
<head>
    <style>
        @page { margin: 0px; }
        body { margin: 60px 60px 40px 70px; }
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

    <div style="width: 100%; text-align: center; font-size: 14pt; padding: 15px 0px 15px 0px; "><b><u>JURNAL HARIAN KELAS</u></b></div>

    <table style="margin-bottom: 10px;">
        <tr>
            <td style="padding-left: 15px;" >Kelas</td>
            <td><span style="margin-left: 100px;"><?=":  " . $kelas?></span></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;" >Tanggal</td>
            <td><span style="margin-left: 100px; font-weight: bold;"><?=":  " . $tanggal?></span></td>
        </tr>
    </table>

    <table style="font-size: 12pt; width: 100%; border: 1px solid black; margin: 0px 10px 10px 0px; border-collapse: collapse;">

                    <tbody>
                        <tr style="text-align: center; background-color: rgb(210, 210, 210); font-weight: bold;">
                            <td style="width: 25px; border: 1px solid black; font-weight: bold;">NO</td>
                            <td style="border: 1px solid black; font-weight: bold; width: 45px;">JAM</td>
                            <td style="border: 1px solid black; font-weight: bold; width: 100px;">MAPEL</td>
                            <td style="border: 1px solid black; font-weight: bold;">GURU</td>
                            <td style="border: 1px solid black; font-weight: bold;">MATERI AJAR</td>
                            <td style="border: 1px solid black; font-weight: bold; width: 80px;">PRESENSI</td>
                            <td style="border: 1px solid black; font-weight: bold; width: 80px;">TTD</td>
                        </tr>
                    <?php $i=0; foreach ($jurnal as $dat) : $i++;?>
                        <tr style="text-align: center;">
                            <td style="padding: 2px; width: 25px; border: 1px solid black; text-align: center;"><?=$i?></td>
                            <td style="padding: 2px; border: 1px solid black; text-align: center;"><?=$dat['jam']?></td>
                            <td style="padding: 2px; border: 1px solid black;"><?=$dat['mapel']?></td>
                            <td style="padding: 2px; border: 1px solid black; text-align: center;"><?=$dat['nama']?></td>
                            <td style="padding: 2px; border: 1px solid black; text-align: center;"><?=$dat['kegiatan']?></td>
                            <td style="padding: 2px; border: 1px solid black; text-align: center;"><?php if(($dat['H']!=NULL)&&($dat['S']!=NULL)&&($dat['I']!=NULL)&&($dat['A']!=NULL)){
                                echo "H=" . $dat['H'] . ", S=" . $dat['S'] . ", I=" . $dat['I'] . ", A=" . $dat['A'];   
                            }?>
                            </td>
                            <td style="border: 1px solid black; text-align: center;">
                                <img src="http://103.28.114.234/assets/img/signature/<?=$dat['ttd']?>" style="width: 60px;">
                            </td>
                        </tr>
                        <?php 
                    endforeach; ?>
                    </tbody>
                </table>

</body>
</html>



    