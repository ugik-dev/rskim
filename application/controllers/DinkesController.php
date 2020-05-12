<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DinkesController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('DinkesModel','UserModel','SharedModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }
  
  public function index(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'dinkes/DashboardPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }
  
  public function data_pasien(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Data Dinas Kesehatan',
      'content' => 'dinkes/DataPasien',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function evaluasi(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Evaluasi',
      'content' => 'dinkes/Evaluasi',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function evaluasiAll(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Data Record',
      'content' => 'dinkes/EvaluasiAll',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function DetailData(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Detail Data', 
      'content' => 'dinkes/DetailData',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function panduan(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'dinkes/PanduanPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function getAllPasien(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DinkesModel->getAllPasien($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllPasienProv(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DinkesModel->getAllPasienProv($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllTempatSampel(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DinkesModel->getAllTempatSampel();
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllRecord(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DinkesModel->getAllRecord($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }

  public function getAllPasien_v2(){
    try{
      $this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->DinkesModel->getAllPasien_v2($this->input->get());
			echo json_encode(array("data" => $data));
    } catch (Exception $e){
      ExceptionHandler::handle($e);
    }
  }
  public function DetailPasien(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Detail Data Pasien', 
      'content' => 'dinkes/DetailPasien',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function DetailRecord(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
		$pageData = array(
			'title' => 'Detail Record', 
      'content' => 'dinkes/DetailRecord',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }
  public function DetailRecordPDF(){
    $this->SecurityModel->roleOnlyGuard(TRUE);
    $pageData = array(
			'title' => 'Detail Record', 
			'contentData' => $this->input->get(),
		);
	    $this->load->view('dinkes/DetailRecord',$pageData);
  }

  public function addPasien(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idPasien = $this->DinkesModel->addPasien($data);
      $data = $this->DinkesModel->getAllPasien(['id_pasien' => $idPasien]);
      $data = $data[$idPasien];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function addPasien_v2(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $this->UserModel->RegisterCek($data['username']);
      $this->UserModel->RegisterCek2($data['NIK']);
      $idPasien = $this->UserModel->addPasien($data);
      
      $data['id_role']='3';
      $data['id_sub']=$idPasien;
			$idUser = $this->UserModel->addUser($data);
      $this->email_send($data,'newuser');
  
      $data = $this->DinkesModel->getAllPasien(['id_pasien' => $idPasien]);
      $data = $data[$idPasien];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }
  public function editPasien_v2(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $filter = $this->input->post();
      $this->UserModel->RegisterCek3($filter);
      if(!empty($filter['password'])){
        $this->UserModel->editUser($filter);
        $this->email_send($filter,'changepassword');
      }
      $idPasien = $this->DinkesModel->editPasien($filter);
      $data = $this->DinkesModel->getAllPasienProv(['id_pasien' => $idPasien]);
      $data = $data[$idPasien];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }
  public function addRecord(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idRecord = $this->DinkesModel->addRecord($data);
      $data = $this->DinkesModel->getAllRecord(['id_record' => $idRecord]);
      $data = $data[$idRecord];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function addRecord_berbayar(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $data['tahap'] = '2';
      $data['tanggal_pengambilan_sampel'] =  $data['tanggal_record'];
      $data['tanggal_hasil_labor'] =  $data['tanggal_record'];
     
      $idRecord = $this->DinkesModel->addRecord($data);
      $data = $this->DinkesModel->getAllRecord(['id_record' => $idRecord]);
      $data = $data[$idRecord];
      $this->email_send($data,'new_jadwal_berbayar');
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }
  
  public function editPasien(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idPasien = $this->DinkesModel->editPasien($data);
      $data = $this->DinkesModel->getAllPasien(['id_pasien' => $idPasien]);
      $data = $data[$idPasien];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function deletePasien(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idPasien = $this->DinkesModel->deletePasien($data);
      // $data = $this->DinkesModel->getAllPasien(['id_pasien' => $idPasien]);
      // $data = $data[$idPasien];
			echo json_encode(array());
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function editRecord(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idRecord = $this->DinkesModel->editRecord($data);
      $data = $this->DinkesModel->getAllRecord(['id_record' => $idRecord]);
      $data = $data[$idRecord];
      if($data['lock_record'] == '1'){
        $this->email_send($data,'final_rec');
      }
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function deleteRecord(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idRecord = $this->DinkesModel->deleteRecord($data);
      // $data = $this->DinkesModel->getAllPasien(['id_pasien' => $idPasien]);
      // $data = $data[$idPasien];
			echo json_encode(array());
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }
  function convertDateTime2($date){
    $cetak_hari = true;
    $hari = array ( 1 => 'Senin', 'Selasa', 'Rabu',
          'Kamis', 'Jumat', 'Sabtu','Minggu'
        );
    $bulan = array (1 => 'Januari', 'Februari', 'Maret',
          'April', 'Mei', 'Juni',	'Juli',	'Agustus',
          'September', 'Oktober',	'November',	'Desember'
        );
    $tanggal = explode(' ', $date);
    $jam = $tanggal[1];
    $tanggal = $tanggal[0];
     
    $split 	  = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    
    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo . ' '.substr($jam,0,5);
    }
    return $tgl_indo.' '.substr($jam,0,5);
  }
  public function email_send($data,$tipe){
    // $email = $registerData['email'];
    // var_dump($data);
      // echo  $data['email'];
      //    var_dump($data);
        $send['to'] = $to = $data['email'];
        if($tipe == 'new_jadwal_berbayar'){
          $data_puskes = $this->SharedModel->getAllPuskesmas($data);
          $data_puskes = $data_puskes[$data['id_puskesmas']];
          $send['subject'] = $subject = 'Pemberitahun Penjadwalan & Pembayaran RS Kalbu Intan Mdika';   
          $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="http://intanmedika.com/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
          $emailContent .='<tr><td style="height:20px"></td></tr>';        
          $emailContent .= '';
          $emailContent .= '<br> Nama  : '.$data['nama'];
          $emailContent .= '<br> Tempat  : '.$data['rumah_sakit'];
          $emailContent .= '<br> Waktu : '.$this->convertDateTime2($data['tanggal_record']);
          $emailContent .= '<br> Nomor Antri  : '.$data['no_antri'];    
          $emailContent .= '<br> '. $data_puskes['bank'];
          $emailContent .= '<br> Dengan ini diinfokan untuk melakukan pembayaran terlebih dahulu, dan membawa bukti pembayaran beserta kartu identitas.<br> <br> ';  
          $emailContent .='<tr><td style="height:20px"></td></tr>';
          $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='intanmedika.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>intanmedika.com/covid19/</a></p></td></tr></table></body></html>";    
          $send['message'] = $emailContent;  
         }else if($tipe == 'new_jadwal'){
          $send['subject'] = $subject = 'Pemberitahun Penjadwalan Uji Sampel BABEL PROV Covid - 19';   
          $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="http://intanmedika.com/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
          $emailContent .='<tr><td style="height:20px"></td></tr>';        
          $emailContent .= '';
          $emailContent .= '<br> Nama  : '.$data['nama'];
          $emailContent .= '<br> Tempat  : '.$data['rumah_sakit'];
          $emailContent .= '<br> Waktu : '.$data['tanggal_pengambilan_sampel'];
          $emailContent .= '<br> ';
          $emailContent .= '<br> Diharapkan Bapak / Ibu datang dengan membawakan kartu identitas.<br> <br> ';  
          $emailContent .='<tr><td style="height:20px"></td></tr>';
          $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='intanmedika.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>intanmedika.com/covid19/</a></p></td></tr></table></body></html>";    
          $send['message'] = $emailContent;  
         }else if ($tipe == 'repair_jadwal'){
          $send['subject'] = $subject = 'Pemberitahun Penjadwalan Ulang Uji Sampel BABEL PROV Covid - 19';     
          $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="http://intanmedika.com/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
          $emailContent .='<tr><td style="height:20px"></td></tr>';        
          $emailContent .= '';
          $emailContent .= '<br> Nama  : '.$data['nama_pasien'];
          $emailContent .= '<br> Tempat  : '.$data['nama_instansi'];
          $emailContent .= '<br> Waktu : '.$data['tanggal_pengambilan_sampel'];
          $emailContent .= '<br> ';
          $emailContent .= '<br> Diharapkan Bapak / Ibu datang dengan membawakan kartu identitas.<br> <br> ';  
          $emailContent .='<tr><td style="height:20px"></td></tr>';
          $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='intanmedika.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>intanmedika.com/covid19/</a></p></td></tr></table></body></html>";    
          $send['message'] = $emailContent;  
    
        }else if ($tipe == 'final_rec'){
          $send['subject'] = $subject = 'Pemberitahun Hasil Laboratorium RS Kalbu Intan Mdika';     
          $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="http://intanmedika.com/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
          $emailContent .='<tr><td style="height:20px"></td></tr>';        
          $emailContent .= ' Dengan ini kami menyampaikan bahwa hasil uji sampel Bapak/Ibu sudah keluar dengan :';
          $emailContent .= '<br> Nama  : '.$data['nama'];
          $emailContent .= '<br> Nomor Rekam Medis  : '.$data['no_rekam'];
          $emailContent .= '<br> Rumah Sakit : '.$data['rumah_sakit'];
          $emailContent .= '<br> ';
          $emailContent .='<tr><td style="height:20px"></td></tr>';
          $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='intanmedika.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>intanmedika.com/covid19/</a></p></td></tr></table></body></html>";    
          $send['message'] = $emailContent;  
  
        }else if ($tipe == 'hasil'){
          $send['subject'] = $subject = 'Pemberitahun Hasil Uji Sampel BABEL PROV Covid - 19';     
          $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="http://intanmedika.com/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
          $emailContent .='<tr><td style="height:20px"></td></tr>';        
          $emailContent .= ' Dengan ini kami menyampaikan bahwa hasil uji sampel Bapak/Ibu sudah keluar dengan :';
          $emailContent .= '<br> Nama  : '.$data['nama_pasien'];
          $emailContent .= '<br> Nomor Sampel  : '.$data['no_sampel'];
          $emailContent .= '<br> Waktu : '.$data['tanggal_pengambilan_sampel'];
          $emailContent .= '<br> ';
          $emailContent .='<tr><td style="height:20px"></td></tr>';
          $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='intanmedika.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>intanmedika.com/covid19/</a></p></td></tr></table></body></html>";    
          $send['message'] = $emailContent;  
  
        }else if ($tipe == 'labor'){
          $send['subject'] = $subject = 'Pemberitahun Hasil Uji Laboratorim BABEL PROV Covid - 19';     
          $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="http://intanmedika.com/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
          $emailContent .='<tr><td style="height:20px"></td></tr>';        
          $emailContent .= ' Dengan ini kami menyampaikan bahwa hasil uji lab Bapak/Ibu sudah keluar dengan :';
          $emailContent .= '<br> Nama  : '.$data['nama_pasien'];
          $emailContent .= '<br> Nomor Sampel  : '.$data['no_sampel'];
          $emailContent .= '<br> Waktu : '.$data['tanggal_hasil_labor'];
          $emailContent .= '<br> ';
          $emailContent .='<tr><td style="height:20px"></td></tr>';
          $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='intanmedika.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>intanmedika.com/covid19/</a></p></td></tr></table></body></html>";    
          $send['message'] = $emailContent;  
  
        }else if ($tipe == 'changepassword'){
          $send['subject'] = $subject = 'Pemberitahun Informasi Login RS Kalbu Intan Mdika';     
          $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="http://intanmedika.com/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
          $emailContent .='<tr><td style="height:20px"></td></tr>';        
          $emailContent .= ' Dengan ini kami menyampaikan bahwa data login anda sudah dirubah, dengan data sebagai berikut :';
          $emailContent .= '<br> Nama  : '.$data['nama'];
          $emailContent .= '<br> NIK   : '.$data['NIK'];
          $emailContent .= '<br> Username : '.$data['username'];
          $emailContent .= '<br> Password : '.$data['password'];
          $emailContent .= '<br> ';
          $emailContent .='<tr><td style="height:20px"></td></tr>';
          $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='intanmedika.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>intanmedika.com/covid19/</a></p></td></tr></table></body></html>";    
          $send['message'] = $emailContent;  
  
        }else if ($tipe == 'newuser'){
          $send['subject'] = $subject = 'Pemberitahun Informasi Login BABEL PROV Covid - 19';     
          $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="http://intanmedika.com/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
          $emailContent .='<tr><td style="height:20px"></td></tr>';        
          $emailContent .= ' Dengan ini kami menyampaikan bahwa data login anda sebagai berikut :';
          $emailContent .= '<br> Nama  : '.$data['nama'];
          $emailContent .= '<br> NIK   : '.$data['NIK'];
          $emailContent .= '<br> Username : '.$data['username'];
          $emailContent .= '<br> Password : '.$data['password'];
          $emailContent .= '<br> ';
          $emailContent .='<tr><td style="height:20px"></td></tr>';
          $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='intanmedika.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>intanmedika.com/covid19</a></p></td></tr></table></body></html>";    
          $send['message'] = $emailContent;  
  
        }


      $serv = $this->UserModel->getServerSTMP($data);  
      $config['protocol']    = 'smtp';
      $config['smtp_host']    = $serv['url_'];
      $config['smtp_port']    = '587';
      $config['smtp_timeout'] = '60';
      $config['smtp_user']    = $serv['username'];    //Important
      $config['smtp_pass']    = $serv['key'];  //Important
      $config['charset']    = 'utf-8';
      $config['newline']    = '\r\n';
      $config['mailtype'] = 'html'; // or html
      $config['validation'] = TRUE; // bool whether to validate email or not 
      $send['config'] = $config;
      $this->email->initialize($send['config']);
      $this->email->set_mailtype("html");
      $this->email->from($serv['username']);
      $this->email->to($send['to']);
      $this->email->subject($send['subject']);
      $this->email->message($send['message']);
      $this->email->send();

      return $send;
  }
 
}
