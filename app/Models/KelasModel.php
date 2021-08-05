<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table      = 'kelas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_kelas'];
    protected $useTimestamps = false;

    public function getKelas()
    {
        return $this->db->table('kelas')->select()->orderBy("nama_kelas", "asc")->distinct()->get()->getResultArray();
    }
}