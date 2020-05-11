<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox ssection-container">
    <div class="ibox-content">
      <form class="form-inline" id="import_form" onsubmit="return false;">
        <button type="submit" class="btn btn-success my-1 mr-sm-2" id="import_btn" data-loading-text="Loading..."><i class="fal fa-file-upload"></i> Import Data RPJMD dari EPlanning</button>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#import_rpjmd').addClass('active');
  $('#import_export').addClass('active');
  $('#import_rpjmd_eplanning').addClass('active');

  SSection = {
    'form': $('#import_form'),
    'import_btn': $('#import_btn')
  }

  SSection.form.on('submit', function(e){
    e.preventDefault();
    importRPJMD();
  });

  function importRPJMD(){
    buttonLoading(SSection.import_btn)
    $.ajax({
      url: `<?php echo site_url('CascadeController/importCascade/')?>`,
      data : {},
      type: 'POST',
      success: function (data){
        buttonIdle(SSection.import_btn)
        var json = JSON.parse(data);
        if(json['error']){
          swal("Import RPJMD gagal!", json['message'], "error");
          return;
        }
        swal("Import Berhasil", 'Import data RPJMD E-Planning berhasil!', "success");
      },
      error: function(e) {}
    });
  }
});
</script>
