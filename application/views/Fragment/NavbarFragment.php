<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a class="logout">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-12">
    <h2><?=!empty($contentData['showBackBtn']) ? "<a onclick='window.history.go(-1); return false;' href='#'><i class='fas fa-arrow-circle-left'></i></a>" : ""?> <?=$title?></h2>
    <?php if (isset($breadcrumb)): ?>
    <ol class="breadcrumb">
      <?php $breadcrumb_num = count($breadcrumb); ?>
      <?php if ($breadcrumb_num > 0): ?>
        <?php foreach ($breadcrumb as $key => $value): ?>
          <?php if ($value != ''): ?>
            <li class="breadcrumb-item">
                <a href="<?=$value?>"><?=mb_strimwidth($key, 0, 38, '...');?></a>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
            <li class="breadcrumb-item active">
                <strong><?= mb_strimwidth($title, 0, 40, '...'); ?></strong>
            </li>
      <?php endif; ?>
    </ol>
    <?php endif; ?>
  </div>
  <!-- <div class="col-lg-5" style="margin:30px 0px 0px 0px">
    <span style="flex:1;display:flex;justify-content:flex-end">
      <div id="nav_info_label" class="p-xs b-r-sm" style="display:none"></div>
      <div id="nav_info" class="bg-muted p-xs b-r-sm" style="display:none"></div>
    </span>
  </div> -->
</div>

<script>
$(document).ready(function() {
  $('.logout').on('click', () => {
    swal({title: 'Logging out...', allowOutsideClick: false});
    swal.showLoading();
    $.ajax({
      url: `<?php echo site_url('UserController/logout/')?>`, 'type': 'POST',
      data: {},
      success: function (data){
        swal.close();
        var json = JSON.parse(data);
        if(json['error']){
          return;
        }
        window.location = "<?=site_url()?>";
      },
      error: function(e) {}
    });
  });
});
</script>