<?php

/**
* Rss_bogor.php Rss xml
*/
class Rss_berita extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('fungtion');
	}

	function index()
	{
		header("Content-type: text/xml");
		echo "<?xml version='1.0' encoding='UTF-8' ?>";
		echo "<rss version='2.0'>";
		echo "<channel>";
		echo "<title>Berita Website Kota Bogor</title>";
		echo "<link>http://kotabogor.go.id/</link>";
		echo "<description>Berita Website Kota Bogor</description>";
		echo "<language>id</language>";
		echo "<copyright>Kota Bogor</copyright>";
		echo "<lastBuildDate>".gmdate("D, d M Y H:i:s", time()+60*60*7)." +0000 </lastBuildDate>";
		echo "<generator>feed_domain (webmaster@kotabogor.go.id)</generator>";

		$berita = $this->db->query("select * from post where category_id='1' and post_status='1' order by post_id desc limit 100")->result_array();
		 
		foreach ($berita as $key => $row)
		{
		 $idartikel = $row['post_id'];
		 $slug = $row['post_slug'];
		 $tanggal = $row['post_publish_date'];
		 $judul = htmlspecialchars($row['post_title'], ENT_QUOTES);
		 $keterangan = htmlentities(strip_tags($row['post_content']),ENT_QUOTES);

		 $bln = substr($tanggal,5,2);
		 $mth = $this->fungtion->convert_month_eng($bln);
		 $date_pub = $this->fungtion->convert_date($tanggal);

		 echo "<item>";
		 echo "<title>".$judul."</title>";
		 echo "<link>http://kotabogor.go.id/index.php/show_post/detail/".$idartikel."/".$slug."</link>";
		 echo "<pubDate>".date("Y-m-d H:i:sO", strtotime($tanggal)) ."</pubDate>";
		 echo !empty($row['post_image']) ?  '<enclosure url="'.base_url('multisite/content/'.$row['post_image']).'" length="10240" type="image/jpeg" />'  : '';
		 echo "<description>".$keterangan."</description>";
		 echo "<guid isPermaLink=\"False\">http://kotabogor.go.id/index.php/show_post/detail/".$idartikel."/".$slug."</guid>";
		 echo "</item>";
		}
		 
		echo "</channel>";
		echo "</rss>";
	}
}

?>