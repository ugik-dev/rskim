<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="toolbar_form" onsubmit="return false;">
        <input type="hidden" id="is_not_self" name="is_not_self" value="1">
        <select class="form-control mr-sm-2" name="kd_kab" id="kd_kab"></select>
        <select class="form-control mr-sm-2" name="nama_perusahaan" id="nama_perusahaan" style="max-width:300px"></select>
        <button hidden type="button" class="btn btn-success my-1 mr-sm-2" id="new_btn" disabled="disabled"><i class="fal fa-plus"></i> Tambah Data PHK</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 14%; text-align:center!important">Kabupaten</th>
                  <th style="width: 24%; text-align:center!important">Perusahaan</th>
                  <th style="width: 24%; text-align:center!important">Nama</th>
                  <th style="width: 16%; text-align:center!important">No Identitas</th>
                  <th style="width: 24%; text-align:center!important">Kontak</th>
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

<div class="modal inmodal" id="user_modal" tabindex="-1" opd="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Kelola Data</h4>
        <span class="info"></span>
      </div>
      <div class="modal-body" id="modal-body">              
        <form opd="form" id="user_form" onsubmit="return false;" type="multipart" autocomplete="off">
          <input type="hidden" id="NO" name="NO">
          <div class="form-group">
            <label for="NIK">NIK</label> 
            <input type="text" placeholder="NIK" class="form-control" id="NIK" name="NIK" required="required">
          </div>
          <div class="form-group">
            <label for="nama_pekerja">Nama Pekerja</label> 
            <input type="text" placeholder="Nama Pekerja" class="form-control" id="nama_pekerja" name="NAMA_PEKERJA" required="required">
          </div>
          <div class="form-group">
            <label for="alamat_pekerja">Alamat Pekerja</label> 
            <input type="text" placeholder="Alamat Pekerja" class="form-control" id="alamat_pekerja" name="ALAMAT_PEKERJA" required="required">
          </div>
          <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan</label> 
            <input type="text" placeholder="Nama Perusahaan" class="form-control" id="nama_perusahaan" name="NAMA_PERUSAHAAN" required="required">
          </div>
          <div class="form-group">
            <label for="alamat_perusahaan">Alamat Perusahaan</label> 
            <input type="text" placeholder="Alamat Perusahaan" class="form-control" id="alamat_perusahaan" name="ALAMAT_PERUSAHAAN" required="required">
          </div>
          <div class="form-group">
            <label for="JABATAN">Jabatan</label> 
            <input type="text" placeholder="Jabatan" class="form-control" id="jabatan" name="JABATAN" required="required">
          </div>
          <div class="form-group">
            <label for="NO_HP">No HP</label> 
            <input type="text" placeholder="No HP" class="form-control" id="no_hp" name="NO_HP" required="required">
          </div>
          <div class="form-group">
            <label for="email">Email</label> 
            <input type="text" placeholder="Email" class="form-control" id="email" name="email" required="required">
          </div>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="add_btn" data-loading-text="Loading..."><strong>Tambah Data</strong></button>
          <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save_edit_btn" data-loading-text="Loading..."><strong>Simpan Perubahan</strong></button>
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
  $('#terdampak_phk').addClass('active');

  var toolbar = {
    'form': $('#toolbar_form'),
    'kd_kab': $('#toolbar_form').find('#kd_kab'),
    'nama_perusahaan': $('#toolbar_form').find('#nama_perusahaan'),
    'newBtn': $('#new_btn'),
  }

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    deferRender: true,
    "order": [[ 0, "desc" ]]
  });

  var UserModal = {
    'self': $('#user_modal'),
    'info': $('#user_modal').find('.info'),
    'form': $('#user_modal').find('#user_form'),
    'addBtn': $('#user_modal').find('#add_btn'),
    'saveEditBtn': $('#user_modal').find('#save_edit_btn'),
    'NO': $('#user_modal').find('#NO'),
    'nama_pekerja': $('#user_modal').find('#nama_pekerja'),
    'alamat_pekerja': $('#user_modal').find('#alamat_pekerja'),
    'nama_perusahaan': $('#user_modal').find('#nama_perusahaan'),
    'alamat_perusahaan': $('#user_modal').find('#alamat_perusahaan'),
    'NIK': $('#user_modal').find('#NIK'),
    'jabatan': $('#user_modal').find('#jabatan'),
    'no_hp': $('#user_modal').find('#no_hp'),
    'email': $('#user_modal').find('#email'),
    // 'kd_kab': $('#user_modal').find('#kd_kab'),
    // 'opd': $('#user_modal').find('#opd'),
    // 'photo': new FileUploader($('#user_modal').find('#photo'), "", "photo", ".jpg"),
  }

  var dataRole = {}
  var dataOPD = {}
  var dataUser = {}

  var swalSaveConfigure = {
    title: "Konfirmasi simpan",
    text: "Yakin akan menyimpan data ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya, Simpan!",
  };

  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

  // $.when(getAllRole(), getAllOPD(), getAllData()).then((e) =>{
  // $.when(getAllKab(),getAllData(),getAllPerusahaan()).then((e) =>{
    $.when(getAllKab()).then((e) =>{

    toolbar.newBtn.prop('disabled', false);
  }).fail((e) => { console.log(e) });

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
        renderKabSelectionFilter(dataRole);
        // renderRoleSelectionAdd(dataRole);
      },
      error: function(e) {}
    });
  }

  function renderKabSelectionFilter(data){
    toolbar.kd_kab.empty();
    toolbar.kd_kab.append($('<option>', { value: "", text: "-- Semua Kabupaten --"}));
    toolbar.kd_kab.append($('<option>', { value: "01", text: "Bangka"}));
    toolbar.kd_kab.append($('<option>', { value: "02", text: "Belitung"}));
    toolbar.kd_kab.append($('<option>', { value: "03", text: "Bangka Barat"}));
    toolbar.kd_kab.append($('<option>', { value: "04", text: "Bangka Tengah"}));
    toolbar.kd_kab.append($('<option>', { value: "05", text: "Bangka Selatan"}));
    toolbar.kd_kab.append($('<option>', { value: "06", text: "Belitung Timur"}));
    toolbar.kd_kab.append($('<option>', { value: "71", text: "Pangkalpinang"}));


    // Object.values(data).forEach((d) => {
    //   toolbar.kd_kab.append($('<option>', {
    //     value: d['id_kd_kab'],
    //     text:  d['nama_kab'],
    //     // text: d['id_kd_kab'] + ' :: ' + d['nama_kab'],
    
    //   }));
    // });
  }

  function renderRoleSelectionAdd(data){
    UserModal.kd_kab.empty();
    UserModal.kd_kab.append($('<option>', { value: "", text: "-- Pilih Role --"}));
    Object.values(data).forEach((d) => {
      UserModal.kd_kab.append($('<option>', {
        value: d['kd_kab'],
        text: d['kd_kab'] + ' :: ' + d['title_role'],
     
        // text: d['kd_kab'] + ' :: ' + d['title_role'],
      }));
    });
  }
  

  function getAllPerusahaan(){
    return $.ajax({
      url: `<?php echo site_url('TerdampakController/getPerusahaanPHK/')?>`, 'type': 'POST',
      data: toolbar.form.serialize(),
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataOPD = json['data'];
        renderOPDSelectionFilter(dataOPD);
        
      },
      error: function(e) {}
    });
  }

  function renderOPDSelectionFilter(data){
    toolbar.nama_perusahaan.empty();
    toolbar.nama_perusahaan.append($('<option>', { value: "", text: "-- Semua Perusahaan --"}));
    Object.values(data).forEach((d) => {
      toolbar.nama_perusahaan.append($('<option>', {
        value: d['NAMA_PERUSAHAAN'],
        text: d['NAMA_PERUSAHAAN'],
      }));
    });
  }

  // function renderOPDSelectionAdd(data){
  //   UserModal.opd.empty();
  //   UserModal.opd.append($('<option>', { value: "", text: "-- Tingkat Provinsi --"}));
  //   Object.values(data).forEach((d) => {
  //     UserModal.opd.append($('<option>', {
  //       value: d['nama_perusahaan'],
  //       text: d['nama_perusahaan'] + ' :: ' + d['nama_opd'],
  //     }));
  //   });
  // }

  toolbar.kd_kab.on('change', (e) => {
    // UserModal.kd_kab.attr('readonly', !empty(toolbar.kd_kab.val()));
    getAllPerusahaan()
    toolbar.nama_perusahaan.val(null).trigger('change');
    
  });

  toolbar.nama_perusahaan.on('change', (e) => {
    // UserModal.opd.attr('readonly', !empty(toolbar.nama_perusahaan.val()));
    getAllData();
  });
  
  // UserModal.kd_kab.on('change', (e) => {
  //   UserModal.opd.attr('required', ["4", "6"].includes(UserModal.kd_kab.val()));
  // });
  
  function getAllData(){
    swal({title: 'Loading user...', allowOutsideClick: false});
    swal.showLoading();
    return $.ajax({
      url: `<?php echo site_url('TerdampakController/getAllPHK/')?>`, 'type': 'GET',
      data: toolbar.form.serialize(),
      success: function (data){
        swal.close();
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataUser = json['data'];
        renderUser(dataUser);
      },
      error: function(e) {}
    });
  }

  function renderUser(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((user) => {
      var editButton = `
        <a class="edit dropdown-item" data-id='${user['NO']}'><i class='fa fa-pencil'></i> Edit User</a>
      `;
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${user['NO']}'><i class='fa fa-trash'></i> Hapus User</a>
      `; 
      var detailButton = `<a href="<?=site_url("AdminController/DetailData/")?>?NO=${user['NO']}&categori=PHK" class="dropdown-item"><i class='fa fa-pencil'></i> Detail Data</a>`;
     
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
      renderData.push([user['nama_kab'], user['NAMA_PERUSAHAAN'], user['NAMA_PEKERJA'], user['NO_KTP_NIK_PEKERJA'], user['NO_HP']+'<br>'+user['email'], button]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  function resetUserModal(){
    UserModal.form.trigger('reset');
    // UserModal.kd_kab.val(toolbar.kd_kab.val());
    // UserModal.opd.val(toolbar.nama_perusahaan.val() != -1 ? toolbar.nama_perusahaan.val() : "");
    // UserModal.photo.resetState();
  }

  toolbar.newBtn.on('click', (e) => {
    resetUserModal();
    UserModal.self.modal('show');
    UserModal.addBtn.show();
    UserModal.saveEditBtn.hide();
    UserModal.password.prop('placeholder', 'Password');
    UserModal.password.prop('required', true);
    UserModal.photo.updateCurrentFile(null);
  });

  FDataTable.on('click', '.edit', function(){
    resetUserModal();
    UserModal.self.modal('show');
    UserModal.addBtn.hide();
    UserModal.saveEditBtn.show();
    // UserModal.password.prop('placeholder', '(Unchanged)')
    // UserModal.password.prop('required', false);
    
    var currentData = dataUser[$(this).data('id')];
    UserModal.NO.val(currentData['NO']);
    UserModal.nama_pekerja.val(currentData['NAMA_PEKERJA']);
    UserModal.alamat_pekerja.val(currentData['ALAMAT_PEKERJA']);
    UserModal.nama_perusahaan.val(currentData['NAMA_PERUSAHAAN']);
    UserModal.alamat_perusahaan.val(currentData['ALAMAT_PERUSAHAAN']);
    UserModal.NIK.val(currentData['NO_KTP_NIK_PEKERJA']);
    UserModal.jabatan.val(currentData['JABATAN']);
    UserModal.no_hp.val(currentData['NO_HP']);
    UserModal.email.val(currentData['email']);
  });

  UserModal.form.submit(function(event) {
    event.preventDefault();
    var isAdd = UserModal.addBtn.is(':visible');
    var url = "<?=site_url('UserController/')?>";
    url += isAdd ? "addUser" : "editUser";
    var button = isAdd ? UserModal.addBtn : UserModal.saveEditBtn;

    swal(swalSaveConfigure).then((result) => {
      if(!result.value){ return; }
      buttonLoading(button);
      $.ajax({
        url: url, type: "POST",
        data: new FormData(UserModal.form[0]),
        contentType: false, processData: false,  
        success: function (data){
          buttonIdle(button);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          var user = json['data']
          dataUser[user['id_user']] = user;
          swal("Simpan Berhasil", "", "success");
          renderUser(dataUser);
          UserModal.self.modal('hide');
        },
        error: function(e) {}
      });
    });
  });

  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('UserController/deleteUser')?>", 'type': 'POST',
        data: {'id_user': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataUser[id];
          swal("Delete Berhasil", "", "success");
          renderUser(dataUser);
        },
        error: function(e) {}
      });
    });
  });

  FDataTable.on('click','.detail', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('TerdampakController/openDetail')?>", 'type': 'POST',
        data: {'ID': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataUser[id];
          swal("Delete Berhasil", "", "success");
          renderUser(dataUser);
        },
        error: function(e) {}
      });
    });
  });
});
</script>