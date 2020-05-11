<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PasienController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('DinkesModel','PasienModel','UserModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }

  public function index(){
    $this->SecurityModel->roleOnlyGuard('pasien');
    // var_dump( $this->session->userdata());
    if($this->session->userdata('pembayaran') == '1'){
      $pageData = array(
        'title' => 'Beranda',
        'content' => 'rumah_sakit/DetailPasien',
        'breadcrumb' => array(
          'Home' => base_url(),
        ),
        'contentData' => array('id_pasien' => $this->session->userdata('id_pasien') ),
      );
    }else{
      $pageData = array(
        'title' => 'Beranda',
        'content' => 'pasien/DashboardPage',
        'breadcrumb' => array(
          'Home' => base_url(),
        ),
      );
    }
    $this->load->view('Page', $pageData);
  }

  public function tracking(){
    $this->SecurityModel->roleOnlyGuard('pasien');
		$pageData = array(
			'title' => 'Riwayat Jalan',
      'content' => 'pasien/Tracking',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function sampel(){
    $this->SecurityModel->roleOnlyGuard('pasien');
		$pageData = array(
			'title' => 'Sampel',
      'content' => 'pasien/Sampel',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function kontak(){
    $this->SecurityModel->roleOnlyGuard('pasien');
		$pageData = array(
			'title' => 'Riwayat Kontak',
      'content' => 'pasien/Kontak',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function panduan(){
    $this->SecurityModel->roleOnlyGuard('pimpinan');
		$pageData = array(
			'title' => 'Panduan',
      'content' => 'pimpinan/PanduanPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => array(),
		);
    $this->load->view('Page', $pageData);
  }

  

  public function requestSampel(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idRequest = $this->PasienModel->requestSampel($data);
      // var_dump($idRequest);
      $data = $this->PasienModel->getAllSampel(['id_sampel' => $idRequest]);
      $data = $data[$idRequest];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }


  public function editSampel(){
    function email_send($data,$tipe){
      // $email = $registerData['email'];
      // var_dump($data);
        // echo  $data['email'];
        //    var_dump($data);
          $send['to'] = $to = $data['email'];
          if($tipe == 'new_jadwal'){
            $send['subject'] = $subject = 'Pemberitahun Penjadwalan Uji Sampel BABEL PROV Covid - 19';   
            $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="https://integrasi.babelprov.go.id/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
            $emailContent .='<tr><td style="height:20px"></td></tr>';        
            $emailContent .= '';
            $emailContent .= '<br> Nama  : '.$data['nama_pasien'];
            $emailContent .= '<br> Tempat  : '.$data['nama_instansi'];
            $emailContent .= '<br> Waktu : '.$data['tanggal_pengambilan_sampel'];
            $emailContent .= '<br> ';
            $emailContent .= '<br> Diharapkan Bapak / Ibu datang dengan membawakan kartu identitas.<br> <br> ';  
            $emailContent .='<tr><td style="height:20px"></td></tr>';
            $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='ugik-dev.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>ugik-dev.com/covid19/</a></p></td></tr></table></body></html>";    
            $send['message'] = $emailContent;  
           }else if ($tipe == 'repair_jadwal'){
            $send['subject'] = $subject = 'Pemberitahun Penjadwalan Ulang Uji Sampel BABEL PROV Covid - 19';     
            $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="https://integrasi.babelprov.go.id/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
            $emailContent .='<tr><td style="height:20px"></td></tr>';        
            $emailContent .= '';
            $emailContent .= '<br> Nama  : '.$data['nama_pasien'];
            $emailContent .= '<br> Tempat  : '.$data['nama_instansi'];
            $emailContent .= '<br> Waktu : '.$data['tanggal_pengambilan_sampel'];
            $emailContent .= '<br> ';
            $emailContent .= '<br> Diharapkan Bapak / Ibu datang dengan membawakan kartu identitas.<br> <br> ';  
            $emailContent .='<tr><td style="height:20px"></td></tr>';
            $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='ugik-dev.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>ugik-dev.com/covid19/</a></p></td></tr></table></body></html>";    
            $send['message'] = $emailContent;  
      
          }else if ($tipe == 'hasil'){
            $send['subject'] = $subject = 'Pemberitahun Hasil Uji Sampel BABEL PROV Covid - 19';     
            $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="https://integrasi.babelprov.go.id/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
            $emailContent .='<tr><td style="height:20px"></td></tr>';        
            $emailContent .= ' Dengan ini kami menyampaikan bahwa hasil uji sampel Bapak/Ibu sudah keluar dengan :';
            $emailContent .= '<br> Nama  : '.$data['nama_pasien'];
            $emailContent .= '<br> Nomor Sampel  : '.$data['no_sampel'];
            $emailContent .= '<br> Waktu : '.$data['tanggal_pengambilan_sampel'];
            $emailContent .= '<br> ';
            $emailContent .='<tr><td style="height:20px"></td></tr>';
            $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='ugik-dev.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>ugik-dev.com/covid19/</a></p></td></tr></table></body></html>";    
            $send['message'] = $emailContent;  
    
          }else if ($tipe == 'labor'){
            $send['subject'] = $subject = 'Pemberitahun Hasil Uji Laboratorim BABEL PROV Covid - 19';     
            $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#F00000;padding-left:3%"><img src="https://integrasi.babelprov.go.id/covid19/assets/img/logo-babel.png" width="60px" vspace=0 /></td></tr>';
            $emailContent .='<tr><td style="height:20px"></td></tr>';        
            $emailContent .= ' Dengan ini kami menyampaikan bahwa hasil uji lab Bapak/Ibu sudah keluar dengan :';
            $emailContent .= '<br> Nama  : '.$data['nama_pasien'];
            $emailContent .= '<br> Nomor Sampel  : '.$data['no_sampel'];
            $emailContent .= '<br> Waktu : '.$data['tanggal_hasil_labor'];
            $emailContent .= '<br> ';
            $emailContent .='<tr><td style="height:20px"></td></tr>';
            $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='ugik-dev.com/covid19/index.php/login' target='_blank' style='text-decoration:none;color: #60d2ff;'>ugik-dev.com/covid19/</a></p></td></tr></table></body></html>";    
            $send['message'] = $emailContent;  
    
          }
          // $send['subject'] = $subject = 'Pemberitahun Uji Sampel BABEL PROV Covid - 19';
 
          // Pass here your mail id   
         
         
          // $send['config'] = $config;
          // $this->email->initialize($config);
          // $this->email->set_mailtype("html");
          // $this->email->from($from);
          // $this->email->to($to);
          // $this->email->subject($subject);
          // $this->email->message($message);
          // $this->email->send();
        return $send;
    }

		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      if(!empty($data['hasil_labor'])){  
        $idRequest = $this->PasienModel->editSampel($data);
        $data = $this->PasienModel->getAllSampel(['id_sampel' => $idRequest]);
        $data = $data[$idRequest];

        $datalab = $this->PasienModel->getAllSampelForLabor(['id_sampel' => $data['id_sampel']]);
        // var_dump($datalab);
        $send = email_send($datalab[$idRequest],'labor');
      }else{
        $data_old = $this->PasienModel->getAllSampel(['id_sampel' => $data['id_sampel']]);
        $data_old = $data_old[$data['id_sampel']];
    
        $idRequest = $this->PasienModel->editSampel($data);
        // var_dump($data_old);
        $data = $this->PasienModel->getAllSampel(['id_sampel' => $idRequest]);
        $data = $data[$idRequest];
  
        if(empty($data['hasil'])){
            // email penjadwalan
            if(empty($data_old['tanggal_pengambilan_sampel'])){
              $send = email_send($data,'new_jadwal');
            }else{
              $send = email_send($data,'repair_jadwal');
            }
          
        }else{
          $send = email_send($data,'hasil');
        }
  
       
      }

      $serv = $this->UserModel->getServerSTMP();   

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
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  

  public function addTracking(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idRequest = $this->PasienModel->addTracking($data);
      // var_dump($idRequest);
      $data = $this->PasienModel->getAllTracking(['id_data_tracking' => $idRequest]);
      $data = $data[$idRequest];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function editTracking(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idRequest = $this->PasienModel->editTracking($data);
      // var_dump($idRequest);
      $data = $this->PasienModel->getAllTracking(['id_data_tracking' => $idRequest]);
      $data = $data[$idRequest];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function deleteTracking(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
			$data = $this->input->post();
			$this->PasienModel->deleteTracking($data);
			echo json_encode(array());
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

  public function addKontak(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idRequest = $this->PasienModel->addKontak($data);
      // var_dump($idRequest);
      $data = $this->PasienModel->getAllKontak(['id_data_kontak' => $idRequest]);
      $data = $data[$idRequest];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function editKontak(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->post();
      $idRequest = $this->PasienModel->editKontak($data);
      // var_dump($idRequest);
      $data = $this->PasienModel->getAllKontak(['id_data_kontak' => $idRequest]);
      $data = $data[$idRequest];
			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function deleteKontak(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
			$data = $this->input->post();
			$this->PasienModel->deleteKontak($data);
			echo json_encode(array());
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
	}

  public function getAllKontak(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->get();
      $data = $this->PasienModel->getAllKontak($data);

			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }
  public function getAllSampel(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->get();
      $data = $this->PasienModel->getAllSampel($data);

			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }

  public function getAllTracking(){
		try{
			$this->SecurityModel->userOnlyGuard(TRUE);
      $data = $this->input->get();
      $data = $this->PasienModel->getAllTracking($data);

			echo json_encode(array("data" => $data));
		} catch (Exception $e) {
			ExceptionHandler::handle($e);
		}
  }
}
