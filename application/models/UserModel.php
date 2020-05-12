<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

  public function getAllUser($filter = []){
	//    var_dump($filter);
		$this->db->select("u.*, r.*");
		
		$this->db->from('user as u');
		$this->db->join('role as r', 'r.id_role = u.id_role');

		
		if(empty($filter['is_login'])) {
			$this->db->select("NULL as password", FALSE);
		}
		if(isset($filter['is_not_self'])) $this->db->where('u.id_user !=', $this->session->userdata('id_user'));
		if(!empty($filter['eselon'])) $this->db->where('u.eselon', $filter['eselon']);
		if(isset($filter['username'])) $this->db->where('u.username', $filter['username']);
		if(isset($filter['id_user'])) $this->db->where('u.id_user', $filter['id_user']);
		if(isset($filter['except_roles'])) $this->db->where_not_in('u.id_role', $filter['except_roles']);
		if(isset($filter['just_roles'])) $this->db->where_in('u.id_role', $filter['just_roles']);
		if(!empty($filter['id_role'])) $this->db->where('u.id_role', $filter['id_role']);
		if(!empty($filter['id_opd'])) {
		if($filter['id_opd'] != -1) $this->db->where('u.id_opd', $filter['id_opd']);
		else $this->db->where('u.id_role =', NULL, FALSE);
		}
		$res = $this->db->get();
		// var_dump($res);
	
    return DataStructure::keyValue($res->result_array(), 'id_user');
	}

	public function getAllPasien($filter){
      
		$this->db->select("ssk.*, p.nama_puskesmas ,p.pembayaran  , ks.Kabupaten as nama_kab, ks.KECAMATAN as nama_kec, ks.Kelurahan as nama_kel");
		$this->db->from("data_pasien as ssk");
		$this->db->join("kd_area_v2 as ks", "ks.KodeKab = ssk.KDKAB AND ks.KodeKec = ssk.KDKEC AND ks.KodeKel = ssk.KDKEL", "LEFT");
		$this->db->join('puskesmas as p',"ssk.id_puskesmas = p.id_puskesmas",'LEFT');
   
		if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
		if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
		if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
		if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDKEL", $filter['kd_kel']);
		if(!empty($filter['NIK'])) $this->db->where("ssk.NIK", $filter['NIK']);
		//  $this->db->GROUP_BY("ssk.NoKK");
		  $this->db->limit("1000");
		$res = $this->db->get();
		return DataStructure::keyValue($res->result_array(), 'id_pasien');
	   
	  }

	  public function getServerSTMP($filter){
		if(!empty($filter['id_puskesmas'])){
			if($filter['id_puskesmas'] == '2'){
				$tipe = 'stmp_rskim' ;
			}else{
				$tipe = 'stmp_mail' ;
			}
		}else{
			$tipe = 'stmp_mail' ;
		}
		$this->db->select("*");
		$this->db->from("config_covid as ssk");
		$this->db->where("ssk.type", $tipe);
		$res = $this->db->get();
		$res = $res->result_array();
		// var_dump($res);
		return $res['0'];
	   
	  }

	  
	  public function getPuskesmas($data){
      
		$this->db->select("*");
		$this->db->from("puskesmas as ssk");
		$this->db->where("ssk.id_puskesmas", $data['id_puskesmas']);
		$res = $this->db->get();
		$res = $res->result_array();
		// var_dump($res);
		return $res['0'];
	   
	  }



	public function getUser($idUser = NULL){
		$row = $this->getAllUser(['id_user' => $idUser]);
		if (empty($row)){
			throw new UserException("User yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$idUser];
	}

	public function getUserByUsername($username = NULL){
		$row = $this->getAllUser(['username' => $username, 'is_login' => TRUE]);
		if (empty($row)){
			throw new UserException("User yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return array_values($row)[0];
	}

	public function RegisterCek($username = NULL ){
		// var_dump($username);
		$row = $this->getAllUser(['username' => $username, 'is_login' => TRUE ]);
		if (!empty($row)){
			throw new UserException("Username '".$username."' Sudah ada", USER_NOT_FOUND_CODE);
		}
		// return array_values($row)[0];
	}

	public function RegisterCek2($NIK = NULL ){
		// var_dump($NIK);
		$row2 = $this->getAllPasien(['NIK' => $NIK, 'is_login' => TRUE ]);
		if (!empty($row2)){
			throw new UserException("NIK '".$NIK."' Sudah ada", USER_NOT_FOUND_CODE);
		}
		// return array_values($row2)[0];
	
	}

	public function RegisterCek3($data){
		$this->db->select("count(*) as n");
		$this->db->from("data_pasien as ssk");
		$this->db->where("ssk.id_pasien != ".$data['id_pasien']);
		$this->db->where("ssk.NIK",$data['NIK']);
	
		$res = $this->db->get();
		$res = $res->result_array();
		// var_dump($res);
		$row = $res['0']['n'];
		// var_dump($row);
		if ($row > '0'){
			throw new UserException("NIK '".$data['NIK']."' Sudah ada", USER_NOT_FOUND_CODE);
		}
		// return array_values($row2)[0];
	
	}



  public function login($loginData){
		$user = $this->getUserByUsername($loginData['username']);
		if(md5($loginData['password']) !== $user['password'])
			throw new UserException("Password yang kamu masukkan salah.", WRONG_PASSWORD_CODE);
		return $user;
	}

  public function addUser($data){
		$data['password'] = md5($data['password']);
    $this->db->insert('user', DataStructure::slice($data, [
      'username', 'nama', 'id_role', 'password', 'id_sub'
		], TRUE));
    ExceptionHandler::handleDBError($this->db->error(), "Tambah User", "User");

    return $this->db->insert_id();
	}

	public function addPasien($data){
		$this->db->insert('data_pasien', DataStructure::slice($data, [
			'nama', 'NIK', 'KDKAB', 'KDKEC', 'KDKEL',
			 'status', 'email', 'nomorhp', 'alamat',
			  'jenis_kelamin',
			   'tempat_lahir',  'id_puskesmas', 'pasca_hamil',  'nama_krt', 
			   'tanggal_lahir','kewarganegaraan','kategori','st_perkawinan','pekerjaan'
		  ], TRUE));
		  ExceptionHandler::handleDBError($this->db->error(), "Tambah Data Pasien", "data_pasien");
	  	return $this->db->insert_id();
	}
	public function RegisterNewLogin($data){
		$this->db->insert('tmp_data_pasien', DataStructure::slice($data, [
			'nama', 'NIK', 'KDKAB', 'KDKEC', 'KDKEL',
			 'status', 'email', 'nomorhp', 'alamat',
			  'jenis_kelamin',
			   'tempat_lahir', 'pasca_hamil',  'nama_krt', 'id_puskesmas',
			   'tanggal_lahir','kewarganegaraan','kategori','st_perkawinan','pekerjaan'
		  ], TRUE));
		  ExceptionHandler::handleDBError($this->db->error(), "Tambah Data Pasien", "data_pasien");
	  	$ret['data_id']= $this->db->insert_id();

		// $pasien = $this->db->insert_id();
		// $data['id_role']= '3';
		$data['id_data_pasien']= $ret['data_id'];
		// $data['password'] = md5($data['password']);

		$this->db->insert('user_temp', DataStructure::slice($data, [
		'username', 'email', 'code', 'password', 'id_data_pasien'
		], TRUE));
    ExceptionHandler::handleDBError($this->db->error(), "Tambah User", "User");
	$ret['user_temp_id']= $this->db->insert_id();
    return $ret;
	}


	public function addUserTemp($data){
		
    $this->db->insert('user_temp', DataStructure::slice($data, [
      'email', 'nik', 'code', 'id_data_pasien'
		], TRUE));
    ExceptionHandler::handleDBError($this->db->error(), "Tambah User Temp", "User_Temp");

    return $this->db->insert_id();
	}

	public function getUserTemp($idUser){
		$this->db->select("*");
		
		$this->db->from('user_temp as u');
		$this->db->where('u.id_user_temp', $idUser);
		$res = $this->db->get();
			  // var_dump($res);
		  
		$row = DataStructure::keyValue($res->result_array(), 'id_user_temp');
		if (empty($row)){
			throw new UserException("Username Sudah Di Aktifkan", USER_NOT_FOUND_CODE);
		}

		return $row[$idUser];
	}

	public function getPasienTemp($idUser){
		$this->db->select("*");
		
		$this->db->from('tmp_data_pasien as u');
		$this->db->where('u.id_pasien', $idUser);
		$res = $this->db->get();
			  // var_dump($res);
		  
		$row = DataStructure::keyValue($res->result_array(), 'id_pasien');
		if (empty($row)){
			throw new UserException("NIK Sudah Di Aktifkan", USER_NOT_FOUND_CODE);
		}
		return $row[$idUser];
	}
	
	public function editUser($data){
		if(!empty($data['password'])) $this->db->set('password', md5($data['password']));
		
		$this->db->set('photo', !empty($data['photo']) ? $data['photo'] : NULL);
		
		$this->db->set(DataStructure::slice($data, ['username', 'nama', 'id_role','id_sub'], TRUE));
		$this->db->where('id_user', $data['id_user']);
		$this->db->update('user');

		ExceptionHandler::handleDBError($this->db->error(), "Ubah User", "User");
		
		return $data['id_user'];
	}

	
	public function deleteUser($data){
		$this->db->where('id_user', $data['id_user']);
		$this->db->delete('user');

    ExceptionHandler::handleDBError($this->db->error(), "Hapus User", "User");
	}

	public function deleteUserTemp($data){
		$this->db->where('id_user_temp', $data['id_user_temp']);
		$this->db->delete('user_temp');

    ExceptionHandler::handleDBError($this->db->error(), "Hapus User", "User");
	}

	public function deletePasienTemp($data){
		$this->db->where('id_pasien', $data['id_pasien']);
		$this->db->delete('tmp_data_pasien');

    ExceptionHandler::handleDBError($this->db->error(), "Hapus User", "User");
	}

	public function changePassword($data){
		$idUser = $this->session->userdata('nama_role') == 'ADMIN_PENELITIAN' ? $data['id_user'] : $this->session->userdata('id_user');
		$this->db->set('password', md5($data['password']));
		$this->db->where('id_user', $idUser);
		$this->db->update('user');
	}

	public function changeUsername($data){
		$this->db->set('username', $data['username_new']);
		$this->db->where('username', $data['username']);
		$this->db->update('user');

    ExceptionHandler::handleDBError($this->db->error(), "Ganti Username", "User");
	}

  public function deleteBatch($ids){
    $this->db->where_in('id_user', $ids);
    $this->db->delete('user');

    ExceptionHandler::handleDBError($this->db->error(), "Hapus User", "User");
	}
	
	// User Dimension
	public function getChild($id){}
}
