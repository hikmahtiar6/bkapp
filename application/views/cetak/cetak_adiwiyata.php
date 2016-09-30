<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=".$filename.$item['nomer'].".xls");
        
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $filename ?></title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<style type="text/css">
	body {
		/*size:595.3pt 841.9pt;
    	margin:2.0cm 42.5pt 2.0cm 3.0cm;*/
    	font-family: Times New Roman, Arial, Calibri;
    	font-size: 11pt;
	}
	h1,h2,h3,h4 {
		padding: 0;
		margin: 0;
		margin-bottom: 5px;
	}
	.bd td {
		padding: 5px 0px;
	}
	.tb td {
		padding: 5px;
	}
	</style>
</head>
<body>
	<h3 align="center"><?php echo $judul1 ?></h3>
	<table width="1000" border="1">
		<tr style='background:#cfcfcf'>
			<td valign="top" align="center" rowspan="2">No</td>
			<td valign="top" align="center" rowspan="2">Nama Sekolah</td>
			<td valign="top" align="center" rowspan="2">Tahun Penghargaan</td>
			<td valign="top" align="center" rowspan="2">Alamat</td>
			<td valign="top" align="center" colspan="2">Lokasi</td>
			<td valign="top" align="center" colspan="2">Kordinat</td>
		</tr>
		<tr style='background:#cfcfcf'>
			<td align="center">Kecamatan</td>
			<td align="center">Kelurahan</td>
			<td align="center">Lat</td>
			<td align="center">Lng</td>
		</tr>
		<?php
          if($listview1) {
            $no = 1;
            foreach ($listview1->result_array() as $que) {
              $bg = "style='background:transparent'";
              echo "<tr $bg >";
              ?>
              <td><?php echo $no ?></td>
              <td><?php echo $que['nama_sekolah']?></td>
              <td><?php echo date('Y', strtotime($que['tahun_penghargaan']))?></td>
              <td><?php echo $que['alamat']?></td>
              <td><?php echo kecamatan($que['kelurahan_id'])?></td>
              <td><?php echo kelurahan($que['kelurahan_id'])?></td>
              <td><?php echo $que['lat']?></td>
              <td><?php echo $que['lng']?></td>
              <?php
              echo "</tr>";
              $no++;
            }
          }
        ?>
	</table> <br/><br/>
	<h3 align="center"><?php echo $judul2 ?></h3>
	<table width="1000" border="1">
		<tr style='background:#cfcfcf'>
			<td valign="top" align="center" rowspan="2">No</td>
			<td valign="top" align="center" rowspan="2">Nama Sekolah</td>
			<td valign="top" align="center" rowspan="2">Tahun Penghargaan</td>
			<td valign="top" align="center" rowspan="2">Alamat</td>
			<td valign="top" align="center" colspan="2">Lokasi</td>
			<td valign="top" align="center" colspan="2">Kordinat</td>
		</tr>
		<tr style='background:#cfcfcf'>
			<td align="center">Kecamatan</td>
			<td align="center">Kelurahan</td>
			<td align="center">Lat</td>
			<td align="center">Lng</td>
		</tr>
		<?php
          if($listview2) {
            $no = 1;
            foreach ($listview2->result_array() as $que) {
              $bg = "style='background:transparent'";
              echo "<tr $bg >";
              ?>
              <td><?php echo $no ?></td>
              <td><?php echo $que['nama_sekolah']?></td>
              <td><?php echo date('Y', strtotime($que['tahun_penghargaan']))?></td>
              <td><?php echo $que['alamat']?></td>
              <td><?php echo kecamatan($que['kelurahan_id'])?></td>
              <td><?php echo kelurahan($que['kelurahan_id'])?></td>
              <td><?php echo $que['lat']?></td>
              <td><?php echo $que['lng']?></td>
              <?php
              echo "</tr>";
              $no++;
            }
          }
        ?>
	</table><br/><br/>
	<h3 align="center"><?php echo $judul3 ?></h3>
	<table width="1000" border="1">
		<tr style='background:#cfcfcf'>
			<td valign="top" align="center" rowspan="2">No</td>
			<td valign="top" align="center" rowspan="2">Nama Sekolah</td>
			<td valign="top" align="center" rowspan="2">Tahun Penghargaan</td>
			<td valign="top" align="center" rowspan="2">Alamat</td>
			<td valign="top" align="center" colspan="2">Lokasi</td>
			<td valign="top" align="center" colspan="2">Kordinat</td>
		</tr>
		<tr style='background:#cfcfcf'>
			<td align="center">Kecamatan</td>
			<td align="center">Kelurahan</td>
			<td align="center">Lat</td>
			<td align="center">Lng</td>
		</tr>
		<?php
          if($listview3) {
            $no = 1;
            foreach ($listview3->result_array() as $que) {
              $bg = "style='background:transparent'";
              echo "<tr $bg >";
              ?>
              <td><?php echo $no ?></td>
              <td><?php echo $que['nama_sekolah']?></td>
              <td><?php echo date('Y', strtotime($que['tahun_penghargaan']))?></td>
              <td><?php echo $que['alamat']?></td>
              <td><?php echo kecamatan($que['kelurahan_id'])?></td>
              <td><?php echo kelurahan($que['kelurahan_id'])?></td>
              <td><?php echo $que['lat']?></td>
              <td><?php echo $que['lng']?></td>
              <?php
              echo "</tr>";
              $no++;
            }
          }
        ?>
	</table>
</body>
</html>