<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Halaman Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
          <a href="#"><b>Admin</b>istrator</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <?php if(!$this->session->flashdata('error')) {?>
        <p class="login-box-msg">Sign in to start your session Administrator</p>
        <?php } else {?>
        <p class="help-block label-danger" style="padding:5px;"><span class="pull-right glyphicon glyphicon-exclamation-sign"></span> <?php echo $this->session->flashdata('error') ?></p>
        <?php } ?>
        <form action="<?php echo site_url('loginweb/go')?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required autocomplete="off"/>
            
            <p class="help-block label-danger"><b><?php echo form_error('username')?></b></p>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required/>
            
      <p class="help-block label-danger"><b><?php echo form_error('password')?></b></p>
          </div>
          <div class="row">
            <div class="col-xs-8">                 
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
      <div class="text-center" style="padding-top:5px;">
        <p>- CopyRight &copy; 2015. All Right Recevied. -</p>
      </div><!-- /.social-auth-links -->
    </div><!-- /.login-box -->

  </body>
</html>