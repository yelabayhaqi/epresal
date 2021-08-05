<?php

namespace App\Controllers;
use App\Models\TimestampModel;
use App\Models\MapelModel;
use App\Models\PresensiModel;
use App\Models\JurnalModel;
use App\Models\PesanModel;
use Dompdf\Dompdf;
class BkController extends BaseController
{
    public function __construct()
    {
        helper('form');
		$this->db = \Config\Database::connect();
		$this->ts = new TimestampModel();
		$this->mapel = new MapelModel();
		$this->presensi = new PresensiModel();
		$this->jurnal = new JurnalModel();
		$this->pesan = new PesanModel();
    }
    public function generatePdf($html='',$filename='document',$size='A4',$orientation='portrait',$attachment=true){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			$this->dompdf = new Dompdf();
			$options = $this->dompdf->getOptions();
			$options->setIsRemoteEnabled(true);
			$this->dompdf->setOptions($options);
			$this->dompdf->loadHtml($html);
			$this->dompdf->setPaper($size, $orientation);
			$this->dompdf->render();
			$this->dompdf->stream($filename,['Attachment'=>$attachment]);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function menu()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			$data['title'] = 'E-JURNAL | BK';
			$data['pesan'] = $this->pesan->select('waktu,judul,pesan,kind')
			->where('shw = 2 OR shw = 3')->get()->getResultArray();
			$data['jmlPres'] = count($this->ts->getTodayPresenceAll()); 
			$data['jmlJurnal'] = count($this->ts->getTodayJournalAll()); 
			return view('bk/index', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
    public function bkpresensi($kelas="semua", $tgll = 0)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			if($tgll == "0"){
				$tgll = date('Y-m-d');
			}
			$data['title'] = 'E-JURNAL | Presensi';
			$data['presensi'] = $this->presensi->getPresensibk($kelas,$tgll);
			$data['kelaspilih'] = $kelas;
			$data['tgll'] = $tgll;
			$data['kelas'] = $this->db->table('kelas')->select('nama_kelas')->get()->getResultArray();
			return view('bk/datapresensi', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
    public function bkjurnal($kelas="X-TKJ-2", $tgll = 0)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			if($tgll == "0"){
				$tgll = date('Y-m-d');
			}
			$data['title'] = 'E-JURNAL | Jurnal';
			$data['jurnal'] = $this->jurnal->getJurnalbk($kelas,$tgll);
			$data['kelaspilih'] = $kelas;
			$data['tgll'] = $tgll;
			$data['kelas'] = $this->db->table('kelas')->select('nama_kelas')->get()->getResultArray();
			return view('bk/datajurnal', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}

	}

    public function cetakjurnal($kelas,$tgll)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			$data['jurnal'] = $this->jurnal->getJurnalcetak($kelas,$tgll);
			$data['kelas'] = $kelas;
			$data['tgll'] = $tgll;
			$html =  view('bk/cetakjurnal', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function cetakrange($tgl1,$tgl2,$kelas)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			$data['kelas'] = $kelas;
			$data['bln1'] = $tgl1;
			$data['bln2'] = $tgl2;
			$data1 = $this->presensi->getRangeBk($tgl1,$tgl2,$kelas);
			$siswa = $this->presensi->getRangeBkSiswa($tgl1,$tgl2,$kelas);
			for($i=0;$i < count($data1);$i++){
				if($data1[$i]['A'] != '0'){
					$data1[$i]['H'] = '0';
					$data1[$i]['S'] = '0';
					$data1[$i]['I'] = '0';
					$data1[$i]['A'] = '1';
				} else if($data1[$i]['S'] != '0'){
					$data1[$i]['H'] = '0';
					$data1[$i]['S'] = '1';
					$data1[$i]['I'] = '0';
					$data1[$i]['A'] = '0';
				} else if(($data1[$i]['I'] != '0')&&($data1[$i]['H'] == '0')){
					$data1[$i]['H'] = '0';
					$data1[$i]['S'] = '0';
					$data1[$i]['I'] = '1';
					$data1[$i]['A'] = '0';
				} else {
					$data1[$i]['H'] = '1';
					$data1[$i]['S'] = '0';
					$data1[$i]['I'] = '0';
					$data1[$i]['A'] = '0';
				}
			}
			for($i=0;$i < count($siswa);$i++){
				$siswa[$i]['H'] = '0';
				$siswa[$i]['S'] = '0';
				$siswa[$i]['I'] = '0';
				$siswa[$i]['A'] = '0';
			}
			$n = 0;
			for($i=0;$i < count($data1);$i++){

				if($data1[$i]['H'] == '1'){
					$siswa[$n]['H'] += 1;
				} else if($data1[$i]['S'] == '1'){
					$siswa[$n]['S'] += 1;
				} else if($data1[$i]['I'] == '1'){
					$siswa[$n]['I'] += 1;
				} else if($data1[$i]['A'] == '1'){
					$siswa[$n]['A'] += 1;
				}
				$n++;
				if($n == count($siswa)){ $n = 0;}
			}
			$data['siswa'] = $siswa;
			$html =  view('bk/cetakrange', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function tugastambahan($bulan = 0,$tahun = 0)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			if(($bulan == "0")&&($tahun == "0")){
				$bulan = date("m",time ());
				$tahun = date("Y",time ());
			}
			$data['title'] = 'E-JURNAL | Tugas Tambahan';
			$data['tugas'] = $this->db->table('tugas_guru')->select()
			->where('id_guru',session()->get('id'))->get()->getResultArray();
			$data['kegiatan'] = $this->db->table('detail_tugas_tambahan')->select()
			->where('id_guru',session()->get('id'))
			->like('tgl',$tahun."-".$bulan."-")
			->orderBy('tgl')->get()->getResultArray();

			$data['tugascetak'] = $this->db->table('detail_tugas_tambahan')->select('tugas')
			->where('id_guru',session()->get('id'))->distinct()->get()->getResultArray();
			$data['tugasall'] = $this->db->table('tugas')->select()->orderBy('nama_tugas','asc')->get()->getResultArray();
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			return view('bk/tugastambahan', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function cetaktugas()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			$bulan = $_POST['pilihBulanCetak'];
			$tahun = $_POST['pilihTahunCetak'];
			$tugas = $_POST['pilihTugasCetak'];
			$data['kegiatan'] = $this->db->table('detail_tugas_tambahan')->select()
			->where('id_guru',session()->get('id'))
			->where('tugas',$tugas)
			->like('tgl',$tahun."-".$bulan."-")
			->orderBy('tgl')->get()->getResultArray();
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['tugas'] = $tugas;
			$html =  view('bk/cetaktugas', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	
	public function keluhan($tampil = "semua")
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 3)&&($idNow == $curID['session_id'])){
			$data['title'] = 'E-JURNAL | Keluhan';
			$data['kelas'] = $this->db->table('kelas')->select('nama_kelas')->get()->getResultArray();
			$data['kelaspilih'] = $tampil;
				$data['aduAktif'] = $this->db->table('pengaduan')->select()
				->where('status','1')
				->orderBy('tgllapor','desc')->get()->getResultArray();
				$data['aduSelesai'] = $this->db->table('pengaduan')->select()
				->where('status','0')
				->orderBy('tgllapor','desc')->get()->getResultArray();
			return view('bk/keluhan', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

}
