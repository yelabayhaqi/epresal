<?php

namespace App\Controllers;
use \App\Models\PresensiModel;
use \App\Models\JurnalModel;
use \App\Models\MapelModel;
use \App\Models\SiswaModel;
use \App\Models\TimestampModel;
use \App\Models\PesanModel;
use Dompdf\Dompdf;


class GuruController extends BaseController
{
    public function __construct()
    {
		$this->db = \Config\Database::connect();
		$this->presensi = new PresensiModel();
		$this->jurnal = new JurnalModel();
        $this->mapel = new MapelModel();
        $this->siswa = new SiswaModel();
		$this->ts = new TimestampModel();
		$this->pesan = new PesanModel();
    }

	public function generatePdf($html='',$filename='document',$size='A4',$orientation='portrait',$attachment=true){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if(((session()->get('level') == 1)||(session()->get('level') == 2)||(session()->get('level') == 3))&&($idNow == $curID['session_id'])){
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
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$data['title'] = 'E-JURNAL | Guru';
			$data['prestoday'] = $this->ts->getTodayPresence(); 
			$data['jrnltoday'] = $this->ts->getTodayJournal(); 
			$data['pesan'] = $this->pesan->select('waktu,judul,pesan,kind')
			->where('shw = 1 OR shw = 3')->get()->getResultArray();
			$data['jmlPres'] = count($data['prestoday']);
			$data['jmlJurnal'] = count($data['jrnltoday']);
			$data['keluhan'] = count($data['aduAktif'] = $this->db->table('pengaduan')->select()
			->where('tujuan',session()->get('id'))
			->where('status','1')->get()->getResultArray());
			return view('guru/index', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	
    public function gurupresensi($bulan = 0,$tahun = 0)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			if(($bulan == "0")&&($tahun == "0")){
				$bulan = date("m",time ());
				$tahun = date("Y",time ());
			}
			$data['title'] = 'E-JURNAL | Presensi';
			$data['presensi'] = $this->presensi->getPresensimy($bulan,$tahun);
			$data['kelas'] = $this->db->table('presensi')->select('kelas')
			->where('id_guru',session()->get('id'))->distinct()->get()->getResultArray();
			$data['kelasInput'] = $this->db->table('kelas')->select('nama_kelas')->get()->getResultArray();
			$data['mapel'] = $this->presensi->getMapel();
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['prestoday'] = count($this->ts->getTodayPresence()); 
			$data['presmnth'] = count($this->ts->getMonthPresence()); 
			$data['prestotal'] = count($this->ts->getAllPresence()); 
			return view('guru/presensi', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function newpresensi()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$data['edit'] = '0';
			$data['title'] = "Daftar Hadir Baru";
			$data['kelas'] = $_POST['inputKelas'];
			$data['mapel'] = $_POST['inputMapel'];
			$data['jam'] = $_POST['inputJam1'] . " - " . $_POST['inputJam2'];
			$data['siswa'] = $this->siswa->getsiswakelas($data['kelas']);
			return view('guru/buatpresensi', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function savepresensi()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$jumlah = $_POST['jumlah'];
			if($_POST['edited'] == '0'){
				$id_guru = session()->get('id');
				$tgl = date("Y-m-d");
				$mapel = $_POST['mapel'];
				$kelas = $_POST['kelas'];
				$jam = $_POST['jampelajaran'];
				$H=0; $S=0; $I=0; $A=0;
				for($i=1;$i<=$jumlah;$i++){
					$value = $_POST["inrad".$i];
					switch($value) {
						case 'H' : 
							$H++;
							break;
						case 'S' : 
							$S++;
							break;
						case 'I' : 
							$I++;
							break;
						case 'A' : 
							$A++;
							break;
					}
				}
				$cek = $this->db->table('presensi')->select()
				->where('id_guru',$id_guru)->where('tgl',$tgl)->where('mapel',$mapel)->where('kelas',$kelas)
				->where('jam',$jam)->where('H',$H)->where('S',$H)->where('I',$H)->where('A',$H)
				->get()->getRowArray();
				if($cek == NULL){
					$this->db->table('presensi')->insert([
						'id_guru' => $id_guru,
						'tgl' => $tgl,
						'mapel' => $mapel,
						'kelas' => $kelas,
						'jam' => $jam,
						'H' => $H,
						'S' => $S,
						'I' => $I,
						'A' => $A
					]);
					$id_presensi = $this->db->table('presensi')->select('id')
								->where('id_guru',$id_guru)
								->where('tgl',$tgl)
								->where('mapel',$mapel)
								->where('kelas',$kelas)
								->where('jam',$jam)
								->get()->getRowArray();
					$this->db->table('timestamp')->insert([
						'id_guru' => $id_guru,
						'kind' => '1',
						'id_stamp' => $id_presensi
					]);
					for($i=1;$i<=$jumlah;$i++){
						$idsiswa = $_POST["id".$i];
						$H=0; $S=0; $I=0; $A=0;
						$value = $_POST["inrad".$i];
						switch($value) {
							case 'H' : 
								$H=1;
								break;
							case 'S' : 
								$S=1;
								break;
							case 'I' : 
								$I=1;
								break;
							case 'A' : 
								$A=1;
								break;
						}
						$this->presensi->insertPresensiDetail($id_presensi,$idsiswa,$H,$S,$I,$A);
					}
					$kegiatan = $_POST['inputKegiatan'];
					$id_guru = session()->get('id');
					$cekj = $this->db->table('jurnal')->select()
					->where('tgl',$tgl)->where('kelas',$kelas)->where('jam',$jam)->where('mapel',$mapel)
					->where('kegiatan',$kegiatan)->where('id_guru',$id_guru)->get()->getRowArray();
					if($cekj == NULL){
						$id_jurnal = $this->jurnal->tambahJurnal($tgl,$kelas,$jam,$mapel,$kegiatan,$id_guru);
						$this->db->table('timestamp')->insert([
							'id_guru' => $id_guru,
							'kind' => '2',
							'id_stamp' => $id_jurnal
						]);
					}
					session()->setFlashdata('pesan', 'Data Presensi dan Jurnal Mengajar Berhasil Ditambah');
					return redirect()->to('guru/presensi');
				}
			} else {
				$id_pr = $_POST['id_pr'];
				$editjam = $_POST['jampelajaran'];
				$cH=0; $cS=0; $cI=0; $cA=0;
				for($i=1;$i<=$jumlah;$i++){
					$idsiswa = $_POST["id".$i];
					$H=0; $S=0; $I=0; $A=0;
					$value = $_POST["inrad".$i];
					switch($value) {
						case 'H' : 
							$H=1; $cH++;
							break;
						case 'S' : 
							$S=1; $cS++;
							break;
						case 'I' : 
							$I=1; $cI++;
							break;
						case 'A' : 
							$A=1; $cA++;
							break;
					}
					$replace = [
						'H' => $H,
						'S'  => $S,
						'I'  => $I,
						'A'  => $A
					];
					$this->db->table('detail_presensi')
					->where('id_siswa', $idsiswa)
					->where('id_presensi', $id_pr)
					->update($replace);
				}
				$current = $this->db->table('presensi')->select('tgl,mapel,kelas,jam')->where('id', $id_pr)
				->where('id_guru', session()->get('id'))->get()->getRowArray();
				$replace1 = [
					'jam'  => $editjam
				];
				$this->db->table('jurnal')
				->where('id_guru', session()->get('id'))
				->where('tgl', $current['tgl'])
				->where('mapel', $current['mapel'])
				->where('kelas', $current['kelas'])
				->where('jam', $current['jam'])
				->update($replace1);
				$replace = [
					'jam' => $editjam,
					'H' => $cH,
					'S'  => $cS,
					'I'  => $cI,
					'A'  => $cA
				];
				$this->db->table('presensi')
				->where('id', $id_pr)
				->update($replace);
				session()->setFlashdata('pesan', 'Data Presensi Berhasil Diubah.');
				return redirect()->to('guru/presensi');
			}
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function editpresensi($id)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$current = $this->presensi->getOne($id);
			$data['edit'] = '1';
			$data['title'] = "Edit Daftar Hadir";
			$data['kelas'] = $current['kelas'];
			$data['mapel'] = $current['mapel'];
			$data['jam'] = $current['jam'];
			$data['tgl'] = $current['tgl'];
			$data['id_presensi'] = $id;
			$data['siswa'] = $this->db->table('detail_presensi')->select('nama,nis,id_presensi,id_siswa,H,S,I,A')
			->join('siswa', 'detail_presensi.id_siswa = siswa.id')
			->where('detail_presensi.id_presensi',$id)->get()->getResultArray();
			return view('guru/buatpresensi', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}	
	}

	public function cetakpresensi($id)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if(($idNow == $curID['session_id'])&&((session()->get('level') == 1)||(session()->get('level') == 2)||(session()->get('level')==3))){
			$current = $this->presensi->getOne($id);
			$data['kelas'] = $current['kelas'];
			$data['mapel'] = $current['mapel'];
			$data['jam'] = $current['jam'];
			$data['tgl'] = $current['tgl'];
			$data['id_presensi'] = $id;
			$data['guru'] = $this->db->table('presensi')->select('nama,nip,ttd')
			->join('users','presensi.id_guru = users.id')->where('presensi.id',$id)->get()->getRowArray();
			$data['siswa'] = $this->db->table('detail_presensi')->select('nama,nis,id_presensi,id_siswa,H,S,I,A')
			->join('siswa', 'detail_presensi.id_siswa = siswa.id')
			->where('detail_presensi.id_presensi',$id)->get()->getResultArray();
			$html =  view('guru/cetakpresensi', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function cetakjurnal($bulan,$tahun)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$data['jurnal'] = $this->jurnal->getJurnalCtk($bulan,$tahun);
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$html =  view('guru/cetakjurnal', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

    public function gurujurnal($bulan = 0,$tahun = 0)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			if(($bulan == "0")&&($tahun == "0")){
				$bulan = date("m",time ());
				$tahun = date("Y",time ());
			}
			$data['title'] = 'E-JURNAL | Jurnal';
			$data['jurnal'] = $this->jurnal->getJurnal($bulan,$tahun);
			$data['kelas'] = $this->db->table('presensi')->select('kelas')
			->where('id_guru',session()->get('id'))->distinct()->get()->getResultArray();
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['jrnltoday'] = count($this->ts->getTodayJournal()); 
			$data['jrnlmnth'] = count($this->ts->getMonthJournal()); 
			$data['jrnltotal'] = count($this->ts->getAllJournal()); 
			return view('guru/jurnal', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function newjurnal()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$tanggal = date('Y-m-d');
			$kelas = $_POST['inputKelas'];
			$mapel = $_POST['inputMapel'];
			$jam = $_POST['inputJam1'] . " - " . $_POST['inputJam2'];
			$kegiatan = $_POST['inputKegiatan'];
			$id_guru = session()->get('id');
			$id_jurnal = $this->jurnal->tambahJurnal($tanggal,$kelas,$jam,$mapel,$kegiatan,$id_guru);
			$this->db->table('timestamp')->insert([
				'id_guru' => $id_guru,
				'kind' => '2',
				'id_stamp' => $id_jurnal
			]);
			session()->setFlashdata('pesan', 'Jurnal Mengajar Berhasil Ditambah');
			return redirect()->to('guru/jurnal');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}

	}
	public function editjurnal()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$id_jurnal = $_POST['idswapjurnal'];
			$jam = $_POST['inputJam1Edit'] . " - " . $_POST['inputJam2Edit'];
			$kegiatan = $_POST['inputKegiatanEdit'];
			$id_guru = session()->get('id');
			$current = $this->db->table('jurnal')->select('tgl,mapel,kelas,jam')->where('id', $id_jurnal)
			->where('id_guru', $id_guru)->get()->getRowArray();
			$replace1 = [
				'jam'  => $jam
			];
			$this->db->table('presensi')
			->where('id_guru', $id_guru)
			->where('tgl', $current['tgl'])
			->where('mapel', $current['mapel'])
			->where('kelas', $current['kelas'])
			->where('jam', $current['jam'])
			->update($replace1);
			$replace = [
				'jam'  => $jam,
				'kegiatan'  => $kegiatan
			];
			$this->db->table('jurnal')
			->where('id', $id_jurnal)
			->where('id_guru', $id_guru)
			->update($replace);
			session()->setFlashdata('pesan', 'Edit Jurnal Mengajar Berhasil');
			return redirect()->to('guru/jurnal');
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
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
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
			return view('guru/tugastambahan', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function savetugas()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if(((session()->get('level') == 2)||(session()->get('level') == 3))&&($idNow == $curID['session_id'])){
			$idTugas = $_POST['inputTugas'];
			$namaTugas = $this->db->table('tugas')->select('nama_tugas')->where('id',$idTugas)->get()->getRowArray();
			$this->db->table('tugas_guru')->insert([
				'nama_tugas' => $namaTugas['nama_tugas'],
				'id_tugas' => $idTugas,
				'id_guru' => session()->get('id')
			]);
			session()->setFlashdata('pesan', 'Tambah tugas baru berhasil.');
			if(session()->get('level') == 2)
				return redirect()->to('/guru/tugastambahan');
			else 
				return redirect()->to('/bk/tugastambahan');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function droptugas($pilihan)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if(((session()->get('level') == 2)||(session()->get('level') == 3))&&($idNow == $curID['session_id'])){
			$this->db->table('tugas_guru')->where('id',$pilihan)->delete();
			session()->setFlashdata('pesan', 'Hapus data berhasil.');
			if(session()->get('level') == 2)
				return redirect()->to('/guru/tugastambahan');
			else 
				return redirect()->to('/bk/tugastambahan');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function savekegiatan()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if(((session()->get('level') == 2)||(session()->get('level') == 3))&&($idNow == $curID['session_id'])){
			$idTugas = $_POST['pilihTugas'];
			$namaTugas = $this->db->table('tugas_guru')->select('nama_tugas')->where('id',$idTugas)->get()->getRowArray();
			$tgl = $_POST['bln'];
			$kegiatan = $_POST['inputKegiatan'];
			$jumlah = $_POST['inputJml'];
			$this->db->table('detail_tugas_tambahan')->insert([
				'id_guru' => session()->get('id'),
				'tgl' => $tgl,
				'kegiatan' => $kegiatan,
				'jml' => $jumlah,
				'tugas' => $namaTugas['nama_tugas'],
				'id_tugas' => $idTugas
			]);
			session()->setFlashdata('pesan', 'Tambah kegiatan baru berhasil.');
			if(session()->get('level') == 2)
				return redirect()->to('/guru/tugastambahan');
			else 
				return redirect()->to('/bk/tugastambahan');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function editkegiatan()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if(((session()->get('level') == 2)||(session()->get('level') == 3))&&($idNow == $curID['session_id'])){
			$idKegiatan = $_POST['idKegiatan'];
			$namaTugas = $_POST['editTugas'];
			$tgl = $_POST['editbln'];
			$kegiatan = $_POST['editKegiatan'];
			$jumlah = $_POST['editJml'];
			$dataInsert = [
				'tgl' => $tgl,
				'kegiatan' => $kegiatan,
				'jml' => $jumlah,
				'tugas' => $namaTugas
			];
			$this->db->table('detail_tugas_tambahan')->where('id',$idKegiatan)->update($dataInsert);
			session()->setFlashdata('pesan', 'Edit data berhasil.');
			if(session()->get('level') == 2)
				return redirect()->to('/guru/tugastambahan');
			else 
				return redirect()->to('/bk/tugastambahan');
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
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$bulan = $_POST['pilihBulanCetak'];
			$tahun = $_POST['pilihTahunCetak'];
			$tugas = $_POST['pilihTugasCetak'];
			$data['kegiatan'] = $this->db->table('detail_tugas_tambahan')->select()
			->where('id_guru',session()->get('id'))
			->where('tugas',$tugas)
			->like('tgl',$tahun."-".$bulan."-")->orderBy('tgl')->get()->getResultArray();
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['tugas'] = $tugas;
			$html =  view('guru/cetaktugas', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	
	public function listmapel()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			return view('guru/templates/getlist');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function getmapelrange()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			return view('guru/templates/getmapelrange');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function savesignature()
	{
		return view('guru/templates/saveSignature');
	}
	public function editsignature()
	{
		return view('guru/templates/editSignature');
	}

	public function aktivasi()
	{
		$uname = $_POST['inputUname'];
		$psswd = $_POST['inputPsswd'];
		$idguru = session()->get('id');
		$cek = $this->db->table('users')->select()->where('username',$uname)->get()->getRowArray();
		if($cek == NULL){
			$dataInsert = [
				'username' => $uname,
				'password' => md5($psswd),
				'active' => '1'
			];
			$this->db->table('users')->where('id',$idguru)->update($dataInsert);
			session()->destroy();
			session()->setFlashdata('yarn', 'Aktivasi Berhasil, silahkan login dengan username dan password baru');
			return view('/login');
		} else {
			session()->setFlashdata('error', 'Username tidak tersedia, silakan coba dengan username lain!');
			return view('activation');
		}

	}

	public function cetakrange($tgl1,$tgl2,$kelas,$mapel)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$data['kelas'] = $kelas;
			$data['mapel'] = $mapel;
			$data['bln1'] = $tgl1;
			$data['bln2'] = $tgl2;
			$data['siswa'] = $this->presensi->getRangeGuru($tgl1,$tgl2,$kelas,$mapel);
			$html =  view('guru/cetakrange', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function pengaduan()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$data['title'] = 'E-JURNAL | Pengaduan';
			$data['aduAktif'] = $this->db->table('pengaduan')->select()
			->where('pelapor',session()->get('id'))
			->where('status','1')->get()->getResultArray();
			$data['aduSelesai'] = $this->db->table('pengaduan')->select()
			->where('pelapor',session()->get('id'))
			->where('status','0')->get()->getResultArray();
			return view('guru/pengaduan', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function aduanbaru()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$data['title'] = 'E-JURNAL | Pengaduan';
			$idKelas = $_POST['pilihKelas'];
			$kelas = $this->db->table('kelas')->select('nama_kelas')->where('id',$idKelas)->get()->getRowArray();
			$data['namakelas'] = $kelas['nama_kelas'];
			$wali = $this->db->table('tugas')->select('users.nama')
			->join('tugas_guru','tugas_guru.id_tugas = tugas.id')
			->join('users','tugas_guru.id_guru = users.id')
			->where('tugas.kategori','wali kelas')
			->where('tugas.nama_tugas',$kelas['nama_kelas'])
			->get()->getRowArray();
			$data['namawali'] = $wali['nama'];
			$data['kelas'] = $this->db->table('kelas')->select()->where('id',$idKelas)->get()->getRowArray();
			$data['siswa'] = $this->db->table('siswa')->select()->where('kelas',$kelas['nama_kelas'])->get()->getResultArray();
			return view('guru/aduanbaru', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function editaduan()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$idAduan = $_POST['idAduan'];
			$keterangan = $_POST['editAduan'];
			$this->db->table('pengaduan')->set('aduan',$keterangan)->where('id',$idAduan)->update();
			session()->setFlashdata('pesan', 'Laporan Pengaduan berhasil diubah');
			return redirect()->to('guru/pengaduan');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function saveaduan()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$tujuan = $this->db->table('users')->select('id')->where('nama',$_POST['wali'])->get()->getRowArray();
			$pelapor = session()->get('id');
			$keterangan = $_POST['keterangan'];
			$date = date('Y-m-d');
			$kelas = $_POST['kelas'];
			$this->db->table('pengaduan')->insert([
				'tgllapor' => $date,
				'aduan' => $keterangan,
				'status' => '1',
				'tujuan' => $tujuan,
				'pelapor' => $pelapor
			]);
			$idAduan = $this->db->table('pengaduan')->select('id')
				->where('tgllapor',$date)
				->where('aduan',$keterangan)
				->where('status','1')
				->where('tujuan',$tujuan)
				->where('pelapor',$pelapor)
				->get()->getRowArray();
			$siswa = $this->db->table('siswa')->select()->where('kelas',$kelas)->get()->getResultArray();
			foreach ($siswa as $s){
				$cek = "siswa".$s['id'];
				if(isset($_POST[$cek])){
					$this->db->table('detail_aduan')->insert([
						'id_siswa' => $s['id'],
						'id_pengaduan' => $idAduan,
						'status' => '0'
					]);
				}
			}
			session()->setFlashdata('pesan', 'Laporan Pengaduan berhasil dibuat');
			return redirect()->to('guru/pengaduan');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function setactive($id)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$this->db->table('detail_aduan')->set('status','1')->where('id',$id)->update();
			return redirect()->to('guru/pengaduan');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function setselesai($id)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$this->db->table('pengaduan')->set('status','0')->set('tglselesai',date('Y-m-d'))->where('id',$id)->update();
			$this->db->table('detail_aduan')->set('status','1')->where('id_pengaduan',$id)->update();
			return redirect()->to('guru/pengaduan');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function keluhan()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 2)&&($idNow == $curID['session_id'])){
			$data['title'] = 'E-JURNAL | Keluhan';
			$data['aduAktif'] = $this->db->table('pengaduan')->select()
			->where('tujuan',session()->get('id'))
			->where('status','1')->get()->getResultArray();
			$data['aduSelesai'] = $this->db->table('pengaduan')->select()
			->where('tujuan',session()->get('id'))
			->where('status','0')->get()->getResultArray();
			return view('guru/keluhan', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

}
