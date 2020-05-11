<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?>
      <li id="dashboard">
        <a href="<?=site_url('PasienController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      <!-- <li id="sampel">
        <a href="<?=site_url('PasienController/sampel')?>"><i class="fa fa-database"></i> <span class="nav-label">Sampel</span></a>
      </li> -->
      <li id="tracking">
        <a href="<?=site_url('PasienController/tracking')?>"><i class="fa fa-database"></i> <span class="nav-label">Riwayat Jalan</span></a>
      </li>
      <li id="kontak">
        <a href="<?=site_url('PasienController/kontak')?>"><i class="fa fa-database"></i> <span class="nav-label">Riwayat Kontak</span></a>
      </li>
      <!-- <li id="data_pasien">
        <a href="<?=site_url('PasienController/data_pasien')?>"><i class="fa fa-database"></i> <span class="nav-label">Data Dinkes</span></a>
      </li> -->
      <!-- <li id="terdampak_phk">
        <a href="<?=site_url('PasienController/terdampak_phk')?>"><i class="fa fa-database"></i> <span class="nav-label">Terdampak PHK</span></a>
      </li>
      <li id="terdampak_dirumahkan">
        <a href="<?=site_url('PasienController/terdampak_dirumahkan')?>"><i class="fa fa-database"></i> <span class="nav-label">Terdampak Dirumahkan</span></a>
      </li> -->
      <!-- <li id="panduan">
        <a href="<?=site_url('PasienController/panduan')?>"><i class="fa fa-question"></i> <span class="nav-label">Panduan</span></a>
      </li> -->
      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>