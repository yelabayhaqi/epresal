<?php

namespace App\Models;

use CodeIgniter\Model;

class TimestampModel extends Model
{    
    protected $table      = 'timestamp';
    protected $primaryKey = 'id';

    public function getTodayPresence()
    {
        return $this->db->table('timestamp')->select('presensi.mapel, presensi.jam, presensi.kelas, time')
        ->like('time',date('Y-m-d'))
        ->where('timestamp.id_guru', session()->get('id'))
        ->where('kind', '1')
        ->join('presensi', '(timestamp.id_stamp = presensi.id)', 'left')
        ->orderBy("time", "asc")->get()->getResultArray();
    }

    public function getTodayPresenceAll()
    {
        return $this->db->table('timestamp')->select('presensi.mapel, presensi.jam, presensi.kelas, time')
        ->like('time',date('Y-m-d'))
        ->where('kind', '1')
        ->join('presensi', '(timestamp.id_stamp = presensi.id)', 'left')
        ->orderBy("time", "asc")->get()->getResultArray();
    }

    public function getMonthPresence()
    {
        return $this->db->table('timestamp')->select('presensi.mapel, presensi.jam, presensi.kelas, time')
        ->like('time',date('Y-m'))
        ->where('timestamp.id_guru', session()->get('id'))
        ->where('kind', '1')
        ->join('presensi', '(timestamp.id_stamp = presensi.id)', 'left')
        ->orderBy("time", "asc")->get()->getResultArray();
    }
    public function getAllPresence()
    {
        return $this->db->table('timestamp')->select('presensi.mapel, presensi.jam, presensi.kelas, time')
        ->where('timestamp.id_guru', session()->get('id'))
        ->where('kind', '1')
        ->join('presensi', '(timestamp.id_stamp = presensi.id)', 'left')
        ->orderBy("time", "asc")->get()->getResultArray();
    }
    public function getTodayJournal()
    {
        return $this->db->table('timestamp')->select('jurnal.mapel, jurnal.jam, jurnal.kelas, time')
        ->like('time',date('Y-m-d'))
        ->where('timestamp.id_guru', session()->get('id'))
        ->where('kind', '2')
        ->join('jurnal', '(timestamp.id_stamp = jurnal.id)', 'left')
        ->orderBy("time", "asc")->get()->getResultArray();
    }
    public function getTodayJournalAll()
    {
        return $this->db->table('timestamp')->select('jurnal.mapel, jurnal.jam, jurnal.kelas, time')
        ->like('time',date('Y-m-d'))
        ->where('kind', '2')
        ->join('jurnal', '(timestamp.id_stamp = jurnal.id)', 'left')
        ->orderBy("time", "asc")->get()->getResultArray();
    }
    public function getMonthJournal()
    {
        return $this->db->table('timestamp')->select('jurnal.mapel, jurnal.jam, jurnal.kelas, time')
        ->like('time',date('Y-m'))
        ->where('timestamp.id_guru', session()->get('id'))
        ->where('kind', '2')
        ->join('jurnal', '(timestamp.id_stamp = jurnal.id)', 'left')
        ->orderBy("time", "asc")->get()->getResultArray();
    }
    public function getAllJournal()
    {
        return $this->db->table('timestamp')->select('jurnal.mapel, jurnal.jam, jurnal.kelas, time')
        ->where('timestamp.id_guru', session()->get('id'))
        ->where('kind', '2')
        ->join('jurnal', '(timestamp.id_stamp = jurnal.id)', 'left')
        ->orderBy("time", "asc")->get()->getResultArray();
    }
    public function getActivityToday($selectedKelas)
    {
        if($selectedKelas == "semua"){
            return $this->db->table('timestamp')->select('jurnal.kegiatan, jurnal.mapel, jurnal.jam, jurnal.kelas, time, users.nama')
            ->like('time',date('Y-m-d'))
            ->where('kind', '2')
            ->join('jurnal', '(timestamp.id_stamp = jurnal.id)', 'left')
            ->join('users', '(timestamp.id_guru = users.id)', 'left')
            ->orderBy("time", "desc")->get()->getResultArray();
        } else {
            return $this->db->table('timestamp')->select('jurnal.kegiatan, jurnal.mapel, jurnal.jam, jurnal.kelas, time, users.nama')
            ->like('time',date('Y-m-d'))
            ->where('kind', '2')->where('kelas', $selectedKelas)
            ->join('jurnal', '(timestamp.id_stamp = jurnal.id)', 'left')
            ->join('users', '(timestamp.id_guru = users.id)', 'left')
            ->orderBy("time", "desc")->get()->getResultArray();
        }
    }
}