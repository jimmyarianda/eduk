<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        // View data pendidikan Admin
        $('#tpendidikan').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/pendidikan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "pd_id", "visible": false},
                {"data": "pd_jenjang_pendidikan"},
                {"data": "pd_nama"},
                {"data": "pd_tahun_lulus"},
                {"data": "pd_ijazah"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data pendidikan User
        $('#tpendidikanuser').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('user/pendidikan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "pd_id", "visible": false},
                {"data": "pd_jenjang_pendidikan"},
                {"data": "pd_nama"},
                {"data": "pd_tahun_lulus"},
                {"data": "pd_ijazah"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data pelatihan Admin
        $('#tpelatihan').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/pelatihan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "plt_id", "visible": false},
                {"data": "plt_nama"},
                {"data": "plt_tgl_pelatihan"},
                {"data": "plt_sertifikat"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data pelatihan User
        $('#tpelatihanuser').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('user/pelatihan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "plt_id", "visible": false},
                {"data": "plt_nama"},
                {"data": "plt_tgl_pelatihan"},
                {"data": "plt_sertifikat"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data jabatan Admin
        $('#tjabatan').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/jabatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "jbt_id", "visible": false},
                {"data": "jbt_nama"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data pangkat Admin
        $('#tpangkat').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/pangkat/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "pkt_id", "visible": false},
                {"data": "pkt_nama"},
                {"data": "pkt_golongan"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data pangkat catatan Admin
        $('#tpangkatct').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/pangkatcatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "pct_id", "visible": false},
                {"data": "usr_nama"},
                {"data": "pkt_nama"},
                {"data": "pct_tmt"},
                {"data": "pct_skpangkat"},
                {"data": "pct_status"},
                {"data": "pct_tgl_naikpangkat"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data pangkat catatan User
        $('#tpangkatuserct').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('user/pangkatcatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "pct_id", "visible": false},
                {"data": "usr_nama"},
                {"data": "pkt_nama"},
                {"data": "pct_tmt"},
                {"data": "pct_skpangkat"},
                {"data": "pct_status"},
                {"data": "pct_tgl_naikpangkat"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data jabatan catatan Admin
        $('#tjabatanct').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/jabatancatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "jct_id", "visible": false},
                {"data": "usr_nama"},
                {"data": "jbt_nama"},
                {"data": "jct_tmt"},
                {"data": "jct_skjabatan"},
                {"data": "jct_status"},
                {"data": "jct_keterangan"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data jabatan catatan User
        $('#tjabatanuserct').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('user/jabatancatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "jct_id", "visible": false},
                {"data": "usr_nama"},
                {"data": "jbt_nama"},
                {"data": "jct_tmt"},
                {"data": "jct_skjabatan"},
                {"data": "jct_status"},
                {"data": "jct_keterangan"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data kenaikan gaji catatan Admin
        $('#tgajict').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/kgajicatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "gct_id", "visible": false},
                {"data": "usr_nama"},
                {"data": "gct_tmt"},
                {"data": "gct_skkenaikangaji"},
                {"data": "gct_tgl_naikgaji"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data kenaikan gaji catatan User
        $('#tgajiuserct').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('user/kgajicatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "gct_id", "visible": false},
                {"data": "usr_nama"},
                {"data": "gct_tmt"},
                {"data": "gct_skkenaikangaji"},
                {"data": "gct_tgl_naikgaji"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data mutasi catatan Admin
        $('#tmutasict').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/mutasicatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "mct_id", "visible": false},
                {"data": "usr_nama"},
                {"data": "mct_catatan"},
                {"data": "mct_tgl_mutasi"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data mutasi catatan User
        $('#tmutasiuserct').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('user/mutasicatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "mct_id", "visible": false},
                {"data": "usr_nama"},
                {"data": "mct_catatan"},
                {"data": "mct_tgl_mutasi"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data mutasi catatan Admin
        $('#tlampiranct').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/lampirancatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "lam_id", "visible": false},
                {"data": "lam_nama"},
                {"data": "lam_dokumen"},
                {"data": "action"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data mutasi catatan Admin
        $('#tlampiranuserct').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('user/lampirancatatan/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "lam_id", "visible": false},
                {"data": "lam_nama"},
                {"data": "lam_dokumen"}
            ],
            "order": [[1, 'dsc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // View data user Admin
        $('#tuser').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "<?=site_url('admin/user/get_data');?>",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "usr_id", "visible": false},
                {"data": "usr_username"},
                {"data": "usr_nama"},
                {"data": "usr_level"},
                {"data": "action"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // Notification alert
        $("#errorMessage").alert().delay(4000).slideUp('slow');
        $("#successMessage").alert().delay(4000).slideUp('slow');
    });
</script>