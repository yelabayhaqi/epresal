<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasGuruModel extends Model
{
    protected $table      = 'tugas_guru';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_tugas', 'nama_tugas'];
    protected $useTimestamps = false;
}