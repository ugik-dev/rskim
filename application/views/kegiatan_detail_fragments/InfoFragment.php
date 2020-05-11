<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
  <div class="row">
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Nama Kegiatan</h5>
          <p class="no-margins"><span id="nama_kegiatan">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Nama Program</h5>
          <p class="no-margins"><span id="nama_program">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox">
        <div class="ibox-content">
          <h5>OPD</h5>
          <p class="no-margins"><span id="nama_opd">-</span></p>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <h5>Tim Kegiatan</h5>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 24%; text-align:center!important">NIP</th>
                  <th style="width: 24%; text-align:center!important">Nama</th>
                  <th style="width: 24%; text-align:center!important">Jabatan</th>
                  <th style="width: 16%; text-align:center!important">Nomor HP</th>
                  <th style="width: 12%; text-align:center!important">Foto</th>
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

  <div class="row">
    <div class="col-lg-4">
      <button class="btn btn-success my-1 mr-sm-2" id="add_tim_btn"><i class='fa fa-plus'></i> Tambah Tim</button>
      <button class="btn btn-success my-1 mr-sm-2" id="edit_info_btn"><i class='fa fa-edit'></i> Edit Informasi</button>
    </div>
  </div>
</div>

<div class="modal inmodal" id="tim_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Kelola TIM</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="tim_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="list_tim">Nama / NIP Tim</label> 
                  <input type="text" class="form-control" id="list_tim" name="list_tim" placeholder="Tidak ada" required="required" >
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_user">ID Tim</label> 
                  <input type="text" class="form-control" id="id_user" name="id_user" placeholder="Tidak ada" required="required" readonly>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <img id="photo_tim" class="rounded img-md">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="id_jabatan_tim">Jabatan Tim</label> 
              <select class="form-control mr-sm-2" name="id_jabatan_tim" id="id_jabatan_tim" required="required"></select>
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

<div class="modal inmodal" id="informasi_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Informasi</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="informasi_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <div class="form-group">
              <label for="lokasi">Lokasi</label> 
              <textarea type="text" id="lokasi" class="form-control" name="lokasi" placeholder="Tidak ada" rows="3"></textarea>
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

