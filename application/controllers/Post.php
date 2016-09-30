<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Author Imam Teguh
* Date Juni 2015
* Namefile post.php
*/
class Post extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('supermodel');
		$this->load->model('m_global');
	}

	function category()
	{
		$tipe = $this->uri->segment(3);
		$data['title'] = "Posting";
		$data['konten'] = "admin/post/posting";

		$link = 'post/category/'.$tipe.'/';
		$limit= 10;
		$uri_segment= 4;
		$offset= $this->uri->segment($uri_segment);
		$jum = $this->m_global->getPost(array('type'=>$tipe));
		$data['listview'] = $this->m_global->getPost(array('type'=>$tipe),$limit,$offset);
		$this->supermodel->paging($link,$jum,$limit,$uri_segment);
		$data['offset'] = $offset;
		$data['sts'] = array('Draft','Publist');

		$data['type'] = array('Static','Dinamis','Media');
		$data['tp'] = $tipe;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function simpan()
	{
		$tipe = $this->input->get('tipe');
		$name = '';
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('category', 'category', 'required');
		$this->form_validation->set_rules('body', 'body', 'required');
		if($this->form_validation->run()===TRUE) {
			$tipe = $this->input->post('tipe');
			$in['title'] = $this->input->post('title');
			$in['body'] = $this->input->post('body');
			$in['category_id'] = $this->input->post('category');
			$in['user_id'] = $this->session->userdata('userid');
			$in['post_date'] = date('Y-m-d H:i:s');
			$in['status'] = $this->input->post('status');
			$in['date_publish'] = $this->input->post('date_publish').' '.date('H:i:s');
			if($_FILES['image']['name']) {
				$ext = end(explode(".", $_FILES['image']['name']));
				$rand = rand(000,999);
				$name = date("Ymd").$rand.'.'.$ext;
				if ($tipe==2)
				{
					$ext = end(explode(".", $_FILES['image']['name']));
					$simbol = array('-','+',' ','&','/','.',',');
					$rand = str_replace($simbol, "_", $in['title']);
					$name = $rand.'.'.$ext;
					
					$unggah = $this->supermodel->unggah_dokumen('post/media/','image',$name);
				}
				else
				{
					$unggah = $this->supermodel->unggah_gambar('post/','image',$name);
				}
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('post/simpan?tipe='.$tipe);
				}
				$in['image'] = $name;
			}
			$this->supermodel->insertData('post',$in);
			$this->session->set_flashdata('success', 'Penyimpanan data sukses');
			$this->m_global->activities('Menyimpan content '.$in['title']);
			redirect('post/simpan?tipe='.$tipe);
		}
		$data['title'] = "Tambah Posting";
		$data['konten'] = 'admin/post/tambah';
		$data['listview'] = $this->supermodel->getData('category',array('type'=>$tipe));
		$data['type'] = array('Static','Dinamis','Media');
		$data['tp'] = $tipe;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}

	function update()
	{
		$tipe = $this->input->get('tipe');
		$id = $this->input->get('id');
		$name = '';
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('category', 'category', 'required');
		$this->form_validation->set_rules('body', 'body', 'required');
		if($this->form_validation->run()===TRUE) {
			$id = $this->input->post('id');
			$tipe = $this->input->post('tipe');
			$in['title'] = $this->input->post('title');
			$in['body'] = $this->input->post('body');
			$in['category_id'] = $this->input->post('category');
			$in['user_id'] = $this->session->userdata('userid');
			$in['post_date'] = date('Y-m-d H:i:s');
			$in['status'] = $this->input->post('status');
			$in['date_publish'] = $this->input->post('date_publish').' '.date('H:i:s');
			if($_FILES['image']['name']) {
				$cek = $this->supermodel->getData('post',array('post_id'=>$id))->row();
				if($cek->image!='') {
					@unlink('./uploads/post/'.$cek->image);
				}
				$ext = end(explode(".", $_FILES['image']['name']));
				$rand = rand(000,999);
				$name = date("Ymd").$rand.'.'.$ext;
				
				if ($tipe==2)
				{
					$ext = end(explode(".", $_FILES['image']['name']));
					$simbol = array('-','+',' ','&','/','.',',');
					$rand = str_replace($simbol, "_", $in['title']);
					$name = $rand.'.'.$ext;
					
					$unggah = $this->supermodel->unggah_dokumen('post/media/','image',$name);
				}
				else
				{
					$unggah = $this->supermodel->unggah_gambar('post/','image',$name);
				}
				if($unggah===false) {
					$this->session->set_flashdata('error', 'Upload gagal!!');
					redirect('post/update?tipe='.$tipe.'&id='.$id);
				}
				$in['image'] = $name;
			}
			$this->supermodel->updateData('post',$in,'post_id',$id);
			$this->session->set_flashdata('success', 'Pengupdatan data sukses');
			$this->m_global->activities('Mengupdate content '.$in['title']);
			redirect('post/update?tipe='.$tipe.'&id='.$id);
		}
		$data['title'] = "Edit Posting";
		$data['konten'] = 'admin/post/edit';
		$data['row'] = $this->m_global->getPost(array('post_id'=>$id))->row_array();
		$data['listview'] = $this->supermodel->getData('category',array('type'=>$tipe));
		$data['type'] = array('Static','Dinamis','Media');
		$data['tp'] = $tipe;
		$data['id'] = $id;
		$this->load->vars($data);
		$this->load->view('admin/template');
	}
}

/* End of file post.php */
/* Location: ./application/controllers/post.php */