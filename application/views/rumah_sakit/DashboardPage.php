<div class="wrapper wrapper-content animated fadeInRight" id="periodeContainer">
  <div class="col-lg-12">
        <div class="ibox">
          <div class="ibox-content">
        <form class="form-inline" id="toolbar_form" onsubmit="return false;">
        <a> Dari : </a>  <input type="date" placeholder="" class="form-control my-1 mr-sm-2" id="date_before" name="date_before" style="max-width:300px"> 
          Sampai :<input type="date" placeholder="" class="form-control my-1 mr-sm-2" id="date_after" name="date_after" style="max-width:300px">      
          <!-- <select class="form-control mr-sm-2" name="kd_perusahaan" id="kd_perusahaan" ></select> -->
          <button type="submit" class="btn btn-success my-1 mr-sm-2" id="src_btn" data-loading-text="Loading..." ><i class="fal fa-search"></i> Cari</button>
        </form>
      </div>
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
                  <th style="width: 12%; text-align:center!important">No Antri</th>
                  <th style="width: 16%; text-align:center!important">Tanggal</th>
                  <th style="width: 24%; text-align:center!important">Nama</th>
                  <th style="width: 24%; text-align:center!important">No Rekam Medis</th>
             
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

<script>
$(document).ready(function() {
  $('#dashboard').addClass('active');
  var toolbar = {
    'form': $('#toolbar_form'),
    'src_btn': $('#src_btn'),
    'date_before': $('#toolbar_form').find('#date_before'),
    'date_after': $('#toolbar_form').find('#date_after'),
  }

  var date = new Date();
  var dd = String(date.getDate());
  if(dd.length == 1) dd = '0'+dd;
  var mm = String(date.getMonth()+1);
  if(mm.length == 1) mm = '0'+mm;
  var yy = String(date.getFullYear()); 
  date = yy+'-'+mm+'-'+dd;
  toolbar.date_before.val(date)

  var swalPembayaranConfigure = {
    title: "Konfirmasi Pembayaran",
    text: "Yakin akan konfirmasi pembayaran ini?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#18a689",
    confirmButtonText: "Ya!",
  };

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3], className: 'text-center'}, ],
    deferRender: true,
    'ordering': true,
    'paging': true,
    'searching': true
  });
  getTim();
  function getTim(){
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllRecord/')?>`, 
        data : toolbar.form.serialize(),
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

  toolbar.form.submit(function(event){
    console.log('src')
    buttonLoading(toolbar.src_btn);
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllRecord/')?>`, 
        data : toolbar.form.serialize(),
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
        buttonIdle(toolbar.src_btn);
      },
      error: function(e) {}, 
    });
  });

  function renderRecord(data){
    if(data == null || typeof data != "object"){
      console.log("User::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    Object.values(data).forEach((record) => {
      var detailButton = `<a class="btn btn-success" href="<?=site_url("RSController/DetailRecord/")?>?id_record=${record['id_record']}" class="dropdown-item"><i class='fa fa-pencil'></i>Form Rekam Medis</a>`;
      var pembayaranButton = `<button class="pembayaran btn btn-warning" data-id='${record['id_record']}'><i class='fa fa-note'></i>Konfirmasi Pembayaran</button>`;
  
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
      renderData.push([record['no_antri'],record['tanggal_record'],record['nama'],record['no_rekam'], record['status_bayar'] == '0' ? pembayaranButton : detailButton  ]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }

  FDataTable.on('click','.pembayaran', function(){
   console.log('act pembayaran')
   event.preventDefault();
    var id = $(this).data('id');
    swal(swalPembayaranConfigure).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('DinkesController/editRecord')?>", 'type': 'POST',
        data: {'id_record': id, status_bayar : '1'},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Konfirmasi Pembayaran Gagal", json['message'], "error");
            return;
          }
          var record = json['data']
          dataRecord[record['id_record']] = record;
          swal("Konfirmasi Pembayaran Berhasil", "", "success");
          renderRecord(dataRecord);
        },
        error: function(e) {}
      });
    });
   
  });

});
</script>