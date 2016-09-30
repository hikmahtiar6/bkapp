<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Pengelolaan Lingkungan Hidup</li>
    <li class="active"><?php echo $title ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <a href="<?php echo site_url('adm_sungai')?>" class="btn btn-default btn-xs btn-flat"><i class="fa fa-reply"></i> Kembali</a>
        <a href="<?php echo site_url('adm_sungai/edit/'.$sungai['sungai_id'])?>" class="btn btn-success btn-xs btn-flat"><i class="fa fa-edit"></i> Edit</a>
        <table class="strip">
          <tr class="bg-olive">
            <td width="140" valign="top">Nama DAS</td>
            <td valign="top" width="20">:</td>
            <td valign="top"><?php echo $sungai['nama_das'] ?></td>
          </tr>
          <tr class="bg-teal">
            <td width="140" valign="top">Tanggal Pengujian</td>
            <td valign="top" width="20">:</td>
            <td valign="top"><?php echo convert_tanggal($sungai['tahun_pengujian']) ?></td>
          </tr>
          <tr class="bg-olive">
            <td width="140" valign="top">Tahap Pengujian</td>
            <td valign="top" width="20">:</td>
            <td valign="top"><?php echo $sungai['tahap_pengujian'] ?></td>
          </tr>
          <tr class="bg-teal">
            <td width="140" valign="top">Hasil Akhir</td>
            <td valign="top" width="20">:</td>
            <td valign="top"><?php echo $sungai['hasil_akhir'] ?></td>
          </tr>
          <tr class="bg-olive">
            <td width="140" valign="top">Keterangan</td>
            <td valign="top" width="20">:</td>
            <td valign="top"><?php echo $sungai['keterangan'] ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        <a href="#" id="hulu" class="btn btn-flat btn-sm btn-info">Titik Uji Hulu Sungai</a>
        <a href="#" id="tengah" class="btn btn-flat btn-sm btn-info">Titik Uji Tengah Sungai</a>
        <a href="#" id="hilir" class="btn btn-flat btn-sm btn-info">Titik Uji Hilir Sungai</a>
      </div>
      <div class="box-body" id="contents">
      </div>
    </div>
  </div>
</div>
</section><!-- /.content -->

<script>
$("#hulu").click(function(){
  $("#contents").load("<?php echo site_url('adm_sungai/titik_uji/hulu/'.$sungai['sungai_id'])?>");
});
$("#tengah").click(function(){
  $("#contents").load("<?php echo site_url('adm_sungai/titik_uji/tengah/'.$sungai['sungai_id'])?>");
});
$("#hilir").click(function(){
  $("#contents").load("<?php echo site_url('adm_sungai/titik_uji/hilir/'.$sungai['sungai_id'])?>");
});
</script>