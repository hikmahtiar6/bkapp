<?php
function hsitu($field=NULL)
{
	$ci =& get_instance();

	$ci->db->select('hasil_uji');
		$ci->db->from('hasiluji_situ a');
		$ci->db->join('lokasiuji_situ b', 'a.lokasiuji_situ_id=b.lokasiuji_situ_id');
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