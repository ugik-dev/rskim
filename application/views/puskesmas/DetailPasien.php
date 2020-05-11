<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Nama</h5>
            <p class="no-margins"><span id="nama">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>NIK</h5>
            <p class="no-margins"><span id="nik">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Status</h5>
          <p class="no-margins"><span id="status">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Nomor Hp</h5>
            <p class="no-margins"><span id="nomorhp">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Email</h5>
            <p class="no-margins"><span id="email">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
            <h5>Jenis Kelamin</h5>
            <p class="no-margins"><span id="jenis_kelamin">-</span></p>
        </div>
      </div>
    </div>
   
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Tempat Lahir</h5>
            <p class="no-margins"><span id="tempat_lahir">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Tanggal Lahir</h5>
            <p class="no-margins"><span id="tanggal_lahir">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Usia</h5>
            <p class="no-margins"><span id="usia">-</span></p>
          </div>
        </div>
      </div>
      
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Alamat</h5>
          <p class="no-margins"><span id="alamat">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Tempat Cek Kesehatan</h5>
          <p class="no-margins"><span id="tempat_cek">-</span></p>
        </div>
      </div>
    </div>
 
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Total Cek</h5>
          <p class="no-margins"><span id="jumlah_cek">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Status Akun</h5>
          <p class="no-margins"><span id="active">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Kabupaten</h5>
            <p class="no-margins"><span id="nama_kab">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Kecamatan</h5>
            <p class="no-margins"><span id="nama_kec">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <div class="ibox-content">
            <h5>Keluarahan / Desa</h5>
            <p class="no-margins"><span id="nama_kel">-</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="ibox">
          <!-- <div class=""> -->
          <button class="btn btn-success my-1 mr-sm-2" id="edit_info_btn"><i class='fa fa-edit'></i> Edit Informasi</button>
          <button class="btn btn-success my-1 mr-sm-2" id="add_record_btn"><i class='fa fa-plus'></i> Tambah Record</button>
   
          <!-- </div> -->
        </div>
      </div>
      </div>
    </div>
    <div class="row">
    <div class="col-lg-4">
     </div>
  </div>
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Riwayat Cek</h5>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 12%; text-align:center!important">No Rekam Medis</th>
                  <th style="width: 24%; text-align:center!important">Result Status</th>
                  <th style="width: 24%; text-align:center!important">Rumah Sakit</th>
                  <th style="width: 16%; text-align:center!important">Tanggal</th>
                  <th style="width: 5%; text-align:center!important">Action</th>
                  
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal inmodal" id="record_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Kelola Record Medis</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="record_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_record" name="id_record">
            <input type="hidden" id="id_pasien_rec" name="id_pasien">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="tanggal_record">Tanggal </label> 
                  <input type="datetime-local" class="form-control" id="tanggal_record" name="tanggal_record" required="required" >
                </div>
              </div>
              <div class="col-sm-12">
                  <div class ="form-group">
                    <label for="before_status">Status Awal</label>
                    <select class="form-control mr-sm-2" id="before_status" name="before_status" required="required" readonly>
                    </select>
                  </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="tanggal_record">No Rekam Medis</label> 
                  <input type="text" class="form-control" id="no_rekam" name="no_rekam" required="required" >
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="tanggal_record">Nama Rumah Sakit</label> 
                  <input type="text" class="form-control" id="rumah_sakit" name="rumah_sakit" required="required" >
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label> 
                  <textarea rows="4" type="text" placeholder="deskripsi" class="form-control" id="deskripsi" name="deskripsi" required="required"></textarea>
                  </div>
              </div>
              
            </div>
           
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah Data</strong></button>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>
     
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal inmodal" id="informasi_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Bantuan</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="informasi_form" onsubmit="return false;" type="multipart">
            <!-- <input type="hidden" id="NO" name="NO"> -->
            <input type="hidden"  id="ID_edit" name="ID">
            <div class="form-group">
            <select class="form-control mr-sm-2" name="jenis_bantuan" id="kd_jenis_bantuan"></select>
            </div>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save" data-loading-text="Loading..."><strong>Simpan</strong></button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>


