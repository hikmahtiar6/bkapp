<?php
/**
* Author Imam teguh
*/
class Ragam_data extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}

	function index()
	{
		$konfig = $this->m_global->get_konfig();
		
		$vrs = array_merge($konfig);
		$this->load->vars($vrs);
		$this->load->view('ragamdata/template');
	}

	// Start Data sungai
	function sungai()
	{
		$data['title'] = "Data Pengujian Air Sungai";
		$data['tahunuji'] = $this->supermodel->queryManual('select * from hasiluji_sungai group by tahunuji_sungai desc');
		$data['sungai'] = $this->supermodel->getData('sungai');
		$this->load->view('ragamdata/sungai/sungai', $data);
	}

	function lokasi_sungai()
	{
		$id = $this->input->get('sungai');
		$lokasi = $this->supermodel->getData('lokasiuji_sungai',array('sungai_id'=>$id));
		echo "<option value=''>- Pilih Lokasi-</option>";
		foreach ($lokasi->result() as $row) {
			echo "<option value='".$row->lokasiuji_sungai_id."'>".$row->nama_lokasi."</option>";
		}
	}

	function report_sungai()
	{
		$thn = $this->input->post('tahunuji');
		$lks = $this->input->post('lokasi');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjiSungai(array('periode'=>0,'tahunuji_sungai'=>$thn,'lokasiuji_sungai_id'=>$lks));
		$data['hasiluji_per2'] = $this->m_global->getHasilUjiSungai(array('periode'=>1,'tahunuji_sungai'=>$thn,'lokasiuji_sungai_id'=>$lks));
		$this->load->view('ragamdata/sungai/report', $data);
	}

	function export_sungai()
	{
		$thn = $this->input->get('thn');
		$lks = $this->input->get('lks');
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=export-data-sungai-".$thn."-".$lks.".xls");
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjiSungai(array('periode'=>0,'tahunuji_sungai'=>$thn,'lokasiuji_sungai_id'=>$lks));
		$data['hasiluji_per2'] = $this->m_global->getHasilUjiSungai(array('periode'=>1,'tahunuji_sungai'=>$thn,'lokasiuji_sungai_id'=>$lks));
		$this->load->view('ragamdata/sungai/report', $data);
	}
	// End Data sungai

	// Start Data situ
	function situ()
	{
		$data['title'] = "Data Pengujian Air Situ";
		$data['tahunuji'] = $this->supermodel->queryManual('select * from hasiluji_situ group by tahunuji_situ desc');
		$data['situ'] = $this->supermodel->getData('situ');
		$this->load->view('ragamdata/situ/situ', $data);
	}

	function lokasi_situ()
	{
		$id = $this->input->get('situ');
		$lokasi = $this->supermodel->getData('lokasiuji_situ',array('situ_id'=>$id));
		echo "<option value=''>- Pilih Lokasi-</option>";
		foreach ($lokasi->result() as $row) {
			echo "<option value='".$row->lokasiuji_situ_id."'>".$row->nama_lokasi."</option>";
		}
	}

	function report_situ()
	{
		$thn = $this->input->post('tahunuji');
		$lks = $this->input->post('lokasi');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjiSitu(array('periode'=>0,'tahunuji_situ'=>$thn,'lokasiuji_situ_id'=>$lks));
		$data['hasiluji_per2'] = $this->m_global->getHasilUjiSitu(array('periode'=>1,'tahunuji_situ'=>$thn,'lokasiuji_situ_id'=>$lks));
		$this->load->view('ragamdata/situ/report', $data);
	}

	function export_situ()
	{
		$thn = $this->input->get('thn');
		$lks = $this->input->post('lks');
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=export-data-situ-".$thn."-".$lks.".xls");
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjiSitu(array('periode'=>0,'tahunuji_situ'=>$thn,'lokasiuji_situ_id'=>$lks));
		$data['hasiluji_per2'] = $this->m_global->getHasilUjiSitu(array('periode'=>1,'tahunuji_situ'=>$thn,'lokasiuji_situ_id'=>$lks));
		$this->load->view('ragamdata/situ/report', $data);
	}
	// End Data situ

	// Start Data sumur
	function sumur()
	{
		$data['title'] = "Data Pengujian Air Sumur";
		$data['tahunuji'] = $this->supermodel->queryManual('select * from hasiluji_sumur group by tahunuji_sumur desc');
		//$data['sumur'] = $this->supermodel->getData('lokasiuji_sumur');
		$this->load->view('ragamdata/sumur/sumur', $data);
	}

	function pilih_tahun_sumur()
	{
		$thn = $this->input->post('tahunuji');
		$sumur =  $this->supermodel->queryManual('select a.lokasiuji_sumur_id, b.nama_lokasi 
			from hasiluji_sumur a, lokasiuji_sumur b where a.lokasiuji_sumur_id=b.lokasiuji_sumur_id and a.tahunuji_sumur='.$thn.'
			group by a.lokasiuji_sumur_id order by b.nama_lokasi');
		if($sumur->num_rows()>0) {
          foreach ($sumur->result() as $rows) {
            ?>
            <option value="<?php echo $rows->lokasiuji_sumur_id ?>"><?php echo $rows->nama_lokasi ?></option>
            <?php
          }
        }
	}

	function report_sumur()
	{
		$thn = $this->input->post('tahunuji');
		$lks = $this->input->post('lokasi');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjiSumur(array('tahunuji_sumur'=>$thn,'lokasiuji_sumur_id'=>$lks));
		$this->load->view('ragamdata/sumur/report', $data);
	}

	function export_sumur()
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=export-data-sumur.xls");
		$thn = $this->input->get('thn');
		$lks = $this->input->get('lks');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjiSumur(array('tahunuji_sumur'=>$thn,'lokasiuji_sumur_id'=>$lks));
		$this->load->view('ragamdata/sumur/report', $data);
	}
	// End Data sumur


	// Start Data tanah
	function tanah()
	{
		$data['title'] = "Data Pengujian Tanah";
		$data['tahunuji'] = $this->supermodel->queryManual('select * from hasiluji_tanah group by tahunuji_tanah desc');
		$this->load->view('ragamdata/tanah/index', $data);
	}

	function pilih_tahun_tanah()
	{
		$thn = $this->input->post('tahunuji');
		$sumur =  $this->supermodel->queryManual('select a.lokasiuji_tanah_id, b.nama_lokasi 
			from hasiluji_tanah a, lokasiuji_tanah b where a.lokasiuji_tanah_id=b.lokasiuji_tanah_id and a.tahunuji_tanah='.$thn.'
			group by a.lokasiuji_tanah_id order by b.nama_lokasi');
		if($sumur->num_rows()>0) {
          foreach ($sumur->result() as $rows) {
            ?>
            <option value="<?php echo $rows->lokasiuji_tanah_id ?>"><?php echo $rows->nama_lokasi ?></option>
            <?php
          }
        }
	}

	function report_tanah()
	{
		$thn = $this->input->post('tahunuji');
		$lks = $this->input->post('lokasi');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjitanah(array('tahunuji_tanah'=>$thn,'lokasiuji_tanah_id'=>$lks));
		$this->load->view('ragamdata/tanah/report', $data);
	}

	function export_tanah()
	{
		$thn = $this->input->get('thn');
		$lks = $this->input->post('lks');
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=export-data-tanah-".$thn."-".$lks.".xls");
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjitanah(array('tahunuji_tanah'=>$thn,'lokasiuji_tanah_id'=>$lks));
		$this->load->view('ragamdata/tanah/report', $data);
	}
	// End Data kendaraan
	
	// start data emisi kendaraan
	function kendaraan()
	{
		$data['title'] = "Data Emisi kendaraan";
		$data['tahun'] = $this->supermodel->queryManual('select (tahunuji) as thn from emisi_kdr group by (tahunuji) order by (tahunuji) desc');
		$this->load->view('ragamdata/kendaraan/kendaraan', $data);
	}
	
	function report_kendaraan()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, tahunuji as thn from emisi_kdr order by tahunuji desc');
		}
		else {
			$data['listdata'] = $this->supermodel->queryManual('select *, (tahunuji) as thn from emisi_kdr where (tahunuji) = "'.$thn.'" order by (tahunuji) desc');
		}
		$this->load->view('ragamdata/kendaraan/report', $data);
	}
	// End Data kendaraan


	// Start Data mata air
	function mata_air()
	{
		$data['title'] = "Data Mata Air Yang Dilindungi";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pengamatan) as thn from mata_air group by YEAR(tahun_pengamatan) order by YEAR(tahun_pengamatan) desc');
		$this->load->view('ragamdata/mata_air/mata_air', $data);
	}

	function report_mata_air()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *,YEAR(tahun_pengamatan) as thn from mata_air order by YEAR(tahun_pengamatan) desc');
		}
		else {
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from mata_air where YEAR(tahun_pengamatan) = "'.$thn.'" order by YEAR(tahun_pengamatan) desc');
		}
		$this->load->view('ragamdata/mata_air/report', $data);
	}
	// End Data mata air

	// Start Data SPPL
	function sppl()
	{
		$data['title'] = "Data SPPL";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tgl_sppl) as thn from sppl group by YEAR(tgl_sppl) order by YEAR(tgl_sppl) desc');
		$this->load->view('ragamdata/sppl/sppl', $data);
	}

	function report_sppl()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *,YEAR(tgl_sppl) as thn from sppl order by YEAR(tgl_sppl) desc');
		}
		else {
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tgl_sppl) as thn from sppl where YEAR(tgl_sppl) = "'.$thn.'" order by YEAR(tgl_sppl) desc');
		}
		$this->load->view('ragamdata/sppl/report', $data);
	}
	// End Data SPPL

	// Start Data AMDAL
	function amdal()
	{
		$data['title'] = "Data AMDAL";
		$data['tahun'] = $this->supermodel->queryManual('select tahun as thn from amdal group by tahun order by tahun desc');
		$this->load->view('ragamdata/amdal/amdal', $data);
	}

	function report_amdal()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *,(tahun) as thn from amdal order by (tahun) desc');
		}
		else {
			$data['listdata'] = $this->supermodel->queryManual('select *, (tahun) as thn from amdal where (tahun) = "'.$thn.'" order by (tahun) desc');
		}
		$this->load->view('ragamdata/amdal/report', $data);
	}
	// End Data AMDAL

	// Start Data AMDAL
	function ukl_upl()
	{
		$data['title'] = "Data UKL-UPL";
		$data['tahun'] = $this->supermodel->queryManual('select tahun as thn from ukl_upl group by tahun order by tahun desc');
		$this->load->view('ragamdata/ukl-upl/ukl-upl', $data);
	}

	function report_ukl_upl()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *,(tahun) as thn from ukl_upl order by (tahun) desc');
		}
		else {
			$data['listdata'] = $this->supermodel->queryManual('select *, (tahun) as thn from ukl_upl where (tahun) = "'.$thn.'" order by (tahun) desc');
		}
		$this->load->view('ragamdata/ukl-upl/report', $data);
	}
	// End Data AMDAL

	// Start Data sumur pantau
	function sumur_pantau()
	{
		$data['title'] = "Data Sumur Pantau";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pengamatan) as thn from sumur_pantau group by YEAR(tahun_pengamatan) order by YEAR(tahun_pengamatan) desc');
		$this->load->view('ragamdata/sumur_pantau/sumur_pantau', $data);
	}

	function report_sumur_pantau()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null){
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from sumur_pantau order by YEAR(tahun_pengamatan) desc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from sumur_pantau where YEAR(tahun_pengamatan) = "'.$thn.'" order by YEAR(tahun_pengamatan) desc');
		}
		$this->load->view('ragamdata/sumur_pantau/report', $data);
	}
	// End Data mata air


	// Start Data Pemanfaatan air
	function pemanfaatan_air()
	{
		$data['title'] = "Data Perusahaan Pengguna Air Tanah";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pengawasan) as thn from pemanfaatan_air group by YEAR(tahun_pengawasan) order by YEAR(tahun_pengawasan) desc');
		$this->load->view('ragamdata/pemanfaatan_air/index', $data);
	}

	function report_pemanfaatan_air()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengawasan) as thn from pemanfaatan_air order by nama_kepemilikan asc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengawasan) as thn from pemanfaatan_air where YEAR(tahun_pengawasan) = "'.$thn.'" order by nama_kepemilikan asc');
		}
		$this->load->view('ragamdata/pemanfaatan_air/report', $data);
	}
	// End Data mata air

	// Start Data sumur imbuhan
	function sumur_imbuhan()
	{
		$data['title'] = "Data Sumur Imbuhan";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pengamatan) as thn from sumur_imbuhan group by YEAR(tahun_pengamatan) order by YEAR(tahun_pengamatan) desc');
		$this->load->view('ragamdata/sumur_imbuhan/index', $data);
	}

	function report_sumur_imbuhan()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from sumur_imbuhan order by tahun_pengamatan desc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from sumur_imbuhan where YEAR(tahun_pengamatan) = "'.$thn.'" order by tahun_pengamatan desc');
		}
		$this->load->view('ragamdata/sumur_imbuhan/report', $data);
	}
	// End Data sumur imbuhan

	// Start Data sumur imbuhan
	function hutan_kota()
	{
		$data['title'] = "Data Hutan Kota";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pendataan) as thn from hutan_kota group by YEAR(tahun_pendataan) order by YEAR(tahun_pendataan) desc');
		$this->load->view('ragamdata/hutan_kota/index', $data);
	}

	function report_hutan_kota()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pendataan) as thn from hutan_kota order by tahun_pendataan desc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pendataan) as thn from hutan_kota where YEAR(tahun_pendataan) = "'.$thn.'" order by tahun_pendataan desc');
		}
		$this->load->view('ragamdata/hutan_kota/report', $data);
	}
	// End Data hutan kota

	// Start Data sehati
	function sehati()
	{
		$data['title'] = "Data SEHATI";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pendataan) as thn from skp where kategori="Sehati" group by YEAR(tahun_pendataan) order by YEAR(tahun_pendataan) desc');
		$this->load->view('ragamdata/sehati/index', $data);
	}

	function report_sehati()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null){
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pendataan) as thn from skp where kategori="Sehati" order by tahun_pendataan desc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pendataan) as thn from skp where kategori="Sehati" and YEAR(tahun_pendataan) = "'.$thn.'" order by tahun_pendataan desc');
		}
		$this->load->view('ragamdata/sehati/report', $data);
	}
	// End Data sumur imbuhan

	// Start Data kehati
	function kehati()
	{
		$data['title'] = "Data KEHATI";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pendataan) as thn from skp where kategori="Kehati" group by YEAR(tahun_pendataan) order by YEAR(tahun_pendataan) desc');
		$this->load->view('ragamdata/kehati/index', $data);
	}

	function report_kehati()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pendataan) as thn from skp where kategori="Kehati" order by tahun_pendataan desc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pendataan) as thn from skp where kategori="Kehati" and YEAR(tahun_pendataan) = "'.$thn.'" order by tahun_pendataan desc');
		}
		$this->load->view('ragamdata/kehati/report', $data);
	}
	// End Data kehati

	// Start Data pemerhati
	function pemerhati()
	{
		$data['title'] = "Data PEMERHATI";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pendataan) as thn from skp where kategori="Pemerhati" group by YEAR(tahun_pendataan) order by YEAR(tahun_pendataan) desc');
		$this->load->view('ragamdata/pemerhati/index', $data);
	}

	function report_pemerhati()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pendataan) as thn from skp where kategori="Pemerhati" order by tahun_pendataan desc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pendataan) as thn from skp where kategori="Pemerhati" and YEAR(tahun_pendataan) = "'.$thn.'" order by tahun_pendataan desc');
		}
		$this->load->view('ragamdata/pemerhati/report', $data);
	}
	// End Data pemerhati

	// Start Data sumur resapan
	function sumur_resapan()
	{
		$data['title'] = "Data Sumur Resapan";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pengamatan) as thn from sumur_resapan group by YEAR(tahun_pengamatan) order by YEAR(tahun_pengamatan) desc');
		$this->load->view('ragamdata/sumur_resapan/index', $data);
	}

	function report_sumur_resapan()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null){
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from sumur_resapan order by tahun_pengamatan desc');
		}
		else{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from sumur_resapan where YEAR(tahun_pengamatan) = "'.$thn.'" order by tahun_pengamatan desc');
		}
		$this->load->view('ragamdata/sumur_resapan/report', $data);
	}
	// End Data sumur imbuhan

	// Start Data adiwiyata
	function sekolah_adiwiyata()
	{
		$data['title'] = "Data Sekolah Adiwiyata";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_penghargaan) as thn from sekolah group by YEAR(tahun_penghargaan) order by YEAR(tahun_penghargaan) desc');
		$this->load->view('ragamdata/skl_adiwiyata/index', $data);
	}

	function report_adiwiyata()
	{
		$thn = $this->input->post('tahun');
		$ktg = $this->input->post('kategori');
		$data['thn'] = $thn;
		$data['ktg'] = $ktg;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_penghargaan) as thn from sekolah where nama_penghargaan="'.$ktg.'" order by tahun_penghargaan desc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_penghargaan) as thn from sekolah where YEAR(tahun_penghargaan) = "'.$thn.'" and nama_penghargaan="'.$ktg.'" order by tahun_penghargaan desc');
		}
		$this->load->view('ragamdata/skl_adiwiyata/report', $data);
	}
	// End Data adiwiyata

	// Start Data adipura
	function adipura()
	{
		$data['title'] = "Titik Pantau Adipura";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pengamatan) as thn from adipura group by YEAR(tahun_pengamatan) order by YEAR(tahun_pengamatan) desc');
		$data['komponen'] = $this->supermodel->queryManual('select komponen from adipura group by komponen asc');
		$this->load->view('ragamdata/adipura/index', $data);
	}

	function report_adipura()
	{
		$thn = $this->input->post('tahun');
		$kpm = $this->input->post('komponen');
		$data['thn'] = $thn;
		$data['kpm'] = $kpm;
		$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from adipura where YEAR(tahun_pengamatan) = "'.$thn.'" and komponen = "'.$kpm.'" order by tahun_pengamatan desc');
		if($thn==NULL) {
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pengamatan) as thn from adipura order by tahun_pengamatan desc');
		}
		$this->load->view('ragamdata/adipura/report', $data);
	}
	// End Data adipura

	// Start Data biogas
	function biogas()
	{
		$data['title'] = "Data Penggunaan Biogas";
		$data['tahun'] = $this->supermodel->queryManual('select YEAR(tahun_pembuatan) as thn from biogas group by YEAR(tahun_pembuatan) order by YEAR(tahun_pembuatan) desc');
		$this->load->view('ragamdata/biogas/index', $data);
	}

	function report_biogas()
	{
		$thn = $this->input->post('tahun');
		$data['thn'] = $thn;
		if($thn==null)
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pembuatan) as thn from biogas order by tahun_pembuatan desc');
		}
		else
		{
			$data['listdata'] = $this->supermodel->queryManual('select *, YEAR(tahun_pembuatan) as thn from biogas where YEAR(tahun_pembuatan) = "'.$thn.'" order by tahun_pembuatan desc');
		}	
		$this->load->view('ragamdata/biogas/report', $data);
	}
	// End Data biogas
	
	// Start Data Limbah Cair
	function limbah_cair()
	{
		$data['title'] = "Data Pengujian Limbah Cair";
		$data['tahunuji'] = $this->supermodel->queryManual('select * from hasiluji_limbah_cair group by tahunuji_limbah_cair desc');
		$this->load->view('ragamdata/limbah_cair/limbah_cair', $data);
	}

	function pilih_tahun_lc()
	{
		$thn = $this->input->post('tahunuji');
		$sumur =  $this->supermodel->queryManual('select a.lokasiuji_limbah_cair_id, b.nama_lokasi 
			from hasiluji_limbah_cair a, lokasiuji_limbah_cair b where a.lokasiuji_limbah_cair_id=b.lokasiuji_limbah_cair_id and a.tahunuji_limbah_cair='.$thn.'
			group by a.lokasiuji_limbah_cair_id order by b.nama_lokasi');
		if($sumur->num_rows()>0) {
          foreach ($sumur->result() as $rows) {
            ?>
            <option value="<?php echo $rows->lokasiuji_limbah_cair_id ?>"><?php echo $rows->nama_lokasi ?></option>
            <?php
          }
        }
	}

	function report_limbah_cair()
	{
		$thn = $this->input->post('tahunuji');
		$lks = $this->input->post('lokasi');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjilimbahcair(array('tahunuji_limbah_cair'=>$thn,'lokasiuji_limbah_cair_id'=>$lks));
		$this->load->view('ragamdata/limbah_cair/report', $data);
	}

	function export_limbah_cair()
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=export-data-limbah-cair.xls");
		$thn = $this->input->get('thn');
		$lks = $this->input->get('lks');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjilimbahcair(array('tahunuji_limbah_cair'=>$thn,'lokasiuji_limbah_cair_id'=>$lks));
		$this->load->view('ragamdata/limbah_cair/report', $data);
	}
	// End Data Limbah Cair 

	// Start Data Ambien
	function ambien()
	{
		$data['title'] = "Data Pengujian Ambien";
		$data['tahunuji'] = $this->supermodel->queryManual('select * from hasiluji_ambien group by tahunuji_ambien desc');
		$this->load->view('ragamdata/ambien/ambien', $data);
	}

	function pilih_tahun_ambien()
	{
		$thn = $this->input->post('tahunuji');
		$sumur =  $this->supermodel->queryManual('select a.lokasiuji_ambien_id, b.nama_lokasi 
			from hasiluji_ambien a, lokasiuji_ambien b where a.lokasiuji_ambien_id=b.lokasiuji_ambien_id and a.tahunuji_ambien='.$thn.'
			group by a.lokasiuji_ambien_id order by b.nama_lokasi');
		if($sumur->num_rows()>0) {
          foreach ($sumur->result() as $rows) {
            ?>
            <option value="<?php echo $rows->lokasiuji_ambien_id ?>"><?php echo $rows->nama_lokasi ?></option>
            <?php
          }
        }
	}

	function report_ambien()
	{
		$thn = $this->input->post('tahunuji');
		$lks = $this->input->post('lokasi');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjiambien(array('tahunuji_ambien'=>$thn,'lokasiuji_ambien_id'=>$lks));
		$this->load->view('ragamdata/ambien/report', $data);
	}

	function export_ambien()
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=export-data-ambien.xls");
		$thn = $this->input->get('thn');
		$lks = $this->input->get('lks');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjiambien(array('tahunuji_ambien'=>$thn,'lokasiuji_ambien_id'=>$lks));
		$this->load->view('ragamdata/ambien/report', $data);
	}
	// End Data embien

	// Start Data Ambien
	function cerobong()
	{
		$data['title'] = "Data Pengujian Emisi Cerobong";
		$data['tahunuji'] = $this->supermodel->queryManual('select * from hasiluji_cerobong group by tahunuji_cerobong desc');
		$this->load->view('ragamdata/cerobong/cerobong', $data);
	}

	function pilih_tahun_cerobong()
	{
		$thn = $this->input->post('tahunuji');
		$sumur =  $this->supermodel->queryManual('select a.lokasiuji_cerobong_id, b.nama_lokasi 
			from hasiluji_cerobong a, lokasiuji_cerobong b where a.lokasiuji_cerobong_id=b.lokasiuji_cerobong_id and a.tahunuji_cerobong='.$thn.'
			group by a.lokasiuji_cerobong_id order by b.nama_lokasi');
		if($sumur->num_rows()>0) {
          foreach ($sumur->result() as $rows) {
            ?>
            <option value="<?php echo $rows->lokasiuji_cerobong_id ?>"><?php echo $rows->nama_lokasi ?></option>
            <?php
          }
        }
	}

	function report_cerobong()
	{
		$thn = $this->input->post('tahunuji');
		$lks = $this->input->post('lokasi');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjicerobong(array('tahunuji_cerobong'=>$thn,'lokasiuji_cerobong_id'=>$lks));
		$this->load->view('ragamdata/cerobong/report', $data);
	}

	function export_cerobong()
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=export-data-emisi-cerobong.xls");
		$thn = $this->input->get('thn');
		$lks = $this->input->get('lks');
		$data['thn'] = $thn;
		$data['lks'] = $lks;
		$data['hasiluji_per1'] = $this->m_global->getHasilUjicerobong(array('tahunuji_cerobong'=>$thn,'lokasiuji_cerobong_id'=>$lks));
		$this->load->view('ragamdata/cerobong/report', $data);
	}
	// End Data embien

	// Start Data b3
	function pengawasan_b3()
	{
		$data['title'] = "Data Pengawasan B3";
		$data['jenis_kegiatan'] = $this->supermodel->queryManual('select * from izin_btiga group by jenis_kegiatan asc');
		$data['izin'] = $this->supermodel->getData('izin_btiga');
		$this->load->view('ragamdata/pengawasan_b3/pengawasan_b3', $data);
	}

	function report_pengawasan_b3()
	{
		$jenis = $this->input->post('jenis');
		$kel = $this->input->post('kelurahan');
		$data['jenis'] = $jenis;
		$data['kelurahan'] = $kel;
		$data['hasiluji_per1'] = $this->supermodel->queryManual('select * from izin_btiga where jenis_kegiatan = "'.$jenis.'"');
		$this->load->view('ragamdata/pengawasan_b3/report', $data);
	}

	function export_pengawasan_b3()
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=export-pengawasan-b3.xls");
		$jenis = $this->input->post('jenis');
		$kel = $this->input->post('kelurahan');
		$data['jenis'] = $jenis;
		$data['kelurahan'] = $kel;
		$data['hasiluji_per1'] = $this->supermodel->queryManual('select * from izin_btiga where jenis_kegiatan = "'.$jenis.'"');
		$this->load->view('ragamdata/pengawasan_b3/report', $data);
	}
	// End Data embien

	// Start Data Izin LC
	function izin_lc()
	{
		$data['title'] = "Data Izin Limbah Cair";
		$data['jenis_kegiatan'] = $this->supermodel->queryManual('select * from izin_lc group by jenis_kegiatan asc');
		$data['izin'] = $this->supermodel->getData('izin_btiga');
		$this->load->view('ragamdata/izin_lc/index', $data);
	}

	function report_izin_lc()
	{
		$jenis = $this->input->post('jenis');
		$kel = $this->input->post('kelurahan');
		$data['jenis'] = $jenis;
		$data['kelurahan'] = $kel;
		$data['hasiluji_per1'] = $this->supermodel->queryManual('select * from izin_lc where jenis_kegiatan = "'.$jenis.'"');
		$this->load->view('ragamdata/izin_lc/report', $data);
	}
}
?>