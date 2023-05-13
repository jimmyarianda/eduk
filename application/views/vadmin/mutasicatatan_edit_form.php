<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/mutasicatatan'); ?>">Riwayat Mutasi</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Edit Data Riwayat Mutasi
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('admin/mutasicatatan'); ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo form_open_multipart($action); ?>
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input type="hidden" name="nama_pengguna" value="<?= isset($mutasicatatan['id_user']) ? $mutasicatatan['id_user'] : NULL ?>">
                    <input type="text" class="form-control" value="<?= isset($mutasicatatan['id_user']) ? $mutasicatatan['usr_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Catatan Mutasi</label>
                    <input type="text" name="catatan" class="form-control" value="<?= isset($mutasicatatan['mct_catatan']) ? $mutasicatatan['mct_catatan'] : NULL ?>" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Mutasi</label>
                    <input type="date" name="tgl_mutasi" class="form-control" value="<?= isset($mutasicatatan['mct_tgl_mutasi']) ? $mutasicatatan['mct_tgl_mutasi'] : NULL ?>" required>
                </div>
            </div>
        </div>
    </div>

    <div class=" card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('admin/mutasicatatan'); ?>">Batal</a>
    </div>
    </form>
</div>