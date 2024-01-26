<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prodi extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Prodi_model');
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

            $jlh_data=$this->Prodi_model->count_data($this->session->flashdata('pag'));
            $config=$this->pagination_bs->load('prodi/index',$jlh_data);
            $this->pagination->initialize($config);
            $page= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            
            
            //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
            $prodi_data = $this->Prodi_model->get_prodi_list($config["per_page"], $page,$this->session->flashdata('pag'));  
                                                                                // sesion untuk cari
            $this->session->set_flashdata('pag', $this->session->flashdata('pag'));
            //echo $this->input->post('cari',TRUE);;         
            //echo $this->session->flashdata('pag');
            $pagination = $this->pagination->create_links();
            $data = array(
                'page' => $page,
                'prodi_data' => $prodi_data,
                'pagination' => $pagination,
                'jlh_data' => $jlh_data,
            );

            $this->template->load('template_tabel','menu','prodi/prodi_list', $data);
            //$this->load->view('menu','',FALSE);//true false untuk tidak langsung tampil
        }
    
    public function read($id) 
        {
            $row = $this->Prodi_model->get_by_id($id);
            if ($row) {
                $data = array(
            'judul' => 'Detail Prodi',
    		'id_prodi' => $row->id_prodi,
    		'nama_prodi' => $row->nama_prodi,
    		'no_telp' => $row->no_telp,
    		'alamat' => $row->alamat,
    	    );
                $this->template->load('template_tabel','menu','prodi/prodi_read', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('prodi'));
            }
        }

    public function create() 
        {
            $data = array(
                'judul' => 'Form Tambah Prodi',
                'button' => 'Simpan',
                'action' => site_url('prodi/create_action'),
    	    'id_prodi' => set_value('id_prodi'),
    	    'nama_prodi' => set_value('nama_prodi'),
    	    'no_telp' => set_value('no_telp'),
    	    'alamat' => set_value('alamat'),
    	   );
            $this->template->load('template_form','menu','prodi/prodi_form', $data);
        }
    
    public function create_action() 
        {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $foto=$this->upload_foto_mhs();
                $data = array(
    		'id_prodi' => $this->input->post('id_prodi',TRUE),
    		'nama_prodi' => $this->input->post('nama_prodi',TRUE),
    		'no_telp' => $this->input->post('no_telp',TRUE),
    		'alamat' => $this->input->post('alamat',TRUE),
    	    );

                $this->Prodi_model->insert($data);

                $this->session->set_flashdata('message', 'Prodi '.$this->input->post('nama_prodi',TRUE).'berhasil ditambah');
                redirect(site_url('prodi/create'));
                
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
            $row = $this->Prodi_model->get_by_id($id);
            //echo $row['nim'];
            if ($row) {
                $data = array(
                    'judul' => 'Form Edit Prodi',
                    'button' => 'Ubah',
                    'action' => site_url('prodi/update_action'),
    		'id_prodi' => set_value('id_prodi',$row->id_prodi),
            'nama_prodi' => set_value('nama_prodi',$row->nama_prodi),
            'no_telp' => set_value('no_telp',$row->no_telp),
            'alamat' => set_value('alamat',$row->alamat),
            );
                $this->template->load('template_form','menu','prodi/prodi_form', $data);
            }else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('prodi'));
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
                'id_prodi' => $this->input->post('id_prodi',TRUE),
                'nama_prodi' => $this->input->post('nama_prodi',TRUE),
                'no_telp' => $this->input->post('no_telp',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                );
                $this->Prodi_model->update($this->input->post('id_prodi', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('prodi/update/'.$this->input->post('id_prodi',TRUE)));
            }
        }
    
    public function delete($id) 
        {
            $row = $this->Prodi_model->get_by_id($id);

            if ($row) {
                $this->Prodi_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('prodi'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('prodi'));
            }
        }

    public function _rules() 
        {
    	$this->form_validation->set_rules('id_prodi', 'id_prodi', 'trim|required|is_unique[tbl_prodi.id_prodi]');
    	$this->form_validation->set_rules('nama_prodi', 'Nama prodi', 'trim|required');
    	$this->form_validation->set_rules('no_telp', 'Nomor telepon', 'trim|required');
    	$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        }
    public function _rules_update() 
        {
        $this->form_validation->set_rules('id_prodi', 'id_prodi', 'trim|required');
        $this->form_validation->set_rules('nama_prodi', 'Nama prodi', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'Nomor telepon', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
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