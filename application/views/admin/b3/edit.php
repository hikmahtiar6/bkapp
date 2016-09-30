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


echo form_open_multipart('adm_b3/edit');
echo form_hidden('id',$item['izin_btiga_id']);
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_b3')?>" class="btn btn-sm bg-grey">Kembali</a>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="box">
      <div class="box-body">
	 
        <div class="form-group">
          <label>Jenis Kegiatan*</label>
          <input type="text" name="jenis_kegiatan" value="<?php echo $item['jenis_kegiatan'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('jenis_kegiatan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Nama Kegiatan*</label>
          <input type="text" name="nama_kegiatan" value="<?php echo $item['nama_kegiatan'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('nama_kegiatan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Pimpinan*</label>
          <input type="text" name="pimpinan" value="<?php echo $item['pimpinan'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('pimpinan', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Kontak Person*</label>
          <input type="text" name="kontak" value="<?php echo $item['kontak'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('kontak', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Telepon*</label>
          <input type="text" name="telepon" value="<?php echo $item['telepon'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('telepon', ' ')?></p>
        </div>
        <div class="form-group">
          <label>No Izin*</label>
          <input type="text" name="no_izin" value="<?php echo $item['no_izin'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('no_izin', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Status*</label>
          <input type="text" name="status" value="<?php echo $item['status'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('status', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Tanggal Terbit Izin*</label>
          <input type="text" name="tgl_terbitizin" value="<?php echo $item['tgl_terbitizin'] ?>" class="form-control" id="dp2">
          <p class="help-block text-red"><?php echo form_error('tgl_terbitizin', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Masa Berlaku*</label>
          <input type="text" name="masa_berlaku" value="<?php echo $item['masa_berlaku'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('masa_berlaku', ' ')?></p>
        </div>
		<div class="form-group">
          <label>Keterangan</label>
          <textarea id="editor1" name="keterangan" class="form-control"><?php echo $item['description']?></textarea>
        </div>
      </div>
      <!-- <div class="box-body">
        <div class="form-group">
          <label>Nama Perusahaan*</label>
          <input type="text" name="nama_perusahaan" value="<?php echo $item['nama_perusahaan'] ?>" class="form-control">
        </div>
        <div class="form-group">
          <label>Tahun Pengawasan*</label>
          <input type="text" name="tahun_pengawasan" value="<?php echo $item['tahun_pengawasan']?>" class="form-control" id="dp2">
        </div>
        <div class="form-group">
          <label>Hasil Pengawasan</label><br/>
          <?php
          $s1 = ''; $s2 = '';
          if($item['hasil_pengawasan']=="Sesuai") { $s1= "checked"; }
          else { $s2= "checked"; }
          ?>
          <label><input type="radio" name="hasil_pengawasan" value="Sesuai" <?php echo $s1; ?> > Sesuai</label>
          <label style="margin-left:30px;"><input type="radio" name="hasil_pengawasan" value="Tidak Sesuai" <?php echo $s2; ?> > Tidak Sesuai</label>
        </div>
        <div class="form-group">
          <label>Status</label><br/>
          <?php
          $s1 = ''; $s2 = '';
          if($item['status']=="1") { $s1= "checked"; }
          else { $s2= "checked"; }
          ?>
          <label><input type="radio" name="status" value="1" <?php echo $s1; ?> > Publish</label>
          <label style="margin-left:30px;"><input type="radio" name="status" value="0" <?php echo $s2; ?> > Non Publish</label>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea id="editor1" name="keterangan" class="form-control"><?php echo $item['keterangan']?></textarea>
        </div>
      </div> -->
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
                  <input type="text" name="lat" class="form-control gllpLatitude" value="<?php echo $item['lat']?>">
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword1">Longitude</label>
                  <input type="text" name="lng" class="form-control gllpLongitude" value="<?php echo $item['lng']?>">
              </div>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <textarea rows="4" class="form-control" name="alamat"><?php echo $item['alamat']?></textarea>
        </div>
        <div class="form-group">
          <label>Kecamatan*</label>
          <select name="kecamatan" class="form-control" id="kecamatan">
            <option value="">- Pilih -</option>
            <?php
            if($kecamatan->num_rows()>0) {
              foreach ($kecamatan->result() as $rows) {
                $sel = '';
                if($kelurahan['kecamatan_id']==$rows->kecamatan_id) {
                  $sel = 'selected';
                }
                ?>
                <option <?php echo $sel; ?> value="<?php echo $rows->kecamatan_id ?>"><?php echo $rows->kecamatan_nama ?></option>
                <?php
              }
            }
            ?>
          </select>
          <input type="hidden" id="kec" value="<?php echo $kelurahan['kecamatan_id'] ?>">
          <input type="hidden" id="kel" value="<?php echo $item['kelurahan_id'] ?>">
        </div>
        <div class="form-group">
          <label>Kelurahan*</label>
          <select name="kelurahan" class="form-control" id="kelurahan">
            <option value="">- Pilih -</option>
          </select>
        </div>
		<div style="border: 1px solid #ddd; padding: 2px; background-color:#dddddd;  text-align: left; color: black; font-family: Verdana,Arial,Helvetica,Georgia; font-size: 11px; line-height:8px;">	
		<p> </p>
		<p><b><font face="Arial" font size="2px" font color="red">*Contoh Format Penulisan Keterangan</font></b></p>
		<p><b><font face="Arial">Data Lokasi Pengujian Biogas</font></b></p>
		<p><b><font face="Arial">Batas Kota arah Bogor Barat di Darmaga</font></b></p>
		<p><b><font face="Arial">Kelurahan:MARGAJAYA</font></b></p>
		<p><b><font face="Arial">Kecamatan:BOGOR BARAT</font></b></p>
		<p><b><font face="Arial">Isi Keterangan</font></b></p>
      </div>
		<!--<div class="form-group">
          <label>marker color</label>
          
          <input type="text" name="marker-color" value="<?php echo $item['marker-color'] ?>" class="form-control jscolor{hash:true}">
        </div>
		<div class="form-group">
          <label>marker symbol</label>
          <select name="icon" class="form-control" id="icon">
            <option value="<?php echo $item['marker-symbol'] ?>"><?php echo $item['marker-symbol'] ?></option>
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
            <option value="<?php echo $item['marker-size'] ?>"><?php echo $item['marker-size'] ?></option>
       <option value="small">small</option>
        <option value="medium">medium</option>
         <option value="large">large</option>
            
          </select>
        </div> -->
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
<!-- Maps -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/gmaps/css/style.css')?>" />
<script src="<?php echo base_url('assets/gmaps/js/OpenLayers.js')?>"></script>
<script src="<?php echo base_url('assets/gmaps/js/jquery-position-picker.debug.js')?>"></script>
<script src="<?php echo base_url('assets/gmaps/js/jscolor.js')?>"></script>