<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pangkat extends CI_Controller
{
    private static $_table = 'pangkat';
    private static $_primaryKey = 'pkt_id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pangkat_model');
        $this->auth->restrict();
    }

    public function index()
    {
        $data['title'] = 'Pangkat - EDUK';

        $data['content'] = 'vadmin/pangkat';
        $this->load->view('vadmin/index', $data);
    }

    public function get_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->load->library('datatables_ssp');

            $columns = array(
                array('db' => 'pkt_id', 'dt' => 'pkt_id'),
                array('db' => 'pkt_nama', 'dt' => 'pkt_nama'),
                array('db' => 'pkt_golongan', 'dt' => 'pkt_golongan'),
                array(
                    'db' => 'pkt_id',
                    'dt' => 'action',
                    'formatter' => function ($id) {
                        return '<a href="' . site_url('admin/pangkat/edit/' . $id) . '" class="btn btn-success btn-sm mb-1"><i class="fas fa-edit"></i></a>
                                <a onclick="deleteConfirm(' . "'" . site_url('admin/pangkat/delete/' . $id) . "'" . ')" href="#!" class="btn btn-danger btn-sm mb-1"><i class="fas fa-trash"></i></a>';
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

            $nama_pangkat = $this->input->post('nama_pangkat', TRUE);
            $golongan = $this->input->post('golongan', TRUE);
            $created_at = date('Y-m-d H:i:s');
            
            $data = [
                'pkt_nama' => $nama_pangkat,
                'pkt_golongan' => $golongan,
                'created_at' => $created_at
            ];
            

            $this->pangkat_model->insert($data);
            $this->session->set_flashdata('success', 'Pangkat berhasil ditambahkan.');
            redirect('admin/pangkat');
        } else {
            $data['title'] = 'Tambah Pangkat - EDUK';
            $data['form_title'] = 'Tambah Pangkat';
            $data['content'] = 'vadmin/pangkat_form';
            $this->load->view('vadmin/index', $data);
        }
    }

    public function edit()
    {
        $id = $this->uri->segment(4);
        $where = "pkt_id = $id";
        $data['pangkat'] = $this->pangkat_model->get_pangkat($where);
        $updated_at = date('Y-m-d H:i:s');

        if (isset($_POST['simpan'])) {
            $data = [
                'pkt_nama' => $this->input->post('nama_pangkat', TRUE),
                'pkt_golongan' => $this->input->post('golongan', TRUE),
                'updated_at' => $updated_at
            ];

            $this->pangkat_model->update($data, $id);
            $this->session->set_flashdata('success', 'Pangkat berhasil diperbarui.');
            redirect('admin/pangkat');
        } else {
            $data['title'] = 'Edit Pangkat - EDUK';
            $data['form_title'] = 'Edit Pangkat';
            $data['content'] = 'vadmin/pangkat_edit_form';
            $data['action'] = site_url(uri_string()); // Mengambil URL yang aktif
            $this->load->view('vadmin/index', $data);
        }
    }

    public function delete($id = NULL)
    {
        $this->pangkat_model->delete($id);
        $this->session->set_flashdata('success', 'Pangkat berhasil dihapus.');
        redirect('admin/pangkat');
    }
}
