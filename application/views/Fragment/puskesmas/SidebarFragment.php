<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?> 
      <li id="dashboard">
        <a href="<?=site_url('PuskesmasController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      <li id="data_pasien">
        <a href="<?=site_url('PuskesmasController/data_pasien')?>"><i class="fa fa-database"></i> <span class="nav-label">Data Puskesmas</span></a>
      </li>
      <!-- <li id="terdampak_phk">
        <a href="<?=site_url('PuskesmasController/terdampak_phk')?>"><i class="fa fa-database"></i> <span class="nav-label">Terdampak PHK</span></a>
      </li>
      <li id="terdampak_dirumahkan">
        <a href="<?=site_url('PuskesmasController/terdampak_dirumahkan')?>"><i class="fa fa-database"></i> <span class="nav-label">Terdampak Dirumahkan</span></a>
      </li> -->
      <!-- <li id="panduan">
        <a href="<?=site_url('PuskesmasController/panduan')?>"><i class="fa fa-question"></i> <span class="nav-label">Panduan</span></a>
      </li> -->
      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>