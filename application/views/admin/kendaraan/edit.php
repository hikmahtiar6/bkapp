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


echo form_open_multipart('adm_kendaraan/edit_lokasiuji');
echo form_hidden('id',$row['lokasiuji_kendaraan_id']);
?>
<div class="box">
</div>
<div class="row">

  <div class="col-md-6">
    <div class="box">
      <div class="box-body">        
        <div class="form-group">
          <label>Nama Lokasi*</label>
          <input type="text" name="nama_lokasi" value="<?php echo $row['nama_lokasi']?>" class="form-control">
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
          <input type="hidden" id="kel" value="<?php echo $row['kelurahan_id'] ?>">
        </div>
        <div class="form-group">
          <label>Kelurahan*</label>
          <select name="kelurahan_id" class="form-control" id="kelurahan">
            <option value="">- Pilih -</option>
          </select>
        </div>

        <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-sm btn-default"> Reset</button>
        <a href="<?php echo site_url('adm_kendaraan/lokasiuji')?>" class="btn btn-sm bg-grey">Kembali</a>
      </div>
    </div>
  </div>

  
</div>
</form>
</section><!-- /.content -->