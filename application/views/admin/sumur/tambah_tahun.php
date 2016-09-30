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


echo form_open_multipart('adm_sumur/tmb_tahunuji');
?>
    <div class="box">
      <div class="box-body">
      <div class="row">
        <div class="col-md-4 form-group">
          <label>Tahun Pengujian</label>
          <input type="text" name="tahun" class="form-control">
          <p class="help-block text-red"><?php echo form_error('tahun', ' ')?></p>
        </div>
        <div class="col-md-12 form-group">
          <label>Keterangan</label>
          <textarea class="form-control" rows="6" name="keterangan" id="editor1"></textarea>
          <p class="help-block text-red"><?php echo form_error('keterangan', ' ')?></p>
        </div>
        <div class="col-md-12">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
        <button class="btn btn-default" type="reset"><i class="fa fa-reload"></i> Batal</button>
        <a href="<?php echo site_url('adm_sumur') ?>" class="btn bg-green">Kembali</a>
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