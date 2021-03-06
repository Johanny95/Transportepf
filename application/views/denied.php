<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>resources/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>resources/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="http://intranet:8001/portal/"><b>PF</b>Alimentos</a>
  </div >
  <!-- START LOCK SCREEN ITEM -->
  <div class="wrapper" style="position: relative;width: 100%">
    <div>
      <img class="img-responsive" src="<?php echo base_url();?>resources/dist/img/logos/logo_pf_alimentos.png">
    </div>
  </div>
  <br>
  <br>
  <div class="text-center">
    <a href="http://intranet:8001/portal/" class="btn bg-gray">Redirecciones al intranet</a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2016-2017 <b><a href="https://www.pfalimentos.cl/" class="text-black">PF Alimentos</a></b><br>
    Todos los derecho reservados
  </div>
</div>
<!-- /.center -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()?>resources/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>resources/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

