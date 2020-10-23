<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url(); ?>foto/favicon.ico" type="image/x-icon">

    <title><?php echo config_item('app_name'); ?></title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/moratelindo.ico" type="image/x-icon">

    <link href="<?php echo base_url().'assets/gentelella/'; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/icheck/flat/green.css" rel="stylesheet" />

    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body class="nav-md" style="background-color: #facda0">

<div class="container body">


    <div class="main_container">

        <!-- page content -->
        <div class="col-md-12">
            <div class="col-middle">
                <div class="text-center">
                    <h2 style="text-decoration: underline;" class="error-number">Access Denied</h2>
                    <h1>
                        <?php if($this->session->userdata('status')!=null) { ?>
                            <?php echo $this->session->userdata('pesan'); ?>
                        <?php } ?>
                    </h1>
                    <p>

                    </p>
                    <div class="mid_center">
                        <div class="clearfix"></div>
                        <div class="separator">

                            <div>
                                <img src="<?php echo base_url(); ?>assets/img/logo-moratel.png"/> <br />
                                <h2><strong>PT MORA TELEMATIKA INDONESIA</strong></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

    </div>

</div>

<script src="<?php echo base_url().'assets/gentelella/'; ?>js/bootstrap.min.js"></script>
<!-- icheck -->
<script src="<?php echo base_url().'assets/gentelella/'; ?>js/icheck/icheck.min.js"></script>

<script src="<?php echo base_url().'assets/gentelella/'; ?>js/custom.js"></script>


</body>

</html>