<div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-content" style="background-color:#fff">
          <div class="table-responsive">
            <table id="RealDataTable" class="table table-bordered" style="padding:0px">
              <thead>
                <tr>
                  <th rowspan="2">Bulan</th>
                  <th style="width:20%" colspan="2">Target</th>
                  <th style="width:24%" colspan="2">Realisasi</th>
                  <th style="width:20%" colspan="2">Capaian</th>
                  <th style="width:20%" rowspan="2">Attachment</th>
                  <th style="width:5%" rowspan="2">Action</th>
                </tr>
                <tr>
                  <th>Uang (%)</th>
                  <th>Fisik (%)</th>
                  <th>Uang (%)</th>
                  <th>Fisik (%)</th>
                  <th>Uang (%)</th>
                  <th>Fisik (%)</th>
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

<div class="modal inmodal" id="realisasi_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated fadeIn">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Input Realisasi</h4>
            <span class="info"></span>
        </div>
        <div class="modal-body" id="modal-body">              
          <form role="form" id="realisasi_form" onsubmit="return false;" type="multipart">
            <input type="hidden" id="id_kegiatan_realisasi" name="id_kegiatan_realisasi">
            <input type="hidden" id="id_kegiatan_renja" name="id_kegiatan_renja">
            <input type="hidden" id="bulan" name="bulan">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="bulan">Bulan</label> 
                  <input type="text" class="form-control" id="nama_bulan" name="nama_bulan" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_keuangan">Realisasi Keuangan (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_keuangan" name="realisasi_keuangan" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_fisik">Realisasi Fisik (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_fisik" name="realisasi_fisik" required="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_keuangan_modal">Realisasi Keuangan - Modal (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_keuangan_modal" name="realisasi_keuangan_modal" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_fisik_modal">Realisasi Fisik - Modal (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_fisik_modal" name="realisasi_fisik_modal" required="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_keuangan_barang_jasa">Realisasi Keuangan - Barang Jasa (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_keuangan_barang_jasa" name="realisasi_keuangan_barang_jasa" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_fisik_barang_jasa">Realisasi Fisik - Barang Jasa (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_fisik_barang_jasa" name="realisasi_fisik_barang_jasa" required="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_keuangan_bl_pegawai">Realisasi Keuangan - BL Pegawai (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_keuangan_bl_pegawai" name="realisasi_keuangan_bl_pegawai" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_fisik_bl_pegawai">Realisasi Fisik - BL Pegawai (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_fisik_bl_pegawai" name="realisasi_fisik_bl_pegawai" required="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_keuangan_btl">Realisasi Keuangan - BTL (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_keuangan_btl" name="realisasi_keuangan_btl" readonly="readonly">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="realisasi_fisik_btl">Realisasi Fisik - BTL (%)</label> 
                  <input type="number" step="0.01" min="0" max="100" class="form-control" id="realisasi_fisik_btl" name="realisasi_fisik_btl" required="required">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="add_attachment">Attachment</label>
              <div id="kra_container"></div>
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
  #RealDataTable th { font-size: 11px; text-align: center; }
  #RealDataTable td { font-size: 11px; padding-left: 4px; }
</style>
<script type="text/javascript">
$(document).ready(function() {
  var sessionData = JSON.parse(`<?=json_encode(DataStructure::slice($this->session->userdata(), ['id_role']))?>`);

  var id_kegiatan_renja = `<?=$contentData['id_kegiatan_renja']?>`;
  var RealDataTable = $('#RealDataTable').DataTable({
    'columnDefs': [{ targets: [0, 1, 2, 3, 4, 5, 6, 8], className: 'text-center'}],
    searching: false,
    ordering: false,
    paging: false,
    info: false
  });

  var realisasi_modal = {
    self: $('#realisasi_modal'),
    form: $('#realisasi_form'),
    id_kegiatan_realisasi: $('#realisasi_modal').find('#id_kegiatan_realisasi'),
    id_kegiatan_renja: $('#realisasi_modal').find('#id_kegiatan_renja'),
    bulan: $('#realisasi_modal').find('#bulan'),
    nama_bulan: $('#realisasi_modal').find('#nama_bulan'),
    realisasi_keuangan: $('#realisasi_modal').find('#realisasi_keuangan'),
    realisasi_fisik: $('#realisasi_modal').find('#realisasi_fisik'),
    realisasi_keuangan_modal: $('#realisasi_modal').find('#realisasi_keuangan_modal'),
    realisasi_fisik_modal: $('#realisasi_modal').find('#realisasi_fisik_modal'),
    realisasi_keuangan_barang_jasa: $('#realisasi_modal').find('#realisasi_keuangan_barang_jasa'),
    realisasi_fisik_barang_jasa: $('#realisasi_modal').find('#realisasi_fisik_barang_jasa'),
    realisasi_keuangan_bl_pegawai: $('#realisasi_modal').find('#realisasi_keuangan_bl_pegawai'),
    realisasi_fisik_bl_pegawai: $('#realisasi_modal').find('#realisasi_fisik_bl_pegawai'),
    realisasi_keuangan_btl: $('#realisasi_modal').find('#realisasi_keuangan_btl'),
    realisasi_fisik_btl: $('#realisasi_modal').find('#realisasi_fisik_btl'),
    save_btn: $('#realisasi_modal').find('#save'),
    kra_container: $('#realisasi_modal').find('#kra_container'),
    kra_uploader: null
  }

  realisasi_modal['kra_uploader'] = new FileUploaderV2(realisasi_modal.kra_container, {'add': "<?=site_url('KegiatanRealisasiController/addAttachment')?>", 'delete': "<?=site_url('KegiatanRealisasiController/deleteAttachment')?>"}, 'id_kegiatan_realisasi_attachment', realisasi_modal);

  var dataRealisasi = {};
  $.when(getRealisasi()).then((e) =>{
    realisasi_modal.kra_uploader.registerDeleteHandler((ctx, id) => { 
      var idp = ctx.parent.bulan.val();
      if(idp) delete dataRealisasi['bulanan'][idp]['attachment'][id] 
    });
  });

  function getRealisasi(){
    return $.ajax({
      url: `<?php echo site_url('KegiatanRealisasiController/get/')?>`, data : {id_kegiatan_renja: id_kegiatan_renja}, type: 'GET',
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataRealisasi = json['data'];
        renderRealisasi(dataRealisasi['bulanan']);
        swal.close();
      },
      error: function(e) {}, 
    });
  }

  function renderRealisasi(data){
    if(data == null || typeof data != "object"){
      console.log("Fisik::UNKNOWN DATA");
      return;
    }
    var i = 0;
    
    var renderData = [];
    var counter = 1;
    Object.values(data).forEach((realisasi) => {
      var action = `
        <button class="input_realisasi btn btn-success btn-xs" data-id='${realisasi['bulan']}'><i class='fa fa-edit'></i></button>
      `;
      var attachment = '';
      Object.values(realisasi['attachment']).forEach((attach) => {
        attachment += `
          <div class="bg-muted p-xs b-r-xs" style="margin-bottom:4px; display:flex; cursor:pointer;" onClick="window.open('<?=base_url()?>${attach['url']}')">
            ${attach['type'] == 'IMAGE' ? 
              `<img style="float:left; margin-right: 4px" src="<?=base_url()?>${attach['url']}" class="img-sm">` : 
              `<div style="float:left; margin-right: 4px"><i class='fa fa-file-alt fa-2x'></i></div>`
            }
            <div style="overflow:hidden; height:2rem; word-break: break-word">${attach['filename']}</div> 
            <div>${attach['size']}KB</div>
          </div>
        `;
      });
      renderData.push([`${realisasi['nama_bulan']}`, `${realisasi['target_keuangan']}%`, `${realisasi['target_fisik']}%`, `${realisasi['realisasi_keuangan']}%<br>(${convertToRupiahV2(realisasi['realisasi_keuangan_rp'])})`, `${realisasi['realisasi_fisik']}%`, coloriseRealisasi(realisasi['capaian_keuangan']), coloriseRealisasi(realisasi['capaian_fisik']), attachment, sessionData['id_role'] == 6 ? action : '-']);
    });
    RealDataTable.clear().rows.add(renderData).draw('full-hold');
  }
  
  RealDataTable.on('click', '.input_realisasi', function(){
    realisasi_modal.self.modal('show');
    var id = $(this).data('id');
    var realisasi = dataRealisasi['bulanan'][id];
    realisasi_modal.id_kegiatan_realisasi.val(realisasi['id_kegiatan_realisasi']);
    realisasi_modal.id_kegiatan_renja.val(realisasi['id_kegiatan_renja']);
    realisasi_modal.bulan.val(realisasi['bulan']);
    realisasi_modal.nama_bulan.val(realisasi['nama_bulan']);
    realisasi_modal.realisasi_keuangan.val(realisasi['realisasi_keuangan']);
    realisasi_modal.realisasi_fisik.val(realisasi['realisasi_fisik']);

    realisasi_modal.realisasi_keuangan_modal.val(realisasi['realisasi_keuangan_modal']);
    realisasi_modal.realisasi_fisik_modal.val(realisasi['realisasi_fisik_modal']);
    realisasi_modal.realisasi_keuangan_barang_jasa.val(realisasi['realisasi_keuangan_barang_jasa']);
    realisasi_modal.realisasi_fisik_barang_jasa.val(realisasi['realisasi_fisik_barang_jasa']);
    realisasi_modal.realisasi_keuangan_bl_pegawai.val(realisasi['realisasi_keuangan_bl_pegawai']);
    realisasi_modal.realisasi_fisik_bl_pegawai.val(realisasi['realisasi_fisik_bl_pegawai']);
    realisasi_modal.realisasi_keuangan_btl.val(realisasi['realisasi_keuangan_btl']);
    realisasi_modal.realisasi_fisik_btl.val(realisasi['realisasi_fisik_btl']);

    realisasi_modal.kra_uploader.updateAttachment(realisasi['attachment']);
  });

  realisasi_modal.form.on('submit', (ev) => {
    ev.preventDefault();
    buttonLoading(realisasi_modal.save_btn);
    $.ajax({
      url: "<?=site_url('KegiatanRealisasiController/set')?>",
      type: "POST",
      data: realisasi_modal.form.serialize(),
      success: (data) => {
        buttonIdle(realisasi_modal.save_btn);
        json = JSON.parse(data);
        if(json['error']){
          swal("Ganti Realisasi Kegiatan gagal", json['message'], "error");
          return;
        } 
        dataRealisasi = json['data'];
        renderRealisasi(dataRealisasi['bulanan']);
        swal("Berhasil disimpan", 'Input Realisasi Berhasil', "success");
        realisasi_modal.self.modal('hide');
      },
      error: () => {
        buttonIdle(realisasi_modal.save_btn);
      },
    });
  });

});
</script>
