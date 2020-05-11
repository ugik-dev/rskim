
<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
<form role="form" id="user_form" onsubmit="return false;" type="multipart" autocomplete="off">
<button style="width: 20%" class="btn btn-success my-3 mr-sm-3" type="submit" id="save_edit_btn" data-loading-text="Loading..."  ><strong>Simpan</strong></button>
 
<input type="hidden" id="id_record" name="id_record">
<input type="hidden" id="id_pasien" name="id_pasien">     
<input type="hidden" id="del_rs" name="del_rs">
<input type="hidden" id="del_dinkes" name="del_dinkes">   
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>A. IDENTITAS PENGIRIM SPESIMEN</h5>
          <div class="form-row">
            <div class="form-check form-check-inline mr-sm-6">
            Pengirim Spesimen
            </div>
          
            <div class="custom-control custom-checkbox  mr-sm-3" >
              <input type="checkbox" class="custom-control-input" id="pengirim_spesimen_rs" name="pengirim_spesimen_rs" value="2">
              <label class="custom-control-label" for="pengirim_spesimen_rs">Rumah Sakit</label>
            </div>
            <div class="custom-control custom-checkbox  mr-sm-3">
              <input type="checkbox" class="custom-control-input" id="pengirim_spesimen_dinkes" name="pengirim_spesimen_dinkes" value="2">
              <label class="custom-control-label" for="pengirim_spesimen_dinkes">Dinas Kesehatan</label>
            </div>
          </div>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Dinas Kesehatan</label>
            <label for="inputEmail3" class="col-sm-1 col-form-label">Kab/Kota</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="dinkes_kab" name="dinkes_kab" placeholder="Kab/Kota">
            </div>
            <label for="inputEmail3" class="col-sm-1 col-form-label">Provinsi</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="dinkes_prov" name="dinkes_prov"  placeholder="Provinsi">
            </div>
          </div>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Rumah Sakit</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="rumah_sakit" name="rumah_sakit" placeholder="Nama Rumah Sakit">
            </div>
            <label for="inputEmail3" class="col-sm-1 col-form-label">Kab/kota</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="rumah_sakit_kab" name="rumah_sakit_kab" placeholder="Kabupaten / Kota">
            </div>
          </div>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Dokter Penanggung Jawab</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="dokter_nama" name="dokter_nama" placeholder="">
             </div>
            <label for="inputEmail3" class="col-sm-1 col-form-label">No Telp/Hp</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="dokter_nomorhp" name="dokter_nomorhp" placeholder="">
            </div>
          </div>
        </div>
      </div>

   
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>B. IDENTITAS PASIEN</h5>
         
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
           
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="nama_pasien" placeholder="Nama Pasien" readonly>
            </div>
            <label for="inputEmail3" class="col-sm-2 col-form-label">No Rekam Medis</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="no_rekam"  name="no_rekam" placeholder="No Rekam Medis">
            </div>
          </div>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" readonly>
            </div>
            <label for="inputEmail3" class="col-sm-2 col-form-label">Usia</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="usia" name="usia" readonly>
            </div>
          </div>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" readonly>
            </div>
            <label for="inputEmail3" class="col-sm-2 col-form-label">Hamil/Pasca Melahirkan</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="hamil" name="hamil" readonly>
            </div>  
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
              <textarea readonly rows="4" type="text" placeholder="Alamat" class="form-control" id="alamat" name="alamat" ></textarea>
         
            </div>
            
            <div class="form-group col-md-4">
              <label for="inputEmail3" class="col-sm-4   col-form-label">No Telepon</label>
              <input type="text" class="form-control" id="nomorhp" readonly>
              <label for="inputEmail3" class="col-sm-4   col-form-label">NIK</label>
              <input type="text" class="form-control" id="nik" readonly>
            </div> 
          </div>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Kepala Keluarga</label>
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="nama_kepala_keluarga" readonly>
            </div>        
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- div C -->

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>C. RIWAYAT PERAWATAN PASIEN DALAM PENGAWASAN COVID 19</h5>
          <div id='c_riwayat'></div>
          </div>
      </div>
    </div>
  </div>
    <!-- end div -->

  <!-- div E -->

  <div class="row">
  <!--  -->
    <div class="col-lg-6">
      <div class="ibox">
        <div class="ibox-content">
          <h5>D. TANDA GEJALA</h5>
          <div class="form-row">
            <label for="inputEmail1" class="col-sm-6 col-form-label">Tanggal onset Gejala</label>
            <div class="col-md-5">
            <!-- <input type="text" class="form-control" id="dokter_nama222" name="dokter_nama2222" placeholder=""> -->
       
              <input type="date" class="form-control" id="tanggal_onset" name="tanggal_onset">
            </div>
          </div> 
          <div class="form-row">
              <label for="inputEmail3" class="col-sm-6 text-right">Panas atau Riwayat Panas >= 38&deg </label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="panas2" value="2" name="panas" class="custom-control-input">
                <label class="custom-control-label" for="panas2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="panas1"  value="1" name="panas" class="custom-control-input">
                <label class="custom-control-label" for="panas1">Tidak</label>
              </div>
          </div> <br>
          <div class="form-row">
              <label for="batuk1" class="col-sm-6 text-right">Batuk</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="batuk2" value="2" name="batuk" class="custom-control-input">
                <label class="custom-control-label" for="batuk2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="batuk1"  value="1" name="batuk" class="custom-control-input">
                <label class="custom-control-label" for="batuk1">Tidak</label>
              </div>
          </div> <br>
          <div class="form-row">
              <label for="sakit_tenggorokan2" class="col-sm-6 text-right">Sakit Tenggorokan</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sakit_tenggorokan2" value="2" name="sakit_tenggorokan" class="custom-control-input">
                <label class="custom-control-label" for="sakit_tenggorokan2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sakit_tenggorokan1"  value="1" name="sakit_tenggorokan" class="custom-control-input">
                <label class="custom-control-label" for="sakit_tenggorokan1">Tidak</label>
              </div>
          </div>
          <br>
          <div class="form-row">
              <label for="sesak_napas2" class="col-sm-6 text-right">Sesak Napas</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sesak_napas2" value="2" name="sesak_napas" class="custom-control-input">
                <label class="custom-control-label" for="sesak_napas2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sesak_napas1"  value="1" name="sesak_napas" class="custom-control-input">
                <label class="custom-control-label" for="sesak_napas1">Tidak</label>
              </div>
          </div> <br>
          <div class="form-row">
              <label for="pilek2" class="col-sm-6 text-right">Pilek</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="pilek2" value="2" name="pilek" class="custom-control-input">
                <label class="custom-control-label" for="pilek2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="pilek1"  value="1" name="pilek" class="custom-control-input">
                <label class="custom-control-label" for="pilek1">Tidak</label>
              </div>
          </div> <br>
          <div class="form-row">
              <label for="lesu2" class="col-sm-6 text-right">Lesu</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="lesu2" value="2" name="lesu" class="custom-control-input">
                <label class="custom-control-label" for="lesu2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="lesu1"  value="1" name="lesu" class="custom-control-input">
                <label class="custom-control-label" for="lesu1">Tidak</label>
              </div>
          </div> <br>
          <div class="form-row">
              <label for="sakit_kepala2" class="col-sm-6 text-right">Sakit Kepala</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sakit_kepala2" value="2" name="sakit_kepala" class="custom-control-input">
                <label class="custom-control-label" for="sakit_kepala2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sakit_kepala1"  value="1" name="sakit_kepala" class="custom-control-input">
                <label class="custom-control-label" for="sakit_kepala1">Tidak</label>
              </div>
          </div> <br>
          <div class="form-row">
              <label for="diare2" class="col-sm-6 text-right">Diare</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="diare2" value="2" name="diare" class="custom-control-input">
                <label class="custom-control-label" for="diare2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="diare1"  value="1" name="diare" class="custom-control-input">
                <label class="custom-control-label" for="diare1">Tidak</label>
              </div>
          </div> <br>
          <div class="form-row">
              <label for="mual_muntah2" class="col-sm-6 text-right">Mual Muntah</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="mual_muntah2" value="2" name="mual_muntah" class="custom-control-input">
                <label class="custom-control-label" for="mual_muntah2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="mual_muntah1"  value="1" name="mual_muntah" class="custom-control-input">
                <label class="custom-control-label" for="mual_muntah1">Tidak</label>
              </div>
          </div>
            <!-- </div> -->
          
        </div>
      </div>
    </div>
