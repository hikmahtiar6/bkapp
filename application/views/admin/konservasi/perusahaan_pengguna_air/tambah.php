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


echo form_open_multipart('adm_perusahaan_pengguna_air/tambah');
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_perusahaan_pengguna_air')?>" class="btn btn-sm bg-grey">Kembali</a>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="box">
      <div class="box-body">
	  
        <div class="form-group">
          <label>Nama Kepemilikan*</label>
          <input type="text" name="nama_kepemilikan" value="<?php echo set_value('nama_kepemilikan')?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('nama_kepemilikan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Tahun Pengawasan*</label>
          <input type="text" name="tahun_pengawasan" value="<?php echo date('Y-m-d')?>" class="form-control" id="dp2">
          <p class="help-block text-red"><?php echo form_error('tahun_pengawasan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Debit Air*</label>
          <input type="text" name="debit_air" value="<?php echo set_value('debit_air') ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('debit_air', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Alamat*</label>
          <textarea rows="4" name="alamat" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label>No Izin</label>
          <input type="text" name="no_izin" value="<?php echo set_value('no_izin')?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('no_izin', ' ')?></p>
        </div>
		<div class="form-group">
          <label>Keterangan</label>
          <textarea id="editor1" name="keterangan" class="form-control"></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-5">
    <div class="box">
      <div class="box-body">
        <div class="gllpLatlonPicker">
          <div class="gllpMap" style="width:100%; height:250px;">Lokasi Map</div>
          <br>
              <div class="form-group">
                  <label for="exampleInputPassword1">Latitude</label>
                  <input type="text" name="lat" class="form-control gllpLatitude" value="-6.59483">
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword1">Longitude</label>
                  <input type="text" name="lng" class="form-control gllpLongitude" value="106.79955">
              </div>
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
		
          <label>marker color</label>
		  
          <input type="text" name="marker-color"  class="form-control jscolor{hash:true}" >
          <p class="help-block text-red"><?php echo form_error('marker-color', ' ')?></p>
        </div>

		
          
          
				<div class="form-group">
          <label>marker symbol</label>
          <select name="icon" class="form-control" id="icon">
            <option value="">- Pilih -</option>
            <?php
            if($icon->num_rows()>0) {
              foreach ($icon->result() as $rows) {
                ?>
                <option value="<?php echo $rows->icon1 ?>"><?php echo $rows->icon1 ?></option>
                <?php
              }
            }
            ?>
          </select>
				
				
			
        </div>
		
		<div class="form-group">
          <label>marker size</label>
          <select name="marker-size" class="form-control" id="marker-size">
            <option value="">- Pilih -</option>
			 <option value="small">small</option>
			  <option value="medium">medium</option>
			   <option value="large">large</option>
            
          </select>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
</section><!-- /.content -->
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
<script src="<?php echo base_url('assets/gmaps/js/jscolor.js')?>"></script>