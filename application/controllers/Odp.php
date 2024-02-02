<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

class Odp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_odp");

		$this->excel = new Spreadsheet();
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


	public function generateExcelDocument(){
		ini_set('max_execution_time', '20'); //300 seconds = 5 minutes
		set_time_limit(300); 
		ini_set('memory_limit', '512M');
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		$lap_bulan = $this->input->post('lap_bulan');
		$lap_tahun = $this->input->post('lap_tahun');

		$data = $this->M_odp->odp($lap_bulan, $lap_tahun);

		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(__DIR__ . '/../../template/42. One Day Publish 1.xlsx');
		$sheet = $spreadsheet->getActiveSheet();
		// Set document properties
		// bulan  [
		// 	'01' => 'Januari',
		// 	'02' => 'Februari',
		// 	'03' => 'Maret',
		// 	'04' => 'April',
		// 	'05' => 'Mei',
		// 	'06' => 'Juni',
		// 	'07' => 'Juli',
		// 	'08' => 'Agustus',
		// 	'09' => 'September',
		// 	'10' => 'Oktober',
		// 	'11' => 'November',
		// 	'12' => 'Desember'
		// ];
		$bulan = [
			'01' => 'JANUARI'
			, '02' => 'FEBRUARI'
			, '03' => 'MARET'
			, '04' => 'APRIL'
			, '05' => 'MEI'
			, '06' => 'JUNI'
			, '07' => 'JULI'
			, '08' => 'AGUSTUS'
			, '09' => 'SEPTEMBER'
			, '10' => 'OKTOBER'
			, '11' => 'NOVEMBER'
			, '12' => 'DESEMBER'
			
		];
	$sheet->setCellValue('A9', ' BULAN ' . $bulan[$lap_bulan] . ' TAHUN ' . $lap_tahun);

		

		// $sheet->setCellValue('A9', 'BULAN ' . strtoupper(date('F')) . ' TAHUN ' . date('Y'));
		// $sheet->setCellValue('A9', 'BULAN ' . strtoupper($lap_bulan) . ' TAHUN ' . $lap_tahun);
		
		
		$row = 14;
		foreach ($data as $key => $value) {
			$spreadsheet->getActiveSheet()->insertNewRowBefore($row, 1);
			$sheet->setCellValue('A' . $row, $key + 1);
			$sheet->setCellValue('B' . $row, $value->nomor_perkara);
			$sheet->setCellValue('C' . $row, $value->jenis_perkara_nama);
			$sheet->setCellValue('D' . $row, $value->tanggal_putusan);
			$sheet->setCellValue('E' . $row, $value->tanggal_publish);
			$row++;
		}
		//Amuntai, 01 Februari 2024
	// tambah 2 baris
		$row = $row + 2;
		$spreadsheet->getActiveSheet()->setCellValue('D' . $row, 'Amuntai, ' . date('d F Y'));

		// tambah 1 baris
		// $row = $row + 1;
		// $spreadsheet->getActiveSheet()->setCellValue('D' . $row, 'Hakim Pengawas');
		
		// $spreadsheet->getActiveSheet()->setCellValue('D' . ($row + 6), 'PANMUD PERTANAHAN');

		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$filename = '42. One Day Publish 1 ' . $lap_bulan . '-' . $lap_tahun . '.xlsx';
		$writer->save($filename);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');


	}
}