<div class="modal inmodal" id="pasien_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Kelola Pasien</h4>
        <span class="info"></span>
      </div>
      <div class="modal-body" id="modal-body">              
        <form role="form" id="user_form" onsubmit="return false;" type="multipart" autocomplete="off">
          <input type="hidden" id="id_pasien" name="id_pasien">
          <div class="form-group">
            <label for="nama">Nama </label> 
            <input type="text" placeholder="Nama" class="form-control" id="nama" name="nama" required="required">
          </div>
          <div class="form-group">
            <label for="nik">NIK </label> 
            <input type="number" placeholder="NIK" class="form-control" id="nik" name="NIK" required="required">
          </div>
          <div class="form-group">
            <label for="terdata">Kabupaten</label> 
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
          <div class="form-group">
            <label for="id_status">Status</label> 
            <select class="form-control mr-sm-2" id="id_status" name="status" required="required">
            </select>
          </div>
          <div class="form-group">
            <label for="email">Email</label> 
            <input type="text" placeholder="email" class="form-control" id="email" name="email" required="required">
          </div>
          <div class="form-group">
            <label for="nomorhp">Nomor HP </label> 
            <input type="number" placeholder="Nomor HP" class="form-control" id="nomorhp" name="nomorhp" required="required">
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label> 
            <textarea rows="4" type="text" placeholder="Alamat" class="form-control" id="alamat" name="alamat" required="required"></textarea>
               </div>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah Data</strong></button>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Simpan Perubahan</strong></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);
  $('#data_pasien').addClass('active');
  var id_pasien = `<?=$contentData['id_pasien']?>`;


  console.log(id_pasien)
  var info = {
    'self': $('#info_container'),
    'nama': $('#info_container').find('#nama'),
    'nik': $('#info_container').find('#nik'),
    'nomorhp': $('#info_container').find('#nomorhp'),
    'email': $('#info_container').find('#email'),
    'alamat': $('#info_container').find('#alamat'),
    'tempat_cek': $('#info_container').find('#tempat_cek'),
    'jumlah_cek': $('#info_container').find('#jumlah_cek'),
    'status': $('#info_container').find('#status'),
    'active': $('#info_container').find('#active'),
    'nama_kab': $('#info_container').find('#nama_kab'),
    'nama_kec': $('#info_container').find('#nama_kec'),
    'nama_kel': $('#info_container').find('#nama_kel'),
    'jenis_kelamin': $('#info_container').find('#jenis_kelamin'),
    'tempat_lahir': $('#info_container').find('#tempat_lahir'),
    'tanggal_lahir': $('#info_container').find('#tanggal_lahir'),
    'usia': $('#info_container').find('#usia'),
    'edit_info_btn': $('#edit_info_btn'),
    'add_record_btn': $('#add_record_btn')
  }

  if(sessionData['id_role'] != 2){
    // info.edit_info_btn.hide();
    info.add_record_btn.hide();
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

  var recordModal = {
    self: $('#record_modal'),
    form: $('#record_form'),
    NO: $('#record_modal').find('#NO'),
    id_pasien_rec: $('#record_modal').find('#id_pasien_rec'),
    id_record: $('#record_modal').find('#id_record'),
    tanggal_record: $('#record_modal').find('#tanggal_record'),
    before_status: $('#record_modal').find('#before_status'),
    no_rekam: $('#record_modal').find('#no_rekam'),
    rumah_sakit: $('#record_modal').find('#rumah_sakit'),
    deskripsi: $('#record_modal').find('#deskripsi'),
    info: $('#record_modal').find('#info'),
    'addBtn': $('#record_modal').find('#add_btn'),
    'saveEditBtn': $('#record_modal').find('#save_edit_btn'),
  }

  var informasiModal = {
    self: $('#informasi_modal'),
    form: $('#informasi_form'),
    ID_edit: $('#informasi_modal').find('#ID_edit'),
    kd_jenis_bantuan: $('#informasi_modal').find('#kd_jenis_bantuan'),
    info: $('#informasi_modal').find('#info'),
    save_btn: $('#informasi_modal').find('#save'),
  }

  
  var PasienModal = {
    'self': $('#pasien_modal'),
    'info': $('#pasien_modal').find('.info'),
    'form': $('#pasien_modal').find('#user_form'),
    'addBtn': $('#pasien_modal').find('#add_btn'),
    'saveEditBtn': $('#pasien_modal').find('#save_edit_btn'),
    'id_pasien': $('#pasien_modal').find('#id_pasien'),
    'nama': $('#pasien_modal').find('#nama'),
    'id_status': $('#pasien_modal').find('#id_status'),
    'sl_kab': $('#pasien_modal').find('#sl_kab'),
    'sl_kec': $('#pasien_modal').find('#sl_kec'),
    'sl_kel': $('#pasien_modal').find('#sl_kel'),
    'nik': $('#pasien_modal').find('#nik'),
    'email': $('#pasien_modal').find('#email'),
    'nomorhp': $('#pasien_modal').find('#nomorhp'),
    'alamat': $('#pasien_modal').find('#alamat'),
  }

  var dataInfo = {};
  var dataJabatanTim = {};
  var dataUser = {};
  
  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

  getInfo();
  function getInfo(){
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllPasien_v2/')?>`, 'type': 'GET',
       data : {id_pasien: id_pasien},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataInfo = json['data']['0'];
        // console.log(dataInfo)
        renderInfo();
        getTim() 
      },
      error: function(e) {}
    });
  }

  function colorBantuan(realisasi, na = false){
  // var realisasi = parseFloat(realisasi);
  if(realisasi == '0')
     return `<span class="label label-danger"> Belum Ada Bantuan </span>`;
  else if (realisasi == '1')
    return `<span class="label label-info"> Jenis Bantuan 1 (PKH dan BPNT) </span>`;
  else if (realisasi == '2')
    return `<span class="label label-info"> Jenis Bantuan 2 (BPNT) </span>`;
  else if (realisasi == '3')
    return `<span class="label label-info"> Jenis Bantuan 3 (Non PKH - Non BPNT) </span>`;
  return `<span class="label label-success">${realisasi}%</span>`;
}

