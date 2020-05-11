  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content" style="background-color:#fff">
          <div class="table-responsive">
            <table id="TargDataTable" class="table table-bordered" style="padding:0px">
              <thead>
                <tr>
                  <th>Bulan</th>
                  <th style="width:30%">Target Keuangan (%)</th>
                  <th style="width:30%">Target Fisik (%)</th>
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

<div class="modal inmodal" id="target_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Target</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="target_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <input type="hidden" id="bulan" name="bulan">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="bulan">Bulan</label> 
                  <input type="text" class="form-control" id="nama_bulan" name="nama_bulan" readonly>
                </div>
              </div>
              <div class="col-sm">
                <div class="form-group">
                  <label for="target_keuangan">Target Keuangan (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="target_keuangan" name="target_keuangan" required="required">
                </div>
              </div>
              <div class="col-sm">
                <div class="form-group">
                  <label for="target_fisik">Target Fisik (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="target_fisik" name="target_fisik" required="required">
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
<style>
  #TargDataTable th { text-align: center; }
  #TargDataTable td { padding-left: 4px; }
</style>
<script type="text/javascript">
$(document).ready(function() {
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);
 
  var id_kegiatan_renja = `<?=$contentData['id_kegiatan_renja']?>`;
  var TargDataTable = $('#TargDataTable').DataTable({
    'columnDefs': [{ targets: [0, 1, 2, 3], className: 'text-center'}],
    searching: false,
    ordering: false,
    paging: false,
    info: false
  });

  var target_modal = {
    self: $('#target_modal'),
    form: $('#target_form'),
    id_kegiatan_renja: $('#target_modal').find('#id_kegiatan_renja'),
    bulan: $('#target_modal').find('#bulan'),
    nama_bulan: $('#target_modal').find('#nama_bulan'),
    target_keuangan: $('#target_modal').find('#target_keuangan'),
    target_fisik: $('#target_modal').find('#target_fisik'),
    save_btn: $('#target_modal').find('#save'),
  }

  var dataTarget = {};

  getTarget()
  function getTarget(){
    return $.ajax({
      url: `<?php echo site_url('KegiatanTargetController/get/')?>`, data : {id_kegiatan_renja: id_kegiatan_renja}, type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataTarget = json['data'];
        renderTarget(dataTarget);
        swal.close();
      },
      error: function(e) {}, 
    });
  }

  function renderTarget(data){
    if(data == null || typeof data != "object"){
      console.log("Fisik::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((target) => {
      var action = `
        <button class="input_target btn btn-success btn-xs" data-id='${target['bulan']}'><i class='fa fa-edit'></i></button>
      `;
      renderData.push([target['nama_bulan'], target['target_keuangan'], target['target_fisik'], sessionData['id_role'] == 6 ? action : '-']);
    });
    TargDataTable.clear().rows.add(renderData).draw('full-hold');
  }
  
  TargDataTable.on('click', '.input_target', function(){
    target_modal.self.modal('show');
    var id = $(this).data('id');
    var target = dataTarget[id];
    target_modal.id_kegiatan_renja.val(target['id_kegiatan_renja']);
    target_modal.bulan.val(target['bulan']);
    target_modal.nama_bulan.val(target['nama_bulan']);
    target_modal.target_keuangan.val(target['target_keuangan']);
    target_modal.target_fisik.val(target['target_fisik']);
  });

  target_modal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(target_modal.save_btn);
    $.ajax({
      url: "<?=site_url('KegiatanTargetController/set')?>",
      type: "POST",
      data: target_modal.form.serialize(),
      success: (data) => {
        buttonIdle(target_modal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Ganti Target Kegiatan gagal", json['message'], "error");
          return;
        } 
        dataTarget = json['data'];
        renderTarget(dataTarget);
        swal("Berhasil disimpan", 'Input Target Berhasil', "success");
        target_modal.self.modal('hide');
      },
      error: () => {
        buttonIdle(target_modal.save_btn);
      },
    });
  });

});
</script>
