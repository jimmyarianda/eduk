<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutasicatatan extends CI_Controller
{
    private static $_table = 'view_mutasi_catatan';
    private static $_primaryKey = 'mct_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mutasicatatan_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Riwayat Mutasi - EDUK';

        $data['content'] = 'vadmin/mutasicatatan';
        $this->load->view('vadmin/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'mct_id', 'dt' => 'mct_id'),
                array('db' => 'usr_nama', 'dt' => 'usr_nama'),
                array('db' => 'mct_catatan', 'dt' => 'mct_catatan'),
                array('db' => 'mct_tgl_mutasi', 'dt' => 'mct_tgl_mutasi'),
                array(
                    'db' => 'mct_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('admin/mutasicatatan/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('admin/mutasicatatan/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
                    }
                )
            );

            $sql_details = [
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            ];

            echo json_encode(
                Datatables_ssp::simple($_GET, $sql_details, self::$_table, self::$_primaryKey, $columns)
            );
        }
    }

    public function add()
    {
        if (isset($_POST['simpan'])) {

            $nama_pengguna = $this->input->post('nama_pengguna', TRUE);
            $catatan = $this->input->post('catatan', TRUE);
            $tgl_mutasi = $this->input->post('tgl_mutasi', TRUE);
            $created_at = date('Y-m-d H:i:s');

            $data = [
                'id_user' => $nama_pengguna,
                'mct_catatan' => $catatan,
                'mct_tgl_mutasi' => $tgl_mutasi,
                'created_at' => $created_at
            ];

            $this->mutasicatatan_model->insert($data);
            $this->session->set_flashdata('success', 'Data Mutasi berhasil ditambahkan.');
            redirect('admin/mutasicatatan');
        } else {
            $data['user'] = $this->mutasicatatan_model->get_all_user();
            $data['title'] = 'Tambah Data Riwayat Mutasi - EDUK';
            $data['form_title'] = 'Tambah Data Riwayat Mutasi';
            $data['content'] = 'vadmin/mutasicatatan_form';
            $this->load->view('vadmin/index', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $where = "mct_id = $id";
        $data['mutasicatatan'] = $this->mutasicatatan_model->get_mutasicatatan($where);
        $updated_at = date('Y-m-d H:i:s');

        if (isset($_POST['simpan'])) {
            $data = [
                'mct_catatan' => $this->input->post('catatan', TRUE),
                'mct_tgl_mutasi' => $this->input->post('tgl_mutasi', TRUE),
                'updated_at' => $updated_at
            ];

            $this->mutasicatatan_model->update($data, $id);
            $this->session->set_flashdata('success', 'Riwayat Mutasi berhasil diperbarui.');
            redirect('admin/mutasicatatan');
        } else {
            $data['user'] = $this->mutasicatatan_model->get_user();
            $data['title'] = 'Edit Data Riwayat Mutasi - EDUK';
            $data['form_title'] = 'Edit Data Riwayat Mutasi';
            $data['content'] = 'vadmin/mutasicatatan_edit_form';
            $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
            $this->load->view('vadmin/index', $data);
        }
    }

    public function delete($id = NULL)
    {
        $this->mutasicatatan_model->delete($id);
        $this->session->set_flashdata('success', 'Data Mutasi berhasil dihapus.');
        redirect('admin/mutasicatatan');
    }

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
