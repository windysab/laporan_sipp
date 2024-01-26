<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Home_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $home = $this->Home_model->jumlah_mhs();

        $data = array(
            'home_data' => $home
        );

        $this->template->load('template_home','menu','home/home', $data);
    }
}