<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SyncSimdaModel extends CI_Model{
  var $conn;
  
  public function __construct() {
    parent::__construct();
    $CI =& get_instance();
    $CI->load->model(['DBConfigModel']);
    $simda = $CI->DBConfigModel->getDBConfig('simda');

    $connection_string = "odbc:DRIVER={{$simda['connector']}};SERVER={$simda['hostname']};DATABASE={$simda['database']}";
    // echo $connection_string;
    try{
      $this->conn = new PDO($connection_string, $simda['username'], $simda['password']);
    } catch(PDOException $e){
      throw new UserException($e->getMessage(), 0);
    }
  }

  public function __destruct(){
    if($this->conn){
      $this->conn->query('KILL CONNECTION_ID()');
      $this->conn = null;
    }
  }

  private function __disableForeignAndTrigger(){
    $query = '
        EXEC sp_MSforeachtable @command1="ALTER TABLE ? DISABLE TRIGGER ALL" 
        EXEC sp_MSforeachtable @command1="ALTER TABLE ? NOCHECK CONSTRAINT ALL" 
    ';
    $exec = $this->conn->query($query);
    if(!$exec) throw new UserException($this->conn->errorInfo()[2], 0);
  }
  
  private function __enableForeignAndTrigger(){
    $query = '
      EXEC sp_MSforeachtable @command1="ALTER TABLE ? CHECK CONSTRAINT ALL" 
      EXEC sp_MSforeachtable @command1="ALTER TABLE ? ENABLE TRIGGER ALL" 
    ';
    $exec = $this->conn->query($query);
    if(!$exec) throw new UserException($this->conn->errorInfo()[2], 0);
  }

  private function get($sql, $key = FALSE){
    $stmt = $this->conn->query($sql);
    if($stmt === false) {
      throw new UserException($this->conn->errorInfo()[2], 0);
    }
    if($key){
      $ret = [];
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ret[$row[$key]] = $row;
      }
      return $ret;
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getSUrusan($filter = array()){
    $sql = "SELECT Kd_Urusan as id_urusan, Nm_Urusan as nama_urusan FROM Ref_Urusan";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'id_urusan');
    return $arr;
  }
  
  public function getSBidang($filter = array()){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar)) as id_bidang, Nm_Bidang as nama_bidang, Kd_Fungsi as id_fungsi FROM Ref_Bidang";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'id_bidang');
    return $arr;
  }

  public function getSOPD($filter = array()){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar)) as id_opd, Nm_Unit as nama_opd FROM Ref_Unit";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'id_opd');
    return $arr;
  }
  
  public function getSSubOPD($filter = array()){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar)) as id_sub_opd, Nm_Sub_Unit as nama_sub_opd FROM Ref_Sub_Unit";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'id_sub_opd');
    return $arr;
  }

  public function getSBankProgram($filter = array()){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Prog as varchar)) as id_bank_program_renja, Kd_Urusan as id_urusan, Kd_Bidang as id_bidang, Ket_Program as nama_bank_program_renja FROM Ref_Program";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'id_bank_program_renja');
    return $arr;
  }
  
  public function getSBankKegiatan($filter = array()){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Kd_Keg as varchar)) as id_bank_kegiatan_renja, (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Prog as varchar)) as id_bank_program_renja, Ket_Kegiatan as nama_bank_kegiatan_renja  FROM Ref_Kegiatan";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'id_bank_kegiatan_renja');
    return $arr;
  }

  public function getSProgram($filter = array()){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar)) as id_program_renja, (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Prog as varchar)) as id_bank_program_renja, Tahun as tahun, Ket_Program as nama_program_renja FROM Ta_Program ";
    if(!empty($filter['tahun'])) $sql .= " WHERE Tahun = {$filter['tahun']}";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'id_program_renja');
    return $arr;
  }


  public function getSKegiatan($filter = array()){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar)) as id_kegiatan_renja, (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Kd_Keg as varchar)) as id_bank_kegiatan_renja, Tahun as tahun, Ket_Kegiatan as nama_kegiatan_renja FROM Ta_Kegiatan ";
    if(!empty($filter['tahun'])) $sql .= " WHERE Tahun = {$filter['tahun']}";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'id_kegiatan_renja');
    return $arr;
  }

  public function getSBankProgramFull($filter = array()){
    $sql = "SELECT * FROM Ref_Program";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }
  
  public function getSBankKegiatanFull($filter = array()){
    $sql = "SELECT *  FROM Ref_Kegiatan";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }

  public function getSProgramFull($filter = array()){
    $sql = "SELECT * FROM Ta_Program WHERE Kd_Sub = 1";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }

  public function getSKegiatanFull($filter = array()){
    $sql = "SELECT * FROM Ta_Kegiatan WHERE Kd_Sub = 1";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }

  public function insertSBankProgram($data = array(), $truncate = FALSE){
    try{
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();

      if($truncate){
        $deleteSQL = "DELETE rb FROM Ref_Program as rb";
  
        $delete = $this->conn->query($deleteSQL);
        if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
      }
        
      if(count($data) > 0){
        foreach(array_chunk($data, 1000) as $chunk){
          $insertData = [];
          foreach($chunk as $nu){
            $insertData[] = "('{$nu['Kd_Urusan']}', '{$nu['Kd_Bidang']}', '{$nu['Kd_Prog']}', '{$nu['Ket_Program']}')";
          }
          $insertSQL = "INSERT INTO Ref_Program (Kd_Urusan, Kd_Bidang, Kd_Prog, Ket_Program) VALUES ".implode(',', $insertData);
          $insert = $this->conn->query($insertSQL);
          if(!$insert) throw new UserException($this->conn->errorInfo()[2], 0);
        }
      }
      $this->conn->commit();
      $this->__enableForeignAndTrigger();
      return TRUE;
      
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }

  public function insertSBankKegiatan($data = array(), $truncate = FALSE){
    try{
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();

      if($truncate){
        $deleteSQL = "DELETE rb FROM Ref_Kegiatan as rb";

        $delete = $this->conn->query($deleteSQL);
        if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
      }

      if(count($data) > 0){
        foreach(array_chunk($data, 1000) as $chunk){
          $insertData = [];
          foreach($chunk as $nu){
            $kegiatan = trim(substr(preg_replace('~[\r\n\']+~', ' ', $nu['Ket_Kegiatan']), 0, 255));
            $insertData[] = "('{$nu['Kd_Urusan']}', '{$nu['Kd_Bidang']}', '{$nu['Kd_Prog']}', '{$nu['Kd_Keg']}', '{$kegiatan}')";
          }
          $insertSQL = "INSERT INTO Ref_Kegiatan (Kd_Urusan, Kd_Bidang, Kd_Prog, Kd_Keg, Ket_Kegiatan) VALUES ".implode(',', $insertData);
          $insert = $this->conn->query($insertSQL);
          if(!$insert) throw new UserException($this->conn->errorInfo()[2], 0);
        }
      }
      $this->conn->commit();
      $this->__enableForeignAndTrigger();
      return TRUE;
      
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }

  public function insertSProgram($data = array(), $truncate = FALSE){
    try{
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();

      if($truncate){
        $deleteSQL = "DELETE rb FROM Ta_Program as rb";

        $delete = $this->conn->query($deleteSQL);
        if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
      }

      if(count($data) > 0){
        foreach(array_chunk($data, 1000) as $chunk){
          $insertData = [];
          foreach($chunk as $nu){
            $program = trim(substr(preg_replace('~[\r\n]+~', ' ', $nu['Ket_Program']), 0, 255));
            $insertData[] = "('{$nu['Tahun']}', '{$nu['Kd_Urusan']}', '{$nu['Kd_Bidang']}', '{$nu['Kd_Unit']}', '{$nu['Kd_Sub']}', '{$nu['Kd_Prog']}', '{$nu['ID_Prog']}', '{$program}', '{$nu['Tolak_Ukur']}', '{$nu['Target_Angka']}', '{$nu['Target_Uraian']}', '{$nu['Kd_Urusan1']}', '{$nu['Kd_Bidang1']}')";
          }
          $insertSQL = "INSERT INTO Ta_Program (Tahun, Kd_Urusan, Kd_Bidang, Kd_Unit, Kd_Sub, Kd_Prog, ID_Prog, Ket_Program, Tolak_Ukur, Target_Angka, Target_Uraian, Kd_Urusan1, Kd_Bidang1) VALUES ".implode(',', $insertData);
          $insert = $this->conn->query($insertSQL);
          if(!$insert) throw new UserException($this->conn->errorInfo()[2], 0);
        }
      }
      $this->conn->commit();
      $this->__enableForeignAndTrigger();
      return TRUE;
      
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }

  public function insertSKegiatan($data = array(), $truncate = FALSE){
    try{
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();

      if($truncate){
        $deleteSQL = "DELETE rb FROM Ta_Kegiatan as rb";

        $delete = $this->conn->query($deleteSQL);
        if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
      }
        
      if(count($data) > 0){
        foreach(array_chunk($data, 1000) as $chunk){
          $insertData = [];
          foreach($chunk as $nu){
            $kegiatan = trim(substr(preg_replace('~[\r\n\']+~', ' ', $nu['Ket_Kegiatan']), 0, 255));
            $insertData[] = "('{$nu['Tahun']}', '{$nu['Kd_Urusan']}', '{$nu['Kd_Bidang']}', '{$nu['Kd_Unit']}', '{$nu['Kd_Sub']}', '{$nu['Kd_Prog']}', '{$nu['ID_Prog']}', '{$nu['Kd_Keg']}', '{$kegiatan}', '{$nu['Lokasi']}', '{$nu['Kelompok_Sasaran']}', '{$nu['Status_Kegiatan']}', '{$nu['Pagu_Anggaran']}', '{$nu['Waktu_Pelaksanaan']}', '{$nu['Kd_Sumber']}')";
          }
          $insertSQL = "INSERT INTO Ta_Kegiatan (Tahun, Kd_Urusan, Kd_Bidang, Kd_Unit, Kd_Sub, Kd_Prog, ID_Prog, Kd_Keg, Ket_Kegiatan, Lokasi, Kelompok_Sasaran, Status_Kegiatan, Pagu_Anggaran, Waktu_Pelaksanaan, Kd_Sumber) VALUES ".implode(',', $insertData);
          $insert = $this->conn->query($insertSQL);
          if(!$insert) throw new UserException($this->conn->errorInfo()[2], 0);
        }
      }
      $this->conn->commit();
      $this->__enableForeignAndTrigger();
      return TRUE;
      
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }

  public function getSBelanja($filter = array()){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar) + '|' + CAST(Kd_Rek_1 as varchar) + '|' + CAST(Kd_Rek_2 as varchar) + '|' + CAST(Kd_Rek_3 as varchar) + '|' + CAST(Kd_Rek_4 as varchar) + '|' + CAST(Kd_Rek_5 as varchar)) as id_belanja, (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar)) as id_kegiatan_renja, Kd_Sumber as id_sumber FROM Ta_Belanja WHERE Tahun = {$filter['tahun']}";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }

  
  public function getSBelanjaRinc($filter = array()){
    $sql = 
      "SELECT 
        (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar) + '|' + CAST(Kd_Rek_1 as varchar) + '|' + CAST(Kd_Rek_2 as varchar) + '|' + CAST(Kd_Rek_3 as varchar) + '|' + CAST(Kd_Rek_4 as varchar) + '|' + CAST(Kd_Rek_5 as varchar) + '|' + CAST(No_Rinc as varchar)) as id_belanja_rinc, 
        (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar) + '|' + CAST(Kd_Rek_1 as varchar) + '|' + CAST(Kd_Rek_2 as varchar) + '|' + CAST(Kd_Rek_3 as varchar) + '|' + CAST(Kd_Rek_4 as varchar) + '|' + CAST(Kd_Rek_5 as varchar)) as id_belanja, 
        Keterangan as nama_belanja_rinc 
      FROM 
        Ta_Belanja_Rinc WHERE Tahun = {$filter['tahun']}";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }

  public function getSBelanjaRincSub($filter = array()){
    $sql = 
      "SELECT 
        (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar) + '|' + CAST(Kd_Rek_1 as varchar) + '|' + CAST(Kd_Rek_2 as varchar) + '|' + CAST(Kd_Rek_3 as varchar) + '|' + CAST(Kd_Rek_4 as varchar) + '|' + CAST(Kd_Rek_5 as varchar) + '|' + CAST(No_Rinc as varchar) + '|' + CAST(No_ID as varchar)) as id_belanja_rinc_sub, 
        (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar) + '|' + CAST(Kd_Rek_1 as varchar) + '|' + CAST(Kd_Rek_2 as varchar) + '|' + CAST(Kd_Rek_3 as varchar) + '|' + CAST(Kd_Rek_4 as varchar) + '|' + CAST(Kd_Rek_5 as varchar) + '|' + CAST(No_Rinc as varchar)) as id_belanja_rinc, 
        Keterangan as nama_belanja_rinc_sub,
        Sat_1 as satuan_1,
        Nilai_1 as nilai_1,
        Sat_2 as satuan_2,
        Nilai_2 as nilai_2,
        Sat_3 as satuan_3,
        Nilai_3 as nilai_3,
        Satuan123 as total_satuan,
        Jml_Satuan as total_nilai,
        Nilai_Rp as nilai_rp,
        Total as total_rp
      FROM 
        Ta_Belanja_Rinc_sub WHERE Tahun = {$filter['tahun']}";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }

  public function deleteBankProgram($data){
    try{
      if(count($data) <= 0) return True;
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();
      foreach($data as $d){
        $deleteIds[] = "('" . implode("','", explode('|', $d)) . "')";
      }
      
      $deleteSQL = "DELETE rb FROM Ref_Program as rb JOIN (VALUES ". implode(',', $deleteIds) . ") AS t(u, b, p) ON t.u = rb.Kd_Urusan AND t.b = rb.Kd_Bidang AND t.p = rb.Kd_Prog";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
      
      $this->__enableForeignAndTrigger();
      $this->conn->commit();
      return True;
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }

  public function deleteBankKegiatan($data){
    try{
      if(count($data) <= 0) return True;
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();
      foreach($data as $d){
        $deleteIds[] = "('" . implode("','", explode('|', $d)) . "')";
      }
      
      $deleteSQL = "DELETE rb FROM Ref_Kegiatan as rb JOIN (VALUES ". implode(',', $deleteIds) . ") AS t(u, b, p, k) ON t.u = rb.Kd_Urusan AND t.b = rb.Kd_Bidang AND t.p = rb.Kd_Prog AND t.k = rb.Kd_Keg";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
    
      $this->__enableForeignAndTrigger();
      $this->conn->commit();
      return True;
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }
  
  public function deleteProgram($data){
    try{
      if(count($data) <= 0) return True;
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();
      foreach($data as $d){
        $deleteIds[] = "('" . implode("','", explode('|', $d)) . "')";
      }
      
      $deleteSQL = "DELETE rb FROM Ta_Program as rb JOIN (VALUES ". implode(',', $deleteIds) . ") AS t(u, b, o, so, p, t) ON t.u = rb.Kd_Urusan AND t.b = rb.Kd_Bidang AND t.o = rb.Kd_Unit AND t.so = rb.Kd_Sub AND t.p = rb.Kd_Prog AND t.t = rb.Tahun";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
    
      $this->__enableForeignAndTrigger();
      $this->conn->commit();
      return True;
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }
  
  public function deleteKegiatan($data){
    try{
      if(count($data) <= 0) return True;
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();
      foreach($data as $d){
        $deleteIds[] = "('" . implode("','", explode('|', $d)) . "')";
      }
      
      $deleteSQL = "DELETE rb FROM Ta_Kegiatan as rb JOIN (VALUES ". implode(',', $deleteIds) . ") AS t(u, b, o, so, p, t, k) ON t.u = rb.Kd_Urusan AND t.b = rb.Kd_Bidang AND t.o = rb.Kd_Unit AND t.so = rb.Kd_Sub AND t.p = rb.Kd_Prog AND t.t = rb.Tahun AND t.k = Kd_Keg";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
    
      $this->__enableForeignAndTrigger();
      $this->conn->commit();
      return True;
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }

  
  public function insertSIndikator($data = array(), $truncate = FALSE){
    try{
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();

      if($truncate){
        $deleteSQL = "DELETE rb FROM Ta_Indikator as rb";
  
        $delete = $this->conn->query($deleteSQL);
        if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 
      }
        
      if(count($data) > 0){
        foreach(array_chunk($data, 1000) as $chunk){
          $insertData = [];
          foreach($chunk as $nu){
            $tolak_ukur = substr(preg_replace("/[^a-zA-Z0-9\s]/", "", $nu['Tolak_Ukur']), 0, 128);
            $insertData[] = "('{$nu['Tahun']}', '{$nu['Kd_Urusan']}', '{$nu['Kd_Bidang']}', '{$nu['Kd_Unit']}', '{$nu['Kd_Sub']}', '{$nu['Kd_Prog']}', '{$nu['ID_Prog']}', '{$nu['Kd_Keg']}', '{$nu['Kd_Indikator']}', '{$nu['No_ID']}', '{$tolak_ukur}', '{$nu['Target_Angka']}', '{$nu['Target_Uraian']}')";
          }
          $insertSQL = "INSERT INTO Ta_Indikator (Tahun, Kd_Urusan, Kd_Bidang, Kd_Unit, Kd_Sub, Kd_Prog, ID_Prog, Kd_Keg, Kd_Indikator, No_ID, Tolak_Ukur, Target_Angka, Target_Uraian) VALUES ".implode(',', $insertData);
          $insert = $this->conn->query($insertSQL);
          if(!$insert) throw new UserException($this->conn->errorInfo()[2], 0);
        }
      }
      $this->conn->commit();
      $this->__enableForeignAndTrigger();
      return TRUE;
      
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }

  public function getSFisik($filter = []){
    $sql = "SELECT (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar) + '|' + CAST(No_ID as varchar)) as array_key, (CAST(Kd_Urusan as varchar) + '|' + CAST(Kd_Bidang as varchar) + '|' + CAST(Kd_Unit as varchar) + '|' + CAST(Kd_Sub as varchar) + '|' + CAST(Kd_Prog as varchar) + '|' + CAST(Tahun as varchar) + '|' + CAST(Kd_Keg as varchar)) as id_kegiatan_renja, No_ID as bulan, Target_Angka as fisik, Target_Angka as realisasi_fisik FROM ta_indikator WHERE Kd_Indikator = 6 AND No_ID <= 12 AND Tahun = {$filter['tahun']}";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql, 'array_key');
    return $arr;
  }

  public function getSRealisasiKeuanganSP2D($filter = []){
    // $sql = "SELECT 
    //     (CAST(spmr.Kd_Urusan as varchar) + '|' + CAST(spmr.Kd_Bidang as varchar) + '|' + CAST(spmr.Kd_Unit as varchar) + '|' + CAST(spmr.Kd_Sub as varchar) + '|' + CAST(spmr.Kd_Prog as varchar) + '|' + CAST(spmr.Tahun as varchar) + '|' + CAST(spmr.Kd_Keg as varchar)) as id_kegiatan_renja,
    //     (CAST(spmr.Kd_Rek_1 as varchar) + '|' + CAST(spmr.Kd_Rek_2 as varchar) + '|' + CAST(spmr.Kd_Rek_3 as varchar) + '|' + CAST(spmr.Kd_Rek_4 as varchar) + '|' + CAST(spmr.Kd_Rek_5 as varchar)) as no_rekening, MONTH(sp2d.Tgl_SP2D) as bulan, 
    //     SUM(spmr.Nilai) as nilai
    //   FROM
    //     ta_sp2d AS sp2d
    //     JOIN ta_spm AS spm
    //       ON spm.No_SPM = sp2d.No_SPM
    //     JOIN ta_spm_rinc AS spmr
    //       ON spmr.No_SPM = spm.No_SPM
    //   WHERE spmr.Kd_Rek_1 = 5 and spmr.Tahun = {$filter['tahun']}
    //   GROUP BY spmr.Kd_Urusan, spmr.Kd_Bidang, spmr.Kd_Unit, spmr.Kd_Sub, spmr.Kd_Prog, spmr.Tahun, spmr.Kd_Keg, spmr.Kd_Rek_1, spmr.Kd_Rek_2, spmr.Kd_Rek_3, spmr.Kd_Rek_4, spmr.Kd_Rek_5, MONTH(sp2d.Tgl_SP2D)";
     
    $sql = "SELECT 
    (CAST(spmr.Kd_Urusan as varchar) + '|' + CAST(spmr.Kd_Bidang as varchar) + '|' + CAST(spmr.Kd_Unit as varchar) + '|' + CAST(spmr.Kd_Sub as varchar) + '|' + CAST(spmr.Kd_Prog as varchar) + '|' + CAST(spmr.Tahun as varchar) + '|' + CAST(spmr.Kd_Keg as varchar)) as id_kegiatan_renja,
    (CAST(spmr.Kd_Rek_1 as varchar) + '|' + CAST(spmr.Kd_Rek_2 as varchar) + '|' + CAST(spmr.Kd_Rek_3 as varchar) + '|' + CAST(spmr.Kd_Rek_4 as varchar) + '|' + CAST(spmr.Kd_Rek_5 as varchar)) as no_rekening, MONTH(sp2d.Tgl_SP2D) as bulan, 
    SUM(spmr.Nilai) as nilai
  FROM
  [babel_2020].[dbo].[Ta_SP2D] AS sp2d
    JOIN [babel_2020].[dbo].[Ta_SPM] AS spm
      ON spm.No_SPM = sp2d.No_SPM
    JOIN [babel_2020].[dbo].[Ta_SPM_Rinc] AS spmr
      ON spmr.No_SPM = spm.No_SPM
  WHERE spmr.Kd_Rek_1 = 5 and spmr.Tahun = '2020' 
  -- and spmr.Kd_Urusan = '3'
  -- and spmr.Kd_Bidang = '6'
  -- and spmr.Kd_Unit = '1'
  GROUP BY spmr.Kd_Urusan, spmr.Kd_Bidang, spmr.Kd_Unit, spmr.Kd_Sub, spmr.Kd_Prog, spmr.Tahun, spmr.Kd_Keg, spmr.Kd_Rek_1, spmr.Kd_Rek_2, spmr.Kd_Rek_3, spmr.Kd_Rek_4, spmr.Kd_Rek_5, MONTH(sp2d.Tgl_SP2D)";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }
  
  public function getSRealisasiKeuangan($filter = []){
    $sql = "SELECT 
        (CAST(spj.Kd_Urusan as varchar) + '|' + CAST(spj.Kd_Bidang as varchar) + '|' + CAST(spj.Kd_Unit as varchar) + '|' + CAST(spj.Kd_Sub as varchar) + '|' + CAST(spj.Kd_Prog as varchar) + '|' + CAST(spj.Tahun as varchar) + '|' + CAST(spj.Kd_Keg as varchar)) as id_kegiatan_renja,
        (CAST(spj.Kd_Rek_1 as varchar) + '|' + CAST(spj.Kd_Rek_2 as varchar) + '|' + CAST(spj.Kd_Rek_3 as varchar) + '|' + CAST(spj.Kd_Rek_4 as varchar) + '|' + CAST(spj.Kd_Rek_5 as varchar)) as no_rekening, MONTH(spj.Tgl_Bukti) as bulan, 
        SUM(spj.Nilai) as nilai
      FROM
        Ta_SPJ_Rinc AS spj
      WHERE spj.Kd_Rek_1 = 5 and spj.Tahun = {$filter['tahun']}
      GROUP BY spj.Kd_Urusan, spj.Kd_Bidang, spj.Kd_Unit, spj.Kd_Sub, spj.Kd_Prog, spj.Tahun, spj.Kd_Keg, spj.Kd_Rek_1, spj.Kd_Rek_2, spj.Kd_Rek_3, spj.Kd_Rek_4, spj.Kd_Rek_5, MONTH(spj.Tgl_Bukti)";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    var_dump(arr);
    // return $arr;
  }

  public function getAllTimKegiatan($filter = []){
    $sql = "SELECT 
        MAX(Nm_Penandatangan) AS nama, 
        REPLACE(Nip_Penandatangan, ' ', '') AS username, 
        REPLACE(Nip_Penandatangan, ' ', '') AS nip, 
        MAX(Jbt_Penandatangan) AS jabatan,
        '7' as id_role,
        '248bc3dd13e338f6df22b9c6e4ef89be' as password
      FROM ref_entry 
      GROUP BY  
        REPLACE(Nip_Penandatangan, ' ', '')";
    $params = NULL;
    $options = NULL;
    
    $arr = $this->get($sql);
    return $arr;
  }

  public function deleteAll(){
    try{
      if(!$this->conn->beginTransaction()) throw new UserException('Unable to begin transaction on simda db', 0);
      $this->__disableForeignAndTrigger();
      $deleteSQL = "DELETE rb FROM Ta_SPD_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPD_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_STS_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_STS_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_JurnalAk_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_JurnalAk_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_SPM_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPM_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_SPP_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPP_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_Belanja as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Belanja');

      $deleteSQL = "DELETE rb FROM Ta_RASK_Arsip as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_RASK_Arsip');

      $deleteSQL = "DELETE rb FROM Ta_Pendapatan as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);        
      
      var_dump('Ta_Pendapatan');

      $deleteSQL = "DELETE rb FROM Ta_Jurnal_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Jurnal_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_SKP_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0); 

      var_dump('Ta_SKP_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_Pajak as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Pajak');
       
      $deleteSQL = "DELETE rb FROM Ta_SPJ_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPJ_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_SPJ_Bukti as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPJ_Bukti');

      $deleteSQL = "DELETE rb FROM Ta_Pengesahan_SPJ_Rinc as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Pengesahan_SPJ_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_SPJ_Panjar as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPJ_Panjar');

      $deleteSQL = "DELETE rb FROM Ta_Panjar as rb";

      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Panjar');

      $deleteSQL = "DELETE rb FROM Ta_Penyesuaian_Rinc as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Penyesuaian_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_SPM_Non_Rinc as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('TA_SPM_Non_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_Pembiayaan as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Pembiayaan');

      $deleteSQL = "DELETE rb FROM Ta_SPP_Non_Rinc as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPP_Non_Rinc');

      $deleteSQL = "DELETE rb FROM Ta_Kegiatan as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Kegiatan');

      $deleteSQL = "DELETE rb FROM Ta_Program as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Program');

      $deleteSQL = "DELETE rb FROM Ta_JurnalAk as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_JurnalAk');
      
      $deleteSQL = "DELETE rb FROM Ta_Tagihan as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Tagihan');

      $deleteSQL = "DELETE rb FROM Ta_SPP as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPP');

      $deleteSQL = "DELETE rb FROM TA_SP2D as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('TA_SP2D');

      $deleteSQL = "DELETE rb FROM Ta_SPM as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPM');
      
      $deleteSQL = "DELETE rb FROM Ta_SP2D as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SP2D');

      $deleteSQL = "DELETE rb FROM Ta_Penguji_Rinc as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Penguji_Rinc');
      
      $deleteSQL = "DELETE rb FROM Ta_Jurnal as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Jurnal');

      $deleteSQL = "DELETE rb FROM Ta_STS as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_STS');

      $deleteSQL = "DELETE rb FROM Ta_Pengesahan_SPJ as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Pengesahan_SPJ');

      $deleteSQL = "DELETE rb FROM Ta_SPJ as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPJ');

      $deleteSQL = "DELETE rb FROM Ta_Bukti_Penerimaan as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Bukti_Penerimaan');

      $deleteSQL = "DELETE rb FROM Ta_JurnalSemua as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_JurnalSemua');

      $deleteSQL = "DELETE rb FROM Ta_SKP as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SKP');

      $deleteSQL = "DELETE rb FROM Ta_SPD as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPD');

      $deleteSQL = "DELETE rb FROM Ta_Mutasi_Kas as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_Mutasi_Kas');

      $deleteSQL = "DELETE rb FROM Ta_S3UP as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_S3UP');

      $deleteSQL = "DELETE rb FROM Ta_SP2D_Non as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SP2D_Non');

      $deleteSQL = "DELETE rb FROM Ta_SPM_Non as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPM_Non');

      $deleteSQL = "DELETE rb FROM Ta_SPP_Non as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ta_SPP_Non');
      
      $deleteSQL = "DELETE rb FROM Ref_Kegiatan as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ref_Kegiatan');
      
      $deleteSQL = "DELETE rb FROM Ref_Program as rb";
      
      $delete = $this->conn->query($deleteSQL);
      if(!$delete) throw new UserException($this->conn->errorInfo()[2], 0);         
      
      var_dump('Ref_Program');
    
      $this->__enableForeignAndTrigger();

      $this->conn->commit();
      return True;
    } catch (Exception $e){
      $this->conn->rollback();
      throw $e;
    }
  }
}
