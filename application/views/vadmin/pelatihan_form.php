<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/pelatihan'); ?>">Pelatihan</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Tambah Pelatihan
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('admin/pelatihan'); ?>"><i class="fas fa-arrow-left"></i>Kembali</a>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo form_open_multipart('admin/pelatihan/add'); ?>
                <div class="form-group">
                    <label>Pilih Pengguna</label>
                    <select class="form-control select2" style="width: 100%;" name="nama_pengguna" required>
                        <option value="" selected="selected">Pilih Pengguna</option>
                        <?php foreach ($user as $row) { ?>
                            <option value="<?= $row['usr_id']; ?>"><?= $row['usr_nama'] ?></option>
                        <?php } ?>
                    </select>
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
        <a class="btn btn-primary" href="<?= site_url('admin/pelatihan'); ?>">Batal</a>
    </div>
    </form>
</div>