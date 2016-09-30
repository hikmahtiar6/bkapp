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


echo form_open_multipart('adm_hutan/edit');
echo form_hidden('id', $item['hutan_kota_id']);
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
          <input type="text" name="nama_lokasi" value="<?php echo $item['nama_lokasi'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('nama_lokasi', ' ')?></p>
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
          <label>Tanggal Pendataan*</label>
          <input type="text" name="tahun_pendataan" value="<?php echo $item['tahun_pendataan']?>" class="form-control" id="dp2">
        </div>
        <div class="form-group">
          <label>foto</label>
          <input type="file" name="foto">
        </div>
        <hr/>
        <?php
        if($item['foto']!='') {
          echo "<img src='".base_url('uploads/ragamdata/hutan/thumb/'.$item['foto'])."' />";
        }
        ?>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea id="editor1" name="keterangan" class="form-control"><?php echo $item['keterangan']?></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header">
        *Gambar map jika ingin merubah area yang ada <a onclick="window.open('<?php echo site_url("adm_hutan/view_map/".$item['hutan_kota_id'])?>', 'Tampilkan Map', 'height=450,width=520,top=100,left=480')" href="#">Tampilkan map</a>
      </div>
      <div class="box-body">
        <div id="petak"></div>
        <input type="hidden" id="kordinat" name="area" value="<?php echo $item['area']?>" />
        <div class="form-group">
          <label>Luasan</label>
          <input type="text" name="luasan" value="<?php echo $item['luasan']?>" class="form-control">
        </div>
        <div class="form-group">
          <label>Jenis Tanaman</label>
          <input type="text" name="jenis_tanaman" value="<?php echo $item['jenis_tanaman']?>" class="form-control">
        </div>
        <div class="form-group">
          <label>Warna Layer</label>
          <input type="text" name="warna" value="<?php echo $item['warna']?>" class="form-control">
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