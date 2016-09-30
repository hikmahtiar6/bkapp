<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li>Pengujian</li>
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


echo form_open_multipart('adm_kendaraan/edit_emisi');
echo form_hidden('id', $row['emisi_kdr_id']);
?>
    <div class="box">
      <div class="box-body">
      <div class="row">
        <div class="col-md-4 form-group">
          <label>Tahun Pengujian</label>
          <input type="text" name="tahunuji" class="form-control" value="<?php echo $row['tahunuji'] ?>">
          <p class="help-block text-red"><?php echo form_error('tahunuji', ' ')?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 form-group">
          <label>Lokasi Pengujian</label>
          <input type="text" name="lokasiuji" class="form-control" value="<?php echo $row['lokasiuji'] ?>">
          <p class="help-block text-red"><?php echo form_error('lokasiuji', ' ')?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 form-group">
          <label>Jumlah Kendaraan (Bensin)</label>
          <input type="text" name="jum_kdr_bensin" class="form-control" placeholder="Jumlah Kendaraan" value="<?php echo $row['jum_kdr_bensin'] ?>">
        </div>
        <div class="col-md-3 form-group">
        <label>Jumlah Lulus</label>
          <input type="text" name="bensin_lulus" class="form-control" placeholder="Jumlah Lulus" value="<?php echo $row['bensin_lulus'] ?>">
        </div>
        <div class="col-md-3 form-group">
        <label>Jumlah Tidak Lulus</label>
          <input type="text" name="bensin_non_lulus" class="form-control" placeholder="Jumlah Tidak Lulus" value="<?php echo $row['bensin_non_lulus'] ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 form-group">
          <label>Jumlah Kendaraan (Solar)</label>
          <input type="text" name="jum_kdr_solar" class="form-control" placeholder="Jumlah Kendaraan" value="<?php echo $row['jum_kdr_solar'] ?>">
        </div>
        <div class="col-md-3 form-group">
        <label>Jumlah Lulus</label>
          <input type="text" name="solar_lulus" class="form-control" placeholder="Jumlah Lulus" value="<?php echo $row['solar_lulus'] ?>">
        </div>
        <div class="col-md-3 form-group">
        <label>Jumlah Tidak Lulus</label>
          <input type="text" name="solar_non_lulus" class="form-control" placeholder="Jumlah Tidak Lulus" value="<?php echo $row['solar_non_lulus'] ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 form-group">
          <label>Keterangan</label>
          <textarea class="form-control" rows="6" name="keterangan" id="editor1"><?php echo $row['keterangan'] ?></textarea>
          <p class="help-block text-red"><?php echo form_error('keterangan', ' ')?></p>
        </div>
        <div class="col-md-12">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
        <button class="btn btn-default" type="reset"><i class="fa fa-reload"></i> Batal</button>
        <a href="<?php echo site_url('adm_kendaraan') ?>" class="btn bg-green">Kembali</a>
        </div>
      </div>
      </div>
    </div>
</form>
</section><!-- /.content -->

<!-- CK Editor -->
<script src="<?php echo base_url()?>assets/plugins/ckeditor/ckeditor.js"></script>

<script language="javascript">
CKEDITOR.replace( 'editor1', {
filebrowserBrowseUrl : '<?php echo base_url()?>assets/plugins/ckfinder/ckfinder.html',
filebrowserImageBrowseUrl : '<?php echo base_url()?>assets/plugins/ckfinder/ckfinder.html?type=Images',
filebrowserFlashBrowseUrl : '<?php echo base_url()?>assets/plugins/ckfinder/ckfinder.html?type=Flash',
filebrowserUploadUrl : '<?php echo base_url()?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl : '<?php echo base_url()?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
filebrowserFlashUploadUrl : '<?php echo base_url()?>assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
filebrowserWindowWidth : '700',
filebrowserWindowHeight : '400'});</script>