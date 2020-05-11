<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="showForm" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="id_opd" id="id_opd" <?=!$this->session->userdata("admin_opd") ? "readonly='readonly'" : ''?> style="width:400px"></select>
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required">
          <option value>-- Pilih Periode --</option>
          <option value='2018'>2017 - 2022</option>
          <option value='2014'>2012 - 2017</option>
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
                  <th style="width: 33%; text-align:center!important">Sasaran Renstra</th>
                  <th style="width: 33%; text-align:center!important">Indikator Renstra</th>
                  <th style="width: 33%; text-align:center!important">Sasaran RPJMD</th>
                  <th style="text-align:center!important">Action</th>
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

<div class="modal inmodal" id="cascade_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Sasaran Renstra --> Sasaran RPJMD</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="cascade_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_sasaran_renstra" name="id_sasaran_renstra">
            <input type="hidden" id="id_indikator_sasaran_renstra" name="id_indikator_sasaran_renstra">
            Sasaran Renstra : <span id="sasaran_renstra"></span><br>
            Indikator Sasaran Renstra : <span id="indikator_sasaran_renstra"></span>
            <div class="row">
              <div class="col-sm">
                <div class="form-group">
                  <label for="id_sasaran_rpjmd">Sasaran RPJMD</label> 
                  <select class="form-control mr-sm-2" name="id_sasaran_rpjmd" id="id_sasaran_rpjmd"></select>
                </div>
                <div class="form-group">
                  <label for="id_sasaran_rpjmd">Indikator RPJMD</label> 
                  <div id="indikator_rpjmd"></div>
                </div>
              </div>
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
       
