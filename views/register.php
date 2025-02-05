<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <!-- Favicons -->
    <link href="<?= base_url(); ?>assets/front-end/img/black-logo.png" rel="icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url(); ?>"><b style="color:#d30000;">Dealer Motor Yamaha</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Please fill in your data !</p>
            
            <form action="<?=base_url('auth/register');?>" method="post" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Fullname" name="fullname"
                        value="<?=set_value('fullname');?>">
                        <span class="input-group-text form-control-feedback"><i class="bi bi-person-fill"></i></span>
                    <small class="text-red"><?=form_error('fullname');?></small>
                </div>
                <div class="form-group has-feedback">
                    <input type="number" class="form-control" placeholder="Nomor Telepon" name="telp"
                        value="<?=set_value('telp');?>">
                        <span class="input-group-text form-control-feedback"><i class="bi bi-telephone-fill"></i></i></span>
                    <small class="text-red"><?=form_error('telp');?></small>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username"
                        value="<?=set_value('username');?>">
                        <span class="input-group-text form-control-feedback"><i class="bi bi-person-fill"></i></i></i></span>
                    <small class="text-red"><?=form_error('username');?></small>
                </div>
                <div class="form-group has-feedback">
                    <input type="file" class="form-control" name="user_gambar">
                        <span class="input-group-text form-control-feedback"><i class="bi bi-card-image"></i></i></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password1">
                    <span class="input-group-text form-control-feedback"><i class="bi bi-lock-fill"></i></span>
                    <small class="text-red"><?=form_error('password1');?></small>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Confirm password" name="password2">
                    <span class="input-group-text form-control-feedback"><i class="bi bi-lock-fill"></i></span>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat mb-5">Register</button>
            </form>

            <!-- <a href="#">I forgot my password ?</a><br> -->
            Already account ?<a href="<?=base_url('auth');?>" class="text-center"> Login here</a>
            <br>
            <a href="<?=base_url();?>">Back to website</a><br>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>



</html>
