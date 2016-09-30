<?php
function hasil_uji_cerobong($field=array())
{
	$ci =& get_instance();
	$ci->db->select('*');
		$ci->db->from('hasiluji_cerobong a');
		$ci->db->join('par_cerobong b', 'a.par_cerobong_id=b.par_cerobong_id');
		if($field!=null)
			$ci->db->where($field);
		$ci->db->order_by('b.parameter','asc');
		$get = $ci->db->get();
		
	$v = $get->row();
	$hasil = 0;
	if(count($v)>0) {
		$hasil = $v->hasil_uji;
	}
	return $hasil;
}
function hcerobong($field=NULL)
{
	$ci =& get_instance();

	$ci->db->select('hasil_uji');
		$ci->db->from('hasiluji_cerobong a');
		$ci->db->join('lokasiuji_cerobong b', 'a.lokasiuji_cerobong_id=b.lokasiuji_cerobong_id');
		if($field!=null) {
			$ci->db->where($field);
		}
		$get = $ci->db->get();
		
	$v = $get->row();
	$hasil = 0;
	if(count($v)>0) {
		$hasil = $v->hasil_uji;
	}
	return $hasil;

}
?>