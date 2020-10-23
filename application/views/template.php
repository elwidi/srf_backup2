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
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/sa.ico" type="image/x-icon">

    <link href="<?php echo base_url().'assets/gentelella/'; ?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/icheck/flat/green.css" rel="stylesheet" />

    <?php if(isset($css['datatables'])) { ?>
    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/jquery.dataTables.css" rel="stylesheet">
    <?php } ?>
    
    <?php if(isset($css['datatables2'])) { ?>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.22/r-2.2.6/sc-2.0.3/datatables.min.css"/> -->
    <script type="text/javascript" src="<?php echo base_url().'assets/DataTables/'; ?>DataTables-1.10.22/css/jquery.dataTables.css"></script>
    <?php } ?>

  


    <?php if(isset($css['select2'])) { ?>
    <!-- select2 -->
    <link href="<?php echo base_url().'assets/gentelella/'; ?>css/select/select2.min.css" rel="stylesheet">
    <?php } ?>
    
    <?php if(isset($css['sweetalert'])) { ?>
    <!-- Sweetalert Css -->
    <link href="<?php echo base_url().'assets/js/'; ?>sweetalert/sweetalert.css" rel="stylesheet" />
    <?php } ?>

    <?php if(isset($css['loadingmodal'])) { ?>
    <link rel="stylesheet" href="<?php echo base_url().'assets/js/'; ?>loadingmodal/css/jquery.loadingModal.css">
    <?php } ?>

    <?php if(isset($css['chat'])) { ?>
    <link href="<?php echo base_url().'assets/'; ?>chat/reset.min.css" rel="stylesheet" />
    <link href="<?php echo base_url().'assets/'; ?>chat/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo base_url().'assets/'; ?>chat/style.css" rel="stylesheet" />
    <?php } ?>

    <?php if(isset($css['wizard'])) { ?>
        <!-- Sweetalert Css -->
        <link href="<?php echo base_url().'assets/gentelella/css/'; ?>smartwizard.css" rel="stylesheet" />
    <?php } ?>

    <?php if(isset($css['timepicker'])) { ?>
        <!-- daterangepicker -->
        <link href="<?php echo base_url().'assets/'; ?>js/wickedpicker/stylesheets/wickedpicker.css" rel="stylesheet" />
    <?php } ?>
    
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/jquery.min.js"></script>

    <?php if(isset($js['highchart'])) { ?>
    <!-- form wizard -->
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/highchart/highcharts.js"></script>
    <?php } ?>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <script>
        $( document ).ready(function() {
            <?php echo ($this->session->userdata('leveluser_id')!=1) ? 'notifchat();' : ''; ?>
        });

        function notifchat()
        {
            $.ajax({
                type:"POST",
                url:"<?php echo base_url().'notif'; ?>",
                dataType: 'json',
                success: function (data) {

                    document.getElementById('jml_notif').innerHTML = data.jml_notif;

                    if( $('#exist').html() != data.exist )
                    {
                        $("#exist").html(data.exist);
                        $("#menu_notif").html(data.notif_pesan);
                    }
                }
            });
        }

        // var autoLoad = setInterval(
        //     function ()
        //     {
        //         <?php echo ($this->session->userdata('leveluser_id')!=1) ? 'notifchat();' : ''; ?>

        //     }, 5000); // refresh page every 5 seconds


    </script>

</head>

