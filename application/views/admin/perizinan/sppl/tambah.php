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


echo form_open_multipart('adm_sppl_baru/tambah');
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_sppl_baru')?>" class="btn btn-sm bg-grey">Kembali</a>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
          <label>Tanggal SPPL*</label>
          <input type="text" name="tgl_sppl" value="<?php echo date('Y-m-d')?>" class="form-control" id="dp2">
        </div>
        <div class="form-group">
          <label>Nomor SPPL*</label>
          <input type="text" name="nomor_sppl" value="<?php echo set_value('nomor_sppl') ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('nomor_sppl', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Tahun*</label>
          <input type="text" name="tahun" value="<?php echo set_value('tahun') ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('tahun', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Jenis Kegiatan/Usaha*</label>
          <input type="text" name="jenis_kegiatanusaha" value="<?php echo set_value('jenis_kegiatanusaha') ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('jenis_kegiatanusaha', ' ')?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-5">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
          <label>Kecamatan*</label>
          <select name="kecamatan" class="form-control" id="kecamatan">
            <option value="">- Pilih -</option>
            <?php
            if($kecamatan->num_rows()>0) {
              foreach ($kecamatan->result() as $rows) {
                ?>
                <option value="<?php echo $rows->kecamatan_id ?>"><?php echo $rows->kecamatan_nama ?></option>
                <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Kelurahan*</label>
          <select name="kelurahan" class="form-control" id="kelurahan">
            <option value="">- Pilih -</option>
          </select>
        </div>
        <div class="form-group">
          <label>Alamat Usaha*</label>
          <textarea rows="4" class="form-control" name="alamat_usaha"></textarea>
          <p class="help-block text-red"><?php echo form_error('alamat_usaha', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Nama Pemilik*</label>
          <input type="text" name="nama_pemilik" value="<?php echo set_value('nama_pemilik') ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('nama_pemilik', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Alamat Pemilik*</label>
          <textarea rows="4" class="form-control" name="alamat_pemilik"></textarea>
          <p class="help-block text-red"><?php echo form_error('alamat_pemilik', ' ')?></p>
        </div>
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
filebrowserWindowHeight : '400'});
CKEDITOR.replace('editor2');</script>
<!-- Maps -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/gmaps/css/style.css')?>" />
<script src="<?php echo base_url('assets/gmaps/js/OpenLayers.js')?>"></script>
<script src="<?php echo base_url('assets/gmaps/js/jquery-position-picker.debug.js')?>"></script>