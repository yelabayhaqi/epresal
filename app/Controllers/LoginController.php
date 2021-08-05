<?php

namespace App\Controllers;
use \App\Models\UserModel;
use App\Models\LoginModel;

class LoginController extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->LoginModel = new LoginModel();
		$this->user = new UserModel();
		$this->db = \Config\Database::connect();
        $this->forge = \Config\Database::forge();
    }
	public function index()
	{
        $setup = $this->user->select('id')->where('level','1')->get()->getRowArray();
        if($setup != NULL){
            if (session()->get('level') == 1){
                $data['title'] = 'E-JURNAL | Admin';
                return redirect()->to(base_url('admin'));
            } else if (session()->get('level') == 2){
                $data['title'] = 'E-JURNAL | Guru';
                return redirect()->to(base_url('guru'));
            } else if (session()->get('level') == 3){
                $data['title'] = 'E-JURNAL | BK';
                return redirect()->to(base_url('bk'));
            } else {
                return view('login');
            }
        } else {
            return redirect()->to(base_url('/setup'));
        }
	}
    public function setup()
	{
        $setup = $this->user->select()->where('level','1')->get()->getRowArray();
        if($setup == NULL){
            return view('templates/setup');
        } else {
		return redirect()->to('/');
        }
	}
	public function setupadmin()
	{
        $setup = $this->user->select()->where('level' == 1)->get()->getRowArray();
        if($setup == NULL){
			$Nama = $_POST['inputNama'];
			$Uname = $_POST['inputUname'];
			$Psswd = $_POST['inputPsswd'];
			$UnameP = $_POST['inputUnameP'];
			$PsswdP = $_POST['inputPsswdP'];
			$this->user->insertDataNew($Uname,md5($Psswd),"000000000000000000",$Nama,'1');
			$this->user->insertDataNew($UnameP,md5($PsswdP),"111111111111111111","Guru Piket",'4');
			return redirect()->to('/');
		} else {
			session()->destroy();
			return redirect()->to('/');
		}
	}
    public function login()
	{
		$uname = $this->request->getPost('username');
		$psswd = $this->request->getPost('password');
        $getdata = $this->LoginModel->cek_login($uname,md5($psswd));
        if (isset($getdata['username'])&&isset($getdata['password'])){
            if (($getdata['username'] == $uname)&&($getdata['password'] == md5($psswd))) 
            {
                if($getdata['active'] == "1"){
                    session()->set('id', $getdata['id']);
                    session()->set('username', $getdata['username']);
                    session()->set('nip', $getdata['nip']);
                    session()->set('nama', $getdata['nama']);
                    session()->set('active', $getdata['active']);
                    session()->set('level', $getdata['level']);
                    session()->set('ttd', $getdata['ttd']);
                    if(($getdata['level'] == 1)||($getdata['level'] == 2)||($getdata['level'] == 3)){
                    $this->db->table('session')->where('id_user', session()->get('id'))->delete();
                        $session_id = uniqid() . 'auth' . date('dmYHis');
                        $dataInsert = [
                            'id_user' => $getdata['id'],
                            'session_id' => $session_id
                        ];
                        $this->db->table('session')->insert($dataInsert);
                        session()->set('session',$session_id);
                    }
                    if($getdata['level'] == 1){
                        return redirect()->to(base_url('admin'));
                    } else if ($getdata['level'] == 2){
                        return redirect()->to(base_url('guru'));
                    } else if ($getdata['level'] == 3){
                        return redirect()->to(base_url('bk'));
                    } else if ($getdata['level'] == 4){
                        return redirect()->to(base_url('piket'));
                    }
                } else {
                    session()->set('id', $getdata['id']);
                    session()->set('nama', $getdata['nama']);
                    session()->set('nip', $getdata['nip']);
                    return view('activation');
                }
            } else {
                session()->setFlashData('pesan', 'Username atau Password salah');
                return redirect()->to(base_url('/'));
            }
        } else {
            session()->setFlashData('pesan', 'Username atau Password salah');
            return redirect()->to(base_url('/'));
        }
	}
    public function logout()
    {
        $this->db->table('session')->where('id_user', session()->get('id'))->delete();
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
    public function profil()
    {
        if(session()->get('level') == 1)
        {
            $data['title'] = "Profil | E-JURNAL";
            return view('admin/profil' , $data);
        } 
        else if((session()->get('level') == 2) || (session()->get('level') == 3)) 
        {
            $data['title'] = "Profil | E-JURNAL";
            return view('guru/profil' , $data);
        }
    }
    public function profilsave()
    {
        if((session()->get('level') == 1)||(session()->get('level') == 2)||(session()->get('level') == 3))
        {
            $data['title'] = "Profil | E-JURNAL";
            if((isset($_POST['ubahUnameChk']))&&(!isset($_POST['ubahPsswdChk'])))
            {
                $newuname = $_POST['inputUnameEdit'];
                $cnfrm = $_POST['inputPsswd'];
                $uname = session()->get('username');
                $getdata = $this->LoginModel->cek_login($uname,md5($cnfrm));
                if (isset($getdata['username'])&&isset($getdata['password'])){
                    if (($getdata['username'] == $uname)&&($getdata['password'] == md5($cnfrm))) 
                        {
                            $cek = $this->db->table('users')->select()->where('username',$newuname)->get()->getRowArray();
                            if($cek == NULL){
                                $dataInsert = [
                                    'username' => $newuname
                                ];
                                $this->db->table('users')->update($dataInsert, ['id' => session()->get('id')]);
                                session()->set('username',$newuname);
                                session()->setFlashData('pesan', 'Username / Password Berhasil Diubah');
                            } else {
                                session()->setFlashData('error', 'Ubah data gagal, username tidak tersedia. Coba dengan username lain!');
                            }

                        } else {
                            session()->setFlashData('error', 'Ubah data gagal, periksa password anda');
                        }
                } else {
                    session()->setFlashData('error', 'Ubah data gagal, periksa password anda');
                }
            }
            if(isset($_POST['ubahPsswdChk']))
            {
                $cnfrm = $_POST['inputPsswdLama'];
                $uname = session()->get('username');
                $getdata = $this->LoginModel->cek_login($uname,md5($cnfrm));
                if (isset($getdata['username'])&&isset($getdata['password'])){
                    if (($getdata['username'] == $uname)&&($getdata['password'] == md5($cnfrm))) 
                    {
                        if(isset($_POST['ubahUnameChk'])){
                            $newuname = $_POST['inputUnameEdit'];
                            $dataInsert = [
                                'username' => $newuname
                            ];
                            $this->db->table('users')->update($dataInsert, ['id' => session()->get('id')]);
                            session()->set('username',$newuname);
                        }
                        $psswdbaru = $_POST['inputPsswdBaru'];
                        $dataInsert = [
                            'password' => md5($psswdbaru)
                        ];
                        $this->db->table('users')->update($dataInsert, ['id' => session()->get('id')]);
                        session()->setFlashData('pesan', 'Password Berhasil Diubah');
                    } else {
                        session()->setFlashData('error', 'Ubah data gagal, periksa password anda');
                    }
                } else {
                    session()->setFlashData('error', 'Ubah data gagal, periksa password anda');
                }
            }
            return redirect()->to(base_url('user/profil'));
        }
    }
}
