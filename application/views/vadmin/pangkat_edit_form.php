<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/pangkat'); ?>">Pangkat</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Edit Pangkat
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('admin/pangkat'); ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="<?= $action; ?>" method="post">
                    <div class="form-group">
                        <label>Nama Pangkat</label>
                        <input type="text" name="nama_pangkat" class="form-control" placeholder="Inputkan Pangkat" value="<?= isset($pangkat['pkt_nama']) ? $pangkat['pkt_nama'] : NULL ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Golongan</label>
                        <input type="text" name="golongan" class="form-control" placeholder="Inputkan Golongan" value="<?= isset($pangkat['pkt_golongan']) ? $pangkat['pkt_golongan'] : NULL ?>" required>
                    </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('admin/pangkat'); ?>">Batal</a>
    </div>
    </form>
</div>