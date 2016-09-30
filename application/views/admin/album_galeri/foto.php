<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?><small> >> <?php echo "album ".$album['album_title'] ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><?php echo $title ?></li>
    <li class="active">Album <?php echo $album['album_title'] ?></li>
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
?>
<div class="row">
  <div class="col-lg-4">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <strong>Form Galeri</strong>
      </div>
      <div class="box-body">
        <?php echo form_open_multipart('album_galeri/foto?album_id='.$album['album_id'])?>
        <input type="hidden" name="id" value="<?php echo $row['galeri_id'] ?>">
        <input type="hidden" name="album_id" value="<?php echo $this->input->get('album_id') ?>">
        <div class="form-group">
          <label>Pilih Album</label>
          <select name="parent" class="form-control">
            <option value="0">- Nama Album -</option>
            <?php
            if($list->num_rows()>0) {
              foreach ($list->result() as $rows) {
                $sel = '';
                
                ?>
                <option value="<?php echo $rows->album_id ?>" <?php echo $sel; ?>><?php echo $rows->album_title?></option>
                <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Judul Foto*</label>
          <input type="text" name="galeri_title" class="form-control" value="<?php echo $row['galeri_title'] ?>">
          <p class="help-block text-red"><?php echo form_error('galeri_title',' ')?></p>
        </div>
        <div class="form-group">
          <label>Foto</label>
          <input type="file" name="image">
          <?php if($row['image']): ?>
          <p class="help-block"><img src="<?php echo base_url('uploads/galeri/thumb/'.$row['image']) ?>"></p>
        <?php endif;?>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" rows="8" name="description"><?php echo $row['description'] ?></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> Save</button>
          <button class="btn btn-default" type="reset">Reset</button>
        </div>
        <?php echo form_close();?>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
  <div class="col-lg-8">
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Foto</th>
              <th>Judul</th>
              <th>Tanggal Upload</th>
              <th>Tools</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($listview->num_rows()>0) {
              $no = 1;
              foreach ($listview->result() as $rows) {
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><img src="<?php echo base_url('uploads/galeri/thumb/'.$rows->image) ?>"></td>
              <td><?php echo $rows->galeri_title ?></td>
              <td><?php echo $rows->upload_date ?></td>
              <td>
                <a href="<?php echo site_url('album_galeri/foto?album_id='.$rows->album_id.'&id='.$rows->galeri_id)?>" class="btn btn-xs bg-green" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil"></i></a>
                <a href="<?php echo site_url('trash/proses?tabel=galeri&primary='.$rows->galeri_id.'&url=album_galeri/foto?album_id='.$rows->album_id.'&img=uploads/galeri/'.$rows->image)?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Menghapus data ini akan menghapus data posting juga!! Anda yakin??')"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
            <?php
              $no++;
              }
            }
            ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
</section><!-- /.content -->