<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo/background -->
  <a href="#" class="brand-link navbar-primary">
    <img src="<?= site_url() ?>assets/dist/img/bappeda.png" class="brand-image img-circle elevation-2">
    <span class="brand-text font-weight-dark">E-DUK</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a class="fas fa-user">&nbsp;&nbsp;<?= $this->session->userdata('usr_username'); ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- <div class="user-panel mb-3"> -->
        <div class="info mb-2">
          <a class="text-bold">Navigasi Utama</a>
        </div>
        <li class="nav-item has-treeview">
          <?php if ($this->session->userdata('usr_level') === 'Admin') { ?>
            <a class="nav-link <?= $this->uri->segment(2) === 'dashboard' ? 'active' : '' ?>" href="<?= site_url('admin/dashboard'); ?>">
              <i class="nav-icon fas fa-desktop mr-2"></i>
              <p>
                Dashboard
              </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'pendidikan' ? 'active' : '' ?>" href="<?= site_url('admin/pendidikan'); ?>">
            <i class="nav-icon fas fa-graduation-cap mr-2"></i>
            <p>
              Pendidikan
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'pelatihan' ? 'active' : '' ?>" href="<?= site_url('admin/pelatihan'); ?>">
            <i class="nav-icon fas fa-star mr-2"></i>
            <p>
              Pelatihan/Diklat
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'jabatan' ? 'active' : '' ?>" href="<?= site_url('admin/jabatan'); ?>">
            <i class="nav-icon fas fa-briefcase mr-2"></i>
            <p>
              Jabatan
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'pangkat' ? 'active' : '' ?>" href="<?= site_url('admin/pangkat'); ?>">
            <i class="nav-icon fas fa-id-card mr-2"></i>
            <p>
              Pangkat dan Golongan
            </p>
          </a>
        </li>
        <!-- <div class="user-panel mb-3"> -->
        <div class="info mb-2">
          <a class="text-bold">Info User</a>
        </div>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'pangkatcatatan' ? 'active' : '' ?>" href="<?= site_url('admin/pangkatcatatan'); ?>">
            <i class="nav-icon fas fa-info-circle mr-2"></i>
            <p>
              Info Pangkat
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'jabatancatatan' ? 'active' : '' ?>" href="<?= site_url('admin/jabatancatatan'); ?>">
            <i class="nav-icon fas fa-info-circle mr-2"></i>
            <p>
              Info Jabatan
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'kgajicatatan' ? 'active' : '' ?>" href="<?= site_url('admin/kgajicatatan'); ?>">
            <i class="nav-icon fas fa-money-bill mr-2"></i>
            <p>
              Kenaikan Gaji Berkala
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'mutasicatatan' ? 'active' : '' ?>" href="<?= site_url('admin/mutasicatatan'); ?>">
            <i class="nav-icon fas fa-walking mr-2"></i>
            <p>
              Catatan Mutasi
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'lampirancatatan' ? 'active' : '' ?>" href="<?= site_url('admin/lampirancatatan'); ?>">
            <i class="nav-icon fas fa-paperclip mr-2"></i>
            <p>
              Lampiran
            </p>
          </a>
        </li>
        <!-- <div class="user-panel mb-3"> -->
        <div class="info mb-2">
          <a class="text-bold">Pengaturan</a>
        </div>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'user' ? 'active' : '' ?>" href="<?= site_url('admin/user'); ?>">
            <i class="nav-icon fas fa-user-cog mr-2"></i>
            <p>
              Manajemen User
            </p>
          </a>
        </li>
      <?php } elseif ($this->session->userdata('usr_level') === 'User') { ?>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'dashboard' ? 'active' : '' ?>" href="<?= site_url('user/dashboard'); ?>">
            <i class="nav-icon fas fa-desktop mr-2"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'pendidikan' ? 'active' : '' ?>" href="<?= site_url('user/pendidikan'); ?>">
            <i class="nav-icon fas fa-graduation-cap mr-2"></i>
            <p>
              Pendidikan
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'pelatihan' ? 'active' : '' ?>" href="<?= site_url('user/pelatihan'); ?>">
            <i class="nav-icon fas fa-star mr-2"></i>
            <p>
              Pelatihan/Diklat
            </p>
          </a>
        </li>

        <div class="info mb-2">
          <a class="text-bold">Info User</a>
        </div>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'pangkatcatatan' ? 'active' : '' ?>" href="<?= site_url('user/pangkatcatatan'); ?>">
            <i class="nav-icon fas fa-info-circle mr-2"></i>
            <p>
              Info Pangkat
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'jabatancatatan' ? 'active' : '' ?>" href="<?= site_url('user/jabatancatatan'); ?>">
            <i class="nav-icon fas fa-info-circle mr-2"></i>
            <p>
              Info Jabatan
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'kgajicatatan' ? 'active' : '' ?>" href="<?= site_url('user/kgajicatatan'); ?>">
            <i class="nav-icon fas fa-money-bill mr-2"></i>
            <p>
              Kenaikan Gaji Berkala
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'mutasicatatan' ? 'active' : '' ?>" href="<?= site_url('user/mutasicatatan'); ?>">
            <i class="nav-icon fas fa-walking mr-2"></i>
            <p>
              Catatan Mutasi
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link <?= $this->uri->segment(2) === 'lampirancatatan' ? 'active' : '' ?>" href="<?= site_url('user/lampirancatatan'); ?>">
            <i class="nav-icon fas fa-paperclip mr-2"></i>
            <p>
              Lampiran
            </p>
          </a>
        </li>

      <?php } ?>
      </ul>
    </nav>
  </div>
</aside>