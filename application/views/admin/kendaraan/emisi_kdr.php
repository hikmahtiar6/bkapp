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
      <a href="<?php echo site_url('adm_kendaraan/tmb_emisi')?>" class="btn btn-sm bg-red"><i class="fa fa-plus"></i> Tambah</a>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover" id="example1">
      <thead>
        <tr>
          <th width="10">No</th>
          <th>Tahun</th>
          <th>Lokasi</th>
          <th>Jml Kendaraan Bensin</th>
          <th>Jml Lulus (Bensin)</th>
          <th>Jml Kendaraan Solar</th>
          <th>Jml Lulus (Solar)</th>
          <th width="180">Tools</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($kdr->result() as $row) {
        ?>
        <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $row->tahunuji ?></td>
          <td><?php echo $row->lokasiuji ?></td>
          <td><?php echo $row->jum_kdr_bensin ?></td>
          <td><?php echo $row->bensin_lulus ?></td>
          <td><?php echo $row->jum_kdr_solar ?></td>
          <td><?php echo $row->solar_lulus ?></td>
          <td>
            <a href="<?php echo site_url('adm_kendaraan/edit_emisi/'.$row->emisi_kdr_id)?>" class="btn btn-xs bg-green"><i class="fa fa-edit"></i> Edit</a>
            <a href="<?php echo site_url('trash/proses?tabel=emisi_kdr&primary='.$row->emisi_kdr_id.'&url=adm_kendaraan')?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Anda yakin ingin menghapus??')"><i class="fa fa-trash-o"></i></a>
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