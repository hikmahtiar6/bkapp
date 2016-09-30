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
      <a href="<?php echo site_url('adm_sumur/')?>" class="btn btn-sm bg-light-blue"><i class="fa fa-undo"></i> kembali</a>
      <a href="<?php echo site_url('adm_sumur/tmb_lokasiuji')?>" class="btn btn-sm bg-red"><i class="fa fa-plus"></i> Tambah</a>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover" id="example1">
      <thead>
        <tr>
          <th width="10">No</th>
          <th>Nama Pemilik</th>
          <th>Alamat</th>
          <th>Latitude</th>
          <th>Longtitude</th>
          <th width="150">Tools</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($listview->result() as $row) {
        ?>
        <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $row->nama_lokasi ?></td>
          <td><?php echo $row->alamat ?></td>
          <td><?php echo $row->lat ?></td>
          <td><?php echo $row->lng ?></td>
          <td>
            <a href="<?php echo site_url('adm_sumur/edit_lokasiuji/'.$row->lokasiuji_sumur_id)?>" class="btn btn-xs bg-green"><i class="fa fa-edit"></i> Edit</a>
            <a href="<?php echo site_url('trash/proses?tabel=lokasiuji_sumur&primary='.$row->lokasiuji_sumur_id.'&url=adm_sumur/lokasiuji')?>" class="btn btn-xs bg-red"><i class="fa fa-trash-o"></i> Hapus</a>
          </td>
        </tr>
        <?php
        $no++;
        }
        ?>
      </tbody>
    </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

</section><!-- /.content -->