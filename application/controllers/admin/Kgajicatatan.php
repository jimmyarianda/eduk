<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kgajicatatan extends CI_Controller
{
    private static $_table = 'view_kgaji_catatan';
    private static $_primaryKey = 'gct_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kgajicatatan_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Kenaikan Gaji Berkala - EDUK';

        $data['content'] = 'vadmin/kgajicatatan';
        $this->load->view('vadmin/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'gct_id', 'dt' => 'gct_id'),
                array('db' => 'usr_nama', 'dt' => 'usr_nama'),
                array('db' => 'gct_tmt', 'dt' => 'gct_tmt'),
                array(
                    'db' => 'gct_skkenaikangaji', 'dt' => 'gct_skkenaikangaji', 'formatter' => function ($kgajictt) {
                        return '<a href="' . site_url('admin/kgajicatatan/download_file/' . $kgajictt) . '" class="btn btn-warning btn-sm mb-1"><i class="fas fa-download"></i>Download</a>';
                    }
                ),
                array('db' => 'gct_tgl_naikgaji', 'dt' => 'gct_tgl_naikgaji'),
                array(
                    'db' => 'gct_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('admin/kgajicatatan/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('admin/kgajicatatan/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
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
            $tmt = $this->input->post('tmt', TRUE);
            $sknaikgaji = $_FILES['sknaikgaji']['name'];
            $tgl_naikgaji = date('Y-m-d', strtotime('+2 years', strtotime($tmt)));
            $created_at = date('Y-m-d H:i:s');

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $sknaikgaji);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $sknaikgaji = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('sknaikgaji');

            $data = [
                'id_user' => $nama_pengguna,
                'gct_tmt' => $tmt,
                'gct_skkenaikangaji' => $sknaikgaji,
                'gct_tgl_naikgaji' => $tgl_naikgaji,
                'created_at' => $created_at
            ];

            $this->kgajicatatan_model->insert($data);
            $this->session->set_flashdata('success', 'Kenaikan Gaji berhasil ditambahkan.');
            redirect('admin/kgajicatatan');
        } else {
            $data['user'] = $this->kgajicatatan_model->get_all_user();
            $data['title'] = 'Tambah Data Kenaikan Gaji - EDUK';
            $data['form_title'] = 'Tambah Data Kenaikan Gaji';
            $data['content'] = 'vadmin/kgajicatatan_form';
            $this->load->view('vadmin/index', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $where = "gct_id = $id";
        $data['kgajicatatan'] = $this->kgajicatatan_model->get_kgajicatatan($where);
        $updated_at = date('Y-m-d H:i:s');

        if (isset($_POST['simpan'])) {
            $tmt = $this->input->post('tmt', TRUE);
            $tgl_naikgaji = date('Y-m-d', strtotime('+2 years', strtotime($tmt)));
            $sknaikgaji = $_FILES['sknaikgaji']['name'];

            $this->load->library('upload');

            $config['upload_path']      = './assets/pdf/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2048;
            $config['overwrite'] = TRUE;
            $x = explode(".", $sknaikgaji);
            $ext = strtolower(end($x));
            $config['file_name']        = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10) . '.' . $ext;
            // $config['file_name'] = $s_id . "-foto." . $ext;
            $sknaikgaji = $config['file_name'];
            $this->upload->initialize($config);
            $this->upload->do_upload('sknaikgaji');

            $data = [
                'gct_tmt' => $this->input->post('tmt', TRUE),
                'gct_tgl_naikgaji' => $tgl_naikgaji, 
                'gct_skkenaikangaji' => (!empty($sknaikgaji)) ? $sknaikgaji : $data['kgaji_catatan']['gct_skkenaikangaji'],
                'updated_at' => $updated_at
            ];

            $this->kgajicatatan_model->update($data, $id);
            $this->session->set_flashdata('success', 'Kenaikan Gaji berhasil diperbarui.');
            redirect('admin/kgajicatatan');
        } else {
            $data['user'] = $this->kgajicatatan_model->get_user();
            $data['title'] = 'Edit Data Kenaikan Gaji - EDUK';
            $data['form_title'] = 'Edit Data Kenaikan Gaji';
            $data['content'] = 'vadmin/kgajicatatan_edit_form';
            $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
            $this->load->view('vadmin/index', $data);
        }
    }

    public function delete($id = NULL)
    {
        $this->kgajicatatan_model->delete($id);
        $this->session->set_flashdata('success', 'Kenaikan Gaji Berkala berhasil dihapus.');
        redirect('admin/kgajicatatan');
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
