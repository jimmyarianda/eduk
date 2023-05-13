<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('user/dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('user/pelatihan'); ?>">Pelatihan</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Tambah Pelatihan
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('user/pelatihan'); ?>"><i class="fas fa-arrow-left"></i>Kembali</a>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo form_open_multipart('user/pelatihan/add'); ?>
                <div class="form-group">
                    <label>Pengguna</label>
                    <input type="hidden" name="nama_pengguna" value="<?= isset($user['usr_id']) ? $user['usr_id'] : NULL ?>">
                    <input type="text" class="form-control" value="<?= isset($user['usr_id']) ? $user['usr_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Pelatihan</label>
                    <input type="text" name="nama_pelatihan" class="form-control" placeholder="Inputkan Pelatihan" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Pelatihan</label>
                    <input type="date" name="tgl_pelatihan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Upload Sertifikat</label>
                    <input type="file" name="sertifikat" class="form-control" required>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('user/pelatihan'); ?>">Batal</a>
    </div>
    </form>
</div>