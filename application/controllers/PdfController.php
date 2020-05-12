<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfController extends CI_Controller {

  public function __construct(){
    parent::__construct();
		$this->load->model(array('DinkesModel','PasienModel','DTKSModel'));
    $this->load->helper(array('DataStructure', 'Validation'));
  }

  
  public function getPDF(){

    require('assets/fpdf/fpdf.php');
   //var_dump($dataProfil);
   // echo $dataProfil['nama'];
   $data = $this->DTKSModel->getAllUMKM_v2($this->input->get());
    //    var_dump($data);
    $pdf = new FPDF('p','mm','A4');
    // Menambah halaman baru
    $pdf->AddPage();
    $pdf->SetTitle('title');
    $pdf->SetAuthor('U Developer');
    // Setting jenis font
    $pdf->SetFont('Arial','B',16);
    // Membuat string
    $pdf->Cell(195,7,'DATA UMKM',0,1,'C');
    $pdf->Cell(50,7,' ',0,1);
    $pdf->Cell(50,7,'Nama UMKM',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['NAMA_UMKM'],0,1);
    $pdf->Cell(50,7,'NIK',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['NIK'],0,1);
    $pdf->Cell(50,7,'PKH',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['sta_pkh'] == '1' ? 'Ada': 'Tidak Ada',0,1);
    $pdf->Cell(50,7,'BNPT',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['sta_rastra'] == '3' ? 'Ada': 'Tidak Ada',0,1);
    $pdf->Cell(50,7,'Jumlah Keluarga',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['Jumlah_Keluarga'],0,1);
    $pdf->Cell(50,7,'No HP',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['NOHP'],0,1);
     $pdf->Cell(50,7,'Alamat',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->MultiCell( 115, 7,$data['0']['ALAMAT'], 0,1);
    $pdf->Cell(50,7,'Kabupaten',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['Nama_KAB'],0,1);
    $pdf->Cell(50,7,'Kecamatan',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['Nama_Kec'],0,1);
    $pdf->Cell(50,7,'Desa/Kelurahan',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->Cell(10,7,$data['0']['Nama_Desa/Kelurahan'],0,1);
    // $pdf->Cell(10,7,$data['0']['ALAMAT'],0,1);
    if(!empty($data['0']['KULINER_BASAH'])){
    $pdf->Cell(50,7,'Kuliner Basah',0,0);
    $pdf->Cell(10,7,': ',0,0);
    $pdf->MultiCell( 115, 7,$data['0']['KULINER_BASAH'], 0,1);
        }
    
    if(!empty($data['0']['KULINER_KERING'])){
        $pdf->Cell(50,7,'Kuliner Kering',0,0);
        $pdf->Cell(10,7,': ',0,0);
        $pdf->MultiCell( 115, 7,$data['0']['KULINER_KERING'], 0,1);
        }
    
    if(!empty($data['0']['MAKANAN'])){
        $pdf->Cell(50,7,'Makanan',0,0);
        $pdf->Cell(10,7,': ',0,0);
        $pdf->MultiCell( 115, 7,$data['0']['MAKANAN'], 0,1);
        }
    if(!empty($data['0']['MINUMAN'])){
        $pdf->Cell(50,7,'Minuman',0,0);
        $pdf->Cell(10,7,': ',0,0);
        $pdf->MultiCell( 115, 7,$data['0']['MINUMAN'], 0,1);
        }
    if(!empty($data['0']['KERAJINAN'])){
        $pdf->Cell(50,7,'Kerajinan',0,0);
        $pdf->Cell(10,7,': ',0,0);
        $pdf->MultiCell( 115, 7,$data['0']['KERAJINAN'], 0,1);
        }

        $pdf->Cell(50,7,'Keterangan',0,0);
        $pdf->Cell(10,7,': ',0,0);
        $pdf->MultiCell( 115, 7,$data['0']['KETERANGAN'], 0,1);
            
    $pdf->Cell(10,7,' ',0,1);
    $pdf->Output('D',$data['0']['NAMA_UMKM'].'.pdf');

  }
  function getAge($date) {
    $tanggal = new DateTime($date);
    $today = new DateTime('today');
    $y = $today->diff($tanggal)->y;
    $m = $today->diff($tanggal)->m;
    $d = $today->diff($tanggal)->d;
    $res =   $y . " tahun " . $m . " bulan " . $d . " hari";
    return $res;
  }

  function checkbox($pdf,$num){
    $pdf->SetFont('ZapfDingbats','', 12);
    if($num == '2'){
      $check = '4';
    }else{
      $check = '';
    }
    $pdf->Cell(7,7, $check, 1, 0);
    $pdf->SetFont('Arial','',12);
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

public function getPDFRecordRS(){
    
  require_once('assets/fpdf/fpdf.php');
  //  var_dump($this->input->get());
 // echo $dataProfil['nama'];
  $get = $this->input->get();
 $data = $this->DinkesModel->getAllRecord($this->input->get());
 $data = $data[$get['id_record']];
 $dataRecord = $this->DinkesModel->getAllRecord(array('id_pasien' => $data['id_pasien'],'isSelf' => '1'));

 $dataPasien = $this->DinkesModel->getAllPasien_v2(array('id_pasien' => $data['id_pasien']));
 $dataKontak = $this->PasienModel->getAllKontak(array('id_pasien' => $data['id_pasien']));
 $dataTracking = $this->PasienModel->getAllTracking(array('id_pasien' => $data['id_pasien']));

    // var_dump($dataPasien);
  $pdf = new FPDF('p','mm','A4');
  // Menambah halaman baru
  $pdf->AddPage();
  $pdf->SetTitle('title');
  $pdf->SetAuthor('U Developer');
  // Setting jenis font
  $pdf->SetFont('Arial','B',12);
  // Membuat string
  $pdf->Image(base_url('assets/img/head_rskim.jpg'), 5, 5, 200);
  
  $pdf->Cell(50,46,' ',0,1);

  $pdf->SetFont('Arial','',10);

  $pdf->Cell(35,7,'No. Rekam Medis',0,0);
  $pdf->Cell(40,7,': '.$data['no_rekam'] ,0,0);
  $pdf->Cell(35,7,'',0,0);
  $pdf->Cell(35,7,'Nama Pasien',0,0);
  $pdf->MultiCell(40,7,': '.$dataPasien['0']['nama'] ,0,1);

  $pdf->Cell(35,7,'Tgl Rekam',0,0);
  $pdf->Cell(40,7,': '.substr($data['tanggal_record'],0,15) ,0,0);
  $pdf->Cell(35,7,'',0,0);
  $pdf->Cell(35,7,'Umur',0,0);
  $pdf->Cell(40,7,': '.$this->getAge($dataPasien['0']['tanggal_lahir']) ,0,1);
  $pdf->Cell(35,7,'Tgl Hasil Selesai',0,0);
  $pdf->Cell(40,7,': '.substr($data['tanggal_hasil_labor'],0,15) ,0,0);
  $pdf->Cell(35,7,'',0,0);
  $pdf->Cell(35,7,'Kabupaten/Kota',0,0);
  $pdf->MultiCell(40,7,': '.ucfirst(strtolower($dataPasien['0']['nama_kab'])) ,0,1);




  $pdf->Cell(35,7,'Dokter Pengirim',0,0);
  $pdf->Cell(40,7,': '.$data['dokter_nama'] ,0,0);
  $pdf->Cell(35,7,'',0,0);
  $pdf->Cell(35,7,'Alamat Pasien',0,0);
  $pdf->MultiCell(40,7,': '.$dataPasien['0']['alamat'].' , '.ucfirst(strtolower($dataPasien['0']['nama_kel'])).' , '.ucfirst(strtolower($dataPasien['0']['nama_kec'])) ,0,1);

  $x = $pdf->GetX();
  $y = $pdf->GetY();
  $pdf->SetLineWidth(0);
  $pdf->Line(10,$y+4,200,$y+4);
  $pdf->Line(10,$y+12,200,$y+12);
  $pdf->Cell(35,5,'',0,1);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(40,7,'PEMERIKSAAN ',0,0);
  $pdf->Cell(40,7,'HASIL ',0,0);
  $pdf->Cell(30,7,'SATUAN ',0,0);
  $pdf->Cell(40,7,'NILAI RUJUKAN',0,0);
  $pdf->Cell(30,7,'METODE',0,1);
  $pdf->Cell(5,3,' ',0,1);
  $pdf->SetFont('Arial','',10);

  $pdf->Cell(40,7,'SEROLOGI ',0,0);
  $pdf->Cell(40,7,' ',0,0);
  $pdf->Cell(30,7,' ',0,0);
  $pdf->Cell(40,7,'',0,0);
  $pdf->Cell(30,7,'',0,1);
  $pdf->Cell(5,3,' ',0,1);

  $pdf->Cell(40,7,'Rapid  Test Covid-19 ',0,0);
  $pdf->Cell(40,7,' ',0,0);
  $pdf->Cell(30,7,' ',0,0);
  $pdf->Cell(40,7,'',0,0);
  $pdf->Cell(30,7,'',0,1);
  $pdf->Cell(40,7,'  IgM',0,0);
  $pdf->Cell(40,7,$data['hasil_igm'] == 'reaktif'? 'Reaktif' : 'Non Reaktif',0,0);
  $pdf->Cell(30,7,' ',0,0);
  $pdf->Cell(40,7,'',0,0);
  $pdf->Cell(30,7,'',0,1);
  $pdf->Cell(40,7,'  IgG',0,0);
  $pdf->Cell(40,7,$data['hasil_igg'] == 'reaktif'? 'Reaktif' : 'Non Reaktif',0,0);
  $pdf->Cell(30,7,' ',0,0);
  $pdf->Cell(40,7,'',0,0);
  $pdf->Cell(30,7,'',0,1);
  $pdf->Cell(30,7,'',0,1);
  $pdf->Cell(30,7,'',0,0);
  $pdf->MultiCell(150,6,"Catatan : \n".$data['deskripsi'],0,'L');

    // $pdf = new FPDF('p','mm','A4');
    // Menambah halaman baru
    $pdf->AddPage('l','A4');
    $pdf->Cell(50,9,' ',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(300,7,'G. Riwayat Kontak / Paparan dan Perjalanan Luar Kota',0,1,'C');
    $pdf->Cell(5,7,' ',0,1);
    $pdf->Cell(5,7,'',0,0);
    $pdf->Cell(70,7,'Riwayat kontak / paparan',0,1,'L');
    $pdf->Cell(5,7,' ',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(50,7,'Nama',1,0,'C');
    $pdf->Cell(50,7,'Alamat',1,0,'C');
    $pdf->Cell(30,7,'Hubungan',1,0,'C');
    $pdf->Cell(30,7,'Peunomia',1,0,'C');
    $pdf->Cell(30,7,'Gejala Sama',1,0,'C');
    $pdf->Cell(40,7,'Tanggal Mulai',1,0,'C');
    $pdf->Cell(40,7,'Tanggal Pulang',1,1,'C');
    $pdf->SetFont('Arial','',12);
    foreach($dataKontak as $pi){
$leng = $pdf->NbLines(50,$pi['alamat']);
$leng2 = $pdf->NbLines(50,$pi['nama']);
$leng = max($leng,$leng2);
$x = $pdf->GetX();
$y = $pdf->GetY();
$h=7*$leng;
$pdf->Rect($x,$y,50,$h);
    //Print the text
$pdf->MultiCell(50,7,$pi['nama'],0,'L');
$pdf->SetXY($x+50,$y);
$pdf->Rect($x+50,$y,50,$h);
$pdf->MultiCell(50,7,$pi['alamat'],0,'L');

$pdf->SetXY($x+100,$y);
$pdf->Rect($x+100,$y,30,$h);
$pdf->MultiCell(30,7,$pi['hubungan'],0,'C');

$pdf->SetXY($x+130,$y);
$pdf->Rect($x+130,$y,30,$h);
$pdf->MultiCell(30,7,$pi['pneunomia_berat'],0,'C');

$pdf->SetXY($x+160,$y);
$pdf->Rect($x+160,$y,30,$h);
$pdf->MultiCell(30,7,$pi['sakit_sama'],0,'C');

$pdf->SetXY($x+190,$y);
$pdf->Rect($x+190,$y,40,$h);
$pdf->MultiCell(40,7,$pi['tanggal_pertama'],0,'C');
$pdf->SetXY($x+230,$y);
$pdf->Rect($x+230,$y,40,$h);
$pdf->MultiCell(40,7,$pi['tanggal_terakhir'],0,'C');
$pdf->Ln($h-7);
}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(5,7,'',0,1);
$pdf->Cell(5,7,'',0,0);
$pdf->Cell(70,7,'Riwayat perjalanan luar kota',0,1,'L');
$pdf->Cell(5,7,' ',0,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,7,'Negara',1,0,'C');
$pdf->Cell(60,7,'Kota',1,0,'C');
$pdf->Cell(40,7,'Tanggal Pergi',1,0,'C');
$pdf->Cell(40,7,'Tanggal Pulang',1,1,'C');

$pdf->SetFont('Arial','',12);

foreach($dataTracking as $pi){
  $leng = $pdf->NbLines(60,$pi['negara']);
  $leng2 = $pdf->NbLines(60,$pi['kota']);
  $leng = max($leng,$leng2);
  $x = $pdf->GetX();
  $y = $pdf->GetY();
  $h=7*$leng;
  $pdf->Rect($x,$y,60,$h);
      //Print the text
  $pdf->MultiCell(60,7,$pi['negara'],0,'L');
  $pdf->SetXY($x+60,$y);
  $pdf->Rect($x+60,$y,60,$h);
  $pdf->MultiCell(60,7,$pi['kota'],0,'L');
  
  $pdf->SetXY($x+120,$y);
  $pdf->Rect($x+120,$y,40,$h);
  $pdf->MultiCell(40,7,$pi['tanggal_pergi'],0,'C');

  $pdf->SetXY($x+160,$y);
  $pdf->Rect($x+160,$y,40,$h);
  $pdf->MultiCell(40,7,$pi['tanggal_pulang'],0,'C');
  
  
  $pdf->Ln($h-7);
  }

$pdf->Output('D',$dataPasien['0']['nama'].'.pdf');
}


public function test_pdf(){
    echo 'test';
//   require_once('assets/fpdf/fpdf.php');
//   //  var_dump($this->input->get());
//  // echo $dataProfil['nama'];

//     // var_dump($dataPasien);
//   $pdf = new FPDF('p','mm','A4');
//   // Menambah halaman baru
//   $pdf->AddPage();
//   $pdf->SetTitle('title');
//   $pdf->SetAuthor('U Developer');
//   // Setting jenis font
//   $pdf->SetFont('Arial','B',12);
//   // Membuat string
//   $pdf->Image(base_url('assets/img/head_rskim.jpg'), 5, 5, 200);
  
//   $pdf->Cell(50,34,' ',0,1);
//   $pdf->SetFont('Arial','B',12);
//   $pdf->Cell(195,7,'A. Data Pengirim Rekam Medis',0,1,'C');
//   $pdf->Cell(50,7,' ',0,1);

//   $pdf->Output('D','sda'.'.pdf');
}

public function getPDFRecord(){
    
    require_once('assets/fpdf/fpdf.php');
    //  var_dump($this->input->get());
   // echo $dataProfil['nama'];
    $get = $this->input->get();
   $data = $this->DinkesModel->getAllRecord($this->input->get());
   $data = $data[$get['id_record']];
   $dataRecord = $this->DinkesModel->getAllRecord(array('id_pasien' => $data['id_pasien'],'isSelf' => '1'));
 
   $dataPasien = $this->DinkesModel->getAllPasien_v2(array('id_pasien' => $data['id_pasien']));
   $dataKontak = $this->PasienModel->getAllKontak(array('id_pasien' => $data['id_pasien']));
   $dataTracking = $this->PasienModel->getAllTracking(array('id_pasien' => $data['id_pasien']));
  
      // var_dump($dataPasien);
    $pdf = new FPDF('p','mm','A4');
    // Menambah halaman baru
    $pdf->AddPage();
    $pdf->SetTitle('title');
    $pdf->SetAuthor('U Developer');
    // Setting jenis font
    $pdf->SetFont('Arial','B',12);
    // Membuat string
    $pdf->Image(base_url('assets/img/head_rskim.jpg'), 5, 5, 200);
    
    $pdf->Cell(50,34,' ',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(195,7,'A. Data Pengirim Rekam Medis',0,1,'C');
    $pdf->Cell(50,7,' ',0,1);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(50,7,'Pengirim Spesimen',0,0);
    $pdf->SetFont('ZapfDingbats','', 12);
    if($data['pengirim_spesimen_rs'] == '2'){
      $check = '4';
    }else{
      $check = '';
    }
    $pdf->Cell(7,7, $check, 1, 0);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(50,7,' Rumah Sakit ',0,0);

    $pdf->SetFont('ZapfDingbats','', 12);
    if($data['pengirim_spesimen_dinkes'] == '2'){
      $check = '4';
    }else{
      $check = '';
    }
    $pdf->Cell(7,7, $check, 1, 0);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(50,7,' Dinas Kesehatan ',0,1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Dinas Kesehatan Kab/Kota',0,0);
    $pdf->Cell(40,7,': '.$data['dinkes_kab'] ,0,0);
    $pdf->Cell(27,7,'Provinsi ',0,0);
    $pdf->Cell(60,7,': '.$data['dinkes_prov'],0,1);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Rumah Sakit',0,0);
    $pdf->Cell(40,7,': '.$data['rumah_sakit'] ,0,0);
    $pdf->Cell(27,7,'Kab/Kota ',0,0);
    $pdf->Cell(60,7,': '.$data['rumah_sakit_kab'],0,1);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Dokter Penanggung Jawab',0,0);
    $pdf->Cell(40,7,': '.$data['dokter_nama'] ,0,1);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'No Telp/Hp ',0,0);
    $pdf->Cell(60,7,': '.$data['dokter_nomorhp'],0,1);
    $pdf->Cell(5,7,' ',0,1);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Nomor Rekam Medis ',0,0);
    $pdf->Cell(45,7,': '.$data['no_rekam'],0,0);
    $pdf->Cell(30,7,'Tanggal :',0,0);
    $pdf->Cell(60,7,substr($data['tanggal_record'],0,16),0,1);


    $pdf->Cell(50,7,' ',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(195,7,'B. Data Pasien',0,1,'C');
    $pdf->Cell(50,7,' ',0,1);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(35,7,'Nama ',0,0);
    $pdf->Cell(60,7,': '.$dataPasien['0']['nama'],0,0);
    $pdf->Cell(30,7,'NIK ',0,0);
    $pdf->Cell(60,7,': '.$dataPasien['0']['NIK'],0,1);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(35,7,'Tempat Lahir ',0,0);
    $pdf->Cell(60,7,': '.$dataPasien['0']['tempat_lahir'],0,0);
    $pdf->Cell(30,7,'Tanggal Lahir ',0,0);
    $pdf->Cell(60,7,': '.$dataPasien['0']['tanggal_lahir'],0,1);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(35,7,'Usia ',0,0);
    $pdf->Cell(60,7,': '.$this->getAge($dataPasien['0']['tanggal_lahir']),0,1);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(35,7,'Email ',0,0);
    $pdf->Cell(60,7,': '.$dataPasien['0']['email'],0,0);
    $pdf->Cell(30,7,'Nomor HP',0,0);
    $pdf->Cell(60,7,': '.$dataPasien['0']['nomorhp'],0,1);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(35,7,'Jenis Kelamin ',0,0);
    $pdf->Cell(60,7,': '.($dataPasien['0']['jenis_kelamin'] == 'P' ? 'Perempuan' : 'Laki-laki'),0,0);
    $pdf->Cell(30,7,'Hamil/Pasca',0,0);
    $pdf->Cell(60,7,': '.($dataPasien['0']['pasca_hamil'] == 'Ya' ? 'Ya' : '-'),0,1);    
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(35,7,'Alamat ',0,0);
    $pdf->Cell(3,7,':',0,0);
    $pdf->MultiCell( 115, 7,$dataPasien['0']['alamat']."\n".$dataPasien['0']['nama_kel'].', '.$dataPasien['0']['nama_kec'].', '.$dataPasien['0']['nama_kab'], 0,1);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(35,7,'Nama KRT ',0,0);
    $pdf->Cell(60,7,': '.$dataPasien['0']['nama_krt'],0,1);

    $pdf->Cell(50,7,' ',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(195,7,'C. Riwayat Perawatan',0,1,'C');
    $pdf->Cell(50,7,' ',0,1);
    $pdf->SetFont('Arial','',12);
    $i=0;
    foreach($dataRecord as $pi){
      $pdf->Cell(20,7,'ke-:'.$i,0,0);
      $pdf->Cell(40,7,$pi['rumah_sakit'],0,0);
      $pdf->Cell(60,7,$this->convertDateTime2($pi['tanggal_record']),0,0);
      $pdf->Cell(50,7,$pi['nama_status'],0,1);
      $i++;
    }
    $pdf->AddPage();
    $pdf->Cell(50,9,' ',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(195,7,'D. Tanda Gejala',0,1,'C');
    $pdf->Cell(5,7,' ',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(35,7,'Tanggal Gejala :',0,0);
    $pdf->Cell(60,7,$data['tanggal_onset'],0,1);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(40,7,'Panas >= 38 ',0,0);
    $this->checkbox($pdf,$data['panas']);
    $pdf->Cell(40,7,' ',0,0);
    $pdf->Cell(30,7,'Batuk ',0,0);
    $this->checkbox($pdf,$data['batuk']);
    $pdf->Cell(5,7,' ',0,1);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(40,7,'Sakit Tenggorokan ',0,0);
    $this->checkbox($pdf,$data['sakit_tenggorokan']);
    $pdf->Cell(40,7,' ',0,0);
    $pdf->Cell(30,7,'Sesak Napas ',0,0);
    $this->checkbox($pdf,$data['sesak_napas']);
    $pdf->Cell(5,7,' ',0,1);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(40,7,'Pilek ',0,0);
    $this->checkbox($pdf,$data['pilek']);
    $pdf->Cell(40,7,' ',0,0);
    $pdf->Cell(30,7,'Lesu ',0,0);
    $this->checkbox($pdf,$data['lesu']);
    $pdf->Cell(5,7,' ',0,1);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(40,7,'Sakit Kepala ',0,0);
    $this->checkbox($pdf,$data['sakit_kepala']);
    $pdf->Cell(40,7,' ',0,0);
    $pdf->Cell(30,7,'Diare ',0,0);
    $this->checkbox($pdf,$data['diare']);
    $pdf->Cell(5,7,' ',0,1);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(40,7,'Muntah Mual ',0,0);
    $this->checkbox($pdf,$data['mual_muntah']);
    $pdf->Cell(40,7,' ',0,0);
  
    $pdf->Cell(50,7,' ',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(195,7,'E. Pemeriksaan Penunjang',0,1,'C');
    $pdf->Cell(5,7,' ',0,1);
    $pdf->SetFont('Arial','',12);

    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(40,7,'X-Ray Paru ',0,0);
    $this->checkbox($pdf,$data['xray']);
    $pdf->Cell(40,7,' ',0,1);

    if(!empty($data['hasil_xray'])){
      $pdf->Cell(5,7,' ',0,0);
      $pdf->Cell(35,7,'Hasil X-Ray ',0,0);
      $pdf->Cell(3,7,':',0,0);
      $pdf->MultiCell( 115, 7,$data['hasil_xray'], 0,1);
    }

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Sel Darah Putih ',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(15,7,' ',0,0);
    $pdf->Cell(40,7,'Lekousit',0,0);
    $pdf->Cell(20,7,': '.$data['lekousit'],0,0);
    $pdf->Cell(30,7,'/ul',0,1);

    $pdf->Cell(80,7,' ',0,0);
    $pdf->Cell(40,7,'Limposit',0,0);
    $pdf->Cell(20,7,': '.$data['limposit'],0,0);
    $pdf->Cell(30,7,'/ul',0,1);

    $pdf->Cell(80,7,' ',0,0);
    $pdf->Cell(40,7,'Trombosit',0,0);
    $pdf->Cell(20,7,': '.$data['trombosit'],0,0);
    $pdf->Cell(30,7,'/ul',0,1);
    $pdf->Cell(50,4,' ',0,1);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Menggunakan Ventilator ',0,0);
    $this->checkbox($pdf,$data['ventilator']);
    $pdf->Cell(10,7,'Ya',0,0);
    $this->checkbox($pdf,$data['ventilator'] == '2' ? '1': '2');
     $pdf->Cell(10,7,'Tidak ',0,0);
    $pdf->Cell(5,7,' ',0,1);
    $pdf->Cell(50,4,' ',0,1);
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Status kesehatan pasien saat pengambilan spesimen ',0,1);
    $pdf->Cell(50,7,' ',0,0);
    $this->checkbox($pdf,$data['status_kesehatan'] == '1' ? '2' : '');
    $pdf->Cell(20,7,'Pulang',0,0);
    $this->checkbox($pdf,$data['status_kesehatan'] == '2' ? '2': '');
     $pdf->Cell(20,7,'Dirawat',0,0);
     $this->checkbox($pdf,$data['status_kesehatan'] == '3' ? '2': '');
     $pdf->Cell(10,7,'Meninggal',0,0);
    $pdf->Cell(5,7,' ',0,1);

    $pdf->Cell(50,9,' ',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(195,7,'F. Pengambilan Spesimen',0,1,'C');
    $pdf->Cell(5,7,' ',0,1);
    $pdf->SetFont('Arial','',12);

    if($data['usap_nasofaring'] == '2'){
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Usap Nasofaring',0,0);
    $pdf->Cell(5,7,': ',0,0);
    $this->checkbox($pdf,$data['usap_nasofaring']);
    $pdf->Cell(20,7,'',0,0);
    $pdf->Cell(20,7,'Tanggal :',0,0);
    $pdf->Cell(60,7,substr($data['date_usap_nasofaring'],0,16),0,1);
    }

    if($data['usap_orofaring'] == '2'){
    $pdf->Cell(5,7,' ',0,0);
    $pdf->Cell(60,7,'Usap Orofaring',0,0);
    $pdf->Cell(5,7,': ',0,0);
    $this->checkbox($pdf,$data['usap_orofaring']);
    $pdf->Cell(20,7,'',0,0);
    $pdf->Cell(20,7,'Tanggal :',0,0);
    $pdf->Cell(60,7,substr($data['date_usap_orofaring'],0,16),0,1);
    }

    if($data['sputum'] == '2'){
      $pdf->Cell(5,7,' ',0,0);
      $pdf->Cell(60,7,'Sputum',0,0);
      $pdf->Cell(5,7,': ',0,0);
      $this->checkbox($pdf,$data['sputum']);
      $pdf->Cell(20,7,'',0,0);
      $pdf->Cell(20,7,'Tanggal :',0,0);
      $pdf->Cell(60,7,substr($data['date_sputum'],0,16),0,1);
      }

      if($data['serum'] == '2'){
        $pdf->Cell(5,7,' ',0,0);
        $pdf->Cell(60,7,'Serum',0,0);
        $pdf->Cell(5,7,': ',0,0);
        $this->checkbox($pdf,$data['serum']);
        $pdf->Cell(20,7,'',0,0);
        $pdf->Cell(20,7,'Tanggal :',0,0);
        $pdf->Cell(60,7,substr($data['date_serum'],0,16),0,1);
      }

      
      if($data['lainnya1'] == '2'){
        $pdf->Cell(5,7,' ',0,0);
        $pdf->Cell(60,7,$data['lainnya1_text'],0,0);
        $pdf->Cell(5,7,': ',0,0);
        $this->checkbox($pdf,$data['lainnya1']);
        $pdf->Cell(20,7,'',0,0);
        $pdf->Cell(20,7,'Tanggal :',0,0);
        $pdf->Cell(60,7,substr($data['date_lainnya1'],0,16),0,1);
      }

      if($data['lainnya2'] == '2'){
        $pdf->Cell(5,7,' ',0,0);
        $pdf->Cell(60,7,$data['lainnya2_text'],0,0);
        $pdf->Cell(5,7,': ',0,0);
        $this->checkbox($pdf,$data['lainnya2']);
        $pdf->Cell(20,7,'',0,0);
        $pdf->Cell(20,7,'Tanggal :',0,0);
        $pdf->Cell(60,7,substr($data['date_lainnya2'],0,16),0,1);
      }
      // $pdf = new FPDF('p','mm','A4');
      // Menambah halaman baru
      $pdf->AddPage('l','A4');
      $pdf->Cell(50,9,' ',0,1);
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(300,7,'G. Riwayat Kontak / Paparan dan Perjalanan Luar Kota',0,1,'C');
      $pdf->Cell(5,7,' ',0,1);
      $pdf->Cell(5,7,'',0,0);
      $pdf->Cell(70,7,'Riwayat kontak / paparan',0,1,'L');
      $pdf->Cell(5,7,' ',0,1);
      $pdf->SetFont('Arial','B',12);
      $pdf->Cell(50,7,'Nama',1,0,'C');
      $pdf->Cell(50,7,'Alamat',1,0,'C');
      $pdf->Cell(30,7,'Hubungan',1,0,'C');
      $pdf->Cell(30,7,'Peunomia',1,0,'C');
      $pdf->Cell(30,7,'Gejala Sama',1,0,'C');
      $pdf->Cell(40,7,'Tanggal Mulai',1,0,'C');
      $pdf->Cell(40,7,'Tanggal Pulang',1,1,'C');
      $pdf->SetFont('Arial','',12);
      foreach($dataKontak as $pi){
  $leng = $pdf->NbLines(50,$pi['alamat']);
  $leng2 = $pdf->NbLines(50,$pi['nama']);
  $leng = max($leng,$leng2);
  $x = $pdf->GetX();
  $y = $pdf->GetY();
  $h=7*$leng;
  $pdf->Rect($x,$y,50,$h);
			//Print the text
	$pdf->MultiCell(50,7,$pi['nama'],0,'L');
  $pdf->SetXY($x+50,$y);
  $pdf->Rect($x+50,$y,50,$h);
  $pdf->MultiCell(50,7,$pi['alamat'],0,'L');
  
  $pdf->SetXY($x+100,$y);
  $pdf->Rect($x+100,$y,30,$h);
  $pdf->MultiCell(30,7,$pi['hubungan'],0,'C');

  $pdf->SetXY($x+130,$y);
  $pdf->Rect($x+130,$y,30,$h);
  $pdf->MultiCell(30,7,$pi['pneunomia_berat'],0,'C');
  
  $pdf->SetXY($x+160,$y);
  $pdf->Rect($x+160,$y,30,$h);
  $pdf->MultiCell(30,7,$pi['sakit_sama'],0,'C');
  
  $pdf->SetXY($x+190,$y);
  $pdf->Rect($x+190,$y,40,$h);
  $pdf->MultiCell(40,7,$pi['tanggal_pertama'],0,'C');
  $pdf->SetXY($x+230,$y);
  $pdf->Rect($x+230,$y,40,$h);
  $pdf->MultiCell(40,7,$pi['tanggal_terakhir'],0,'C');
  $pdf->Ln($h-7);
  }

  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(5,7,'',0,1);
  $pdf->Cell(5,7,'',0,0);
  $pdf->Cell(70,7,'Riwayat perjalanan luar kota',0,1,'L');
  $pdf->Cell(5,7,' ',0,1);
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(60,7,'Negara',1,0,'C');
  $pdf->Cell(60,7,'Kota',1,0,'C');
  $pdf->Cell(40,7,'Tanggal Pergi',1,0,'C');
  $pdf->Cell(40,7,'Tanggal Pulang',1,1,'C');
  
  $pdf->SetFont('Arial','',12);

  foreach($dataTracking as $pi){
    $leng = $pdf->NbLines(60,$pi['negara']);
    $leng2 = $pdf->NbLines(60,$pi['kota']);
    $leng = max($leng,$leng2);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $h=7*$leng;
    $pdf->Rect($x,$y,60,$h);
        //Print the text
    $pdf->MultiCell(60,7,$pi['negara'],0,'L');
    $pdf->SetXY($x+60,$y);
    $pdf->Rect($x+60,$y,60,$h);
    $pdf->MultiCell(60,7,$pi['kota'],0,'L');
    
    $pdf->SetXY($x+120,$y);
    $pdf->Rect($x+120,$y,40,$h);
    $pdf->MultiCell(40,7,$pi['tanggal_pergi'],0,'C');
  
    $pdf->SetXY($x+160,$y);
    $pdf->Rect($x+160,$y,40,$h);
    $pdf->MultiCell(40,7,$pi['tanggal_pulang'],0,'C');
    
    
    $pdf->Ln($h-7);
    }

  $pdf->Output('D',$dataPasien['0']['nama'].'.pdf');
}

 }