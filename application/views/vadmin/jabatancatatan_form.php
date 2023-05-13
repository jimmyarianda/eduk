<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/jabatancatatan'); ?>">Riwayat Jabatan</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Tambah Jabatan
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('admin/jabatancatatan'); ?>"><i class="fas fa-arrow-left"></i>Kembali</a>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo form_open_multipart('admin/jabatancatatan/add'); ?>
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
                    <label>Riwayat Jabatan</label>
                    <select class="form-control select2" style="width: 100%;" name="nama_jabatan" required>
                        <option value="" selected="selected">Pilih Jabatan</option>
                        <?php foreach ($jabatan as $row) { ?>
                            <option value="<?= $row['jbt_id']; ?>"><?= $row['jbt_nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>TMT</label>
                    <input type="date" name="tmt" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Upload SK Jabatan</label>
                    <input type="file" name="skjabatan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2" style="width: 100%;" name="status" required>
                        <option value="" selected="selected">Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <select class="form-control select2" style="width: 100%;" name="keterangan" required>
                        <option value="" selected="selected">Keterangan</option>
                        <option value="Kenaikan Jabatan">Kenaikan Jabatan</option>
                        <option value="Non Job">Non Job</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('admin/jabatancatatan'); ?>">Batal</a>
    </div>
    </form>
</div>