<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="showForm" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="id_opd" id="id_opd" <?=!$this->session->userdata("admin_opd") ? "readonly='readonly'" : ''?> style="width:400px"></select>
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required">
          <option value>-- Pilih Periode --</option>
          <option value='2020'>2020</option>
          <option value='2019'>2019</option>
          <option value='2018'>2018</option>
          <option value='2017'>2017</option>
        </select>  
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="show_btn" data-loading-text="Loading..." disabled="disabled"><i class="fal fa-eye"></i> Tampilkan</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content">
          <div class="table-responsive">
            <table id="FDataTable" class="table table-bordered" style="padding:0px">
              <thead>
                <tr>
                  <th style="width:45%">Program Renja</th>
                  <th style="width:50%">Kegiatan Renja</th>
                  <th style="width:5%">Action</th>
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
<style>
  th { text-align: center; }
  td { font-size: 12px; padding-left: 4px; }
</style>    
<script type="text/javascript">
$(document).ready(function() {
  $('#informasi_stats').addClass('active');

  var prevState = Object.fromEntries(new URLSearchParams(window.location.search));
  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [{ targets: [2], className: 'text-center'}],
    ordering: false,
    paging: false, 
    rowsGroup: [0]
  });

  var SSection = {
    'form': $('#showForm'),
    'opd': $('#id_opd'),
    'tahun': $('#tahun'),
    'showBtn': $('#show_btn')
  }

  var dataAllOPD = {};
  var dataKegiatan = {};

  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.showBtn)
    $.when(getKegiatan()).done(function(){
      renderKegiatan(dataKegiatan);
    }).then((e) => {
      buttonIdle(SSection.showBtn)
    });
  });

  $.when(getAllOPD()).done(() => {
    SSection.showBtn.prop('disabled', false);
    if(prevState['id_kegiatan_renja']){
      SSection.opd.val(prevState['id_opd']);
      SSection.tahun.val(prevState['tahun']);
      SSection.showBtn.trigger('click');
      FDataTable.on('draw', function(){
        if(prevState['searched'] == undefined){
          var row = FDataTable.row(function ( idx, data, node ) {
            return data[1].split('::')[0] === prevState['id_kegiatan_renja'];
          } );
          prevState['searched'] = 1;
          prevState['row_state'] = row;
          if (row.length > 0) 
            row.table().page(Math.floor(row.index() / row.page.len())).draw(false);
        } else if(prevState['searched'] == 1){
          prevState['row_state'].node().scrollIntoView();
          prevState['searched'] = 2;
        }
      })
    }
  })

  function getAllOPD(){
    return $.ajax({
      url: "<?php echo site_url('SharedController/getAllSOPD')?>",
      data : {},
      type: 'POST',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataAllOPD = json['data'];
        renderOPD(dataAllOPD, json['curr']);
      },
      error: function(e) {}
    });
  }

  function renderOPD(data, curr){
    SSection.opd.empty();
    SSection.opd.append($('<option>', { value: "", text: "-- SEMUA OPD --"}));
    Object.values(data).forEach((e) => {
      SSection.opd.append($('<option>', {
        value: e['id_opd'],
        text: `${e['id_opd']}::${e['nama_opd']}`,
      }));
    });

    SSection.opd.val(curr);
  }

  function getKegiatan(){
    return $.ajax({
      url: `<?php echo site_url('KegiatanController/getAllWithInformationStats/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataKegiatan = json['data'];
      },
      error: function(e) {}, 
    });
  }

  function renderKegiatan(data){
    if(data == null || typeof data != "object"){
      console.log("Kegiatan::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((kegiatan) => {
      var program_renja = `${kegiatan['id_program_renja']}::${kegiatan['nama_program_renja']}`;
      var kegiatan_renja = `${kegiatan['id_kegiatan_renja']}::${kegiatan['nama_kegiatan_renja']}`;
      var progress_pengisian = `
        <small>Pengisian Informasi: ${kegiatan['filled']}/${kegiatan['num_of_fields']}</small>
        <div class="progress progress-mini">
            <div style="width: ${(kegiatan['filled'] / kegiatan['num_of_fields']) * 100}%;" class="progress-bar"></div>
        </div>
      `;
      var actionBtn = `
        <button class="detail_kegiatan btn btn-success my-1 mr-sm-2" data-id='${kegiatan['id_kegiatan_renja']}'><i class='fa fa-edit'></i></button>
      `;
      renderData.push([program_renja, kegiatan_renja, actionBtn]);
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
  
  FDataTable.on('click', '.detail_kegiatan', function(){
    var id = $(this).data('id');
    window.history.replaceState({}, "all_kegiatan", `<?=site_url()?>KegiatanController/informasi_stats?${SSection.form.serialize()}&id_kegiatan_renja=${id}`);
    window.location.href = `<?=site_url()?>/KegiatanController/detail?id_kegiatan_renja=${id}&tab=info`;
  });  

});
</script>
