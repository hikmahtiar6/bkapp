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


echo form_open_multipart('adm_sppl/edit');
echo form_hidden('id',$item['sppl_lama_id']);
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_sppl')?>" class="btn btn-sm bg-grey">Kembali</a>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
          <label>Nama*</label>
          <input type="text" name="nama" value="<?php echo $item['nama'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('nama', ' ')?></p>
        </div>
        <div class="form-group">
          <label>jabatan*</label>
          <input type="text" name="jabatan" value="<?php echo $item['jabatan'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('jabatan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Alamat*</label>
          <textarea rows="4" class="form-control" name="alamat"><?php echo $item['alamat']?></textarea>
        </div>
        <div class="form-group">
          <label>Nomor Telepon</label>
          <input type="text" name="no_telp" value="<?php echo $item['no_telp'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('no_telp', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Tanggal</label>
          <input type="text" name="tanggal" value="<?php echo $item['tanggal']?>" class="form-control" id="dp2">
        </div>
        <div class="form-group">
          <label>Status Permohonan</label><br/>
          <?php
          $s1 = ''; $s2 = '';
          if($item['status']=="0") { $s1= "checked"; }
          else { $s2= "checked"; }
          ?>
          <label><input type="radio" name="status" value="0" <?php echo $s1; ?> > Belum Diterima</label>
          <label style="margin-left:30px;"><input type="radio" name="status" value="1" <?php echo $s2; ?> > Sudah Diterima</label>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-5">
    <div class="box">
      <div class="box-body">
          <div class="form-group">
          <label>Nama Perusahaan/Usaha*</label>
          <input type="text" name="nama_perusahaan" value="<?php echo $item['nama_perusahaan'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('nama_perusahaan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Alamat Perusahaan*</label>
          <textarea rows="4" class="form-control" name="alamat_perusahaan"><?php echo $item['alamat_perusahaan']?></textarea>
        </div>
        <div class="form-group">
          <label>Nomor Telepon Perusahaan</label>
          <input type="text" name="no_telp_perusahaan" value="<?php echo $item['no_telp_perusahaan'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('no_telp_perusahaan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Jenis Usaha/Sifat Usaha</label>
          <input type="text" name="jenis_usaha" value="<?php echo $item['jenis_sifat'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('jenis_usaha', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Kapasitas Produksi</label>
          <input type="text" name="kapasitas_produksi" value="<?php echo $item['kapasitas_produksi'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('kapasitas_produksi', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Luas Lahan + Luas Bangunan</label>
          <input type="text" name="luas_lahan" value="<?php echo $item['luas_lahan'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('luas_lahan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Kondisi_lahan</label>
          <input type="text" name="kondisi_lahan" value="<?php echo $item['kondisi_lahan'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('kondisi_lahan', ' ')?></p>
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