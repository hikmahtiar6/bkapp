<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Author Imam Teguh
* Date 28 Mei 2015
* namefile global.php type Model
*/
class M_global extends CI_Model
{
	
	function getPost($where=null,$limit='', $offset='')
	{
		$this->db->select('*');
		$this->db->from('post p');
		$this->db->join('category c','p.category_id=c.category_id');
		$this->db->join('user u','p.user_id=u.user_id');

		if($where!=null) {
			$this->db->where($where);
		}

		$this->db->order_by('p.date_publish','desc');
		if(!empty($limit)):
			$this->db->limit($limit,$offset);
		endif;

		$get = $this->db->get();
		
		return $get;

	}

	function getPostAll($where=null,$order='p.post_date',$by='desc',$limit='', $offset='')
	{
		$this->db->select('*');
		$this->db->from('post p');
		$this->db->join('category c','p.category_id=c.category_id');
		$this->db->join('user u','p.user_id=u.user_id');

		if($where!=null) {
			$this->db->where($where);
		}

		$this->db->order_by($order,$by);
		if(!empty($limit)):
			$this->db->limit($limit,$offset);
		endif;

		$get = $this->db->get();
		
		return $get;

	}	

	function getAct($where=null,$limit='', $offset='')
	{
		$this->db->select('*');
		$this->db->from('logactivity p');
		$this->db->join('user u','p.user_id=u.user_id');

		if($where!=null) {
			$this->db->where($where);
		}

		$this->db->order_by('p.time','desc');
		if(!empty($limit)):
			$this->db->limit($limit,$offset);
		endif;

		$get = $this->db->get();
		
		return $get;
	}
	

	function activities($activity)
	{
		$in['user_id'] = $this->session->userdata('userid');
		$in['activity'] = $activity;
		$in['time'] = date('Y-m-d H:i:s');
		$this->supermodel->insertData('logactivity',$in);
		return TRUE;
	}

	function get_konfig()
	{
		$this->db->where('webconfig_id','1');
		$get = $this->db->get('webconfig');
		foreach ($get->result_array() as $key => $value) {
			$key = $value;
		}
		return $key;
	}

	function getHasilUjiSungai($field=null)
	{
		$this->db->select('*');
		$this->db->from('hasiluji_sungai a');
		$this->db->join('par_sungai_situ b', 'a.par_sungai_situ_id=b.par_sungai_situ_id');
		if($field!=null)
			$this->db->where($field);
		$this->db->order_by('b.parameter','asc');
		$get = $this->db->get();
		return $get;
	}

	function getHasilUjiSitu($field=null)
	{
		$this->db->select('*');
		$this->db->from('hasiluji_situ a');
		$this->db->join('par_sungai_situ b', 'a.par_sungai_situ_id=b.par_sungai_situ_id');
		if($field!=null)
			$this->db->where($field);
		$this->db->order_by('b.parameter','asc');
		$get = $this->db->get();
		return $get;
	}

	function getHasilUjisumur($field=null)
	{
		$this->db->select('*');
		$this->db->from('hasiluji_sumur a');
		$this->db->join('par_sumur b', 'a.par_sumur_id=b.par_sumur_id');
		if($field!=null)
			$this->db->where($field);
		$this->db->order_by('b.parameter','asc');
		$get = $this->db->get();
		return $get;
	}

	function getHasilUjitanah($field=null)
	{
		$this->db->select('*');
		$this->db->from('hasiluji_tanah a');
		$this->db->join('par_tanah b', 'a.par_tanah_id=b.par_tanah_id');
		if($field!=null)
			$this->db->where($field);
		$this->db->order_by('b.parameter','asc');
		$get = $this->db->get();
		return $get;
	}

	function getHasilUjilimbahcair($field=null)
	{
		$this->db->select('*');
		$this->db->from('hasiluji_limbah_cair a');
		$this->db->join('par_limbah_cair b', 'a.par_limbah_cair_id=b.par_limbah_cair_id');
		if($field!=null)
			$this->db->where($field);
		$this->db->order_by('b.parameter','asc');
		$get = $this->db->get();
		return $get;
	}

	function getHasilUjiambien($field=null)
	{
		$this->db->select('*');
		$this->db->from('hasiluji_ambien a');
		$this->db->join('par_ambien b', 'a.par_ambien_id=b.par_ambien_id');
		if($field!=null)
			$this->db->where($field);
		$this->db->order_by('b.parameter','asc');
		$get = $this->db->get();
		return $get;
	}
	
	function getHasilUjicerobong($field=null)
	{
		$this->db->select('*');
		$this->db->from('hasiluji_cerobong a');
		$this->db->join('par_cerobong b', 'a.par_cerobong_id=b.par_cerobong_id');
		if($field!=null)
			$this->db->where($field);
		$this->db->order_by('b.parameter','asc');
		$get = $this->db->get();
		return $get;
	}

	function getHasilUjikendaraan($field=null)
	{
		$this->db->select('*');
		$this->db->from('hasiluji_kendaraan a');
		$this->db->join('par_kendaraan b', 'a.par_kendaraan_id=b.par_kendaraan_id');
		if($field!=null)
			$this->db->where($field);
		$this->db->order_by('b.parameter','asc');
		$get = $this->db->get();
		return $get;
	}


}

?>