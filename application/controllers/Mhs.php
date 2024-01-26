<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mhs extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Mhs_model');
        $this->load->library('form_validation');
        $this->load->library('Pagination');
        $this->load->library('Pagination_bs');
    }

    public function index()
        {
            //$mhs = $this->Mhs_model->get_all();
            if ($this->input->POST('s_cari',TRUE)) {
                $this->session->set_flashdata('pag', $this->input->POST('cari',TRUE));
            }elseif($this->input->POST('reset')){
                $this->session->set_flashdata('pag', '');
            }

            $jlh_data=$this->Mhs_model->count_data($this->session->flashdata('pag'));
            $config=$this->pagination_bs->load('mhs/index',$jlh_data);
            $this->pagination->initialize($config);
            $page= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            
            //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
            $mhs_data = $this->Mhs_model->get_mahasiswa_list($config["per_page"], $page,$this->session->flashdata('pag'));  
                                                                                // sesion untuk cari
            $this->session->set_flashdata('pag', $this->session->flashdata('pag'));
            //echo $this->input->post('cari',TRUE);;         
            //echo $this->session->flashdata('pag');
            $pagination = $this->pagination->create_links();
            $data = array(
                'page' => $page,
                'mhs_data' => $mhs_data,
                'pagination' => $pagination,
                'jlh_data' => $jlh_data,
            );

            $this->template->load('template_tabel','menu','mhs/mhs_list', $data);
            //$this->load->view('menu','',FALSE);//true false untuk tidak langsung tampil
        }
    
    public function read($nim) 
        {
            $row = $this->Mhs_model->get_by_id($nim);
            if ($row) {
                $data = array(
    		'nim' => $row->nim,
    		'nama' => $row->nama,
    		'gender' => $row->gender,
    		'tanggal_lahir' => $row->tanggal_lahir,
    		'tempat_lahir' => $row->tempat_lahir,
    		'kd_agama' => $row->kd_agama,
            'foto' => $row->foto,
            'kd_kelas' => $row->kd_kelas,
    	    );
                $this->template->load('template_tabel','menu','mhs/mhs_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('mhs'));
            }
        }

    public function create() 
        {
            $data = array(
                'judul' => 'Form Tambah Mahasiswa',
                'button' => 'Simpan',
                'action' => site_url('mhs/create_action'),
    	    'nim' => set_value('nim'),
    	    'nama' => set_value('nama'),
    	    'gender' => set_value('gender'),
    	    'tanggal_lahir' => set_value('tanggal_lahir'),
    	    'tempat_lahir' => set_value('tempat_lahir'),
    	    'kd_agama' => set_value('kd_agama'),
            'foto' => set_value('foto'),
    	   );
            $this->template->load('template_form','menu','mhs/mhs_form', $data);
        }
    
    public function create_action() 
        {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $foto=$this->upload_foto_mhs();
                $data = array(
    		'nim' => $this->input->post('nim',TRUE),
    		'nama' => $this->input->post('nama',TRUE),
    		'gender' => $this->input->post('gender',TRUE),
    		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
    		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
            'kd_agama' => $this->input->post('kd_agama',TRUE),
            'foto' => $foto,
    	    );

                $this->Mhs_model->insert($data);

                $this->session->set_flashdata('message', 'Mahasiswa berhasil ditambah dengan nama: '.$this->input->post('nama',TRUE));
                redirect(site_url('mhs/create'));
                
            }
        }

    function get_name_pic()
        {
            $filename=$_FILES['foto']['name'];
             return $filename;
        }

    function upload_foto_mhs()
        {
            //validasi foto yang di upload
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);

            //proses upload
            $this->upload->do_upload('foto');
            $upload = $this->upload->data();
            return $upload['file_name'];            
        }
        
    public function update($nim) 
        {
            $row = $this->Mhs_model->get_by_id($nim);
            //echo $row['nim'];
            if ($row) {
                $data = array(
                    'judul' => 'Form Edit Mahasiswa',
                    'button' => 'Ubah',
                    'action' => site_url('mhs/update_action'),
    		'nim' => set_value('nim',$row->nim),
            'nama' => set_value('nama',$row->nama),
            'gender' => set_value('gender',$row->gender),
            'tanggal_lahir' => set_value('tanggal_lahir',$row->tanggal_lahir),
            'tempat_lahir' => set_value('tempat_lahir',$row->tempat_lahir),
            'kd_agama' => set_value('kd_agama',$row->kd_agama),
            'foto' => set_value('foto',$row->foto),
            );
                $this->template->load('template_form','menu','mhs/mhs_form', $data);
            }else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('menu'));
            }
        }
    
    public function update_action() 
        {
            $this->_rules_update();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('nim', TRUE));
            } else {
            $foto=$this->get_name_pic();
            // mengambil nama foto untuk di hapus
            if (empty($foto)) {
                $data = array(
            'nim' => $this->input->post('nim',TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'gender' => $this->input->post('gender',TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
            'kd_agama' => $this->input->post('kd_agama',TRUE),
            
            );
            }else{
                $row = $this->Mhs_model->get_by_id($this->input->post('nim',TRUE));
                if ($row) {
                    $old_foto=$row->foto;
                    
                }
                
                //link tdak bisa absolut url
                $foto=$this->upload_foto_mhs();
                $err=$this->upload->display_errors();
                if (empty($err)) {
                        unlink("./uploads/".$old_foto);
                    }
                $data = array(
            'nim' => $this->input->post('nim',TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'gender' => $this->input->post('gender',TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
            'kd_agama' => $this->input->post('kd_agama',TRUE),
            'foto' => $foto,
            );
            }
            if (empty($err)) {
                $this->Mhs_model->update($this->input->post('nim', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('mhs/update/'.$this->input->post('nim',TRUE)));
            }else{
                $this->session->set_flashdata('message', $err);
                $this->update($this->input->post('nim', TRUE));
                
            }
                
                //redirect(site_url('mhs'));
            }
        }
    
    public function delete($nim) 
        {
            $row = $this->Mhs_model->get_by_id($nim);

            if ($row) {
                $this->Mhs_model->delete($nim);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('mhs'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('mhs'));
            }
        }

    public function _rules() 
        {
    	$this->form_validation->set_rules('nim', 'nim', 'trim|required|is_unique[tbl_mhs.nim]');
    	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
    	$this->form_validation->set_rules('gender', 'gender', 'trim|required');
    	$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
    	$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');

    	$this->form_validation->set_rules('kd_agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('foto', 'foto', 'trim');
        //$this->form_validation->set_rules('kd_kelas', 'Kelas', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        }
    public function _rules_update() 
        {
        $this->form_validation->set_rules('nim', 'nim', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('gender', 'gender', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');

        $this->form_validation->set_rules('kd_agama', 'Agama', 'trim|required');
        $this->form_validation->set_rules('foto', 'foto', 'trim');
        //$this->form_validation->set_rules('kd_kelas', 'Kelas', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        }

    public function excel()
        {
            $this->load->helper('exportexcel');
            $namaFile = "Data Mahasiswa.xls";
            $judul = "Data Mahasiswa";
            $tablehead = 0;
            $tablebody = 1;
            $nourut = 1;
            //penulisan header
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Disposition: attachment;filename=" . $namaFile . "");
            header("Content-Transfer-Encoding: binary ");

            xlsBOF();

            $kolomhead = 0;
            xlsWriteLabel($tablehead, $kolomhead++, "No");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nim");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
    	xlsWriteLabel($tablehead, $kolomhead++, "Gender");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");

    	foreach ($this->Mhs_model->get_all() as $data) {
                $kolombody = 0;

                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nim);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->gender);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->tempat_lahir);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->tanggal_lahir);

    	    $tablebody++;
                $nourut++;
            }

            xlsEOF();
            exit();
        }

    public function word()
        {
            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=menu.doc");

            $data = array(
                'menu_data' => $this->Mhs_model->get_all(),
                'start' => 0
            );
            
            $this->load->view('menu_doc',$data);
        }

    function pdf()
        {
            $data = array(
                'menu_data' => $this->Menu_model->get_all(),
                'start' => 0
            );
            
            ini_set('memory_limit', '32M');
            $html = $this->load->view('menu_pdf', $data, true);
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output('menu.pdf', 'D'); 
        }

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-01-01 09:22:19 */
/* http://harviacode.com */