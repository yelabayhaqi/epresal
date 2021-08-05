<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table      = 'mapel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_mapel','kategori'];
    protected $useTimestamps = false;

    public function cekdata($kelas,$mp)
    {
        return $this->db->table('kelas_has_mapel')->select('nama_mapel,nama_kelas')
        ->join('mapel', '(mapel.id = kelas_has_mapel.mapel)')
        ->join('kelas', '(kelas.id = kelas_has_mapel.kelas)')
        ->where('kelas.nama_kelas',$kelas)->where('mapel.nama_mapel',$mp)->get()->getRowArray();
    }
    public function insertMapel($kelas,$mp)
    {
        $this->db->table('mapel')->insert([
			'kelas' => $kelas,
			'nama_mapel' => $mp
		]);
    }
}