<?php $base_url = 'http://'.$_SERVER['SERVER_NAME']; ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="index3.html" class="brand-link">
    <img src="<?php echo $base_url; ?>/admin/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">MedKIOSK</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo $base_url; ?>/admin/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block text-uppercase"><?php echo $_SESSION['name']; ?></a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/admin" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/users" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/branches" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Branches
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>