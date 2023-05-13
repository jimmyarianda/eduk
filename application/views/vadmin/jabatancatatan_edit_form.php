<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/jabatancatatan'); ?>">Riwayat Jabatan</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Edit Riwayat Jabatan
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('admin/jabatancatatan'); ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <input type="hidden" name="nama_pengguna" value="<?= isset($jabatancatatan['id_user']) ? $jabatancatatan['id_user'] : NULL ?>">
                    <input type="text" class="form-control" value="<?= isset($jabatancatatan['id_user']) ? $jabatancatatan['usr_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Riwayat Jabatan</label>
                    <input type="text" name="nama_jabatan" class="form-control" value="<?= isset($jabatan['jbt_nama']) ? $jabatan['jbt_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>TMT</label>
                    <input type="date" name="tmt" class="form-control" value="<?= isset($jabatancatatan['jct_tmt']) ? $jabatancatatan['jct_tmt'] : NULL ?>" required>
                </div>
                <div class="form-group">
                    <label>Upload SK Jabatan</label>
                    <input type="file" name="skjabatan" class="form-control" required><br>
                    <?php if (file_exists('assets/pdf/' . $jabatancatatan['jct_skjabatan'])) { ?>
                        <a href="<?= site_url('assets/pdf/' . $jabatancatatan['jct_skjabatan']) ?>" target="_blank" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i><?= $jabatancatatan['jct_skjabatan'] ?></a>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2" style="width: 100%;" name="status" required>
                        <option value="<?= isset($jabatancatatan['jct_status']) ? $jabatancatatan['jct_status'] : NULL ?>" selected="selected"><?= isset($jabatancatatan['jct_status']) ? $jabatancatatan['jct_status'] : NULL ?></option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>keterangan</label>
                    <select class="form-control select2" style="width: 100%;" name="keterangan" required>
                        <option value="<?= isset($jabatancatatan['jct_keterangan']) ? $jabatancatatan['jct_keterangan'] : NULL ?>" selected="selected"><?= isset($jabatancatatan['jct_keterangan']) ? $jabatancatatan['jct_keterangan'] : NULL ?></option>
                        <option value="Kenaikan Jabatan">Kenaikan Jabatan</option>
                        <option value="Non Job">Non Job</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class=" card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('admin/jabatancatatan'); ?>">Batal</a>
    </div>
    </form>
</div>