<div class="wrapper wrapper-content animated fadeInRight" id="info_container">
  <div class="row">
    <div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-content">
          <h5>Riwayat Cek</h5>
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered table-hover" style="padding:0px">
              <thead>
                <tr>
                  <th style="width: 12%; text-align:center!important">Nama / NIK</th>
                  <th style="width: 24%; text-align:center!important">Status</th>
                  <th style="width: 24%; text-align:center!important">Rekomendasi</th>
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
  
<script>
$(document).ready(function() {
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);
  $('#evaluasi').addClass('active');  

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [0, 3, 4], className: 'text-center'}, ],
    deferRender: true,
    'ordering': false,
    'paging': false,
    'searching': false
  });

  getTim()
  function getTim(){
    return $.ajax({
        url: `<?php echo site_url('DinkesController/getAllRecord/')?>`, 
        data : {tahap : '1'},
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
      renderData.push([record['nama']+" / "+record['NIK'], convStatus(record['before_status']), record['rumah_sakit'],record['tanggal_record'],detailButton]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
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
});
</script>