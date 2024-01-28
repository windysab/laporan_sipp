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



	// public function generateExcelDocument()
	// {
	// 	$spreadsheet = new Spreadsheet();
	// 	$lap_bulan = $this->input->post('lap_bulan');
	// 	$lap_tahun = $this->input->post('lap_tahun');
	// 	$jenis_perkara = $this->input->post('jenis_perkara');
	// 	$data['datafilter'] = $this->M_lipa1->getData($lap_tahun, $lap_bulan, $jenis_perkara);
	// 	$spreadsheet->setActiveSheetIndex(0);
	// 	$spreadsheet->getActiveSheet()->setTitle('Laporan');
	// 	$spreadsheet->getActiveSheet()->setCellValue('A1', 'Laporan Lipa1 ' . $lap_bulan . '-' . $lap_tahun);
	// 	$spreadsheet->getActiveSheet()->setCellValue('A2', 'No');
	// 	$spreadsheet->getActiveSheet()->setCellValue('B2', 'NOMOR PERKARA');
	// 	$spreadsheet->getActiveSheet()->setCellValue('C2', 'JENIS PERKARA');
	// 	$spreadsheet->getActiveSheet()->setCellValue('D2', 'MAJELIS HAKIM');
	// 	$spreadsheet->getActiveSheet()->setCellValue('E2', 'PANITERA PENGANTI');
	// 	$spreadsheet->getActiveSheet()->setCellValue('F2', 'PANITERA');
	// 	$spreadsheet->getActiveSheet()->setCellValue('G2', 'TANGGAL PENDAFTARAN');
	// 	$spreadsheet->getActiveSheet()->setCellValue('H2', 'PENETAPAN MAJELIS HAKIM');
	// 	$spreadsheet->getActiveSheet()->setCellValue('I2', 'PENETAPAN HARI SIDANG');
	// 	$spreadsheet->getActiveSheet()->setCellValue('J2', 'SIDANG PERTAMA');
	// 	$spreadsheet->getActiveSheet()->setCellValue('K2', 'TANGGAL PUTUSAN');
	// 	$spreadsheet->getActiveSheet()->setCellValue('L2', 'STATUS PUTUSAN');
	// 	$spreadsheet->getActiveSheet()->setCellValue('M2', 'PEKERJAAN');
	// 	$spreadsheet->getActiveSheet()->setCellValue('N2', 'ALAMAT PIHAK 2');
	// 	$spreadsheet->getActiveSheet()->setCellValue('O2', 'PRODEO');
	// 	$spreadsheet->getActiveSheet()->setCellValue('P2', 'EMAIL PIHAK 1');


	// 	// ... (the rest of your code remains unchanged)



	// 	$no = 3;

	// 	foreach ($data['datafilter'] as $row) {
	// 		$spreadsheet->getActiveSheet()->setCellValue('A' . $no, $no - 2);
	// 		$spreadsheet->getActiveSheet()->setCellValue('B' . $no, $row->nomor_perkara);
	// 		$spreadsheet->getActiveSheet()->setCellValue('D' . $no, $row->jenis_perkara_nama);
	// 		$spreadsheet->getActiveSheet()->setCellValue('E' . $no, $row->nomor_perkara);
	// 		$spreadsheet->getActiveSheet()->setCellValue('F' . $no, $row->tanggal_pendaftaran);
	// 		$spreadsheet->getActiveSheet()->setCellValue('G' . $no, $row->majelis_hakim_nama);
	// 		$spreadsheet->getActiveSheet()->setCellValue('H' . $no, $row->panitera_pengganti_text);
	// 		$spreadsheet->getActiveSheet()->setCellValue('I' . $no, $row->panitera_pengganti_text);
	// 		$spreadsheet->getActiveSheet()->setCellValue('J' . $no, $row->tanggal_pendaftaran);
	// 		$spreadsheet->getActiveSheet()->setCellValue('K' . $no, $row->penetapan_majelis_hakim);
	// 		$spreadsheet->getActiveSheet()->setCellValue('L' . $no, $row->penetapan_hari_sidang);
	// 		$spreadsheet->getActiveSheet()->setCellValue('M' . $no, $row->sidang_pertama);
	// 		$spreadsheet->getActiveSheet()->setCellValue('N' . $no, $row->tanggal_putusan);
	// 		$spreadsheet->getActiveSheet()->setCellValue('O' . $no, $row->status_putusan_nama);
	// 		$spreadsheet->getActiveSheet()->setCellValue('P' . $no, $row->pekerjaan);
	// 		$spreadsheet->getActiveSheet()->setCellValue('Q' . $no, $row->alamat_pihak2);
	// 		$spreadsheet->getActiveSheet()->setCellValue('R' . $no, $row->prodeo);
	// 		$spreadsheet->getActiveSheet()->setCellValue('S' . $no, $row->email_pihak1);
	// 		$no++;



	// 		// ... (the rest of your code remains unchanged)

	// 	}

	// 	// ... (the rest of your code remains unchanged)
	// 	$filename = 'Laporan Lipa1 ' . $lap_bulan . '-' . $lap_tahun . '.xls';

	// 	header('Content-Type: application/vnd.ms-excel');
	// 	header('Content-Disposition: attachment;filename="' . $filename . '"');
	// 	header('Cache-Control: max-age=0');

	// 	$objWriter = IOFactory::createWriter($spreadsheet, 'Xls');
	// 	ob_end_clean();
	// 	$objWriter->save('php://output');
	// }

	public function generateExcelDocument()
	{
		// Load PhpSpreadsheet library
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$lap_bulan = $this->input->post('lap_bulan');
		$lap_tahun = $this->input->post('lap_tahun');
		$jenis_perkara = $this->input->post('jenis_perkara');
		



		// Get data from view
		// $data = $this->M_lipa1->getData('2024', '02', 'Pdt.G');
		$data = $this->M_lipa1->getData($lap_tahun, $lap_bulan, $jenis_perkara);
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
		$no = 3; // Start from the third row
		foreach ($data as $item) {
			$sheet->setCellValue('A' . $no, $no - 2);
			$sheet->setCellValue('B' . $no, $item->nomor_perkara);
			$sheet->setCellValue('C' . $no, $item->jenis_perkara_nama);
			$sheet->setCellValue('D' . $no, $item->majelis_hakim_nama);
			$sheet->setCellValue('E' . $no, $item->panitera_pengganti_text);
			$sheet->setCellValue('F' . $no, $item->tanggal_pendaftaran);
			$sheet->setCellValue('G' . $no, $item->penetapan_majelis_hakim);
			$sheet->setCellValue('H' . $no, $item->penetapan_hari_sidang);
			$sheet->setCellValue('I' . $no, $item->sidang_pertama);
			$sheet->setCellValue('J' . $no, $item->tanggal_putusan);
			$sheet->setCellValue('K' . $no, $item->status_putusan_nama);
			$sheet->setCellValue('L' . $no, $item->pekerjaan);
			$sheet->setCellValue('M' . $no, $item->alamat_pihak2);
			$sheet->setCellValue('N' . $no, $item->prodeo);
			$sheet->setCellValue('O' . $no, $item->email_pihak1);


			// ... Write the rest of the data ...

			$no++;
		}

		// Save Excel file

		$filename = 'Laporan Lipa1 ' . $lap_bulan . '-' . $lap_tahun . '.xls';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');



		$objWriter = IOFactory::createWriter($spreadsheet, 'Xls');
		ob_end_clean();
		$objWriter->save('php://output');
		
	}
}
