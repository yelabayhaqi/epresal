<?php
namespace App\Controllers;
use App\Models\TimestampModel;
use App\Models\PresensiModel;
class PiketController extends BaseController
{
    public function __construct()
    {
        $this->ts = new TimestampModel();
		$this->presensi = new PresensiModel();
    }
    public function menu($selectedKelas = "semua")
	{
		if(session()->get('level') == 4){
			$data['title'] = 'E-JURNAL | Piket';
			$data['aktivitas'] = $this->ts->getActivityToday($selectedKelas);
			$data['kelas'] = $this->presensi->getKelasPiket();
			$data['selectedKelas'] = $selectedKelas;
			return view('piket/index', $data);
			//return view('piket/index', $data);
		} else {
			return redirect()->to('/');
		}
	}
}