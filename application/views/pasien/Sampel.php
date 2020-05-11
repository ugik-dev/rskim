<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
    <div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <button class="btn btn-success my-1 mr-sm-2" id="request_btn"><i class='fa fa-plus'></i> Request Uji Sampel</button>

                <h5>Silahkan request untuk dijadwalkan pengujian sampel anda</h5>
                
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
                  <th style="width: 12%; text-align:center!important">Tanggal Request</th>
                  <th style="width: 12%; text-align:center!important">Jenis</th>
                  <th style="width: 12%; text-align:center!important">Status</th>
                  <th style="width: 12%; text-align:center!important">Tempat</th>
                  
                  <th style="width: 16%; text-align:center!important">Tanggal Pengujian</th>
                  <!-- <th style="width: 16%; text-align:center!important">Hasil</th> -->
                  <th style="width: 16%; text-align:center!important">Nomor Sampel</th>
                  
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 


<div class="modal inmodal" id="request_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Request</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="request_form" onsubmit="return false;" type="multipart">
            <!-- <input type="hidden" id="NO" name="NO"> -->
            <input type="hidden"  id="id_pasien" name="id_pasien">
            <div class="form-group">
            <select class="form-control mr-sm-2" name="jenis" id="jenis_request" required="required"></select>
            </div>
            <div class="form-group">
            <select class="form-control mr-sm-2" name="instansi" id="instansi" required="required"></select>
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
   $('#sampel').addClass('active');
  var id_pasien = `<?=$this->session->userdata('id_sub')?>`;
  console.log(id_pasien)


  if(sessionData['id_role'] != 2){
    // info.edit_info_btn.hide();
    // info.request_btn.hide();
  }

    $('#request_btn').on('click', function(){
        requestModal.self.modal('show');
        // requestModal.id_pasien.val(dataInfo['ID']);
        // requestModal.jenis_request.val(dataInfo['jenis_request']);
    });

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3, 4], className: 'text-center'}, ],
    deferRender: true,
    'ordering': false,
    'paging': false,
    'searching': false
  });


  var requestModal = {
    self: $('#request_modal'),
    form: $('#request_form'),
    id_pasien: $('#request_modal').find('#id_pasien'),
    jenis_request: $('#request_modal').find('#jenis_request'),
    instansi: $('#request_modal').find('#instansi'),
    info: $('#request_modal').find('#info'),
    save_btn: $('#request_modal').find('#save'),
  }
  requestModal.id_pasien.val(id_pasien);

  renderJenisSampelSelection();
  var dataInfo = {};
  var dataSampel = {};
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
    title: "Konfirmasi request",
    text: "Yakin akan request?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Ya, Request!",
  };

  getAllSampel();  
  function getAllSampel(){
    return $.ajax({
      url: `<?php echo site_url('PasienController/getAllSampel/')?>`, 'type': 'GET',
      data: {id_pasien : id_pasien},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataSampel = json['data'];
        renderSampel(dataSampel);
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


  function renderSampel(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((sampel) => {
      var detailButton = `<a class="btn btn-success" href="<?=site_url("DinkesController/Detailsampel/")?>?id_sampel=${sampel['id_sampel']}" class="dropdown-item"><i class='fa fa-pencil'></i> Detail Info </a>`;
    
      var deleteButton = `
        <a class="delete dropdown-item" data-id='${sampel['id_sampel']}'><i class='fa fa-trash'></i> Hapus sampel</a>
      `;
      var editButton = `
        <a class="edit dropdown-item" data-id='${sampel['id_sampel']}'><i class='fa fa-pencil'></i> Edit sampel</a>
      `;
      var button = `
        <div class="btn-group" opd="group">
          <button id="action" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${detailButton}
          </div>
        </div>
      `;
    //   var no_hp = sampel['no_hp_tim'] ? sampel['no_hp_tim'] : 'Tidak Ada';
    //   var photo = sampel['photo_tim'] ? `<img src="<?=base_url('uploads/photo/')?>${sampel['photo_tim']}" class="img-sm">` : 'Tidak Ada';
      renderData.push([sampel['tanggal_request'], sampel['jenis'], convStatus(sampel['status_sampel']),sampel['nama_instansi'],sampel['tanggal_pengambilan_sampel'],sampel['no_sampel']]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  requestModal.form.on('submit', (ev) => {
    Swal(swalRequestConfigure).then((result) => {
      if(!result.value){ return; }
    ev.preventDefault();
    buttonLoading(requestModal.save_btn);
    $.ajax({
      url: "<?=site_url('PasienController/requestSampel/')?>",
      type: "POST",
      data: requestModal.form.serialize(),
      success: (data) => {
        buttonIdle(requestModal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Request Gagal", json['message'], "error");
          return;
        } 
        sampel = json['data'];
        // console.log(dataSampel)
        dataSampel[sampel['id_sampel']] = sampel;
        renderSampel(dataSampel);
        swal("Berhasil Request", 'Harap Tunggu Informasi Penjadwalan', "success");
        requestModal.self.modal('hide');
      },
      error: () => {
        buttonIdle(requestModal.save_btn);
      },
    });
    });
  });
  
  function renderJenisSampelSelection(){
      
    requestModal.jenis_request.empty();
    requestModal.jenis_request.append($('<option>', { value: "", text: "-- Pilih Jenis --"}));
    requestModal.jenis_request.append($('<option>', { value: "RAPID", text: "RAPID"}));
    requestModal.jenis_request.append($('<option>', { value: "SWAP", text: "SWAP"}));
    requestModal.instansi.empty();
    requestModal.instansi.append($('<option>', { value: "", text: "-- Pilih Tempat Pengujian Sampel --"}));
    requestModal.instansi.append($('<option>', { value: "1", text: "Klinik"}));
    requestModal.instansi.append($('<option>', { value: "2", text: "Rumah Sakit"}));
    requestModal.instansi.append($('<option>', { value: "3", text: "Bandara"}));
    requestModal.instansi.append($('<option>', { value: "4", text: "Pelabuhan"}));
  }

});
</script>