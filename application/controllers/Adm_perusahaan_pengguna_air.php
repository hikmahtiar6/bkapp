<?php
/**
* Author Tri Wanda
* Edit By Rizki Maulana
*/
class Adm_perusahaan_pengguna_air extends CI_Controller
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
		$data['title'] = "Data Upaya konservasi Perusahaan Pengguna Air Tanah";
		$data['konten'] = 'admin/konservasi/perusahaan_pengguna_air/index';
		$link = 'adm_perusahaan_pengguna_air/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('pemanfaatan_air');
		$data['tgl1'] = '';
		$data['tgl2'] = '';
		$data['listview'] = $this->supermodel->getData('pemanfaatan_air',$field='', $order='tahun_pengawasan', $dasc='DESC', $limit, $offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function tambah()
	{
		$this->form_validation->set_rules('tahun_pengawasan','Tahun Pengawasan','required');
		$this->form_validation->set_rules('nama_kepemilikan','Nama Kepemilikan','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		if($this->form_validation->run()===TRUE) {
			$in['nama_pemilik'] = $this->input->post('nama_kepemilikan');
			$in['tahun_pengawasan'] = $this->input->post('tahun_pengawasan');
			$in['alamat'] = $this->input->post('alamat');
			$in['no_izin'] = $this->input->post('no_izin');
			$in['debit_air'] = $this->input->post('debit_air');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
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
			$in['icon_map'] = "icon-perusahaan_pengguna_air.png";
			$this->supermodel->insertData('pemanfaatan_air',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data konservasi Perusahaan Pengguna Air Tanah '.$in['pemanfaatan_air_id']);
			redirect('adm_perusahaan_pengguna_air/tambah');
		}
		$data['title'] = "Tambah Data konservasi Perusahaan Pengguna Air Tanah";
		$data['konten'] = 'admin/konservasi/perusahaan_pengguna_air/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function edit($id=null)
	{
		$this->form_validation->set_rules('tahun_pengawasan','Tahun Pengawasan','required');
		$this->form_validation->set_rules('nama_kepemilikan','Nama Kepemilikan','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$in['nama_pemilik'] = $this->input->post('nama_kepemilikan');
			$in['tahun_pengawasan'] = $this->input->post('tahun_pengawasan');
			$in['alamat'] = $this->input->post('alamat');
			$in['no_izin'] = $this->input->post('no_izin');
			$in['debit_air'] = $this->input->post('debit_air');
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['marker-color'] = $this->input->post('marker-color');
			$in['marker-size'] = $this->input->post('marker-size');
			$in['description'] = $this->input->post('keterangan');
			$in['marker-symbol'] = $this->input->post('icon');
			//$in['kelurahan_nama'] = $this->input->post('kelurahan_nama');
			//$in['kecamatan_nama'] = $this->input->post('kecamatan_nama');	
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['icon_map'] = "icon-perusahaan_pengguna_air.png";
			$this->supermodel->updateData('pemanfaatan_air',$in,'pemanfaatan_air_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data konservasi Perusahaan Pengguna Air Tanah '.$in['pemanfaatan_air_id']);
			redirect('adm_perusahaan_pengguna_air/edit/'.$id);
		}
		$data['title'] = "Edit Data Konservasi Perusahaan Pengguna Air Tanah";
		$data['konten'] = 'admin/konservasi/perusahaan_pengguna_air/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['icon'] = $this->supermodel->getData('icon');
		$data['item'] = $this->supermodel->getData('pemanfaatan_air',array('pemanfaatan_air_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cetak($id=NULL)
	{
		$data['filename'] = 'Perusahaan_pengguna_air_tanah-';
		$tgl1 = $this->input->get('tgl1');
		$tgl2 = $this->input->get('tgl2');
		if($tgl1=='')
		{
			//$data['listview'] = $this->db->query("select * from mata_air");
			$data['listview'] = $this->supermodel->getData('pemanfaatan_air',$field='','tahun_pengawasan','asc');
		}
		else
		{
			$data['listview'] = $this->db->query("select * from pemanfaatan_air where tahun_pengawasan between '$tgl1' and '$tgl2'");
		}
		
		$this->load->view('cetak/cetak_perusahaan_pengguna_air_tanah', $data);
	}

	function cari()
	{
		$data['title'] = "Data Upaya konservasi Perusahaan Pengguna Air Tanah";
		$data['konten'] = 'admin/konservasi/perusahaan_pengguna_air/index';
		$link = 'adm_perusahaan_pengguna_air/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('pemanfaatan_air');
		$tgl1 = $this->input->post('tahun_pengujian1');
		$tgl2 = $this->input->post('tahun_pengujian2');
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['listview'] = $this->db->query("select * from pemanfaatan_air where tahun_pengawasan between '$tgl1' and '$tgl2'");
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>