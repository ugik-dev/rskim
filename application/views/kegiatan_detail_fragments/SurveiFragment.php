<div class="wrapper wrapper-content animated fadeInRight">
  <div id="survei_container"></div>
  <div class="row">
    <div class="col-lg-4">
      <button class="btn btn-success my-1 mr-sm-2" id="add_survei_btn" disabled><i class='fa fa-plus'></i> Tambah Survei</button>
    </div>
  </div>
</div>

<div class="modal inmodal" id="survei_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Kelola Survei</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="cascade_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <input type="hidden" id="id_kegiatan_survei" name="id_kegiatan_survei">
            <div class="row">
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="pemeriksa">Pemeriksa</label> 
                  <input type="text" class="form-control" id="pemeriksa" name="pemeriksa" placeholder="Tidak ada" required="required">
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="tanggal">Tanggal</label> 
                  <div class="input-group date" id="tanggal_container">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="tanggal" name="tanggal" required="required">
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="kendala">Kendala</label> 
              <textarea type="text" id="kendala" class="form-control" name="kendala" placeholder="Tidak ada" rows="5" required="required"></textarea>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label> 
              <textarea type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Tidak ada" rows="5" required="required"></textarea>
            </div>
            <div class="form-group">
              <label for="add_attachment">Attachment</label>
              <div id="kma_container"></div>
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
<style>
  th { font-size: 11px; text-align: center; }
  td { font-size: 11px; padding-left: 4px; }
  h2 { margin-top: 10px; margin-bottom: 20px; }
  .ppj-thumbnail { margin-right: 6px; float:left }
