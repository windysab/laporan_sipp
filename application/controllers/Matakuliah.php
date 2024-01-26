<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Matakuliah extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Matakuliah_model');
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

            $jlh_data=$this->Matakuliah_model->count_data($this->session->flashdata('pag'));
            $config=$this->pagination_bs->load('matakuliah/index',$jlh_data);
            $this->pagination->initialize($config);
            $page= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            
            //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
            $data = $this->Matakuliah_model->get_list($config["per_page"], $page,$this->session->flashdata('pag'));  
                                                                                // sesion untuk cari
            $this->session->set_flashdata('pag', $this->session->flashdata('pag'));
            //echo $this->input->post('cari',TRUE);;         
            //echo $this->session->flashdata('pag');
            $pagination = $this->pagination->create_links();
            $data = array(
                'page' => $page,
                'data' => $data,
                'pagination' => $pagination,
                'jlh_data' => $jlh_data,
            );

            $this->template->load('template_tabel','menu','matakuliah/matakuliah_list', $data);
            //$this->load->view('menu','',FALSE);//true false untuk tidak langsung tampil
        }
    
    public function read($id) 
        {
            $row = $this->Matakuliah_model->get_by_id($id);
            if ($row) {
                $data = array(
            'judul' => 'Detail Matakuliah',
    		'id_mata_kuliah' => $row->id_mata_kuliah,
    		'nama_prodi' => $row->nama_prodi,
    		'nama_mata_kuliah' => $row->nama_mata_kuliah,
    		'sks' => $row->sks,
            'semester' => $row->sks,
            'nama_prodi' => $row->nama_prodi,
    	    );
                $this->template->load('template_tabel','menu','matakuliah/matakuliah_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('prodi'));
            }
        }

    public function create() 
        {
            $query=$this->Matakuliah_model->get_prodi();
            $data = array(
                'judul' => 'Form Tambah Matakuliah',
                'button' => 'Simpan',
                'action' => site_url('matakuliah/create_action'),
    	    'id_mata_kuliah' => set_value('id_mata_kuliah'),
    	    'nama_mata_kuliah' => set_value('nama_mata_kuliah'),
    	    'sks' => set_value('sks'),
            'semester' => set_value('semester'),
    	    'id_prodi' => set_value('id_prodi'),
            'prodi' => $query,
    	   );
            $this->template->load('template_form','menu','matakuliah/matakuliah_form', $data);
        }
    
    public function create_action() 
        {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $foto=$this->upload_foto_mhs();
                $data = array(
    		'id_mata_kuliah' => $this->input->post('id_mata_kuliah',TRUE),
    		'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah',TRUE),
    		'sks' => $this->input->post('sks',TRUE),
    		'semester' => $this->input->post('semester',TRUE),
            'id_prodi' => $this->input->post('id_prodi',TRUE),
    	    );

                $this->Matakuliah_model->insert($data);

                $this->session->set_flashdata('message', 'Matakuliah '.$this->input->post('nama_mata_kuliah',TRUE).'berhasil ditambah');
                redirect(site_url('matakuliah/create'));
                
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
        
    public function update($id) 
        {
            $row = $this->Matakuliah_model->get_by_id($id);
            $query=$this->Matakuliah_model->get_prodi();
            //echo $row['nim'];
            if ($row) {
                $data = array(
                    'judul' => 'Form Edit Matakuliah',
                    'button' => 'Ubah',
                    'action' => site_url('matakuliah/update_action'),
    		'id_mata_kuliah' => set_value('id_mata_kuliah',$row->id_mata_kuliah),
            'nama_mata_kuliah' => set_value('nama_mata_kuliah',$row->nama_mata_kuliah),
            'sks' => set_value('sks',$row->sks),
            'semester' => set_value('semester',$row->semester),
            'id_prodi' => set_value('id_prodi',$row->id_prodi),
            'prodi' => $query,
            );
                $this->template->load('template_form','menu','matakuliah/matakuliah_form', $data);
            }else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('matakuliah'));
            }
        }
    
    public function update_action() 
        {
            $this->_rules_update();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_prodi', TRUE));
            } 
            else 
            {
            
                $data = array(
                'id_mata_kuliah' => $this->input->post('id_mata_kuliah',TRUE),
                'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah',TRUE),
                'sks' => $this->input->post('sks',TRUE),
                'semester' => $this->input->post('semester',TRUE),
                'id_prodi' => $this->input->post('id_prodi',TRUE),
                );
                $this->Matakuliah_model->update($this->input->post('id_mata_kuliah', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('matakuliah/update/'.$this->input->post('id_mata_kuliah',TRUE)));
            }
        }
    
    public function delete($id) 
        {
            $row = $this->Matakuliah_model->get_by_id($id);

            if ($row) {
                $this->Matakuliah_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('matakuliah'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('matakuliah'));
            }
        }

    public function _rules() 
        {
    	$this->form_validation->set_rules('id_mata_kuliah', 'ID', 'trim|required|is_unique[tbl_matakuliah.id_mata_kuliah]');
    	$this->form_validation->set_rules('nama_mata_kuliah', 'Nama Matakuliah', 'trim|required');
    	$this->form_validation->set_rules('sks', 'Jumlah SKS', 'trim|required');
    	$this->form_validation->set_rules('semester', 'Semester', 'trim|required');
        $this->form_validation->set_rules('id_prodi', 'PRODI', 'trim|required');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        }
    public function _rules_update() 
        {
        $this->form_validation->set_rules('id_mata_kuliah', 'ID', 'trim|required');
        $this->form_validation->set_rules('nama_mata_kuliah', 'Nama Matakuliah', 'trim|required');
        $this->form_validation->set_rules('sks', 'Jumlah SKS', 'trim|required');
        $this->form_validation->set_rules('semester', 'Semester', 'trim|required');
        $this->form_validation->set_rules('id_prodi', 'PRODI', 'trim|required');
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