<?php
function hasil_uji_ambien($field=array())
{
	$ci =& get_instance();
	$ci->db->select('*');
		$ci->db->from('hasiluji_ambien a');
		$ci->db->join('par_ambien b', 'a.par_ambien_id=b.par_ambien_id');
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
function hambien($field=NULL)
{
	$ci =& get_instance();

	$ci->db->select('hasil_uji');
		$ci->db->from('hasiluji_ambien a');
		$ci->db->join('lokasiuji_ambien b', 'a.lokasiuji_ambien_id=b.lokasiuji_ambien_id');
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