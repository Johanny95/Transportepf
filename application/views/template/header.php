<?php $user=$this->session->userdata('usuario');?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  

  <link rel="icon" type="image/png" href="<?php echo base_url() ?>resources/dist/img/logos/logo_pf.png" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<link rel="shortcut icon" href="<?php echo base_url() ?>resources/dist/img/logos/icono.gif" type="image/gif">-->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/dist/css/AdminLTE.min.css">

  <!--SELECT BOOTSTRAP-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bootstrap/bootstrap-selected/bootstrap-select.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>resources/dist/css/skins/_all-skins.min.css">

      <link rel="stylesheet" href="<?php echo base_url(); ?>resources/dist/css/Style.css">

      <!-- TagsInput -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/tagsinput/src/bootstrap-tagsinput.css">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font --><!-- 
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

    <link rel="stylesheet"
    href="<?php echo base_url('resources/externo/googlecss.css') ?>">
    <!--- JS -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>resources/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
    <script src="<?php echo base_url('resources/externo/jquery-ui.min.js') ?>"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>resources/bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url(); ?>resources/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url(); ?>resources/bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url(); ?>resources/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url(); ?>resources/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- Bootstrap File Upload -->
    <link src="<?php echo base_url(); ?>resources/plugins/bootstrap-fileinput/css/fileinput.min.css">

    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>resources/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url(); ?>resources/plugins/iCheck/icheck.min.js"></script>

    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>resources/bower_components/fastclick/lib/fastclick.js"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>resources/dist/js/adminlte.min.js"></script>
    <!-- Bootstrap File Upload -->
    <script src="<?php echo base_url(); ?>resources/plugins/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/bootstrap-fileinput/js/plugins/sortable.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/bootstrap-fileinput/js/plugins/purify.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/bootstrap-fileinput/js/locales/es.js"></script>
    <!-- Ajax file upload -->
    <script src="<?php echo base_url(); ?>resources/plugins/ajaxfileupload/jquery.ajaxfileupload.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>resources/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap  -->
    <script src="<?php echo base_url(); ?>resources/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!--GENERADOR DE RAR-->
    <script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/jszip.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>resources/bootstrap/js/FileSaver.js"></script>
    
    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>resources/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url(); ?>resources/bower_components/Chart.js/Chart.js"></script>

    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>resources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/buttons.bootstrap.min.js"></script>

    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script> -->

    <script src="<?php echo base_url('resources/externo/jszip.min.js') ?>"></script>
    <script src="<?php echo base_url('resources/externo/pdfmake.min.js') ?>"></script>
    <script src="<?php echo base_url('resources/externo/vfs_fonts.js') ?>"></script>

    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/datatables/extensions/bootstrap_extensions/js/buttons.colVis.min.js"></script>
    <!-- Pace -->
    <script src="<?php echo base_url(); ?>resources/plugins/pace/pace.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/pace/pace.min.css">

    <!-- fancybox -->

