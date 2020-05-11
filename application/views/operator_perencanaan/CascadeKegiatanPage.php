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
                  <th style="width: 33%; text-align:center!important">Kegiatan Renja</th>
                  <th style="width: 33%; text-align:center!important">Indikator Kegiatan Renja</th>
                  <th style="width: 33%; text-align:center!important">Program Renja</th>
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
            <h4 class="modal-title">Kegiatan Renja --> Program Renja</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="cascade_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <input type="hidden" id="id_indikator_kegiatan_renja" name="id_indikator_kegiatan_renja">
            Kegiatan Renja : <span id="kegiatan_renja"></span>
            Indikator Kegiatan Renja : <span id="indikator_kegiatan_renja"></span>
            <div class="row">
              <div class="col-sm">
                <div class="form-group">
                  <label for="id_program_renja">Program Renja</label> 
                  <select class="form-control mr-sm-2" name="id_program_renja" id="id_program_renja"></select>
                </div>
                <div class="form-group">
                  <label for="id_program_renja">Indikator Renstra</label> 
                  <div id="indikator_renstra"></div>
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
  $('#cascade_kegiatan').addClass('active');

  var FDataTable = $('#FDataTable').DataTable({
    'columnDefs': [],
    ordering: false,
    paging: false,
    rowsGroup: [0],
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
    id_kegiatan_renja: $('#cascade_modal').find('#id_kegiatan_renja'),
    id_indikator_kegiatan_renja: $('#cascade_modal').find('#id_indikator_kegiatan_renja'),
    kegiatan_renja: $('#cascade_modal').find('#kegiatan_renja'),
    indikator_kegiatan_renja: $('#cascade_modal').find('#indikator_kegiatan_renja'),
    renstra: $('#cascade_modal').find('#id_program_renja'),
    indikator_renstra: $('#cascade_modal').find('#indikator_renstra'),
    save_btn: $('#cascade_modal').find('#save'),
  }
  var dataProgramRenja = {};
  var dataKegiatanRenja = {};

  SSection.form.on('submit', function(e){
    e.preventDefault();
    buttonLoading(SSection.showBtn)
    $.when(getProgramRenja(), getKegiatanRenja()).done(function(){
      renderKegiatanRenja(dataKegiatanRenja);
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

  function getProgramRenja(){
    return $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getProgramRenja/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataProgramRenja = json['data'];
        renderRenstraSelect(dataProgramRenja);
      },
      error: function(e) {}
    });
  }

  function renderRenstraSelect(data){
    cascade_modal.renstra.empty();
    cascade_modal.renstra.append($('<option>', { value: "", text: "Program Renja Belum dipilih"}));
    Object.values(data).forEach((e) => {
      cascade_modal.renstra.append($('<option>', {
        value: e['id_program_renja'],
        text: `${e['id_program_renja']} :: ${e['nama_program_renja']}`,
      }));
    });
  }

  cascade_modal.renstra.on('change', function(e){
    var id_program_renja = $(this).val();
    var renstra = dataProgramRenja[id_program_renja];
    var kegiatan = dataKegiatanRenja[cascade_modal.id_kegiatan_renja.val()];
    var indikator_kegiatan = kegiatan['indikator_kegiatan_renja'][cascade_modal.id_indikator_kegiatan_renja.val()];
    renderIndikatorRenstraCheckbox(renstra ? renstra['indikator_program_renja'] : [], indikator_kegiatan['indikator_program_renja']);
  });

  function renderIndikatorRenstraCheckbox(data, checkeds){
    cascade_modal.indikator_renstra.empty();
    Object.values(data).forEach((e) => {
      var checked = checkeds[e['id_indikator_program_renja']] != undefined;
      cascade_modal.indikator_renstra.append(`
        <label><input type='checkbox' value='${e['id_indikator_program_renja']}' name='id_indikator_program_renja[]' ${checked ? 'checked' : ''}>
        ${e['id_indikator_program_renja']} :: ${e['nama_indikator_program_renja']}</label><br>
      `);
    });
  }

  function getKegiatanRenja(){
    return $.ajax({
      url: `<?php echo site_url('OPPerencanaanController/getKegiatanRenja/')?>`,
      data : SSection.form.serialize(),
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataKegiatanRenja = json['data'];
      },
      error: function(e) {}, 
    });
  }

  function renderKegiatanRenja(data){
    if(data == null || typeof data != "object"){
      console.log("Program Renja::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((kegiatan) => {
      var kegiatan_str = `<b>${kegiatan['id_kegiatan_renja']} :: ${kegiatan['nama_kegiatan_renja']}</b>`;
      Object.values(kegiatan['indikator_kegiatan_renja']).forEach((ipr) => {
        var ipr_str = `${ipr['id_indikator_kegiatan_renja']} :: ${ipr['nama_indikator_kegiatan_renja']}`;
        var renstra = dataProgramRenja[ipr['id_program_renja']];
        var renstra_str = renstra == null ? '' : `<b>${renstra['id_program_renja']} :: ${renstra['nama_program_renja']}</b>`;
        var indikator_renstra = renstra == null ? [] : Object.values(renstra['indikator_program_renja'])
          .filter((e) => ipr['indikator_program_renja'][e['id_indikator_program_renja']] != undefined)
        var indikator_renstra_str = Object.values(indikator_renstra).reduce((acc, curr) => `${acc} ${curr['id_indikator_program_renja']} :: ${curr['nama_indikator_program_renja']}<br>`, '<br>Indikator::<br>');
        
        var program_renja_str = (renstra == null || Object.values(indikator_renstra).length == null) ? 
          '<span style="color:red">Program/Indikator Renja belum dipilih.</span>' : `${renstra_str}${indikator_renstra_str}`;
        var change_btn = `
          <button class="change_cascade btn btn-success my-1 mr-sm-2" data-id='${kegiatan['id_kegiatan_renja']}' data-idi='${ipr['id_indikator_kegiatan_renja']}'><i class='fa fa-edit'></i></button>
        `;
        renderData.push([kegiatan_str, ipr_str, program_renja_str, change_btn])
      });
      if(Object.values(kegiatan['indikator_kegiatan_renja']).length == 0) renderData.push([kegiatan_str, '<span style="color:red">Tidak ada Indikator.</span>', '-', '-'])
    });
    FDataTable.clear().rows.add(renderData).draw('full-hold');
  }
  
  FDataTable.on('click', '.change_cascade', function(){
    cascade_modal.self.modal('show');
    var id = $(this).data('id');
    var idi = $(this).data('idi');
    cascade_modal.id_kegiatan_renja.val(id);
    cascade_modal.id_indikator_kegiatan_renja.val(idi);
    var renstra = dataKegiatanRenja[id];
    cascade_modal.kegiatan_renja.html(renstra['nama_kegiatan_renja']);
    var indikator_renstra = renstra['indikator_kegiatan_renja'][idi];
    cascade_modal.indikator_kegiatan_renja.html(indikator_renstra['nama_indikator_kegiatan_renja']);
    cascade_modal.renstra.val(indikator_renstra['id_program_renja']).trigger('change');
  });

  cascade_modal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(cascade_modal.save_btn);
    $.ajax({
      url: "<?=site_url('OPPerencanaanController/setProgramRenja')?>",
      type: "POST",
      data: cascade_modal.form.serialize(),
      success: (data) => {
        buttonIdle(cascade_modal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Ganti Program Renja gagal", json['message'], "error");
          return;
        } 
        swal("Berhasil disimpan", 'Ganti sasaran Renstra berhasil', "success");
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
