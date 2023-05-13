<?php
defined('BASEPATH') or exit('No direct script access allowed');

$notifikasi_kenaikanpangkat = notifikasi_kenaikanpangkat();
$notifikasi_kenaikangaji = notifikasi_kenaikangaji();

$results_kenaikanpangkat = '';
$count_notifikasi_kenaikanpangkat = 0;
$results_kenaikangaji = '';
$count_notifikasi_kenaikangaji = 0;

if (!empty($notifikasi_kenaikanpangkat)) {
    foreach ($notifikasi_kenaikanpangkat as $row) {
        $tgl_hariini = date('Y-m-d');
        $tgl_3bln_sebelumnya = date('Y-m-d', strtotime('-3 Months', strtotime($row['tgl_naikpangkat'])));

        if ($tgl_hariini == $tgl_3bln_sebelumnya) {
            $count_notifikasi_kenaikanpangkat += 1;

            $results_kenaikanpangkat .= '<a href="' . site_url('admin/pangkatcatatan') . '" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i>' . $row['usr_nama'] . '
                        <span class="float-right text-muted text-sm">' . $row['tgl_naikpangkat'] . '</span>
                    </a>';
        }
    }
} else {
    $results_kenaikanpangkat .= '<a href="#" class="dropdown-item">
                Tidak Ada Data
            </a>';
}

if (!empty($notifikasi_kenaikangaji)) {
    foreach ($notifikasi_kenaikangaji as $row) {
        $tgl_hariini = date('Y-m-d');
        $tgl_3bln_sebelumnya = date('Y-m-d', strtotime('-3 Months', strtotime($row['tgl_naikgaji'])));

        if ($tgl_hariini == $tgl_3bln_sebelumnya) {
            $count_notifikasi_kenaikangaji += 1;

            $results_kenaikangaji .= '<a href="' . site_url('admin/kgajicatatan') . '" class="dropdown-item">
                        <i class="fas fa-user mr-2"></i>' . $row['usr_nama'] . '
                        <span class="float-right text-muted text-sm">' . $row['tgl_naikgaji'] . '</span>
                    </a>';
        }
    }
} else {
    $results_kenaikangaji .= '<a href="#" class="dropdown-item">
                Tidak Ada Data
            </a>';
}
?>

<nav class="main-header navbar navbar-expand navbar-primary navbar-light shadow">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <?php if ($this->session->userdata('usr_level') === 'Admin') { ?>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-bell"></i>

                    <span class="badge badge-warning navbar-badge">
                        <?php
                        $count_all_notifikasi = $count_notifikasi_kenaikanpangkat + $count_notifikasi_kenaikangaji;

                        if ($count_all_notifikasi > 0) echo $count_all_notifikasi;
                        else echo '';
                        ?>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">KENAIKAN PANGKAT</span>
                    <div class="dropdown-divider"></div>
                    <?= $results_kenaikanpangkat; ?>
                    <div class="dropdown-divider"></div>
                    <a href="<?= site_url('admin/pangkatcatatan'); ?>" class="dropdown-item dropdown-footer">Lihat Semua Kenaikan Pangkat</a>
                    <div class="dropdown-divider"></div><br>
                    <span class="dropdown-item dropdown-header">KENAIKAN GAJI</span>
                    <div class="dropdown-divider"></div>
                    <?= $results_kenaikangaji; ?>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Lihat Semua Kenaikan Gaji</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= site_url('logout'); ?>">Logout</a>
                </div>
            </li>
        <?php }
        if ($this->session->userdata('usr_level') === 'User') { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= site_url('logout'); ?>">Logout</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</nav>