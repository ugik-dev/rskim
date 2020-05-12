<?php $this->load->view('Fragment/HeaderFragment',['title' => $title]); ?>

<div class="loginColumns animated fadeInDown">
  <div class="row">
    <!-- <div class="col-md-4">
      <span class="text-center">
        <h3><img class="col-xs-6 col-lg-6 logo" src="<?php echo base_url('assets/img/logo-babel.png');?>"></h3>
        <h3 class="font-bold">DATA BANTUAN TERDAMPAK COVID-19 BABEL</h3>
      </span>
    </div> -->
    <div class="col-md-12">
      <div class="ibox-content">
        <form id="registerForm"  class="m-t" role="form">
          <h3>Registrasi Peserta</h3>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
               <label for="terdata">Username</label> 
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required" autocomplete="username">
              </div>
              <div class="form-group">
              <label for="terdata">Password</label> 
                <input type="password" class="form-control"  id="password" name="password" placeholder="Password" required="required" autocomplete="current-password">
              </div>
              <div class="form-group">
                <label for="terdata">Re-Password</label> 
                  <input type="password" class="form-control"  id="repassword" name="repassword" placeholder="Re-Password" required="required" autocomplete="current-repassword">
              </div>
              <div class="form-group">
              <label for="terdata">Nama Kepala Rumah Tangga</label> 
                  <input type="text" class="form-control" name="nama_krt" placeholder="Nama Kepala Rumah Tangga" required="required" autocomplete="current-password">
                </div>
                <div class="form-group">
              <label for="terdata">Nomor Hp</label> 
                  <input type="number" class="form-control" name="nomorhp" placeholder="Nomor Hp" required="required" autocomplete="current-password">
                </div>
                <div class="form-group">
              <label for="terdata">Email</label> 
                <input type="text" class="form-control" name="email" placeholder="Email" required="required" autocomplete="username">
              </div>
              <div class="form-group">
              <label for="terdata">Pekerjaan</label> 
                  <input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan" required="required" autocomplete="current-password">
                </div>
                <div class="form-group">
              <label for="terdata">Kategori Pasien</label> 
              <select class="form-control mr-sm-2" id="sl_kategori" name="kategori" required="required">
            </select>
                </div>
            </div>



            <div class="col-lg-6">
              <div class="form-group">
                <label for="terdata">NIK (Sesuai KTP)</label> 
                  <input type="number" class="form-control" id="NIK" name="NIK" placeholder="NIK" required="required" autocomplete="current-password">
              </div>
              <div class="form-group">
                <label for="terdata">Nama (Sesuai KTP)</label> 
                <input type="text" class="form-control" name="nama" placeholder="Nama" required="required" autocomplete="">
              </div>
              <div class="form-group">
                <label for="terdata">Jenis Kelamin</label> 
                <select class="form-control mr-sm-2" id="sl_kelamin" name="jenis_kelamin" required="required">
              </select>
               </div>
               <div class="form-group">
              <label for="terdata">Hamil / Pasca Melahirkan</label> 
              <select class="form-control mr-sm-2" id="sl_hamil" name="pasca_hamil" required="required">
              </select>  </div>
              <div class="form-group">
              <label for="terdata">Tempat Lahir</label> 
                  <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required="required" autocomplete="">
                </div>
                <div class="form-group">
              <label for="terdata">Tanggal Lahir (YYYY-MM-DD)</label> 
                  <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir" required="required" autocomplete="">
                </div>
                <div class="form-group">
              <label for="terdata">Kewarganegaraan</label> 
              <select class="form-control mr-sm-2" id="sl_kewarganegaraan" name="kewarganegaraan" required="required">
            </select>
                </div>
                <div class="form-group">
              <label for="terdata">Status Perkawinan</label> 
              <input type="text" class="form-control" name="st_perkawinan" placeholder="Status Perkawinan" required="required" autocomplete="">
              </div>
            </div>
          </div>
          
       

          <div hidden class="form-group">
            <label for="terdata">Instansi Pengurus</label> 
            <select class="form-control mr-sm-2" id="sl_puskesmas" name="id_puskesmas" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label> 
            <textarea rows="4" type="text" placeholder="Alamat" class="form-control" id="alamat" name="alamat" required="required"></textarea>
               </div>
          <div class="form-group">
            <label for="terdata">Kabupaten / Kota</label> 
            <select class="form-control mr-sm-2" id="sl_kab" name="KDKAB" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="terdata">Kecamatan</label> 
            <select class="form-control mr-sm-2" id="sl_kec" name="KDKEC" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="terdata">Desa / Keluarahan</label> 
            <select class="form-control mr-sm-2" id="sl_kel" name="KDKEL" required="required">
            </select>
          </div>
          <button type="submit" id="registerBtn" class="btn btn-primary block full-width m-b" data-loading-text="Register In..." >REGISTRASI</button>   
        </form> 
        
        <p class="m-t">
          <small>@developers</small>
        </p>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-md-6">
          Rumah Sakit Kalbu Intan Medika
      </div>
      <div class="col-md-6 text-right">
          <small>© 2020</small>
          </div>
      </div>
  </div>
