<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendidikan extends CI_Controller
{
    private static $_table = 'view_pendidikan';
    private static $_primaryKey = 'pd_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pendidikan_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Pendidikan - EDUK';

        $data['content'] = 'vuser/pendidikan';
        $this->load->view('vuser/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'pd_id', 'dt' => 'pd_id'),
                array('db' => 'pd_jenjang_pendidikan', 'dt' => 'pd_jenjang_pendidikan'),
                array('db' => 'pd_nama', 'dt' => 'pd_nama'),
                array('db' => 'pd_tahun_lulus', 'dt' => 'pd_tahun_lulus'),
                array(
                    'db' => 'pd_ijazah', 'dt' => 'pd_ijazah', 'formatter' => function ($ijazah) {
                        return '<a href="' . site_url('user/pendidikan/download_file/' . $ijazah) . '" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i>Download</a>';
                    }
                ),
                array(
                    'db' => 'pd_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('user/pendidikan/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('user/pendidikan/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
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
        $data['user'] = $this->pendidikan_model->get_user_session($where);

        if (isset($_POST['simpan'])) {

            $nama_pengguna = $this->input->post('nama_pengguna', TRUE);
            $jenjang_pendidikan = $this->input->post('jenjang_pendidikan', TRUE);
            $nama_almamater = $this->input->post('nama_almamater', TRUE);
            $tahun_lulus = $this->input->post('tahun_lulus', TRUE);
            $ijazah = $_FILES['ijazah']['name'];
            $created_at = date('Y-m-d H:i:s');

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $ijazah);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $ijazah = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('ijazah');

            $data = [
                'id_user' => $nama_pengguna,
                'pd_jenjang_pendidikan' => $jenjang_pendidikan,
                'pd_nama' => $nama_almamater,
                'pd_tahun_lulus' => $tahun_lulus,
                'pd_ijazah' => $ijazah,
                'created_at' => $created_at
            ];


            $this->pendidikan_model->insert($data);
            $this->session->set_flashdata('success', 'Pendidikan berhasil ditambahkan.');
            redirect('user/pendidikan');
        } else {
            // $data['user'] = $this->pendidikan_model->get_all_user();
            $data['title'] = 'Tambah Pendidikan - EDUK';
            $data['form_title'] = 'Tambah Pendidikan';
            $data['content'] = 'vuser/pendidikan_form';
            $this->load->view('vuser/index', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $where = "pd_id = $id";
        $data['pendidikan'] = $this->pendidikan_model->get_pendidikan($where);

        if (isset($_POST['simpan'])) {
            $ijazah = $_FILES['ijazah']['name'];

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $ijazah);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $ijazah = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('ijazah');

            $data = [
                'pd_jenjang_pendidikan' => $this->input->post('jenjang_pendidikan', TRUE),
                'pd_nama' => $this->input->post('nama_almamater', TRUE),
                'pd_tahun_lulus' => $this->input->post('tahun_lulus', TRUE),
                'pd_ijazah' => (!empty($ijazah)) ? $ijazah : $data['pendidikan']['pd_ijazah'],
            ];

            $this->pendidikan_model->update($data, $id);
            $this->session->set_flashdata('success', 'Pendidikan berhasil diperbarui.');
            redirect('user/pendidikan');
        } else {
            $data['user'] = $this->pendidikan_model->get_user();
            $data['title'] = 'Edit Pendidikan - EDUK';
            $data['form_title'] = 'Edit Pendidikan';
            $data['content'] = 'vuser/pendidikan_edit_form';
            $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
            $this->load->view('vuser/index', $data);
        }
    }

    public function delete($id = NULL)
    {
        $this->pendidikan_model->delete($id);
        $this->session->set_flashdata('success', 'Pendidikan berhasil dihapus.');
        redirect('user/pendidikan');
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