<!--  -->
    <div class="col-lg-6">
      <div class="ibox">
        <div class="ibox-content">
          <h5>E. PEMERIKSAAN PENUNJANG</h5>
          <div class="form-row">
              <label for="xray" class="col-sm-3 custom-control">X-Ray Paru</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="xray2" value="2" name="xray" class="custom-control-input">
                <label class="custom-control-label" for="xray2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="xray1"  value="1" name="xray" class="custom-control-input">
                <label class="custom-control-label" for="xray1">Tidak</label>
              </div>
          </div>
          <div class="form-group col-md-12">
              <label for="hasil_xray" class="col-sm-3 col-form-label">Hasil</label>
              <textarea rows="4" type="text" placeholder="" class="form-control" id="hasil_xray" name="hasil_xray" ></textarea>
          </div>
          <h5>Hitung Sel Darah Putih</h5>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Lekousit</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="lekousit"  name="lekousit" placeholder="">
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label"> /ul</label>
          </div>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Limposit</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="limposit"  name="limposit" placeholder="">
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label"> /ul</label>
          </div>
          <div class="form-row">
            <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Trombosit</label>
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="trombosit"  name="trombosit" placeholder="">
            </div>
            <label for="inputEmail3" class="col-sm-4 col-form-label"> /ul</label>
          </div>
          <div class="form-row">
              <label for="ventilator" class="col-sm-4 custom-control">Menggunakan Ventilator</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="ventilator2" value="2" name="ventilator" class="custom-control-input">
                <label class="custom-control-label" for="ventilator2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="ventilator1"  value="1" name="ventilator" class="custom-control-input">
                <label class="custom-control-label" for="ventilator1">Tidak</label>
              </div>
          </div>
          <div class="form-row">
              <label for="status_kesehatan" class="col-sm-12 custom-control">Status kesehatan pasien saat pengambilan Spesimen</label>
              <label for="status_kesehatan2" class="col-sm-3 custom-control"></label>
             <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="status_kesehatan1" value="1" name="status_kesehatan" class="custom-control-input">
                <label class="custom-control-label" for="status_kesehatan1">Pulang</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="status_kesehatan2"  value="2" name="status_kesehatan" class="custom-control-input">
                <label class="custom-control-label" for="status_kesehatan2">Dirawat</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="status_kesehatan3"  value="3" name="status_kesehatan" class="custom-control-input">
                <label class="custom-control-label" for="status_kesehatan3">Meninggal</label>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- div F -->

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>F. PENGAMBILAN SPESIMEN</h5>
          <div class="form-row">
              <label for="usap_nasofaring" class="col-sm-3 text-right">Usap Nasofaring</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="usap_nasofaring2" value="2" name="usap_nasofaring" class="custom-control-input">
                <label class="custom-control-label" for="usap_nasofaring2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="usap_nasofaring1"  value="1" name="usap_nasofaring" class="custom-control-input">
                <label class="custom-control-label" for="usap_nasofaring1">Tidak</label>
              </div>
              <label for="usap_nasofaring" class="col-sm-2 text-right">Tanggal - Pukul</label>
              <div class="form-group col-sm-4">
                <input type="datetime-local" class="form-control" id="date_usap_nasofaring" name="date_usap_nasofaring" placeholder="">
              </div>
            </div>  
            <div class="form-row">
              <label for="usap_orofaring" class="col-sm-3 text-right">Usap Orofaring</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="usap_orofaring2" value="2" name="usap_orofaring" class="custom-control-input">
                <label class="custom-control-label" for="usap_orofaring2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="usap_orofaring1"  value="1" name="usap_orofaring" class="custom-control-input">
                <label class="custom-control-label" for="usap_orofaring1">Tidak</label>
              </div>
              <label for="usap_nasofaring" class="col-sm-2 text-right">Tanggal - Pukul</label>
              <div class="form-group col-sm-4">
                <input type="datetime-local" class="form-control" id="date_usap_orofaring" name="date_usap_orofaring" placeholder="">
              </div>
            </div> 
            <div class="form-row">
              <label for="sputum" class="col-sm-3 text-right">Sputum</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sputum2" value="2" name="sputum" class="custom-control-input">
                <label class="custom-control-label" for="sputum2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="sputum1"  value="1" name="sputum" class="custom-control-input">
                <label class="custom-control-label" for="sputum1">Tidak</label>
              </div>
                <label for="usap_nasofaring" class="col-sm-2 text-right">Tanggal - Pukul</label>
              <div class="form-group col-sm-4">
                <input type="datetime-local" class="form-control" id="date_sputum" name="date_sputum" placeholder="">
              </div>
            </div> 
            <div class="form-row">
              <label for="serum" class="col-sm-3 text-right">Serum / Serologis Sputum</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="serum2" value="2" name="serum" class="custom-control-input">
                <label class="custom-control-label" for="serum2"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="serum1"  value="1" name="serum" class="custom-control-input">
                <label class="custom-control-label" for="serum1">Tidak</label>
              </div>
              <label for="usap_nasofaring" class="col-sm-2 text-right">Tanggal - Pukul</label>
              <div class="form-group col-sm-4">
                <input type="datetime-local" class="form-control" id="date_serum" name="date_serum" placeholder="">
              </div>
          </div>
          <div class="form-row">
              <label for="lainnya1" class="col-sm-1 text-right" >Lainnya </label>
              <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="lainnya1_text"  name="lainnya1_text" placeholder="">
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="lainnya12" value="2" name="lainnya1" class="custom-control-input">
                <label class="custom-control-label" for="lainnya12"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="lainnya11"  value="1" name="lainnya1" class="custom-control-input">
                <label class="custom-control-label" for="lainnya11">Tidak</label>
              </div>
              <label for="usap_nasofaring" class="col-sm-2 text-right">Tanggal - Pukul</label>
              <div class="form-group col-sm-4">
                <input type="datetime-local" class="form-control" id="date_lainnya1" name="date_lainnya1" placeholder="">
              </div>
          </div>
          <div class="form-row">
              <label for="lainnya2" class="col-sm-1 text-right" >Lainnya </label>
              <div class="form-group col-sm-2">
                <input type="text" class="form-control" id="lainnya2_text"  name="lainnya2_text" placeholder="">
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="lainnya22" value="2" name="lainnya2" class="custom-control-input">
                <label class="custom-control-label" for="lainnya22"> Ya</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="lainnya21"  value="1" name="lainnya2" class="custom-control-input">
                <label class="custom-control-label" for="lainnya21">Tidak</label>
              </div>
              <label for="usap_nasofaring" class="col-sm-2 text-right">Tanggal - Pukul</label>
              <div class="form-group col-sm-4">
                <input type="datetime-local" class="form-control" id="date_lainnya2" name="date_lainnya2" placeholder="">
              </div>
          </div>

        </div>
      </div>
    </div>
  </div>
    <!-- end div -->
      <!-- div G -->

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>G. RIWAYAT KONTAK / PAPARAN</h5>
          TABEL HERE
        </div>
      </div>
    </div>
  </div>
    <!-- end div -->
          <!-- div G -->

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>H. KESIMPULAN</h5>
          <div class="form-row">
            
            
            <div class="form-group col-md-4">
              <div class ="form-group">
                <label for="before_status">Status Awal</label>
                <select class="form-control mr-sm-2" id="before_status" required="required" readonly>
                </select>
              </div>
              <div class ="form-group">
                <label for="before_status">Status Kesimpulan</label>
                <select class="form-control mr-sm-2" id="after_status" name="after_status" required="required">
                </select>
              </div>
            </div> 

            <div class="form-group col-md-8">
              <label for="inputEmail3" class="col-sm-8 col-form-label">Kesimpulan / Catatan</label>
              <textarea rows="7" type="text" placeholder="Kesimpulan" class="form-control" id="deskripsi" name="deskripsi" ></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- end div -->
        </form>
    <!-- end div -->
  </div>