</div>
<style>
  .logo {
    flex: 0 0 50%;
    max-width: 50%;
  }
</style>
<script>
  $(document).ready(function() {

    var registerForm = $('#registerForm');
    var submitBtn = registerForm.find('#registerBtn');


    Pass = registerForm.find('#password');
    RePass = registerForm.find('#repassword');
    Kab = registerForm.find('#sl_kab');
    Kec = registerForm.find('#sl_kec');
    Kel = registerForm.find('#sl_kel');
    sl_puskesmas = registerForm.find('#sl_puskesmas');
    sl_kewarganegaraan = registerForm.find('#sl_kewarganegaraan');
    sl_perkawinan = registerForm.find('#sl_perkawinan');
    sl_hamil = registerForm.find('#sl_hamil');
  
    sl_kategori = registerForm.find('#sl_kategori');
    tanggal_lahir = registerForm.find('#tanggal_lahir');
    JenisKelamin = registerForm.find('#sl_kelamin');
    Kab.on('change', (e) => {
      if(Kab.val() != ''){
        Kec.empty();
        Kel.empty();
        getAllKec()
      }else{
        Kec.empty();
        Kel.empty();
      }
    });
    JenisKelamin.on('change', (e) => {
        if(JenisKelamin.val() == 'P'){
        sl_hamil.prop('disabled',false)
      }else{
        sl_hamil.val(''); 
        sl_hamil.prop('disabled',true)     
      }
    });

    Kec.on('change', (e) => {
      if(Kec.val() != ''){
        Kel.empty();
        getAllKel()
      }else{
        Kel.empty();
      }
    });
    var swalRegisConfigure = {
    title: "Konfirmasi Registrasi",
    text: "Yakin data sudah benar?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya, Registrasi!",
  };

  var swalRegisSucces = {
    title: "Registrasi Berhasil",
    text: "Silahkan Aktifasi Melalui Email!",
    type: "success",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Lanjutkan Login",
  };

  // registerForm.submit(function(event){
  //   // event.preventDefault();
  //   // swal(swalSaveConfigure).then((result) => {
  //   //   if(!result.value){ return; }
  //   //   console.log('swal')
  //   // })
  //   // switch(PasienModal.form[0].target){
  //   //   case 'add':
  //   //     addPasien();
  //   //     break;
  //   //   case 'edit':
  //   //     editPasien();
  //   //     break;
  //   // }
  // });

    registerForm.on('submit', (ev) => {
      ev.preventDefault();
      // console.log(tanggal_lahir.val())
      // console.log(RePass.val())
      swal(swalRegisConfigure).then((result) => {
      if(!result.value){ return; }

          if(RePass.val() != Pass.val()){
                swal("Salah", 'Pengulangan Password Salah', "error");
          }else{
           
            buttonLoading(submitBtn);
            $.ajax({
              url: "<?=site_url() . 'register-process'?>",
              type: "POST",
              data: registerForm.serialize(),
              success: (data) => {
                buttonIdle(submitBtn);
                json = JSON.parse(data);
                if(json['error']){
                  swal("Register Gagal", json['message'], "error");
                  return;
                }else{
                  swal(swalRegisSucces).then((result) => {
                  if(!result.value){ return; }
                  $(location).delay(2000).attr('href', '<?=site_url()?>' + 'login');
                  });
                }
              }
               ,
              error: () => {
                buttonIdle(submitBtn);
              }
            });
          }
      });
    });
  });
  getAllKab();
  function getAllKab(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllKab/')?>`, 'type': 'POST',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        // renderKabSelectionFilter(dataRole);
        renderKabOptionFilter(dataRole);
      },
      error: function(e) {}
    });
  }

  function getAllKec(){
    var kab = Kab.val();
    console.log(kab);
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllKec/')?>`, 'type': 'POST',
      data: {kd_kab : kab},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        renderKecOptionFilter(dataRole);
      },
      error: function(e) {}
    });
  }

  function getAllKel(){
    var kab = Kab.val();
    var kec = Kec.val();
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllKel/')?>`, 'type': 'POST',
      data: {kd_kab : kab, kd_kec : kec},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        renderKelOptionFilter(dataRole);
      },
      error: function(e) {}
    });
  }

 getAllPuskesmas();
  function getAllPuskesmas(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllPuskesmas/')?>`, 'type': 'POST',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRole = json['data'];
        // renderKabSelectionFilter(dataRole);
          renderPuskesmas(dataRole);
      },
      error: function(e) {}
    });
  }

  function renderKabOptionFilter(data){
    Kab.empty();
    JenisKelamin.append($('<option>', { value: "", text: "-- Pilih Jenis Kelamin"}));
    JenisKelamin.append($('<option>', { value: "L", text: "Laki-laki"}));
    JenisKelamin.append($('<option>', { value: "P", text: "Perempuan"}));

    sl_hamil.append($('<option>', { value: "", text: ""}));
    sl_hamil.append($('<option>', { value: "Ya", text: "Ya"}));
    sl_hamil.append($('<option>', { value: "Tidak", text: "Tidak"}));

    sl_kategori.append($('<option>', { value: "", text: "-- Pilih Kategori --"}));
    sl_kategori.append($('<option>', { value: "1", text: "Pasien Mandiri"}));
    sl_kategori.append($('<option>', { value: "2", text: "Pasien Asuransi / Perusahaan"}));
    sl_kategori.append($('<option>', { value: "3", text: "Pasien SATGAS"}));

    sl_kewarganegaraan.append($('<option>', { value: "", text: "-- Pilih Kewarganegaraan --"}));
    sl_kewarganegaraan.append($('<option>', { value: "WNI", text: "Warga Negara Indonesia"}));
    sl_kewarganegaraan.append($('<option>', { value: "WNA", text: "Warga Negara Asing"}));

    Kab.append($('<option>', { value: "", text: "-- Pilih Kabupaten --"}));

    Object.values(data).forEach((d) => {
      Kab.append($('<option>', {
        value: d['id_kd_kab'],
        text:  d['nama_kab'],    
      }));
    });
  }

  // JenisKelamin.on('change', (e) => {
  //   // if(JenisKelamin.val() == 'P'){
  //   //   sl_hamil.prop('disabled',false)
  //   // }else{
  //   //   sl_hamil.prop('disabled',true)     
  //   // }
  // });

  function renderKecOptionFilter(data){
    Kec.empty();
    Kec.append($('<option>', { value: "", text: "-- Pilih Kecamatan --"}));
    Object.values(data).forEach((d) => {
      Kec.append($('<option>', {
        value: d['KodeKec'],
        text:  d['Kecamatan'],
        // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
      }));
    });
  }

  function renderPuskesmas(data){
    sl_puskesmas.empty();
    sl_puskesmas.append($('<option>', { value: "", text: "-- Pilih Instansi --"}));
    Object.values(data).forEach((d) => {
      sl_puskesmas.append($('<option>', {
        value: d['id_puskesmas'],
        text:  d['nama_puskesmas'],
        // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
      }));
    });
    sl_puskesmas.val('2');

  }

  function renderKelOptionFilter(data){
    Kel.empty();
    Kel.append($('<option>', { value: "", text: "-- Pilih Kelurahan --"}));
    Object.values(data).forEach((d) => {
      Kel.append($('<option>', {
        value: d['KodeKel'],
        text:  d['Kelurahan'],
      }));
    });
  }



</script>
<style> body { background-color: #f3f3f4!important; } </style>

