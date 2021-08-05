<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table      = 'presensi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_guru', 'tgl', 'mapel','kelas','jam','H','S','I','A'];
    protected $useTimestamps = false;


    public function getPresensi()
    {
        return $this->db->table('presensi')->select('id,id_guru,tgl,mapel,kelas,jam,H,S,I,A')
        ->where('id_guru', session()->get('id'))->get()->getResultArray();
    }

    public function getPresensiToday($id){
        if($id == "all"){
            return $this->db->table('presensi')->select('id,id_guru,tgl,mapel,kelas,jam,H,S,I,A')
            ->like('tgl',date('Y-m-d'))
            ->get()->getResultArray();
        } else {
            return $this->db->table('presensi')->select('id,id_guru,tgl,mapel,kelas,jam,H,S,I,A')
            ->where('id_guru', $id)
            ->like('tgl',date('Y-m-d'))
            ->get()->getResultArray();
        }
    }

    public function getPresensimy($bulan,$tahun)
    {
        $bulantahun = $tahun . "-" . $bulan;
        return $this->db->table('presensi')->select('id,id_guru,tgl,mapel,kelas,jam,H,S,I,A')
        ->like('tgl',$bulantahun)->where('id_guru', session()->get('id'))
        ->orderBy("id", "desc")->get()->getResultArray();
    }
    public function getPresensimyid($idGuru,$bulan,$tahun)
    {
        $bulantahun = $tahun . "-" . $bulan;
        return $this->db->table('presensi')->select('id,id_guru,tgl,mapel,kelas,jam,H,S,I,A')
        ->like('tgl',$bulantahun)->where('id_guru', $idGuru)
        ->orderBy("id", "desc")->get()->getResultArray();
    }
    public function getPresensibk($kelas,$tgll)
    {
        if($kelas == "semua"){
            return $this->db->table('presensi')->select('nama,presensi.id,id_guru,tgl,mapel,kelas,jam,H,S,I,A')
            ->join('users', '(users.id = presensi.id_guru)', 'left')
            ->like('tgl',$tgll)
            ->orderBy("id", "desc")->get()->getResultArray();
        } else {
            return $this->db->table('presensi')->select('nama,presensi.id,id_guru,tgl,mapel,kelas,jam,H,S,I,A')
            ->join('users', '(users.id = presensi.id_guru)', 'left')
            ->like('tgl',$tgll)
            ->where('kelas',$kelas)
            ->orderBy("id", "desc")->get()->getResultArray();
        }

    }

    public function getOne($id)
    {
        return $this->db->table('presensi')->select('id_guru,tgl,mapel,kelas,jam,H,S,I,A')
        ->where('id',$id)->get()->getRowArray();
    }

    public function getRangeGuru($tgl1,$tgl2,$kelas,$mapel)
    {
        return $this->db->table('presensi')->select('siswa.nama, detail_presensi.H,detail_presensi.S,detail_presensi.I,detail_presensi.A')
        ->join('detail_presensi','detail_presensi.id_presensi = presensi.id', 'left')
        ->join('siswa','detail_presensi.id_siswa = siswa.id')
        ->where('id_guru',session()->get('id'))
        ->where('presensi.kelas', $kelas)
        ->where('mapel', $mapel)
        ->where("tgl BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'")
        ->groupBy('id_siswa')
        ->selectSum('detail_presensi.H')
        ->selectSum('detail_presensi.S')
        ->selectSum('detail_presensi.I')
        ->selectSum('detail_presensi.A')
        ->get()->getResultArray();
    }
    public function getRangeGuruId($idGuru,$tgl1,$tgl2,$kelas,$mapel)
    {
        return $this->db->table('presensi')->select('siswa.nama, detail_presensi.H,detail_presensi.S,detail_presensi.I,detail_presensi.A')
        ->join('detail_presensi','detail_presensi.id_presensi = presensi.id', 'left')
        ->join('siswa','detail_presensi.id_siswa = siswa.id')
        ->where('id_guru',$idGuru)
        ->where('presensi.kelas', $kelas)
        ->where('mapel', $mapel)
        ->where("tgl BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'")
        ->groupBy('id_siswa')
        ->selectSum('detail_presensi.H')
        ->selectSum('detail_presensi.S')
        ->selectSum('detail_presensi.I')
        ->selectSum('detail_presensi.A')
        ->get()->getResultArray();
    }
    public function getRangeBk($tgl1,$tgl2,$kelas)
    {
        return $this->db->table('presensi')->select('mapel,tgl,  siswa.nama, detail_presensi.H,detail_presensi.S,detail_presensi.I,detail_presensi.A')
        ->join('detail_presensi','detail_presensi.id_presensi = presensi.id', 'left')
        ->join('siswa','detail_presensi.id_siswa = siswa.id')
        ->where('presensi.kelas', $kelas)
        ->where("tgl BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'")
        ->groupBy(array('tgl', 'id_siswa'))
        // ->groupBy('id_siswa')
        ->selectSum('detail_presensi.H')
        ->selectSum('detail_presensi.S')
        ->selectSum('detail_presensi.I')
        ->selectSum('detail_presensi.A')
        ->get()->getResultArray();
    }
    public function getRangeBkSiswa($tgl1,$tgl2,$kelas){
        return $this->db->table('presensi')->select('siswa.nama, detail_presensi.H,detail_presensi.S,detail_presensi.I,detail_presensi.A')
        ->join('detail_presensi','detail_presensi.id_presensi = presensi.id', 'left')
        ->join('siswa','detail_presensi.id_siswa = siswa.id')
        ->where('presensi.kelas', $kelas)
        ->where("tgl BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'")
        ->groupBy('id_siswa')
        ->get()->getResultArray();
    }

    public function getMapel()
    {
        return $this->db->table('presensi')->select('mapel')->where('id_guru',session()->get('id'))
        ->distinct()->get()->getResultArray();
    }
    public function getKelas()
    {
        return $this->db->table('presensi')->select('kelas')->where('id_guru',session()->get('id'))
        ->distinct()->get()->getResultArray();
    }
    public function getKelasPiket()
    {
        return $this->db->table('presensi')->select('kelas')
        ->distinct()->orderBy("kelas", "asc")->get()->getResultArray();
    }

    public function tambahPresensi($id_guru,$tgl,$mapel,$kelas,$jampel,$totalH,$totalS,$totalI,$totalA){
        $this->db->table('presensi')->insert([
			'id_guru' => $id_guru,
			'tgl' => $tgl,
			'mapel' => $mapel,
			'kelas' => $kelas,
			'jam' => $jampel,
			'H' => $totalH,
			'S' => $totalS,
			'I' => $totalI,
			'A' => $totalA
		]);
        return $this->db->table('presensi')->select('id')
        ->where('id_guru',$id_guru)
        ->where('tgl',$tgl)
        ->where('mapel',$mapel)
        ->where('kelas',$kelas)
        ->where('jam',$jampel)
        ->get()->getRowArray();
    }
    
    public function insertPresensiDetail($idpresensi,$idsiswa,$H,$S,$I,$A)
    {
        $this->db->table('detail_presensi')->insert([
			'id_presensi' => $idpresensi,
			'id_siswa' => $idsiswa,
			'H' => $H,
			'S' => $S,
			'I' => $I,
			'A' => $A
		]);
    }
}