<?php if($this->uri->segment('1') != 'customer'){ ?>
<body class="nav-md">
<?php } else { ?>
<body class="nav-sm">
<?php } ?>

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo base_url().'home'; ?>" class="site_title"><img src="<?php echo base_url(); ?>assets/img/logo-moratel.png" style="width:180px;height:70px" /> <span></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator"> </div>
                    <!-- menu prile quick info -->
             

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>&nbsp;</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url().'home'; ?>"><i class="fa fa-home"></i> Home </a></li>
                                
                                <?php
                                if($this->session->userdata('leveluser_id')==1)
                                {
                                ?>
                                    <li><a href="<?php echo base_url().'employee'; ?>"><i class="fa fa-user"></i> Users </a></li>
                                <?php
                                } 

                                if($this->session->userdata('leveluser_id')!=4 && $this->session->userdata('leveluser_id')!=3 && $this->session->userdata('leveluser_id')!=2)
                                {
                                ?>
                                    <li><a href="<?php echo base_url().'manager'; ?>"><i class="fa fa-user"></i> Manager </a></li>
                                <?php
                                }

                                if($this->session->userdata('leveluser_id')!=3 && $this->session->userdata('leveluser_id')!=2)
                                {
                                ?>
                                    <li><a href="<?php echo base_url().'supervisor'; ?>"><i class="fa fa-user"></i> Supervisor </a></li>
                                <?php
                                }
                                
                                if($this->session->userdata('leveluser_id')!=3)
                                {
                                ?>
                                    <li><a href="<?php echo base_url().'account'; ?>"><i class="fa fa-group"></i> Sales </a></li>
                                <?php
                                }
                                ?>

                                <li><a href="<?php echo base_url().'customer'; ?>"><i class="fa fa-male"></i> Customer</a></li>
                                <li><a href="<?php echo base_url().'customer/list_srf'; ?>"><i class="fa fa-file-text"></i> SRF</a></li>
                                <!-- <li><a href="<?php echo base_url().'customer/list_fat'; ?>"><i class="fa fa-code-fork"></i> FAT</a></li> -->
                                <li><a><i class="fa fa-code-fork"></i> FAT <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url().'customer/list_fat'; ?>"><i class="fa fa-list"></i> List</a></li>
                                        <li><a href="<?php echo base_url().'customer/map_fat'; ?>"><i class="fa fa-map-marker"></i> Map</a></li>
                                    </ul>
                                </li>

                                <li><a href="<?php echo base_url().'opportunities'; ?>"><i class="fa fa-flag-checkered"></i> Opportunities</a></li>

                                <?php if($this->session->userdata('leveluser_id')!=1) { ?>
                                    <li><a href="<?php echo base_url().'chat'; ?>"><i class="fa fa-comments-o"></i> Chat</a></li>
                                <?php } ?>

                                <?php
                                if($this->session->userdata('leveluser_id')==1 || $this->session->userdata('leveluser_id')==2 || $this->session->userdata('leveluser_id')==4)
                                {
                                ?>
                                    <li><a><i class="fa fa-print"></i> Report <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url().'report/calllog'; ?>"><i class="fa fa-phone"></i> Call Log</a></li>
                                        </ul>
                                    </li>
                                <?php
                                } 
                                ?>

                                <?php if($this->session->userdata('leveluser_id')==1) { ?>
                                    <li><a href="<?php echo base_url().'changesession'; ?>"><i class="fa fa-key"></i> Session</a></li>
                                <?php } ?>

                                <li><a href="<?php echo base_url().'profile/logout'; ?>"><i class="fa fa-sign-out pull-right"></i> Sign out</a>
                                
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->
                    
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <div class="navbar-left" id="apptitle">
                            <span class="site_title" style="color:#2c3e64 !important;font-weight: bold;font-size: 26px;">Sales Activities</span>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <b>Welcome, <?php echo $this->session->userdata('user_name'); ?></b>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <?php if($this->session->userdata('leveluser_id')!=1) { ?>
                                    <li><a href="<?php echo base_url().'profile'; ?>"><i class="fa fa-key pull-right"></i> Profile</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url().'profile/logout'; ?>"><i class="fa fa-sign-out pull-right"></i> Sign out</a></li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="badge bg-green" id="jml_notif">0</span>
                                </a>
                                <ul id="menu_notif" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    
                                </ul>
                                <span id="exist" style="display: none;"></span>
                            </li>
                            
                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">

                <?php $this->load->view($view); ?>
                
                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right"><span class="bold">Copyright &copy; <?php echo date('Y'); ?>, PT Mora Telematika Indonesia</span>
                        </p>
                            
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/icheck/icheck.min.js"></script>
    
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/custom.js"></script>

    <?php if(isset($js['select2'])) { ?>
    <!-- select2 -->
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/select/select2.full.js"></script>
    <script>
        $(document).ready(function () {
            $(".select2_single").select2({
                placeholder: "-- Pilih --"
            });
            $(".js-example-tags").select2({
                tags: true
            });
        });
    </script>
    <?php } ?>

    <?php if(isset($js['tagsinput'])) { ?>
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/tags/jquery.tagsinput.min.js"></script>
    <script>
        $(function () {
            $('.tagsinput').tagsInput({
                width: 'auto',
                defaultText: 'Add No.'
            });
        });
    </script>
    <?php } ?>
        
    <?php if(isset($js['validation'])) { ?>
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

        $('#btnsaveactivity').click(function (e) {
            e.preventDefault();
            var cek = true;

            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('#subject')
                .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                .on('change', 'select.required', validator.checkField)
                .on('keypress', 'input[required][pattern]', validator.keypress);

            // evaluate the form using generic validaing
            if (!validator.checkAll($('#form_activity'))) {
                cek = false;
            }

            if(cek)
            {
                <?php if($this->session->userdata('leveluser_id')==2) { ?>

                    savereply();

                <?php } elseif($this->session->userdata('leveluser_id')==3) { ?>
                
                    saveactivity();

                <?php } ?>
            }
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>
    <?php } ?>
    
    <?php if(isset($js['datepicker'])) { ?>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?php echo base_url().'assets/gentelella/'; ?>js/moment.min2.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/gentelella/'; ?>js/datepicker/daterangepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.single_date').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_1",
                    format: 'DD/MM/YYYY',
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
            });
            
            $('.range_date').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                }
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });

        });
    </script>
    <?php } ?>

    <?php if(isset($js['timepicker'])) { ?>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?php echo base_url().'assets/'; ?>js/wickedpicker/src/wickedpicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var options = {
                // now: "12:35", //hh:mm 24 hour format only, defaults to current time
                twentyFour: true,  //Display 24 hour format, defaults to false
                upArrow: 'wickedpicker__controls__control-up',  //The up arrow class selector to use, for custom CSS
                downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS
                close: 'wickedpicker__close', //The close class selector to use, for custom CSS
                hoverState: 'hover-state', //The hover state class to use, for custom CSS
                title: 'Time', //The Wickedpicker's title,
                showSeconds: false, //Whether or not to show seconds,
                timeSeparator: ' : ', // The string to put in between hours and minutes (and seconds)
                secondsInterval: 1, //Change interval for seconds, defaults to 1,
                minutesInterval: 1, //Change interval for minutes, defaults to 1
                beforeShow: null, //A function to be called before the Wickedpicker is shown
                afterShow: null, //A function to be called after the Wickedpicker is closed/hidden
                show: null, //A function to be called when the Wickedpicker is shown
                clearable: false, //Make the picker's input clearable (has clickable "x")
            };
            $('.timepicker').wickedpicker(options);
        });
    </script>
    <?php } ?>
    
    <?php if(isset($js['datatables'])) { ?>
    <!-- Datatables -->
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/datatables/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url().'assets/gentelella/'; ?>js/datatables/tools/js/dataTables.tableTools.js"></script>
    <script>
        $(document).ready(function () {
            $('input.tableflat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });

        var asInitVals = new Array();
        $(document).ready(function () {
            var oTable = $('#example').dataTable({
                "oLanguage": {
                    "sSearch": "Search :"
                },
                "aoColumnDefs": [
                    {
                        'bSortable': false,
                        'aTargets': [0]
                    } //disables sorting for column one
        ],
                'iDisplayLength': 12,
                "sPaginationType": "full_numbers",
//                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url('assets/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                }
            });
            $("tfoot input").keyup(function () {
                /* Filter on the column based on the index of this element's parent <th> */
                oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
            });
            $("tfoot input").each(function (i) {
                asInitVals[i] = this.value;
            });
            $("tfoot input").focus(function () {
                if (this.className == "search_init") {
                    this.className = "";
                    this.value = "";
                }
            });
            $("tfoot input").blur(function (i) {
                if (this.value == "") {
                    this.className = "search_init";
                    this.value = asInitVals[$("tfoot input").index(this)];
                }
            });
        });
    </script>
    <?php } ?>
    <?php if(isset($js['datatables2'])) { ?>
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script> -->

 
    <script type="text/javascript" src="<?php echo base_url().'assets/DataTables/'; ?>DataTables-1.10.22/js/jquery.dataTables.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.js"></script>
    <?php } ?>
        
    <?php if(isset($js['sweetalert'])) { ?>
    <!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url().'assets/js/'; ?>sweetalert/sweetalert.min.js"></script>
    <?php } ?>
    
    <!-- PNotify -->
    <script type="text/javascript" src="<?php echo base_url().'assets/gentelella/'; ?>js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/gentelella/'; ?>js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/gentelella/'; ?>js/notify/pnotify.nonblock.js"></script>

    <script>
        $(function () {
            var cnt = 10; //$("#custom_notifications ul.notifications li").length + 1;
            TabbedNotification = function (options, id) {
                var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title + "</h2><div class='close'><a href='javascript:;' class='notification_close' class='bg-green'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

                if (document.getElementById('custom_notifications') == null) {
                    alert('doesnt exists');
                } else {
                    $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
                    $('#custom_notifications #notif-group').append(message);
                    cnt++;
                    CustomTabs(options);
                }
            }

            CustomTabs = function (options) {
                $('.tabbed_notifications > div').hide();
                $('.tabbed_notifications > div:first-of-type').show();
                $('#custom_notifications').removeClass('dsp_none');
                $('.notifications a').click(function (e) {
                    e.preventDefault();
                    var $this = $(this),
                        tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
                        others = $this.closest('li').siblings().children('a'),
                        target = $this.attr('href');
                    others.removeClass('active');
                    $this.addClass('active');
                    $(tabbed_notifications).children('div').hide();
                    $(target).show();
                });
            }

            CustomTabs();

            var tabid = idname = '';
            $(document).on('click', '.notification_close', function (e) {
                idname = $(this).parent().parent().attr("id");
                tabid = idname.substr(-2);
                $('#ntf' + tabid).remove();
                $('#ntlink' + tabid).parent().remove();
                $('.notifications a').first().addClass('active');
                $('#notif-group div').first().css('display','block');
            });
        })
        
    </script>
    
    <?php if(isset($js['wizard'])) { ?>
    <!-- form wizard -->
    <script type="text/javascript" src="<?php echo base_url().'assets/gentelella/'; ?>js/wizard/jquery.smartWizard.js"></script>
    <?php } ?>

    <?php if(isset($js['wizard2'])) { ?>
    <!-- form wizard -->
    <script type="text/javascript" src="<?php echo base_url().'assets/gentelella/'; ?>js/wizard/jquery.smartWizard2.js"></script>
    <?php } ?>

    <?php if(isset($js['loadingmodal'])) { ?>
    <script src="<?php echo base_url().'assets/js/'; ?>loadingmodal/js/jquery.loadingModal.js"></script>
    <script>
        var delay = function(ms){ return new Promise(function(r) { setTimeout(r, ms) }) };
        var time = 1000;

        function showLoadingmodal() {

            delay(time)
                .then(function() { $('body').loadingModal({
                        'text' : 'Please wait ...',
                        'animation': 'wanderingCubes',
                        'backgroundColor': 'blue',
                    });
                    return delay(time);
                });
        }

        function hideLoadingmodal(msg, color) {

            delay(time)
                .then(function() { $('body').loadingModal('text', msg).loadingModal('backgroundColor', color);  return delay(time); } )
                .then(function() { $('body').loadingModal('destroy') ;} );
        }
    </script>
    <?php } ?>

    <script>
        $(".js-example-tags").select2({
            tags: true
        });
    </script>

    <?php if(isset($js['chat'])) { ?>
    <script type="text/javascript" src="<?php echo base_url().'assets/chat/'; ?>chat.js"></script>
    <?php } ?>

    <?php if(isset($js['parsley'])) { ?>
    <script type="text/javascript" src="<?php echo base_url().'assets/laras/'; ?>parsley.min.js"></script>
    <?php } ?>

    <?php if(isset($js['inputmask'])) { ?>
    <script type="text/javascript" src="<?php echo base_url().'assets/gentelella/'; ?>js/input_mask/jquery.inputmask.js"></script>
    <?php } ?>
    
</body>

</html>