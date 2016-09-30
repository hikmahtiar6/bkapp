<?php
/**
* Author Imam Teguh
*/
class Ragamdata extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}

	// KONSERVASI
	function mata_air($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('mata_air',array('mata_air_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/mata_air', $data);
	}

	function sumur_pantau($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('sumur_pantau',array('sumur_pantau_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/sumur_pantau', $data);
	}

	function sumur_imbuhan($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('sumur_imbuhan',array('sumur_imbuhan_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/sumur_imbuhan', $data);
	}

	function sumur_resapan($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('sumur_resapan',array('sumur_resapan_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/sumur_resapan', $data);
	}

	function perusahaan_pengguna_air_tanah($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('pemanfaatan_air',array('pemanfaatan_air_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/perusahaan_pengguna_air_tanah', $data);
	}

	function sehati($id=NULL)
	{
		$kat='Sehati';
		$data['dt'] = $this->supermodel->getData('skp',array('skp_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/sehati', $data);
	}

	function kehati($id=NULL)
	{
		$kat='Sehati';
		$data['dt'] = $this->supermodel->getData('skp',array('skp_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/kehati', $data);
	}

	function pemerhati($id=NULL)
	{
		$kat='Pemerhati';
		$data['dt'] = $this->supermodel->getData('skp',array('skp_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/pemerhati', $data);
	}

	function pembangunan_biogas($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('biogas',array('biogas_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/pembangunan_biogas', $data);
	}

	function adipura($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('adipura',array('adipura_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/adipura', $data);
	}

	function sekolah_adiwiyata($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('sekolah',array('sekolah_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/sekolah_adiwiyata', $data);
	}

	function hutan_kota($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('hutan_kota',array('hutan_kota_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/hutan_kota', $data);
	}

	function sungai($id=NULL)
	{
		$data['dt'] = $this->supermodel->queryManual('
			SELECT l.nama_lokasi, l.lokasi_uji, l.kelurahan_id, l.lat, l.lng, l.icon_map, s.nama_sungai, l.lokasiuji_sungai_id
			FROM lokasiuji_sungai l, sungai s WHERE l.sungai_id=s.sungai_id AND l.lokasiuji_sungai_id="'.$id.'"
			')->row_array();
		$this->load->view('gis/ragamdata/sungai', $data);
	}

	function situ($id=NULL)
	{
		$data['dt'] = $this->supermodel->queryManual('
			SELECT l.nama_lokasi, l.lokasi_uji, l.kelurahan_id, l.lat, l.lng, l.icon_map, s.nama_situ, l.lokasiuji_situ_id
			FROM lokasiuji_situ l, situ s WHERE l.situ_id=s.situ_id AND l.lokasiuji_situ_id="'.$id.'"
			')->row_array();
		$this->load->view('gis/ragamdata/situ', $data);
	}

	function sumur($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('lokasiuji_sumur',array('lokasiuji_sumur_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/sumur', $data);
	}

	function tanah($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('lokasiuji_tanah',array('lokasiuji_tanah_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/tanah', $data);
	}
	
	function cerobong($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('lokasiuji_cerobong',array('lokasiuji_cerobong_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/cerobong', $data);
	}

	function ambien($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('lokasiuji_ambien',array('lokasiuji_ambien_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/ambien', $data);
	}

	function pengawasan_b3($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('izin_btiga',array('izin_btiga_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/pengawasan_b3', $data);
	}

	function limbah_cair($id=NULL)
	{
		$data['dt'] = $this->supermodel->getData('lokasiuji_limbah_cair',array('lokasiuji_limbah_cair_id'=>$id))->row_array();
		$this->load->view('gis/ragamdata/limbah_cair', $data);
	}
}
?>