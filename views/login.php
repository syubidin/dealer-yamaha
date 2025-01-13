<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <!-- Favicons -->
    <link rel="icon" href="<?= base_url('assets/logo-ridezone.png') ?>" type="image/x-icon">
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
            <img src="<?=base_url('assets/logo-ridezone.png'); ?>"alt="logo" width="250" height="200px" class="shadow-light rounded-circle">
                <div>
                    <b style="color:#d30000;">Dealer Motor Yamaha</b>
                </div>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <?=$this->session->flashdata('msg');?>
            <p class="login-box-msg">Please enter your username and password !</p>
			

            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <span class="input-group-text form-control-feedback"><i class="bi bi-envelope-at-fill"></i></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <a href="<?=base_url('auth/forgot_password');?>" class="text-decoration-none">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
            </form>

            Not ready account ?<a href="<?=base_url('auth/register');?>" class="text-center"> Register here</a>
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
