<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion <?= $_SESSION['user']['status'] === 'PEGAWAI' ? 'toggled' : ''; ?>" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?">
        <div class="sidebar-brand-text mx-3">THE ZAMRUD JEWELLERY</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= isset($_GET['h']) ? (($_GET['h'] == "") ? "active" : "")  : "active" ?>">
        <a class="nav-link" href="?">
            <i class="fas fa-home"></i>
            <span>Beranda</span></a>
    </li>

    <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
        <div class="sidebar-heading mt-3">
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
                <i class="fas fa-user"></i>
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
                <i class="fas fa-users"></i>
                <span>Petugas</span></a>
        </li>
        <li class="nav-item <?php
                            if (isset($_GET['h'])) {
                                if ($_GET['h'] == "pegawai") echo "active";
                                else if ($_GET['h'] == "tambah_pegawai") echo "active";
                                else if ($_GET['h'] == "edit_pegawai") echo "active";
                            }
                            ?>">
            <a class="nav-link" href="?h=pegawai">
                <i class="fas fa-users"></i>
                <span>Pegawai</span></a>
        </li>
    <?php endif; ?>

    <div class="sidebar-heading mt-3">
        Utama
    </div>
    <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
        <li class="nav-item <?php
                            if (isset($_GET['h'])) {
                                if ($_GET['h'] == "jenis_pembayaran") echo "active";
                                else if ($_GET['h'] == "tambah_jenis_pembayaran") echo "active";
                                else if ($_GET['h'] == "edit_jenis_pembayaran") echo "active";
                            }
                            ?>">
            <a class="nav-link" href="?h=jenis_pembayaran">
                <i class="fas fa-user"></i>
                <span>Jenis Pembayaran</span>
            </a>
        </li>
    <?php endif; ?>
    <li class="nav-item <?= in_array(($_GET['h'] ?? ''), ['jenis_barang', 'barang', 'barang_per_jenis_barang', 'tambah_jenis_barang', 'tambah_barang', 'edit_jenis_barang', 'edit_barang']) ? 'active' : '' ?>">
        <a class="nav-link <?= in_array(($_GET['h'] ?? ''), ['jenis_barang', 'barang', 'barang_per_jenis_barang', 'tambah_jenis_barang', 'tambah_barang', 'edit_jenis_barang', 'edit_barang']) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#barang" aria-expanded="true" aria-controls="barang">
            <i class="fas fa-cubes"></i>
            <span>Barang</span>
        </a>
        <div id="barang" class="collapse <?= in_array(($_GET['h'] ?? ''), ['jenis_barang', 'barang', 'barang_per_jenis_barang', 'tambah_jenis_barang', 'tambah_barang', 'edit_jenis_barang', 'edit_barang']) && ($_SESSION['user']['status'] !== 'PEGAWAI') ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
                    <a class="collapse-item <?= in_array(($_GET['h'] ?? ''), ['jenis_barang', 'tambah_jenis_barang', 'edit_jenis_barang']) ? 'active' : '' ?>" href="?h=jenis_barang">Jenis Barang</a>
                <?php endif; ?>
                <?php if ($_SESSION['user']['status'] === 'PEGAWAI') : ?>
                    <a class="collapse-item" href="?h=barang">Daftar Barang</a>
                <?php else : ?>
                    <a class="collapse-item <?= in_array(($_GET['h'] ?? ''), ['barang', 'barang_per_jenis_barang', 'tambah_barang', 'edit_barang']) ? 'active' : '' ?>" href="?h=barang">Daftar Barang</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <li class="nav-item <?= in_array(($_GET['h'] ?? ''), ['toko', 'toko-jenis_barang', 'toko-jenis_barang-barang', 'penjualan_toko', 'distribusi_barang', 'detail_distribusi_barang', 'detail_penjualan_toko', 'tambah_penjualan_toko', 'tambah_toko', 'tambah_distribusi_barang', 'edit_penjualan_toko', 'edit_toko', 'edit_distribusi_barang']) ? 'active' : '' ?>">
        <a class="nav-link <?= in_array(($_GET['h'] ?? ''), ['toko', 'toko-jenis_barang', 'toko-jenis_barang-barang', 'penjualan_toko', 'distribusi_barang', 'detail_distribusi_barang', 'detail_penjualan_toko', 'tambah_penjualan_toko', 'tambah_toko', 'tambah_distribusi_barang', 'edit_penjualan_toko', 'edit_toko', 'edit_distribusi_barang']) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#toko" aria-expanded="true" aria-controls="toko">
            <i class="fas fa-truck"></i>
            <span>Toko</span>
        </a>
        <div id="toko" class="collapse <?= (in_array(($_GET['h'] ?? ''), ['toko', 'toko-jenis_barang', 'toko-jenis_barang-barang', 'penjualan_toko', 'distribusi_barang', 'detail_distribusi_barang', 'detail_penjualan_toko', 'tambah_penjualan_toko', 'tambah_toko', 'tambah_distribusi_barang', 'edit_penjualan_toko', 'edit_toko', 'edit_distribusi_barang']) && ($_SESSION['user']['status'] !== 'PEGAWAI')) ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
                    <a class="collapse-item <?= in_array(($_GET['h'] ?? ''), ['toko', 'toko-jenis_barang', 'toko-jenis_barang-barang', 'tambah_toko', 'edit_toko']) ? 'active' : '' ?>" href="?h=toko">Daftar Toko</a>
                <?php endif; ?>
                <?php if ($_SESSION['user']['status'] == 'ADMIN' || $_SESSION['user']['status'] == 'PETUGAS') : ?>
                    <a class="collapse-item <?= in_array(($_GET['h'] ?? ''), ['distribusi_barang', 'detail_distribusi_barang', 'tambah_distribusi_barang', 'edit_distribusi_barang']) ? 'active' : '' ?>" href="?h=distribusi_barang">Pendistribusian</a>
                <?php endif; ?>
                <?php if ($_SESSION['user']['status'] === 'PEGAWAI') : ?>
                    <a class="collapse-item" href="?h=penjualan_toko">Penjualan</a>
                <?php else : ?>
                    <a class="collapse-item <?= in_array(($_GET['h'] ?? ''), ['penjualan_toko', 'detail_penjualan_toko', 'tambah_penjualan_toko', 'edit_penjualan_toko', 'detail_penjualan_toko']) ? 'active' : '' ?>" href="?h=penjualan_toko">Penjualan</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php if ($_SESSION['user']['status'] == 'ADMIN' || $_SESSION['user']['status'] == 'PETUGAS') : ?>
        <li class="nav-item <?= in_array(($_GET['h'] ?? ''), ['pemasok', 'penyuplaian', 'detail_penyuplaian', 'detail_return_barang', 'return_barang', 'tambah_pemasok', 'tambah_penyuplaian', 'tambah_return_barang', 'edit_pemasok', 'edit_penyuplaian', 'edit_return_barang']) ? 'active' : '' ?>">
            <a class="nav-link <?= in_array(($_GET['h'] ?? ''), ['pemasok', 'penyuplaian', 'detail_penyuplaian', 'detail_return_barang', 'return_barang', 'tambah_pemasok', 'tambah_penyuplaian', 'tambah_return_barang', 'edit_pemasok', 'edit_penyuplaian', 'edit_return_barang']) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#pemasok" aria-expanded="true" aria-controls="pemasok">
                <i class="fas fa-truck"></i>
                <span>Pemasok</span>
            </a>
            <div id="pemasok" class="collapse <?= in_array(($_GET['h'] ?? ''), ['pemasok', 'penyuplaian', 'detail_penyuplaian', 'detail_return_barang', 'return_barang', 'tambah_pemasok', 'tambah_penyuplaian', 'tambah_return_barang', 'edit_pemasok', 'edit_penyuplaian', 'edit_return_barang']) ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
                        <a class="collapse-item <?= in_array(($_GET['h'] ?? ''), ['pemasok', 'tambah_pemasok', 'edit_pemasok']) ? 'active' : '' ?>" href="?h=pemasok">Daftar Pemasok</a>
                    <?php endif; ?>
                    <a class="collapse-item <?= in_array(($_GET['h'] ?? ''), ['penyuplaian', 'detail_penyuplaian', 'tambah_penyuplaian', 'edit_penyuplaian']) ? 'active' : '' ?>" href="?h=penyuplaian">Penyuplaian</a>
                    <a class="collapse-item <?= in_array(($_GET['h'] ?? ''), ['return_barang', 'detail_return_barang', 'tambah_return_barang', 'edit_return_barang']) ? 'active' : '' ?>" href="?h=return_barang">Return Barang</a>
                </div>
            </div>
        </li>
    <?php endif; ?>
    <?php if ($_SESSION['user']['status'] == 'ADMIN' || $_SESSION['user']['status'] == 'PETUGAS') : ?>
        <li class="nav-item <?= in_array(($_GET['h'] ?? ''), ['pameran', 'detail_pameran', 'tambah_pameran', 'edit_pameran', 'tambah_penjualan_pameran', 'edit_penjualan_pameran']) ? 'active' : '' ?>">
            <a class="nav-link" href="?h=pameran">
                <i class="fas fa-store"></i>
                <span>Pameran</span></a>
        </li>
    <?php endif; ?>
    <?php if ($_SESSION['user']['status'] == 'ADMIN' || $_SESSION['user']['status'] == 'PETUGAS') : ?>
        <div class="sidebar-heading mt-3">
            Laporan
        </div>
        <li class="nav-item <?= in_array(($_GET['h'] ?? ''), ['laporan_barang', 'laporan_penjualan_toko', 'laporan_distribusi_barang', 'laporan_penyuplaian', 'laporan_return_barang', 'laporan_pameran', 'laporan_penjualan_pameran']) ? 'active' : '' ?>">
            <a class="nav-link <?= in_array(($_GET['h'] ?? ''), ['laporan_barang', 'laporan_penjualan_toko', 'laporan_distribusi_barang', 'laporan_penyuplaian', 'laporan_return_barang', 'laporan_pameran', 'laporan_penjualan_pameran']) ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="laporan">
                <i class="far fa-file-pdf"></i>
                <span>Laporan</span>
            </a>
            <div id="laporan" class="collapse <?= in_array(($_GET['h'] ?? ''), ['laporan_barang', 'laporan_penjualan_toko', 'laporan_distribusi_barang', 'laporan_penyuplaian', 'laporan_return_barang', 'laporan_pameran', 'laporan_penjualan_pameran']) ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= isset($_GET['h']) ? (($_GET['h'] == "laporan_barang") ? "active" : "")  : "" ?>" href="?h=laporan_barang">Barang</a>
                    <a class="collapse-item <?= isset($_GET['h']) ? (($_GET['h'] == "laporan_distribusi_barang") ? "active" : "")  : "" ?>" href="?h=laporan_distribusi_barang">Pendistribusian</a>
                    <a class="collapse-item <?= isset($_GET['h']) ? (($_GET['h'] == "laporan_penjualan_toko") ? "active" : "")  : "" ?>" href="?h=laporan_penjualan_toko">Penjualan Toko</a>
                    <a class="collapse-item <?= isset($_GET['h']) ? (($_GET['h'] == "laporan_penyuplaian") ? "active" : "")  : "" ?>" href="?h=laporan_penyuplaian">Penyuplaian</a>
                    <a class="collapse-item <?= isset($_GET['h']) ? (($_GET['h'] == "laporan_return_barang") ? "active" : "")  : "" ?>" href="?h=laporan_return_barang">Return Barang</a>
                    <a class="collapse-item <?= isset($_GET['h']) ? (($_GET['h'] == "laporan_pameran") ? "active" : "")  : "" ?>" href="?h=laporan_pameran">Pameran</a>
                    <a class="collapse-item <?= isset($_GET['h']) ? (($_GET['h'] == "laporan_penjualan_pameran") ? "active" : "")  : "" ?>" href="?h=laporan_penjualan_pameran">Penjualan Pameran</a>
                    <a class="collapse-item <?= isset($_GET['h']) ? (($_GET['h'] == "laporan_keuangan") ? "active" : "")  : "" ?>" href="?h=laporan_keuangan">Keuangan</a>
                </div>
            </div>
        </li>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>