<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?">
        <div class="sidebar-brand-text mx-3">THE ZAMRUD JEWELLERY</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= isset($_GET['h']) ? (($_GET['h'] == "") ? "active" : "")  : "active" ?>">
        <a class="nav-link" href="?">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Pengguna
    </div>
    <li class="nav-item <?php
                        if (isset($_GET['h'])) {
                            if ($_GET['h'] == "admin") echo "active";
                            else if ($_GET['h'] == "tambah_admin") echo "active";
                            else if ($_GET['h'] == "edit_admin") echo "active";
                        }
                        ?>">
        <a class="nav-link" href="?h=admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Admin</span></a>
    </li>
    <li class="nav-item <?php
                        if (isset($_GET['h'])) {
                            if ($_GET['h'] == "petugas") echo "active";
                            else if ($_GET['h'] == "tambah_petugas") echo "active";
                            else if ($_GET['h'] == "edit_petugas") echo "active";
                        }
                        ?>">
        <a class="nav-link" href="?h=petugas">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Petugas</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Utama
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#barang" aria-expanded="true" aria-controls="barang">
            <i class="fas fa-fw fa-folder"></i>
            <span>Barang</span>
        </a>
        <div id="barang" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="login.html">Jenis Barang</a>
                <a class="collapse-item" href="register.html">Daftar Barang</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pemasok" aria-expanded="true" aria-controls="pemasok">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pemasok</span>
        </a>
        <div id="pemasok" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="login.html">Daftar Pemasok</a>
                <a class="collapse-item" href="register.html">Penyuplaian</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pameran</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Laporan
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="laporan">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan</span>
        </a>
        <div id="laporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="login.html">1</a>
                <a class="collapse-item" href="register.html">2</a>
                <a class="collapse-item" href="register.html">3</a>
                <a class="collapse-item" href="register.html">4</a>
                <a class="collapse-item" href="register.html">5</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>