<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lampirancatatan extends CI_Controller
{
    private static $_table = 'view_lampiran_catatan';
    private static $_primaryKey = 'lam_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('lampirancatatan_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Riwayat Lampiran - EDUK';

        $data['content'] = 'vuser/lampirancatatan';
        $this->load->view('vuser/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'lam_id', 'dt' => 'lam_id'),
                array('db' => 'lam_nama', 'dt' => 'lam_nama'),
                array(
                    'db' => 'lam_dokumen', 'dt' => 'lam_dokumen', 'formatter' => function ($dokumenct) {
                        return '<a href="' . site_url('user/lampirancatatan/download_file/' . $dokumenct) . '" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i>Download</a>';
                    }
                ),
                array(
                    'db' => 'lam_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('admin/lampirancatatan/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('admin/lampirancatatan/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
                    }
                )
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            $id_session = $this->session->userdata('usr_id');

            $where = "id_user = $id_session";

            echo json_encode(
                Datatables_ssp::complex($_GET, $sql_details, self::$_table, self::$_primaryKey, $columns, NULL, $where, NULL)
            );
        }
    }

    // public function add()
    // {
    //     if (isset($_POST['simpan'])) {

    //         $nama_pengguna = $this->input->post('nama_pengguna', TRUE);
    //         $nama_lampiran = $this->input->post('nama_lampiran', TRUE);
    //         $dokumen = $_FILES['dokumen']['name'];
    //         $created_at = date('Y-m-d H:i:s');

    //         $this->load->library('upload');

    //         $config['upload_path']      = './assets/pdf/';
    //         $config['allowed_types']    = 'pdf';
    //         $config['max_size']         = 2048;
    //         $config['overwrite'] = TRUE;
    //         $x = explode(".", $dokumen);
    //         $ext = strtolower(end($x));
    //         $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
    //         // $config['file_name'] = $s_id . "-foto." . $ext;
    //         $dokumen = $config['file_name'];
    //         $this->upload->initialize($config);
    //         $this->upload->do_upload('dokumen');

    //         $data = [
    //             'id_user' => $nama_pengguna,
    //             'lam_nama' => $nama_lampiran,
    //             'lam_dokumen' => $dokumen,
    //             'created_at' => $created_at
    //         ];

    //         $this->lampirancatatan_model->insert($data);
    //         $this->session->set_flashdata('success', 'Lampiran berhasil ditambahkan.');
    //         redirect('admin/lampirancatatan');
    //     } else {
    //         $data['user'] = $this->lampirancatatan_model->get_all_user();
    //         $data['title'] = 'Tambah Lampiran - EDUK';
    //         $data['form_title'] = 'Tambah Lampiran';
    //         $data['content'] = 'vadmin/lampirancatatan_form';
    //         $this->load->view('vadmin/index', $data);
    //     }
    // }

    // public function edit()
    // {
    //     $id = $this->uri->segment(4);
    //     $where = "lam_id = $id";
    //     $data['lampirancatatan'] = $this->lampirancatatan_model->get_lampirancatatan($where);
    //     $updated_at = date('Y-m-d H:i:s');

    //     if (isset($_POST['simpan'])) {
    //         $dokumen = $_FILES['dokumen']['name'];

    //         $this->load->library('upload');

    //         $config['upload_path']      = './assets/pdf/';
    //         $config['allowed_types']    = 'pdf';
    //         $config['max_size']         = 2048;
    //         $config['overwrite'] = TRUE;
    //         $x = explode(".", $dokumen);
    //         $ext = strtolower(end($x));
    //         $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
    //         // $config['file_name'] = $s_id . "-foto." . $ext;
    //         $dokumen = $config['file_name'];
    //         $this->upload->initialize($config);
    //         $this->upload->do_upload('dokumen');

    //         $data = [
    //             'lam_nama' => $this->input->post('nama_lampiran', TRUE),
    //             'lam_dokumen' => (!empty($dokumen)) ? $dokumen : $data['lampiran_catatan']['lam_dokumen'],
    //             'updated_at' => $updated_at
    //         ];

    //         $this->lampirancatatan_model->update($data, $id);
    //         $this->session->set_flashdata('success', 'Riwayat Lampiran berhasil diperbarui.');
    //         redirect('admin/lampirancatatan');
    //     } else {
    //         $data['user'] = $this->lampirancatatan_model->get_user();
    //         $data['title'] = 'Edit Riwayat Lampiran - EDUK';
    //         $data['form_title'] = 'Edit Riwayat Lampiran';
    //         $data['content'] = 'vadmin/lampirancatatan_edit_form';
    //         $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
    //         $this->load->view('vadmin/index', $data);
    //     }
    // }

    // public function delete($id = NULL)
    // {
    //     $this->lampirancatatan_model->delete($id);
    //     $this->session->set_flashdata('success', 'Lampiran berhasil dihapus.');
    //     redirect('admin/lampirancatatan');
    // }

    public function download_file($filename)
    {
        $this->load->helper('download');

        $file_path = 'assets/pdf/' . $filename;

        if (file_exists($file_path)) {
            return force_download($file_path, NULL);
        } else {
            return show_404();
        }
    }
}
