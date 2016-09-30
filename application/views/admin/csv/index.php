<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><?php echo $title ?></li>
    <li class="active"></li>
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
<div class="row">
  <div class="col-lg-4">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <strong>Form Galeri</strong>
      </div>
      <div class="box-header with-border">
        
      <a href="<?php echo base_url('assets/excel/format.csv')?>"><button class="btn-warning btn-md"> Download Format </button></a>
      
      </div>
        <div class="box-body">
          <?php echo form_open_multipart('adm_csv/importcsv')?>
        <?php echo form_close();?>
		<div class="form-group">
          <label>Import</label>
		  <form method="post" action="<?php echo base_url() ?>index.php/adm_csv/importcsv" enctype="multipart/form-data">
                    <input type="file" name="userfile" ><br><br>
                    <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary">
                </form>
         
        </div>
		
      </div>
	  
	  
	  <div style="border: 1px solid #ddd; padding: 2px; background-color:#dddddd;  text-align: left; color: black; font-family: Verdana,Arial,Helvetica,Georgia; font-size: 11px; line-height:8px;">	
		<p> </p>
		<p><b><font face="Arial" font size="2px" font color="red">*Contoh Format Import Data</font></b></p>
		<p><b><font face="Arial">1. Download Form Pengisian Yang Tertera Di Atas</font></b></p>
		<p><b><font face="Arial">2. Isikan Data Dengan Sesuai</font></b></p>
		<p><b><font face="Arial">3. Lalu Save Dengan Format CSV </font></b></p>
		<p><b><font face="Arial">4. Lalu Klik Choose File </font></b></p>
		<p><b><font face="Arial">5. Pilih Data Yang Sudah Di Inputkan</font></b></p>
		<p><b><font face="Arial">5. Lalu Klik Upload</font></b></p>
      </div>
	  <!-- box-body -->
    </div><!-- box -->
	<div class="box-header with-border">
        
      <a href="<?php echo base_url('index.php/adm_csv/cetak')?>"><button class="btn-warning btn-md"> Download Format </button></a>
      
      </div>
  </div>
  
  <div class="col-lg-8">
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>id_pengujiansungai</th>
              <th>nama_sungai</th>
              <th>waktu_pengujian</th>
              <th>periode_uji</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($listview->num_rows()>0) {
              $no = 1;
              foreach ($listview->result() as $rows) {
            ?> 
            <tr>
              <td><?php echo $no; ?></td>
             
              <td><?php echo $rows->pengujian_sungai_id ?></td>
              <td><?php echo $rows->nama_sungai ?></td>
              <td><?php echo $rows->waktu_pengujian ?></td>
              <td><?php echo $rows->periode_uji ?></td>
              <td>
                <a href="<?php echo site_url('adm_csv/edit/'.$rows->pengujian_sungai_id)?>" class="btn btn-xs bg-green" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil"></i></a>
                <a href="<?php echo site_url('trash/proses?tabel=pengujian_sungai&primary='.$rows->pengujian_sungai_id.'&url=adm_csv')?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Menghapus data ini akan menghapus data posting juga!! Anda yakin??')"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
            <?php
              $no++;
              }
            }
            ?>
          </tbody>
        </table>
       
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
</section><!-- /.content -->