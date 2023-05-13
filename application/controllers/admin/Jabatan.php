<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    private static $_table = 'jabatan';
    private static $_primaryKey = 'jbt_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jabatan_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Jabatan - EDUK';

        $data['content'] = 'vadmin/jabatan';
        $this->load->view('vadmin/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'jbt_id', 'dt' => 'jbt_id'),
                array('db' => 'jbt_nama', 'dt' => 'jbt_nama'),
                array(
                    'db' => 'jbt_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('admin/jabatan/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('admin/jabatan/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
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

            $nama_jabatan = $this->input->post('nama_jabatan', TRUE);
            $created_at = date('Y-m-d H:i:s');
            
            $data = [
                'jbt_nama' => $nama_jabatan,
                'created_at' => $created_at
            ];
            

            $this->jabatan_model->insert($data);
            $this->session->set_flashdata('success', 'Jabatan berhasil ditambahkan.');
            redirect('admin/jabatan');
        } else {
            $data['title'] = 'Tambah Jabatan - EDUK';
            $data['form_title'] = 'Tambah Jabatan';
            $data['content'] = 'vadmin/jabatan_form';
            $this->load->view('vadmin/index', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $where = "jbt_id = $id";
        $data['jabatan'] = $this->jabatan_model->get_jabatan($where);
        $updated_at = date('Y-m-d H:i:s');

        if (isset($_POST['simpan'])) {
            $data = [
                'jbt_nama' => $this->input->post('nama_jabatan', TRUE),
                'updated_at' => $updated_at
            ];

            $this->jabatan_model->update($data, $id);
            $this->session->set_flashdata('success', 'Jabatan berhasil diperbarui.');
            redirect('admin/jabatan');
        } else {
            $data['title'] = 'Edit Jabatan - EDUK';
            $data['form_title'] = 'Edit Jabatan';
            $data['content'] = 'vadmin/jabatan_edit_form';
            $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
            $this->load->view('vadmin/index', $data);
        }
    }

    public function delete($id = NULL)
    {
        $this->jabatan_model->delete($id);
        $this->session->set_flashdata('success', 'Jabatan berhasil dihapus.');
        redirect('admin/jabatan');
    }
}
