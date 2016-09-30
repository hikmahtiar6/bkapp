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
        <strong>Form Kategori</strong>
      </div>
      <div class="box-body">
        <?php echo form_open('category/index')?>
        <input type="hidden" name="id" value="<?php echo $row['category_id'] ?>">
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" name="category_name" class="form-control" value="<?php echo $row['category_name'] ?>">
          <p class="help-block text-red"><?php echo form_error('category_name',' ')?></p>
        </div>
         <div class="form-group">
          <label>Induk</label>
          <select name="parent" class="form-control">
            <option value="0">- Induk Kategori -</option>
            <?php
            if($listview->num_rows()>0) {
              foreach ($listview->result() as $rows) {
                $sel = '';
                if($rows->category_id==$row['parent']) {
                  $sel = 'selected';
                }
                ?>
                <option value="<?php echo $rows->category_id ?>" <?php echo $sel; ?>><?php echo $rows->category_name?></option>
                <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Tipe</label>
          <select name="type" class="form-control">
            <?php
            foreach ($type as $no => $nm) {
              $sel = '';
              if($row['type']==$no) {
                $sel = 'selected';
              }
              echo "<option value='".$no."' ".$sel.">". $nm."</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Warna Background</label>
          <select name="color" class="form-control">
            <?php
            foreach ($color as $no => $nm) {
              $sel = '';
              if($row['color']==$no) {
                $sel = 'selected';
              }
              echo "<option value='".$no."' ".$sel.">". $nm."</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Urutan</label>
          <input type="text" name="sort" class="form-control" value="<?php echo $row['sort'] ?>">
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
              <th>Nama Kategori</th>
              <th>Induk</th>
              <th>Tipe</th>
              <th>Warna</th>
              <th>Urutan</th>
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
              <td><?php echo $rows->category_name ?></td>
              <td><?php echo category_parent($rows->parent); ?></td>
              <td><?php echo $type[$rows->type] ?></td>
              <td><?php echo $color[$rows->color] ?></td>
              <td><?php echo $rows->sort ?></td>
              <td>
                <a href="<?php echo site_url('category/index/'.$rows->category_id)?>" class="btn btn-xs bg-green" data-toggle="tooltip" title="Edit Data"><i class="fa fa-pencil"></i></a>
                <a href="<?php echo site_url('trash/proses?tabel=category&primary='.$rows->category_id.'&url=category')?>" class="btn btn-xs bg-red" data-toggle="tooltip" title="Hapus Data" onclick="return confirm('Menghapus data ini akan menghapus data posting juga!! Anda yakin??')"><i class="fa fa-trash-o"></i></a>
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