<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
    <small>konfigurasi situs</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Pengaturan Web</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php
  if($this->session->flashdata('error')) {
    echo '
      <div class="alert alert-danger">
        <p>'.$this->session->flashdata('error').'</p>
      </div>
    ';
  }
  ?>
  <!-- Default box -->
  <div class="box">
    <?php echo form_open_multipart('konfig/index') ?>
    <div class="box-body">
      <h4 class="konfig-judul">Pengaturan Umum</h4>
      <div class="row">
        <div class="col-md-3 text-right">Nama</div>
        <div class="col-md-5 form-group"><input type="text" name="name_site" class="form-control" value="<?php echo $web['name_site']?>"></div>
      </div>
      <div class="row">
        <div class="col-md-3 text-right">Sub Title</div>
        <div class="col-md-5 form-group"><input type="text" name="sub_title" class="form-control" value="<?php echo $web['sub_title']?>"></div>
      </div>
      <div class="row">
        <div class="col-md-3 text-right">Tentang</div>
        <div class="col-md-5 form-group"><textarea name="description_site" rows="5" class="form-control" placeholder="Your description...."><?php echo $web['description_site']?></textarea></div>
      </div>
      <div class="row">
        <div class="col-md-3 text-right"></div>
        <div class="col-md-5 form-group">
          <img src="<?php echo base_url('uploads/'.$web['icon_site'])?>" class="img-thumbnail img-responsive">
          <p class="help-block">*Format logo JPG/GIF/PNG. Max Size 2MB</p>
          <input type="file" name="icon_site" class="">
        </div>
      </div>
      <h4 class="konfig-judul">Pengaturan Kontak</h4>
      <div class="row">
        <div class="col-md-3 text-right">Alamat</div>
        <div class="col-md-5 form-group"><textarea name="alamat" rows="5" class="form-control" placeholder="Alamat.."><?php echo $web['alamat']?></textarea></div>
      </div>
      <div class="row">
        <div class="col-md-3 text-right">No Telepon</div>
        <div class="col-md-3 form-group"><input type="text" name="no_telp" class="form-control" value="<?php echo $web['no_telp']?>"></div>
      </div>
      <div class="row">
        <div class="col-md-3 text-right">Email</div>
        <div class="col-md-5 form-group"><input type="text" name="mail_site" class="form-control" value="<?php echo $web['mail_site']?>"></div>
      </div>
      <div class="row">
        <div class="col-md-3 text-right">Embed Map</div>
        <div class="col-md-5 form-group"><textarea name="embed_map" rows="5" class="form-control" placeholder="Embed Map.."><?php echo $web['embed_map']?></textarea></div>
      </div>
      <h4 class="konfig-judul">Lain -lain</h4>
      <div class="row">
        <div class="col-md-3 text-right">Konten Sambutan</div>
        <div class="col-md-5 form-group">
          <select name="sambutan" class="form-control">
            <option value="">- Pilih -</option>
            <?php
            if($sambutan->num_rows()>0) {
              foreach ($sambutan->result() as $rows) {
                $sel = '';
                if($rows->post_id==$web['sambutan']) {
                  $sel = 'selected';
                }
                ?>
                <option value="<?php echo $rows->post_id ?>" <?php echo $sel ?> ><?php echo $rows->title ?></option>
                <?php
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 text-right">Facebook</div>
        <div class="col-md-5 form-group"><input type="text" name="fb_site" class="form-control" value="<?php echo $web['fb_site']?>"></div>
        <div class="help-block">*masukan alamat facebook page anda disini.<br>(http://facebook.com/page.anda)</div>
      </div>
      <div class="row">
        <div class="col-md-3 text-right">Twitter</div>
        <div class="col-md-5 form-group"><input type="text" name="twitter_site" class="form-control" value="<?php echo $web['twitter_site']?>"></div>
        <div class="help-block">*masukan alamat twitter page anda disini.<br>(http://twitter.com/page.anda)</div>
      </div>
      
    </div><!-- /.box-body -->
    <div class="box-footer text-right">
      <button class="btn btn-info"><i class="fa fa-save"></i> Update Pengaturan</button>
    </div>
    <?php echo form_close() ?>
  </div><!-- /.box -->

</section><!-- /.content -->