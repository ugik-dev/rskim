<div id="wrapper">

<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <?= $this->load->view('Fragment/SidebarHeaderFragment', NULL, TRUE);?>
      <li id="dashboard">
        <a href="<?=site_url('AdminController/')?>"><i class="fa fa-home"></i> <span class="nav-label">Beranda</span></a>
      </li>
      <li id="data_induk">
        <a href="<?=site_url('AdminController/data_induk')?>"><i class="fa fa-database"></i> <span class="nav-label">Data DTKS Kemensos</span></a>
      </li>
      <!-- <li id="data_umkm">
        <a href="<?=site_url('AdminController/data_umkm')?>"><i class="fa fa-database"></i> <span class="nav-label">Data UMKM</span></a>
      </li> -->
      <li id="kategori">
        <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Kategori Bantuan</span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level" aria-expanded="true">
          <li id="kategori1"><a href="<?=site_url('AdminController/kategori1')?>">1. PKH dan BPNT </a></li>
          <li id="kategori2"><a href="<?=site_url('AdminController/kategori2')?>">2. BPNT  </a></li>
          <li id="kategori3"><a href="<?=site_url('AdminController/kategori3')?>">3. Non PKH & BPNT </a></li>
          <li id="kategori4"><a href="<?=site_url('AdminController/kategori4')?>">4. (Dinas Pemberdayaan Masyarakat Desa)  yang belum menerima kategori 1,2,3 dan 6 </a></li>
          <li id="kategori5"><a href="<?=site_url('AdminController/kategori5')?>">5. (Dinas Kesehatan)  </a></li>
          <li id="kategori6"><a href="<?=site_url('AdminController/kategori6')?>">6. (Dinas Koperasi & UMKM) yang belum menerima kategori 1,2,3 dan 4 </a></li>
          <li id="kategori7"><a href="<?=site_url('AdminController/kategori7')?>">7. (Dinas Tenaga Kerja) yang belum menerima kategori 1,2,3,4 dan 6 </a></li>
        </ul>
      </li>
      <!-- <li id="kelola_user">
        <a href="<?=site_url('AdminController/kelola_user')?>"><i class="fa fa-users-cog"></i> <span class="nav-label">Kelola User</span></a>
      </li> -->
      <li id="terdampak_phk">
        <a href="<?=site_url('AdminController/terdampak_phk')?>"><i class="fa fa-database"></i> <span class="nav-label">Terdampak PHK</span></a>
      </li>
      <!-- <li id="prior_phk">
        <a href="<?=site_url('AdminController/prior_phk')?>"><i class="fa fa-database"></i> <span class="nav-label">Prioritas PHK</span></a>
      </li> -->
      <li id="terdampak_dirumahkan">
        <a href="<?=site_url('AdminController/terdampak_dirumahkan')?>"><i class="fa fa-database"></i> <span class="nav-label">Terdampak Dirumahkan</span></a>
      </li>
      <!-- <li id="prior_dirumahkan">
        <a href="<?=site_url('AdminController/prior_dirumahkan')?>"><i class="fa fa-database"></i> <span class="nav-label">Prioritas Dirumahkan</span></a>
      </li> -->
     
      <!-- <li id="panduan">
        <a href="<?=site_url('AdminController/panduan')?>"><i class="fa fa-question"></i> <span class="nav-label">Panduan</span></a>
      </li> -->
      <li id="logout">
        <a href="#" class="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Logout</span></a>
      </li>
  </div>
</nav>
<script>
$(document).ready(function() {});
</script>