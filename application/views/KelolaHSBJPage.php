<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox">
    <div class="ibox-content">
      <form class="form-inline" id="import_form" type="multipart">
        <select class="form-control mr-sm-2" name="tahun" id="tahun" required="required"></select>
        <button type="button" class="btn btn-success my-1 mr-sm-2" id="import_btn" data-loading-text="Uploding HSBJ"><i class="fa fa-upload"></i> Upload</button>
        <a href="<?=base_url('assets/templates/template_upload_hsbj.xlsx')?>" class="btn btn-success my-1 mr-sm-2"><i class="fal fa-file-spreadsheet"></i> Template</a>
        <input type="file" id="hsbj_file" name="hsbj_file" style="display:none" accept=".xlsx">
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#hsbj').addClass('active');
  $('#kelola_hsbj').addClass('active');

  var SSection = {
    'import_form': $('#import_form'),
    'tahun': $('#import_form').find('#tahun'),
    'import_btn': $('#import_btn'),
    'hsbj_file': $('#hsbj_file'),
  }

  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  for(var i = currentYear + 2; i >= 2017; i--){
    SSection.tahun.append($('<option>', { value: i, text: i }));
  }
  SSection.tahun.val(currentYear + 1);

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
      url: '<?=site_url("HSBJController/import_hsbj")?>', type: "POST",
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