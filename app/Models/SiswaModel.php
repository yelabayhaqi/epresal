<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nis', 'nisn', 'nama','kelas'];
    protected $useTimestamps = false;

    public function getsiswa()
    {
        return $this->db->table('siswa')->select('id,nis,nisn,nama,kelas')->get()->getResultArray();
    }

    public function getsiswa10()
    {
        return $this->db->table('siswa')->select('id,nis,nisn,nama,kelas')
        ->like('kelas','X-')->get()->getResultArray();
    }
    public function getsiswa11()
    {
        return $this->db->table('siswa')->select('id,nis,nisn,nama,kelas')
        ->like('kelas','XI-')->get()->getResultArray();
    }
    public function getsiswa12()
    {
        return $this->db->table('siswa')->select('id,nis,nisn,nama,kelas')
        ->like('kelas','XII-')->get()->getResultArray();
    }

    
    public function cekdata($nisn)
    {
        return $this->db->table('siswa')->select('id,nisn')->where('nisn',$nisn)->get()->getRowArray();
    }

    public function getsiswakelas($kelas)
    {
        return $this->db->table('siswa')->select('id,nis,nama')->where('kelas',$kelas)->get()->getResultArray();
    }

    public function insertData($nisn,$nis,$nama,$kelas)
    {
        $this->db->table('siswa')->insert([
			'nis' => $nis,
			'nisn' => $nisn,
			'nama' => $nama,
			'kelas' => $kelas
		]);
    }
}