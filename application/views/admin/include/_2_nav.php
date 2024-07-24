<nav class="navbar navbar-expand-sm bg-black navbar-white-font">
    <a href="/admin/main/" class="navbar-brand">
        <span class="brand-text font-weight-light">MTMBPPT</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php
            foreach ($menu_list as $menu) {
                if ($menu['visible']) {
            ?>
                    <li class="nav-item d-sm-inline-block">
                        <a href="/admin/<?= $menu['segment'] ?>/" class="nav-link white-font <?= ($menu['current']) ? 'active' : '' ?>">
                            <?= $menu['name'] ?>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link white-font" href="/" target="_blank">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link white-font" href="https://nestjejuds.com/admin/" target="_blank">MTMBPPT</a>
            </li>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle white-font" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">&nbsp; <?= $this->session->userdata('adm_id') ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" id="btn-logout"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="content-wrapper">