<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelatihan extends CI_Controller
{
    private static $_table = 'view_pelatihan';
    private static $_primaryKey = 'plt_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelatihan_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Pelatihan - EDUK';

        $data['content'] = 'vuser/pelatihan';
        $this->load->view('vuser/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'plt_id', 'dt' => 'plt_id'),
                array('db' => 'plt_nama', 'dt' => 'plt_nama'),
                array('db' => 'plt_tgl_pelatihan', 'dt' => 'plt_tgl_pelatihan'),
                array(
                    'db' => 'plt_sertifikat', 'dt' => 'plt_sertifikat', 'formatter' => function ($sertifikat) {
                        return '<a href="' . site_url('user/pelatihan/download_file/' . $sertifikat) . '" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i>Download</a>';
                    }
                ),
                array(
                    'db' => 'plt_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('user/pelatihan/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('user/pelatihan/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
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

    public function add()
    {
        $id = $this->session->userdata('usr_id');
        $where = "usr_id = $id";
        $data['user'] = $this->pelatihan_model->get_user_session($where);

        if (isset($_POST['simpan'])) {

            $nama_pengguna = $this->input->post('nama_pengguna', TRUE);
            $nama_pelatihan = $this->input->post('nama_pelatihan', TRUE);
            $tgl_pelatihan = $this->input->post('tgl_pelatihan', TRUE);
            $sertifikat = $_FILES['sertifikat']['name'];
            $created_at = date('Y-m-d H:i:s');

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $sertifikat);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $sertifikat = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('sertifikat');

            $data = [
                'id_user' => $nama_pengguna,
                'plt_nama' => $nama_pelatihan,
                'plt_tgl_pelatihan' => $tgl_pelatihan,
                'plt_sertifikat' => $sertifikat,
                'created_at' => $created_at
            ];

            $this->pelatihan_model->insert($data);
            $this->session->set_flashdata('success', 'Pelatihan berhasil ditambahkan.');
            redirect('user/pelatihan');
        } else {
            // $data['user'] = $this->pelatihan_model->get_all_user();
            $data['title'] = 'Tambah Pelatihan - EDUK';
            $data['form_title'] = 'Tambah Pelatihan';
            $data['content'] = 'vuser/pelatihan_form';
            $this->load->view('vuser/index', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $where = "plt_id = $id";
        $data['pelatihan'] = $this->pelatihan_model->get_pelatihan($where);

        if (isset($_POST['simpan'])) {
            $sertifikat = $_FILES['sertifikat']['name'];

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $sertifikat);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $sertifikat = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('sertifikat');

            $data = [
                'plt_nama' => $this->input->post('nama_pelatihan', TRUE),
                'plt_tgl_pelatihan' => $this->input->post('tgl_pelatihan', TRUE),
                'plt_sertifikat' => (!empty($sertifikat)) ? $sertifikat : $data['pelatihan']['plt_sertifikat'],
            ];

            $this->pelatihan_model->update($data, $id);
            $this->session->set_flashdata('success', 'Pelatihan berhasil diperbarui.');
            redirect('user/pelatihan');
        } else {
            $data['user'] = $this->pelatihan_model->get_user();
            $data['title'] = 'Edit Pelatihan - EDUK';
            $data['form_title'] = 'Edit Pelatihan';
            $data['content'] = 'vuser/pelatihan_edit_form';
            $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
            $this->load->view('vuser/index', $data);
        }
    }

    public function delete($id = NULL)
    {
        $this->pelatihan_model->delete($id);
        $this->session->set_flashdata('success', 'Pelatihan berhasil dihapus.');
        redirect('user/pelatihan');
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
