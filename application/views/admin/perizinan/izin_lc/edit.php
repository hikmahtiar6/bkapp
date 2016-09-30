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


echo form_open_multipart('adm_izin_lc/edit/'.$item['izin_lc_id']);
echo form_hidden('id',$item['izin_lc_id']);
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_izin_lc')?>" class="btn btn-sm bg-grey">Kembali</a>
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
      </div>
    </div>
  </div>

  <div class="col-md-5">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
            <label for="exampleInputPassword1">Debit Air</label>
            <input type="text" name="debit" class="form-control" value="<?php echo $item['debit']?>">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Sungai</label>
            <input type="text" name="sungai" class="form-control" value="<?php echo $item['sungai']?>">
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
      </div>
    </div>
  </div>
</div>
</form>
</section><!-- /.content -->
