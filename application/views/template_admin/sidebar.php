<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('admin/dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-university"></i>
                </div>
                <div class="sidebar-brand-text">SISFO-AKADEMIK </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('admin/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php $menu = menu() ?>
            <?php foreach($menu as $key): ?>
                <?php $id = $key->id_menu ?>
                <?php $subMenu = sub_menu($id) ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $key->id_menu ?>" aria-expanded="true" aria-controls="collapse<?= $key->id_menu ?>">
                        <i class="<?= $key->icon ?>"></i>
                        <span><?= $key->nama_menu ?></span>
                    </a>
                    <div id="collapse<?=$key->id_menu ?>" class="collapse" aria-labelledby="heading<?= $key->id_menu ?>" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Sub-menu <?= $key->nama_menu ?></h6>
                    <?php foreach($subMenu as $sm): ?>
                            <a class="collapse-item <?= activate_menu($sm->controller) ?>" href="<?=site_url($sm->url) ?>">
                                    <?= $sm->nama_submenu ?>
                            </a>
                    <?php endforeach ?>
            <?php endforeach ?>
            
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">

                            <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('username') ?></span>
                                <i class="img-profile fas fa-fw fa-user fa-2x"> </i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in " aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?=site_url('ganti-password') ?>">
                                    <i class="fas fa-key fa-sm fa-fw mr-2"></i>
                                    Ganti password
                                </a>
                                <a  href="" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->