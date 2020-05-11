<li class="nav-header">
  <div class="dropdown profile-element">
    <img alt="image" class="rounded-circle" style="width:48px; height:48px;" id="header_photo"/>
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <span class="block m-t-xs font-bold"><span id="header_nama"></span> (<span id="header_username"></span>)</span>
        <span class="text-muted text-xs block">
          <span id="header_title"></span>
          <b class="caret"></b>
        </span>
    </a>
    <ul class="dropdown-menu animated fadeInRight m-t-xs">
        <li><a id="profile_btn" class="dropdown-item">Edit Profile</a></li>
        <li><a class="dropdown-item" href="<?=site_url() . 'logout'?>">Logout</a></li>
    </ul>
  </div>
  <div class="logo-element">
      SS
  </div>
</li>