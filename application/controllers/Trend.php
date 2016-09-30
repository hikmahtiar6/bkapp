<?php
/**
* Author Imam Teguh
*/
class Trend extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('supermodel');
	}

	function sungai()
	{
		$data['title'] = "Trend Pengujian Sungai";
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_sungai order by tahunuji_sungai desc');
		$data['parameter'] = $this->supermodel->getData('par_sungai_situ');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_sungai');

		$data['bakumutu'] = '';
		

		$this->load->view('ragamdata/sungai/trend', $data);
	}

	function trend_sungai()
	{
		$this->load->helper('sungai');
		$tahun1 = $this->input->post('tahun1');
		$tahun2 = $this->input->post('tahun2');
		$sungai = $this->input->post('sungai');
		$par = $this->input->post('parameter');
		$data['dt'] = $this->supermodel->getData('par_sungai_situ',array('par_sungai_situ_id'=>$par))->row_array();

		$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_sungai where par_sungai_situ_id='.$par.' group by baku_mutu')->row_array();

		$data['bakumutu'] = $bk['baku_mutu'];

		$s = ''; $ss = ''; $thn = '';
		for($i=$tahun1; $i<=$tahun2; $i++){
			$thn .= $i.',';
			$s .= hsungai(array('periode'=>0,'a.lokasiuji_sungai_id'=>$sungai,'par_sungai_situ_id'=>$par,'tahunuji_sungai'=>$i)).',';
			$ss .= hsungai(array('periode'=>1,'a.lokasiuji_sungai_id'=>$sungai,'par_sungai_situ_id'=>$par,'tahunuji_sungai'=>$i)).',';
        }

        $data['periode_satu'] = $s;
        $data['periode_dua'] = $ss;
        $data['thn'] = $thn;

        

		$this->load->view('ragamdata/sungai/trend_c', $data);
	}

	function situ()
	{
		$data['title'] = "Trend Pengujian Situ";
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_situ order by tahunuji_situ desc');
		$data['parameter'] = $this->supermodel->getData('par_sungai_situ');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_situ');

		$data['bakumutu'] = '';
		

		$this->load->view('ragamdata/situ/trend', $data);
	}

	function trend_situ()
	{
		$this->load->helper('situ');
		$tahun1 = $this->input->post('tahun1');
		$tahun2 = $this->input->post('tahun2');
		$sungai = $this->input->post('sungai');
		$par = $this->input->post('parameter');
		$data['dt'] = $this->supermodel->getData('par_sungai_situ',array('par_sungai_situ_id'=>$par))->row_array();

		$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_situ where par_sungai_situ_id='.$par.' group by baku_mutu')->row_array();

		$data['bakumutu'] = $bk['baku_mutu'];

		$s = ''; $ss = ''; $thn = '';
		for($i=$tahun1; $i<=$tahun2; $i++){
			$thn .= $i.',';
			$s .= hsitu(array('periode'=>0,'a.lokasiuji_situ_id'=>$sungai,'par_sungai_situ_id'=>$par,'tahunuji_situ'=>$i)).',';
			$ss .= hsitu(array('periode'=>1,'a.lokasiuji_situ_id'=>$sungai,'par_sungai_situ_id'=>$par,'tahunuji_situ'=>$i)).',';
        }

        $data['periode_satu'] = $s;
        $data['periode_dua'] = $ss;
        $data['thn'] = $thn;

        

		$this->load->view('ragamdata/situ/trend_c', $data);
	}

	function sumur()
	{
		$data['title'] = "Trend Pengujian Sumur";
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_sumur order by tahunuji_sumur desc');
		$data['parameter'] = $this->supermodel->getData('par_sumur');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_sumur');

		$data['bakumutu'] = '';
		

		$this->load->view('ragamdata/sumur/trend', $data);
	}

	function trend_sumur()
	{
		$this->load->helper('sumur');
		$tahun1 = $this->input->post('tahun1');
		$tahun2 = $this->input->post('tahun2');
		$sungai = $this->input->post('sungai');
		$par = $this->input->post('parameter');
		$data['dt'] = $this->supermodel->getData('par_sumur',array('par_sumur_id'=>$par))->row_array();

		$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_sumur where par_sumur_id='.$par.' group by baku_mutu')->row_array();

		$data['bakumutu'] = $bk['baku_mutu'];

		$s = ''; $ss = ''; $thn = '';
		for($i=$tahun1; $i<=$tahun2; $i++){
			$thn .= $i.',';
			$s .= hsumur(array('a.lokasiuji_sumur_id'=>$sungai,'par_sumur_id'=>$par,'tahunuji_sumur'=>$i)).',';
        }

        $data['periode_satu'] = $s;
        $data['thn'] = $thn;

        

		$this->load->view('ragamdata/sumur/trend_c', $data);
	}

	function ambien()
	{
		$data['title'] = "Trend Pengujian Ambien";
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_ambien order by tahunuji_ambien desc');
		$data['parameter'] = $this->supermodel->getData('par_ambien');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_ambien');

		$data['bakumutu'] = '';
		

		$this->load->view('ragamdata/ambien/trend', $data);
	}

	function trend_ambien()
	{
		$this->load->helper('ambien');
		$tahun1 = $this->input->post('tahun1');
		$tahun2 = $this->input->post('tahun2');
		$sungai = $this->input->post('sungai');
		$par = $this->input->post('parameter');
		$data['dt'] = $this->supermodel->getData('par_ambien',array('par_ambien_id'=>$par))->row_array();

		$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_ambien where par_ambien_id='.$par.' group by baku_mutu')->row_array();

		$data['bakumutu'] = $bk['baku_mutu'];

		$s = ''; $ss = ''; $thn = '';
		for($i=$tahun1; $i<=$tahun2; $i++){
			$thn .= $i.',';
			$s .= hambien(array('a.lokasiuji_ambien_id'=>$sungai,'par_ambien_id'=>$par,'tahunuji_ambien'=>$i)).',';
        }

        $data['periode_satu'] = $s;
        $data['thn'] = $thn;

        

		$this->load->view('ragamdata/ambien/trend_c', $data);
	}

	function cerobong()
	{
		$data['title'] = "Trend Pengujian Cerobong";
		$data['tahun'] = $this->supermodel->queryManual('select * from tahunuji_cerobong order by tahunuji_cerobong desc');
		$data['parameter'] = $this->supermodel->getData('par_cerobong');
		$data['lokasi'] = $this->supermodel->getData('lokasiuji_cerobong');

		$data['bakumutu'] = '';
		

		$this->load->view('ragamdata/cerobong/trend', $data);
	}

	function trend_cerobong()
	{
		$this->load->helper('cerobong');
		$tahun1 = $this->input->post('tahun1');
		$tahun2 = $this->input->post('tahun2');
		$sungai = $this->input->post('sungai');
		$par = $this->input->post('parameter');
		$data['dt'] = $this->supermodel->getData('par_cerobong',array('par_cerobong_id'=>$par))->row_array();

		$bk = $this->supermodel->queryManual('select baku_mutu from hasiluji_cerobong where par_cerobong_id='.$par.' group by baku_mutu')->row_array();

		$data['bakumutu'] = $bk['baku_mutu'];

		$s = ''; $ss = ''; $thn = '';
		for($i=$tahun1; $i<=$tahun2; $i++){
			$thn .= $i.',';
			$s .= hcerobong(array('a.lokasiuji_cerobong_id'=>$sungai,'par_cerobong_id'=>$par,'tahunuji_cerobong'=>$i)).',';
        }

        $data['periode_satu'] = $s;
        $data['thn'] = $thn;

        

		$this->load->view('ragamdata/cerobong/trend_c', $data);
	}
}
?>