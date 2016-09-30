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
    <?php
    if($this->session->flashdata('success')) {
      echo '
      <div class="alert alert-success">'.$this->session->flashdata('success').'</div> 
      ';
    }
    if($this->session->flashdata('error')) {
      echo '
      <div class="alert alert-danger">'.$this->session->flashdata('error').'</div> 
      ';
    }
    ?>
  <!-- Default box -->
  <div class="box" id="boximport">
      <div class="box-header with-border">
        <h3 class="box-title">Import Data</h3>
      </div>
      <div class="box-body">
        <form method="post" id="uploadcsv">
            <input type="file" name="csvfile" id="csvfile">
            <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </form>
      </div>
    </div>
  <div class="box">
    <div class="box-header with-border">
      <p><a href="<?php echo site_url('adm_amdal/tambah')?>" class="btn btn-sm bg-light-blue"><i class="fa fa-plus"></i> Tambah</a>
      </p>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Jenis kegiatan dan atau usaha</th>
          <th>Alamat Kegiatan</th>
          <th>KA-AMDAL</th>
          <th>AMDAL</th>
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
        <td><?php echo $rows->jenis_kegiatanusaha ?></td>
        <td><?php echo $rows->alamat ?></td>
        <td><?php echo $rows->rekom_kaamdal ?></td>
        <td><?php echo $rows->rekom_amdal ?></td>
        <td align="center">
          <a href="<?php echo site_url('adm_amdal/edit/'.$rows->amdal_id)?>" class="btn btn-xs bg-green" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil"></i></a>
          <a href="<?php echo site_url('trash/proses?tabel=amdal&primary='.$rows->amdal_id.'&url=adm_amdal')?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Anda yakin??')"><i class="fa fa-trash-o"></i></a>
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
<script type="text/javascript">
  $("#uploadcsv").submit(function(e) {
    e.preventDefault();
    $("#loading").show();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url('adm_amdal/importdata') ?>",
      enctype: 'multipart/form-data',
      contentType: false,
      cache: false,
      processData: false,
      data: new FormData(this),
      success: function(data) {
        $("#loading").hide();
        $("#formhasil").html(data);
        $("#boximport").show();
        $("#csvfile").val("");
      }
    });
  });
</script>