<link rel="stylesheet" href="<?php echo base_url(); ?>resources/externo/jquery.fancybox.min.css">
   <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">-->
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>-->

    <script src="<?php echo base_url('resources/externo/jquery.fancybox.min.js') ?>"></script>

    <!-- JGallery -->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>resources/dist/js/pages/dashboard2.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>resources/dist/js/demo.js"></script>
    
    <!--notificaciones-->
    <script src="<?php echo base_url(); ?>resources/bootstrap/notefy/bootstrap-notify.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>resources/bootstrap/notefy/animate.css">
    <!--JS SELECT BOOTSTRAP MULTIPLE-->
    <script src="<?php echo base_url(); ?>resources/bootstrap/bootstrap-selected/bootstrap-select.js"></script>
    <!--MORRIS.JS GRAFICOS-->
    <script src="<?php echo base_url(); ?>resources/bower_components/morris.js/morris.min.js"></script>
    <!--RAPHAEL GRAFICOS-->
    <script src="<?php echo base_url(); ?>resources/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/plugins/blockui/jquery.blockUI.js"></script>
    <!--Mis funciones-->
    <script src="<?php echo base_url(); ?>resources/funciones/misFunciones.js"></script>

    <meta name="author" content="Johanny Adonis Lopez Mendez">
    <style>
    @media only screen and (min-width : 1224px) {

      #img1{
        height:500px !important;
        width :1200px !important ;
      }
      .camionIMG{
        height: 200px !important;
        width :300px !important ;
      }
      .camionIMG-mantenedor{
       height: 80px !important;
       width : 100px !important ; 
     }

     .btn-circle {
       border-radius: 50%;
     }
     
     .vcenter {
      display: inline-block;
      vertical-align: middle;
      float: none;
    }
    .negrita{
      font-weight: bold !important;
    }
    .camionIMG:hover {
      opacity: 0.5;
      filter: alpha(opacity=50); /* For IE8 and earlier */
    }
    .camionIMG-mantenedor:hover {
      opacity: 0.5;
      filter: alpha(opacity=50); /* For IE8 and earlier */
    }
    #img2{
      height:500px !important;
      width :1200px !important ;
    }
    .btn-file {
      position: relative;
      overflow: hidden;
    }
    .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      filter: alpha(opacity=0);
      opacity: 0;
      outline: none;
      background: white;
      cursor: inherit;
      display: block;
    }
  }
</style>


<script type="text/javascript">
  function pf_notify(titulo,mensaje,tipo){
    var icon;
    if(tipo=='success'){
      icon='fa fa-check';  
    }else if(tipo=='danger'){
      icon='fa fa-ban';
    }else if(tipo=='warning'){
      icon='fa fa-warning';
    }else if(tipo=='info'){
      icon='fa fa-info-circle';
    }
    $.notify(
      { icon:icon,
      title: "<strong>"+titulo+"</strong> <br/>",
      message: mensaje
    },{
      type: tipo,
      showProgressbar: false,
      placement: {
        from: "bottom",
        align: "right"
      },
      delay: 3000,
      timer: 2000,
      z_index:9999,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      }
    }); 
  }

  function pf_blockUI(){
      $.blockUI({
          css: {
              border: 'none',
              padding: '15px',
              backgroundColor: '#000','-webkit-border-radius': '10px','-moz-border-radius': '10px',
              opacity: .5,
              color: '#fff',
              zIndex: 20000
          },
          message: '<h1><i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Espere por favor...</h1>'
      });
  };

  function pf_unblockUI(){
      $.unblockUI();
  };
</script>
<title>Menu | PF Alimentos</title>
</head>

<body class="hold-transition fixed skin-purple sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="" class="logo">
        <div class="logo-mini logo-img">
          <img class="logo-img" src="<?php echo base_url(); ?>resources/dist/img/logos/logo_pf.png"/>
        </div>
        <span class="logo-lg logo-img">
          <img class="logo-img" src="<?php echo base_url(); ?>resources/dist/img/logos/logo_pf_alimentos_3.png"/>
        </span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
          <!-- Notifications: style can be found in dropdown.less -->

          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user margin-right-5"></i>
              <span class="hidden-xs"><?php echo $user[0]['USUNOM'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>resources/dist/img/usuario.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->user_data; ?>
                  <small>Dpto: <?php echo $user[0]['NOM_DEPTO']?></small>
                </p>
              </li>

              <!-- Menu Body -->
              <li class="user-body">
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo site_url(); ?>/logout">
                    <i class="fa fa-sign-out"></i> Cerrar Sesión
                  </a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
<li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
          <?php echo $this->menu->render(); ?>

    </section>
    <!-- /.sidebar -->
  </aside>
  <aside class="control-sidebar control-sidebar-dark">
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-theme-demo-options-tab" data-toggle="tab"><i class="fa fa-wrench"></i></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane" id="control-sidebar-home-tab">
        </div><div id="control-sidebar-theme-demo-options-tab" class="tab-pane active"><div></div></div>
        <div class="tab-pane" id="control-sidebar-stats-tab"></div>
      </div>
    </aside>
  <!--fin menu-->

