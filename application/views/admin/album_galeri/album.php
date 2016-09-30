<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
?>
<div class="row">
  <div class="col-lg-4">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <strong>Form Album</strong>
      </div>
      <div class="box-body">
        <?php echo form_open('album_galeri/index')?>
        <input type="hidden" name="id" value="<?php echo $row['album_id'] ?>">
        <div class="form-group">
          <label>Album Title</label>
          <input type="text" name="album_title" class="form-control" value="<?php echo $row['album_title'] ?>">
          <p class="help-block text-red"><?php echo form_error('album_title',' ')?></p>
        </div>
         <div class="form-group">
          <label>Parent</label>
          <select name="parent" class="form-control">
            <option value="0">- Parent Album -</option>
            <?php
            if($listview->num_rows()>0) {
              foreach ($listview->result() as $rows) {
                $sel = '';
                if($rows->album_id==$row['parent']) {
                  $sel = 'selected';
                }
                ?>
                <option value="<?php echo $rows->album_id ?>" <?php echo $sel; ?>><?php echo $rows->album_title?></option>
                <?php
              }
            }
            ?>
          </select>
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
              <th>Album title</th>
              <th>Parent</th>
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
              <td><?php echo $rows->album_title ?></td>
              <td><?php echo album_parent($rows->parent); ?></td>
              <td>
                <a href="<?php echo site_url('album_galeri/index/'.$rows->album_id)?>" class="btn btn-xs bg-green" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil"></i></a>
                <a href="<?php echo site_url('trash/proses?tabel=album&primary='.$rows->album_id.'&url=album_galeri')?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Menghapus data ini akan menghapus data posting juga!! Anda yakin??')"><i class="fa fa-trash-o"></i></a>
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