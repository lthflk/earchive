<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/bootstrap.min.css') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('/public/css/login.css') ?>" />
    <link href="<?php echo base_url('/public/logoatas.png') ?>" rel="icon" />
</head>
<body>

<div class="container" id=logindiv>
    <div class="row">
        <div class="container" id="formContainer">

          <form class="form-signin" id="login" role="form" method="post" action="<?php echo site_url('/home/gologin'); ?>">
          <p align="center"><img src="<?php echo base_url("/public/logokab.png");?>" class="img-responsive"></p>
            <h5 class="form-signin-heading"><p align="center">
            Masukkan username dan password anda</p></h5>
            <?php
            if($this->session->flashdata('erorlogin')) {
                echo "<div style=\"color:red; text-align:center;\">".$this->session->flashdata('erorlogin')."</div>";
            }
            ?>
            <input type="hidden" name="previous" value="<?php echo (isset($previous)?$previous:"") ?>">
            <input type="text" class="form-control" name="username" id="loginEmail" placeholder="username" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')" autofocus>
            <input type="password" class="form-control" name="password" id="loginPass" placeholder="sandi" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <br><p align="center">WEBSITE PEMERINTAH KABUPATEN BENGKALIS</p>
          </form>

        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/js/jquery-2.2.2.min.js')?>"></script>
<script src="<?php echo base_url('/public/js/bootstrap.min.js')?>"></script>
</body>
</html>