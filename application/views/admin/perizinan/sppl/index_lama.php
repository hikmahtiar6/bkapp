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
      <a href="<?php echo site_url('adm_sppl/tambah')?>" class="btn btn-sm bg-light-blue"><i class="fa fa-plus"></i> Tambah</a>
    </div>
    <div class="box-body">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Nama Perusahaan</th>
          <th>Alamat</th>
          <th>Alamat Perusahaan</th>
          <th>Status Permohonan</th>
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
        <td><?php echo $rows->nama ?></td>
        <td><?php echo $rows->nama_perusahaan ?></td>
        <td><?php echo $rows->alamat ?></td>
        <td><?php echo $rows->alamat_perusahaan ?></td>
        <td>
          <?php 
            if ($rows->status=="1")
            {
              echo 'Sudah Diterima';
            }
            else
            {
              echo 'Belum Diterima';
            } 
          ?>
         
        </td>
        <td align="center">
          <a href="<?php echo site_url('adm_sppl/approve/')?>" class="btn btn-xs bg-blue" data-toggle="tooltip" title="Ubah Status Permohonan" onclick="return confirm('Ini akan merubah status permohonan menjadi sudah diterima, lanjutkan?')"><i class="fa fa-check-square"></i></a>
          <a href="<?php echo site_url('adm_sppl/edit/'.$rows->sppl_lama_id)?>" class="btn btn-xs bg-green" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil"></i></a>
          <a href="<?php echo site_url('trash/proses?tabel=sppl_lama&primary='.$rows->sppl_lama_id.'&url=adm_sppl')?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Anda yakin??')"><i class="fa fa-trash-o"></i></a>
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