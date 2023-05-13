<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatancatatan extends CI_Controller
{
    private static $_table = 'view_jabatan_catatan';
    private static $_primaryKey = 'jct_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jabatancatatan_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Riwayat Jabatan - EDUK';

        $data['content'] = 'vadmin/jabatancatatan';
        $this->load->view('vadmin/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'jct_id', 'dt' => 'jct_id'),
                array('db' => 'usr_nama', 'dt' => 'usr_nama'),
                array('db' => 'jbt_nama', 'dt' => 'jbt_nama'),
                array('db' => 'jct_tmt', 'dt' => 'jct_tmt'),
                array(
                    'db' => 'jct_skjabatan', 'dt' => 'jct_skjabatan', 'formatter' => function ($jabatanct) {
                        return '<a href="' . site_url('admin/jabatancatatan/download_file/' . $jabatanct) . '" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i>Download</a>';
                    }
                ),
                array('db' => 'jct_status', 'dt' => 'jct_status'),
                array('db' => 'jct_keterangan', 'dt' => 'jct_keterangan'),
                array(
                    'db' => 'jct_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('admin/jabatancatatan/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('admin/jabatancatatan/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
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
            $nama_jabatan = $this->input->post('nama_jabatan', TRUE);
            $tmt = $this->input->post('tmt', TRUE);
            $skjabatan = $_FILES['skjabatan']['name'];
            $status = $this->input->post('status', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);
            $created_at = date('Y-m-d H:i:s');

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $skjabatan);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $skjabatan = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('skjabatan');

            $data = [
                'id_user' => $nama_pengguna,
                'id_jabatan' => $nama_jabatan,
                'jct_tmt' => $tmt,
                'jct_skjabatan' => $skjabatan,
                'jct_status' => $status,
                'jct_keterangan' => $keterangan,
                'created_at' => $created_at
            ];

            $this->jabatancatatan_model->insert($data);
            $this->session->set_flashdata('success', 'Riwayat Jabatan berhasil ditambahkan.');
            redirect('admin/jabatancatatan');
        } else {
            $data['user'] = $this->jabatancatatan_model->get_all_user();
            $data['jabatan'] = $this->jabatancatatan_model->get_all_jabatan();
            $data['title'] = 'Tambah Riwayat Jabatan - EDUK';
            $data['form_title'] = 'Tambah Riwayat Jabatan';
            $data['content'] = 'vadmin/jabatancatatan_form';
            $this->load->view('vadmin/index', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $where = "jct_id = $id";
        $data['jabatancatatan'] = $this->jabatancatatan_model->get_jabatancatatan($where);
        $updated_at = date('Y-m-d H:i:s');

        if (isset($_POST['simpan'])) {
            $skjabatan = $_FILES['skjabatan']['name'];

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $skjabatan);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $skjabatan = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('skjabatan');

            $data = [
                'jct_tmt' => $this->input->post('tmt', TRUE),
                'jct_skjabatan' => (!empty($skjabatan)) ? $skjabatan : $data['jabatan_catatan']['jct_skjabatan'],
                'jct_status' => $this->input->post('status', TRUE),
                'jct_keterangan' => $this->input->post('keterangan', TRUE),
                'updated_at' => $updated_at
            ];

            $this->jabatancatatan_model->update($data, $id);
            $this->session->set_flashdata('success', 'Riwayat Jabatan berhasil diperbarui.');
            redirect('admin/jabatancatatan');
        } else {
            $data['user'] = $this->jabatancatatan_model->get_user();
            $data['jabatan'] = $this->jabatancatatan_model->get_jabatan();
            $data['title'] = 'Edit Riwayat Jabatan - EDUK';
            $data['form_title'] = 'Edit Riwayat Jabatan';
            $data['content'] = 'vadmin/jabatancatatan_edit_form';
            $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
            $this->load->view('vadmin/index', $data);
        }
    }

    public function delete($id = NULL)
    {
        $this->jabatancatatan_model->delete($id);
        $this->session->set_flashdata('success', 'Riwayat Jabatan berhasil dihapus.');
        redirect('admin/jabatancatatan');
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
