<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nip', 'nama', 'username','password','level','active','ttd'];
    protected $useTimestamps = false;


    public function getuser()
    {
        return $this->db->table('users')->select('id,nip,nama,level,active,username')
        ->orderBy('nip','asc')->get()->getResultArray();
    }

    public function getguru()
    {
        return $this->db->table('users')->select('id,nip,nama,level,active,username')
        ->where('level','2')->get()->getResultArray();
    }
    public function getbk()
    {
        return $this->db->table('users')->select('id,nip,nama,level,active,username')
        ->where('level','3')->get()->getResultArray();
    }

    public function insertData($uname,$psswd,$nip,$nama,$level)
    {
        $this->db->table('users')->insert([
			'nip' => $nip,
			'nama' => $nama,
			'username' => $uname,
			'password' => $psswd,
			'level' => $level,
			'active' => '0'
		]);
    }
    public function insertDataNew($uname,$psswd,$nip,$nama,$level)
    {
        $this->db->table('users')->insert([
			'nip' => $nip,
			'nama' => $nama,
			'username' => $uname,
			'password' => $psswd,
			'level' => $level,
			'active' => '1'
		]);
    }
    public function cekdata($nip)
    {
        return $this->db->table('users')->select('id,nip')->where('nip',$nip)->get()->getRowArray();
    }
}