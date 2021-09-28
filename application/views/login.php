<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>resources/dist/img/logos/logo_pf.png" />
    <title> Pf Transporte | Login </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/iCheck/square/blue.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/dist/css/Style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo site_url();?>"> <img class="login-img" src="<?php echo base_url(); ?>resources/dist/img/logos/logo_pf_alimentos_3.png"/> </a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Ingrese sus credenciales para iniciar sesión</p>        
            <div id='loginError' class="alert alert-danger hidden" role="alert">

            </div>
            <div id="fg_rut" class="form-group has-feedback">
                <label>Usuario:</label>
                <input id="user" autocomplete="off" type="text" maxlength="15" name="user" class="form-control" placeholder="Nombre usuario">
            </div>
                <!--
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>-->
                <div class="form-group has-feedback">
                    <label>Contraseña:</label>
                    <input type="password" class="form-control" placeholder="Contraseña" id="pass" name="pass">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                
                <div class="row">                                                    
                    <div class="col-sm-12">
                        <a id="btIngresar" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</a>
                    </div>       
                </div>
                <!--<a href="#">Olvidé mi contraseña</a><br>-->
            </div>


        </div>

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url(); ?>resources/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url(); ?>resources/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="<?php echo base_url(); ?>resources/plugins/iCheck/icheck.min.js"></script>

        <script src="<?php echo base_url(); ?>resources/plugins/jquery.rut.js"></script>

        <script>
          $(function () {
            $('input').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
  });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#user').on('change keyup paste', function(e){
                if($('#input_rut').val().length >= 15)
                {
                    var result = $.validateRut($('#input_rut').val(), null, { minimumLength: 15 });

                    $('#fg_rut').removeClass('has-error');
                    $('#fg_rut').removeClass('has-success');
                    $('#search_btn').attr("disabled", true);

                    if(!result)
                    {
                        $('#fg_rut').addClass('has-error');
                    }
                    else
                    {
                        $('#fg_rut').addClass('has-success');
                        $('#search_btn').attr("disabled", false);
                    }
                }
                else
                {
                    $('#fg_rut').removeClass('has-error');
                    $('#fg_rut').removeClass('has-success');
                    $('#search_btn').attr("disabled", true);
                }
            });


            $('#btIngresar').click(function(e){
                login(); 
            });

            $('#pass').on('keypress',function(e){
                if(e.which == 13) {
                   login();
                }
            })

        });

        function login(){
             //e.preventDefault();
             $('#loginError').removeClass('show');              
             $('#loginError').addClass('hidden');
             var user=$('#user').val();
             var pass=$('#pass').val();
             if(user=='' || pass==''){
                $('#loginError').removeClass('hidden');
                $('#loginError').html('Ingrese datos solicitados').focus();
                $('#loginError').addClass('show');
                    //loginError
                }else{
                  $.post('<?php echo site_url().'/login'?>', {user:user,pass:pass}, function(data, textStatus, xhr) {
                      if(data.status!=false){
                          if(data.status==true){
                             window.location='<?php echo site_url().'/index'?>';
                         }
                     }else{                            
                        $('#loginError').removeClass('hidden');
                        $('#loginError').html('Usuario no registrado o sin permisos, verifique sus datos').focus();
                        $('#loginError').addClass('show');
                    }
                },'json');
              }
          }

      </script>

  </body>
  </html>