<script type="text/javascript">
$(document).ready(function() {
  $('#cascade').addClass('active');
  $('#cascade_renstra').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
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

  var cascade_modal = {
    self: $('#cascade_modal'),
    form: $('#cascade_form'),
    id_sasaran_renstra: $('#cascade_modal').find('#id_sasaran_renstra'),
    id_indikator_sasaran_renstra: $('#cascade_modal').find('#id_indikator_sasaran_renstra'),
    sasaran_renstra: $('#cascade_modal').find('#sasaran_renstra'),
    indikator_sasaran_renstra: $('#cascade_modal').find('#indikator_sasaran_renstra'),
    rpjmd: $('#cascade_modal').find('#id_sasaran_rpjmd'),
    indikator_rpjmd: $('#cascade_modal').find('#indikator_rpjmd'),
    save_btn: $('#cascade_modal').find('#save'),
  }
  var dataSasaranRPJMD = {};
  var dataSasaranRenstra = {};

  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.showBtn)
    $.when(getSasaranRPJMD(), getSasaranRenstra()).done(function(){
      renderSasaranRenstra(dataSasaranRenstra);
    }).then((e) => {
      buttonIdle(SSection.showBtn)
    });
  });


  $.when(getAllOPD()).done(() => {
    SSection.showBtn.prop('disabled', false);
  })

  function getAllOPD(){
    return $.ajax({
      url: "<?php echo site_url('SharedController/getAllOPD')?>",
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

  function getSasaranRPJMD(){
    return $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getSasaranRPJMD/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataSasaranRPJMD = json['data'];
        renderRPJMDSelect(dataSasaranRPJMD);
      },
      error: function(e) {}
    });
  }

  function renderRPJMDSelect(data){
    cascade_modal.rpjmd.empty();
    cascade_modal.rpjmd.append($('<option>', { value: "", text: "Sasaran RPJMD Belum dipilih"}));
    Object.values(data).forEach((e) => {
      cascade_modal.rpjmd.append($('<option>', {
        value: e['id_sasaran_rpjmd'],
        text: `${e['id_sasaran_rpjmd']} :: ${e['nama_sasaran_rpjmd']}`,
      }));
    });
  }

  cascade_modal.rpjmd.on('change', function(e){
    id_sasaran_rpjmd = $(this).val();
    rpjmd = dataSasaranRPJMD[id_sasaran_rpjmd];
    var renstra = dataSasaranRenstra[cascade_modal.id_sasaran_renstra.val()];
    var indikator_renstra = renstra['indikator_sasaran_renstra'][cascade_modal.id_indikator_sasaran_renstra.val()];
    renderIndikatorRPJMDCheckbox(rpjmd ? rpjmd['indikator_sasaran_rpjmd'] : [], indikator_renstra['indikator_sasaran_rpjmd']);
  });

  function renderIndikatorRPJMDCheckbox(data, checkeds){
    cascade_modal.indikator_rpjmd.empty();
    Object.values(data).forEach((e) => {
      var checked = checkeds[e['id_indikator_sasaran_rpjmd']] != undefined;
      cascade_modal.indikator_rpjmd.append(`
        <label><input type='checkbox' value='${e['id_indikator_sasaran_rpjmd']}' name='id_indikator_sasaran_rpjmd[]' ${checked ? 'checked' : ''}>
        ${e['id_indikator_sasaran_rpjmd']} :: ${e['nama_indikator_sasaran_rpjmd']}</label><br>
      `);
    });
  }

  function getSasaranRenstra(){
    return $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getSasaranRenstra/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataSasaranRenstra = json['data'];
      },
      error: function(e) {}, 
    });
  }

  function renderSasaranRenstra(data){
    if(data == null || typeof data != "object"){
      console.log("Sasaran Renstra::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((renstra) => {
      var renstra_str = `<b>${renstra['id_sasaran_renstra']} :: ${renstra['nama_sasaran_renstra']}</b>`;
      Object.values(renstra['indikator_sasaran_renstra']).forEach((isre) => {
        var isre_str = `${isre['id_indikator_sasaran_renstra']} :: ${isre['nama_indikator_sasaran_renstra']}`;
        var rpjmd = dataSasaranRPJMD[isre['id_sasaran_rpjmd']];
        var rpjmd_str = rpjmd == null ? '' : `<b>${rpjmd['id_sasaran_rpjmd']} :: ${rpjmd['nama_sasaran_rpjmd']}</b>`;
        var indikator_rpjmd = rpjmd == null ? [] : Object.values(rpjmd['indikator_sasaran_rpjmd'])
          .filter((e) => isre['indikator_sasaran_rpjmd'][e['id_indikator_sasaran_rpjmd']] != undefined)
        var indikator_rpjmd_str = Object.values(indikator_rpjmd).reduce((acc, curr) => `${acc} ${curr['id_indikator_sasaran_rpjmd']} :: ${curr['nama_indikator_sasaran_rpjmd']}<br>`, '<br>Indikator::<br>');
        
        var sasaran_rpjmd_str = (rpjmd == null || Object.values(indikator_rpjmd).length == null) ? 
          '<span style="color:red">Sasaran/Indikator RPJMD belum dipilih.</span>' : `${rpjmd_str}${indikator_rpjmd_str}`;
        var change_btn = `
          <button class="change_cascade btn btn-success my-1 mr-sm-2" data-id='${renstra['id_sasaran_renstra']}' data-idi='${isre['id_indikator_sasaran_renstra']}'><i class='fa fa-edit'></i></button>
        `;
        renderData.push([renstra_str, isre_str, sasaran_rpjmd_str, change_btn])
      });
      if(Object.values(renstra['indikator_sasaran_renstra']).length == 0) renderData.push([renstra_str, '<span style="color:red">Tidak ada Indikator.</span>', '-', '-'])
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
  
  FDataTable.on('click', '.change_cascade', function(){
    cascade_modal.self.modal('show');
    var id = $(this).data('id');
    var idi = $(this).data('idi');
    cascade_modal.id_sasaran_renstra.val(id);
    cascade_modal.id_indikator_sasaran_renstra.val(idi);
    var renstra = dataSasaranRenstra[id];
    cascade_modal.sasaran_renstra.html(renstra['nama_sasaran_renstra']);
    var indikator_renstra = renstra['indikator_sasaran_renstra'][idi];
    cascade_modal.indikator_sasaran_renstra.html(indikator_renstra['nama_indikator_sasaran_renstra']);
    cascade_modal.rpjmd.val(indikator_renstra['id_sasaran_rpjmd']).trigger('change');
  });

  cascade_modal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(cascade_modal.save_btn);
    $.ajax({
      url: "<?=site_url('OPPerencanaanController/setSasaranRPJMD')?>",
      type: "POST",
      data: cascade_modal.form.serialize(),
      success: (data) => {
        buttonIdle(cascade_modal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Ganti Sasaran RPJMD gagal", json['message'], "error");
          return;
        } 
        swal("Berhasil disimpan", 'Ganti sasaran RPJMD berhasil', "success");
        SSection.showBtn.trigger('click');
        cascade_modal.self.modal('hide');
      },
      error: () => {
        buttonIdle(cascade_modal.save_btn);
      },
    });
  });

});
</script>
