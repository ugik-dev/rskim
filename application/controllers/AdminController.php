<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('DBConfigModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }
  
  public function index(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'admin/DashboardPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }
  
  public function kelola_user(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Kelola User',
      'content' => 'admin/KelolaUserPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }
  
  public function data_induk(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Data DTKS KEMENSOS',
      'content' => 'admin/DataInduk',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function data_umkm(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Data UMKM',
      'content' => 'admin/DataUMKM',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function terdampak_phk(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Terdampak PHK',
      'content' => 'admin/TerdampakPHK',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }
  
  public function terdampak_dirumahkan(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Terdampak Dirumahkan',
      'content' => 'admin/TerdampakDirumahkan',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }
  
  public function prior_phk(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Prioritas Terdampak PHK',
      'content' => 'admin/PriorPHK',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }
  
  public function prior_dirumahkan(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Prioritas Terdampak Dirumahkan',
      'content' => 'admin/PriorDirumahkan',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function DetailData(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Detail Data', 
      'content' => 'admin/DetailData',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function PageInfoBantuan(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Detail BDT', 
      'content' => 'admin/PageInfoBantuan',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function PageInfoBantuanUMKM(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Detail UMKM', 
      'content' => 'admin/PageInfoBantuanUMKM',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function kategori1(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Kategori Bantuan PKH dan BPNT', 
      'content' => 'admin/Kategori1',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function kategori2(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Kategori Bantuan BPNT', 
      'content' => 'admin/Kategori2',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function kategori3(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Kategori Bantuan Non PKH & BPNT', 
      'content' => 'admin/Kategori3',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function kategori4(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Kategori Bantuan (Dinas Pemberdayaan Masyarakat Desa)  yang belum menerima kategori 1,2,3 dan 6', 
      'content' => 'admin/Kategori4',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function kategori5(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Kategori Bantuan Dinas Kesehatan', 
      'content' => 'admin/Kategori5',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function kategori6(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Kategori Bantuan (Dinas Koperasi & UMKM) yang belum menerima kategori 1,2,3 dan 4', 
      'content' => 'admin/Kategori6',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function kategori7(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Kategori Bantuan (Dinas Tenaga Kerja) yang belum menerima kategori 1,2,3,4 dan 6', 
      'content' => 'admin/Kategori7',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  

  public function DetailDataDirumahkan(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Detail Data', 
      'content' => 'admin/DetailDataDirumahkan',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => $this->input->get(),
		);
    $this->load->view('Page', $pageData);
  }

  public function sync_opd(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Sync OPD',
      'content' => 'admin/SyncOPDPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function panduan(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Beranda',
      'content' => 'admin/PanduanPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
		);
    $this->load->view('Page', $pageData);
  }

  public function getAllDBConfig(){
    try {
      $this->SecurityModel->roleOnlyGuard('admin');
      $dbconfigs = $this->DBConfigModel->getAllDBConfig();
      echo json_encode(['data' => $dbconfigs]);
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function testDBConfig(){
    try {
      $this->SecurityModel->roleOnlyGuard('admin');
      $dbconfig = $this->input->post();

      switch($dbconfig['dbdriver']){
        case 'mysqli':
          $db3 = $this->load->database($dbconfig, TRUE);
          if(!$db3) throw new UserException('Database tidak bisa dicapai!', 0);
          break;
        case 'sqlserver':
          $CONNECTION_INFO = array('Database' => $dbconfig['database'], 'UID' => $dbconfig['username'], 'PWD' => $dbconfig['password']);
          $conn = sqlsrv_connect( $dbconfig['hostname'], $CONNECTION_INFO );
          if( $conn === false ) throw new UserException('Database tidak bisa dicapai!', 0);
          sqlsrv_close($conn);
          break;
      }

      echo json_encode([]);
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function editDBConfig(){
    try {
      $this->SecurityModel->roleOnlyGuard('admin');
      $data = $this->input->post();

      $status = $this->DBConfigModel->editDBConfig($data);
      $dbconfig = $this->DBConfigModel->getDBConfig($data['id_db_config']);
      
      echo json_encode(['data' => $dbconfig]);
    } catch (Exception $e) {
      ExceptionHandler::handle($e);
    }
  }

  public function import_rpjmd_eplanning(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Import RPJMD', 
      'content' => 'ImportRPJMDPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => array(),
		);
    $this->load->view('Page', $pageData);
  }
   
  public function import_rpjmd_simda(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Import RPJMD Simmda', 
      'content' => 'ImportRPJMDSimdaPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => array(),
		);
    $this->load->view('Page', $pageData);
  }

  public function export_rpjmd_simda(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Export RPJMD Simda', 
      'content' => 'admin/ExportRPJMDPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => array(),
		);
    $this->load->view('Page', $pageData);
  }

  public function import_belanja_simda(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Import Belanja Simda', 
      'content' => 'admin/ImportBelanjaPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => array(),
		);
    $this->load->view('Page', $pageData);
  }

  public function import_fisik_simda(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Import Fisik Simda', 
      'content' => 'admin/ImportFisikPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => array(),
		);
    $this->load->view('Page', $pageData);
  }

  
  public function import_realisasi_keuangan_simda(){
    $this->SecurityModel->roleOnlyGuard('admin');
		$pageData = array(
			'title' => 'Import Realisasi Keuangan Simda', 
      'content' => 'admin/ImportRealisasiKeuanganPage',
      'breadcrumb' => array(
        'Home' => base_url(),
      ),
			'contentData' => array(),
		);
    $this->load->view('Page', $pageData);
  }
}
