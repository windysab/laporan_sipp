<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard1 extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/new_header');
		$this->load->view('template/new_sidebar');
		$this->load->view('dashboard');
		$this->load->view('template/new_footer');
	}
    
}
