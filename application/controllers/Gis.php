<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gis extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}

	//load kelurahan dari kecamatan
	function load_kelurahan()
	{
		$id= $this->input->get('id_kec');
		$kel = $this->supermodel->getData('kelurahan',array('kecamatan_id'=>$id));
		echo "<option value=''>- Pilih Kelurahan -</option>";
		foreach ($kel->result() as $row) {
			echo "<option value='".$row->kelurahan_id."' ".$sel.">".$row->kelurahan_nama."</option>";
		}
	}

	function index()
	{
		$konfig = $this->m_global->get_konfig();

		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		
		$vrs = array_merge($konfig,$data);
		$this->load->vars($vrs);
		$this->load->view('gis/template');
	}

	function mata_air()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/mata_air?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function sumur_pantau()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/sumur_pantau?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function sumur_imbuhan()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/sumur_imbuhan?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function sumur_resapan()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/sumur_resapan?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function perusahaan_pengguna_air_tanah()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/perusahaan_pengguna_air_tanah?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function sehati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/sehati?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function kehati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/kehati?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function pemerhati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/pemerhati?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function pembangunan_biogas()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/pembangunan_biogas?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function adipura()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/adipura?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function sekolah_adiwiyata()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/sekolah_adiwiyata?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function hutan_kota()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/hutan_kota?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function sungai()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/sungai?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function situ()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/situ?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function sumur()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/sumur?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function tanah()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/tanah?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}
	
	function cerobong()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/cerobong?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function ambien()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/ambien?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function pengawasan_b3()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/pengawasan_b3?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}

	function limbah_cair()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		echo '<iframe src="'.site_url('mapsxml/limbah_cair?kec='.$kec.'&kel='.$kel).'" width="100%" height="500" style="border:none;" scrolling="no"></iframe>';
	}
}

/* End of file gis.php */
/* Location: ./application/controllers/gis.php */