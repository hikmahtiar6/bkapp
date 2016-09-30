<!DOCTYPE HTML>
</style>
<html>
  <head>
    <link rel="icon" href="<?php echo base_url('assets/css/image/kotabogor.png') ?>">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <title>Login Perizinan Lingkungan</title>
  </head>
  <body>

<div class="section" style="background:#15A531;" >
<div class="container" id="header">
  <div class="row padding-y-10">
    <div class="col-md-9 col-sm-8 col-xs-10">
      <div class="logo clearfix" style="margin:2% 0%;;">
      <?php echo "<img src='".base_url('uploads/logo.png')."' class='img-responsive pull-left'/>"; ?>
      </div>
    </div>
  </div>
</div>
</div>

<div class="section" style="background:#f4f4f4">
  <div class="container" align="center" >
    <h4><b>Login Perizinan Lingkungan</b></h4>
  </div>

<!-- LOGIN -->
<form method="POST" action="<?php echo site_url('login_daftar_member/login')?>">
  <div class="col-sm-5" style="background:#f4f4f4; margin-top:5%; margin-left:29%;padding:5%;" align="center">
      <table class="table">
          <tr>
            <td><label>Email</label></td>
            <td>:</td>
            <td><input type="text" placeholder="Email" name="email" class="form-control"></td>
          </tr>
          <tr>
            <td><label>Password</label></td>
            <td>:</td>
            <td><input type="password" placeholder="Password" name="password" class="form-control"></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>
                <input type="submit" value="Login" name="login" class="btn btn-success"> 
                <medium>atau <a data-toggle="modal" data-target="#myModal">Mendaftar</a></medium>
            </td>
          </tr>
      </table> 
    </div>
  </div>
</form>
<!-- END LOGIN -->

<!-- MODAL -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <form method="POST" action="<?php echo site_url('login_daftar_member/daftar')?>" enctype="multipart/form-data">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Mendaftar</b></h4>
        </div>
        <div class="modal-body">
         
  <!-- DAFTAR -->
        
          <div>
            <table border="0" class="table">
              <tr>
                <td><label>Nama Lengkap</label></td>
                <td>:</td>
                <td><input type="text" placeholder="Nama Lengkap" name="nama" class="form-control"></td>
              </tr>
              <tr>
                <td><label>Alamat</label></td>
                <td>:</td>
                <td><textarea placeholder="Alamat" name="alamat" class="form-control"></textarea></td>
              </tr>
              <tr>
                <td><label>NIK</label></td>
                <td>:</td>
                <td><input type="number" placeholder="NIK" name="nik" class="form-control"></td>
              </tr>
              <tr>
                <td><label>Email</label></td>
                <td>:</td>
                <td><input type="text" placeholder="Email" name="email" class="form-control"></td>
              </tr>
              <tr>
                <td><label>Password</label></td>
                <td>:</td>
                <td><input type="password" placeholder="password" name="password" class="form-control"><span>*ket : password isi bebas, dan harap diingat !</span></td>
              </tr>
              <tr>
                <td><label>Image KTP</label></td>
                <td>:</td>
                <td><input type="file" placeholder="Image KTP" name="image_ktp" class="form-control"></td>
              </tr>
            </table>
          </div>
        
  <!-- END DAFTAR -->

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="daftar">Daftar</button>
        </div>
      </div>
      </form> 
    </div>
  </div>
<!-- END MODAL -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>
 
        