<script>
$(document).ready(function() {
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);
  getAllStatus();  
  var id_record = `<?=$contentData['id_record']?>`;
  var dataRecord = [];
  var dataPasien = [];
  btnUpdate = $('#save_edit_btn');
  form = $('#user_form');
  
  form.submit(function(event){
    console.log(info.tanggal_onset.val())
    buttonLoading(btnUpdate);
    $.ajax({
          url: "<?=site_url('DinkesController/editRecord')?>", 'type': 'POST',
          data: form.serialize(),
          success: function (data){
            buttonIdle(btnUpdate);
            var json = JSON.parse(data);
            if(json['error']){
              swal("Simpan Gagal", json['message'], "error");
              return;
            }
            var record = json['data']
            getRecord();
            swal("Simpan Berhasil", "", "success");
          },
          error: function(e) {}
        });
  });
  function function_check_rs(){
    console.log('activecek')
  }
  // console.log(id_pasien)
 

  if(sessionData['id_role'] != 2){
    // info.edit_info_btn.hide();
    btnUpdate.hide();
  }

    $('#edit_bantuan').on('click', function(){
        informasiModal.self.modal('show');
        informasiModal.ID_edit.val(dataInfo['ID']);
        informasiModal.kd_jenis_bantuan.val(dataInfo['jenis_bantuan']);
    });
  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3, 4], className: 'text-center'}, ],
    deferRender: true,
    'ordering': false,
    'paging': false,
    'searching': false
  });

  var info = {
    'id_pasien': $('#info_container').find('#id_pasien'),
    'id_record': $('#info_container').find('#id_record'),
    'del_rs': $('#info_container').find('#del_rs'),
    'del_dinkes': $('#info_container').find('#del_dinkes'),
    'c_riwayat': $('#info_container').find('#c_riwayat'),
    'self': $('#info_container'),
    'pengirim_spesimen_rs': $('#info_container').find('#pengirim_spesimen_rs'),
    'pengirim_spesimen_dinkes': $('#info_container').find('#pengirim_spesimen_dinkes'),
    'dinkes_kab': $('#info_container').find('#dinkes_kab'),
    'dinkes_prov': $('#info_container').find('#dinkes_prov'),
    'rumah_sakit': $('#info_container').find('#rumah_sakit'),
    'rumah_sakit_kab': $('#info_container').find('#rumah_sakit_kab'),
    'dokter_nama': $('#info_container').find('#dokter_nama'),
    'dokter_nomorhp': $('#info_container').find('#dokter_nomorhp'),

    'nama_pasien': $('#info_container').find('#nama_pasien'),
    'no_rekam': $('#info_container').find('#no_rekam'),
    'tanggal_lahir': $('#info_container').find('#tanggal_lahir'),
    'usia': $('#info_container').find('#usia'),
    'jenis_kelamin': $('#info_container').find('#jenis_kelamin'),
    'hamil': $('#info_container').find('#hamil'),
    'alamat': $('#info_container').find('#alamat'),
    'nomorhp': $('#info_container').find('#nomorhp'),
    'nik': $('#info_container').find('#nik'),
    'nama_kepala_keluarga': $('#info_container').find('#nama_kepala_keluarga'),

    'tanggal_onset': $('#info_container').find('#tanggal_onset'),
    'hasil_xray': $('#info_container').find('#hasil_xray'),
    'xray2': $('#info_container').find('#xray2'),
    'xray1': $('#info_container').find('#xray1'),
    'lekousit': $('#info_container').find('#lekousit'),
    'limposit': $('#info_container').find('#limposit'),
    'trombosit': $('#info_container').find('#trombosit'),
    'date_usap_nasofaring': $('#info_container').find('#date_usap_nasofaring'),
    'date_usap_orofaring': $('#info_container').find('#date_usap_orofaring'),
    'date_sputum': $('#info_container').find('#date_sputum'),
    'date_serum': $('#info_container').find('#date_serum'),
    'date_lainnya1': $('#info_container').find('#date_lainnya1'),
    'date_lainnya2': $('#info_container').find('#date_lainnya2'),
    'lainnya1_text': $('#info_container').find('#lainnya1_text'),
    'lainnya2_text': $('#info_container').find('#lainnya2_text'),
    'before_status': $('#info_container').find('#before_status'),
    'after_status': $('#info_container').find('#after_status'),
    'deskripsi': $('#info_container').find('#deskripsi'),
  }

