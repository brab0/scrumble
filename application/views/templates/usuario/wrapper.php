<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->login_model->checkUserSession();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">    
        <title>Scrumble</title>
        <base href="<?php echo base_url(); ?>" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <!--<link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">-->

        <!--<link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php if (isset($stylesheets)) {
            $this->load->view($stylesheets);
        } ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
<?php $this->load->view(TEMPLATE_USUARIO_PARTIALS . "main_header"); ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
<?php $this->load->view(TEMPLATE_USUARIO_PARTIALS . "main_sidebar"); ?>        
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
<?php $this->load->view($mainContent); ?>
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 0.0.1-Snapshot
                </div>
                <strong>Copyright &copy; 2015 <a href="http://rmdb.com.br">rmdb</a>.</strong> All rights reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
<?php $this->load->view(TEMPLATE_USUARIO_PARTIALS . "control_sidebar"); ?>                  
            </aside><!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="assets/plugins/jQueryUI/jquery-ui.min.js"></script>    
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>    
        <!-- Slimscroll -->
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="assets/plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->    
        <script src="assets/dist/js/app.min.js"></script>

        <!-- AdminLTE for demo purposes -->
        <!-- <script src="assets/dist/js/demo.js"></script> -->

        <script src="assets/helpers/form-validation.js"></script>
        <script src="assets/dist/js/pages/projeto/projetos.js"></script>

        <?php if (isset($custom_scripts)) {
            $this->load->view($custom_scripts);
        } ?>        

<?php $this->load->view("modals/projeto"); ?> 
    </body>
</html>
