<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_lipa1 extends CI_Model
{
	public function getData($lap_tahun, $lap_bulan, $jenis_perkara)
	{
		$this->db->select("nomor_perkara, jenis_perkara_nama, majelis_hakim_nama, panitera_pengganti_text, tanggal_pendaftaran, penetapan_majelis_hakim, penetapan_hari_sidang, sidang_pertama, tanggal_putusan, status_putusan_id, pekerjaan, perkara_pihak2.alamat as alamat_pihak2, prodeo, pihak.email as email_pihak1");
		$this->db->from("perkara");
		$this->db->join("perkara_penetapan", "perkara.perkara_id = perkara_penetapan.perkara_id", "left");
		$this->db->join("perkara_putusan", "perkara.perkara_id = perkara_putusan.perkara_id", "left");
		$this->db->join("perkara_pihak1", "perkara.perkara_id = perkara_pihak1.perkara_id", "left");
		$this->db->join("perkara_pihak2", "perkara.perkara_id = perkara_pihak2.perkara_id", "left");
		$this->db->join("pihak", "perkara_pihak1.pihak_id = pihak.id", "left");
		$this->db->join("perkara_efiling_id", "perkara.perkara_id = perkara_efiling_id.perkara_id", "left");
		$this->db->where("YEAR(tanggal_pendaftaran)", $lap_tahun);
		$this->db->where("MONTH(tanggal_pendaftaran)", $lap_bulan);
		$this->db->or_where("YEAR(penetapan_majelis_hakim)", $lap_tahun);
		$this->db->where("MONTH(penetapan_majelis_hakim)", $lap_bulan);
		$this->db->or_where("YEAR(penetapan_hari_sidang)", $lap_tahun);
		$this->db->where("MONTH(penetapan_hari_sidang)", $lap_bulan);
		$this->db->or_where("YEAR(sidang_pertama)", $lap_tahun);
		$this->db->where("MONTH(sidang_pertama)", $lap_bulan);
		$this->db->or_where("YEAR(tanggal_putusan)", $lap_tahun);
		$this->db->where("MONTH(tanggal_putusan)", $lap_bulan);
		$this->db->or_where("tanggal_pendaftaran IS NULL", NULL, FALSE);
		$this->db->where("perkara_pihak1.pihak_id !=", '1');
		$this->db->like("perkara.nomor_perkara", $jenis_perkara);
		$this->db->where("perkara_pihak1.urutan", '1');
		$this->db->not_like("pekerjaan", 'Pensiunan');
		$this->db->order_by("tanggal_pendaftaran");
	
		$query = $this->db->get();
		return $query->result();
	}
}
