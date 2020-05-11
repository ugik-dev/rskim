<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?>
      <li id="dashboard">
        <a href="<?=site_url('OPMonevController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      <li id="monevAll">
        <a href="<?=site_url('PimpinanController/monevAll')?>"><i class="fa fa-database"></i> <span class="nav-label">Data Renja</span></a>
      </li>
      <li id="kegiatan">
        <a href="<?=site_url('KegiatanController/kegiatan_tim')?>"><i class="fa fa-tasks"></i> <span class="nav-label">Kegiatan</span></a>
      </li>
      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>