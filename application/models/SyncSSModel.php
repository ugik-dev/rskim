<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SyncSSModel extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  private function replace($data, $existing, $table, $key){
    $dataInsert = DataStructure::getNewAndUpdates($data, $existing);
    if(count($dataInsert['new']) > 0) $this->db->insert_batch($table, $dataInsert['new']);
    if(count($dataInsert['updates']) > 0) $this->db->update_batch($table, $dataInsert['updates'], $key);
    if(count($dataInsert['removed']) > 0) {
      $this->db->where_in($key, DataStructure::toOneDimension($dataInsert['removed'], $key));
      $this->db->delete($table);
    };
  }

  public function getSUrusan(){
    $this->db->select('*');
    $this->db->from('sync_s_urusan');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_urusan');
  }
  
  public function insertSUrusan($data){
    $this->replace($data, $this->getSUrusan(), 'sync_s_urusan', 'id_urusan');
    ExceptionHandler::handleDBError($this->db->error(), "Backup Sync Simda Urusan", "sync_s_urusan");
    return True;
  }

  public function getSBidang(){
    $this->db->select('*');
    $this->db->from('sync_s_bidang');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_bidang');
  }
  
  public function insertSBidang($data){
    $this->replace($data, $this->getSBidang(), 'sync_s_bidang', 'id_bidang');
    ExceptionHandler::handleDBError($this->db->error(), "Backup Sync Simda Bidang", "sync_s_bidang");
    return True;
  }

  
  public function getAllSOPD(){
    $this->db->select('*');
    $this->db->from('sync_s_opd');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_opd');
  }
  
  public function insertSOPD($data){
    $this->replace($data, $this->getAllSOPD(), 'sync_s_opd', 'id_opd');
    ExceptionHandler::handleDBError($this->db->error(), "Backup Sync Simda OPD", "sync_s_opd");
    return True;
  }

  
  public function getAllSSubOPD(){
    $this->db->select('*');
    $this->db->from('sync_s_sub_opd');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_sub_opd');
  }
  
  public function insertSSubOPD($data){
    $this->replace($data, $this->getAllSSubOPD(), 'sync_s_sub_opd', 'id_sub_opd');
    ExceptionHandler::handleDBError($this->db->error(), "Backup Sync Simda SubOPD", "sync_s_sub_opd");
    return True;
  }

  
  public function getAllEOPD($filter = []){
    $this->db->select('seo.*');
    $this->db->from('sync_e_opd as seo');
    if(!empty($filter['id_opd'])) $this->db->where('seo.id_opd', $filter['id_opd']);
    
    $this->db->select('seso.*');
    $this->db->join('sync_e_sub_opd as seso', 'seso.id_opd = seo.id_opd');
    
    $res = $this->db->get();
    return DataStructure::groupByRecursive2($res->result_array(), ['id_opd'], ['id_sub_opd'], [['id_opd', 'nama_opd', 's_id_opd'], ['id_sub_opd', 'nama_sub_opd', 's_id_sub_opd']], ['sub_opd']);
  }

	public function getEOPD($idOPD = NULL){
		$row = $this->getAllEOPD(['id_opd' => $idOPD]);
		if (empty($row)){
			throw new UserException("OPD yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$idOPD];
  }
  
  public function insertEOPD($data){
    $this->replace($data, $this->getAllEOPD(), 'sync_e_opd', 'id_opd');
    ExceptionHandler::handleDBError($this->db->error(), "Backup Sync EPlanning OPD Gagal", "sync_e_opd");
    return True;
  }

  public function syncEOPD($data){
    $this->db->set('s_id_opd', $data['s_id_opd'] ?: null);
    $this->db->where('id_opd', $data['id_opd']);
    $this->db->update('sync_e_opd');
    ExceptionHandler::handleDBError($this->db->error(), "Backup Sync EPlanning OPD Gagal", "sync_e_opd");

    return True;
  }
  
  public function getAllESubOPD(){
    $this->db->select('seso.*');
    $this->db->from('sync_e_sub_opd as seso');
    if(!empty($filter['id_sub_opd'])) $this->db->where('seso.id_sub_opd', $filter['id_sub_opd']);
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_sub_opd');
  }
  
	public function getESubOPD($idSubOPD = NULL){
		$row = $this->getAllESubOPD(['id_sub_opd' => $idSubOPD]);
		if (empty($row)){
			throw new UserException("Sub OPD yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$idSubOPD];
  }

  public function insertESubOPD($data){
    $this->replace($data, $this->getAllESubOPD(), 'sync_e_sub_opd', 'id_sub_opd');
    ExceptionHandler::handleDBError($this->db->error(), "Backup Sync EPlanning SubOPD", "sync_e_sub_opd");
    return True;
  }

  public function syncESubOPD($data){
    $this->db->set('s_id_sub_opd', $data['s_id_sub_opd'] ?: null);
    $this->db->where('id_sub_opd', $data['id_sub_opd']);
    $this->db->update('sync_e_sub_opd');
    ExceptionHandler::handleDBError($this->db->error(), "Sync EPlanning Sub OPD Gagal", "sync_e_sub_opd");
    
    return True;
  }
  
  public function getAllEProgram(){
    $this->db->select('sep.*');
    $this->db->from('sync_e_program as sep');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_program_renja');
  }
  
	public function getEProgram($idProgramRenja = NULL){
		$row = $this->getAllEProgram(['id_program_renja' => $idProgramRenja]);
		if (empty($row)){
			throw new UserException("Program yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$idProgramRenja];
  }

  public function insertEProgram($data){
    $this->db->empty_table('sync_e_program');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying EPlanning Program Failed", "sync_e_kegiatan");
    
    if(empty($data)) return;
    $this->db->insert_batch('sync_e_program', $data);
    // $this->replace($data, $this->getAllEProgram(), 'sync_e_program', 'id_program_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Backup EPlanning Program", "sync_e_program");
    return True;
  }
  
  public function insertSProgram($filter, $data){
    $this->db->where('tahun', $filter['tahun'])->delete('sync_s_program');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Simda Program Failed", "sync_s_program");

    if(empty($data)) return;
    $this->db->insert_batch('sync_s_program', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Program Failed", "sync_s_program");
    return True;
  }

  private function __getCrossProgram(){
    $res = $this->db->query(
      "SELECT
        sep.`id_program_renja` AS id_e_program,
        sep.`nama_program_renja` AS nama_e_program,
        seso.`s_id_sub_opd`,
        sep.`tahun`,
        ssp.`id_program_renja` AS id_s_program,
        ssp.`nama_program_renja` AS nama_s_program
      FROM
        sync_e_program AS sep
        JOIN sync_e_sub_opd AS seso
          ON seso.`id_sub_opd` = sep.`id_opd`
        JOIN sync_s_program AS ssp
          ON SUBSTRING_INDEX(ssp.`id_program_renja`, '|', 4) = seso.`s_id_sub_opd` AND ssp.`tahun` = sep.`tahun`"
    );
    return $res->result_array();
  }

  public function makeCrossProgram(){
    $cross = $this->__getCrossProgram();
    foreach($cross as $k => $v){
      similar_text(strtolower($v['nama_e_program']), strtolower($v['nama_s_program']), $distance);
      $cross[$k]['distance'] = $distance;
    }
    $maxPerProgram = [];
    $selectedSimda = [];
    foreach(DataStructure::groupBy($cross, 'id_e_program') as $id => $possibilities){
      $maxPerProgram[$id] = ['id_program_renja' => $id, 'distance' => 0, 'id_s_program_renja' => NULL];
      foreach($possibilities as $v){
        if(!in_array($v['id_s_program'], $selectedSimda) && $v['distance'] >= 70 && $v['distance'] > $maxPerProgram[$id]['distance']){
          $maxPerProgram[$id]['distance'] = $v['distance'];
          $maxPerProgram[$id]['id_s_program_renja'] = $v['id_s_program'];
        }
      }
      if($maxPerProgram[$id]['id_s_program_renja'] != NULL) $selectedSimda[] = $maxPerProgram[$id]['id_s_program_renja']; 
    }

    $data = DataStructure::slice2d($maxPerProgram, ['id_program_renja', 'id_s_program_renja']);
    if(count($data) > 0) $this->db->update_batch('sync_e_program', $data, 'id_program_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Cross Bank Program Failed", "sync_e_program");
  }

  public function insertSBankProgram($data){
    $this->db->empty_table('sync_s_bank_program');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Simda Bank Program Failed", "sync_s_bank_program");
    
    if(empty($data)) return;
    $this->db->insert_batch('sync_s_bank_program', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Bank Program Failed", "sync_s_bank_program");
    return True;
  }

  public function makeEBankProgram(){
    $this->db->empty_table('sync_e_bank_program');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying EPlanning Bank Program Failed", "sync_e_bank_program");

    $this->db->select('sep.id_program_renja as id_bank_program_renja, GROUP_CONCAT(sep.id_program_renja SEPARATOR ";") as id_program_renja, sep.nama_program_renja, SUBSTRING_INDEX(SUBSTRING_INDEX(seso.s_id_sub_opd, "|", 1), "|", 1) as id_urusan,  SUBSTRING_INDEX(SUBSTRING_INDEX(seso.s_id_sub_opd, "|", 2), "|", -1) as id_bidang, ssp.id_bank_program_renja');
    $this->db->from('sync_e_program as sep');
    $this->db->join('sync_e_sub_opd as seso', 'seso.id_sub_opd = sep.id_opd');
    $this->db->join('sync_s_program as ssp', 'ssp.id_program_renja = sep.id_s_program_renja', 'LEFT');
    $this->db->group_by('sep.nama_program_renja, seso.s_id_sub_opd, ssp.id_bank_program_renja');

    $sql = $this->db->get_compiled_select();
    $res = $this->db->query("INSERT INTO sync_e_bank_program {$sql}");
    ExceptionHandler::handleDBError($this->db->error(), "Transform EPlanning Bank Program Failed", "sync_e_bank_program");
    
    $this->db->query(
      "UPDATE sync_e_program AS sep JOIN sync_e_bank_program AS sebp 
        ON CONCAT(';',sebp.`id_program_renja`, ';') LIKE CONCAT('%;', sep.`id_program_renja`, ';%') 
        SET sep.`id_bank_program_renja` = sebp.`id_bank_program_renja`"
    );
    return True;
  }

  
  public function getAllEKegiatan(){
    $this->db->select('sek.*');
    $this->db->from('sync_e_kegiatan as sek');
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_kegiatan_renja');
  }
  
	public function getEKegiatan($idKegiatanRenja = NULL){
		$row = $this->getAllEKegiatan(['id_kegiatan_renja' => $idKegiatanRenja]);
		if (empty($row)){
			throw new UserException("Kegiatan yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
		}
		return $row[$idKegiatanRenja];
  }

  public function insertEKegiatan($data){
    $this->db->empty_table('sync_e_kegiatan');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying EPlanning Kegiatan Failed", "sync_e_kegiatan");
    
    if(empty($data)) return;
    $this->db->insert_batch('sync_e_kegiatan', $data);
    // $this->replace($data, $this->getAllEKegiatan(), 'sync_e_kegiatan', 'id_kegiatan_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Backup EPlanning Program", "sync_e_program");
    return True;
  }

  public function insertSKegiatan($filter, $data){
    $this->db->where('tahun', $filter['tahun'])->delete('sync_s_kegiatan');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Simda Kegiatan Failed", "sync_s_kegiatan");

    if(empty($data)) return;
    $this->db->insert_batch('sync_s_kegiatan', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Kegiatan Failed", "sync_s_kegiatan");
    return True;
  }

  private function __getCrossKegiatan(){
    $res = $this->db->query(
      "SELECT
        sek.`id_kegiatan_renja` AS id_e_kegiatan,
        sek.`nama_kegiatan_renja` AS nama_e_kegiatan,
        sep.`id_s_program_renja`,
        ssk.`id_kegiatan_renja` AS id_s_kegiatan,
        ssk.`nama_kegiatan_renja` AS nama_s_kegiatan
      FROM
        sync_e_kegiatan AS sek
        JOIN `sync_e_program` AS sep
          ON sep.`id_program_renja` = sek.`id_program_renja`
        JOIN sync_s_kegiatan AS ssk
          ON SUBSTRING_INDEX(ssk.`id_kegiatan_renja`, '|', 6) = sep.`id_s_program_renja`
          AND ssk.`tahun` = sep.`tahun`"
    );
    return $res->result_array();
  }

  public function makeCrossKegiatan(){
    $cross = $this->__getCrossKegiatan();
    foreach($cross as $k => $v){
      similar_text(strtolower($v['nama_e_kegiatan']), strtolower($v['nama_s_kegiatan']), $distance);
      $cross[$k]['distance'] = $distance;
    }
    $maxPerKegiatan = [];
    $selectedSimda = [];
    foreach(DataStructure::groupBy($cross, 'id_e_kegiatan') as $id => $possibilities){
      $maxPerKegiatan[$id] = ['id_kegiatan_renja' => $id, 'distance' => 0, 'id_s_kegiatan_renja' => NULL];
      foreach($possibilities as $v){
        if(!in_array($v['id_s_kegiatan'], $selectedSimda) && $v['distance'] >= 70 && $v['distance'] > $maxPerKegiatan[$id]['distance']){
          $maxPerKegiatan[$id]['distance'] = $v['distance'];
          $maxPerKegiatan[$id]['id_s_kegiatan_renja'] = $v['id_s_kegiatan'];
        }
      }
      if($maxPerKegiatan[$id]['id_s_kegiatan_renja'] != NULL) $selectedSimda[] = $maxPerKegiatan[$id]['id_s_kegiatan_renja']; 
    }

    $data = DataStructure::slice2d($maxPerKegiatan, ['id_kegiatan_renja', 'id_s_kegiatan_renja']);
    if(count($data) > 0) $this->db->update_batch('sync_e_kegiatan', $data, 'id_kegiatan_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Cross Kegiatan Failed", "sync_e_kegiatan");
  }

  public function insertSBankKegiatan($data){
    $this->db->empty_table('sync_s_bank_kegiatan');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Simda Bank Kegiatan Failed", "sync_s_bank_kegiatan");

    if(empty($data)) return;
    $this->db->insert_batch('sync_s_bank_kegiatan', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Bank Kegiatan Failed", "sync_s_bank_kegiatan");
    return True;
  }

  public function makeEBankKegiatan(){
    $this->db->empty_table('sync_e_bank_kegiatan');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying EPlanning Bank Kegiatan Failed", "sync_e_bank_kegiatan");

    $this->db->select('sek.id_kegiatan_renja as id_bank_kegiatan_renja, GROUP_CONCAT(sek.id_kegiatan_renja SEPARATOR ";") as id_kegiatan_renja, sek.nama_kegiatan_renja, sep.id_bank_program_renja, ssk.id_bank_kegiatan_renja');
    $this->db->from('sync_e_kegiatan as sek');
    $this->db->join('sync_e_sub_opd as seso', 'seso.id_sub_opd = sek.id_opd');
    $this->db->join('sync_e_program as sep', 'sep.id_program_renja = sek.id_program_renja', 'LEFT');
    $this->db->join('sync_s_kegiatan as ssk', 'ssk.id_kegiatan_renja = sek.id_s_kegiatan_renja', 'LEFT');
    $this->db->group_by('sek.nama_kegiatan_renja, seso.s_id_sub_opd, ssk.id_bank_kegiatan_renja');

    $sql = $this->db->get_compiled_select();
    $res = $this->db->query("INSERT INTO sync_e_bank_kegiatan {$sql}");
    ExceptionHandler::handleDBError($this->db->error(), "Transform EPlanning Bank Kegiatan Failed", "sync_e_bank_kegiatan");
    
    $res = $this->db->get('sync_e_bank_kegiatan');
    $dataInsert = [];
    foreach($res->result_array() as $bk){
      foreach(explode(';', $bk['id_kegiatan_renja']) as $id){
        $dataInsert[$id] = ['id_kegiatan_renja' => $id, 'id_bank_kegiatan_renja' => $bk['id_bank_kegiatan_renja']];
      }
    }
    if(count($dataInsert) > 0) $this->db->update_batch('sync_e_kegiatan', $dataInsert, 'id_kegiatan_renja');
    return True;
  }
  
  public function insertSBelanja($param, $data){
    if(count($data) <= 0) return;

    $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(id_belanja, '|', 6), '|', -1) =", $param['tahun'])->delete('sync_s_belanja');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Simda Belanja Failed", "sync_s_belanja");

    $this->db->insert_batch('sync_s_belanja', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Belanja Failed", "sync_s_belanja");
    return True;
  }

  public function insertSBelanjaRinc($param, $data){
    if(count($data) <= 0) return;

    $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(id_belanja_rinc, '|', 6), '|', -1) =", $param['tahun'])->delete('sync_s_belanja_rinc');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Simda Belanja Rincian Failed", "sync_s_belanja_rinc");

    $this->db->insert_batch('sync_s_belanja_rinc', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Belanja Rincian Failed", "sync_s_belanja_rinc");
    return True;
  }

  public function insertSBelanjaRincSub($param, $data){
    if(count($data) <= 0) return;

    $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(id_belanja_rinc_sub, '|', 6), '|', -1) =", $param['tahun'])->delete('sync_s_belanja_rinc_sub');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Simda Belanja Rincian Sub Failed", "sync_s_belanja_rinc_sub");

    $this->db->insert_batch('sync_s_belanja_rinc_sub', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Belanja Rincian Sub Failed", "sync_s_belanja_rinc_sub");
    return True;
  }

  public function getKegiatanTotalBelanja($param){
    $this->db->select('sek.id_kegiatan_renja, SUM(sebrs.total_rp) as total_belanja');
    $this->db->from('sync_e_kegiatan as sek');
    $this->db->join('sync_s_belanja as seb', 'seb.id_kegiatan_renja = sek.id_s_kegiatan_renja', 'LEFT');
    $this->db->join('sync_s_belanja_rinc as sebr', 'sebr.id_belanja = seb.id_belanja', 'LEFT');
    $this->db->join('sync_s_belanja_rinc_sub as sebrs', 'sebrs.id_belanja_rinc = sebr.id_belanja_rinc', 'LEFT');
    $this->db->group_by('sek.id_kegiatan_renja');
    $this->db->where('sek.tahun', $param['tahun']);
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_kegiatan_renja');
  }

  public function setKegiatanTotalBelanja($data){
    if(count($data) <= 0) return;
    $this->db->update_batch('sync_e_kegiatan', $data, 'id_kegiatan_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Kegiatan Total Belanja Failed", "sync_e_kegiatan");
    return True;
  }

  public function backupSBankProgram($data, $idSync){
    if(empty($data)) return;
    $dataInsert = DataStructure::broadcast($data, [$idSync], ['id_sync']);
    $this->db->insert_batch('backup_s_bank_program', $dataInsert);
    ExceptionHandler::handleDBError($this->db->error(), "Backup Bank Program Failed", "backup_s_bank_program");
    return True;
  }

  public function backupSBankKegiatan($data, $idSync){
    if(empty($data)) return;
    $dataInsert = DataStructure::broadcast($data, [$idSync], ['id_sync']);
    $this->db->insert_batch('backup_s_bank_kegiatan', $dataInsert);
    ExceptionHandler::handleDBError($this->db->error(), "Backup Bank Kegiatan Failed", "backup_s_bank_kegiatan");
    return True;
  }

  public function backupSProgram($data, $idSync){
    if(empty($data)) return;
    $dataInsert = DataStructure::broadcast($data, [$idSync], ['id_sync']);
    $this->db->insert_batch('backup_s_program', $dataInsert);
    ExceptionHandler::handleDBError($this->db->error(), "Backup Program Failed", "backup_s_program");
    return True;
  }

  public function backupSKegiatan($data, $idSync){
    if(empty($data)) return;
    $dataInsert = DataStructure::broadcast($data, [$idSync], ['id_sync']);
    $this->db->insert_batch('backup_s_kegiatan', $dataInsert);
    ExceptionHandler::handleDBError($this->db->error(), "Backup Kegiatan Failed", "backup_s_kegiatan");
    return True;
  }

  public function getBackupSBankProgram($filter = []){
    $this->db->select('*');
    $this->db->from('backup_s_bank_program as bsbp');
    if(!empty($filter['id_sync'])) $this->db->where('id_sync', $filter['id_sync']);
    $res = $this->db->get();
    return $res->result_array();
  }

  public function getBackupSBankKegiatan($filter = []){
    $this->db->select('*');
    $this->db->from('backup_s_bank_kegiatan as bsbk');
    if(!empty($filter['id_sync'])) $this->db->where('id_sync', $filter['id_sync']);
    $res = $this->db->get();
    return $res->result_array();
  }

  public function getBackupSProgram($filter = []){
    $this->db->select('*');
    $this->db->from('backup_s_program as bsp');
    if(!empty($filter['id_sync'])) $this->db->where('id_sync', $filter['id_sync']);
    $res = $this->db->get();
    return $res->result_array();
  }
  
  public function getBackupSKegiatan($filter = []){
    $this->db->select('*');
    $this->db->from('backup_s_kegiatan as bsk');
    if(!empty($filter['id_sync'])) $this->db->where('id_sync', $filter['id_sync']);
    $res = $this->db->get();
    return $res->result_array();
  }

  public function getBankProgramDelete(){
    $this->db->select('id_s_bank_program_renja');
    $this->db->from('sync_e_bank_program');
    $this->db->where('id_s_bank_program_renja IS NOT NULL', NULL, FALSE);
    $idBankProgram = $this->db->get_compiled_select();

    $this->db->select('ssbp.id_bank_program_renja');
    $this->db->from("sync_s_bank_program as ssbp");
    $this->db->where("ssbp.id_bank_program_renja NOT IN ({$idBankProgram})", NULL, FALSE);
    
    $res = $this->db->get();
    return DataStructure::toOneDimension($res->result_array(), 'id_bank_program_renja');
  }
  
  public function getBankKegiatanDelete(){
    $this->db->select('id_s_bank_kegiatan_renja');
    $this->db->from('sync_e_bank_kegiatan');
    $this->db->where('id_s_bank_kegiatan_renja IS NOT NULL', NULL, FALSE);
    $idBankKegiatan = $this->db->get_compiled_select();

    $this->db->select('ssbp.id_bank_kegiatan_renja');
    $this->db->from("sync_s_bank_kegiatan as ssbp");
    $this->db->where("ssbp.id_bank_kegiatan_renja NOT IN ({$idBankKegiatan})", NULL, FALSE);
    
    $res = $this->db->get();
    return DataStructure::toOneDimension($res->result_array(), 'id_bank_kegiatan_renja');
  }
  
  public function getProgramDelete(){
    $this->db->select('id_s_program_renja');
    $this->db->from('sync_e_program');
    $this->db->where('id_s_program_renja IS NOT NULL', NULL, FALSE);
    $idProgram = $this->db->get_compiled_select();

    $this->db->select('ssbp.id_program_renja');
    $this->db->from("sync_s_program as ssbp");
    $this->db->where("ssbp.id_program_renja NOT IN ({$idProgram})", NULL, FALSE);

    $res = $this->db->get();
    return DataStructure::toOneDimension($res->result_array(), 'id_program_renja');
  }

  public function getKegiatanDelete(){
    $this->db->select('id_s_kegiatan_renja');
    $this->db->from('sync_e_kegiatan');
    $this->db->where('id_s_kegiatan_renja IS NOT NULL', NULL, FALSE);
    $idKegiatan = $this->db->get_compiled_select();

    $this->db->select('ssbp.id_kegiatan_renja');
    $this->db->from("sync_s_kegiatan as ssbp");
    $this->db->where("ssbp.id_kegiatan_renja NOT IN ({$idKegiatan})", NULL, FALSE);

    $res = $this->db->get();
    return DataStructure::toOneDimension($res->result_array(), 'id_kegiatan_renja');
  }

  public function getAvailableBankProgramIds(){
    $query = "
      SELECT
        SUBSTRING_INDEX(ssbp.id_bank_program_renja, '|', 2) AS id_bidang,
        COALESCE(MAX(CAST(SUBSTRING_INDEX(ssbp.id_bank_program_renja, '|', - 1) AS UNSIGNED)), 0) AS max_id
      FROM sync_s_bank_program AS ssbp
      GROUP BY SUBSTRING_INDEX(ssbp.id_bank_program_renja, '|', 2)
    ";
    $res = $this->db->query($query);
    return DataStructure::keyValue($res->result_array(), 'id_bidang', 'max_id');
  }

  private function __getBankProgramNew(){
    $this->db->select('sebp.id_bank_program_renja, sebp.id_urusan as Kd_Urusan, sebp.id_bidang as Kd_Bidang, sebp.nama_bank_program_renja as Ket_Program');
    $this->db->from('sync_e_bank_program as sebp');
    $this->db->where('sebp.id_s_bank_program_renja IS NULL', NULL, FALSE);
    $res = $this->db->get();
    return $res->result_array();
  }

  public function getBankProgramNew(){
    $bankProgram = $this->__getBankProgramNew();
    $latestIds = $this->getAvailableBankProgramIds();
    foreach($bankProgram as $k => $bp){
      $parent = $bp['Kd_Urusan'] . '|' . $bp['Kd_Bidang'];
      $newId = isset($latestIds[$parent]) ? $latestIds[$parent] + 1 : 1;
      $latestIds[$parent] = $newId;
      $bankProgram[$k]['Kd_Prog'] = $newId; 
      $bankProgram[$k]['id_s_bank_program_renja'] = $parent . '|' . $newId; 
    }
    return $bankProgram;
  }

  public function updateBankProgramSync($data){
    if(empty($data)) return;
    $this->db->update_batch('sync_e_bank_program', DataStructure::slice2D($data, ['id_bank_program_renja', 'id_s_bank_program_renja']), 'id_bank_program_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Update Bank Program Sync Gagal", "sync_e_bank_program");
  }

  private function __getProgramNew(){
    $this->db->select("
      sep.id_program_renja,
      sep.tahun AS Tahun,
      SUBSTRING_INDEX(seso.s_id_sub_opd, '|', 1) AS Kd_Urusan,
      SUBSTRING_INDEX(SUBSTRING_INDEX(seso.s_id_sub_opd, '|', 2), '|', -1) AS Kd_Bidang,
      SUBSTRING_INDEX(SUBSTRING_INDEX(seso.s_id_sub_opd, '|', 3), '|', -1) AS Kd_Unit,
      SUBSTRING_INDEX(SUBSTRING_INDEX(seso.s_id_sub_opd, '|', 4), '|', -1) AS Kd_Sub,
      SUBSTRING_INDEX(sebp.id_s_bank_program_renja, '|', -1) AS Kd_Prog,
      sep.nama_program_renja as Ket_Program,
      0 as ID_Prog,
      NULL as Tolak_Ukur,
      NULL as Target_Angka,
      NULL as Target_Uraian,
      1 as Kd_Urusan1,
      1 as Kd_Bidang1
    ", FALSE);
    $this->db->from('sync_e_program as sep');
    $this->db->join('sync_e_sub_opd as seso', 'seso.id_opd = sep.id_opd');
    $this->db->join('sync_e_bank_program as sebp', 'sebp.id_bank_program_renja = sep.id_bank_program_renja');
    $this->db->where('seso.s_id_sub_opd IS NOT NULL', NULL, FALSE);
    $this->db->where('sep.id_s_program_renja IS NULL', NULL, FALSE);
    $this->db->group_by('sep.tahun, sep.id_opd, sep.id_bank_program_renja');
    $res = $this->db->get();
    return $res->result_array();
  }

  public function getProgramNew(){
    $bankProgram = $this->__getProgramNew();
    foreach($bankProgram as $k => $bp){
      $bankProgram[$k]['id_s_program_renja'] = "{$bp['Kd_Urusan']}|{$bp['Kd_Bidang']}|{$bp['Kd_Unit']}|{$bp['Kd_Sub']}|{$bp['Kd_Prog']}|{$bp['Tahun']}";
    }
    return $bankProgram;
  }

  public function updateProgramSync($data){
    if(empty($data)) return;
    $this->db->update_batch('sync_e_program', DataStructure::slice2D($data, ['id_program_renja', 'id_s_program_renja']), 'id_program_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Update Bank Program Sync Gagal", "sync_e_program");
  }
  
  public function getAvailableBankKegiatanIds(){
    $query = "
      SELECT
        ssbp.id_bank_program_renja,
        COALESCE(MAX(CAST(SUBSTRING_INDEX(ssbp.id_bank_kegiatan_renja, '|', - 1) AS UNSIGNED)), 0) AS max_id
      FROM sync_s_bank_kegiatan AS ssbp
      GROUP BY ssbp.id_bank_program_renja
    ";
    $res = $this->db->query($query);
    return DataStructure::keyValue($res->result_array(), 'id_bank_program_renja', 'max_id');
  }

  private function __getBankKegiatanNew(){
    $this->db->select("sebk.id_bank_kegiatan_renja, sebp.id_urusan as Kd_Urusan, sebp.id_bidang as Kd_Bidang, SUBSTRING_INDEX(sebp.id_s_bank_program_renja, '|', -1) as Kd_Prog, sebk.nama_bank_kegiatan_renja as Ket_Kegiatan");
    $this->db->from('sync_e_bank_kegiatan as sebk');
    $this->db->join('sync_e_bank_program as sebp', 'sebp.id_bank_program_renja = sebk.id_bank_program_renja');
    $this->db->where('sebk.id_s_bank_kegiatan_renja IS NULL', NULL, FALSE);
    $res = $this->db->get();
    return $res->result_array();
  }

  public function getBankKegiatanNew(){
    $bankKegiatan = $this->__getBankKegiatanNew();
    $latestIds = $this->getAvailableBankKegiatanIds();
    foreach($bankKegiatan as $k => $bp){
      $parent = $bp['Kd_Urusan'] . '|' . $bp['Kd_Bidang'] . '|' . $bp['Kd_Prog'];
      $newId = isset($latestIds[$parent]) ? $latestIds[$parent] + 1 : 1;
      $latestIds[$parent] = $newId;
      $bankKegiatan[$k]['Kd_Keg'] = $newId; 
      $bankKegiatan[$k]['id_s_bank_kegiatan_renja'] = $parent . '|' . $newId; 
    }

    return $bankKegiatan;
  }

  public function updateBankKegiatanSync($data){
    if(empty($data)) return;
    $this->db->update_batch('sync_e_bank_kegiatan', DataStructure::slice2D($data, ['id_bank_kegiatan_renja', 'id_s_bank_kegiatan_renja']), 'id_bank_kegiatan_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Update Bank Kegiatan Sync Gagal", "sync_e_bank_kegiatan");
  }

  private function __getKegiatanNew(){
    $this->db->select("
      sek.id_kegiatan_renja,
      sek.tahun AS Tahun,
      SUBSTRING_INDEX(seso.s_id_sub_opd, '|', 1) AS Kd_Urusan,
      SUBSTRING_INDEX(SUBSTRING_INDEX(seso.s_id_sub_opd, '|', 2), '|', -1) AS Kd_Bidang,
      SUBSTRING_INDEX(SUBSTRING_INDEX(seso.s_id_sub_opd, '|', 3), '|', -1) AS Kd_Unit,
      SUBSTRING_INDEX(SUBSTRING_INDEX(seso.s_id_sub_opd, '|', 4), '|', -1) AS Kd_Sub,
      SUBSTRING_INDEX(SUBSTRING_INDEX(sebp.id_s_bank_kegiatan_renja, '|', -2), '|', 1) AS Kd_Prog,
      SUBSTRING_INDEX(sebp.id_s_bank_kegiatan_renja, '|', -1) AS Kd_Keg,
      sek.nama_kegiatan_renja as Ket_Kegiatan,
      0 as ID_Prog,
      NULL as Lokasi,
      NULL as Kelompok_Sasaran,
      1 as Status_Kegiatan,
      NULL as Pagu_Anggaran,
      NULL as Waktu_Pelaksanaan,
      NULL as Kd_Sumber,
    ", FALSE);
    $this->db->from('sync_e_kegiatan as sek');
    $this->db->join('sync_e_program as sep', 'sep.id_program_renja = sek.id_program_renja');
    $this->db->join('sync_e_sub_opd as seso', 'seso.id_opd = sek.id_opd');
    $this->db->join('sync_e_bank_kegiatan as sebp', 'sebp.id_bank_kegiatan_renja = sek.id_bank_kegiatan_renja');
    $this->db->where('seso.s_id_sub_opd IS NOT NULL', NULL, FALSE);
    $this->db->where('sek.id_s_kegiatan_renja IS NULL', NULL, FALSE);
    $this->db->where('sebp.id_s_bank_kegiatan_renja IS NOT NULL', NULL, FALSE);
    $this->db->group_by('sek.tahun, sek.id_opd, sek.id_bank_kegiatan_renja');
    $res = $this->db->get();
    return $res->result_array();
  }

  public function getKegiatanNew(){
    $bankKegiatan = $this->__getKegiatanNew();
    foreach($bankKegiatan as $k => $bp){
      $bankKegiatan[$k]['id_s_kegiatan_renja'] = "{$bp['Kd_Urusan']}|{$bp['Kd_Bidang']}|{$bp['Kd_Unit']}|{$bp['Kd_Sub']}|{$bp['Kd_Prog']}|{$bp['Tahun']}|{$bp['Kd_Keg']}";
    }
    return $bankKegiatan;
  }

  public function updateKegiatanSync($data){
    if(empty($data)) return;
    $this->db->update_batch('sync_e_kegiatan', DataStructure::slice2D($data, ['id_kegiatan_renja', 'id_s_kegiatan_renja']), 'id_kegiatan_renja');
    ExceptionHandler::handleDBError($this->db->error(), "Update Bank Kegiatan Sync Gagal", "sync_e_kegiatan");
  }

  private function __createBelanjaPerKegiatan(){
    $this->db->query("DROP TABLE IF EXISTS belanja_level_4");
    $this->db->query("
      CREATE TEMPORARY TABLE IF NOT EXISTS belanja_level_4 AS (
      SELECT 
        @rek_1 := SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 8), '|', -1) AS rek_1,
        @rek_2 := SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 9), '|', -1) AS rek_2, 
        @rek_3 := SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 10), '|', -1) AS rek_3,
        @tahun := SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 6), '|', -1) AS tahun,
        @id_kegiatan_renja := SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7) AS id_kegiatan_renja,
        SUM(ssbrs.total_rp) AS total_rp
      FROM 
        sync_s_belanja_rinc_sub AS ssbrs 
      GROUP BY 
        @rek_1, @rek_2, @rek_3, tahun, id_kegiatan_renja
      );
    ");
    ExceptionHandler::handleDBError($this->db->error(), "Create Belanja Per Kegiatan", "belanja_level_4");
    return "belanja_level_4";
  }

  public function getStrukturAnggaran($filter = []){
    $tahun = !empty($filter['tahun']) ? " AND tahun = {$filter['tahun']}" : "";
    $idOPD = !empty($filter['id_opd']) ? " AND SUBSTRING_INDEX(id_kegiatan_renja, '|', 3) = '{$filter['id_opd']}'" : "";
    $idSubOPD = !empty($filter['id_sub_opd']) ? " AND SUBSTRING_INDEX(id_kegiatan_renja, '|', 4) = '{$filter['id_sub_opd']}'" : "";
    $idProgramRenja = !empty($filter['id_program_renja']) ? " AND SUBSTRING_INDEX(id_kegiatan_renja, '|', 6) = '{$filter['id_program_renja']}'" : "";
    $idKegiatanRenja = !empty($filter['id_kegiatan_renja']) ? " AND id_kegiatan_renja = '{$filter['id_kegiatan_renja']}'" : "";
    $this->__createBelanjaPerKegiatan();
    $res = $this->db->query("
      SELECT
        SUM(total_rp) AS belanja, 
        SUM(IF(rek_2 = 1, total_rp, 0)) AS btl, 
        SUM(IF(rek_2 = 2, total_rp, 0)) AS bl,
        SUM(IF(rek_2 = 1 AND rek_3 = 1, total_rp, 0)) AS btl_pegawai,
        SUM(IF(rek_2 = 1 AND rek_3 != 1, total_rp, 0)) AS btl_non_pegawai,
        SUM(IF(rek_2 = 2 AND rek_3 = 1, total_rp, 0)) AS bl_pegawai,
        SUM(IF(rek_2 = 2 AND rek_3 != 1, total_rp, 0)) AS bl_non_pegawai,
        SUM(IF(rek_2 = 2 AND rek_3 = 2, total_rp, 0)) AS barang_jasa,
        SUM(IF(rek_2 = 2 AND rek_3 IN(3,4), total_rp, 0)) AS modal
      FROM
        belanja_level_4
      WHERE rek_1 = 5{$tahun}{$idOPD}{$idSubOPD}{$idProgramRenja}{$idKegiatanRenja}
    ");
    $belanja = $res->result_array();
    if(empty($belanja)) {
      ExceptionHandler::handleDBError($this->db->error(), "Data Belanja tidak ditemukan", "belanja_level_4");
    }
    
    return $belanja[0];
  }

  public function makeIndikatorRKA($data){
    $this->db->empty_table('sync_e_indikator');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Indikator RKA Failed", "sync_e_indikator");
    
    if(empty($data)) return;
    $dataInsert = [];
    foreach($data as $idkr => $indikator){
      if(!empty($indikator['nama_indikator_kegiatan_renja'])) $dataInsert[] = ['id_kegiatan_renja' => $indikator['id_kegiatan_renja'], 'kd_indikator' => 3, 'no_urut' => 2, 'tolak_ukur' => $indikator['nama_indikator_kegiatan_renja'], 'target_angka' => $indikator['target_ikr'], 'target_uraian' => $indikator['satuan_ikr']];
      if(!empty($indikator['nama_indikator_program_renja'])) $dataInsert[] = ['id_kegiatan_renja' => $indikator['id_kegiatan_renja'], 'kd_indikator' => 4, 'no_urut' => 4, 'tolak_ukur' => $indikator['nama_indikator_program_renja'], 'target_angka' => $indikator['target_ipr'], 'target_uraian' => $indikator['satuan_ipr']];
      if(!empty($indikator['nama_indikator_sasaran_renstra'])) $dataInsert[] = ['id_kegiatan_renja' => $indikator['id_kegiatan_renja'], 'kd_indikator' => 5, 'no_urut' => 5, 'tolak_ukur' => $indikator['nama_indikator_sasaran_renstra'], 'target_angka' => $indikator['target_isre'], 'target_uraian' => $indikator['satuan_isre']];
      if(!empty($indikator['nama_indikator_sasaran_rpjmd'])) $dataInsert[] = ['id_kegiatan_renja' => $indikator['id_kegiatan_renja'], 'kd_indikator' => 6, 'no_urut' => 6, 'tolak_ukur' => $indikator['nama_indikator_sasaran_rpjmd'], 'target_angka' => $indikator['target_isr'], 'target_uraian' => $indikator['satuan_isr']];
    }

    $this->db->insert_batch('sync_e_indikator', $dataInsert);
    ExceptionHandler::handleDBError($this->db->error(), "Making Indikator RKA Failed", "sync_e_indikator");
    return True;
  }

  public function getIndikatorRKA(){
    $this->db->select("
      SUBSTRING_INDEX(SUBSTRING_INDEX(sek.id_s_kegiatan_renja, '|', 1), '|', -1) as Kd_Urusan,
      SUBSTRING_INDEX(SUBSTRING_INDEX(sek.id_s_kegiatan_renja, '|', 2), '|', -1) as Kd_Bidang,
      SUBSTRING_INDEX(SUBSTRING_INDEX(sek.id_s_kegiatan_renja, '|', 3), '|', -1) as Kd_Unit,
      SUBSTRING_INDEX(SUBSTRING_INDEX(sek.id_s_kegiatan_renja, '|', 4), '|', -1) as Kd_Sub,
      SUBSTRING_INDEX(SUBSTRING_INDEX(sek.id_s_kegiatan_renja, '|', 5), '|', -1) as Kd_Prog,
      SUBSTRING_INDEX(SUBSTRING_INDEX(sek.id_s_kegiatan_renja, '|', 6), '|', -1) as Tahun,
      SUBSTRING_INDEX(SUBSTRING_INDEX(sek.id_s_kegiatan_renja, '|', 7), '|', -1) as Kd_Keg,
      0 as ID_Prog,
      sei.kd_indikator as Kd_Indikator,
      sei.no_urut as No_ID,
      sei.tolak_ukur as Tolak_Ukur,
      sei.target_angka as Target_Angka,
      sei.target_uraian as Target_Uraian
    ");
    $this->db->from("sync_e_indikator as sei");
    $this->db->join("sync_e_kegiatan as sek", "sek.id_kegiatan_renja = sei.id_kegiatan_renja");
    $this->db->where("sek.id_s_kegiatan_renja IS NOT NULL", NULL, FALSE);
    $res = $this->db->get();
    return $res->result_array();
  }

  public function countProgram($filter){
    $this->db->select("COUNT(*) as jumlah");
    $this->db->from("sync_s_program as ssp");
    if(!empty($filter['tahun'])) $this->db->where("ssp.tahun", $filter['tahun']);
    if(!empty($filter['id_opd'])) $this->db->where("SUBSTRING_INDEX(ssp.id_program_renja, '|', 3) =", $filter['id_opd']);
    if(!empty($filter['id_sub_opd'])) $this->db->where("SUBSTRING_INDEX(ssp.id_program_renja, '|', 4) =", $filter['id_sub_opd']);
    if(!empty($filter['id_program_renja'])) $this->db->where("ssp.id_program_renja =", $filter['id_program_renja']);
    $res = $this->db->get();
    return $res->result_array()[0]['jumlah'];
  }

  public function countKegiatan($filter){
    $this->db->select("COUNT(*) as jumlah");
    $this->db->from("sync_s_kegiatan as ssk");
    if(!empty($filter['tahun'])) $this->db->where("ssk.tahun", $filter['tahun']);
    if(!empty($filter['id_opd'])) $this->db->where("SUBSTRING_INDEX(ssk.id_kegiatan_renja, '|', 3) =", $filter['id_opd']);
    if(!empty($filter['id_sub_opd'])) $this->db->where("SUBSTRING_INDEX(ssk.id_kegiatan_renja, '|', 4) =", $filter['id_sub_opd']);
    if(!empty($filter['id_program_renja'])) $this->db->where("SUBSTRING_INDEX(ssk.id_kegiatan_renja, '|', 6) =", $filter['id_program_renja']);
    $res = $this->db->get();
    return $res->result_array()[0]['jumlah'];
  }

  public function getSRealisasi($filter = []){
    $this->db->select("CONCAT_WS('|', kr.id_kegiatan_renja, kr.bulan) as array_key, kr.id_kegiatan_realisasi");
    $this->db->from('kegiatan_realisasi as kr');
    if(!empty($filter['tahun'])) $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(kr.id_kegiatan_renja, '|', 6), '|', -1) =", $filter['tahun']);
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'array_key');
  }
  
  public function insertSFisik($filter, $data){
    if(empty($data)) return;

    $existing = $this->getSRealisasi($filter);

    $dataInsert = DataStructure::getNewAndUpdates(DataStructure::slice2D($data, ['id_kegiatan_renja', 'bulan', 'realisasi_fisik']), $existing);
    if(count($dataInsert['new']) > 0) $this->db->insert_batch('kegiatan_realisasi', $dataInsert['new']);
    if(count($dataInsert['updates']) > 0) {
      $update = [];
      foreach($dataInsert['updates'] as $k => $u){
        $update[] = ['id_kegiatan_realisasi' => $existing[$k]['id_kegiatan_realisasi'], 'id_kegiatan_renja' => $u['id_kegiatan_renja'], 'bulan' => $u['bulan'], 'realisasi_fisik' => $u['realisasi_fisik']];
      }
      $this->db->update_batch('kegiatan_realisasi', $update, 'id_kegiatan_realisasi');
    }

    ExceptionHandler::handleDBError($this->db->error(), "Backup Sync Simda Fisik", "kegiatan_realisasi");
    return True;
  }

  public function insertSRealisasiKeuangan($filter, $data){
    if(count($data) == 0) return;

    $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(id_kegiatan_renja, '|', 6), '|', -1) =", $filter['tahun'])->delete('sync_s_realisasi_keuangan');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Simda Realisasi Keuangan Failed", "sync_s_realisasi_keuangan");

    if(empty($data)) return;
    $this->db->insert_batch('sync_s_realisasi_keuangan', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Inserting Simda Realisasi Keuangan Failed", "sync_s_realisasi_keuangan");
    return True;
  }

  public function getRealisasiKeuangan($filter = []){
    $this->db->select("SUM(ssrk.nilai) as realisasi_keuangan");
    $this->db->from("sync_s_realisasi_keuangan as ssrk");
    $this->db->join("sync_e_opd as seo", "SUBSTRING_INDEX(ssrk.`id_kegiatan_renja`, '|', 3) = seo.`s_id_opd`", "LEFT");
    if(!empty($filter['id_opd'])) $this->db->where("seo.id_opd =", $filter['id_opd']);
    if(!empty($filter['tahun'])) $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(ssrk.`id_kegiatan_renja`, '|', 6), '|', -1) =", $filter['tahun']);

    $res = $this->db->get();
    $keuangan = $res->result_array();
    if(empty($keuangan)) {
      ExceptionHandler::handleDBError($this->db->error(), "Data Realisasi Keuangan ditemukan", "sync_s_realisasi_keuangan");
    }
    
    return $keuangan[0];
  }

  public function getAllRealisasiAll($filter = []){
    $this->db->select("
      COALESCE(ssf.realisasi_fisik, 0) AS realisasi_fisik,
      COALESCE(ssrk.realisasi_keuangan, 0) AS realisasi_keuangan,
      COALESCE(ssbrs.anggaran, 0) AS anggaran,
      (@capaian_keuangan := COALESCE(ROUND((ssrk.realisasi_keuangan / ssbrs.anggaran) * 100, 2), 0)) AS capaian_keuangan,
      COALESCE(ROUND((@capaian_keuangan + ssf.realisasi_fisik) / 2, 2), 0) AS kpi
    ");
    
    // $fisikSoFar = "SELECT 
    //     ROUND(AVG(ssf.fisik), 2) as realisasi_fisik
    //   FROM 
    //     (SELECT ssf.`id_kegiatan_renja`, MAX(ssf.`realisasi_fisik`) as fisik 
    //       FROM v_kegiatan_fisik AS ssf 
    //       GROUP BY ssf.id_kegiatan_renja
    //     ) as ssf 
    //   WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}";
    $fisikSoFar = "SELECT ROUND(realisasi_fisik, 2) as realisasi_fisik FROM t_fisik WHERE tahun = {$filter['tahun']}";
    $this->db->from("({$fisikSoFar}) as ssf");

    $keuanganPerKegiatan = "SELECT 
        SUM(ssrk.nilai) as realisasi_keuangan
      FROM
        (SELECT ssrk.id_kegiatan_renja, SUM(ssrk.nilai) as nilai 
          FROM sync_s_realisasi_keuangan as ssrk 
          GROUP BY ssrk.id_kegiatan_renja
        ) as ssrk
      WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}";

    $this->db->join("({$keuanganPerKegiatan}) as ssrk", "1 = 1", "RIGHT");
    
    $anggaranPerKegiatan = "SELECT
        SUM(ssbrs.anggaran) as anggaran
      FROM
        (SELECT SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7) AS id_kegiatan_renja, SUM(total_rp) AS anggaran 
          FROM sync_s_belanja_rinc_sub AS ssbrs 
          GROUP BY SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7)
        ) as ssbrs
      WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}";
    $this->db->join("({$anggaranPerKegiatan}) as ssbrs", "1 = 1", "LEFT");

    $res = $this->db->get();
    
    $fisik = $res->result_array();
    if(empty($fisik)) {
      ExceptionHandler::handleDBError($this->db->error(), "Data Realisasi Keuangan ditemukan", "sync_s_realisasi_keuangan");
    }
    
    return $fisik;
  }

  public function getRealisasiAll($filter = []){
    $row = $this->getAllRealisasiAll($filter);
    if (empty($row)){
			throw new UserException("Realisasi All yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[0];
  }

  public function getAllRealisasiOPD($filter = []){
    $this->db->select("
      sso.id_opd,
      sso.nama_opd,
      COALESCE(ssf.realisasi_fisik, 0) AS realisasi_fisik,
      COALESCE(ssrk.realisasi_keuangan, 0) AS realisasi_keuangan,
      COALESCE(ssbrs.anggaran, 0) AS anggaran,
      (@capaian_keuangan := COALESCE(ROUND((ssrk.realisasi_keuangan / ssbrs.anggaran) * 100, 2), 0)) AS capaian_keuangan,
      COALESCE(ROUND((@capaian_keuangan + ssf.realisasi_fisik) / 2, 2), 0) AS kpi
    ");
    $this->db->from("v_sync_s_opd as sso");
    
    // $fisikSoFar = "SELECT 
    //     SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 3) as id_opd, 
    //     ROUND(AVG(ssf.fisik), 2) as realisasi_fisik
    //   FROM 
    //     (SELECT ssf.`id_kegiatan_renja`, MAX(ssf.`realisasi_fisik`) as fisik 
    //       FROM v_kegiatan_fisik AS ssf 
    //       GROUP BY ssf.id_kegiatan_renja
    //     ) as ssf 
    //   WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']} 
    //   GROUP BY SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 3)";
    $fisikSoFar = "SELECT id_opd, ROUND(realisasi_fisik, 2) as realisasi_fisik FROM t_fisik_opd WHERE tahun = {$filter['tahun']}";

    $this->db->join("({$fisikSoFar}) as ssf", "ssf.id_opd = sso.id_opd", "LEFT");

    $keuanganPerKegiatan = "SELECT 
        SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 3) as id_opd,
        SUM(ssrk.nilai) as realisasi_keuangan
      FROM
        (SELECT ssrk.id_kegiatan_renja, SUM(ssrk.nilai) as nilai 
          FROM sync_s_realisasi_keuangan as ssrk 
          GROUP BY ssrk.id_kegiatan_renja
        ) as ssrk
      WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}
      GROUP BY SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 3)";

    $this->db->join("({$keuanganPerKegiatan}) as ssrk", "ssrk.id_opd = sso.id_opd", "LEFT");
    
    $anggaranPerKegiatan = "SELECT
        SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 3) as id_opd,
        SUM(ssbrs.anggaran) as anggaran
      FROM
        (SELECT SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7) AS id_kegiatan_renja, SUM(total_rp) AS anggaran 
          FROM sync_s_belanja_rinc_sub AS ssbrs 
          GROUP BY SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7)
        ) as ssbrs
      WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}
      GROUP BY SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 3)";
    $this->db->join("({$anggaranPerKegiatan}) as ssbrs", "ssbrs.id_opd = sso.id_opd", "LEFT");

    if(!empty($filter['id_opd'])) $this->db->where('sso.id_opd', $filter['id_opd']);
    $res = $this->db->get();
    
    $fisik = $res->result_array();
    if(empty($fisik)) {
      ExceptionHandler::handleDBError($this->db->error(), "Data Realisasi Keuangan ditemukan", "sync_s_realisasi_keuangan");
    }
    
    return $fisik;
  }

  public function getRealisasiOPD($filter = []){
    $row = $this->getAllRealisasiOPD($filter);
    if (empty($row)){
			throw new UserException("Realisasi OPD yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[0];
  }
  
  public function getAllRealisasiSubOPD($filter = []){
    $this->db->select("
      sso.id_sub_opd,
      sso.nama_sub_opd,
      COALESCE(ssf.realisasi_fisik, 0) AS realisasi_fisik,
      COALESCE(ssrk.realisasi_keuangan, 0) AS realisasi_keuangan,
      COALESCE(ssbrs.anggaran, 0) AS anggaran,
      (@capaian_keuangan := COALESCE(ROUND((ssrk.realisasi_keuangan / ssbrs.anggaran) * 100, 2), 0)) AS capaian_keuangan,
      COALESCE(ROUND((@capaian_keuangan + ssf.realisasi_fisik) / 2, 2), 0) AS kpi
    ");
    $this->db->from("sync_s_sub_opd as sso");
    // $fisikSoFar = "SELECT 
    //     SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 4) as id_sub_opd, 
    //     ROUND(AVG(ssf.fisik), 2) as realisasi_fisik
    //   FROM 
    //     (SELECT ssf.`id_kegiatan_renja`, MAX(ssf.`realisasi_fisik`) as fisik 
    //       FROM v_kegiatan_fisik AS ssf 
    //       GROUP BY ssf.id_kegiatan_renja
    //     ) as ssf 
    //   WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']} 
    //   GROUP BY SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 4)";
    $fisikSoFar = "SELECT id_sub_opd, ROUND(realisasi_fisik, 2) as realisasi_fisik FROM t_fisik_sub_opd WHERE tahun = {$filter['tahun']}";

    $this->db->join("({$fisikSoFar}) as ssf", "ssf.id_sub_opd = sso.id_sub_opd", "LEFT");

    $keuanganPerKegiatan = "SELECT 
        SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 4) as id_sub_opd,
        SUM(ssrk.nilai) as realisasi_keuangan
      FROM
        (SELECT ssrk.id_kegiatan_renja, SUM(ssrk.nilai) as nilai 
          FROM sync_s_realisasi_keuangan as ssrk 
          GROUP BY ssrk.id_kegiatan_renja
        ) as ssrk
      WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}
      GROUP BY SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 4)";

    $this->db->join("({$keuanganPerKegiatan}) as ssrk", "ssrk.id_sub_opd = sso.id_sub_opd", "LEFT");
    
    $anggaranPerKegiatan = "SELECT
        SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 4) as id_sub_opd,
        SUM(ssbrs.anggaran) as anggaran
      FROM
        (SELECT SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7) AS id_kegiatan_renja, SUM(total_rp) AS anggaran 
          FROM sync_s_belanja_rinc_sub AS ssbrs 
          GROUP BY SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7)
        ) as ssbrs
      WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}
      GROUP BY SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 4)";
    $this->db->join("({$anggaranPerKegiatan}) as ssbrs", "ssbrs.id_sub_opd = sso.id_sub_opd", "LEFT");

    if(!empty($filter['id_opd'])) $this->db->where("SUBSTRING_INDEX(sso.id_sub_opd, '|', 3) =", $filter['id_opd']);
    if(!empty($filter['id_sub_opd'])) $this->db->where('sso.id_sub_opd', $filter['id_sub_opd']);
    $res = $this->db->get();
    
    return $res->result_array();
  }

  public function getRealisasiSubOPD($filter = []){
    $row = $this->getAllRealisasiSubOPD($filter);
    if (empty($row)){
			throw new UserException("Realisasi Sub OPD yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[0];
  }

  public function getAllRealisasiProgram($filter = []){
    $this->db->select("
      ssp.id_program_renja,
      ssp.nama_program_renja,
      COALESCE(ssf.realisasi_fisik, 0) AS realisasi_fisik,
      COALESCE(ssrk.realisasi_keuangan, 0) AS realisasi_keuangan,
      COALESCE(ssbrs.anggaran, 0) AS anggaran,
      (@capaian_keuangan := COALESCE(ROUND((ssrk.realisasi_keuangan / ssbrs.anggaran) * 100, 2), 0)) AS capaian_keuangan,
      COALESCE(ROUND((@capaian_keuangan + ssf.realisasi_fisik) / 2, 2), 0) AS kpi
    ");
    $this->db->from("sync_s_program as ssp");
    
    $ssfTahun = !empty($filter['tahun']) ? "WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}" : '';
    $fisikSoFar = "SELECT 
        SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 6) as id_program_renja, 
        ROUND(AVG(ssf.fisik), 2) as realisasi_fisik
      FROM 
        (SELECT ssf.`id_kegiatan_renja`, MAX(ssf.`realisasi_fisik`) as fisik 
          FROM v_kegiatan_fisik AS ssf 
          GROUP BY ssf.id_kegiatan_renja
        ) as ssf 
      {$ssfTahun} 
      GROUP BY SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 6)";

    $this->db->join("({$fisikSoFar}) as ssf", "ssf.id_program_renja = ssp.id_program_renja", "LEFT");

    $ssrkTahun = !empty($filter['tahun']) ? "WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}" : '';
    $keuanganPerKegiatan = "SELECT 
        SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 6) as id_program_renja,
        SUM(ssrk.nilai) as realisasi_keuangan
      FROM
        (SELECT ssrk.id_kegiatan_renja, SUM(ssrk.nilai) as nilai 
          FROM sync_s_realisasi_keuangan as ssrk 
          GROUP BY ssrk.id_kegiatan_renja
        ) as ssrk
      {$ssrkTahun}
      GROUP BY SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 6)";

    $this->db->join("({$keuanganPerKegiatan}) as ssrk", "ssrk.id_program_renja = ssp.id_program_renja", "LEFT");
    
    $ssbrsTahun = !empty($filter['tahun']) ? "WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}" : '';
    $anggaranPerKegiatan = "SELECT
        SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 6) as id_program_renja,
        SUM(ssbrs.anggaran) as anggaran
      FROM
        (SELECT SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7) AS id_kegiatan_renja, SUM(total_rp) AS anggaran 
          FROM sync_s_belanja_rinc_sub AS ssbrs 
          GROUP BY SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7)
        ) as ssbrs
      {$ssbrsTahun} 
      GROUP BY SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 6)";
    $this->db->join("({$anggaranPerKegiatan}) as ssbrs", "ssbrs.id_program_renja = ssp.id_program_renja", "LEFT");

    if(!empty($filter['tahun'])) $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(ssp.id_program_renja, '|', 6), '|', -1) =", $filter['tahun']);
    if(!empty($filter['id_sub_opd'])) $this->db->where("SUBSTRING_INDEX(ssp.id_program_renja, '|', 4) =", $filter['id_sub_opd']);
    if(!empty($filter['id_program_renja'])) $this->db->where('ssp.id_program_renja', $filter['id_program_renja']);
    $res = $this->db->get();
    
    $fisik = $res->result_array();
    if(empty($fisik)) {
      ExceptionHandler::handleDBError($this->db->error(), "Data Realisasi Keuangan ditemukan", "sync_s_realisasi_keuangan");
    }
    
    return $fisik;
  }

  public function getRealisasiProgram($filter = []){
    $row = $this->getAllRealisasiProgram($filter);
    if (empty($row)){
			throw new UserException("Realisasi Program yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[0];
  }
  
  private function __getAllRealisasiKegiatan($filter = []){
    $this->db->select("
      ssk.id_kegiatan_renja,
      ssk.nama_kegiatan_renja,
      COALESCE(ssf.realisasi_fisik, 0) AS realisasi_fisik,
      COALESCE(ssrk.realisasi_keuangan, 0) AS realisasi_keuangan,
      COALESCE(ssbrs.anggaran, 0) AS anggaran,
      (@capaian_keuangan := COALESCE(ROUND((ssrk.realisasi_keuangan / ssbrs.anggaran) * 100, 2), 0)) AS capaian_keuangan,
      COALESCE(ROUND((@capaian_keuangan + ssf.realisasi_fisik) / 2, 2), 0) AS kpi
    ");
    $this->db->from("sync_s_kegiatan as ssk");
    
    $queryFilter = !empty($filter['tahun']) ? "WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssf.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']} " : "";
    $fisikSoFar = "SELECT 
        ssf.id_kegiatan_renja, 
        ROUND(AVG(ssf.fisik), 2) as realisasi_fisik
      FROM 
        (SELECT ssf.`id_kegiatan_renja`, MAX(ssf.`realisasi_fisik`) as fisik 
          FROM v_kegiatan_fisik AS ssf 
          GROUP BY ssf.id_kegiatan_renja
        ) as ssf 
      {$queryFilter} 
      GROUP BY ssf.id_kegiatan_renja";

    $this->db->join("({$fisikSoFar}) as ssf", "ssf.id_kegiatan_renja = ssk.id_kegiatan_renja", "LEFT");

    $queryFilter = !empty($filter['tahun']) ? "WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssrk.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}" : "";
    $keuanganPerKegiatan = "SELECT 
        ssrk.id_kegiatan_renja,
        SUM(ssrk.nilai) as realisasi_keuangan
      FROM
        (SELECT ssrk.id_kegiatan_renja, SUM(ssrk.nilai) as nilai 
          FROM sync_s_realisasi_keuangan as ssrk 
          GROUP BY ssrk.id_kegiatan_renja
        ) as ssrk
      {$queryFilter} 
      GROUP BY ssrk.id_kegiatan_renja";

    $this->db->join("({$keuanganPerKegiatan}) as ssrk", "ssrk.id_kegiatan_renja = ssk.id_kegiatan_renja", "LEFT");
    
    $queryFilter = !empty($filter['tahun']) ? "WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ssbrs.id_kegiatan_renja, '|', 6), '|', -1) = {$filter['tahun']}" : "";
    $anggaranPerKegiatan = "SELECT
        ssbrs.id_kegiatan_renja,
        SUM(ssbrs.anggaran) as anggaran
      FROM
        (SELECT SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7) AS id_kegiatan_renja, SUM(total_rp) AS anggaran 
          FROM sync_s_belanja_rinc_sub AS ssbrs 
          GROUP BY SUBSTRING_INDEX(ssbrs.`id_belanja_rinc_sub`, '|', 7)
        ) as ssbrs
      {$queryFilter} 
      GROUP BY ssbrs.id_kegiatan_renja";
    $this->db->join("({$anggaranPerKegiatan}) as ssbrs", "ssbrs.id_kegiatan_renja = ssk.id_kegiatan_renja", "LEFT");

    if(!empty($filter['tahun'])) $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(ssk.id_kegiatan_renja, '|', 6), '|', -1) =", $filter['tahun']);
    if(!empty($filter['id_opd'])) $this->db->where("SUBSTRING_INDEX(ssk.id_kegiatan_renja, '|', 3) =", $filter['id_opd']);
    if(!empty($filter['id_program_renja'])) $this->db->where("SUBSTRING_INDEX(ssk.id_kegiatan_renja, '|', 6) =", $filter['id_program_renja']);
    if(!empty($filter['id_kegiatan_renja'])) $this->db->where('ssk.id_kegiatan_renja', $filter['id_kegiatan_renja']);
    
    return $this->db->get_compiled_select();
  }
  
  public function createRealisasiKegiatanTemp($filter){
    $res = $this->__getAllRealisasiKegiatan($filter);
    $this->db->query("DROP TABLE IF EXISTS realisasi_kegiatan_temp");
    $this->db->query("
      CREATE TEMPORARY TABLE IF NOT EXISTS realisasi_kegiatan_temp AS ($res);
    ");
    ExceptionHandler::handleDBError($this->db->error(), "Create Realisasi Kegiatan", "realisasi_kegiatan_temp");
    return "realisasi_kegiatan_temp";
  }

  public function getAllRealisasiKegiatan($filter = []){
    $allRealisasiKegiatan = $this->__getAllRealisasiKegiatan($filter);
    $res = $this->db->query($allRealisasiKegiatan);
    
    $fisik = $res->result_array();
    if(empty($fisik)) {
      ExceptionHandler::handleDBError($this->db->error(), "Data Realisasi Keuangan ditemukan", "sync_s_realisasi_keuangan");
    }
    
    return $fisik;
  }

  public function getRealisasiKegiatan($filter = []){
    $row = $this->getAllRealisasiKegiatan($filter);
    if (empty($row)){
			throw new UserException("Realisasi Kegiatan yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[0];
  }


  public function countKegiatanUnderformed($filter = []){
    $allRealisasiKegiatan = $this->__getAllRealisasiKegiatan($filter);
    $this->db->select("COUNT(*) as jumlah");
    $this->db->from("({$allRealisasiKegiatan}) as ark");
    if(!empty($filter['kpi'])) $this->db->where("ark.kpi <=", $filter['kpi']);

    $res = $this->db->get();
    $arr = $res->result_array();
    return $arr[0]['jumlah'];
  }

  public function getOPD($filter = []){
    $this->db->select("*");
    $this->db->from("sync_s_opd");
    $this->db->where("id_opd", $filter['id_opd']);
    $res = $this->db->get();
    $row = $res->result_array();
    if (empty($row)){
			throw new UserException("OPD yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[0];
  }

  public function getAllSubOPD($filter = []){
    $this->db->select("*, SUBSTRING_INDEX(id_sub_opd, '|', 3) as id_opd");
    $this->db->from("sync_s_sub_opd");
    if(!empty($filter['id_opd'])) $this->db->where("SUBSTRING_INDEX(id_sub_opd, '|', 3)", $filter['id_opd']);
    if(!empty($filter['id_sub_opd'])) $this->db->where("id_sub_opd", $filter['id_sub_opd']);
    $res = $this->db->get();
    return DataStructure::keyValue($res->result_array(), 'id_sub_opd');
  }

  public function getSubOPD($filter = []){
    $row = $this->getAllSubOPD($filter);
    if (empty($row)){
			throw new UserException("Sub OPD yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[$filter['id_sub_opd']];
  }

  public function getProgramRenja($filter = []){
    $this->db->select("ssp.*, ssso.id_sub_opd, ssso.nama_sub_opd, sso.id_opd, sso.nama_opd");
    $this->db->from("sync_s_program as ssp");
    $this->db->from("sync_s_sub_opd as ssso", "ssso.id_sub_opd = SUBSTRING_INDEX(ssp.id_program_renja, '|', 4)");
    $this->db->from("sync_s_opd as sso", "sso.id_opd = SUBSTRING_INDEX(ssp.id_program_renja, '|', 3)");
    $this->db->where("ssp.id_program_renja", $filter['id_program_renja']);
    $res = $this->db->get();
    $row = $res->result_array();
    if (empty($row)){
			throw new UserException("Program Renja yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[0];
  }
  
  public function getKegiatanRenja($filter = []){
    $this->db->select("*");
    $this->db->from("sync_s_kegiatan");
    $this->db->where("id_kegiatan_renja", $filter['id_kegiatan_renja']);
    $res = $this->db->get();
    $row = $res->result_array();
    if (empty($row)){
			throw new UserException("Kegiatan Renja yang kamu cari tidak ditemukan", USER_NOT_FOUND_CODE);
    }
    return $row[0];
  }

  public function insertAllTimKegiatan($data){
    $this->db->where('id_role', 7);
    $this->db->delete('user');
    ExceptionHandler::handleDBError($this->db->error(), "Emptying Tim Kegiatan Failed", "user");
    
    if(empty($data)) return;
    $this->db->insert_batch('user', $data);
    ExceptionHandler::handleDBError($this->db->error(), "Adding Tim Kegiatan Failed", "user");
    return True;
  }

}