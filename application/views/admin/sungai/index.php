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
      <a href="<?php echo site_url('adm_sungai/lokasiuji')?>" class="btn btn-sm bg-light-blue"><i class="fa fa-list"></i> Lokasi Pengujian</a>
      <a href="<?php echo site_url('adm_sungai/tmb_tahunuji')?>" class="btn btn-sm bg-red"><i class="fa fa-plus"></i> Tambah Tahun Pengujian</a>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover" id="example1">
      <thead>
        <tr>
          <th width="10">No</th>
          <th>Tahun Pengujian</th>
          <th>Keterangan</th>
          <th width="180">Tools</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($tahun->result() as $row) {
        ?>
        <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $row->tahunuji_sungai ?></td>
          <td><?php echo $row->keterangan ?></td>
          <td>
            <a href="<?php echo site_url('adm_sungai/tmb_hasiluji/'.$row->tahunuji_sungai)?>" class="btn btn-xs bg-light-blue"><i class="fa fa-file"></i> Hasil Pengujian</a>
            <a href="<?php echo site_url('adm_sungai/edit_tahunuji/'.$row->tahunuji_sungai)?>" class="btn btn-xs bg-green"><i class="fa fa-edit"></i> Edit</a>
            <a href="<?php echo site_url('adm_sungai/hapus_tahunuji/'.$row->tahunuji_sungai)?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Anda yakin ingin menghapus??')"><i class="fa fa-trash-o"></i></a>
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