//   var currentValue = 0;
// function handleClick(xray) {
//    console.log('j') // alert('Old value: ' + currentValue);
//     // alert('New value: ' + myRadio.value);
//     // currentValue = myRadio.value;
// }
// document.getElementsByName("xray").on('click', function () {
// console.log('babi');
// });

  $(document).on('click', '[name="xray"]', function () {
      if( document.getElementById("xray2").checked == true){
        info.hasil_xray.prop('disabled', false);
        info.hasil_xray.val(dataRecord['hasil_xray']);
      }else{
        info.hasil_xray.prop('disabled', true);
        info.hasil_xray.val("");
      }
  });
function convertDateTime(date){
  // var datecur = current['tanggal_record']
    var res = date.substr(0,10);
    var res2 = date.substr(11,5);
    return res+'T'+res2;
}

function convertDateTime2(date){
  //  = '2020-04-20 13:13:00';
  var bulan = ['Januari','Februari','Maret',
  'April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
  ]
  var hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum`at','Sabtu']
  // var datecur = current['tanggal_record']
    var res = date.substr(0,10);
    var thun = date.substr(0,4);
    var res2 = date.substr(11,5);
    var tanggal = new Date(res).getDate();
    var _hari = new Date(res).getDay();
    var _bulan = new Date(res).getMonth();
    var bulan_ = bulan[_bulan]
    var hari_ = hari[_hari]
    var ret = hari_+', '+tanggal+' '+bulan_+' '+thun+' - '+res2;
    return ret;
}
  function renderRecord(){
    // info.jenis_bantuan.html(`${colorBantuan(dataInfo['jenis_bantuan'])}`);
   
    if(dataRecord['pengirim_spesimen_rs'] == '2'){
      document.getElementById("pengirim_spesimen_rs").checked = true;
    }
    if(dataRecord['pengirim_spesimen_dinkes'] == '2'){
      document.getElementById("pengirim_spesimen_dinkes").checked = true;
    }

    info.id_pasien.val(dataRecord['id_pasien']);
    info.id_record.val(dataRecord['id_record']);
    info.before_status.val(dataRecord['before_status']);
    info.after_status.val(dataRecord['after_status']? dataRecord['after_status'] : dataRecord['before_status'] );
    info.deskripsi.val(dataRecord['deskripsi']);
    info.dinkes_kab.val(dataRecord['dinkes_kab']);
    info.dinkes_prov.val(dataRecord['dinkes_prov']);
    info.rumah_sakit.val(dataRecord['rumah_sakit']);
    info.rumah_sakit_kab.val(dataRecord['rumah_sakit_kab']);
    info.dokter_nama.val(dataRecord['dokter_nama']);
    info.dokter_nomorhp.val(dataRecord['dokter_nomorhp']);

    info.nama_pasien.val(dataPasien['nama']);
    info.no_rekam.val(dataRecord['no_rekam']);
    info.tanggal_lahir.val(dataPasien['tanggal_lahir']);
    info.jenis_kelamin.val(dataPasien['jenis_kelamin']);
    info.usia.val(getAge(dataPasien['tanggal_lahir']));
    info.hamil.val(dataPasien['hamil']);
    info.alamat.val(dataPasien['alamat']+'\n'+dataPasien['nama_kel']+', '+dataPasien['nama_kec']+', '+dataPasien['nama_kab']);
    info.nomorhp.val(dataPasien['nomorhp']);
    info.nik.val(dataPasien['NIK']);
    info.nama_kepala_keluarga.val(dataPasien['nama_kepala_keluarga']);
    info.lekousit.val(dataRecord['lekousit']);
    info.limposit.val(dataRecord['limposit']);
    info.trombosit.val(dataRecord['trombosit']);

    info.tanggal_onset.val(dataRecord['tanggal_onset']);
    if(dataRecord['panas'] == '2'){
      document.getElementById("panas2").checked = true;
    }else{
      document.getElementById("panas1").checked = true;
    }
    if(dataRecord['batuk'] == '2'){
      document.getElementById("batuk2").checked = true;
    }else{
      document.getElementById("batuk1").checked = true;
    }
    if(dataRecord['sakit_tenggorokan'] == '2'){
      document.getElementById("sakit_tenggorokan2").checked = true;
    }else{
      document.getElementById("sakit_tenggorokan1").checked = true;
    }
    if(dataRecord['sesak_napas'] == '2'){
      document.getElementById("sesak_napas2").checked = true;
    }else{
      document.getElementById("sesak_napas1").checked = true;
    }
    if(dataRecord['pilek'] == '2'){
      document.getElementById("pilek2").checked = true;
    }else{
      document.getElementById("pilek1").checked = true;
    }
    if(dataRecord['lesu'] == '2'){
      document.getElementById("lesu2").checked = true;
    }else{
      document.getElementById("lesu1").checked = true;
    }
    if(dataRecord['sakit_kepala'] == '2'){
      document.getElementById("sakit_kepala2").checked = true;
    }else{
      document.getElementById("sakit_kepala1").checked = true;
    }
    if(dataRecord['diare'] == '2'){
      document.getElementById("diare2").checked = true;
    }else{
      document.getElementById("diare1").checked = true;
    }
    if(dataRecord['mual_muntah'] == '2'){
      document.getElementById("mual_muntah2").checked = true;
    }else{
      document.getElementById("mual_muntah1").checked = true;
    }
    if(dataRecord['xray'] == '2'){
      document.getElementById("xray2").checked = true;
      info.hasil_xray.prop('disabled', false);
      info.hasil_xray.val(dataRecord['hasil_xray']);
    }else{
      document.getElementById("xray1").checked = true;
      info.hasil_xray.prop('disabled', true);
    }
    if(dataRecord['ventilator'] == '2'){
      document.getElementById("ventilator2").checked = true;
    }else{
      document.getElementById("ventilator1").checked = true;
    }

    if(dataRecord['status_kesehatan'] == '3'){
      document.getElementById("status_kesehatan3").checked = true;
    }else if(dataRecord['status_kesehatan'] == '2'){
      document.getElementById("status_kesehatan2").checked = true;
    }else{
      document.getElementById("status_kesehatan1").checked = true;
    }

    if(dataRecord['usap_nasofaring'] == '2'){
      document.getElementById("usap_nasofaring2").checked = true;
      info.date_usap_nasofaring.prop('disabled', false);
      info.date_usap_nasofaring.val(convertDateTime(dataRecord['date_usap_nasofaring']));
    }else{
      document.getElementById("usap_nasofaring1").checked = true;
      info.date_usap_nasofaring.prop('disabled', true);
    }

    if(dataRecord['usap_orofaring'] == '2'){
      document.getElementById("usap_orofaring2").checked = true;
      info.date_usap_orofaring.prop('disabled', false);
      info.date_usap_orofaring.val(convertDateTime(dataRecord['date_usap_orofaring']));
    }else{
      document.getElementById("usap_orofaring1").checked = true;
      info.date_usap_orofaring.prop('disabled', true);
    }

    if(dataRecord['sputum'] == '2'){
      document.getElementById("sputum2").checked = true;
      info.date_sputum.prop('disabled', false);
      info.date_sputum.val(convertDateTime(dataRecord['date_sputum']));
    }else{
      document.getElementById("sputum1").checked = true;
      info.date_sputum.prop('disabled', true);
    }

    if(dataRecord['serum'] == '2'){
      document.getElementById("serum2").checked = true;
      info.date_serum.prop('disabled', false);
      info.date_serum.val(convertDateTime(dataRecord['date_serum']));
    }else{
      document.getElementById("serum1").checked = true;
      info.date_serum.prop('disabled', true);
    }

    if(dataRecord['lainnya1'] == '2'){
      document.getElementById("lainnya12").checked = true;
      info.date_lainnya1.prop('disabled', false);
      info.lainnya1_text.prop('disabled', false);
      info.date_lainnya1.val(convertDateTime(dataRecord['date_lainnya1']));
      info.lainnya1_text.val(dataRecord['lainnya1_text']);
    }else{
      document.getElementById("lainnya11").checked = true;
      info.date_lainnya1.prop('disabled', true);
      info.lainnya1_text.prop('disabled', true);
    }

    if(dataRecord['lainnya2'] == '2'){
      document.getElementById("lainnya22").checked = true;
      info.date_lainnya2.prop('disabled', false);
      info.lainnya2_text.prop('disabled', false);
      info.date_lainnya2.val(convertDateTime(dataRecord['date_lainnya2']));
      info.lainnya2_text.val(dataRecord['lainnya2_text']);
    }else{
      document.getElementById("lainnya21").checked = true;
      info.date_lainnya2.prop('disabled', true);
      info.lainnya2_text.prop('disabled', true);
    }
 }
  $(document).on('click', '[name="usap_nasofaring"]', function () {
      if( document.getElementById("usap_nasofaring2").checked == true){
        info.date_usap_nasofaring.prop('disabled', false);
        info.date_usap_nasofaring.val(convertDateTime(dataRecord['date_usap_nasofaring']));
      }else{
        info.date_usap_nasofaring.prop('disabled', true);
        info.date_usap_nasofaring.val(null);
      }
  });

  $(document).on('click', '[name="usap_orofaring"]', function () {
      if( document.getElementById("usap_orofaring2").checked == true){
        info.date_usap_orofaring.prop('disabled', false);
        info.date_usap_orofaring.val(convertDateTime(dataRecord['date_usap_orofaring']));
      }else{
        info.date_usap_orofaring.prop('disabled', true);
        info.date_usap_orofaring.val(null);
      }
  });

  $(document).on('click', '[name="sputum"]', function () {
      if( document.getElementById("sputum2").checked == true){
        info.date_sputum.prop('disabled', false);
        info.date_sputum.val(convertDateTime(dataRecord['date_sputum']));
      }else{
        info.date_sputum.prop('disabled', true);
        info.date_sputum.val(null);
      }
  });

  $(document).on('click', '[name="serum"]', function () {
      if( document.getElementById("serum2").checked == true){
        info.date_serum.prop('disabled', false);
        info.date_serum.val(convertDateTime(dataRecord['date_serum']));
      }else{
        info.date_serum.prop('disabled', true);
        info.date_serum.val(null);
      }
  });

  $(document).on('click', '[name="lainnya1"]', function () {
      if( document.getElementById("lainnya12").checked == true){
        info.date_lainnya1.prop('disabled', false);
        info.date_lainnya1.val(convertDateTime(dataRecord['date_lainnya1']));
        info.lainnya1_text.prop('disabled', false);
        info.lainnya1_text.val(dataRecord['lainnya1_text']);
      }else{
        info.date_lainnya1.prop('disabled', true);
        info.date_lainnya1.val(null);
        info.lainnya1_text.prop('disabled', true);
        info.lainnya1_text.val(" ");
      }
  });

  $(document).on('click', '[name="lainnya2"]', function () {
      if( document.getElementById("lainnya22").checked == true){
        info.date_lainnya2.prop('disabled', false);
        info.date_lainnya2.val(convertDateTime(dataRecord['date_lainnya2']));
        info.lainnya2_text.prop('disabled', false);
        info.lainnya2_text.val(dataRecord['lainnya2_text']);
      }else{
        info.date_lainnya2.prop('disabled', true);
        info.date_lainnya2.val(null);
        info.lainnya2_text.prop('disabled', true);
        info.lainnya2_text.val(" ");
      }
  });

  $(document).on('click', '[name="pengirim_spesimen_rs"]', function () {
      if( document.getElementById("pengirim_spesimen_rs").checked == false){
         info.del_rs.val('1');
      }else{
        info.del_rs.val('');
      }
  });

  $(document).on('click', '[name="pengirim_spesimen_dinkes"]', function () {
      if( document.getElementById("pengirim_spesimen_dinkes").checked == false){
         info.del_dinkes.val('1');
      }else{
        info.del_dinkes.val('');
      }
  });


  
  function getAllStatus(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllStatusOption/')?>`, 'type': 'GET',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataJenis = json['data'];
        renderStatusSelection(dataJenis);
      },
      error: function(e) {}
    });
  }

  function renderStatusSelection(data){
    info.after_status.empty();
    info.after_status.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
    Object.values(data).forEach((d) => {
      info.after_status.append($('<option>', {
        value: d['id_status'],
        text: d['id_status'] + ' :: ' + d['nama_status'],
      }));
    });

    info.before_status.empty();
    info.before_status.append($('<option>', { value: "", text: "-- Pilih Status --"}));
    Object.values(data).forEach((d) => {
      info.before_status.append($('<option>', {
        value: d['id_status'],
        text: d['id_status'] + ' :: ' + d['nama_status'],
      }));
    });
  }

