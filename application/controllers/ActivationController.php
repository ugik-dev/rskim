<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActivationController extends CI_Controller {

 function __construct(){
  parent::__construct();
  $this->load->model(array('DinkesModel', 'UserModel', 'DinkesModel'));
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->load->library('session');

        //get all users
//   $this->data['users'] = $this->users_model->getAllUsers();
 }

 public function index(){
  // $this->load->view('ActivationPage');
  $id =  $this->uri->segment(3);
  $code = $this->uri->segment(4);
  var_dump($id);

}

//  public function activation(){
//     $this->SecurityModel->guestOnlyGuard();
//     $pageData = array(
//         'title' => 'Activation',
//     );
//     $this->load->view('ActivationPage', $pageData);
// }

    public function activation(){  
      try{
              // throw new UserException("Kode aktifasi salah !!", USER_NOT_FOUND_CODE);
            $id =  $this->uri->segment(2);
            $code = $this->uri->segment(3);
            
            $data = 'kosong';
            $user = 'kosong';
            // fetch user details
          
            $user = $this->UserModel->getUserTemp($id);
            $this->UserModel->RegisterCek($user['username']);
            $data = $this->UserModel->getPasienTemp($user['id_data_pasien']);

            $this->UserModel->RegisterCek2($data['NIK']);
            $this->UserModel->RegisterCek($user['username'],$data['NIK']);
            //if code matches
            if($user['code'] == $code){
              $user['active'] = true;
              
              $iduser = $this->UserModel->addPasien($data);
              $user['id_role']='3';
              $user['id_sub']=$iduser;
              $user['nama']=$data['nama'];

              $this->UserModel->addUser($user);
              $this->UserModel->deleteUserTemp($user);
              $this->UserModel->deletePasienTemp($data);
            }else{
              throw new UserException("Kode aktifasi salah !!", USER_NOT_FOUND_CODE);
            }
            $pageData = array(
              'title' => 'Masuk',
              'contentData' => 'Berhasil',
            );

            $this->load->view('LoginPage', $pageData);
            // echo json_encode(array("error" => FALSE, "data" => 'Berhasil Aktifasi'));
    } catch (Exception $e) {
      $pageData = array(
        'title' => 'Masuk',
        'contentData' => 'Gagal',
      );
      $this->load->view('LoginPage', $pageData);
      // ExceptionHandler::handle($e);
    }
 }

 
 public function activatereq(){
    try{
    $data = $this->input->post();
   
    //fetch user details
    $user = $this->UserModel->getUserTemp($data['id']);
    $dinkes = $this->DinkesModel->getAllPasien(['id_pasien' => $user['id_data_pasien'] ]);
    $dinkes = $dinkes[$user['id_data_pasien']];
    // var_dump($dinkes);
    $data['username'] = $dinkes['NIK'];
    $data['nama'] = $dinkes['nama'];
    $data['id_role'] = '3';
    $data['id_sub'] = $dinkes['id_pasien'];
    //if code matches
    if($user['code'] == $data['code']){
      //  var_dump($data);
        $query = $this->UserModel->addUser($data);
     //update user active status
     if(!$query){
         throw new Exception ('Data Duplikat!!');
     }
        $data['active'] = true;
        $query = $this->UserModel->renderData($data);
    }
    else{
     $this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
    }
  //   $this->load->view('ActivationPage');
    } catch (Exception $e) {
        ExceptionHandler::handle($e);
    }
   }
   

}
