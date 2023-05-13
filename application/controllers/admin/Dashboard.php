<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
        $this->auth->restrict();
        // $this->auth->not_admin();
	}

	public function index()
	{
		$data['title'] = 'Dashboard - ELaporan';
        $data['content'] = 'vadmin/home';
        $this->load->view('vadmin/index', $data);
	}
}