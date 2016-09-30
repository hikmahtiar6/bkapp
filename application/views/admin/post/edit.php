<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="#">Contents</a></li>
    <li><?php echo $title ?></li>
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


echo form_open_multipart('post/update?tipe='.$tp.'&id='.$id);
?>
<div class="box">
  <div class="box-header text-right">
      <button type="submit" class="btn btn-sm bg-orange"><i class="fa fa-save"></i> Save</button>
      <button type="reset" class="btn btn-sm btn-default"> Reset</button>
      <a href="<?php echo site_url('post/category/'.$tp)?>" class="btn btn-sm bg-grey">Back</a>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
          <label>Judul*</label>
          <input type="hidden" name="tipe" value ="<?php echo $tp ?>" class="form-control">
          <input type="hidden" name="id" value="<?php echo $row['post_id'] ?>" class="form-control">
          <input type="text" name="title" value="<?php echo $row['title'] ?>" class="form-control">
          <p class="help-block text-red"><?php echo form_error('title', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Konten*</label>
          <textarea id="editor1" name="body" class="form-control"><?php echo $row['body'] ?></textarea>
          <p class="help-block text-red"><?php echo form_error('body', ' ')?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="box">
      <div class="box-body">
        <div class="form-group">
          <label>Kategori*</label>
          <select name="category" class="form-control">
            <option value="">- Pilih -</option>
            <?php
            if($listview->num_rows()>0) {
              foreach ($listview->result() as $rows) {
                $sel = '';
                if($rows->category_id==$row['category_id']) {
                  $sel = 'selected';
                }
                ?>
                <option value="<?php echo $rows->category_id ?>" <?php echo $sel ?> ><?php echo $rows->category_name?></option>
                <?php
              }
            }
            ?>
          </select>
          <p class="help-block text-red"><?php echo form_error('category', ' ')?></p>
        </div>
        <div class="form-group">
          <label>Gambar</label>
          <input type="file" name="image">
          <p class="help-block"><?php echo $row['image'] ?></p>
        </div>
        <hr>
        <div class="form-group">
          <label>Publish <input type="checkbox" name="status" value="1" <?php if($row['status']==1){ echo "checked"; } ?>></label>
        </div>
        <div class="form-group">
          <label>Tanggal Publish</label>
          <input type="text" name="date_publish" value="<?php echo $row['date_publish'] ?>" class="form-control" id="dp2">
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
filebrowserWindowHeight : '400'});</script>