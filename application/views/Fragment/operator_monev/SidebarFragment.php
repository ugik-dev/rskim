<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?>
      <li id="dashboard">
        <a href="<?=site_url('OPMonevController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      <li id="upload_fisik">
        <a href="<?=site_url('OPMonevController/upload_fisik')?>"><i class="fa fa-database"></i> <span class="nav-label">Upload Fisik</span></a>
      </li>
      <li id="kelola_user">
        <a href="<?=site_url('OPMonevController/kelola_user')?>"><i class="fa fa-user-cog"></i> <span class="nav-label">Kelola Tim Kegiatan</span></a>
      </li>
      <li id="monevAll">
        <a href="<?=site_url('PimpinanController/monevAll')?>"><i class="fa fa-database"></i> <span class="nav-label">Data Renja</span></a>
      </li>
      <li id="informasi_stats">
        <a href="<?=site_url('KegiatanController/informasi_stats')?>"><i class="fa fa-tasks"></i> <span class="nav-label">Pengisian Info Kegiatan</span></a>
      </li>
      <li id="panduan">
        <a href="<?=site_url('OPMonevController/panduan')?>"><i class="fa fa-question"></i> <span class="nav-label">Panduan</span></a>
      </li>
      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>