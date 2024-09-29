<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" <?php if (in_groups('admin')) {
                                        echo 'href="/admin"';
                                    } elseif (in_groups('designer')) {
                                        echo 'href="/designer"';
                                    } elseif (in_groups('user')) {
                                        echo 'href="/dashboard"';
                                    } ?>><img src="<?= base_url() ?>img/jambedigital.png" class="img-fluid" alt="Jambe Digital"></a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></div>

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= user()->username ?> <img src="/img/<?= user()->user_image ?>" alt="profile" class="rounded-circle img-fluid" width="30"></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><button class="dropdown-item" onclick="logout()">Logout</button></li>
            </ul>
        </li>
    </ul>
</nav>