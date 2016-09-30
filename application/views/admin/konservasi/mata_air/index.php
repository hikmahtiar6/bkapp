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
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="box-header text-right">
        <form method="post" action="<?php echo site_url('adm_mata_air/cari')?>">
        <input type="text" name="tahun_pengujian1" value="<?php echo date('Y-m-d')?>" id="dp2" style="width:150px;"> s/d
        <input type="text" name="tahun_pengujian2" value="<?php echo date('Y-m-d')?>" id="dp1" style="width:150px;">
        <button class="btn btn-sm bg-green"><i class="fa fa-search"></i> Cari</button>
        <a href="<?php echo site_url('adm_mata_air/cetak?tgl1='.$tgl1.'&tgl2='.$tgl2.'')?>" class="btn btn-sm bg-green"><i class="fa fa-print"></i> Cetak Data</a>
        </form>
      </div>
      <a href="<?php echo site_url('adm_mata_air/tambah')?>" class="btn btn-sm bg-light-blue"><i class="fa fa-plus"></i> Tambah</a>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Tahun Pengamatan</th>
          <th>Keterangan</th>
          <th>Alamat</th>
          <th>Tools</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if($listview->num_rows()>0) {
        $no = $offset + 1;
        foreach ($listview->result() as $rows) {
      ?>
      <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $rows->tahun_pengamatan ?></td>
        <td><?php echo $rows->description ?></td>
        <td><?php echo $rows->alamat ?></td>
        <td align="center">
          <a href="<?php echo site_url('adm_mata_air/edit/'.$rows->mata_air_id)?>" class="btn btn-xs bg-green" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil"></i></a>
          <a href="<?php echo site_url('trash/proses?tabel=mata_air&primary='.$rows->mata_air_id.'&url=adm_mata_air&img=uploads/ragamdata/konservasi/mata_air/'.$rows->foto)?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Anda yakin??')"><i class="fa fa-trash-o"></i></a>
        </td>
      </tr>
      <?php
      $no++;
        }
      } else {
        echo "<tr><td colspan='10'>No Data...</td></tr>";
      }
      ?>
      </tbody>
    </table>
      
    </div><!-- /.box-body -->
    <div class="box-footer">
    <?php echo $this->pagination->create_links(); ?>
    </div><!-- /.box-footer-->
  </div><!-- /.box -->
</section><!-- /.content -->