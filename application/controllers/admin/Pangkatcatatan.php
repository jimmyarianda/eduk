<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pangkatcatatan extends CI_Controller
{
    private static $_table = 'view_pangkat_catatan';
    private static $_primaryKey = 'pct_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pangkatcatatan_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Pangkat Catatan - EDUK';

        $data['content'] = 'vadmin/pangkatcatatan';
        $this->load->view('vadmin/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'pct_id', 'dt' => 'pct_id'),
                array('db' => 'usr_nama', 'dt' => 'usr_nama'),
                array('db' => 'pkt_nama', 'dt' => 'pkt_nama'),
                array('db' => 'pct_tmt', 'dt' => 'pct_tmt'),
                array(
                    'db' => 'pct_skpangkat', 'dt' => 'pct_skpangkat', 'formatter' => function ($pangkatct) {
                        return '<a href="' . site_url('admin/pangkatcatatan/download_file/' . $pangkatct) . '" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i>Download</a>';
                    }
                ),
                array('db' => 'pct_status', 'dt' => 'pct_status'),
                array('db' => 'pct_tgl_naikpangkat', 'dt' => 'pct_tgl_naikpangkat'),
                array(
                    'db' => 'pct_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('admin/pangkatcatatan/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('admin/pangkatcatatan/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
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
            $nama_pangkat = $this->input->post('nama_pangkat', TRUE);
            $tmt = $this->input->post('tmt', TRUE);
            $skpangkat = $_FILES['skpangkat']['name'];
            $status = $this->input->post('status', TRUE);
            $kpselanjutnya = date('Y-m-d', strtotime('+4 years', strtotime($tmt)));
            $created_at = date('Y-m-d H:i:s');

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $skpangkat);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $skpangkat = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('skpangkat');

            $data = [
                'id_user' => $nama_pengguna,
                'id_pangkat' => $nama_pangkat,
                'pct_tmt' => $tmt,
                'pct_skpangkat' => $skpangkat,
                'pct_status' => $status,
                'pct_tgl_naikpangkat' => $kpselanjutnya,
                'created_at' => $created_at
            ];

            $this->pangkatcatatan_model->insert($data);
            $this->session->set_flashdata('success', 'Rirawyat Pangkat berhasil ditambahkan.');
            redirect('admin/pangkatcatatan');
        } else {
            $data['user'] = $this->pangkatcatatan_model->get_all_user();
            $data['pangkat'] = $this->pangkatcatatan_model->get_all_pangkat();
            $data['title'] = 'Tambah Riwayat Pangkat - EDUK';
            $data['form_title'] = 'Tambah Riwayat Pangkat';
            $data['content'] = 'vadmin/pangkatcatatan_form';
            $this->load->view('vadmin/index', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $where = "pct_id = $id";
        $data['pangkatcatatan'] = $this->pangkatcatatan_model->get_pangkatcatatan($where);
        $updated_at = date('Y-m-d H:i:s');

        if (isset($_POST['simpan'])) {
            $tmt = $this->input->post('tmt', TRUE);
            $kpselanjutnya = date('Y-m-d', strtotime('+4 years', strtotime($tmt)));
            $skpangkat = $_FILES['skpangkat']['name'];

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $skpangkat);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $skpangkat = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('skpangkat');

            $data = [
                'pct_tmt' => $tmt,
                'pct_skpangkat' => (!empty($skpangkat)) ? $skpangkat : $data['pangkat_catatan']['pct_skpangkat'],
                'pct_status' => $this->input->post('status', TRUE),
                'pct_tgl_naikpangkat' => $kpselanjutnya,
                'updated_at' => $updated_at
            ];

            $this->pangkatcatatan_model->update($data, $id);
            $this->session->set_flashdata('success', 'Riwayat Pangkat berhasil diperbarui.');
            redirect('admin/pangkatcatatan');
        } else {
            $data['user'] = $this->pangkatcatatan_model->get_user();
            $data['pangkat'] = $this->pangkatcatatan_model->get_pangkat();
            $data['title'] = 'Edit Riwayat Pangkat - EDUK';
            $data['form_title'] = 'Edit Riwayat Pangkat';
            $data['content'] = 'vadmin/pangkatcatatan_edit_form';
            $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
            $this->load->view('vadmin/index', $data);
        }
    }

    public function delete($id = NULL)
    {
        $this->pangkatcatatan_model->delete($id);
        $this->session->set_flashdata('success', 'Riwayat Pangkat berhasil dihapus.');
        redirect('admin/pangkatcatatan');
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