function getAge(date) {
  var d = Date.parse(date);
    e = Date.parse(Date());
    f = Math.floor((e-d)/86400000/365);
    g = (e-d)/1000/86400%365;
    g = Math.floor(g/30)
    hasil = " "+f+ " Tahun "+g+" Bulan";
    return hasil;
}


  // function renderRecord(data){
  //   if(data == null || typeof data != "object"){
  //     console.log("User::UNKNOWN DATA");
  //     return;
  //   }
  //   var i = 0;
    
  //   var renderData = [];
  //   Object.values(data).forEach((record) => {
  //     var detailButton = `<a href="<?=site_url("DinkesController/DetailRecord/")?>?id_record=${record['id_record']}" class="dropdown-item"><i class='fa fa-pencil'></i> Detail Info </a>`;
    
  //     var deleteButton = `
  //       <a class="delete dropdown-item" data-id='${record['id_record']}'><i class='fa fa-trash'></i> Hapus Record</a>
  //     `;
  //     var editButton = `
  //       <a class="edit dropdown-item" data-id='${record['id_record']}'><i class='fa fa-pencil'></i> Edit Record</a>
  //     `;
  //     var button = `
  //       <div class="btn-group" opd="group">
  //         <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
  //         <div class="dropdown-menu" aria-labelledby="action">
  //           ${detailButton}
  //           ${editButton}
  //           ${deleteButton}
  //         </div>
  //       </div>
  //     `;
  //   //   var no_hp = record['no_hp_tim'] ? record['no_hp_tim'] : 'Tidak Ada';
  //   //   var photo = record['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${record['photo_tim']}" class="img-sm">` : 'Tidak Ada';
  //     renderData.push([record['no_rekam'], convStatus(record['result_status']), record['rumah_sakit'],record['tanggal_record'],button]);
  //   });
  //   FDataTable.clear().rows.add(renderData).draw('full-hold');
  // }