function convStatus(status){
  // var realisasi = parseFloat(realisasi);
  if(status == '1')
     return `<span class="label label-info"> Orang Tanpa Gejala </span>`;
  else if (status == '2')
    return `<span class="label label-warning"> Orang Dalam Pemantauan </span>`;
  else if (status == '3')
    return `<span class="label label-warning"> Pasien Dalam Pemantauan </span>`;
  else if (status == '4')
    return `<span class="label label-danger"> POSITIF COVID-19 </span>`;
  return `<span class="label label-success"> NEGATIF COVID-19 </span>`;  
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

  function renderInfo(){
    // info.jenis_bantuan.html(`${colorBantuan(dataInfo['jenis_bantuan'])}`);
    info.nama.html(`${dataInfo['nama']}`);
    info.nik.html(`${dataInfo['NIK']}`);
    info.alamat.html(`${dataInfo['alamat'] }`);
    info.tempat_cek.html(`${dataInfo['tempat_cek'] ? dataInfo['tempat_cek'] : 'Belum ada'}`);
  
    info.jumlah_cek.html(`${dataInfo['jumlah_cek']}`);
    info.status.html(`${convStatus(dataInfo['status'])}`);
    info.active.html(`${dataInfo['active'] == 0 ? 'Belum Aktif' : 'Aktif'}`);
    info.nama_kab.html(`${dataInfo['nama_kab']}`);
    info.nama_kec.html(`${dataInfo['nama_kec']}`);
    info.nama_kel.html(`${dataInfo['nama_kel']}`);
    info.nomorhp.html(`${dataInfo['nomorhp']}`);
    info.email.html(`${dataInfo['email']}`);
    recordModal.id_pasien_rec.val(dataInfo['id_pasien']);
    info.jenis_kelamin.html(`${dataInfo['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan'}`);
    info.tempat_lahir.html(`${dataInfo['tempat_lahir']}`);
    info.tanggal_lahir.html(`${dataInfo['tanggal_lahir']}`);
   
    info.usia.html(getAge(dataInfo['tanggal_lahir']));

    // info.Nama_KRT.html(`${dataInfo['NO_KTP_NIK_PEKERJA']}`);
    // info.kontak.html(`${dataInfo['NO_HP']+'  <br>'+dataInfo['email']}`);
    // info.Alamat.html(`<a href="<?=site_url()?>OPPerencanaanController/detail?id_opd${dataInfo['id_opd']}">${dataInfo['Alamat']}</a>`);
  }

  function renderRecord(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((record) => {
      var detailButton = `<a class="btn btn-success" href="<?=site_url("DinkesController/DetailRecord/")?>?id_record=${record['id_record']}" class="dropdown-item"><i class='fa fa-pencil'></i> Detail Info </a>`;
    
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${record['id_record']}'><i class='fa fa-trash'></i> Hapus Record</a>
      `;
      var editButton = `
        <a class="edit dropdown-item" data-id='${record['id_record']}'><i class='fa fa-pencil'></i> Edit Record</a>
      `;
      var button = `
        <div class="btn-group" opd="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${detailButton}
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
    //   var no_hp = record['no_hp_tim'] ? record['no_hp_tim'] : 'Tidak Ada';
    //   var photo = record['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${record['photo_tim']}" class="img-sm">` : 'Tidak Ada';
      renderData.push([record['no_rekam'], convStatus(record['before_status'])+' to '+convStatus(record['after_status']), record['rumah_sakit'],record['tanggal_record'],detailButton]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  recordModal.form.submit(function(event){
    event.preventDefault();
    switch(recordModal.form[0].target){
      case 'add':
        addRecord();
        break;
      case 'edit':
        editRecord();
        break;
    }
  });

      function addRecord(){
      swal('Tambah Record').then((result) => {
        if(!result.value){ return; }
        buttonLoading(recordModal.addBtn);
        $.ajax({
          url: "<?=site_url('DinkesController/addRecord')?>", 'type': 'POST',
          data: recordModal.form.serialize(),
          success: function (data){
            buttonIdle(recordModal.addBtn);
            var json = JSON.parse(data);
            if(json['error']){
              swal("Simpan Gagal", json['message'], "error");
              return;
            }
            var record = json['data']
            // console.log(record)
            dataRecord[record['id_record']] = record;
            swal("Simpan Berhasil", "", "success");
            renderRecord(dataRecord);
            getInfo();
            recordModal.self.modal('hide');
          },
          error: function(e) {}
        });
      });
    }

    function editRecord(){
      swal('Edit Record').then((result) => {
        if(!result.value){ return; }
        buttonLoading(recordModal.saveEditBtn);
        $.ajax({
          url: "<?=site_url('DinkesController/editRecord')?>", 'type': 'POST',
          data: recordModal.form.serialize(),
          success: function (data){
            buttonIdle(recordModal.saveEditBtn);
            var json = JSON.parse(data);
            if(json['error']){
              swal("Simpan Gagal", json['message'], "error");
              return;
            }
            var record = json['data']
            // console.log(record)
            dataRecord[record['id_record']] = record;
            swal("Simpan Berhasil", "", "success");
            renderRecord(dataRecord);
            getInfo();
            recordModal.self.modal('hide');
          },
          error: function(e) {}
        });
      });
    }
  

  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('DinkesController/deleteRecord')?>", 'type': 'POST',
        data: {'id_record': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataRecord[id];
          swal("Delete Berhasil", "", "success");
          renderRecord(dataRecord);
        },
        error: function(e) {}
      });
    });
  });

  FDataTable.on('click','.edit', function(){
    recordModal.form.trigger('reset');
    recordModal.self.modal('show');
    recordModal.id_pasien_rec.val(dataInfo['id_pasien']);
    recordModal.saveEditBtn.show();
    recordModal.addBtn.hide();
    var id = $(this).data('id');
    var current = dataRecord[id];
    console.log(current);
    recordModal.id_record.val(current['id_record']);
    recordModal.deskripsi.val(current['deskripsi']);
    recordModal.before_status.val(current['before_status']);
    recordModal.no_rekam.val(current['no_rekam']);
    recordModal.rumah_sakit.val(current['rumah_sakit']);
    var datecur = current['tanggal_record']
    var res = datecur.substr(0,10);
    var res2 = datecur.substr(11,5);
    console.log(res+'T'+res2)
    recordModal.tanggal_record.val(res+'T'+res2);

  });

  // getJenisBantuan()
  function getJenisBantuan(){
    return $.ajax({
        url: `<?php echo site_url('SharedController/getJenisBantuan/')?>`, 
        data : {},
        type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        data = json['data'];
        renderJenisBantuan(data)
      },
      error: function(e) {}, 
    });
  }

  function renderJenisBantuan(data){
    informasiModal.kd_jenis_bantuan.empty();
    informasiModal.kd_jenis_bantuan.append($('<option>', { value: "0", text: "Pilih Jenis Bantuan"}));
    Object.values(data).forEach((d) => {
        informasiModal.kd_jenis_bantuan.append($('<option>', {
        value: d['id_jenis_bantuan'],
        text:  d['id_jenis_bantuan'] + " :: " + d['nama_jenis_bantuan'] ,
      }));
    });
  }

  getAllStatus();  
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
    PasienModal.id_status.empty();
    PasienModal.id_status.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
    Object.values(data).forEach((d) => {
      PasienModal.id_status.append($('<option>', {
        value: d['id_status'],
        text: d['id_status'] + ' :: ' + d['nama_status'],
      }));
    });

    recordModal.before_status.empty();
    recordModal.before_status.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
    Object.values(data).forEach((d) => {
      recordModal.before_status.append($('<option>', {
        value: d['id_status'],
        text: d['id_status'] + ' :: ' + d['nama_status'],
      }));
    });
  }

  function getTim(){
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllRecord/')?>`, 
        data : {id_pasien: id_pasien},
        type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRecord = json['data'];
        if(dataRecord != 'NULL'){
            console.log('run')
        
        // info.st_terdata.html(`Terdata`);
        renderRecord(dataRecord);
        }else{
        //   info.st_terdata.html(`Tidak Terdata`);
        }
      },
      error: function(e) {}, 
    });
  }

  function renderRecordSelection(data){
    if(data == null || typeof data != "object") return;
    recordModal.list_tim.typeahead({ 
      source: Object.values(data).map((e) => {
        return `${e['nama']} (${e['nip']}) -- ${e['id_user']}`;
      }),
      afterSelect: function(data){
        var id = data.split(" -- ")[1];
        var user = dataUser[id];
        recordModal.id_user.val(user['id_user']);
        recordModal.photo_tim.attr('src', user['photo']);
      }
    });
    recordModal.list_tim.on('blur', function(e){
      if(empty(recordModal.list_tim.val())) {
        recordModal.id_user.val('');
        recordModal.photo_tim.attr('src', null);
      }
    });
  }

  info.add_record_btn.on('click', function(){
    recordModal.form.trigger('reset');
    recordModal.self.modal('show');
    recordModal.id_pasien_rec.val(dataInfo['id_pasien']);
    recordModal.saveEditBtn.hide();
    recordModal.addBtn.show();
    recordModal.before_status.val(dataInfo['status']);
    // recordModal.NO.val(dataInfo['NO']);
  });
  
  info.edit_info_btn.on('click', function(){
    // informasiModal.self.modal('show');
    // informasiModal.NO.val(dataInfo['NO']);
    // informasiModal.lokasi.val(dataInfo['lokasi']);

    event.preventDefault();
    PasienModal.form.trigger('reset');
    PasienModal.self.modal('show');
    PasienModal.addBtn.hide();
    PasienModal.saveEditBtn.show();

    PasienModal.id_pasien.val(dataInfo['id_pasien']);
    PasienModal.nama.val(dataInfo['nama']);
    PasienModal.nik.val(dataInfo['nik']);
    PasienModal.jumlah_kamar.val(dataInfo['jumlah_kamar']);
    PasienModal.jumlah_tempat_tidur.val(dataInfo['jumlah_tempat_tidur']);
    PasienModal.file.val(dataInfo['file']);
    PasienModal.lokasi.val(dataInfo['lokasi']);
    PasienModal.deskripsi.val(dataInfo['deskripsi']);
    PasienModal.terdata.val(dataInfo['tahun_terdata']);

    // info.nama.html(`${dataInfo['nama']}`);
    // info.nik.html(`${dataInfo['NIK']}`);
    // info.alamat.html(`${dataInfo['alamat'] }`);
    // info.tempat_cek.html(`${dataInfo['tempat_cek']}`);
  
    // info.jumlah_cek.html(`${dataInfo['jumlah_cek']}`);
    // info.status.html(`${dataInfo['status']}`);
    // info.active.html(`${dataInfo['active']}`);
    // info.nama_kab.html(`${dataInfo['nama_kab']}`);
    // info.nama_kec.html(`${dataInfo['nama_kec']}`);
    // info.nama_kel.html(`${dataInfo['nama_kel']}`);
    // info.nomorhp.html(`${dataInfo['nomorhp']}`);
    // info.email.html(`${dataInfo['email']}`);

  });

  informasiModal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(informasiModal.save_btn);
    $.ajax({
      url: "<?=site_url('DTKSController/editDTKSRT/')?>",
      type: "POST",
      data: informasiModal.form.serialize(),
      success: (data) => {
        buttonIdle(informasiModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Tambah Bantuan Gagal", json['message'], "error");
          return;
        } 
        dataInfo = json['data']['0'];
        renderInfo();
        getTim();
        swal("Berhasil Tambah Bantuan", 'Input Informasi Berhasil', "success");
        informasiModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(informasiModal.save_btn);
      },
    });
  });
});
</script>