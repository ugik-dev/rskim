<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SyncModel extends CI_Model{

  public function __construct() {
    parent::__construct();
  }

  public function insertSync($data){
    $this->tryBackup($data['id_action']);
    $dataSync = DataStructure::slice($data, [
      'id_action', 'ket_sync'
    ]);
    $this->db->replace('sync', $dataSync);
    ExceptionHandler::handleDBError($this->db->error(), "Tambah Riwayat Sync Gagal", "Sync");
    return $this->db->insert_id();
  }

  public function getSyncs($action){
    $this->db->select('s.*');
    $this->db->from('sync as s');
    $this->db->where('s.id_action', $action);
    $this->db->order_by('s.sync_date', 'DESC');
    $res = $this->db->get();
    return $res->result_array();
  }

  public function getLatestSync($action){
    $row = $this->getSyncs($action);
    if (empty($row)){
			throw new UserException("Backup tidak ditemukan", 0);
    }
    return $row[0];
  }

  public function getLineChartKegiatanTarget($filter){
    // $filter['tahun']='2019';

    $this->db->select("bulan,avg(target_keuangan) as target_keuangan ,avg(target_fisik) as target_fisik",false);
    $this->db->from('kegiatan_target as a');
    $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(id_kegiatan_renja, '|', 6), '|', -1) =", $filter['tahun']);
    // $this->db->where("target_keuangan != 0");
    $this->db->group_by('bulan', 'DESC');
    $res = $this->db->get();
    $res = $res->result_array();
    return $res;
  }
  public function getLineChartRealisasiFisik($filter){
    // $filter['tahun']='2019';

    $this->db->select("bulan,avg(realisasi_fisik) as realisasi_fisik ",false);
    $this->db->from('kegiatan_realisasi as a');
    $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(id_kegiatan_renja, '|', 6), '|', -1) =", $filter['tahun']);
    // $this->db->where("realisasi_fisik != 0");
    $this->db->group_by('bulan', 'DESC');
    $res = $this->db->get();
    $res = $res->result_array();
    return $res;
  }
  public function getLineChartRealisasiKeuangan($filter){
    // $filter['tahun']='2019';

    $this->db->select('sum(anggaran) as anggaran');
    $this->db->from('v_anggaran_per_kegiatan');
    $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(id_kegiatan_renja, '|', 6), '|', -1) =", $filter['tahun']);
    $anggaran = $this->db->get();
    $anggaran = $anggaran->result_array();
    $hanggaran = $anggaran[0]['anggaran'];

    $this->db->select("a.*, sum(nilai), ( SELECT sum(nilai) from sync_s_realisasi_keuangan where SUBSTRING_INDEX(SUBSTRING_INDEX(id_kegiatan_renja, '|', 6), '|', -1) = ".$filter['tahun']." and bulan <= a.bulan ) as hasilsum",false);
    $this->db->from('sync_s_realisasi_keuangan as a');
    $this->db->where("SUBSTRING_INDEX(SUBSTRING_INDEX(a.id_kegiatan_renja, '|', 6), '|', -1) =", $filter['tahun']);
    $this->db->group_by('a.bulan', 'DESC');
    $res = $this->db->get();
    $res = $res->result_array();

    $i=0;
    foreach($res as $k){
        $res[$i]['persen_realisasi'] = ($res[$i]['hasilsum']/$hanggaran) * 100;
        $i++;
    };
  
    
    return $res;

  }

  public function getLatestSyncId($action){
    $row = $this->getLatestSync($action);
    return $row['id_sync'];
  }

  private function tryBackup($action){
    $row = $this->getSyncs($action);
    if(count($row) >= 5){
			throw new UserException("Backup sudah lebih 5x", 0);
    }
  }

  public function deleteBackup($id_sync){
    $this->db->where('id_sync', $id_sync);
    $this->db->delete('sync');
  }

  public function changeSyncState($id_sync, $state){
    $this->db->set('status', $state);
    $this->db->where('id_sync', $id_sync);
    $this->db->update('sync');
    ExceptionHandler::handleDBError($this->db->error(), "Update Riwayat Sync Gagal", "Sync");
    return True;
  }

  public function insertSyncImport($data){
    $this->db->insert('sync_import', DataStructure::slice($data, ['tahun', 'id_sync_import_jenis']));
    ExceptionHandler::handleDBError($this->db->error(), "Tambah Riwayat Sync Import Gagal", "Sync");
    return $this->db->insert_id();
  }

  public function getAllLatestSyncImport($filter = []){
    $query = "SELECT
      sij.`id_sync_import_jenis`,
      sij.`nama_sync_import_jenis`,
      (SELECT
        si.tanggal_sync_import
      FROM
        sync_import AS si
      WHERE si.id_sync_import_jenis = sij.`id_sync_import_jenis` AND si.tahun = {$filter['tahun']}
      ORDER BY si.tanggal_sync_import DESC
      LIMIT 1) AS tanggal_sync_import
    FROM
      sync_import_jenis AS sij
    ";
    $res = $this->db->query($query);
    return DataStructure::keyValue($res->result_array(), 'id_sync_import_jenis');
  }

  public function getLatestSyncImport($filter){
    $row = $this->getAllLatestSyncImport($filter);
    if (empty($row)){
			throw new UserException("Sync Import tidak ditemukan", 0);
    }
    return $row[$filter['id_sync_import_jenis']];
  }
}
