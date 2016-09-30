<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Author Imam Teguh
* Build Mei 2015
* Namefile trash.php
*/
class Trash extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('supermodel');
		$this->load->model('m_global');
		if($this->session->userdata('getLoginAct')==FALSE) {
			$this->session->set_flashdata('error', 'Tidak ada akses untuk ini!!!');
			redirect('loginweb');
		}
	}

	function proses()
	{
		$tabel = $this->input->get('tabel');
		$primary = $this->input->get('primary');
		$url = $this->input->get('url');
		$image = $this->input->get('img');
		if($image!=null) {
			@unlink($image);
		}
		$del = $this->supermodel->deleteData($tabel,$tabel.'_id',$primary);
		if($del) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus data dari tabel '.$tabel.' dengan id '.$primary);
			redirect($url);
		} else {
			$this->session->set_flashdata('success','Hapus data gagal');
			redirect($url);
		}
	}

	function hapuslog()
	{
		$hapus = $this->db->truncate('logactivity');
		if($hapus) {
			$this->session->set_flashdata('success','Hapus data berhasil');
			$this->m_global->activities('Menghapus data log aktivitas');
			redirect('adminweb');
		}
	}

}

/* End of file trash.php */
/* Location: ./application/controllers/trash.php */