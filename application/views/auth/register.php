<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="<?php echo base_url() ?>index.php/auth/reg_action" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" set_value="<?php set_value('nama')?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="email" class="form-control" placeholder="Email" set_value="<?php set_value('email')?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="repassword" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php echo form_error('repassword', '<small class="text-danger pl-3">', '</small>');?>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="nip" class="form-control" placeholder="NIP" set_value="<?php set_value('nip')?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <?php echo form_error('nip', '<small class="text-danger pl-3">', '</small>');?>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="instansi" class="form-control" placeholder="Instansi" set_value="<?php set_value('instansi')?>">
        <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
        <?php echo form_error('instansi', '<small class="text-danger pl-3">', '</small>');?>
      </div>

      
      <!-- <div class="form-group has-feedback">
        <input type="text" name="tgl_tempat" class="form-control" placeholder="Tanggal Penempatan">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> -->

      <div class="form-group has-feedback">

      <!-- <div class="input-group date"> -->

        <input type="text" name="tgl_tempat" class="form-control" id="datepicker" placeholder="Tanggal Penempatan" set_value="<?php set_value('tgl_tempat')?>">
        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
        <?php echo form_error('tgl_tempat', '<small class="text-danger pl-3">', '</small>');?>
      <!-- </div> -->
      <!-- /.input group -->

      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="register" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <a href="<?php echo base_url('index.php/auth/login') ?>" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>


<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });


</script>
</body>
</html>
