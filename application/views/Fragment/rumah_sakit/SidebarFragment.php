<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?> q
      <li id="dashboard">
        <a href="<?=site_url('RSController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      <li id="data_pasien">
        <a href="<?=site_url('RSController/data_pasien')?>"><i class="fa fa-database"></i> <span class="nav-label">Data Pasien</span></a>
      </li>
      <!-- <li id="data_record">
        <a href="<?=site_url('RSController/data_record')?>"><i class="fa fa-database"></i> <span class="nav-label">Data Record</span></a>
      </li> -->
      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>