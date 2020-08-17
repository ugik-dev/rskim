<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DinkesModel extends CI_Model {
  var $CI = "";
  public function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
    $this->CI->load->library('form_validation');
    }

    public function getAllPasienProv($filter){
      if(!empty($this->session->userdata('id_puskesmas'))){
        if($this->session->userdata('id_puskesmas') != '999')$filter['id_puskesmas'] = $this->session->userdata('id_puskesmas');
      } 
      $this->db->select("ssk.*,p.nama_puskesmas ,p.pembayaran , u.username as username , u.id_user as id_user, 
    (SELECT nama from wilayah_2020 where SUBSTRING_INDEX(kode, '.', 1) = SUBSTRING_INDEX(ssk.kode_wilayah, '.', 1) 
     and (length(kode )-length(replace(kode ,'.',''))) = 0 limit 1) as nama_prov,
     (SELECT nama from wilayah_2020 where SUBSTRING_INDEX(kode, '.', 2) = SUBSTRING_INDEX(ssk.kode_wilayah, '.', 2) 
     and (length(kode )-length(replace(kode ,'.',''))) = 1 limit 1) as nama_kab,
     (SELECT nama from wilayah_2020 where SUBSTRING_INDEX(kode, '.', 3) = SUBSTRING_INDEX(ssk.kode_wilayah, '.', 3) 
     and (length(kode )-length(replace(kode ,'.',''))) = 2 limit 1)  as nama_kec, 
     (SELECT nama from wilayah_2020 where SUBSTRING_INDEX(kode, '.', 4) = SUBSTRING_INDEX(ssk.kode_wilayah, '.', 4) 
     and (length(kode )-length(replace(kode ,'.',''))) = 3 limit 1)  as nama_kel");
      $this->db->from("data_pasien as ssk");
      $this->db->join('user as u',"ssk.id_pasien = u.id_sub",'LEFT');
      $this->db->join('puskesmas as p',"ssk.id_puskesmas = p.id_puskesmas",'LEFT');
      $this->db->join("kd_area_v2 as ks", "ks.KodeKab = ssk.KDKAB AND ks.KodeKec = ssk.KDKEC AND ks.KodeKel = ssk.KDKEL", "LEFT");
      // $idSub = $this->session->userdata('id_sub');
      // if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_puskesmas'])) $this->db->where("ssk.id_puskesmas", $filter['id_puskesmas']);
      if(!empty($filter['kd_prov'])) $this->db->where("SUBSTRING_INDEX(ssk.kode_wilayah, '.', 1) = ", $filter['kd_prov']);
      if(!empty($filter['kd_kab'])) $this->db->where("SUBSTRING_INDEX(ssk.kode_wilayah, '.', 2) =", $filter['kd_kab']);
      if(!empty($filter['kd_kec'])) $this->db->where("SUBSTRING_INDEX(ssk.kode_wilayah, '.', 3) =" , $filter['kd_kec']);
      if(!empty($filter['kd_kel'])) $this->db->where("SUBSTRING_INDEX(ssk.kode_wilayah, '.', 4) =", $filter['kd_kel']);
      if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
      if(!empty($filter['by_name_or_nik'])) $this->db->where("ssk.nama like '%".$filter['by_name_or_nik']."%'");
   
      //  $this->db->GROUP_BY("ssk.NoKK");
        $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_pasien');
     
    }
    
    public function getAllPasien($filter){
      if(!empty($this->session->userdata('id_puskesmas'))){
        if($this->session->userdata('id_puskesmas') != '999')$filter['id_puskesmas'] = $this->session->userdata('id_puskesmas');
      } 
      $this->db->select("ssk.*,p.nama_puskesmas ,p.pembayaran , u.username as username , u.id_user as id_user, ks.Kabupaten as nama_kab, ks.KECAMATAN as nama_kec, ks.Kelurahan as nama_kel");
      $this->db->from("data_pasien as ssk");
      $this->db->join('user as u',"ssk.id_pasien = u.id_sub",'LEFT');
      $this->db->join('puskesmas as p',"ssk.id_puskesmas = p.id_puskesmas",'LEFT');
      $this->db->join("kd_area_v2 as ks", "ks.KodeKab = ssk.KDKAB AND ks.KodeKec = ssk.KDKEC AND ks.KodeKel = ssk.KDKEL", "LEFT");
      // $idSub = $this->session->userdata('id_sub');
      // if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_puskesmas'])) $this->db->where("ssk.id_puskesmas", $filter['id_puskesmas']);
   
      if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
      if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
      if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDKEL", $filter['kd_kel']);
      if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
      //  $this->db->GROUP_BY("ssk.NoKK");
        $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_pasien');
     
    }

    public function getAllTempatSampel(){
      
      $this->db->select("id_instansi,nama");
      $this->db->from("user as ssk");
      $this->db->where("ssk.id_role", '4');
      //  $this->db->GROUP_BY("ssk.NoKK");
        $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_instansi');
     
    }
    public function getAllPasien_v2($filter){
      // var_dump($filter);
      $this->db->select("ssk.*,  sp.nama_status as nama_status, ks.Kabupaten as nama_kab, ks.KECAMATAN as nama_kec, ks.Kelurahan as nama_kel ");
      $this->db->from("data_pasien as ssk");
      $this->db->join("kd_area_v2 as ks", "ks.KodeKab = ssk.KDKAB AND ks.KodeKec = ssk.KDKEC AND ks.KodeKel = ssk.KDKEL", "LEFT");
      
      $this->db->join("status_pasien as sp", "sp.id_status = ssk.status", "LEFT");
      // $this->db->where("ssk.NO", $filter['NO']);
      // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
      // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
       // $idSub = $this->session->userdata('id_sub');
      if(!empty($this->session->userdata('id_sub'))) $this->db->where("ssk.id_pasien", $this->session->userdata('id_sub'));
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['IDBDT'])) $this->db->where("ssk.IDBDT", $filter['IDBDT']);
      if(!empty($filter['kd_kab'])) $this->db->where("ssk.KDKAB", $filter['kd_kab']);
      if(!empty($filter['kd_kec'])) $this->db->where("ssk.KDKEC", $filter['kd_kec']);
      if(!empty($filter['kd_kel'])) $this->db->where("ssk.KDKEL", $filter['kd_kel']);
      if(!empty($filter['by_nik'])) $this->db->where("ssk.NIK", $filter['by_nik']);
      if(!empty($filter['by_nokk'])) $this->db->where("ssk.NoKK", $filter['by_nokk']);
      if(!empty($filter['sta_pkh'])) $this->db->where("ssk.sta_pkh", $filter['sta_pkh']);
      if(!empty($filter['sta_rastra'])) $this->db->where("ssk.sta_rastra", $filter['sta_rastra']);
      //  $this->db->GROUP_BY("ssk.NoKK");
        $this->db->limit("1000");
      $res = $this->db->get();
      return $res->result_array();
     
    }

    public function getAllRecord($filter){
      if(!empty($this->session->userdata('id_puskesmas'))){
        $filter['id_puskesmas'] = $this->session->userdata('id_puskesmas');
      } 
      if(!empty($filter['isSelf'])) $filter['id_puskesmas'] = '';
    
      $this->db->select("ssk.* ,sp.nama_status, dp.nama as nama , dp.NIK as NIK,dp.email as email");
      $this->db->from("record_pasien as ssk");
      $this->db->join("status_pasien as sp", "ssk.before_status = sp.id_status", "LEFT");
      $this->db->join("data_pasien as dp", "ssk.id_pasien = dp.id_pasien", "LEFT");
     
      if(!empty($this->session->userdata('id_sub'))) $this->db->where("ssk.id_pasien", $this->session->userdata('id_sub'));
     
      // $this->db->where("ssk.NO", $filter['NO']);
      // $this->db->join("kegiatan_survei_attachment as ksa", "ksa.id_kegiatan_survei = ks.id_kegiatan_survei", "LEFT");
      // if(!empty($filter['kd_perusahaan'])) $this->db->where("ssk.NAMA_PERUSAHAAN", $filter['kd_perusahaan']);
      if(!empty($filter['instansi'])) $this->db->where("ssk.instansi", $filter['instansi']);
      if(!empty($filter['tahap'])) $this->db->where("ssk.tahap", $filter['tahap']);
      if(!empty($filter['id_puskesmas'])) $this->db->where("ssk.id_puskesmas", $filter['id_puskesmas']);
      if(!empty($filter['date_before']))$this->db->where("ssk.tanggal_record >= '".$filter['date_before']." 00:00:00'");
      if(!empty($filter['date_after']))$this->db->where("ssk.tanggal_record <= '".$filter['date_after']." 23:59:00'");
  
      if(!empty($filter['id_pasien'])) $this->db->where("ssk.id_pasien", $filter['id_pasien']);
      if(!empty($filter['id_record'])) $this->db->where("ssk.id_record", $filter['id_record']);
      if(!empty($filter['is_self'])) $this->db->where("ssk.id_record != ", $filter['is_self']);

     $this->db->limit("1000");
      $res = $this->db->get();
      return DataStructure::keyValue($res->result_array(), 'id_record');
     
 
     
    }

    public function addPasien($data){
 
      $this->db->insert('data_pasien', DataStructure::slice($data, [
        'nama', 'NIK', 'KDKAB', 'KDKEC', 'KDKEL', 'status', 'email', 'nomorhp', 'alamat', 'jenis_kelamin', 'tempat_lahir', 'pasca_hamil',  'nama_krt', 'tanggal_lahir','kode_wilayah'
      ], TRUE));
      ExceptionHandler::handleDBError($this->db->error(), "Tambah Data Pasien", "data_pasien");
  
      return $this->db->insert_id();
    }

    
    public function addRecord($data){

      $tanggal = substr($data['tanggal_record'],0,10);
      $this->db->select("no_antri");
      $this->db->from("record_pasien");
      // $this->db->where("tanggal_record like '". $tanggal."%' ");
       $this->db->where("tanggal_record like '". $tanggal."%' ");
       $this->db->order_by("no_antri",'desc');
       $this->db->limit("1");

     
      $res = $this->db->get();
      $noantri = $res->result_array();
      // var_dump($tanggal);
    
      if(!empty($noantri[0])){
        $data['no_antri'] = $noantri[0]['no_antri']+1;
      }else{
        $data['no_antri'] = '1';
      }

      if(!empty($this->session->userdata('id_puskesmas'))){
        $data['id_puskesmas'] = $this->session->userdata('id_puskesmas');
      } 
      $data['after_status'] = $data['before_status'];
      $this->db->insert('record_pasien', DataStructure::slice($data, [
        'id_pasien', 'tanggal_record', 'before_status', 'deskripsi', 'berbayar','no_rekam', 'rumah_sakit','after_status','tahap','tanggal_pengambilan_sampel','tanggal_hasil_labor','id_puskesmas','no_antri'
      ], TRUE));
      ExceptionHandler::handleDBError($this->db->error(), "Tambah Data Pasien", "record_pasien");
  
      return $this->db->insert_id();
    }


      public function editPasien($data){
       
        // $this->db->set(DataStructure::slice($data, ['ID', 'jenis_bantuan'], TRUE));
        // $this->db->set('jenis_bantuan', $data['jenis_bantuan']);
        // $this->db->set(DataStructure::slice($data, [
        //   'nama', 'NIK', 'KDKAB', 'KDKEC', 'KDKEL', 'status', 'email', 'nomorhp', 'alamat'
        // ], TRUE));

        $this->db->set(DataStructure::slice($data, [
          'nama', 'NIK', 'KDKAB', 'KDKEC', 'KDKEL',
           'status', 'email', 'nomorhp', 'alamat',
            'jenis_kelamin','pasca_hamil',  'nama_krt', 
             'tempat_lahir',  'id_puskesmas', 
             'tanggal_lahir','kewarganegaraan','kategori','st_perkawinan','pekerjaan','kode_wilayah'
          ], TRUE));
        
  
        $this->db->where('id_pasien', $data['id_pasien']);
        $this->db->update('data_pasien');
        ExceptionHandler::handleDBError($this->db->error(), "Ubah Jenis Bantuan", "data_pasien");
        return $data['id_pasien'];
      }

      public function editRecord($data){
      
        ini_set('date.timezone', 'Asia/Jakarta');
        if(!empty($data['del_rs'])) $data['pengirim_spesimen_rs'] = '1';
        if(!empty($data['del_dinkes'])) $data['pengirim_spesimen_dinkes'] = '1';
        if(!empty($data['hasil_labor'])) $data['tanggal_hasil_labor'] =  date('Y-m-d H:i:s');
        if(!empty($data['lock_record'])){
          if($data['lock_record'] == '1') $data['tanggal_hasil_labor'] = date('Y-m-d H:i:s');
        }
        // $this->db->set(DataStructure::slice($data, ['ID', 'jenis_bantuan'], TRUE));
        // $this->db->set('jenis_bantuan', $data['jenis_bantuan']);
        // 'tanggal_record', 'before_status', 'deskripsi', 'no_rekam', 'rumah_sakit','after_status'
       
        $this->db->set(DataStructure::slice($data, [
          'before_status', 'after_status', 'tanggal_record', 'deskripsi', 'no_rekam',
          'pengirim_spesimen_rs', 'pengirim_spesimen_dinkes', 'dinkes_prov', 'dinkes_kab',
          'rumah_sakit', 'rumah_sakit_kab', 'dokter_nama', 'dokter_nomorhp', 'tanggal_onset', 
          'panas', 'batuk', 'sakit_tenggorokan', 'sesak_napas', 'pilek', 'lesu', 'sakit_kepala', 
          'diare', 'mual_muntah', 'xray', 'hasil_xray', 'lekousit', 'limposit', 'trombosit',
           'ventilator', 'status_kesehatan', 'usap_nasofaring', 'date_usap_nasofaring',
            'usap_orofaring', 'date_usap_orofaring', 'sputum', 'date_sputum', 'serum',
             'date_serum', 'lainnya1', 'lainnya1_text', 'date_lainnya1', 'lainnya2', 'lock_record','status_bayar','no_antri','hasil_igm','hasil_igg','tekanan_darah','tinggi_badan','berat_badan',
             'lainnya2_text', 'date_lainnya2', 'kesimpulan','tahap','instansi','tanggal_pengambilan_sampel','jenis','no_sampel','tanggal_hasil_labor','hasil_labor'
        ], TRUE));
        $this->db->where('id_record', $data['id_record']);
        $this->db->update('record_pasien');
        ExceptionHandler::handleDBError($this->db->error(), "Ubah Jenis Bantuan", "record_pasien");
        return $data['id_record'];
      }

      public function deletePasien($data){
        $this->db->where('id_pasien', $data['id_pasien']);
        $this->db->delete('data_pasien');
    
        ExceptionHandler::handleDBError($this->db->error(), "Hapus Pasien", "data_pasien");
      }

      public function deleteRecord($data){
        $this->db->where('id_record', $data['id_record']);
        $this->db->delete('record_pasien');
    
        ExceptionHandler::handleDBError($this->db->error(), "Hapus Pasien", "record_pasien");
      }
    }
    