//   recordModal.form.submit(function(event){
//     event.preventDefault();
//     switch(recordModal.form[0].target){
//       case 'add':
//         addRecord();
//         break;
//       case 'edit':
//         editRecord();
//         break;
//     }
//   });

//       function addRecord(){
//       swal('Tambah Record').then((result) => {
//         if(!result.value){ return; }
//         buttonLoading(recordModal.addBtn);
//         $.ajax({
//           url: "<?=site_url('DinkesController/addRecord')?>", 'type': 'POST',
//           data: recordModal.form.serialize(),
//           success: function (data){
//             buttonIdle(recordModal.addBtn);
//             var json = JSON.parse(data);
//             if(json['error']){
//               swal("Simpan Gagal", json['message'], "error");
//               return;
//             }
//             var record = json['data']
//             // console.log(record)
//             dataRecord[record['id_record']] = record;
//             swal("Simpan Berhasil", "", "success");
//             renderRecord(dataRecord);
//             getInfo();
//             recordModal.self.modal('hide');
//           },
//           error: function(e) {}
//         });
//       });
//     }

//     function editRecord(){
//       swal('Edit Record').then((result) => {
//         if(!result.value){ return; }
//         buttonLoading(recordModal.saveEditBtn);
//         $.ajax({
//           url: "<?=site_url('DinkesController/editRecord')?>", 'type': 'POST',
//           data: recordModal.form.serialize(),
//           success: function (data){
//             buttonIdle(recordModal.saveEditBtn);
//             var json = JSON.parse(data);
//             if(json['error']){
//               swal("Simpan Gagal", json['message'], "error");
//               return;
//             }
//             var record = json['data']
//             // console.log(record)
//             dataRecord[record['id_record']] = record;
//             swal("Simpan Berhasil", "", "success");
//             renderRecord(dataRecord);
//             getInfo();
//             recordModal.self.modal('hide');
//           },
//           error: function(e) {}
//         });
//       });
//     }
  

