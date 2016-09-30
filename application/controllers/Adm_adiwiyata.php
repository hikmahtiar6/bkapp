<?php
/**
* Author Tri Wanda
*/
class Adm_adiwiyata extends CI_Controller
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
    $data['title'] = "Data Sekolah Adiwiyata";
    $data['konten'] = 'admin/kemitraan/adiwiyata/index';
    $link = 'adm_adiwiyata/index/';
    $limit= 10;
    $uri_segment= 3;
    $offset= $this->uri->segment($uri_segment);
    $jum = $this->supermodel->getData('sekolah');
    $data['tgl1'] = '';
    $data['tgl2'] = '';
    $data['listview'] = $this->supermodel->getData('sekolah',$field='', $order='sekolah_id', $dasc='DESC', $limit, $offset);
    $this->supermodel->paging($link,$jum,$limit,$uri_segment);
    $data['offset'] = $offset;
    $this->load->vars($data);
    $this->load->view('admin/template');
  }

  function tambah()
  {
    $this->form_validation->set_rules('nama_sekolah','Nama Sekolah','required');
    $this->form_validation->set_rules('alamat','Alamat','required');
    if($this->form_validation->run()===TRUE) {
      $in['nama_sekolah'] = $this->input->post('nama_sekolah');
      $in['tahun_penghargaan'] = $this->input->post('tahun_penghargaan');
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
      $in['nama_penghargaan'] = $this->input->post('nama_penghargaan');
      $in['icon_map'] = "icon-adiwiyata.png";
      if($_FILES['foto']['name']) {
        $ext = end(explode(".", $_FILES['foto']['name']));
        $rand = rand(000,999);
        $name = "adiwiyata-".$rand.'.'.$ext;
        $unggah = $this->supermodel->unggah_gambar('ragamdata/kemitraan/adiwiyata/','foto',$name,true);
        if($unggah===false) {
          $this->session->set_flashdata('error', 'Upload gagal!!');
          redirect('adm_adiwiyata/tambah');
        }
        $in['foto'] = $name;
      }
      $this->supermodel->insertData('sekolah',$in);
      $this->session->set_flashdata('success', 'Penyimpanan data sukses');
      $this->m_global->activities('Menyimpan data Sekolah Adiwiyata '.$in['sekolah_id']);
      redirect('adm_adiwiyata/tambah');
    }
    $data['title'] = "Tambah Data Sekolah Adiwiyata";
    $data['konten'] = 'admin/kemitraan/adiwiyata/tambah';
	$data['icon'] = $this->supermodel->getData('icon');
    $data['kecamatan'] = $this->supermodel->getData('kecamatan');
    $this->load->vars($data);
    $this->load->view('admin/template');
  }

  function edit($id=null)
  {
    $this->form_validation->set_rules('nama_sekolah','Nama Sekolah','required');
    $this->form_validation->set_rules('alamat','Alamat','required');
    if($this->form_validation->run()===TRUE) {
      $id = $this->input->post('id');
      $in['nama_sekolah'] = $this->input->post('nama_sekolah');
      $in['tahun_penghargaan'] = $this->input->post('tahun_penghargaan');
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
      $in['nama_penghargaan'] = $this->input->post('nama_penghargaan');
      $in['icon_map'] = "icon-adiwiyata.png";
      if($_FILES['foto']['name']) {
        $cek = $this->supermodel->getData('sekolah',array('sekolah_id'=>$id))->row();
        if($cek->foto!='') {
          @unlink('./uploads/ragamdata/kemitraan/adiwiyata/'.$cek->foto);
          @unlink('./uploads/ragamdata/kemitraan/adiwiyata/thumb/'.$cek->foto);
        }
        $ext = end(explode(".", $_FILES['foto']['name']));
        $rand = rand(000,999);
        $name = "adiwiyata-".$rand.'.'.$ext;
        $unggah = $this->supermodel->unggah_gambar('ragamdata/kemitraan/adiwiyata/','foto',$name,true);
        if($unggah===false) {
          $this->session->set_flashdata('error', 'Upload gagal!!');
          redirect('Adm_adiwiyata/tambah');
        }
        $in['foto'] = $name;
      }
      $this->supermodel->updateData('sekolah',$in,'sekolah_id',$id);
      $this->session->set_flashdata('success', 'Perubahan data sukses');
      $this->m_global->activities('Menyimpan data Sekolah Adiwiyata'.$in['sekolah_id']);
      redirect('Adm_adiwiyata/edit/'.$id);
    }
    $data['title'] = "Edit Data Sekolah Adiwiyata";
    $data['konten'] = 'admin/kemitraan/adiwiyata/edit';
    $data['kecamatan'] = $this->supermodel->getData('kecamatan');
	$data['icon'] = $this->supermodel->getData('icon');
    $data['item'] = $this->supermodel->getData('sekolah',array('sekolah_id'=>$id))->row_array();
    $data['kelurahan'] = $this->supermodel->getData('kelurahan', array('kelurahan_id'=>$data['item']['kelurahan_id']))->row_array();
    $this->load->vars($data);
    $this->load->view('admin/template');
  }

  function cetak()
  {
    $np1 = 'Adiwiyata Tingkat Mandiri';
    $np2 = 'Adiwiyata Tingkat Nasional';
    $np3 = 'Adiwiyata Tingkat Kota/Provinsi';
    $data['filename'] = 'Sekolah_Adiwiyata';
    $data['judul1'] = 'Penghargaan Sekolah Adiwiyata Mandiri Kota Bogor';
    $data['judul2'] = 'Penghargaan Sekolah Adiwiyata Propinsi Kota Bogor';
    $data['judul3'] = 'Penghargaan Sekolah Adiwiyata Nasional Kota Bogor';
    $tgl1 = $this->input->get('tgl1');
    $tgl2 = $this->input->get('tgl2');
    if($tgl1=='')
    {
      $data['listview1'] = $this->supermodel->getData('sekolah',array('nama_penghargaan'=>$np1),'tahun_penghargaan','asc');
      $data['listview2'] = $this->supermodel->getData('sekolah',array('nama_penghargaan'=>$np2),'tahun_penghargaan','asc');
      $data['listview3'] = $this->supermodel->getData('sekolah',array('nama_penghargaan'=>$np3),'tahun_penghargaan','asc');
    }
    else
    {
      $data['listview1'] = $this->db->query("select * from sekolah where nama_penghargaan = '$np1' and tahun_penghargaan between '$tgl1' and '$tgl2'");
      $data['listview2'] = $this->db->query("select * from sekolah where nama_penghargaan = '$np2' and tahun_penghargaan between '$tgl1' and '$tgl2'");
      $data['listview3'] = $this->db->query("select * from sekolah where nama_penghargaan = '$np3' and tahun_penghargaan between '$tgl1' and '$tgl2'");
    }
    $this->load->view('cetak/cetak_adiwiyata', $data);
  }

  function cari()
  {
    $data['title'] = "Data Sekolah Adiwiyata";
    $data['konten'] = 'admin/kemitraan/adiwiyata/index';
    $link = 'Adm_adiwiyata/index/';
    $limit= 10;
    $uri_segment= 3;
    $offset= $this->uri->segment($uri_segment);
    $jum = $this->supermodel->getData('sekolah');
    $tgl1 = $this->input->post('tahun_pengujian1');
    $tgl2 = $this->input->post('tahun_pengujian2');
    $data['tgl1'] = $tgl1;
    $data['tgl2'] = $tgl2;
    $data['listview'] = $this->db->query("select * from sekolah where tahun_penghargaan between '$tgl1' and '$tgl2'");
    $this->supermodel->paging($link,$jum,$limit,$uri_segment);
    $data['offset'] = $offset;
    $this->load->vars($data);
    $this->load->view('admin/template');
  }
}
?>