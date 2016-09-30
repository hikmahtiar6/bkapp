<?php
function menus()
{
	$mn = '<ul class="nav navbar-nav menu">';
	$ci =& get_instance();
	$get = $ci->db->query("select * from category where parent = 0 order by sort asc");
	foreach ($get->result() as $rows) {
		$cek = $ci->db->query("select * from category where parent = '".$rows->category_id."' order by sort asc ");
		if($cek->num_rows()>0) {
			$mn .= '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$rows->category_name.' <span class="caret"></span></a>';
			$mn .= '<ul class="dropdown-menu">';
			foreach ($cek->result() as $row) {
				$mn .= '<li><a href="'.site_url('kategori/kode/'.$row->category_id).'">'.$row->category_name.'</a></li>';
			}
			$mn .= "</ul>";
			$mn .= "</li>";
		} else {
			$mn .= '<li><a href="'.site_url('kategori/kode/'.$rows->category_id).'">'.$rows->category_name.'</a></li>';
		}
	}
	$mn .= '<li><a href="'.site_url('ragam_data').'">RAGAM DATA</a></li>';
	$mn .= '<li><a href="'.site_url('galeri').'">GALERI</a></li>';
	$mn .= '<li><a href="'.site_url('gis').'">WEB GIS</a></li>';
	$mn .= '<li><a href="'.site_url('kontak').'">KONTAK KAMI</a></li>';
	$mn .= "</ul>";

	return $mn;
}

function color()
{
	$warna = array(
		'bg-red'=>'Merah',
		'bg-yellow'=>'Kuning',
		'bg-green'=>'Hijau',
		'bg-aqua'=>'Aqua',
		'bg-blue'=>'Biru',
		'bg-light-blue'=>'Biru muda',
		'bg-navy'=>'Biru Tua',
		'bg-teal'=>'Teal',
		'bg-olive'=>'Olive',
		'bg-lime'=>'Lime',
		'bg-orange'=>'Orange',
		'bg-purple'=>'Ungu',
		'bg-marron'=>'Maroon',
		'bg-black'=>'Black');
	return $warna;
}

function posisi_banner($id=null)
{
	$posisi = array(
		'atasportal'=>'Bagian Atas Portal',
		'sisikiriportal'=>'Bagian Kiri Portal',
		'sisikananportal'=>'Bagian Kanan Portal',
		'bawahportal'=>'Bagian Bawah Portal',
		'kanankonten'=>'Sisi Kanan Konten',
		'kirikonten'=>'Sisi Kiri Konten');
	if($id==null)
		return $posisi;
	else
		return $posisi[$id];
	// Edit sesuai kebutuhan
}

function category_parent($id)
{
	$ci =& get_instance();

	$cek = $ci->db->get_where('category',array('category_id'=>$id));
	if($cek->num_rows()==1) {
		$cek = $cek->row();
		return $cek->category_name;
	} else {
		return $m = "- Parent Category -";
	}
}

function album_parent($id)
{
	$ci =& get_instance();

	$cek = $ci->db->get_where('album',array('album_id'=>$id));
	if($cek->num_rows()==1) {
		$cek = $cek->row();
		return $cek->album_title;
	} else {
		return $m = "- Parent Album -";
	}
}

function getIdKecamatan($idkel=null)
{
	$ci =& get_instance();
	$kel = $ci->db->get_where('kelurahan',array('kelurahan_id'=>$idkel))->row();
	if($kel) {
		$kec = $ci->db->get_where('kecamatan',array('kecamatan_id'=>$kel->kecamatan_id))->row();
		return $kec->kecamatan_id;
	}
	return $kec = "";
}

function kecamatan($idkel=null)
{
	$ci =& get_instance();
	$kel = $ci->db->get_where('kelurahan',array('kelurahan_id'=>$idkel))->row();
	if($kel) {
		$kec = $ci->db->get_where('kecamatan',array('kecamatan_id'=>$kel->kecamatan_id))->row();
		return $kec->kecamatan_nama;
	}
	return $kec = "";
}

function kelurahan($idkel=null)
{
	$ci =& get_instance();
	$kel = $ci->db->get_where('kelurahan',array('kelurahan_id'=>$idkel))->row();
	if($kel) {
		return $kel->kelurahan_nama;
	}
	return $kel = "";
}

function level($id)
{
	$level = array('Superadmin','Operator');
	echo $level[$id];
}

function convert_tanggal($tgl)
{
	$bulan = array(
		"01"=>"Januari",
			"02"=>"Februari",
			"03"=>"Maret",
			"04"=>"April",
			"05"=>"Mei",
			"06"=>"Juni",
			"07"=>"Juli",
			"08"=>"Agustus",
			"09"=>"September",
			"10"=>"Oktober",
			"11"=>"November",
			"12"=>"Dessember",);
	$ex = explode("-", $tgl);
	$d = $ex[2];
	$y = $ex[0];
	$m = $bulan[$ex[1]];

	return $cetak = $d.' '.$m.' '.$y;
}
function linked($id, $title) {
	$link = str_replace(" ", "-", htmlspecialchars($title));
	$linked = site_url('kategori/addview?id='.$id.'&title='.$link);
	return $linked;
}

