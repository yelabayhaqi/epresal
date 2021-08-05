<?php

namespace App\Controllers;
use \App\Models\UserModel;
use \App\Models\SiswaModel;
use App\Models\LoginModel;
use App\Models\MapelModel;
use App\Models\KelasModel;
use App\Models\PresensiModel;
use App\Models\JurnalModel;
use App\Models\TimestampModel;
use App\Models\PesanModel;
use App\Models\TugasModel;
use App\Models\TugasGuruModel;
use Dompdf\Dompdf;

class AdminController extends BaseController
{
	//////////// Edit value variabel dibawah ini //////////////
	private $username_database = "root";
	private $password_database = "";
	private $nama_database = "db_epresal";
	private $default_pass = "password";
	///////////////////////////////////////////////////////////
	
    public function __construct()
    {
        helper('form');		
		$this->db = \Config\Database::connect();
		$this->user = new UserModel();
		$this->siswa = new SiswaModel();
        $this->LoginModel = new LoginModel();
        $this->mapel = new MapelModel();
        $this->kelas = new KelasModel();
        $this->pres = new PresensiModel();
        $this->jrnl = new JurnalModel();
        $this->ts = new TimestampModel();
        $this->pesan = new PesanModel();
        $this->tugas = new TugasModel();
        $this->tugasguru = new TugasGuruModel();
    }
	public function generatePdf($html='',$filename='document',$size='A4',$orientation='portrait',$attachment=true){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
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
    public function menu($selectedKelas = "semua")
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'E-JURNAL | Admin';
			$data['guru'] = count($this->user->getguru());
			$data['bk'] = count($this->user->getbk());
			$data['siswa'] = count($this->siswa->getsiswa());
			$data['siswa10'] = count($this->siswa->getsiswa10());
			$data['siswa11'] = count($this->siswa->getsiswa11());
			$data['siswa12'] = count($this->siswa->getsiswa12());
			$data['pesan'] = $this->pesan->select()->get()->getResultArray();
			$data['prestoday'] = count($this->pres->getPresensiToday("all"));
			$data['jrnltoday'] = count($this->jrnl->getJurnalToday());
			$data['prestotal'] = count($this->pres->getPresensibk("semua",""));
			$data['jrnltotal'] = count($this->jrnl->getJurnalAll());
			$data['aktivitas'] = $this->ts->getActivityToday($selectedKelas);
			$data['kelas'] = $this->pres->getKelasPiket();
			$data['selectedKelas'] = $selectedKelas;
			return view('admin/index', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}

	}
	