//   FDataTable.on('click','.delete', function(){
//     event.preventDefault();
//     var id = $(this).data('id');
//     swal(swalDeleteConfigure).then((result) => {
//       if(!result.value){ return; }
//       $.ajax({
//         url: "<?=site_url('DinkesController/deleteRecord')?>", 'type': 'POST',
//         data: {'id_record': id},
//         success: function (data){
//           var json = JSON.parse(data);
//           if(json['error']){
//             swal("Delete Gagal", json['message'], "error");
//             return;
//           }
//           delete dataRecord[id];
//           swal("Delete Berhasil", "", "success");
//           renderRecord(dataRecord);
//         },
//         error: function(e) {}
//       });
//     });
//   });

//   FDataTable.on('click','.edit', function(){
//     recordModal.form.trigger('reset');
//     recordModal.self.modal('show');
//     recordModal.id_pasien_rec.val(dataInfo['id_pasien']);
//     recordModal.saveEditBtn.show();
//     recordModal.addBtn.hide();
//     var id = $(this).data('id');
//     var current = dataRecord[id];
//     console.log(current);
//     recordModal.id_record.val(current['id_record']);
//     recordModal.deskripsi.val(current['deskripsi']);
//     recordModal.result_status.val(current['result_status']);
//     recordModal.no_rekam.val(current['no_rekam']);
//     recordModal.rumah_sakit.val(current['rumah_sakit']);
//     var datecur = current['tanggal_record']
//     var res = datecur.substr(0,10);
//     var res2 = datecur.substr(11,5);
//     console.log(res+'T'+res2)
//     recordModal.tanggal_record.val(res+'T'+res2);

//   });

//   // getJenisBantuan()
//   function getJenisBantuan(){
//     return $.ajax({
//         url: `<?php echo site_url('SharedController/getJenisBantuan/')?>`, 
//         data : {},
//         type: 'GET',
//       success: function (data){
//         var json = JSON.parse(data);
//         if(json['error']){
//           return;
//         }
//         data = json['data'];
//         renderJenisBantuan(data)
//       },
//       error: function(e) {}, 
//     });
//   }

//   function renderJenisBantuan(data){
//     informasiModal.kd_jenis_bantuan.empty();
//     informasiModal.kd_jenis_bantuan.append($('<option>', { value: "0", text: "Pilih Jenis Bantuan"}));
//     Object.values(data).forEach((d) => {
//         informasiModal.kd_jenis_bantuan.append($('<option>', {
//         value: d['id_jenis_bantuan'],
//         text:  d['id_jenis_bantuan'] + " :: " + d['nama_jenis_bantuan'] ,
//       }));
//     });
//   }

//   getAllStatus();  
//   function getAllStatus(){
//     return $.ajax({
//       url: `<?php echo site_url('SharedController/getAllStatusOption/')?>`, 'type': 'GET',
//       data: {},
//       success: function (data){
//         var json = JSON.parse(data);
//         if(json['error']){
//           return;
//         }
//         dataJenis = json['data'];
//         renderStatusSelection(dataJenis);
//       },
//       error: function(e) {}
//     });
//   }

//   function renderStatusSelection(data){
//     PasienModal.id_status.empty();
//     PasienModal.id_status.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
//     Object.values(data).forEach((d) => {
//       PasienModal.id_status.append($('<option>', {
//         value: d['id_status'],
//         text: d['id_status'] + ' :: ' + d['nama_status'],
//       }));
//     });

