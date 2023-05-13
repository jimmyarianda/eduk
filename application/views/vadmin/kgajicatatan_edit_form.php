<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/kgajicatatan'); ?>">Kenaikan Gaji Berkala</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Edit Data Kenaikan Gaji
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('admin/kgajicatatan'); ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <input type="hidden" name="nama_pengguna" value="<?= isset($kgajicatatan['id_user']) ? $kgajicatatan['id_user'] : NULL ?>">
                    <input type="text" class="form-control" value="<?= isset($kgajicatatan['id_user']) ? $kgajicatatan['usr_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>TMT</label>
                    <input type="date" name="tmt" class="form-control" value="<?= isset($kgajicatatan['gct_tmt']) ? $kgajicatatan['gct_tmt'] : NULL ?>" required>
                </div>
                <div class="form-group">
                    <label>Upload SK Kenaikan Gaji Berkala</label>
                    <input type="file" name="sknaikgaji" class="form-control"><br>
                    <?php if (file_exists('assets/pdf/' . $kgajicatatan['gct_skkenaikangaji'])) { ?>
                        <a href="<?= site_url('assets/pdf/' . $kgajicatatan['gct_skkenaikangaji']) ?>" target="_blank" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i><?= $kgajicatatan['gct_skkenaikangaji'] ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class=" card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('admin/kgajicatatan'); ?>">Batal</a>
    </div>
    </form>
</div>