<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printer extends CI_Controller {
    public function __construct() {
		parent::__construct();
        $this->load->library('session');
	}
    
    public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$this->load->view('admin/print');
		}else{
			redirect(base_url('login'));
		}
		
	}

}