<script>
$(document).ready(function() {
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);
  
  var id_kegiatan_renja = `<?=$contentData['id_kegiatan_renja']?>`;
  var info = {
    'self': $('#info_container'),
    'nama_kegiatan': $('#info_container').find('#nama_kegiatan'),
    'nama_program': $('#info_container').find('#nama_program'),
    'nama_opd': $('#info_container').find('#nama_opd'),
    'edit_info_btn': $('#edit_info_btn'),
    'add_tim_btn': $('#add_tim_btn')
  }

  if(sessionData['id_role'] != 6){
    info.edit_info_btn.hide();
    info.add_tim_btn.hide();
  }

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3, 4], className: 'text-center'}, ],
    deferRender: true,
    'ordering': false,
    'paging': false,
    'searching': false
  });

  var timModal = {
    self: $('#tim_modal'),
    form: $('#tim_form'),
    id_kegiatan_renja: $('#tim_modal').find('#id_kegiatan_renja'),
    list_tim: $('#tim_modal').find('#list_tim'),
    id_user: $('#tim_modal').find('#id_user'),
    photo_tim: $('#tim_modal').find('#photo_tim'),
    id_jabatan_tim: $('#tim_modal').find('#id_jabatan_tim'),
    info: $('#tim_modal').find('#info'),
    save_btn: $('#tim_modal').find('#save'),
  }
  var informasiModal = {
    self: $('#informasi_modal'),
    form: $('#informasi_form'),
    id_kegiatan_renja: $('#informasi_modal').find('#id_kegiatan_renja'),
    lokasi: $('#informasi_modal').find('#lokasi'),
    info: $('#informasi_modal').find('#info'),
    save_btn: $('#informasi_modal').find('#save'),
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
      url: "<?php echo site_url('KegiatanController/getInfo')?>",
      data : {'id_kegiatan_renja': id_kegiatan_renja},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataInfo = json['data'];
        renderInfo();
        renderTim(dataInfo['tim']);
      },
      error: function(e) {}
    });
  }

  function renderInfo(){
    info.nama_kegiatan.html(`${dataInfo['nama_kegiatan_renja']}`);
    info.nama_program.html(`<a href="<?=site_url()?>ProgramController/detail?id_program_renja${dataInfo['id_program_renja']}">${dataInfo['nama_program_renja']}</a>`);
    info.nama_opd.html(`<a href="<?=site_url()?>OPPerencanaanController/detail?id_opd${dataInfo['id_opd']}">${dataInfo['nama_opd']}</a>`);
  }

  function renderTim(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((tim) => {
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${tim['id_kegiatan_tim']}'><i class='fa fa-trash'></i> Hapus Tim</a>
      `;
      var button = `
        <div class="btn-group" opd="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${deleteButton}
          </div>
        </div>
      `;
      var no_hp = tim['no_hp_tim'] ? tim['no_hp_tim'] : 'Tidak Ada';
      var photo = tim['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${tim['photo_tim']}" class="img-sm">` : 'Tidak Ada';
      renderData.push([tim['nip_tim'], tim['nama_tim'], tim['nama_jabatan_tim'], no_hp, photo, button]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  timModal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(timModal.save_btn);
    $.ajax({
      url: "<?=site_url('KegiatanController/addTim')?>",
      type: "POST",
      data: timModal.form.serialize(),
      success: (data) => {
        buttonIdle(timModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Tambah Tim Gagal", json['message'], "error");
          return;
        } 
        dataInfo = json['data'];
        renderInfo();
        renderTim(dataInfo['tim']);
        swal("Berhasil disimpan", 'Tambah Tim Berhasil', "success");
        timModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(timModal.save_btn);
      },
    });
  });

  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('KegiatanController/deleteTim')?>", 'type': 'POST',
        data: {'id_kegiatan_tim': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataInfo['tim'][id];
          swal("Delete Berhasil", "", "success");
          renderTim(dataInfo['tim']);
        },
        error: function(e) {}
      });
    });
  });

  getTim();
  function getTim(){
    return $.ajax({
      url: `<?php echo site_url('UserController/getAllUser/')?>`,
      data : {id_role: 7},
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataUser = json['data'];
        renderTimSelection(dataUser);
      },
      error: function(e) {}, 
    });
  }

  function renderTimSelection(data){
    if(data == null || typeof data != "object") return;
    timModal.list_tim.typeahead({ 
      source: Object.values(data).map((e) => {
        return `${e['nama']} (${e['nip']}) -- ${e['id_user']}`;
      }),
      afterSelect: function(data){
        var id = data.split(" -- ")[1];
        var user = dataUser[id];
        timModal.id_user.val(user['id_user']);
        timModal.photo_tim.attr('src', user['photo']);
      }
    });
    timModal.list_tim.on('blur', function(e){
      if(empty(timModal.list_tim.val())) {
        timModal.id_user.val('');
        timModal.photo_tim.attr('src', null);
      }
    });
  }

  getAllJabatanTim();
  function getAllJabatanTim(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllJabatanTim/')?>`, 'type': 'POST',
      data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataJabatanTim = json['data'];
        renderJabatanTimSelection(dataJabatanTim);
      },
      error: function(e) {}
    });
  }

  function renderJabatanTimSelection(data){
    timModal.id_jabatan_tim.empty();
    timModal.id_jabatan_tim.append($('<option>', { value: "", text: "-- Pilih Jabatan Tim --"}));
    Object.values(data).forEach((d) => {
      timModal.id_jabatan_tim.append($('<option>', {
        value: d['id_jabatan_tim'],
        text: d['id_jabatan_tim'] + ' :: ' + d['nama_jabatan_tim'],
      }));
    });
  }

  info.add_tim_btn.on('click', function(){
    timModal.self.modal('show');
    timModal.id_kegiatan_renja.val(dataInfo['id_kegiatan_renja']);
  });
  
  info.edit_info_btn.on('click', function(){
    informasiModal.self.modal('show');
    informasiModal.id_kegiatan_renja.val(dataInfo['id_kegiatan_renja']);
    informasiModal.lokasi.val(dataInfo['lokasi']);
  });

  informasiModal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(informasiModal.save_btn);
    $.ajax({
      url: "<?=site_url('KegiatanController/setInformation')?>",
      type: "POST",
      data: informasiModal.form.serialize(),
      success: (data) => {
        buttonIdle(informasiModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Ganti Program Renja gagal", json['message'], "error");
          return;
        } 
        dataInfo = json['data'];
        renderInfo();
        swal("Berhasil disimpan", 'Input Informasi Berhasil', "success");
        informasiModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(informasiModal.save_btn);
      },
    });
  });
});
</script>