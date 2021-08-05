<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalModel extends Model
{
    protected $table      = 'jurnal';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['tgl', 'kelas', 'jam','mapel','kegiatan','id_guru'];
    protected $useTimestamps = false;


    public function getJurnal($bulan,$tahun)
    {
        $bulantahun = $tahun . "-" . $bulan;
        return $this->db->table('jurnal')->select('jurnal.id,jurnal.tgl,jurnal.kelas,jurnal.jam,jurnal.mapel,jurnal.kegiatan,jurnal.id_guru')
        ->like('jurnal.tgl',$bulantahun)->where('jurnal.id_guru', session()->get('id'))
        ->orderBy("id", "desc")->get()->getResultArray();
    }
    public function getJurnalId($idGuru,$bulan,$tahun)
    {
        $bulantahun = $tahun . "-" . $bulan;
        return $this->db->table('jurnal')->select('jurnal.id,jurnal.tgl,jurnal.kelas,jurnal.jam,jurnal.mapel,jurnal.kegiatan,jurnal.id_guru')
        ->like('jurnal.tgl',$bulantahun)->where('jurnal.id_guru', $idGuru)
        ->orderBy("id", "desc")->get()->getResultArray();
    }
    public function getJurnalAll()
    {
        return $this->db->table('jurnal')->select()->get()->getResultArray();
    }
    public function getJurnalCtk($bulan,$tahun)
    {
        $bulantahun = $tahun . "-" . $bulan;
        return $this->db->table('jurnal')->select('jurnal.id,jurnal.tgl,jurnal.kelas,jurnal.jam,jurnal.mapel,jurnal.kegiatan,jurnal.id_guru')
        ->like('jurnal.tgl',$bulantahun)->where('jurnal.id_guru', session()->get('id'))
        ->orderBy("id", "asc")->get()->getResultArray();
    }
    public function getJurnalCtkId($idGuru,$bulan,$tahun)
    {
        $bulantahun = $tahun . "-" . $bulan;
        return $this->db->table('jurnal')->select('jurnal.id,jurnal.tgl,jurnal.kelas,jurnal.jam,jurnal.mapel,jurnal.kegiatan,jurnal.id_guru')
        ->like('jurnal.tgl',$bulantahun)->where('jurnal.id_guru', $idGuru)
        ->orderBy("id", "asc")->get()->getResultArray();
    }
    public function getJurnalcetak($kelas,$tgll)
    {
        return $this->db->table('jurnal')->select('nama, ttd, jurnal.jam,jurnal.mapel,jurnal.kegiatan,H,S,I,A')
        ->like('jurnal.tgl',$tgll)->where('jurnal.kelas', $kelas)
        ->join('presensi', ' (jurnal.id_guru = presensi.id_guru AND jurnal.tgl = presensi.tgl AND jurnal.mapel = presensi.mapel AND jurnal.kelas = presensi.kelas AND jurnal.jam = presensi.jam)', 'left')
        ->join('users', 'jurnal.id_guru = users.id', 'left')
        ->orderBy("jurnal.id", "asc")->get()->getResultArray();
    }
    public function getJurnalbk($kelas,$tgll)
    {
        if($kelas == "semua")
        {
            return $this->db->table('jurnal')->select('nama, presensi.id as presdi, jurnal.id,jurnal.tgl,jurnal.kelas,jurnal.jam,jurnal.mapel,jurnal.kegiatan,jurnal.id_guru,H,S,I,A')
            ->like('jurnal.tgl',$tgll)
            ->join('presensi', ' (jurnal.id_guru = presensi.id_guru AND jurnal.tgl = presensi.tgl AND jurnal.mapel = presensi.mapel AND jurnal.kelas = presensi.kelas AND jurnal.jam = presensi.jam)', 'left')
            ->join('users', 'jurnal.id_guru = users.id')
            ->orderBy("id", "desc")->get()->getResultArray();
        } else {
            return $this->db->table('jurnal')->select('nama, presensi.id as presdi, jurnal.id,jurnal.tgl,jurnal.kelas,jurnal.jam,jurnal.mapel,jurnal.kegiatan,jurnal.id_guru,H,S,I,A')
            ->like('jurnal.tgl',$tgll)->where('jurnal.kelas',$kelas)
            ->join('presensi', ' (jurnal.id_guru = presensi.id_guru AND jurnal.tgl = presensi.tgl AND jurnal.mapel = presensi.mapel AND jurnal.kelas = presensi.kelas AND jurnal.jam = presensi.jam)', 'left')
            ->join('users', 'jurnal.id_guru = users.id')
            ->orderBy("id", "desc")->get()->getResultArray();
        }
    }

    public function getJurnalToday()
    {
        return $this->db->table('jurnal')->select('kelas,jam,mapel,kegiatan,id_guru,tgl')
        ->like('tgl', date('Y-m-d'))->get()->getResultArray();
    }

    public function tambahJurnal($tgl,$kelas,$jampel,$mapel,$kegiatan,$id_guru){
        $this->db->table('jurnal')->insert([
			'tgl' => $tgl,
			'kelas' => $kelas,
			'jam' => $jampel,
			'mapel' => $mapel,
			'kegiatan' => $kegiatan,
			'id_guru' => $id_guru
		]);
        return $this->db->table('jurnal')->select('id')
        ->where('tgl',$tgl)
        ->where('kelas',$kelas)
        ->where('jam',$jampel)
        ->where('mapel',$mapel)
        ->where('kegiatan',$kegiatan)
        ->where('id_guru',$id_guru)
        ->get()->getRowArray();
    }
}