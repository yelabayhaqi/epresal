<?php 
    include ("templates/hariTanggalIndo.php");
    $tgl=($tahun . "-" . $bulan . "-01");
    $tanggal = format_jurnal($tgl);
    $ttdtgl = get_tgl_akhir($tgl);
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

    <div style="width: 100%; text-align: center; font-size: 14pt; padding: 15px 0px 15px 0px; "><b><u>LAPORAN REKAP JURNAL MENGAJAR</u></b></div>
    <table style="margin-bottom: 10px;">
        <tr>
            <td style="padding-left: 15px;">Nama</td>
            <td><span style="margin-left: 90px;"> : <b><?=session()->get('nama')?></b></span></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;">NIP / NUPTK</td>
            <td><span style="margin-left: 90px;"> : <?=session()->get('nip')?></span></td>
        </tr>
        <tr>
            <td style="padding-left: 15px;">Unit Kerja</td>
            <td><span style="margin-left: 90px;"> : SMK Negeri 1 Nganjuk</span></td>
        </tr>
        <tr>
            <td style="padding-left: 15px; vertical-align: top;">Nama Kegiatan</td>
            <td><span style="margin-left: 90px;"> : Merencanakan dan melaksanakan pembelajaran, mengevaluasi</span>
            <div style="margin-left: 98px;">dan menilai hasil pembelajaran.</div>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 15px;">Bulan </td>
            <td><span style="margin-left: 90px;"> : <?=$tanggal?></td>
        </tr>
    </table>

    <table style="font-size: 12pt; width: 100%; border: 1px solid black; margin: 0px 0px 5px 0px; border-collapse: collapse;">
                    <thead>
                        <tr style="text-align: center; background-color: rgb(210, 210, 210); font-weight: bold;">
                            <th style="width: 25px; border: 1px solid black;">NO</th>
                            <th style="border: 1px solid black;">TANGGAL</th>
                            <th style="border: 1px solid black;">KELAS</th>
                            <th style="border: 1px solid black;">MAPEL</th>
                            <th style="border: 1px solid black;">MATERI AJAR</th>
                            <th style="border: 1px solid black;">JML<br/>(menit)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $totalJam = 0; $n=0; foreach ($jurnal as $dat) : $n++;?>
                        <tr>
                            <td style="padding: 2px; width: 25px; border: 1px solid black; text-align: center; vertical-align: top; padding-top: 8px;"><?=$n?></td>
                            <td style="width: 100px !important; padding-left: 4px; border: 1px solid black; vertical-align: top; padding-top: 8px;"><?=format_hari_tanggal_jrnl($dat['tgl'])?></td>
                            <td style="width: 85px !important; padding: 2px; border: 1px solid black; text-align: center; vertical-align: top; padding-top: 8px;"><?=$dat['kelas']?></td>
                            <td style="width: 130px !important; padding: 2px; border: 1px solid black; vertical-align: top; padding-top: 8px;"><?=$dat['mapel']?></td>
                            <td style="width: 230px !important; padding: 2px; border: 1px solid black; vertical-align: top;"><?=$dat['kegiatan']?></td>
                            <td style="padding: 2px; border: 1px solid black; text-align: center; vertical-align: top; padding-top: 8px;"><?php
                                                        $arpas = $dat['jam'];
                                                        $tanda = 0;
                                                                    for($i=0;$i<=strlen($arpas);$i++){
                                                                        if($arpas[$i]=="-") {
                                                                        break;
                                                                        }
                                                                        else $tanda++;
                                                                    };
                                                                    $angka1 = substr($arpas,0,$tanda-1);
                                                                    $angka2 = substr($arpas,$tanda+2,strlen($arpas));
                                                                    $totalJam += (($angka2-$angka1)+1)*45;
                                                                    echo (($angka2-$angka1)+1)*45?>
                            
                            </td>
                        </tr>
                        <?php 
                    endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="text-align: center;">
                            <td colspan="5" style="border: 1px solid black;">Total (menit)</td>
                            <td style="border: 1px solid black;">
                            <?=$totalJam?>
                            </td>
                        </tr>
                    </tfoot>
                </table>

    <table style="margin-top: 40px; page-break-inside: avoid;">
        <tr>
            <td rowspan="5" style="padding-right: 400px;"></td>
            <td><?=$ttdtgl?></td>
        </tr>
        <tr>
            <td>Guru Mapel</td>
        </tr>
        <tr>
            <td><img src="http://103.28.114.234/assets/img/signature/<?=session()->get('ttd')?>" style="padding-left: 10px; width: 120px;"></td>
        </tr>
        <tr>
            <td><?=session()->get('nama')?></td>
        </tr>
        <tr>
            <td style="border-top: 1.5px solid black">NIP. <?=session()->get('nip')?></td>
        </tr>
    </table>

</body>
</html>



    