<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="import_form" onsubmit="return false;">
        <select class="form-control mr-sm-2" name="tahun" id="tahun"></select>
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="import_btn" data-loading-text="Loading..."><i class="fal fa-file-upload"></i> Import Data RPJMD Simda</button>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#import_export').addClass('active');
  $('#import_rpjmd_simda').addClass('active');

  var SSection = {
    'form': $('#import_form'),
    'tahun': $('#import_form').find('#tahun'),
    'import_btn': $('#import_btn')
  }

  var dataTahun = {}

  swal({title: 'Loading...', allowOutsideClick: false});
  swal.showLoading();
  $.when(getAllTahun()).then((e) =>{
    swal.close();
  }).fail((e) => { console.log(e) });

  function getAllTahun(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllTahun/')?>`, 'type': 'GET', data: {},
      success: function (data){
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        dataTahun = json['data'];
        renderTahunSelectionFilter(dataTahun);
      },
      error: function(e) {}
    });
  }

  function renderTahunSelectionFilter(data){
    SSection.tahun.empty();
    Object.values(data).reverse().forEach((d) => {
      SSection.tahun.append($('<option>', {
        value: d['tahun'],
        text: d['tahun'],
      }));
    });
  }

  SSection.form.on('submit', function(e){
    e.preventDefault();
    importRPJMD();
  });

  function importRPJMD(){
    buttonLoading(SSection.import_btn)
    $.ajax({
      url: `<?php echo site_url('SyncronizationController/import_rpjmd_simda/')?>`,
      data : SSection.form.serialize(), type: 'POST',
      success: function (data){
        buttonIdle(SSection.import_btn)
        var json = JSON.parse(data);
        if(json['error']){
          swal("Import RPJMD gagal!", json['message'], "error");
          return;
        }
        swal("Import Berhasil", 'Import data RPJMD Simda berhasil!', "success");
      },
      error: function(e) {}
    });
  }
});
</script>
