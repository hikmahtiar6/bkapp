<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* Author Imam Teguh
* File supermodel.php
* Date Februari 2015
*/
class Supermodel extends CI_Model {

	function queryManual($sql)
	{
		$get = $this->db->query($sql);
		return $get;
	}
	
	function getData($table, $field='', $order='', $dasc='DESC', $limit='', $offset='') {
		$this->db->select('*');
		
		$this->db->from($table);

		if(!empty($field)) {
			$this->db->where($field);
		}
		
		if(empty($order)):
			$this->db->order_by($table.'_id', $dasc);
		else:
			$this->db->order_by($order, $dasc);
		endif;
		
		if(!empty($limit)):
			$this->db->limit($limit,$offset);
		endif;
		
		$get = $this->db->get();
		
		return $get;
	}
	function get_pengujian_sungai() {     
    $query = $this->db->get('pengujian_sungai');
	//$get = $this->db->query('addressbook');
		//return $get;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	
    function insert_csv($data) {
        $this->db->insert('pengujian_sungai', $data);
    }
	function insertData($table, $data) {
		$this->db->insert($table, $data);
		return TRUE;
	}
	
	function updateData($table,$array,$where, $field) {
		$this->db->where($where,$field);
		$db = $this->db->update($table, $array);
		return $db;
	}
	
	function deleteData($table, $where, $field) {
		$this->db->where($where,$field);
		$db = $this->db->delete($table);
		return $db;		
	}

	function thumb_gambar($path=null,$name)
	{
		$con['image_library'] = 'gd2';
		$con['source_image'] = './uploads/'.$path.''.$name;
		$con['new_image'] = './uploads/'.$path.'thumb/';
		$con['create_thumb'] = TRUE;
		$con['thumb_marker'] = '';
		$con['maintain_ratio'] = TRUE;
		$con['width'] = 75;
		$con['height'] = 50;

		$this->load->library('image_lib', $con);

		$this->image_lib->resize();
		return true;
	}

	function unggah_gambar($path=null,$name=null,$rename=null,$thumb=false)
	{
		$config['upload_path'] = './uploads/'.$path;
		$config['allowed_types'] = 'jpg|jpeg|gif|png|pdf';
		$config['max_size'] = '2200';
		if($rename!=null) {
			$config['file_name'] = $rename;
		}
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload($name)) {
			return false;
		} else {
			if($thumb===true) {
				$this->thumb_gambar($path,$rename);
			}
			return true;
		}
	}

	function unggah_dokumen($path=null,$name=null,$rename=null)
	{
		ini_set('memory_limit','96M');
		ini_set('post_max_size','64M');
		ini_set('upload_max_filesize', '64M');
		$config['upload_path'] = './uploads/'.$path;
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = '640000';

		if($rename!=null) {
			$config['file_name'] = $rename;
		}
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload($name)) {
			return false;
		} else {
			return true;
		}
	}
	
	function paging($link,$jum,$limit,$uri_segment)
	{
		$config_page['base_url']= site_url($link);
		$config_page['total_rows']= $jum->num_rows();
		$config_page['per_page']= $limit;
		$config_page['uri_segment']= $uri_segment;
		$config_page['full_tag_open'] = '<ul class="pagination right">';
		$config_page['full_tag_close'] = '</ul>';
		$config_page['first_link'] = '&laquo; First';
		$config_page['first_tag_open'] = '<li>';
		$config_page['first_tag_close'] = '</li>';
		
		$config_page['last_link'] = 'Last &raquo;';
		$config_page['last_tag_open'] = '<li>';
		$config_page['last_tag_close'] = '</li>';
		
		$config_page['next_link'] = 'Next';
		$config_page['next_tag_open'] = '<li>';
		$config_page['next_tag_close'] = '</li>';
		
		$config_page['prev_link'] = 'Prev';
		$config_page['prev_tag_open'] = '<li>';
		$config_page['prev_tag_close'] = '</li>';
		
		$config_page['cur_tag_open'] = '<li class="active"><a href="">';
		$config_page['cur_tag_close'] = '</a></li>';
		
		$config_page['num_tag_open'] = '<li>';
		$config_page['num_tag_close'] = '</li>';
		$this->pagination->initialize($config_page);
	}
	
	
}

?>