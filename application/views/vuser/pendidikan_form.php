<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('user/dashboard'); ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('user/pendidikan'); ?>">Pendidikan</a></li>
    <li class="breadcrumb-item active"><?= $form_title; ?></li>
</ol>

<div class="card card-default">
    <!-- card-header -->
    <div class="card-header">Tambah Pendidikan
        &nbsp;&nbsp;&nbsp;<a class="btn btn-primary btn-sm" href="<?= site_url('user/pendidikan'); ?>"><i class="fas fa-arrow-left"></i>Kembali</a>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?php echo form_open_multipart('user/pendidikan/add'); ?>
                <div class="form-group">
                    <label>Pengguna</label>
                    <input type="hidden" name="nama_pengguna" value="<?= isset($user['usr_id']) ? $user['usr_id'] : NULL ?>">
                    <input type="text" class="form-control" value="<?= isset($user['usr_id']) ? $user['usr_nama'] : NULL ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Jenjang Pendidikan</label>
                    <select class="form-control select2" style="width: 100%;" name="jenjang_pendidikan" required>
                        <option value="" selected="selected">Pilih Jenjang Pendidikan</option>
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
                    <input type="text" name="nama_almamater" class="form-control" placeholder="Inputkan Nama Almamater" required>
                </div>
                <div class="form-group">
                    <label>Tahun Lulus</label>
                    <input type="number" name="tahun_lulus" class="form-control" placeholder="Inputkan Tahun Lulus" required>
                </div>
                <div class="form-group">
                    <label>Upload Ijazah</label>
                    <input type="file" name="ijazah" class="form-control" required>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>&nbsp;
        <a class="btn btn-primary" href="<?= site_url('user/pendidikan'); ?>">Batal</a>
    </div>
    </form>
</div>