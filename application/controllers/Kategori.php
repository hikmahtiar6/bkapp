<?php
/**
* Author Imam Teguh
* Juni 2015
* Kategori.php
*/
class Kategori extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}

	function kode($id=null)
	{
		if($id!=null) {
			$konfig = $this->m_global->get_konfig();
			$data['category'] = $this->supermodel->getData('category',array('category_id'=>$id))->row_array();
			$data['banner'] = $this->supermodel->getData('banner',array('status'=>1));
			$data['unduh'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>2),'p.post_id','desc',6);
			$data['galeri'] = $this->supermodel->getData('galeri',$field='', $order='', $dasc='DESC', $limit='8');

			if($data['category']['type']==0) {
				$data['konten'] = 'page-detail';
				$datacek = $this->m_global->getPost(array('p.status'=>1,'p.category_id'=>$id));
				if($datacek->num_rows()>0) {
					$data['content'] = $datacek->row_array();
				}
				else {
					redirect('welcome/not_found');
				}
				$data['populer'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>1),'p.view','desc',4);
			} elseif ($data['category']['type']==1) {
				$data['konten'] = 'page-list';
				$data['populer'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>1,'p.category_id'=>$id),'p.view','desc',4);
			} else {
				$data['konten'] = 'page-media';
				$datacek = $this->m_global->getPost(array('p.status'=>1,'p.category_id'=>$id));
				if($datacek->num_rows()>0) {
					$data['content'] = $datacek->row_array();
				}
				else {
					redirect('welcome/not_found');
				}
				$data['listpost'] = $this->m_global->getPost(array('p.status'=>1,'p.category_id'=>$id));
			}

			$link = 'kategori/kode/'.$id.'/';
			$limit= 8;
			$uri_segment= 4;
			$offset= $this->uri->segment($uri_segment);
			$jum = $this->m_global->getPost(array('status'=>1,'p.category_id'=>$id));

			$data['all'] = $this->m_global->getPost(array('status'=>1,'p.category_id'=>$id),$limit,$offset);
			$this->supermodel->paging($link,$jum,$limit,$uri_segment);

			$vrs = array_merge($konfig,$data);
			$this->load->vars($vrs);
			$this->load->view('template');
		} else {
			redirect('welcome');
		}
	}

	function addview()
	{
		$id = $this->input->get('id');
		if($id!="") {
			$get = $this->supermodel->getData('post',array('post_id'=>$id))->row();
			$in['view'] = $get->view + 1;
			$this->supermodel->updateData('post',$in,'post_id',$id);
			redirect('kategori/page?id='.$id.'&title='.md5($get->title));
		} else {
			redirect('welcome');
		}
	}

	function page()
	{
		$id = $this->input->get('id');
		if($id!="") {
			$konfig = $this->m_global->get_konfig();
			$data['content'] = $this->m_global->getPost(array('status'=>1,'p.post_id'=>$id))->row_array();
			$data['category'] = $this->supermodel->getData('category',array('category_id'=>$data['content']['category_id']))->row_array();
			if($data['category']['type']==2) {
				$data['konten'] = 'page-media';
				$data['listpost'] = $this->m_global->getPost(array('p.status'=>1,'p.category_id'=>$data['category']['category_id']));
			} else {
				$data['konten'] = 'page-detail';
				$data['populer'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>1,'p.post_id !='=>$id),'p.view','desc',4);
				$data['berita_terkait'] = $this->m_global->getPost(array('status'=>1,'p.category_id'=>$data['content']['category_id']),5,0);
			}
			$data['banner'] = $this->supermodel->getData('banner',array('status'=>1));
			$data['unduh'] = $this->m_global->getPostAll(array('p.status'=>1,'c.type'=>2),'p.date_publish','desc',6);
			$data['galeri'] = $this->supermodel->getData('galeri',$field='', $order='', $dasc='DESC', $limit='8');
			$vrs = array_merge($konfig,$data);
			$this->load->vars($vrs);
			
			$this->load->view('template');
			
		} else {
			redirect('welcome');
		}
	}
}

/* End of file kategori.php */
/* Location: ./application/controllers/kategori.php */