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


echo form_open_multipart('adm_sumur_resapan/edit');
echo form_hidden('id',$item['sumur_resapan_id']);
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_sumur_resapan')?>" class="btn btn-sm bg-grey">Kembali</a>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
          <label>Tahun Pengamatan*</label>
          <input type="text" name="tahun_pengamatan" value="<?php echo $item['tahun_pengamatan']?>" class="form-control" id="dp2">
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea id="editor1" name="keterangan" class="form-control"><?php echo $item['description']?></textarea>
        </div>
        <div class="form-group">
          <label>Alamat*</label>
          <textarea class="form-control" rows="4dp" name="alamat"><?php echo $item['alamat']?></textarea>
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
                  <input type="text" name="lat" class="form-control gllpLatitude" value="<?php echo $item['lat']?>">
              </div>

              <div class="form-group">
                  <label for="exampleInputPassword1">Longitude</label>
                  <input type="text" name="lng" class="form-control gllpLongitude" value="<?php echo $item['lng']?>">
              </div>
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
        <div class="form-group">
          <label>foto</label>
          <input type="file" name="foto">
        </div>
        <hr/>
        <?php
        if($item['foto']!='') {
          echo "<img src='".base_url('uploads/ragamdata/konservasi/sumur_resapan/thumb/'.$item['foto'])."' />";
        }
        ?>
		<div class="form-group">
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
<script src="<?php echo base_url('assets/gmaps/js/jquery-position-picker.debug.js')?>"></script><script src="<?php echo base_url('assets/gmaps/js/jscolor.js')?>"></script>