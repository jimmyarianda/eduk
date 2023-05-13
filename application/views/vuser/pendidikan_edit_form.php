<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('user/pendidikan'); ?>">Pendidikan</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Edit Pendidikan
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('user/pendidikan'); ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <label>Pengguna</label>
                    <input type="hidden" name="nama_user" value="<?= isset($user['id_user']) ? $user['id_user'] : NULL ?>">
                    <input type="text" class="form-control" value="<?= isset($id_user['id_user']) ? $id_user['usr_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Jenjang Pendidikan</label>
                    <select class="form-control select2" style="width: 100%;" name="jenjang_pendidikan" required>
                        <option value="<?= isset($pendidikan['pd_jenjang_pendidikan']) ? $pendidikan['pd_jenjang_pendidikan'] : NULL ?>" selected="selected"><?= isset($pendidikan['pd_jenjang_pendidikan']) ? $pendidikan['pd_jenjang_pendidikan'] : NULL ?></option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP/Setara</option>
                        <option value="SMA">SMA/Setara</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Sarjana">S1</option>
                        <option value="Megister">S2</option>
                        <option value="Doktoral">S3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Almamater</label>
                    <input type="text" name="nama_almamater" class="form-control" value="<?= isset($pendidikan['pd_nama']) ? $pendidikan['pd_nama'] : NULL ?>" required>
                </div>
                <div class="form-group">
                    <label>Tahun Lulus</label>
                    <input type="number" name="tahun_lulus" class="form-control" value="<?= isset($pendidikan['pd_tahun_lulus']) ? $pendidikan['pd_tahun_lulus'] : NULL ?>" required>
                </div>
                <div class="form-group">
                    <label>Upload Ijazah</label>
                    <input type="file" name="ijazah" class="form-control" required><br>
                    <?php if (file_exists('assets/pdf/' . $pendidikan['pd_ijazah'])) { ?>
                        <a href="<?= site_url('assets/pdf/' . $pendidikan['pd_ijazah']) ?>" target="_blank" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i><?= $pendidikan['pd_ijazah'] ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class=" card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('user/pendidikan'); ?>">Batal</a>
    </div>
    </form>
</div>