	public function pesansave()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$judul = $_POST['inputJudul'];
			$isi = $_POST['inputIsi'];
			$waktu = $_POST['inputWaktu'];
			$kind = $_POST['inputType'];
			if(!isset($_POST['penerima0']) && (!isset($_POST['penerima1']))){
				$rcp = 0;
			} else if(isset($_POST['penerima0']) && (!isset($_POST['penerima1']))){
				$rcp = 1;
			} else if((!isset($_POST['penerima0'])) && isset($_POST['penerima1'])){
				$rcp = 2;
			}else if(isset($_POST['penerima0']) && isset($_POST['penerima1'])){
				$rcp = 3;
			}
			$dataInsert = [
				'waktu' => $waktu,
				'judul' => $judul,
				'pesan' => $isi,
				'kind' => $kind,
				'shw' => $rcp
			];
			$this->pesan->insert($dataInsert);
			return redirect()->to('admin');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function editpesan()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$id = $_POST['editIdPesan'];
			$judul = $_POST['editInputJudul'];
			$isi = $_POST['editInputIsi'];
			$kind = $_POST['editInputType'];
			if(!isset($_POST['editPenerima0']) && (!isset($_POST['editPenerima1']))){
				$rcp = 0;
			} else if(isset($_POST['editPenerima0']) && (!isset($_POST['editPenerima1']))){
				$rcp = 1;
			} else if((!isset($_POST['editPenerima0'])) && isset($_POST['editPenerima1'])){
				$rcp = 2;
			}else if(isset($_POST['editPenerima0']) && isset($_POST['editPenerima1'])){
				$rcp = 3;
			}
			$dataInsert = [
				'judul' => $judul,
				'pesan' => $isi,
				'kind' => $kind,
				'shw' => $rcp
			];
			$this->pesan->update($id, $dataInsert);
			return redirect()->to('admin');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function droppesan(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$id = $_POST['idPesan'];
			$this->pesan->where('id', $id)->delete();
			return redirect()->to('admin');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

    public function guru()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'Data Guru';
			$data['users'] = $this->user->getuser();
			$data['defpassword'] = $this->default_pass;
			return view('admin/dataguru', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function gurusave()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$selectedRole = $_POST['inputRole'];
			$Nama = $_POST['inputNama'];
			$Nip = $_POST['inputNip'];
			$Uname = "";
			$Psswd = "";
			if($_POST['inputUname'] === ""){
				$Uname = $_POST['inputNip'];
			} else {
				$Uname = $_POST['inputUname'];
			}
			if($_POST['inputPsswd'] === ""){
				$Psswd = $this->default_pass;
			} else {
				$Psswd = $_POST['inputPsswd'];
			}
			$cek = NULL;
			$cek = $this->user->cekdata($Nip);
			if((isset($cek['nip']))&&($Nip != '000000000000000000'))
			{
				$dataInsert = [
					'nama' => $Nama,
					'username' => $Uname,
					'password' => md5($Psswd),
					'level' => $selectedRole
				];
				$this->user->update($cek['id'], $dataInsert);
				session()->setFlashdata('pesan', '(1) Data guru berhasil diubah.');
			} else {
				$cekuname = $this->db->table('users')->select()->where('username',$Uname)
				->get()->getRowArray();
				$ceknip = $this->db->table('users')->select()->where('nip',$Nip)
				->get()->getRowArray();
				if(($ceknip == NULL)&&($cekuname == NULl)){
					$this->user->insertData($Uname,md5($Psswd),$Nip,$Nama,$selectedRole);
					session()->setFlashdata('pesan', '(1) Data guru berhasil ditambahkan.');
				} else {
					session()->setFlashdata('error', 'Gagal menambah data. duplikasi nip / username ditemukan');
				}
			}
			return redirect()->to('admin/dataguru');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	
	public function gurudrop()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$cnfrm = $_POST['confirmpsswd'];
			$uname = session()->get('username');
			$getdata = $this->LoginModel->cek_login($uname,md5($cnfrm));
			if (isset($getdata['username'])&&isset($getdata['password'])){
				if (($getdata['username'] == $uname)&&($getdata['password'] == md5($cnfrm))) 
				{
					$this->user->where('level', 2)->delete();
					$this->user->where('level', 3)->delete();
					session()->setFlashdata('pesan', 'Hapus data berhasil.');
				} else {
					session()->setFlashdata('error', 'Gagal menghapus, cek kembali password anda!');
				}
			} else {
				session()->setFlashdata('error', 'Gagal menghapus, cek kembali password anda!');
			}
			return redirect()->to('admin/dataguru');
			return redirect()->to('admin/dataguru');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function gurudropsingle()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$id = $_POST['idswap'];
			$this->user->where('id', $id)->delete();
			session()->setFlashdata('pesan', 'Hapus data berhasil.');
			return redirect()->to('admin/dataguru');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function gurureset()
	{	
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			helper('filesystem');
			$id = $_POST['idswapreset'];
			$nip = $_POST['nipswapreset'];
			$dataInsert = [
				'username' => $nip,
				'password' => md5($this->default_pass),
				'ttd' => 'empty',
				'active' => 0
			];
			$current = $this->db->table('users')->select('ttd')->where('id',$id)->get()->getRowArray();
			if(!$current['ttd'] === "empty"){
				$rep = $current['ttd'];
				unlink('assets/img/signature/' . $rep);
			}
			$this->user->update($id, $dataInsert);
			session()->setFlashdata('pesan', 'Reset data berhasil.');
			return redirect()->to('admin/dataguru');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function guruedit()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$id = $_POST['idswapedit'];
			$nip = $_POST['editNip'];
			$nama = $_POST['editNama'];
			$last = $this->user->find($id);
			if ($last['nip'] === $last['username']){
				$dataInsert = [
					'nip' => $nip,
					'nama' => $nama,
					'username' => $nip
				];
			} else {
				$dataInsert = [
					'nip' => $nip,
					'nama' => $nama
				];
			}
			$this->user->update($id, $dataInsert);
			session()->setFlashdata('pesan', 'Edit data berhasil.');
			return redirect()->to('admin/dataguru');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function piketedit()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$id = $_POST['idswapeditP'];
			$nip = $_POST['editNipP'];
			$nama = $_POST['editNamaP'];
			$uname = $_POST['editUnameP'];
			$psswd = NULL;
			if(isset($_POST['editPsswdP'])) 
				$psswd = $_POST['editPsswdP'];
			if ($psswd != NULL){
				$dataInsert = [
					'nip' => $nip,
					'nama' => $nama,
					'username' => $uname,
					'password' => md5($psswd)
				];
			} else {
				$dataInsert = [
					'nip' => $nip,
					'nama' => $nama,
					'username' => $uname
				];
			}
			$this->user->update($id, $dataInsert);
			session()->setFlashdata('pesan', 'Edit data berhasil.');
			return redirect()->to('admin/dataguru');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function guruimport()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			helper('file');
			$file = $this->request->getFile('file_xls');
			$ext = $file->getClientExtension();
			if($ext == 'xls')
			{
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$exist = 0; $new = 0;
			$spreadsheet = $render->load($file);
			$sheet = $spreadsheet->getActiveSheet()->toArray();
			foreach ($sheet as $data => $excel)
			{
				if($data == 0)
				{
					continue;
				}
				$nip = NULL;
				$nip = $this->user->cekdata($excel['1']);
				$insertNip = $excel['1'];
				$insertNama = $excel['2'];
				$insertUname = $excel['3'];
				$insertPsswd = $excel['4'];
				$insertRole = $excel['5'];
				if (($insertNip === "")||($insertNip == NULL)||(!isset($insertNip))){
					continue;
				}
				if (($insertNama === "")||($insertNama == NULL)||(!isset($insertNama))){
					continue;
				}
				if (($insertUname === "")||($insertUname == NULL)||(!isset($insertUname))){
					$insertUname = $insertNip;
				}
				if (($insertPsswd === "")||($insertPsswd == NULL)||(!isset($insertPsswd))){
					$insertPsswd = $this->default_pass;
				}
				if($insertRole === ""){
					$insertRole = '2';
				} else {
					if(($insertRole === "bk")||($insertRole === "BK")){
						$insertRole = '3';
					} else {
						$insertRole = '2';
					}
				}
				if(isset($nip['nip']))
				{
					$dataInsert = [
						'nama' => $insertNama,
						'username' => $insertUname,
						'password' => md5($insertPsswd),
						'role' => $insertRole
					];
					$this->user->update($nip['id'], $dataInsert);
					$exist++;
				} else {
					$this->user->insertData($insertUname,md5($insertPsswd),$insertNip,$insertNama,$insertRole);
					$new++;
				}
			}
			if (($new > 0)&&($exist > 0)){
				session()->setFlashdata('pesan', "(" . $new . ") Data baru ditambahkan, (" . $exist . ") Data lama diperbarui");
			} else {
				if ($new > 0){
					session()->setFlashdata('pesan', "(" . $new . ") Data baru ditambahkan.");
				} else if ($exist > 0){
					session()->setFlashdata('pesan', "(" . $exist . ") Data lama diperbarui.");
				}
			}
			return redirect()->to('admin/dataguru');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

    public function siswa()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'Data Siswa';
			$data['siswa'] = $this->siswa->getsiswa();
			return view('admin/datasiswa', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}	
	public function siswasave()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$Nis = $_POST['inputNis'];
			$Nisn = $_POST['inputNisn'];
			$Nama = $_POST['inputNama'];
			$Kelas = $_POST['inputKelas'];
			$cek = NULL;
			$cek = $this->siswa->cekdata($Nisn);
			if(isset($cek['nisn']))
			{
				$dataInsert = [
					'nis' => $Nis,
					'nisn' => $Nisn,
					'nama' => $Nama,
					'kelas' => $Kelas
				];
				$this->siswa->update($cek['id'], $dataInsert);
				session()->setFlashdata('pesan', '(1) Data siswa berhasil diubah.');
			} else {
				$this->siswa->insertData($Nisn,$Nis,$Nama,$Kelas);
				session()->setFlashdata('pesan', '(1) Data siswa berhasil ditambahkan.');
			}
			return redirect()->to('admin/datasiswa');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function siswaimport()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			helper('file');
			$file = $this->request->getFile('file_xls');
			$ext = $file->getClientExtension();
			if($ext == 'xls')
			{
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$exist = 0; $new = 0;
			$spreadsheet = $render->load($file);
			$sheet = $spreadsheet->getActiveSheet()->toArray();
			foreach ($sheet as $data => $excel)
			{
				if($data == 0)
				{
					continue;
				}
				$nisn = NULL;
				$nisn = $this->siswa->cekdata($excel['1']);
				$insertNisn = $excel['1'];
				$insertNis = $excel['2'];
				$insertNama = $excel['3'];
				$insertKelas = $excel['4'];
				if (($insertNisn === "")||($insertNisn == NULL)||(!isset($insertNisn))){
					continue;
				}
				if (($insertNis === "")||($insertNis == NULL)||(!isset($insertNis))){
					continue;
				}
				if (($insertNama === "")||($insertNama == NULL)||(!isset($insertNama))){
					continue;
				}
				if (($insertKelas === "")||($insertKelas == NULL)||(!isset($insertKelas))){
					continue;
				}
				if(isset($nisn['nisn']))
				{
					$dataInsert = [
						'nis' => $insertNis,
						'nama' => $insertNama,
						'kelas' => $insertKelas
					];
					$this->siswa->update($nisn['id'], $dataInsert);
					$exist++;
				} else {
					$this->siswa->insertData($insertNisn,$insertNis,$insertNama,$insertKelas);
					$new++;
				}
			}
			if (($new > 0)&&($exist > 0)){
				session()->setFlashdata('pesan', "(" . $new . ") Data baru ditambahkan, (" . $exist . ") Data lama diperbarui");
			} else {
				if ($new > 0){
					session()->setFlashdata('pesan', "(" . $new . ") Data baru ditambahkan.");
				} else if ($exist > 0){
					session()->setFlashdata('pesan', "(" . $exist . ") Data lama diperbarui.");
				}
			}
			return redirect()->to('admin/datasiswa');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function siswadrop()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$cnfrm = $_POST['confirmpsswd'];
			$uname = session()->get('username');
			$getdata = $this->LoginModel->cek_login($uname,md5($cnfrm));
			if (isset($getdata['username'])&&isset($getdata['password'])){
				if (($getdata['username'] == $uname)&&($getdata['password'] == md5($cnfrm))) 
				{
					$this->siswa->emptyTable();
					session()->setFlashdata('pesan', 'Hapus data berhasil.');
				} else {
					session()->setFlashdata('error', 'Gagal menghapus, cek kembali password anda!');
				}
			} else {
				session()->setFlashdata('error', 'Gagal menghapus, cek kembali password anda!');
			}
			return redirect()->to('admin/datasiswa');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function siswadropsingle()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$id = $_POST['idswap'];
			$this->siswa->where('id', $id)->delete();
			session()->setFlashdata('pesan', 'Hapus data berhasil.');
			return redirect()->to('admin/datasiswa');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function siswaedit()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$id = $_POST['idswapedit'];
			$nisn = $_POST['editNisn'];
			$nis = $_POST['editNis'];
			$nama = $_POST['editNama'];
			$kelas = $_POST['editKelas'];
			$dataInsert = [
				'nis' => $nis,
				'nisn' => $nisn,
				'nama' => $nama,
				'kelas' => $kelas
			];
			$this->siswa->update($id, $dataInsert);
			session()->setFlashdata('pesan', 'Edit data berhasil.');
			return redirect()->to('admin/datasiswa');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

    public function mapel()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'Data Mata Pelajaran';
			$data['kelas'] = $this->kelas->getKelas();
			return view('admin/datamapel', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	
	public function editmapel()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'Data Mata Pelajaran';
			$data['kelas'] = $this->kelas->getKelas();
			return view('admin/templates/kelolamapel', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function savemapel()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$mapel = $this->db->table('mapel')->select('id')->get()->getResultArray();
			$kelas = $this->db->table('kelas')->select('id')->get()->getResultArray();
			foreach ($kelas as $k){
				if(isset($_POST['selKelas' . $k['id']])){
					foreach ($mapel as $m){
						if(isset($_POST['selMapel' . $m['id']])){
							$isExist = $this->db->table('kelas_has_mapel')->select()
							->where('mapel',$m['id'])->where('kelas',$k['id'])->get()->getResultArray();
							if($isExist == NULL) {
								$this->db->table('kelas_has_mapel')->insert([
									'mapel' => $m['id'],
									'kelas' => $k['id']
								]);
								session()->setFlashdata('pesan', "Ubah Data Berhasil");
							}
						}
					}
				}
			}
			return redirect()->to('/admin/datamapel/editmapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function addkelas(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$dataKelas = $_POST['inputKelas'];
			$cek = $this->db->table('kelas')->where('nama_kelas',$dataKelas)->get()->getRowArray();
			if ($cek == NULL){
				$this->db->table('kelas')->insert([
					'nama_kelas' => $dataKelas
				]);
				session()->setFlashdata('pesan', "Data kelas baru ditambahkan.");
			} else {
				session()->setFlashdata('error', "Gagal, Duplikasi data ditemukan !!");
			}
			return redirect()->to('admin/datamapel/editmapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function importkelas(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			helper('file');
			$file = $this->request->getFile('file_xls');
			$ext = $file->getClientExtension();
			if($ext == 'xls')
			{
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$new = 0;
			$spreadsheet = $render->load($file);
			$sheet = $spreadsheet->getActiveSheet()->toArray();
			foreach ($sheet as $data => $excel)
			{
				if($data == 0)
				{
					continue;
				}
				$cek = NULL;
				$cek = $this->db->table('kelas')->where('nama_kelas',$excel['1'])->get()->getRowArray();
				$insertKelas = $excel['1'];
				if (($insertKelas === "")||($insertKelas == NULL)||(!isset($insertKelas))){
					continue;
				}
				if ($cek != NULL){
					continue;
				} else {
					$this->db->table('kelas')->insert([
						'nama_kelas' => $insertKelas
					]);
					$new++;
				}
			}
			if ($new > 0){
				session()->setFlashdata('pesan', "(" . $new . ") Data kelas baru ditambahkan.");
			} else {
				session()->setFlashdata('pesan', "Data lama diperbarui.");
			}
			return redirect()->to('admin/datamapel/editmapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function delkelas(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$kelas = $this->db->table('kelas')->select('id')->get()->getResultArray();
			foreach ($kelas as $k){
				if(isset($_POST['selKelasDel' . $k['id']])){
					$this->db->table('kelas')->where('id',$k['id'])->delete();
					$this->db->table('kelas_has_mapel')->where('kelas',$k['id'])->delete();
					session()->setFlashdata('pesan', "Data berhasil dihapus.");
				}
			}
			return redirect()->to('admin/datamapel/editmapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function addmapel(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$dataMapel = $_POST['inputMapel'];
			$dataKtg = "-";
			if($_POST['inputKtg'] === ""){
				$dataKtg = "-";
			} else {
				$dataKtg = $_POST['inputKtg'];
			}
			$cek = $this->db->table('mapel')->where('nama_mapel',$dataMapel)->get()->getRowArray();
			if ($cek == NULL){
				$this->db->table('mapel')->insert([
					'nama_mapel' => $dataMapel,
					'kategori' => $dataKtg
				]);
				session()->setFlashdata('pesan', "Data mata pelajaran baru ditambahkan.");
			} else {
				session()->setFlashdata('error', "Gagal, Duplikasi data ditemukan !!");
			}
			return redirect()->to('admin/datamapel/editmapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function importmapel(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			helper('file');
			$file = $this->request->getFile('file_xls');
			$ext = $file->getClientExtension();
			if($ext == 'xls')
			{
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$new = 0;
			$spreadsheet = $render->load($file);
			$sheet = $spreadsheet->getActiveSheet()->toArray();
			foreach ($sheet as $data => $excel)
			{
				if($data == 0)
				{
					continue;
				}
				$cek = NULL;
				$cek = $this->db->table('mapel')->where('nama_mapel',$excel['1'])->get()->getRowArray();
				$insertMapel = $excel['1'];
				if($excel['2'])
				$insertKtg = $excel['2'];
				if (($insertMapel === "")||($insertMapel == NULL)||(!isset($insertMapel))){
					continue;
				}
				if (($insertKtg === "")||($insertKtg == NULL)||(!isset($insertKtg))){
					$insertKtg = "-";
				}
				if ($cek != NULL){
					continue;
				} else {
					$this->db->table('mapel')->insert([
						'nama_mapel' => $insertMapel,
						'kategori' => $insertKtg
					]);
					$new++;
				}
			}
			if ($new > 0){
				session()->setFlashdata('pesan', "(" . $new . ") Data mata pelajaran baru ditambahkan.");
			}
			return redirect()->to('admin/datamapel/editmapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function delmapel(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$mapel = $this->db->table('mapel')->select('id')->get()->getResultArray();
			foreach ($mapel as $m){
				if(isset($_POST['selMapelDel' . $m['id']])){
					$this->db->table('mapel')->where('id',$m['id'])->delete();
					$this->db->table('kelas_has_mapel')->where('mapel',$m['id'])->delete();
					session()->setFlashdata('pesan', "Data Mata Pelajaran Berhasil Dihapus.");
				}
			}
			return redirect()->to('admin/datamapel/editmapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function dropallmapel()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$cnfrm = $_POST['confirmpsswd'];
			$uname = session()->get('username');
			$getdata = $this->LoginModel->cek_login($uname,md5($cnfrm));
			if (isset($getdata['username'])&&isset($getdata['password'])){
				if (($getdata['username'] == $uname)&&($getdata['password'] == md5($cnfrm))) 
				{
					$this->db->table('mapel')->emptyTable();
					$this->db->table('kelas')->emptyTable();
					$this->db->table('kelas_has_mapel')->emptyTable();
					session()->setFlashdata('pesan', 'Hapus data berhasil.');
				} else {
					session()->setFlashdata('error', 'Gagal menghapus, cek kembali password anda!');
				}
			} else {
				session()->setFlashdata('error', 'Gagal menghapus, cek kembali password anda!');
			}
			return redirect()->to('admin/datamapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function delsinglemapel()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			return view('admin/templates/mapeldelsingle');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function delallmapel()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			return view('admin/templates/mapeldelall');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function getmapel()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			return view('admin/templates/getmapelfromkelas');
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
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['kelas'] = $this->kelas->getKelas();
			return view('admin/templates/listmapel', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function mapeldrop()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$cnfrm = $_POST['confirmpsswd'];
			$uname = session()->get('username');
			$getdata = $this->LoginModel->cek_login($uname,md5($cnfrm));
			if (isset($getdata['username'])&&isset($getdata['password'])){
				if (($getdata['username'] == $uname)&&($getdata['password'] == md5($cnfrm))) 
				{
					$this->mapel->emptyTable();
					session()->setFlashdata('pesan', 'Hapus data berhasil.');
				} else {
					session()->setFlashdata('error', 'Gagal menghapus, cek kembali password anda!');
				}
			} else {
				session()->setFlashdata('error', 'Gagal menghapus, cek kembali password anda!');
			}
			return redirect()->to('admin/datamapel');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function tugas()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'Tugas Tambahan';
			$data['tugas'] = $this->db->table('tugas')->select('nama_tugas,id,kategori')
			->orderBy('kategori','asc')
			->orderBy('nama_tugas','asc')->get()->getResultArray();
			return view('admin/tugas', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function importtugas(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			helper('file');
			$file = $this->request->getFile('file_xls');
			$ext = $file->getClientExtension();
			if($ext == 'xls')
			{
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$new = 0;
			$spreadsheet = $render->load($file);
			$sheet = $spreadsheet->getActiveSheet()->toArray();
			foreach ($sheet as $data => $excel)
			{
				if($data == 0)
				{
					continue;
				}
				$insertTugas = $excel['1'];
				$insertKtg = $excel['2'];
				$cekTugas = NULL;
				$cekTugas = $this->db->table('tugas')->select('id')->where('nama_tugas',$insertTugas)->get()->getRowArray();
				if (($insertTugas === "")||($insertTugas == NULL)||(!isset($insertTugas))){
					continue;
				}
				if (($insertKtg === "")||($insertKtg == NULL)||(!isset($insertKtg))){
					$insertKtg = "-";
				}
				if ($cekTugas != NULL){
					continue;
				} else {
					$this->db->table('tugas')->insert([
						'nama_tugas' => $insertTugas,
						'kategori' => $insertKtg
					]);

				}
			}
				session()->setFlashdata('pesan', "Data Tugas Tambahan berhasil diubah.");
			return redirect()->to('admin/tugas');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function droptugas()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$this->db->table('tugas_guru')->like('nama_tugas','Wali Kelas X')->delete();
			$cek = $this->db->table('tugas')->select('id,kategori')->get()->getResultArray();
			if($cek != NULL){
				foreach($cek as $c){
					if($c['kategori']=="wali kelas"){
						continue;
					} else {
						$this->db->table('tugas')->where('id',$c['id'])->delete();
					}
				}
				session()->setFlashdata('pesan', 'Hapus Data Tugas Tambahan Berhasil.');
			}
			$data['title'] = 'Tugas Tambahan';
			$data['kelas'] = $this->db->table('kelas')->select('nama_kelas,id')
			->orderBy('nama_kelas','asc')->get()->getResultArray();
			return view('admin/tugas', $data);
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
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$namatugas = $_POST['inputTugas'];
			$ktg = "-";
			if(isset($_POST['inputKtg']))
				$ktg = $_POST['inputKtg'];
			if($ktg == "") $ktg = "-";
			if($ktg != "wali kelas"){
				$this->db->table('tugas')->insert([
					'nama_tugas' => $namatugas,
					'kategori' => $ktg
				]);
				session()->setFlashdata('pesan', "Tugas Baru berhasil ditambahkan");
			}
			return redirect()->to('/admin/tugas');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function edittugas()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$idtugas = $_POST['idTugas'];
			$namatugas = $_POST['editTugas'];
			$ktg = "-";
			if(isset($_POST['editKtg']))
				$ktg = $_POST['editKtg'];
			if($ktg == "") $ktg = "-";
			if($ktg == "wali kelas"){
				$cek = $this->db->table('kelas')->select()->where('nama_kelas',$namatugas)->get()->getRowArray();
				if($cek != NULL){
					$this->tugas->update($idtugas,[
						'nama_tugas' => $namatugas,
						'kategori' => $ktg
					]);
					$idtugasguru = $this->tugasguru->select('id')->where('id_tugas',$idtugas)->get()->getResultArray();
					foreach ($idtugasguru as $idtg){
						$this->tugasguru->where('id_tugas',$idtugas)->update($idtg['id'],[
							'nama_tugas' => "Wali Kelas ".$namatugas
						]);
						$this->db->table('detail_tugas_tambahan')->set('tugas',"Wali Kelas ".$namatugas)->where('id_tugas',$idtg['id'])->update();
					}
				}
			} else {
				$this->tugas->update($idtugas,[
					'nama_tugas' => $namatugas,
					'kategori' => $ktg
				]);
				$idtugasguru = $this->tugasguru->select('id')->where('id_tugas',$idtugas)->get()->getResultArray();
				foreach ($idtugasguru as $idtg){
					$this->tugasguru->where('id_tugas',$idtugas)->update($idtg['id'],[
						'nama_tugas' => $namatugas
					]);
					$this->db->table('detail_tugas_tambahan')->set('tugas',$namatugas)->where('id_tugas',$idtg['id'])->update();
				}
			}
			return redirect()->to('/admin/tugas');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function deltugas($idTugas)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$this->tugas->where('id',$idTugas)->delete();
			return redirect()->to('/admin/tugas');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function wali()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'Tugas Tambahan';
			$data['kelas'] = $this->db->table('kelas')->select('nama_kelas,id')
			->orderBy('nama_kelas','asc')->get()->getResultArray();
			return view('admin/walikelas', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function importwali(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			helper('file');
			$file = $this->request->getFile('file_xls');
			$ext = $file->getClientExtension();
			if($ext == 'xls')
			{
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$new = 0;
			$spreadsheet = $render->load($file);
			$sheet = $spreadsheet->getActiveSheet()->toArray();
			foreach ($sheet as $data => $excel)
			{
				if($data == 0)
				{
					continue;
				}
				$insertKelas = $excel['1'];
				$insertGuru = $excel['2'];
				$cekKelas = NULL;
				$cekGuru = NULL;
				$cekKelas = $this->db->table('kelas')->select('id')->where('nama_kelas',$insertKelas)->get()->getRowArray();
				$cekGuru = $this->db->table('users')->select('id')->where('nama',$insertGuru)->get()->getRowArray();
				if (($insertKelas === "")||($insertKelas == NULL)||(!isset($insertKelas))){
					continue;
				}
				if (($insertGuru === "")||($insertGuru == NULL)||(!isset($insertGuru))){
					continue;
				}
				if (($cekKelas == NULL)||($cekGuru == NULL)){
					continue;
				} else {
					$id_tugas = $this->db->table('tugas')->select('id')
					->where('kategori',"wali kelas")
					->where('nama_tugas',$insertKelas)
					->get()->getRowArray();
					$cekExist = $this->db->table('tugas_guru')->select('id')
					->where('id_tugas',$id_tugas)
					->get()->getRowArray();
					if($cekExist == NULL){
						$this->db->table('tugas_guru')->insert([
							'id_guru' => $cekGuru,
							'id_tugas' => $id_tugas,
							'nama_tugas' => "Wali Kelas ".$insertKelas
						]);
					} else {
						$this->db->table('tugas_guru')->where('id',$cekExist)->delete();
						$this->db->table('tugas_guru')->insert([
							'id_guru' => $cekGuru,
							'id_tugas' => $id_tugas,
							'nama_tugas' => "Wali Kelas ".$insertKelas
						]);
					}

				}
			}
				session()->setFlashdata('pesan', "Data wali kelas berhasil diubah.");
			return redirect()->to('admin/wali');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function dropwali()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$this->db->table('tugas_guru')->like('nama_tugas','Wali Kelas X')->delete();
			$data['title'] = 'Tugas Tambahan';
			$data['kelas'] = $this->db->table('kelas')->select('nama_kelas,id')
			->orderBy('nama_kelas','asc')->get()->getResultArray();
			session()->setFlashdata('pesan', 'Hapus Data Wali Kelas Berhasil.');
			return view('admin/walikelas', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function savewali()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			return view('admin/templates/savewali');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}


	public function presensi()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'Arsip Presensi';
			$data['users'] = $this->user->getuser();
			return view('admin/arsippresensi', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function showpresensi($idGuru,$bulan = 0,$tahun = 0)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			if(($bulan == "0")&&($tahun == "0")){
				$bulan = date("m",time ());
				$tahun = date("Y",time ());
			}
			$data['title'] = 'Arsip Presensi';
			$data['presensi'] = $this->pres->getPresensimyid($idGuru,$bulan,$tahun);
			$data['kelas'] = $this->db->table('presensi')->select('kelas')
			->where('id_guru',$idGuru)->distinct()->get()->getResultArray();
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['guru'] = $this->db->table('users')->select()->where('id',$idGuru)->get()->getRowArray();
			return view('admin/templates/showpresensi', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	
	public function cetakrange($idGuru,$tgl1,$tgl2,$kelas,$mapel)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['guru'] = $this->db->table('users')->select()->where('id',$idGuru)->get()->getRowArray();
			$data['kelas'] = $kelas;
			$data['mapel'] = $mapel;
			$data['bln1'] = $tgl1;
			$data['bln2'] = $tgl2;
			$data['siswa'] = $this->pres->getRangeGuruId($idGuru,$tgl1,$tgl2,$kelas,$mapel);
			$html =  view('admin/templates/cetakrange', $data);
			$this->generatePdf($html);
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
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			return view('admin/templates/getmapelrange');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function showjurnal($idGuru,$bulan = 0,$tahun = 0)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			if(($bulan == "0")&&($tahun == "0")){
				$bulan = date("m",time ());
				$tahun = date("Y",time ());
			}
			$data['title'] = 'Arsip Jurnal Mengajar';
			$data['jurnal'] = $this->jrnl->getJurnalId($idGuru,$bulan,$tahun);
			$data['kelas'] = $this->db->table('presensi')->select('kelas')
			->where('id_guru',$idGuru)->distinct()->get()->getResultArray();
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['guru'] = $this->db->table('users')->select()->where('id',$idGuru)->get()->getRowArray();
			return view('admin/templates/showjurnal', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function cetakjurnal($idGuru,$bulan,$tahun)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['guru'] = $this->db->table('users')->select()->where('id',$idGuru)->get()->getRowArray();
			$data['jurnal'] = $this->jrnl->getJurnalCtkId($idGuru,$bulan,$tahun);
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$html =  view('admin/templates/cetakjurnal', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function jurnal()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'Arsip Jurnal Kegiatan';
			//$data['users'] = $this->user->getuser();
			$data['users'] = $this->db->table('users')->select()
			->where("level='2' OR level='3'")
			->orderBy('nama','asc')
			->get()->getResultArray();
			return view('admin/arsipjurnal', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}

	public function showtugas($idGuru,$bulan = 0,$tahun = 0)
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			if(($bulan == "0")&&($tahun == "0")){
				$bulan = date("m",time ());
				$tahun = date("Y",time ());
			}
			$data['title'] = 'E-JURNAL | Tugas Tambahan';
			$data['guru'] = $this->db->table('users')->select()->where('id',$idGuru)->get()->getRowArray();
			$data['tugas'] = $this->db->table('tugas_guru')->select()
			->where('id_guru',$idGuru)->get()->getResultArray();
			$data['kegiatan'] = $this->db->table('detail_tugas_tambahan')->select()
			->where('id_guru',$idGuru)
			->like('tgl',$tahun."-".$bulan."-")
			->orderBy('tgl')
			->get()->getResultArray();

			$data['tugascetak'] = $this->db->table('detail_tugas_tambahan')->select('tugas')
			->where('id_guru',$idGuru)->distinct()->get()->getResultArray();

			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			return view('admin/templates/tugastambahan', $data);
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
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$idGuru = $_POST['idGuru'];
			$tugas = $_POST['pilihTugasCetak'];
			$bulan = $_POST['pilihBulanCetak'];
			$tahun = $_POST['pilihTahunCetak'];
			$data['kegiatan'] = $this->db->table('detail_tugas_tambahan')->select()
			->where('id_guru',$idGuru)
			->where('tugas',$tugas)
			->like('tgl',$tahun."-".$bulan."-")
			->orderBy('tgl')
			->get()->getResultArray();
			$data['guru'] = $this->db->table('users')->select()->where('id',$idGuru)->get()->getRowArray();
			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['tugas'] = $tugas;
			$html =  view('admin/templates/cetaktugas', $data);
			$this->generatePdf($html);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function pengaturan()
	{
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = "E-JURNAL | PENGATURAN";
			return view('admin/pengaturan', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function backupdb(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$cnfrm = $_POST['confirmpsswd'];
			$uname = session()->get('username');
			$getdata = $this->LoginModel->cek_login($uname,md5($cnfrm));
			if (isset($getdata['username'])&&isset($getdata['password'])){
				$fname = "backup_" . date('d-m-Y_H-i');
				$exten = ".sql";
				$cmd = "C:\\xampp\\mysql\\bin\\mysqldump -u " . $this->username_database . " --password=\"" . $this->password_database . "\" " . $this->nama_database . " > " . $fname . $exten;
				exec($cmd);
				chmod($fname . $exten, 0755);
				rename($fname . $exten, "..\\backup_db\\" . $fname . $exten);
				$data = [
					'namafile' => $fname . $exten
				];
				return view('/admin/templates/downloadbc', $data);
			} else {
				session()->setFlashdata('error', 'Gagal, cek kembali password anda!');
			}
			return redirect()->to('admin/pengaturan');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
	public function tabaru(){
		$curID = $this->db->table('session')->where('id_user', session()->get('id'))->get()->getRowArray();
		if(!isset($curID['session_id'])){
			$curID['session_id'] = "-";
		}
		$idNow = session()->get('session');
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$cnfrm = $_POST['confirmpsswd'];
			$uname = session()->get('username');
			$getdata = $this->LoginModel->cek_login($uname,md5($cnfrm));
			if (isset($getdata['username'])&&isset($getdata['password'])){
				$fname = "backup_" . date('d-m-Y_H-i');
				$exten = ".sql";
				$cmd = "C:\\xampp\\mysql\\bin\\mysqldump -u " . $this->username_database . " --password=\"" . $this->password_database . "\" " . $this->nama_database . " > " . $fname . $exten;
				exec($cmd);
				chmod($fname . $exten, 0755);
				rename($fname . $exten, "..\\backup_db\\" . $fname . $exten);
				$data = [
					'namafile' => $fname . $exten
				];
				$this->db->table('presensi')->emptyTable();
				$this->db->table('jurnal')->emptyTable();
				$this->db->table('detail_presensi')->emptyTable();
				$this->db->table('tugas_tambahan')->emptyTable();
				$this->db->table('detail_tugas_tambahan')->emptyTable();
				$this->db->table('mapel')->emptyTable();
				$this->db->table('kelas')->emptyTable();
				$this->db->table('kelas_has_mapel')->emptyTable();
				$this->db->table('timestamp')->emptyTable();
				$this->db->table('siswa')->like('kelas','XII-')->delete();
				$man10 = $this->db->table('siswa')->like('kelas','X-')->get()->getResultArray();
				$man11 = $this->db->table('siswa')->like('kelas','XI-')->get()->getResultArray();
				foreach($man10 as $d){
					$d['kelas'] = str_replace('X-','XI-',$d['kelas']);
					$dataIn = [
						'nis' => $d['nis'],
						'nisn' => $d['nisn'],
						'nama' => $d['nama'],
						'kelas' => $d['kelas']
					];
					$this->siswa->update($d['id'], $dataIn);
				}
				foreach($man11 as $d){
					$d['kelas'] = str_replace('XI-','XII-',$d['kelas']);
					$dataIn = [
						'nis' => $d['nis'],
						'nisn' => $d['nisn'],
						'nama' => $d['nama'],
						'kelas' => $d['kelas']
					];
					$this->siswa->update($d['id'], $dataIn);
				}
				return view('/admin/templates/downloadbc', $data);
			} else {
				session()->setFlashdata('error', 'Gagal, cek kembali password anda!');
			}
			return redirect()->to('admin/pengaturan');
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
		if((session()->get('level') == 1)&&($idNow == $curID['session_id'])){
			$data['title'] = 'E-JURNAL | Keluhan';
			$data['kelas'] = $this->db->table('kelas')->select('nama_kelas')->get()->getResultArray();
			$data['kelaspilih'] = $tampil;
				$data['aduAktif'] = $this->db->table('pengaduan')->select()
				->where('status','1')
				->orderBy('tgllapor','desc')->get()->getResultArray();
				$data['aduSelesai'] = $this->db->table('pengaduan')->select()
				->where('status','0')
				->orderBy('tgllapor','desc')->get()->getResultArray();
			return view('admin/keluhan', $data);
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
}
