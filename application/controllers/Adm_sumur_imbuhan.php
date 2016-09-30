<?php
/**
* Author Tri Wanda
*/
class Adm_sumur_imbuhan extends CI_Controller
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
		$data['title'] = "Data Upaya konservasi Sumur Imbuhan";
		$data['konten'] = 'admin/konservasi/sumur_imbuhan/index';
		$link = 'adm_sumur_imbuhan/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('sumur_imbuhan');
		$data['tgl1'] = '';
		$data['tgl2'] = '';
		$data['listview'] = $this->supermodel->getData('sumur_imbuhan',$field='', $order='tahun_pengamatan', $dasc='DESC', $limit, $offset);
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
			$in['tahun_pengamatan'] = $this->input->post('tahun_pengamatan');
			$in['alamat'] = $this->input->post('alamat');
			$in['marker-color'] = "#32CD32";
			$in['marker-size'] = "medium";
			$in['marker-symbol'] = "waste-basket";
			$in['description'] = $this->input->post('keterangan');
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['icon_map'] = "icon-sumur_imbuhan.png";
			if($_FILES['foto']['name']) {
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "sumur_imbuhan-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/konservasi/sumur_imbuhan/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_sumur_imbuhan/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->insertData('sumur_imbuhan',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan data konservasi Sumur Imbuhan '.$in['sumur_imbuhan_id']);
			redirect('adm_sumur_imbuhan/tambah');
		}
		$data['icon'] = $this->supermodel->getData('icon');
		$data['title'] = "Tambah Data konservasi Sumur Imbuhan";
		$data['konten'] = 'admin/konservasi/sumur_imbuhan/tambah';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
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
				$in['marker-color'] = "#32CD32";
			$in['marker-size'] = "medium";
			$in['marker-symbol'] = "waste-basket";
			$in['description'] = $this->input->post('keterangan');
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			//$in['kecamatan'] = $keca['kecamatan_nama'];
			//$in['kelurahan'] = $kelu['kelurahan_nama'];
			$in['lat'] = $this->input->post('lat');
			$in['lng'] = $this->input->post('lng');
			$in['kelurahan_id'] = $this->input->post('kelurahan');
			$in['icon_map'] = "icon-sumur_imbuhan.png";
			if($_FILES['foto']['name']) {
				$cek = $this->supermodel->getData('sumur_imbuhan',array('sumur_imbuhan_id'=>$id))->row();
				if($cek->foto!='') {
					@unlink('./uploads/ragamdata/konservasi/sumur_imbuhan/'.$cek->foto);
					@unlink('./uploads/ragamdata/konservasi/sumur_imbuhan/thumb/'.$cek->foto);
				}
				$ext = end(explode(".", $_FILES['foto']['name']));
				$rand = rand(000,999);
				$name = "sumur_imbuhan-".$rand.'.'.$ext;
				$unggah = $this->supermodel->unggah_gambar('ragamdata/konservasi/sumur_imbuhan/','foto',$name,true);
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('adm_sumur_imbuhan/tambah');
				}
				$in['foto'] = $name;
			}
			$this->supermodel->updateData('sumur_imbuhan',$in,'sumur_imbuhan_id',$id);
			$this->session->set_flashdata('success', 'Perubahan data sukses');
			$this->m_global->activities('Menyimpan data konservasi Sumur Imbuhan'.$in['sumur_imbuhan_id']);
			redirect('adm_sumur_imbuhan/edit/'.$id);
		}
		$data['title'] = "Edit Data Konservasi Sumur Imbuhan";
		$data['icon'] = $this->supermodel->getData('icon');
		$data['konten'] = 'admin/konservasi/sumur_imbuhan/edit';
		$data['kecamatan'] = $this->supermodel->getData('kecamatan');
		$data['item'] = $this->supermodel->getData('sumur_imbuhan',array('sumur_imbuhan_id'=>$id))->row_array();
		$data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function cetak()
	{
		$data['filename'] = 'Sumur_Imbuhan';
		$tgl1 = $this->input->get('tgl1');
		$tgl2 = $this->input->get('tgl2');
		if($tgl1=='')
	    {
	      $data['listview'] = $this->supermodel->getData('sumur_imbuhan',$field='','tahun_pengamatan','asc');
	    }
	    else
	    {
	      $data['listview'] = $this->db->query("select * from sumur_imbuhan where tahun_pengamatan between '$tgl1' and '$tgl2'");
	    }
		
		$this->load->view('cetak/cetak_sumur_imbuhan', $data);
	}

	function cari()
	{
		$data['title'] = "Data Upaya konservasi Sumur Imbuhan";
		$data['konten'] = 'admin/konservasi/sumur_imbuhan/index';
		$link = 'adm_sumur_imbuhan/index/';
		$limit= 10;
		$uri_segment= 3;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->supermodel->getData('mata_air');
		$tgl1 = $this->input->post('tahun_pengujian1');
		$tgl2 = $this->input->post('tahun_pengujian2');
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['listview'] = $this->db->query("select * from sumur_imbuhan where tahun_pengamatan between '$tgl1' and '$tgl2'");
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}
?>