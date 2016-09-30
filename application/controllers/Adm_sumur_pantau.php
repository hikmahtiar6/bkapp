<?php
/**
* Author Tri Wanda
* Edit By Rizki Maulana
*/
class Adm_sumur_pantau extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
		if($this->session->userdata('getLoginAct')==FALSE) {
			$this->session->set_flashdata('error', 'Tidak ada akses untuk ini!!!');
			redirect('loginweb');
		}
	}

	function index()
	{
		$data['title'] = "Data Upaya konservasi Sumur Pantau";
		$data['konten'] = 'admin/konservasi/sumur_pantau/index';
		$link = 'adm_sumur_pantau/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('sumur_pantau');
		$data['tgl1'] = '';
		$data['tgl2'] = '';
		$data['listview'] = $this->supermodel->getData('sumur_pantau',$field='', $order='tahun_pengamatan', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		$this->form_validation->set_rules('tahun_pengamatan','Tahun Pengamatan','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		if($this->form_validation->run()===TRUE) {
			//$in['nama_kepemilikan'] = $this->input->post('nama_kepemilikan');
			$in['tahun_pengamatan'] = $this->input->post('tahun_pengamatan');
			$in['alamat'] = $this->input->post('alamat');
			$in['marker-color'] = $this->input->post('marker-color');
			$in['marker-symbol'] = $this->input->post('icon');
			$in['marker-size'] = $this->input->post('marker-size');
			$in['description'] = $this->input->post('keterangan');
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['tinggi_air'] = $this->input->post('tinggi_air');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['icon_map'] = "icon-sumur_pantau.png";
			if($_FILES['foto']['name']) {
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "sumur_pantau-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/konservasi/sumur_pantau/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('Adm_biogas/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->insertData('sumur_pantau',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data konservasi sumur pantau '.$in['sumur_pantau_id']);
			redirect('adm_sumur_pantau/tambah');
		}
		$data['title'] = "Tambah Data konservasi sumur pantau";
		$data['konten'] = 'admin/konservasi/sumur_pantau/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('tahun_pengamatan','Tahun Pengamatan','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['tahun_pengamatan'] = $this->input->post('tahun_pengamatan');
			$in['alamat'] = $this->input->post('alamat');
			$in['marker-color'] = $this->input->post('marker-color');
			$in['marker-symbol'] = $this->input->post('icon');
			$in['marker-size'] = $this->input->post('marker-size');
			$in['description'] = $this->input->post('keterangan');
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['tinggi_air'] = $this->input->post('tinggi_air');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['icon_map'] = "icon-sumur_pantau.png";
			if($_FILES['foto']['name']) {
				$cek = $this->supermodel->getData('sumur_pantau',array('sumur_pantau_id'=>$id))->row();
				if($cek->foto!='') {
					@unlink('./uploads/ragamdata/konservasi/sumur_pantau/'.$cek->foto);
					@unlink('./uploads/ragamdata/konservasi/sumur_pantau/thumb/'.$cek->foto);
				}
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "sumur_pantau-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/konservasi/sumur_pantau/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('Adm_sumur_pantau/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->updateData('sumur_pantau',$in,'sumur_pantau_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data konservasi Sumur Pantau '.$in['sumur_pantau_id']);
			redirect('Adm_sumur_pantau/edit/'.$id);
		}
		$data['title'] = "Edit Data Konservasi Sumur Pantau";
		$data['icon'] = $this->supermodel->getData('icon');
		$data['konten'] = 'admin/konservasi/sumur_pantau/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['item'] = $this->supermodel->getData('sumur_pantau',array('sumur_pantau_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cetak(){
		$data['filename'] = 'Data Sumur Pantau';
		$tgl1 = $this->input->get('tgl1');
		$tgl2 = $this->input->get('tgl2');
		if($tgl1=='')
		{
			$data['listview'] = $this->supermodel->getData('sumur_pantau',$field='','tahun_pengamatan','asc');
		}
		else
		{
			$data['listview'] = $this->db->query("select * from sumur_pantau where tahun_pengamatan between '$tgl1' and '$tgl2'");
		}
		$this->load->view('cetak/cetak_sumur_pantau', $data);
	}
	function cari()
	{
		$data['title'] = "Data Upaya konservasi Sumur Pantau";
		$data['konten'] = 'admin/konservasi/sumur_pantau/index';
		$link = 'adm_sumur_pantau/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('sumur_pantau');
		$tgl1 = $this->input->post('tahun_pengujian1');
		$tgl2 = $this->input->post('tahun_pengujian2');
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['listview'] = $this->db->query("select * from sumur_pantau where tahun_pengamatan between '$tgl1' and '$tgl2'");
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>