function get_image($data, $default_url = null) {
    if($default_url!="") {
    	$img = base_url()."uploads/post/".$default_url;
    	return $img;
    } else {
    	if(preg_match_all('/\!\[.*?\]\((.*?)\)/', $data, $matches)) {
        	return $matches[1][0];
	    }
	    
	    if(preg_match_all('/<img (.*?)?src=(\'|\")(.*?)(\'|\")(.*?)? ?\/?>/i', $data, $matches)) {
	        return $matches[3][0];
	    }

    	return $foto = base_url()."uploads/post/default.jpg";
    }
}
function tanggal($tgl)
{
	$exp = explode(" ", $tgl);
	$tgl = $exp[0];
	$wkt = $exp[1];
	$bln = array(
		'01'=>'Januari',
		'02'=>'Februari',
		'03'=>'Maret',
		'04'=>'April',
		'05'=>'Mei',
		'06'=>'Juni',
		'07'=>'Juli',
		'08'=>'Agustus',
		'09'=>'September',
		'10'=>'Oktober',
		'11'=>'November',
		'12'=>'Desember'
		);
	$p = explode("-", $tgl);
	$tgl_jadi = $p[2]." ".$bln[$p[1]]." ".$p[0]." - ".$wkt;
	return $tgl_jadi;
}
function navigate($id)
{
	$t = "";
	$ci =& get_instance();
	$get = $ci->db->query("select * from category where category_id ='".$id."' ");
	if($get->num_rows()==1) {
		foreach ($get->result() as $c) {
			if($c->parent!="0") {
				$cek = $ci->db->query("select * from category where category_id ='".$c->parent."' ");
				foreach ($cek->result() as $k) {
					$t .= '<li><a href="#">'.$k->category_name.'</a></li>';
				}
				$t .= '<li><a href="#">'.$c->category_name.'</a></li>';
			} else {
				$t .= '<li><a href="'.site_url('kategori/kode/'.$c->category_id).'">'.$c->category_name.'</a></li>';
			}
		}
	}
	return $t;
}
function galeri_album($id)
{
	$ci =& get_instance();
	$kel = $ci->db->get_where('galeri',array('album_id'=>$id))->row();
	if($kel) {
		return base_url("uploads/galeri/".$kel->image);
	}
	return base_url("uploads/post/default.jpg");
}

function hasil_uji($parameter_id,$titik_uji_id)
{
	$ci =& get_instance();
	$ke = $ci->db->get_where('hasil_uji',array('parameter_id'=>$parameter_id,'titik_uji_id'=>$titik_uji_id));
	if($ke->num_rows()>0) {
		$data = $ke->row();
		return $data->hasil_uji;
	}
	return $ke = '-';
}

function status_hasil_uji($parameter_id,$titik_uji_id)
{
	$ci =& get_instance();
	$kep = $ci->db->get_where('hasil_uji',array('parameter_id'=>$parameter_id,'titik_uji_id'=>$titik_uji_id));
	if($kep->num_rows()>0) {
		$data = $kep->row();
		return $data->status;
	}
}

function nama_lokasi($table,$id,$field)
{
	$ci =& get_instance();
	$kep = $ci->db->get_where($table,array($table.'_id'=>$id));
	if($kep->num_rows()>0) {
		$data = $kep->row();
		return $data->$field;
	}
}

function hasil_uji_sungai($field=array())
{
	$ci =& get_instance();
	$ci->db->select('*');
		$ci->db->from('hasiluji_sungai a');
		$ci->db->join('par_sungai_situ b', 'a.par_sungai_situ_id=b.par_sungai_situ_id');
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

function hasil_uji_situ($field=array())
{
	$ci =& get_instance();
	$ci->db->select('*');
		$ci->db->from('hasiluji_situ a');
		$ci->db->join('par_sungai_situ b', 'a.par_sungai_situ_id=b.par_sungai_situ_id');
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

function hasil_uji_sumur($field=array())
{
	$ci =& get_instance();
	$ci->db->select('*');
		$ci->db->from('hasiluji_sumur a');
		$ci->db->join('par_sumur b', 'a.par_sumur_id=b.par_sumur_id');
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

function hasil_uji_tanah($field=array())
{
	$ci =& get_instance();
	$ci->db->select('*');
		$ci->db->from('hasiluji_tanah a');
		$ci->db->join('par_tanah b', 'a.par_tanah_id=b.par_tanah_id');
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


?>