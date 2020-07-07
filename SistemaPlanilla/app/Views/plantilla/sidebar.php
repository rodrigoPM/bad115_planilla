 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url()?>/img/sin_backup_logo.png" alt="AdminLTE Logo" class="brand-image img-circle "
           style="opacity: .9" >
      <span class="brand-text font-weight-bold">Sin Backup</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="<?= base_url()?>/img/<?= $usuario['img']?>" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="<?= $usuario['url']?>" class="d-block"><?= $usuario['nombre'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <?php foreach ($menus as $index => $menu): ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon <?= $menu['NOMBRE_ICONO']?>"></i>
              <p>
                <?= $menu['NOMBRE_MENU']?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if (isset($menu['submenus'])) : ?>
            <?php foreach ($menu['submenus'] as $submenu): ?>
                <li class="nav-item">
                  <a href="<?= base_url().'/'.$submenu["RUTA_MENU"] ?>" class="nav-link">
                    <i class="fas fa-arrow-alt-circle-right nav-icon"></i>
                    <p><?= $submenu['NOMBRE_MENU']?></p>
                  </a>
                </li>
              <?php endforeach; ?>
            <?php endif ?>
            </ul>
          </li>
          <?php endforeach; ?>

          
         

          <li class="nav-header">Mas</li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url() ?>/login/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Salir 
              </p>
            </a>
           
          </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>