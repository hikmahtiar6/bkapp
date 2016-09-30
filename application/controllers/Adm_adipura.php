<?php
/**
* Author Tri Wanda
*/
class Adm_adipura extends CI_Controller
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
    $data['title'] = "Data Titik Pantau Adipura";
    $data['konten'] = 'admin/kemitraan/adipura/index';
    $link = 'Adm_adipura/index/';
    $limit= 10;
    $uri_segment= 3;
    $offset= $this->uri->segment($uri_segment);
    $jum = $this->supermodel->getData('adipura');
    $data['listview'] = $this->supermodel->getData('adipura',$field='', $order='tahun_pengamatan', $dasc='DESC', $limit, $offset);
    $this->supermodel->paging($link,$jum,$limit,$uri_segment);
    $data['offset'] = $offset;
    $this->load->vars($data);
    $this->load->view('admin/template');
  }

  function tambah()
  {
    $this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
    $this->form_validation->set_rules('tahun_pengamatan','Tahun Pengamatan','required');
    $this->form_validation->set_rules('alamat','Alamat','required');
    if($this->form_validation->run()===TRUE) {
      $in['komponen'] = ucfirst($this->input->post('komponen'));
      $in['tahun_pengamatan'] = $this->input->post('tahun_pengamatan');
      $in['nama_lokasi'] = $this->input->post('nama_lokasi');
      $in['alamat'] = $this->input->post('alamat');
      $in['marker-color'] = $this->input->post('marker-color');
			$in['marker-symbol'] = $this->input->post('icon');
			$in['marker-size'] = $this->input->post('marker-size');
			$in['description'] = $this->input->post('keterangan');
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			$in['kecamatan'] = $keca['kecamatan_nama'];
			$in['kelurahan'] = $kelu['kelurahan_nama'];
      $in['lat'] = $this->input->post('lat');
      $in['lng'] = $this->input->post('lng');
      $in['kelurahan_id'] = $this->input->post('kelurahan');
      $in['icon_map'] = "icon-adipura.png";
      if($_FILES['foto']['name']) {
        $ext = end(explode(".", $_FILES['foto']['name']));
        $rand = rand(000,999);
        $name = "adipura-".$rand.'.'.$ext;
        $unggah = $this->supermodel->unggah_gambar('ragamdata/kemitraan/adipura/','foto',$name,true);
        if($unggah===false) {
          $this->session->set_flashdata('error', 'Upload gagal!!');
          redirect('Adm_adipura/tambah');
        }
        $in['foto'] = $name;
      }
      $this->supermodel->insertData('adipura',$in);
      $this->session->set_flashdata('success', 'Penyimpanan data sukses');
      $this->m_global->activities('Menyimpan data Titik Pantau Adipura '.$in['adipura_id']);
      redirect('Adm_adipura/tambah');
    }
    $data['title'] = "Tambah Data Titik Pantau Adipura";
    $data['konten'] = 'admin/kemitraan/adipura/tambah';
	$data['icon'] = $this->supermodel->getData('icon');
    $data['kecamatan'] = $this->supermodel->getData('kecamatan');
    $this->load->vars($data);
    $this->load->view('admin/template');
  }

  function edit($id=null)
  {
    $this->form_validation->set_rules('nama_lokasi','Nama Lokasi','required');
    $this->form_validation->set_rules('tahun_pengamatan','Tahun Pengamatan','required');
    $this->form_validation->set_rules('alamat','Alamat','required');
    if($this->form_validation->run()===TRUE) {
      $id = $this->input->post('id');
      $in['komponen'] = ucfirst($this->input->post('komponen'));
      $in['tahun_pengamatan'] = $this->input->post('tahun_pengamatan');
      $in['nama_lokasi'] = $this->input->post('nama_lokasi');
      $in['alamat'] = $this->input->post('alamat');
      $in['marker-color'] = $this->input->post('marker-color');
			$in['marker-symbol'] = $this->input->post('icon');
			$in['marker-size'] = $this->input->post('marker-size');
			$in['description'] = $this->input->post('keterangan');
			$kecamatan = $this->supermodel->getData('kecamatan',array('kecamatan_id'=>$this->input->post('kecamatan')));
			$kelurahan = $this->supermodel->getData('kelurahan',array('kelurahan_id'=>$this->input->post('kelurahan')));	
			
			$keca = $kecamatan->row_array();
			$kelu = $kelurahan->row_array();

			$in['kecamatan'] = $keca['kecamatan_nama'];
			$in['kelurahan'] = $kelu['kelurahan_nama'];
      $in['lat'] = $this->input->post('lat');
      $in['lng'] = $this->input->post('lng');
      $in['kelurahan_id'] = $this->input->post('kelurahan');
      $in['icon_map'] = "icon-adipura.png";
      if($_FILES['foto']['name']) {
        $cek = $this->supermodel->getData('adipura',array('adipura_id'=>$id))->row();
        if($cek->foto!='') {
          @unlink('./uploads/ragamdata/kemitraan/adipura/'.$cek->foto);
          @unlink('./uploads/ragamdata/kemitraan/adipura/thumb/'.$cek->foto);
        }
        $ext = end(explode(".", $_FILES['foto']['name']));
        $rand = rand(000,999);
        $name = "adipura-".$rand.'.'.$ext;
        $unggah = $this->supermodel->unggah_gambar('ragamdata/kemitraan/adipura/','foto',$name,true);
        if($unggah===false) {
          $this->session->set_flashdata('error', 'Upload gagal!!');
          redirect('Adm_adipura/tambah');
        }
        $in['foto'] = $name;
      }
      $this->supermodel->updateData('adipura',$in,'adipura_id',$id);
      $this->session->set_flashdata('success', 'Perubahan data sukses');
      $this->m_global->activities('Menyimpan data Titik Pantau Adipura'.$in['adipura_id']);
      redirect('Adm_adipura/edit/'.$id);
    }
    $data['title'] = "Edit Data Titik Pantau Adipura";
    $data['konten'] = 'admin/kemitraan/adipura/edit';
	$data['icon'] = $this->supermodel->getData('icon');
    $data['kecamatan'] = $this->supermodel->getData('kecamatan');
    $data['item'] = $this->supermodel->getData('adipura',array('adipura_id'=>$id))->row_array();
    $data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
    $this->load->vars($data);
    $this->load->view('admin/template');
  }
}
?>