//     recordModal.result_status.empty();
//     recordModal.result_status.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
//     Object.values(data).forEach((d) => {
//       recordModal.result_status.append($('<option>', {
//         value: d['id_status'],
//         text: d['id_status'] + ' :: ' + d['nama_status'],
//       }));
//     });
//   }
  getRecord()
  function getRecord(){
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllRecord/')?>`, 
        data : {id_record: id_record},
        type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRecord = json['data'][id_record];
        if(dataRecord != 'NULL'){
        console.log(dataRecord)
        getPasien(dataRecord['id_pasien'])
        }else{
        //   info.st_terdata.html(`Tidak Terdata`);
        }
      },
      error: function(e) {}, 
    });
  }


  function getAllRecord(idPasien){
    //  is_self : id_record
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllRecord/')?>`, 
        data : {id_pasien: idPasien,},
        type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataAllRecord = json['data'];
        if(dataAllRecord != 'NULL'){
        // console.log(dataAllRecord)
        renderAllRecord(dataAllRecord);
        }else{
        
        }
      },
      error: function(e) {}, 
    });
  }


  function getPasien(idPasien){
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllPasien_v2/')?>`, 'type': 'GET',
       data : {id_pasien: idPasien},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataPasien = json['data']['0'];
        renderRecord(dataRecord);
        getAllRecord(dataPasien['id_pasien']);
      },
      error: function(e) {}
    });
  }

  function renderAllRecord(data){
    htmlinner = "";
    i = 1;
    Object.values(data).forEach((d) => {
      htmlinner +=`
            <div class="form-row">
              <label for="inputEmail3" class="col-sm-1 col-form-label"> Ke- ${i}</label>
              <div class="form-group col-md-3">
                <input type="text" class="form-control" value="${convertDateTime2(d['tanggal_record'])}" readonly>
              </div>
              <label for="inputEmail3" class="col-sm-1 col-form-label">Rumah Sakit</label>
              <div class="form-group col-md-3">
              <input type="text" class="form-control" value="${d['rumah_sakit']+', '+d['rumah_sakit_kab']}" readonly>
              </div>
              <label for="inputEmail3" class="col-sm-1 col-form-label">Hasil</label>
              <div class="form-group col-md-3">
              <input type="text" class="form-control" value="${converStatus(d['after_status'])}" readonly>
              </div>
            </div>`;
            i++;
    });
    info.c_riwayat.html(htmlinner);
  }

  function converStatus(st){
    if(st == '1'){
      return 'OTG';
    }else if(st == '2'){
      return 'ODP';
    }else if(st == '3'){
      return 'PDP';
    }else if(st == '4'){
      return 'POSITIF';
    }else if(st == '5'){
      return 'NEGATIF'
    }else{
      return 'on prosses'
    }
  }
//   function renderRecordSelection(data){
//     if(data == null || typeof data != "object") return;
//     recordModal.list_tim.typeahead({ 
//       source: Object.values(data).map((e) => {
//         return `${e['nama']} (${e['nip']}) -- ${e['id_user']}`;
//       }),
//       afterSelect: function(data){
//         var id = data.split(" -- ")[1];
//         var user = dataUser[id];
//         recordModal.id_user.val(user['id_user']);
//         recordModal.photo_tim.attr('src', user['photo']);
//       }
//     });
//     recordModal.list_tim.on('blur', function(e){
//       if(empty(recordModal.list_tim.val())) {
//         recordModal.id_user.val('');
//         recordModal.photo_tim.attr('src', null);
//       }
//     });
//   }

//   info.add_record_btn.on('click', function(){
//     recordModal.form.trigger('reset');
//     recordModal.self.modal('show');
//     recordModal.id_pasien_rec.val(dataInfo['id_pasien']);
//     recordModal.saveEditBtn.hide();
//     recordModal.addBtn.show();
//     recordModal.result_status.val(dataInfo['status']);
//     // recordModal.NO.val(dataInfo['NO']);
//   });
  
//   info.edit_info_btn.on('click', function(){
//     // informasiModal.self.modal('show');
//     // informasiModal.NO.val(dataInfo['NO']);
//     // informasiModal.lokasi.val(dataInfo['lokasi']);

//     event.preventDefault();
//     PasienModal.form.trigger('reset');
//     PasienModal.self.modal('show');
//     PasienModal.addBtn.hide();
//     PasienModal.saveEditBtn.show();

//     PasienModal.id_pasien.val(dataInfo['id_pasien']);
//     PasienModal.nama.val(dataInfo['nama']);
//     PasienModal.nik.val(dataInfo['nik']);
//     PasienModal.jumlah_kamar.val(dataInfo['jumlah_kamar']);
//     PasienModal.jumlah_tempat_tidur.val(dataInfo['jumlah_tempat_tidur']);
//     PasienModal.file.val(dataInfo['file']);
//     PasienModal.lokasi.val(dataInfo['lokasi']);
//     PasienModal.deskripsi.val(dataInfo['deskripsi']);
//     PasienModal.terdata.val(dataInfo['tahun_terdata']);

//     // info.nama.html(`${dataInfo['nama']}`);
//     // info.nik.html(`${dataInfo['NIK']}`);
//     // info.alamat.html(`${dataInfo['alamat'] }`);
//     // info.tempat_cek.html(`${dataInfo['tempat_cek']}`);
  
//     // info.jumlah_cek.html(`${dataInfo['jumlah_cek']}`);
//     // info.status.html(`${dataInfo['status']}`);
//     // info.active.html(`${dataInfo['active']}`);
//     // info.nama_kab.html(`${dataInfo['nama_kab']}`);
//     // info.nama_kec.html(`${dataInfo['nama_kec']}`);
//     // info.nama_kel.html(`${dataInfo['nama_kel']}`);
//     // info.nomorhp.html(`${dataInfo['nomorhp']}`);
//     // info.email.html(`${dataInfo['email']}`);

//   });

//   informasiModal.form.on('submit', (ev) => {
//     ev.preventDefault();
//     buttonLoading(informasiModal.save_btn);
//     $.ajax({
//       url: "<?=site_url('DTKSController/editDTKSRT/')?>",
//       type: "POST",
//       data: informasiModal.form.serialize(),
//       success: (data) => {
//         buttonIdle(informasiModal.save_btn);
//         json = JSON.parse(data);
//         if(json['error']){
//           swal("Tambah Bantuan Gagal", json['message'], "error");
//           return;
//         } 
//         dataInfo = json['data']['0'];
//         renderInfo();
//         getTim();
//         swal("Berhasil Tambah Bantuan", 'Input Informasi Berhasil', "success");
//         informasiModal.self.modal('hide');
//       },
//       error: () => {
//         buttonIdle(informasiModal.save_btn);
//       },
//     });
//   });
});
</script>