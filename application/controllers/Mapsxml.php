<?php
/**
* Author Imam Teguh
*/
class Mapsxml extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}


	// MATA AIR KONSERVASI
	function mata_air()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlMataAir?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/mata_air', $data);
	}

	function xmlMataAir()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('mata_air');
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('mata_air',array('kelurahan_id'=>$kel));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('mata_air',array('YEAR(tahun_pengamatan)'=>$tahun));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('mata_air',array('kelurahan_id'=>$kel,'YEAR(tahun_pengamatan)'=>$tahun));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'mata_air_id="' . $row['mata_air_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'mata_air_id="' . $row['mata_air_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// SUMUR PANTAU KONSERVASI
	function sumur_pantau()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlSumurPantau?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/sumur_pantau', $data);
	}

	function xmlSumurPantau()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('sumur_pantau');
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('sumur_pantau',array('kelurahan_id'=>$kel));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('sumur_pantau',array('YEAR(tahun_pengamatan)'=>$tahun));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('sumur_pantau',array('kelurahan_id'=>$kel,'YEAR(tahun_pengamatan)'=>$tahun));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['sumur_pantau_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['sumur_pantau_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// SUMUR IMBUHAN KONSERVASI
	function sumur_imbuhan()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlSumurImbuhan?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/sumur_imbuhan', $data);
	}

	function xmlSumurImbuhan()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('sumur_imbuhan');
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('sumur_imbuhan',array('kelurahan_id'=>$kel));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('sumur_imbuhan',array('YEAR(tahun_pengamatan)'=>$tahun));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('sumur_imbuhan',array('kelurahan_id'=>$kel,'YEAR(tahun_pengamatan)'=>$tahun));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['sumur_imbuhan_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['sumur_imbuhan_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// SUMUR RESAPAN KONSERVASI
	function sumur_resapan()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlSumurResapan?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/sumur_resapan', $data);
	}

	function xmlSumurResapan()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('sumur_resapan');
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('sumur_resapan',array('kelurahan_id'=>$kel));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('sumur_resapan',array('YEAR(tahun_pengamatan)'=>$tahun));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('sumur_resapan',array('kelurahan_id'=>$kel,'YEAR(tahun_pengamatan)'=>$tahun));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['sumur_resapan_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['sumur_resapan_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// Perusahaan pengguna air tanah
	function perusahaan_pengguna_air_tanah()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlPerusahaan_pengguna_air_tanah?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/perusahaan_pengguna_air_tanah', $data);
	}

	function xmlPerusahaan_pengguna_air_tanah()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('pemanfaatan_air');
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('pemanfaatan_air',array('kelurahan_id'=>$kel));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('pemanfaatan_air',array('YEAR(tahun_pengawasan)'=>$tahun));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('pemanfaatan_air',array('kelurahan_id'=>$kel,'YEAR(tahun_pengawasan)'=>$tahun));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['pemanfaatan_air_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['pemanfaatan_air_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// SEHATI KONSERVASI
	function sehati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlSehati?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/sehati', $data);
	}

	function xmlSehati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$kategori = "Sehati";
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('skp',array('kategori'=>$kategori));
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('skp',array('kelurahan_id'=>$kel,'kategori'=>$kategori));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('skp',array('YEAR(tahun_pendataan)'=>$tahun,'kategori'=>$kategori));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('skp',array('kelurahan_id'=>$kel,'YEAR(tahun_pendataan)'=>$tahun,'kategori'=>$kategori));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['skp_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['skp_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// KEHATI KONSERVASI
	function kehati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlKehati?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/kehati', $data);
	}

	function xmlKehati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$kategori = "Kehati";
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('skp',array('kategori'=>$kategori));
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('skp',array('kelurahan_id'=>$kel,'kategori'=>$kategori));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('skp',array('YEAR(tahun_pendataan)'=>$tahun,'kategori'=>$kategori));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('skp',array('kelurahan_id'=>$kel,'YEAR(tahun_pendataan)'=>$tahun,'kategori'=>$kategori));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['skp_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['skp_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// PEMERHATI KONSERVASI
	function pemerhati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlPemerhati?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/pemerhati', $data);
	}

	function xmlPemerhati()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$kategori = "Pemerhati";
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('skp',array('kategori'=>$kategori));
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('skp',array('kelurahan_id'=>$kel,'kategori'=>$kategori));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('skp',array('YEAR(tahun_pendataan)'=>$tahun,'kategori'=>$kategori));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('skp',array('kelurahan_id'=>$kel,'YEAR(tahun_pendataan)'=>$tahun,'kategori'=>$kategori));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['skp_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['skp_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// PEMBANGUNAN BIOGAS
	function pembangunan_biogas()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlPembangunan_biogas?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/pembangunan_biogas', $data);
	}

	function xmlPembangunan_biogas()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('biogas');
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('biogas',array('kelurahan_id'=>$kel));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('biogas',array('YEAR(tahun_pembuatan)'=>$tahun));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('biogas',array('kelurahan_id'=>$kel,'YEAR(tahun_pembuatan)'=>$tahun));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['biogas_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['biogas_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// TITIK PANTAU ADIPURA
	function adipura()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlAdipura?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/adipura', $data);
	}

	function xmlAdipura()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('adipura');
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('adipura',array('kelurahan_id'=>$kel));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('adipura',array('YEAR(tahun_pengamatan)'=>$tahun));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('adipura',array('kelurahan_id'=>$kel,'YEAR(tahun_pengamatan)'=>$tahun));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['adipura_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['adipura_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// SEKOLAH ADIWIYATA
	function sekolah_adiwiyata()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlSekolah_adiwiyata?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/sekolah_adiwiyata', $data);
	}

	function xmlSekolah_adiwiyata()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('sekolah');
		if($kel!='') {
			$list = $this->supermodel->getData('sekolah',array('kelurahan_id'=>$kel));
		} else {
			$list = $this->supermodel->getData('sekolah');
		} 
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['sekolah_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['sekolah_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// HUTAN KOTA
	function hutan_kota()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlHutan_kota?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/hutan_kota', $data);
	}

	function xmlHutan_kota()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('hutan_kota');
		if($kel!='' && $tahun=='') {
			$list = $this->supermodel->getData('hutan_kota',array('kelurahan_id'=>$kel));
		} elseif($tahun!='' && $kel=='') {
			$list = $this->supermodel->getData('hutan_kota',array('YEAR(tahun_pendataan)'=>$tahun));
		} elseif ($tahun!='' && $kel!='') {
			$list = $this->supermodel->getData('hutan_kota',array('kelurahan_id'=>$kel,'YEAR(tahun_pendataan)'=>$tahun));
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['hutan_kota_id'] . '" ';
					echo 'coords="' . $row['area'] . '" ';
					echo 'warna="' . $row['warna'] . '" ';
				
					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['hutan_kota_id'] . '" ';
					echo 'coords="' . $row['area'] . '" ';
					echo 'warna="' . $row['warna'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// Sungai
	function sungai()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlSungai?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/sungai', $data);
	}

	function xmlSungai()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		// $list = $this->supermodel->queryManual('
		// 	SELECT l.nama_lokasi, l.lokasi_uji, l.kelurahan_id, l.lat, l.lng, l.icon_map, s.nama_sungai, l.lokasiuji_sungai_id
		// 	FROM lokasiuji_sungai l, sungai s WHERE l.sungai_id=s.sungai_id
		// 	');
		$list = $this->supermodel->queryManual('
			SELECT lat, lng, icon_map, lokasiuji_sungai_id, kelurahan_id
			FROM lokasiuji_sungai 
			');
		if($kel!='') {
			$list = $this->supermodel->queryManual('
			SELECT lat, lng, icon_map, lokasiuji_sungai_id, kelurahan_id
			FROM lokasiuji_sungai WHERE kelurahan_id = "'.$kel.'"
			');
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_sungai_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';
					echo '/>';
					}
				}
				else {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_sungai_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';
					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// Situ
	function situ()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlSitu?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/situ', $data);
	}

	function xmlSitu()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		// $list = $this->supermodel->queryManual('
		// 	SELECT l.nama_lokasi, l.lokasi_uji, l.kelurahan_id, l.lat, l.lng, l.icon_map, s.nama_situ, l.lokasiuji_situ_id
		// 	FROM lokasiuji_situ l, situ s WHERE l.situ_id=s.situ_id
		// 	');
		$list = $this->supermodel->queryManual('
			SELECT lat, lng, icon_map, lokasiuji_situ_id, kelurahan_id
			FROM lokasiuji_situ
			');
		if($kel!='') {
			$list = $this->supermodel->queryManual('
			SELECT lat, lng, icon_map, lokasiuji_situ_id, kelurahan_id
			FROM lokasiuji_situ WHERE kelurahan_id = "'.$kel.'"
			');
		}
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_situ_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';
					echo '/>';
					}
				}
				else {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_situ_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';
					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// Sumur
	function sumur()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlSumur?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/sumur', $data);
	}

	function xmlSumur()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('lokasiuji_sumur');
		if($kel!='') {
			$list = $this->supermodel->getData('lokasiuji_sumur',array('kelurahan_id'=>$kel));
		} else {
			$list = $this->supermodel->getData('lokasiuji_sumur');
		} 
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_sumur_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_sumur_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// Tanah
	function tanah()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlTanah?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/tanah', $data);
	}

	function xmlTanah()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('lokasiuji_tanah');
		if($kel!='') {
			$list = $this->supermodel->getData('lokasiuji_tanah',array('kelurahan_id'=>$kel));
		} else {
			$list = $this->supermodel->getData('lokasiuji_tanah');
		} 
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_tanah_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_tanah_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}
	
	// Emisi Cerobong
	function cerobong()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlCerobong?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/cerobong', $data);
	}

	function xmlCerobong()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('lokasiuji_cerobong');
		if($kel!='') {
			$list = $this->supermodel->getData('lokasiuji_cerobong',array('kelurahan_id'=>$kel));
		} else {
			$list = $this->supermodel->getData('lokasiuji_cerobong');
		} 
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_cerobong_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_cerobong_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// Emisi Ambien
	function ambien()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlAmbien?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/ambien', $data);
	}

	function xmlAmbien()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('lokasiuji_ambien');
		if($kel!='') {
			$list = $this->supermodel->getData('lokasiuji_ambien',array('kelurahan_id'=>$kel));
		} else {
			$list = $this->supermodel->getData('lokasiuji_ambien');
		} 
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_ambien_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_ambien_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// Emisi Pengawasan B3
	function pengawasan_b3()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlB3?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/pengawasan_b3', $data);
	}

	function xmlB3()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('izin_btiga');
		if($kel!='') {
			$list = $this->supermodel->getData('izin_btiga',array('kelurahan_id'=>$kel));
		} else {
			$list = $this->supermodel->getData('izin_btiga');
		} 
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['izin_btiga_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['izin_btiga_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}

	// Emisi Pengawasan B3
	function limbah_cair()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		$data['linked'] = 'xmlLimbahCair?kec='.$kec.'&kel='.$kel.'&tahun='.$tahun;
		$this->load->view('gis/frame/limbah_cair', $data);
	}

	function xmlLimbahCair()
	{
		$kec = $this->input->get('kec');
		$kel = $this->input->get('kel');
		$tahun = $this->input->get('tahun');
		header("Content-type: text/xml");
 
		// Parent node XML
		echo '<markers>';
		$list = $this->supermodel->getData('lokasiuji_limbah_cair');
		if($kel!='') {
			$list = $this->supermodel->getData('lokasiuji_limbah_cair',array('kelurahan_id'=>$kel));
		} else {
			$list = $this->supermodel->getData('lokasiuji_limbah_cair');
		} 
		if($list->num_rows()>0) {
			foreach ($list->result_array() as $row) {
				// Menambahkan ke node dokumen XML
				if($kec!=null) {
					if($kec==getIdKecamatan($row['kelurahan_id'])) {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_limbah_cair_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
					}
				} else {
					echo '<marker ';
					echo 'id="' . $row['lokasiuji_limbah_cair_id'] . '" ';
					echo 'icon_map="' . $row['icon_map'] . '" ';
					echo 'lat="' . $row['lat'] . '" ';
					echo 'lng="' . $row['lng'] . '" ';

					echo '/>';
				}
						
			}
		}
		echo '</markers>';
	}
}
?>