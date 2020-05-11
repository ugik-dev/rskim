<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
    <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <button class="btn btn-success my-1 mr-sm-2" id="add_tracking_btn"><i class='fa fa-plus'></i> Tambah Riwayat Jalan</button>

                <h5>Silahkan tambah data, jika dalam 14 hari sebelum anda sakit pernah melakukan perjalanan luar kota / luar negeri</h5>
                
            </div>
        </div>
        </div>
    </div>


      <div class="ibox">
        <div class="ibox-content">
          <h5>Riwayat Cek</h5>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                
                  <th style="width: 12%; text-align:center!important">Negara</th>
                  <th style="width: 12%; text-align:center!important">Kota</th>
                  <th style="width: 12%; text-align:center!important">Tanggal Mulai</th>
                  
                  <th style="width: 16%; text-align:center!important">Tanggal Pulang</th>
                  <th style="width: 16%; text-align:center!important">Action</th>
                  
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 


<div class="modal inmodal" id="tracking_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Form Riwayat Perjalanan</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="tracking_form" onsubmit="return false;" type="multipart">
            <!-- <input type="hidden" id="NO" name="NO"> -->
            <input type="hidden"  id="id_pasien" name="id_pasien">
            <input type="hidden"  id="id_data_tracking" name="id_data_tracking">
         
            <div class="form-group">
                  <label for="negara">Negara</label> 
                  <input type="text" class="form-control" id="negara" name="negara" required="required" >
            </div>
            <div class="form-group">
                  <label for="kota">Kota</label> 
                  <input type="text" class="form-control" id="kota" name="kota" required="required" >
            </div>
            <div class="form-group">
            <label for="negara">Tanggal Berangkat</label> 
            <input type="date" class="form-control" id="tanggal_pergi" name="tanggal_pergi" required="required" >
  
            </div>
            <div class="form-group">
            <label for="negara">Tanggal Pulang</label> 
            <input type="date" class="form-control" id="tanggal_pulang" name="tanggal_pulang" required="required" >
  
            </div>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="save" data-loading-text="Loading..." onclick="this.form.target='add'"><strong>Tambah</strong></button>
            <button class="btn btn-success my-1 mr-sm-2" type="submit" id="edit" data-loading-text="Loading..." onclick="this.form.target='edit'"><strong>Ubah</strong></button>
       
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
   $('#tracking').addClass('active');
  var id_pasien = `<?=$this->session->userdata('id_sub')?>`;
  console.log(id_pasien)


  if(sessionData['id_role'] != 2){
    // info.edit_info_btn.hide();
    // info.add_tracking_btn.hide();
  }

    $('#add_tracking_btn').on('click', function(){
        trackingModal.form.trigger('reset');
        trackingModal.self.modal('show');
        trackingModal.save_btn.show()
        trackingModal.edit_btn.hide()
        trackingModal.id_pasien.val(id_pasien);
        // trackingModal.jenis_request.val(dataInfo['jenis_request']);
    });

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3, 4], className: 'text-center'}, ],
    deferRender: true,
    'ordering': false,
    'paging': false,
    'searching': false
  });


  var trackingModal = {
    self: $('#tracking_modal'),
    form: $('#tracking_form'),
    id_data_tracking: $('#tracking_modal').find('#id_data_tracking'),
    id_pasien: $('#tracking_modal').find('#id_pasien'),
    negara: $('#tracking_modal').find('#negara'),
    kota: $('#tracking_modal').find('#kota'),
    tanggal_pergi: $('#tracking_modal').find('#tanggal_pergi'),
    tanggal_pulang: $('#tracking_modal').find('#tanggal_pulang'),
    info: $('#tracking_modal').find('#info'),
    save_btn: $('#tracking_modal').find('#save'),
    edit_btn: $('#tracking_modal').find('#edit'),
  }
  trackingModal.id_pasien.val(id_pasien);

  var dataInfo = {};
  var dataTracking = {};
  var dataUser = {};
  
  var swalDeleteConfigure = {
    title: "Konfirmasi hapus",
    text: "Yakin akan menghapus data ini?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Hapus!",
  };

   
  var swalRequestConfigure = {
    title: "Konfirmasi Tambah Data",
    text: "Yakin akan tambah data?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya!",
  };

    
  var swalEditConfigure = {
    title: "Konfirmasi Ubah Data",
    text: "Yakin akan ubah data?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya!",
  };

  getAllTracking();  
  function getAllTracking(){
    return $.ajax({
      url: `<?php echo site_url('PasienController/getAllTracking/')?>`, 'type': 'GET',
      data: {id_pasien : id_pasien},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataTracking = json['data'];
        renderTracking(dataTracking);
      },
      error: function(e) {}
    });
  }

