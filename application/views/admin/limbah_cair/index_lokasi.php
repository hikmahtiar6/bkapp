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
      <a href="<?php echo site_url('adm_limbah_cair/')?>" class="btn btn-sm bg-light-blue"><i class="fa fa-undo"></i> kembali</a>
      <a href="<?php echo site_url('adm_limbah_cair/tmb_lokasiuji')?>" class="btn btn-sm bg-red"><i class="fa fa-plus"></i> Tambah</a>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover" id="example1">
      <thead>
        <tr>
          <th width="10">No</th>
          <th>Kategori</th>
          <th>Nama lokasi</th>
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
          <td><?php echo $row->nama_objekuji ?></td>
          <td><?php echo $row->nama_lokasi ?></td>
          <td>
            <a href="<?php echo site_url('adm_limbah_cair/edit_lokasiuji/'.$row->lokasiuji_limbah_cair_id)?>" class="btn btn-xs bg-green"><i class="fa fa-edit"></i> Edit</a>
            <a href="<?php echo site_url('trash/proses?tabel=lokasiuji_limbah_cair&primary='.$row->lokasiuji_limbah_cair_id.'&url=adm_limbah_cair/lokasiuji')?>" class="btn btn-xs bg-red"><i class="fa fa-trash-o"></i> Hapus</a>
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