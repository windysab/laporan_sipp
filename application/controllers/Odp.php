<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Odp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_odp");
    }

   public function index()
    {
		$lap_bulan = $this->input->post('lap_bulan');
        $lap_tahun = $this->input->post('lap_tahun');
		$data['datafilter'] = $this->M_odp->odp($lap_bulan, $lap_tahun);
		$this->load->view('template/new_header');
		$this->load->view('template/new_sidebar');
		$this->load->view('v_odp', $data);
		$this->load->view('template/new_footer');	
    }
}