function convStatus(status){
  // var realisasi = parseFloat(realisasi);
  if(status == '1')
     return `Request`;
  else if (status == '2')
    return `Terjadwal`;
  else if (status == '3')
    return `Menunggu Hasil`;
  else if (status == '4')
    return `Final`;
  return `Tidak Diketahui`;  
}


  function renderTracking(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((tracking) => {
      var detailButton = `<a class="btn btn-success" href="<?=site_url("DinkesController/Detailtracking/")?>?id_data_tracking=${tracking['id_data_tracking']}" class="dropdown-item"><i class='fa fa-pencil'></i> Detail Info </a>`;
    
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${tracking['id_data_tracking']}'><i class='fa fa-trash'></i> Hapus tracking</a>
      `;
      var editButton = `
        <a class="edit dropdown-item" data-id='${tracking['id_data_tracking']}'><i class='fa fa-pencil'></i> Edit tracking</a>
      `;
      var button = `
        <div class="btn-group" opd="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
    //   var no_hp = tracking['no_hp_tim'] ? tracking['no_hp_tim'] : 'Tidak Ada';
    //   var photo = tracking['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${tracking['photo_tim']}" class="img-sm">` : 'Tidak Ada';
      renderData.push([tracking['negara'], tracking['kota'], tracking['tanggal_pergi'],tracking['tanggal_pulang'],button]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  trackingModal.form.submit(function(event){
    event.preventDefault();
    switch(trackingModal.form[0].target){
      case 'add':
        addTracking();
        break;
      case 'edit':
        editTracking();
        break;
    }
  });
  function addTracking(){
    Swal(swalRequestConfigure).then((result) => {
      if(!result.value){ return; }
    buttonLoading(trackingModal.save_btn);
    $.ajax({
      url: "<?=site_url('PasienController/addTracking/')?>",
      type: "POST",
      data: trackingModal.form.serialize(),
      success: (data) => {
        buttonIdle(trackingModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Request Gagal", json['message'], "error");
          return;
        } 
        tracking = json['data'];
        // console.log(dataTracking)
        dataTracking[tracking['id_data_tracking']] = tracking;
        renderTracking(dataTracking);
        swal("Berhasil Request", 'Harap Tunggu Informasi Penjadwalan', "success");
        trackingModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(trackingModal.save_btn);
      },
    });
    });
  }

  function editTracking(){
    Swal(swalEditConfigure).then((result) => {
      if(!result.value){ return; }
    
    buttonLoading(trackingModal.edit_btn);
    $.ajax({
      url: "<?=site_url('PasienController/editTracking/')?>",
      type: "POST",
      data: trackingModal.form.serialize(),
      success: (data) => {
        buttonIdle(trackingModal.edit_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Request Gagal", json['message'], "error");
          return;
        } 
        tracking = json['data'];
        // console.log(dataTracking)
        dataTracking[tracking['id_data_tracking']] = tracking;
        renderTracking(dataTracking);
        swal("Berhasil Request", 'Harap Tunggu Informasi Penjadwalan', "success");
        trackingModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(trackingModal.edit_btn);
      },
    });
    });
  }

  FDataTable.on('click','.edit', function(){
    trackingModal.form.trigger('reset');
    trackingModal.self.modal('show');
    trackingModal.id_pasien.val(id_pasien);
    trackingModal.edit_btn.show();
    trackingModal.save_btn.hide();
    var id = $(this).data('id');
    var current = dataTracking[id];
    console.log(current);
    trackingModal.id_data_tracking.val(current['id_data_tracking']);
    trackingModal.negara.val(current['negara']);
    trackingModal.kota.val(current['kota']);
    trackingModal.tanggal_pergi.val(current['tanggal_pergi']);
    trackingModal.tanggal_pulang.val(current['tanggal_pulang']);
    // var datecur = current['tanggal_record']
    // var res = datecur.substr(0,10);
    // var res2 = datecur.substr(11,5);
    // console.log(res+'T'+res2)
    // recordModal.tanggal_record.val(res+'T'+res2);

  });

  FDataTable.on('click','.delete', function(){
    event.preventDefault();
    var id = $(this).data('id');
    swal(swalDeleteConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('PasienController/deleteTracking')?>", 'type': 'POST',
        data: {'id_data_tracking': id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataTracking[id];
          swal("Delete Berhasil", "", "success");
          renderTracking(dataTracking);
        },
        error: function(e) {}
      });
    });
  });
  

});
</script>