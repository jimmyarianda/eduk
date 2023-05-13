<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('admin/pangkatcatatan'); ?>">Riwayat Pangkat</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Edit Riwayat Pangkat
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('admin/pangkatcatatan'); ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <input type="hidden" name="nama_pengguna" value="<?= isset($pangkatcatatan['id_user']) ? $pangkatcatatan['id_user'] : NULL ?>">
                    <input type="text" class="form-control" value="<?= isset($pangkatcatatan['id_user']) ? $pangkatcatatan['usr_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Riwayat Pangkat</label>
                    <input type="text" name="nama_pangkat" class="form-control" value="<?= isset($pangkat['pkt_nama']) ? $pangkat['pkt_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>TMT</label>
                    <input type="date" name="tmt" class="form-control" value="<?= isset($pangkatcatatan['pct_tmt']) ? $pangkatcatatan['pct_tmt'] : NULL ?>" required>
                </div>
                <div class="form-group">
                    <label>Upload SK Pangkat</label>
                    <input type="file" name="skpangkat" class="form-control" required><br>
                    <?php if (file_exists('assets/pdf/' . $pangkatcatatan['pct_skpangkat'])) { ?>
                        <a href="<?= site_url('assets/pdf/' . $pangkatcatatan['pct_skpangkat']) ?>" target="_blank" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i><?= $pangkatcatatan['pct_skpangkat'] ?></a>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2" style="width: 100%;" name="status" required>
                        <option value="<?= isset($pangkatcatatan['pct_status']) ? $pangkatcatatan['pct_status'] : NULL ?>" selected="selected"><?= isset($pangkatcatatan['pct_status']) ? $pangkatcatatan['pct_status'] : NULL ?></option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class=" card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('admin/pangkatcatatan'); ?>">Batal</a>
    </div>
    </form>
</div>