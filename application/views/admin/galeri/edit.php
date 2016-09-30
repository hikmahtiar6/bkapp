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


echo form_open_multipart('adm_galeri/edit');
echo form_hidden('id',$item['galeri_id']);
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Simpan</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('adm_galeri')?>" class="btn btn-sm bg-grey">Kembali</a>
  </div>
</div>
<div class="row">
  <div class="col-md-7">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
          <label>Judul Foto*</label>
          <input type="text" name="galeri_title" value="<?php echo $item['galeri_title'] ?>" class="form-control">
        </div>
        <div class="form-group">
          <label>Pilih Album</label>
          <select name="parent" class="form-control">
            <option value="0">- Parent Album -</option>
            <?php
            if($listview->num_rows()>0) {
              foreach ($listview->result() as $rows) {
                $sel = '';
                $nama_tipe = '';
                if($item['album_id']==$rows->album_id){
                    $sel ="selected";
                }
                ?>
                <option <?php echo $sel ?> value="<?php echo $rows->album_id ?>"><?php echo $rows->album_title ?></option>
                <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Tipe Galeri</label><br/>
          <select name="type" id="tipeGaleri" class="form-control">
            
            <?php
              if($item['tipe']=='Foto'){
                  echo '<option value="pilih">- Pilih -</option>';
                  echo '<option selected value="Foto">Foto</option>';
                  // echo '<option value="Video">Video</option>'; 
              }
            ?>
          </select>
        </div>
       <!-- <div class="form-group">
          <label>URL Youtube</label>
          <?php
          // if ($item['tipe']=='Video') {
          //   echo '<textarea class="form-control" rows="2" name="youtube" id="video"> '.$item["image"].'</textarea>';
          // }
          // else {
          //    echo '<textarea class="form-control" rows="2" name="youtube" id="video"></textarea>';
          // }
          ?>
          
       </div> -->
        <div class="form-group">
          <label>foto</label>
          <input type="file" name="image" id="foto">
        </div>
        <hr/>
        <?php
        if($item['image']!='') {
          if($item['tipe']=='Foto'){
             echo "<img src='".base_url('uploads/galeri/thumb/'.$item['image'])."' />";
          }
         
        }
        ?>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" rows="5" name="description"><?php echo $item['description']?></textarea>
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