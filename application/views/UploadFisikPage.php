<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox">
    <div class="ibox-content">
      <form class="form-inline" id="import_form" type="multipart">
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required"></select>
        <button type="button" class="btn btn-success my-1 mr-sm-2" id="import_btn" data-loading-text="Uploding HSBJ"><i class="fa fa-upload"></i> Upload</button>
        <a href="<?=base_url('assets/templates/template_upload_fisik.xls')?>" class="btn btn-success my-1 mr-sm-2"><i class="fal fa-file-spreadsheet"></i> Template</a>
        <input type="file" id="hsbj_file" name="hsbj_file" style="display:none" accept=".xls">
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#upload_fisik').addClass('active');

  var dataTahun = {}
  
  var SSection = {
    'import_form': $('#import_form'),
    'tahun': $('#import_form').find('#tahun'),
    'import_btn': $('#import_btn'),
    'hsbj_file': $('#hsbj_file'),
  }

  swal({title: 'Loading...', allowOutsideClick: false});
  swal.showLoading();
  $.when(getAllTahun()).then((e) =>{
    swal.close();
  }).fail((e) => { console.log(e) });

  function getAllTahun(){
    return $.ajax({
      url: `<?php echo site_url('SharedController/getAllTahun/')?>`, 'type': 'GET',
      data: {},
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

  SSection.import_btn.on('click', (e) => {
    SSection.hsbj_file.click();
  });

  SSection.hsbj_file.on('change', function(){
    if(this.files.length >= 1){
      importHSBJ();
    }
  });

  function importHSBJ(){
    buttonLoading(SSection.import_btn);
    $.ajax({
      url: '<?=site_url("OPMonevController/upload_fisik_process")?>', type: "POST",
      data: new FormData(SSection.import_form[0]), contentType: false, processData: false,
      success: function (result){
        buttonIdle(SSection.import_btn);
        SSection.hsbj_file.val(null);
        var json = JSON.parse(result);
        if(json['error']){
          swal("Upload Gagal", json['message'], "error");
          return;
        }
        swal("Simpan Berhasil", "", "success");
      },
      error: function(status){
        SSection.hsbj_file.val(null);
        buttonIdle(SSection.import_btn);
      }
    });
  }
});
</script>