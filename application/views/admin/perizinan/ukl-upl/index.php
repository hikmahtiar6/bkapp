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
  <div class="box">
    <div class="box-header with-border">
      <a href="<?php echo site_url('adm_uklupl/tambah')?>" class="btn btn-sm bg-light-blue"><i class="fa fa-plus"></i> Tambah</a>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nomor Surat</th>
          <th>Tanggal Surat</th>
          <th>Jenis kegiatan dan atau usaha</th>
          <th>Nama Pemilik</th>
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
        <td><?php echo $rows->nomor_surat ?></td>
        <td><?php echo $rows->tgl_surat ?></td>
        <td><?php echo $rows->jenis_kegiatanusaha ?></td>
        <td><?php echo $rows->nama_pemilik ?></td>
        <td align="center">
          <a href="<?php echo site_url('adm_uklupl/edit/'.$rows->ukl_upl_id)?>" class="btn btn-xs bg-green" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil"></i></a>
          <a href="<?php echo site_url('trash/proses?tabel=ukl_upl&primary='.$rows->ukl_upl_id.'&url=adm_uklupl')?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Anda yakin??')"><i class="fa fa-trash-o"></i></a>
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