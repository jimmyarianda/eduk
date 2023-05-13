<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/lampirancatatan'); ?>">Data Lampiran</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Tambah Data Lampiran
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('admin/lampirancatatan'); ?>"><i class="fas fa-arrow-left"></i>Kembali</a>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo form_open_multipart('admin/lampirancatatan/add'); ?>
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
                    <label>Lampiran</label>
                    <select class="form-control select2" style="width: 100%;" name="nama_lampiran" required>
                        <option value="" selected="selected">Lampiran</option>
                        <option value="SK CPNS">SK CPNS</option>
                        <option value="SK PNS">SK PNS</option>
                        <option value="Kartu Pegawai">Kartu Pegawai</option>
                        <option value="e-Kartu Pegawai">e-Kartu Pegawai</option>
                        <option value="Taspen">Taspen</option>
                        <option value="BPJS">BPJS</option>
                        <option value="Karis">Karis</option>
                        <option value="NPWP">NPWP</option>
                        <option value="KK">Kartu Keluarga</option>
                        <option value="KTP">KTP</option>
                        <option value="KTP-S">KTP Suami/Istri</option>
                        <option value="Akte">Akte Anak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Upload Dokumen Lampiran</label>
                    <input type="file" name="dokumen" class="form-control" required>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('admin/lampirancatatan'); ?>">Batal</a>
    </div>
    </form>
</div>