<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

defined('BASEPATH') or exit('No direct script access allowed');

class Lipa1 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_lipa1");

		$this->excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
	}



	public function index()
	{
		$jenis_perkara = $this->input->post('jenis_perkara'); // Get the selected value
		$lap_bulan = $this->input->post('lap_bulan');
		$lap_tahun = $this->input->post('lap_tahun');
		$data['datafilter'] = $this->M_lipa1->getData($lap_tahun, $lap_bulan, $jenis_perkara);
		$this->load->view('template/new_header');
		$this->load->view('template/new_sidebar');
		$this->load->view('v_lipa1', $data);
		$this->load->view('template/new_footer');
	}

	



	public function generateExcelDocument()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$jenis_perkara = $this->input->post('jenis_perkara'); // Get the selected value
		$lap_bulan = $this->input->post('lap_bulan');
		$lap_tahun = $this->input->post('lap_tahun');
		
		$data = $this->M_lipa1->getData($lap_tahun, $lap_bulan, $jenis_perkara);

		

		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Set document properties


		$spreadsheet->getActiveSheet()->setTitle('Laporan');
		$spreadsheet->getActiveSheet()->setCellValue('A1', 'Laporan Lipa1 ' . $lap_bulan . '-' . $lap_tahun);
		$spreadsheet->getActiveSheet()->setCellValue('A2', 'No');
		$spreadsheet->getActiveSheet()->setCellValue('B2', 'NOMOR PERKARA');
		$spreadsheet->getActiveSheet()->setCellValue('C2', 'JENIS PERKARA');
		$spreadsheet->getActiveSheet()->setCellValue('D2', 'MAJELIS HAKIM');
		$spreadsheet->getActiveSheet()->setCellValue('E2', 'PANITERA PENGANTI');
		$spreadsheet->getActiveSheet()->setCellValue('F2', 'PANITERA');
		$spreadsheet->getActiveSheet()->setCellValue('G2', 'TANGGAL PENDAFTARAN');
		$spreadsheet->getActiveSheet()->setCellValue('H2', 'PENETAPAN MAJELIS HAKIM');
		$spreadsheet->getActiveSheet()->setCellValue('I2', 'PENETAPAN HARI SIDANG');
		$spreadsheet->getActiveSheet()->setCellValue('J2', 'SIDANG PERTAMA');
		$spreadsheet->getActiveSheet()->setCellValue('K2', 'TANGGAL PUTUSAN');
		$spreadsheet->getActiveSheet()->setCellValue('L2', 'STATUS PUTUSAN');
		$spreadsheet->getActiveSheet()->setCellValue('M2', 'PEKERJAAN');
		$spreadsheet->getActiveSheet()->setCellValue('N2', 'ALAMAT PIHAK 2');
		$spreadsheet->getActiveSheet()->setCellValue('O2', 'PRODEO');
		$spreadsheet->getActiveSheet()->setCellValue('P2', 'EMAIL PIHAK 1');

		// Write data to Excel file
		// Starting from row 3, since the first two rows are for headers
		$row = 3;
		foreach ($data as $item) {
			$spreadsheet->getActiveSheet()->setCellValue('A' . $row, $item->nomor_perkara);
			$spreadsheet->getActiveSheet()->setCellValue('B' . $row, $item->jenis_perkara_nama);
			$spreadsheet->getActiveSheet()->setCellValue('C' . $row, $item->majelis_hakim_nama);
			$spreadsheet->getActiveSheet()->setCellValue('D' . $row, $item->panitera_pengganti_text);
			$spreadsheet->getActiveSheet()->setCellValue('E' . $row, $item->tanggal_pendaftaran);
			$spreadsheet->getActiveSheet()->setCellValue('F' . $row, $item->penetapan_majelis_hakim);
			$spreadsheet->getActiveSheet()->setCellValue('G' . $row, $item->penetapan_hari_sidang);
			$spreadsheet->getActiveSheet()->setCellValue('H' . $row, $item->sidang_pertama);
			$spreadsheet->getActiveSheet()->setCellValue('I' . $row, $item->tanggal_putusan);
			$spreadsheet->getActiveSheet()->setCellValue('J' . $row, $item->status_putusan_nama);
			$spreadsheet->getActiveSheet()->setCellValue('K' . $row, $item->pekerjaan);
			$spreadsheet->getActiveSheet()->setCellValue('L' . $row, $item->alamat_pihak2);
			$spreadsheet->getActiveSheet()->setCellValue('M' . $row, $item->prodeo);
			$spreadsheet->getActiveSheet()->setCellValue('N' . $row, $item->email_pihak1);
			// ... continue for the rest of your columns
			$row++;
		}


		// // Save Excel file
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$filename = 'Laporan Lipa1 ' . $lap_bulan . '-' . $lap_tahun . '.xlsx';
		$writer->save($filename);

		// Save Excel file to a temporary file
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$temp_file = tempnam(sys_get_temp_dir(), 'laporan');
		$writer->save($temp_file);
		$filename = 'Laporan Lipa1 ' . $lap_bulan . '-' . $lap_tahun . '.xlsx';

		// Send headers and file to browser
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		readfile($temp_file);

		// Delete temporary file
		unlink($temp_file);

		// Stop script execution
		exit;
	}
}
