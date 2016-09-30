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


echo form_open_multipart('adm_hutan/tambah');
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_hutan')?>" class="btn btn-sm bg-grey">Kembali</a>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
          <label>Nama Lokasi*</label>
          <input type="text" name="nama_lokasi" value="<?php echo set_value('nama_lokasi') ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('nama_lokasi', ' ')?></p>
        </div>
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
          <label>Tanggal Pendataan*</label>
          <input type="text" name="tahun_pendataan" value="<?php echo date('Y-m-d')?>" class="form-control" id="dp2">
        </div>
        <div class="form-group">
          <label>foto</label>
          <input type="file" name="foto">
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea id="editor1" name="keterangan" class="form-control"></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        *Gambar map menggunakan poligon
      </div>
      <div class="box-body">
        <div id="petak"></div>
        <input type="hidden" id="kordinat" name="area" />
        <div class="form-group">
          <label>Luasan</label>
          <input type="text" name="luasan" value="<?php echo set_value('luasan') ?>" class="form-control">
        </div>
        <div class="form-group">
          <label>Jenis Tanaman</label>
          <input type="text" name="jenis_tanaman" value="<?php echo set_value('jenis_tanaman') ?>" class="form-control">
        </div>
        <div class="form-group">
          <label>Warna Layer</label>
          <input type="text" name="warna" value="<?php echo set_value('warna') ?>" class="form-control">
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
</script>
<style type="text/css">
#petak {
  height: 400px;
  width: 100%;
  background: #ffd;
}
</style>