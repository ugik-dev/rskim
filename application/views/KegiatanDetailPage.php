<div class="tabs-container">
  <ul class="nav nav-tabs" role="tablist">
    <li><a class="nav-link" data-toggle="tab" href="#info"> Informasi Umum</a></li>
    <li><a class="nav-link" data-toggle="tab" href="#monitoring">Monitoring</a></li>
    <li><a class="nav-link" data-toggle="tab" href="#target">Target</a></li>
    <li><a class="nav-link" data-toggle="tab" href="#realisasi">Realisasi</a></li>
    <li><a class="nav-link" data-toggle="tab" href="#survei">Survei</a></li>
  </ul>
  <div class="tab-content">
    <div role="tabpanel" id="info" class="tab-pane"><div class="panel-body"></div></div>
    <div role="tabpanel" id="monitoring" class="tab-pane"><div class="panel-body"></div></div>
    <div role="tabpanel" id="target" class="tab-pane"><div class="panel-body"></div></div>
    <div role="tabpanel" id="realisasi" class="tab-pane"><div class="panel-body"></div></div>
    <div role="tabpanel" id="survei" class="tab-pane"><div class="panel-body"></div></div>
  </div>
</div>
<style>
  .tabs-container { margin: 0px -15px; }
  .ibox-content { background-color: #f7f7f7;}
  .tabs-container .panel-body { padding-top: 0px }
</style>
<script src="<?=base_url('assets/')?>js/FileUploaderV2.js"></script>
<script>
$(document).ready(function() {
  $('#monevAll').addClass('active');
  var id_kegiatan_renja = `<?=$contentData['id_kegiatan_renja']?>`;
  tahun = `<?=$contentData['tahun']?>`;
  var prevState = Object.fromEntries(new URLSearchParams(window.location.search));
  var load_state = {info: false, monitoring: false, survei: false, fisik: false};
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href");
    if(load_state[`#${target}`]) return; 
    if(["#monitoring", "#target", "#realisasi"].includes(target)){
      swal({title: 'Loading...', allowOutsideClick: false});
      swal.showLoading();
    }

    if(target == "#info") {
      $('#info div').load(`<?=site_url()?>KegiatanController/info_fragment?id_kegiatan_renja=${id_kegiatan_renja}`);
    } else if(target == "#monitoring") {
      $('#monitoring div').load(`<?=site_url()?>KegiatanController/monitoring_fragment?id_kegiatan_renja=${id_kegiatan_renja}`);
    } else if(target == "#target") {
      $('#target div').load(`<?=site_url()?>KegiatanController/target_fragment?id_kegiatan_renja=${id_kegiatan_renja}`);
    } else if(target == "#realisasi") {
      $('#realisasi div').load(`<?=site_url()?>KegiatanController/realisasi_fragment?id_kegiatan_renja=${id_kegiatan_renja}`);
    } else if(target == "#survei") {
      $('#survei div').load(`<?=site_url()?>KegiatanController/survei_fragment?id_kegiatan_renja=${id_kegiatan_renja}`);
    }
    load_state[`#${target}`] = true;
  });
  $(`a[href="#${!empty(prevState['tab']) ? prevState['tab'] : 'info'}"]`).tab('show');
});
</script>