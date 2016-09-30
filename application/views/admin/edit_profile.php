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
<div class="row">
  <div class="col-lg-4">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <strong>Form Pengguna</strong>
      </div>
      <div class="box-body">
        <?php echo form_open('adminweb/edit_profile')?>
        <input type="hidden" name="id" value="<?php echo $row['user_id'] ?>">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="user_name" class="form-control" value="<?php echo $row['user_name'] ?>">
          <p class="help-block text-red"><?php echo form_error('user_name',' ')?></p>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>">
          <p class="help-block text-red"><?php echo form_error('username',' ')?></p>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" >
          <p class="help-block text-blue">*isi jika ingin dirubah</p>
        </div>
        <div class="form-group">
          <label>Level</label>
          <select name="level" class="form-control">
            <?php
            foreach ($level as $no => $nm) {
              $sel = '';
              if($row['level']==$no) {
                $sel = 'selected';
              }
              echo "<option value='".$no."' ".$sel.">". $nm."</option>";
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
</div>
</section>