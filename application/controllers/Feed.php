<?php

/**
* Feed.php Rss xml
*/
class Feed extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('supermodel');
	}

	function index()
	{
		header("Content-type: text/xml");
		echo "<?xml version='1.0' encoding='UTF-8'?>";
		echo "<rss version='2.0'>";
		echo "<channel>";
		echo "<title>BPLH Kota Bogor</title>";
		echo "<link>http://bplh.kotabogor.go.id/</link>";
		echo "<description>Berita BPLH Kota Bogor</description>";
		echo "<language>id</language>";
		echo "<copyright>BPLH Kota Bogor</copyright>";
		echo "<lastBuildDate>".gmdate("D, d M Y H:i:s", time()+60*60*7)." +0700 </lastBuildDate>";
		echo "<generator>feed_domain (webmaster@bplh.kotabogor.go.id)</generator>";

		$berita = $this->db->query("select * from post where category_id = 7 order by date_publish desc");

		//$berita = $this->sprmodel->getAllWhere('konten', array('kategori_id'=>5,'publish'=>1), array('tgl_post','desc'))->result_array();
		 
		foreach ($berita->result_array() as $row)
		{
		 // $idartikel = $row['post_id'];
		 // $tanggal = $row['date_publish'];
		 $judul = htmlspecialchars($row['title'], ENT_QUOTES);
		 $keterangan = substr(htmlentities(strip_tags($row['body']),ENT_QUOTES), 0,300).'...';

		 // echo "<item>";
		 // echo "<title>".$judul."</title>";
		 // echo "<opd>BPLH Kota Bogor</opd>";
		 // echo "<linkopd>http://bplh.kotabogor.go.id</linkopd>";
		 // echo "<link>".linked($idartikel, $row['title'])."</link>";
		 // echo "<pubDate>".date("Y-m-d H:i:s", strtotime($tanggal))."</pubDate>";
		 // //echo !empty($row['image']) ?  '<enclosure url="'.base_url('asset/images/web/konten/'.$row['konten_gambar']).'" length="10240" type="image/jpeg" />'  : '';
		 // echo "<description>".$keterangan."</description>";
		 // echo "<guid isPermaLink=\"False\">".linked($idartikel, $row['title'])."</guid>";
		 // echo "</item>";

		$link = htmlspecialchars($row['title']);

		 echo "<item>";
		 echo "<title>".$judul."</title>";
		 echo "<opd>BPLH Kota Bogor</opd>";
		 echo "<linkopd>http://bplh.kotabogor.go.id</linkopd>";
		 echo "<link>".site_url('kategori/addview?id='.$row['post_id'])."</link>";
		 echo "<pubDate>".date("Y-m-d H:i:s", strtotime($row['date_publish']))."</pubDate>";
		 //echo !empty($row['image']) ?  '<enclosure url="'.base_url('asset/images/web/konten/'.$row['konten_gambar']).'" length="10240" type="image/jpeg" />'  : '';
		 echo "<description>".$keterangan."</description>";
		 echo "<guid isPermaLink=\"False\">http://sil.kotabogor.go.id</guid>";
		 echo "</item>";


		}
		 
		echo "</channel>";
		echo "</rss>";
	}
}

?>