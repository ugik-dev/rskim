<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('UserModel'));
		$this->load->helper(array('DataStructure', 'Validation'));
		$this->db->db_debug = false;
	}

  public function index(){
		redirect('login');
  }

	public function login(){
		$this->SecurityModel->guestOnlyGuard();
		$pageData = array(
			'title' => 'Masuk',
		);

		$this->load->view('LoginPage', $pageData);
	}

	public function register(){
		$this->SecurityModel->guestOnlyGuard();
		$pageData = array(
			'title' => 'Registrasi',
		);

		$this->load->view('RegisterPage', $pageData);
	}
	
	public function loginProcess(){
		try{
			$this->SecurityModel->guestOnlyGuard(TRUE);
			Validation::ajaxValidateForm($this->SecurityModel->loginValidation());

			$loginData = $this->input->post();

			$user = $this->UserModel->login($loginData);
			if(!empty($user['id_puskesmas'])){
			$puskesmas = $this->UserModel->getPuskesmas($user);
			$user['nama_puskesmas'] = $puskesmas['nama_puskesmas'];
			$user['KDKAB'] = $puskesmas['KDKAB'];
			}
			if($user['id_role'] == '3'){
				$pasien = $this->UserModel->getAllPasien(array('id_pasien' => $user['id_sub']));
				$pasien = $pasien[$user['id_sub']];
				$user['id_pasien'] = $pasien['id_pasien'];
				$user['nama'] = $pasien['nama'];
				$user['pembayaran'] = $pasien['pembayaran'];
			}
			$this->session->set_userdata($user);
			echo json_encode(array("error" => FALSE, "user" => $user));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function registerProcess(){
		try{
			$this->SecurityModel->guestOnlyGuard(TRUE);
			// Validation::ajaxValidateForm($this->SecurityModel->registerValidation());

			$registerData = $this->input->post();
			$cekdump = $this->UserModel->RegisterCek($registerData['username']);
			$cekdump = $this->UserModel->RegisterCek2($registerData['NIK']);
			// var_dump($registerData);
			$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 16);
			// $email = 'ugik.dev@gmail.com';
			$email = $registerData['email'];
			$registerData['code'] = $code;
			$ret = $this->UserModel->RegisterNewLogin($registerData);
			
					//   ------------------------ email

					// $id = '3';
					// var_dump($data);
				
					//generate simple random code
					
					//insert user to users table and get id
					$serv = $this->UserModel->getServerSTMP();
					$user['email'] = $email;
					$user['code'] = $code;
					$id = $ret['user_temp_id'];
				   
					$to = $email;
					$subject = 'Verification BABEL PROV Covid - 19';
				
					$from = $serv['username'];              // Pass here your mail id
					$message =  "
			
					<h2>Thank you for Registering.</h2>
					<p>Your Account:</p>
					<p> </p>
					<p>Username: ".$registerData['username']."</p>
					<p>Password: ".$registerData['password']."</p>
					<p>NIK: ".$registerData['NIK']."</p>
					<p>Code Verifikasi: ".$code."</p>
					<p>Email: ".$email."</p>
					<p> </p>
					<p>Please click the link below to activate your account and change password.</p>
					<h4><a href='".base_url()."index.php/activation/".$id."/".$code."'>Activate My Account</a></h4>
					<p>Atau masukkan kode url berikut secara manual.</p>
					<p>".base_url()."index.php/activation/".$id."/".$code."</p>

					";
					$emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="https://integrasi.babelprov.go.id/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
					$emailContent .='<tr><td style="height:20px"></td></tr>';
				
				
					$emailContent .= $message;  //   Post message available here
				
				
					$emailContent .='<tr><td style="height:20px"></td></tr>';
					$emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='ugik-dev.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>ugik-dev.com/covid19/</a></p></td></tr></table></body></html>";    
								 
				
				
					$config['protocol']    = 'smtp';
					$config['smtp_host']    = $serv['url_'];
					$config['smtp_port']    = '587';
					$config['smtp_timeout'] = '60';
					$config['smtp_user']    = $serv['username'];    //Important
					$config['smtp_pass']    = $serv['key'];  //Important
					$config['charset']    = 'utf-8';
					$config['newline']    = "\r\n";
					$config['mailtype'] = 'html'; // or html
					$config['validation'] = TRUE; // bool whether to validate email or not 
				 
					$this->email->initialize($config);
					$this->email->set_mailtype("html");
					$this->email->from($from);
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($emailContent);
					$this->email->send();

							//   ------------------------ email
			echo json_encode(array("error" => FALSE, "user" => "Registrasi Berhasil"));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function update(){
		try{
			$profile = $this->input->post();
			$profile['id_user'] = $this->session->userdata('id_user');
			$newProfile = $this->UserModel->updateDosenLocal($profile);
			$oldSess = $this->session->userdata();
			$this->session->set_userdata(array_merge($oldSess, $newProfile));
			$profile = DataStructure::slice($this->session->userdata(), ['nidn', 'nohp', 'telepon', 'email', 'bidang_keahlian']);
			echo json_encode(array('profile' => $profile));
		} catch (Exception $e){
			ExceptionHandler::handle($e);
		}
	}

	public function changePassword(){
		try{
      $this->SecurityModel->roleOnlyGuard('pengusul', TRUE);
      $this->SecurityModel->pengusulSubTypeGuard(['dosen_tendik'], TRUE);
			// Validation::ajaxValidateForm($this->SecurityModel->deleteDosenTendik());

			$CP = $this->input->post();
			if(md5($CP['old_password']) != $this->session->userdata('password')){
				throw new UserException('Password Lama Salah', 0);
			}
			$this->UserModel->changePassword($CP);
			$this->session->set_userdata('password', md5($CP['password']));
			echo json_encode(array());
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function changeUsername(){
		$this->SecurityModel->apiKeyGuard();
		try{
			$data = $this->input->post();

			if(!isset($data['username']) || !isset($data['username_new'])){
				throw new UserException('Parameter tidak lengkap', 0);
			}
			$this->UserModel->changeUsername($data);
			echo json_encode(array());
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}	
	}

	public function getAllUser(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->UserModel->getAllUser($this->input->get());
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function addUser(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
			$data = $this->input->post();
      $data['photo'] = !empty($_FILES['photo']['name']) ? FileIO::upload('photo', 'photo', NULL, "jpg|jpeg")['filename'] : NULL;
			$idUser = $this->UserModel->addUser($data);
			$user = $this->UserModel->getUser($idUser);
			echo json_encode(array("data" => $user));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function editUser(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
			$data = $this->input->post();
			$dataOld = $this->UserModel->getUser($data['id_user']);

     		$data['photo'] = (!empty($_FILES['photo']['name']) ? FileIO::upload('photo', 'photo', NULL, "jpg|jpeg")['filename'] : $dataOld['photo']);
			$data['photo'] = !empty($data['delete_photo'])? FileIO::delete('/uploads/photo/' . $data['delete_photo']) : $data['photo'];
			
			$idUser = $this->UserModel->editUser($data);
			$user = $this->UserModel->getUser($idUser);
			if($user['id_user'] == $this->session->userdata('id_user')){
				$this->session->set_userdata(array_merge($this->session->userdata(), $user));
			}

			echo json_encode(array("data" => $user));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}
	
	public function deleteUser(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
			$data = $this->input->post();
			$this->UserModel->deleteUser($data);
			echo json_encode(array());
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function userOnly(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
			echo json_encode([]);
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

	public function logout(){
		// $this->SecurityModel->userOnlyGuard();
		$this->session->sess_destroy();
		echo json_encode(["error" => FALSE, 'data' => 'Logout berhasil.']);
	}

	// User Dimension
	public function detail_user(){
		
	}
}