</style>    
<script type="text/javascript">
$(document).ready(function() {
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);

  var id_kegiatan_renja = `<?=$contentData['id_kegiatan_renja']?>`;
  var survei_container = $('#survei_container');
  var add_survei_btn = $('#add_survei_btn');
  
  if(sessionData['id_role'] != 6){
    add_survei_btn.hide();
  }
  
  var surveiModal = {
    self: $('#survei_modal'),
    form: $('#cascade_form'),
    id_kegiatan_renja: $('#survei_modal').find('#id_kegiatan_renja'),
    id_kegiatan_survei: $('#survei_modal').find('#id_kegiatan_survei'),
    pemeriksa: $('#survei_modal').find('#pemeriksa'),
    tanggal: $('#survei_modal').find('#tanggal'),
    kendala: $('#survei_modal').find('#kendala'),
    keterangan: $('#survei_modal').find('#keterangan'),
    kma_attachment: null,
    'addBtn': $('#survei_modal').find('#add_btn'),
    'saveEditBtn': $('#survei_modal').find('#save_edit_btn'),
  }

  surveiModal.kma_attachment = new FileUploaderV2($('#kma_container'), {'add': "<?=site_url('KegiatanSurveiController/addAttachment')?>", 'delete': "<?=site_url('KegiatanSurveiController/deleteAttachment')?>"}, 'id_kegiatan_survei_attachment', surveiModal),

  $('#tanggal_container').datepicker({                
    todayBtn: "linked",
    autoclose: true,
    format: "yyyy-mm-dd"
  });
          
  var dataSurvei = {};

  $.when(getSurvei()).done(() => {
    add_survei_btn.prop('disabled', false);
  })

  function getSurvei(){
    return $.ajax({
      url: `<?php echo site_url('KegiatanSurveiController/get/')?>`,
      data : { id_kegiatan_renja: id_kegiatan_renja },
      type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataSurvei = json['data'];
        renderSurvei(dataSurvei);
      },
      error: function(e) {}, 
    });
  }

  function renderSurvei(data){
    if(data == null || typeof data != "object"){
      console.log("Informasi::UNKNOWN DATA");
      return;
    }
    counter = 1;
    survei_container.empty();
    Object.values(data['survei']).forEach((e) => {
      var editButton = `<a class="edit_survei dropdown-item" data-id='${e['id_kegiatan_survei']}'><i class='fa fa-pencil'></i> Edit Survei</a>`;
      var deleteButton = `<a class="delete_survei dropdown-item" data-id='${e['id_kegiatan_survei']}'><i class='fa fa-trash'></i> Hapus Survei</a>`;
      var button = `
        <div class="btn-group" role="group">
          <button id="action" type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-bars'></i></button>
          <div class="dropdown-menu" aria-labelledby="action">
            ${editButton}
            ${deleteButton}
          </div>
        </div>
      `;
      survei_container.append(`
        <div class="panel panel-default">
          <div class="panel-heading">Survei #${counter++}<span style="float: right;">${sessionData['id_role'] == 6 ? button : '-'}</span></div>
            <div class="panel-body" style="padding-top:8px">
              <div class="row">
                <div class="col-sm-6"><h4>Tanggal</h4><p>${e['tanggal']}</p></div>
                <div class="col-sm-6"><h4>Pemeriksa</h4><p>${e['pemeriksa']}</p></div>
              </div>
              <h4>Kendala</h4><p>${e['kendala']}</p>
              <h4>Keterangan</h4><p>${e['keterangan']}</p>
              <h4>Attachment</h4><div id="kma_container_${e['id_kegiatan_survei']}"></div>
            </div>
          </div>
        </div>
      `);
      var kma_attachment = new FileUploaderV2($(`#kma_container_${e['id_kegiatan_survei']}`), {'add': "", 'delete': ""}, 'id_kegiatan_survei_attachment', surveiModal);
      kma_attachment.updateAttachment(e['attachment'], true);
    });

    survei_container.find('.edit_survei').unbind('click').on('click', (e) => {
      var id = $(e.target).data('id');
      showSurveiEditModal(id);
    });
    survei_container.find('.delete_survei').unbind('click').on('click', (e) => {
      var id = $(e.target).data('id');
      deleteSurvei(id);
    });
    if(Object.keys(data['survei']).length == 0) survei_container.html('<h2>Tidak Ada</h2>');
  }

  add_survei_btn.on('click', (e) => {
    surveiModal.id_kegiatan_renja.val(id_kegiatan_renja);
    surveiModal.kma_attachment.updateAttachment([]);
    surveiModal.addBtn.show();
    surveiModal.saveEditBtn.hide();
    surveiModal.self.modal("show");
  });

  function showSurveiEditModal(id){
    var currentData = dataSurvei['survei'][id];
    surveiModal.id_kegiatan_renja.val(id_kegiatan_renja);
    surveiModal.id_kegiatan_survei.val(id);
    surveiModal.pemeriksa.val(currentData['pemeriksa']);
    surveiModal.tanggal.val(currentData['tanggal']);
    surveiModal.kendala.val(currentData['kendala']);
    surveiModal.keterangan.val(currentData['keterangan']);
    surveiModal.kma_attachment.updateAttachment(currentData['attachment']);
    surveiModal.addBtn.hide();
    surveiModal.saveEditBtn.show();
    surveiModal.self.modal("show");
  }

  surveiModal.self.on('hidden.bs.modal', function () {
    surveiModal.form.trigger('reset'); 
  })
  
  surveiModal.form.submit(function(event) {
    event.preventDefault();
    var isAdd = surveiModal.addBtn.is(':visible');
    var url = "<?=site_url('KegiatanSurveiController/')?>";
    url += isAdd ? "add" : "edit";
    var button = isAdd ? surveiModal.addBtn : surveiModal.saveEditBtn;

    swal(SWALSAVE).then((result) => {
      if(!result.value){ return; }
      buttonLoading(button);
      $.ajax({
        url: url, 'type': 'POST',
        data: surveiModal.form.serialize(),
        success: function (data){
          buttonIdle(button);
          var json = JSON.parse(data);
          if(json['error']){
            swal("Simpan Gagal", json['message'], "error");
            return;
          }
          dataSurvei = json['data']
          swal("Simpan Berhasil", "", "success");
          renderSurvei(dataSurvei);
          surveiModal.self.modal('hide');
        },
        error: function(e) {}
      });
    });
  });

  function deleteSurvei(id){
    swal(SWALDELETE).then((result) => {
      if(!result.value){ return; }
      $.ajax({
        url: "<?=site_url('KegiatanSurveiController/delete')?>", 'type': 'POST',
        data: {id_kegiatan_survei: id},
        success: function (data){
          var json = JSON.parse(data);
          if(json['error']){
            swal("Delete Gagal", json['message'], "error");
            return;
          }
          delete dataSurvei['survei'][id];
          swal("Delete Berhasil", "", "success");
          renderSurvei(dataSurvei);
          kegiatanModal.self.trigger('show.bs.modal');
        },
        error: function(e) {}
      });
    });
  }
});
</script>
