<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title><?php echo config_item('app_name'); ?></title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/sa.ico" type="image/x-icon">

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

<body style="background-color: #609dff;">


    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">

                    <form id="form_login" class="form-horizontal form-label-left" method="post" action="<?php echo base_url().'login'; ?>" >
					

                        <h1 style="font-size:28px;font-weight: bold; color:#000 !important;">Sign In</h1>
                         <h2 style="font-size:24px;font-weight: bold; color:#000;">Sales Activities Application</h2><br />
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="required" id="email" name="email">
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="required" id="password" name="password">
                            <?php echo form_error('password', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                        <div>
                            <input type="submit" id="btnlogin" name="btnlogin" value="Sign in" class="btn btn-success" />
                        </div>
                        
                    </form>
                    <!-- form -->
					
                        <div id="error_text">
                            <?php if($this->session->flashdata('status')!=null) { ?>
                                <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                                    <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                                </div>
                            <?php } ?>
                        </div>
                    
                        <div class="clearfix"></div>
                        <div class="separator">

                            <div>
                                 <img src="<?php echo base_url(); ?>assets/img/logo-moratel.png"/> <br />
                                <h2><strong>PT MORA TELEMATIKA INDONESIA</strong></h2>
                            </div>
                        </div>
                    
                </section>
                <!-- content -->
            </div>
            
        </div>
    </div>

    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/bootstrap.min.js"></script>
    
    <!-- form validation -->
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/validator/validator.js"></script>
    <script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });
    
    </script>
	
	
	
	
    
</body>

</html>