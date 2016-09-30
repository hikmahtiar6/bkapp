<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Log Aktivitas</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Waktu</th>
              <th>Aktivitas</th>
              <th>User</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($activity->num_rows()>0) {
              $no = 1;
              foreach ($activity->result() as $rows) {
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $rows->time ?></td>
              <td><?php echo $rows->activity ?></td>
              <td><?php echo $rows->user_name; ?></td>
            </tr>
            <?php
              $no++;
              }
            }
            ?>
          </tbody>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
      <a href="<?php echo site_url('trash/hapuslog')?>" onclick="return confirm('Anda yakin hapus semua log aktivitas??')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Bersihkan Log Aktivitas</a>
    </div><!-- /.box-footer-->
  </div><!-- /.box -->
</section><!-- /.content -->