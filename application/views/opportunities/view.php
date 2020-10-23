<div class="page-title">
    <div class="title_left">
        <h3><?php echo $judul; ?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            
        </div>
    </div>
</div>
<div class="clearfix"></div>

<?php if($this->session->userdata('status')!=null) { ?>
    <div class="alert alert-<?php echo $this->session->userdata('status'); ?> alert-dismissible fade in  text-center" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong><?php echo $this->session->userdata('pesan'); ?></strong>
    </div>
<?php 
        $this->session->set_userdata('status', null);
    }
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">      
        <div class="x_panel">
            <div class="x_title">
                <h2>Customer</h2>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'opportunities'; ?>"><span class="fa fa-reply"></span> Back</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <form class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Customer Name 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="customer_name" name="customer_name" value="<?php echo $rec->customer_name; ?>" />
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stage_name"> Stage
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="stage_name" name="stage_name" class="form-control" value="<?php echo $rec->stage_name; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Contact Person
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="pic" name="pic" class="form-control" value="<?php echo $rec->pic; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Contact Number
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="telephone" name="telephone" class="form-control" value="<?php echo $rec->telephone; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="address" name="address" class="form-control" readonly=""><?php echo $rec->address; ?></textarea>
                    </div>
                </div>

                </form>
                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">      
        <div class="x_panel">
            
            <div class="x_title">
                <h2>Stages</h2>
                <div class="pull-right">

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <input type="hidden" id="modalStage" name="modalStage" value="<?php echo $rec->pipeline; ?>" />
                
                <div id="wizard" class="form_wizard wizard_horizontal table-responsive">
                    <ul class="wizard_steps">

                        <?php
                        if($recStages!=null)
                        {
                            foreach($recStages as $rS)
                            {
                        ?>
                        <li>
                            <a href="#step-canvasing" <?php echo ($this->session->userdata('leveluser_id')==3) ? 'onclick="formmodal('.$rS->id.', \''.$rS->name.'\')"' : ''; ?>>
                                <span class="step_no"><?php echo $rS->id; ?></span>
                                <span class="step_descr">
                                    <?php echo $rS->name; ?><br />
                                    <small> </small>
                                </span>
                            </a>
                        </li>
                        <?php
                            }
                        }
                        ?>

                    </ul>

                    <?php
                    if($recStages!=null)
                    {
                        foreach($recStages as $rS)
                        {
                    ?>
                    <div id="step-<?php echo str_replace(' ', '', strtolower($rS->name)); ?>">
                        <h2 class="StepTitle"> </h2>

                    </div>
                    <?php
                        }
                    }
                    ?>

                </div>
                
            </div>
                
            <!--</form>-->
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2>Activities</h2>
                <div class="pull-right">
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            
            	<div class="dashboard-widget-content" id="list_activity">

                    <?php 
                    if($recActivity!=null) 
                    { 
                        $tmp_act = 0;
                        $i = 0;
                    ?>

                    <ul class="list-unstyled timeline widget">
                        <?php 
                        foreach($recActivity as $rA) 
                        { 
                            if($tmp_act!=$rA->id)
                            {
                                if($i!=0)
                                {
                        ?>
                        
                                    </div>

                                </div>
                            </div>
                        </li>

                        <?php
                                    $i=1;
                                }
                        ?>
                        <li>
                            <div class="block" id="activity<?php echo $rA->id; ?>">
                                <div class="block_content">
                                    <h2 class="title">
                                        <a id="type<?php echo $rA->id; ?>"><?php echo $rA->type_name; ?></a>
                                    </h2>
                                    <div class="byline">
                                        <div class="pull-left">
                                            <span id="date<?php echo $rA->id; ?>"><?php echo date('d-m-Y H:i:s', strtotime($rA->created_date)); ?></span>, stage : <a><?php echo $rA->stage_name; ?></a>
                                        </div>
                                        <div class="pull-right">
                                            <?php if($this->session->userdata('leveluser_id')==2) { ?>
                                                <button id="btnreply" class="btn btn-sm" value="Reply" onclick="toreply(<?php echo $rA->id; ?>)">Reply</button>
                                            <?php } ?>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <p class="excerpt" id="message<?php echo $rA->id; ?>"><?php echo $rA->message; ?></p>
                                    
                                    <?php if($rA->activitytype_id==1) { ?>
                                        <hr />
                                        <span>Telp No. : <?php echo $rA->telephone; ?></span><br />
                                        <span>Date : <?php echo date('d-m-Y H:i:s', strtotime($rA->telephone_date)); ?></span><br />
                                        <span>ISP : <?php echo $rA->isp; ?></span><br />
                                        <span>Bandwith : <?php echo $rA->bandwith; ?></span><br />
                                        <span>Location : <?php echo $rA->location; ?></span><br />
                                        <span>Budget : <?php echo $rA->budget; ?></span><br />
                                    <?php } ?>

                                    <div class="<?php echo ($rA->reply!=null) ? 'block' : ''; ?>" id="reply<?php echo $rA->id; ?>">

                            <?php 
                            }
                                    if($rA->reply!=null) 
                                    { 
                            ?>
                                            
                                            <div class="block_content">
                                                <h2 class="title">
                                                    <a>Reply from Supervisor</a>
                                                </h2>
                                                <div class="byline">
                                                    <span><?php echo date('d-m-Y H:i:s', strtotime($rA->reply_date)); ?></span>
                                                </div>
                                                <p class="excerpt"><?php echo $rA->reply; ?></p>
                                            </div>

                            <?php 
                                    } 
                            
                            if($tmp_act!=$rA->id)
                            {
                            ?>
                                    
                        <?php 
                                $tmp_act = $rA->id;
                            }
                        } 
                        ?>
                    </ul>

                    <?php } else { ?>

                        <div class="alert alert-warning text-center" id="emptyactivity">No Recent Activity</div>

                        <ul class="list-unstyled timeline widget">
                            <li></li>
                        </ul>

                    <?php } ?>

                </div>
            	
            </div>
        </div>
	</div>

    <?php if($this->session->userdata('leveluser_id')==3) { ?>

	<div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <div class="x_title">
                <h2>Add Activities</h2>
                <div class="pull-right">
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            
            	<?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>
                
                <form id="form_activity" class="form-horizontal form-label-left" novalidate method="post" action="#">

                    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $rec->id; ?>">
                    <input type="hidden" id="workflow_id" name="workflow_id" value="<?php echo $rec->pipeline; ?>">

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Subject *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="subject" name="subject" required="required" class="form-control" onchange="chooseSubject(this.value)">
                            		<option value="">-- Select --</option>
                            		<?php foreach($recType as $r) { ?>
                            		<option value="<?php echo $r->id; ?>"><?php echo $r->name; ?></option>
                            		<?php } ?>
                            </select>
                            <?php echo form_error('subject', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group call" id="telephone" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">Telephone No. *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="telephone" name="telephone" required="required" class="form-control js-example-tags">
                            		<option value="">-- Select / Create --</option>
                            		<?php foreach($recTelephone as $r) { ?>
                            		<option value="<?php echo $r->number; ?>"><?php echo $r->number; ?></option>
                            		<?php } ?>
                            </select>
                            <?php echo form_error('telephone', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group call" id="pin" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject">PIN *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type='text' id="pin" name="pin" required="required" class="form-control" maxlength="10">
                            <?php echo form_error('pin', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group call" id="date" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type='text' id="date" name="date" required="required" class="form-control single_date">
                            <?php echo form_error('date', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group call" id="time" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="time">Time *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type='text' id="time" name="time" required="required" class="form-control timepicker">
                            <?php echo form_error('time', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Message *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="message" name="message" required="required" class="form-control"></textarea>
                            <?php echo form_error('message', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group call" id="isp" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isp">ISP 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type='text' id="isp" name="isp" class="form-control" maxlength="100">
                            <?php echo form_error('isp', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group call" id="bandwith" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bandwith">Bandwith
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type='text' id="bandwith" name="bandwith" class="form-control" maxlength="100">
                            <?php echo form_error('bandwith', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group call" id="location" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="location">Location
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type='text' id="location" name="location" class="form-control" maxlength="100">
                            <?php echo form_error('location', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group call" id="bugdet" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bugdet">Bugdet
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type='number' id="budget" name="budget" class="form-control" min="0">
                            <?php echo form_error('budget', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="btnsaveactivity" name="btnsaveactivity" value="Save" type="button" class="btn btn-success" />
                        </div>
                    </div>

					</form>
            	
            </div>
        </div>
	</div>

    <?php } ?>

    <?php if($this->session->userdata('leveluser_id')==2) { ?>

    <div class="col-md-6 col-sm-12 col-xs-12" id="formreply" style="display:none;">
        <div class="x_panel">
            
            <div class="x_title">
                <h2>Reply Activities</h2>
                <div class="pull-right">
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            
                <?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>
                
                <form id="form_activity" class="form-horizontal form-label-left" novalidate method="post" action="#">

                    <input type="hidden" id="activity_id" name="activity_id">

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activities">Activities
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="activities" name="activities" required="required" class="form-control" readonly>
                            <?php echo form_error('activities', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="date" name="date" required="required" class="form-control" readonly>
                            <?php echo form_error('date', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="message">Message
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="message" name="message" required="required" class="form-control" readonly></textarea>
                            <?php echo form_error('message', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reply">Reply *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="reply" name="reply" required="required" class="form-control"></textarea>
                            <?php echo form_error('reply', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="btnsaveactivity" name="btnsaveactivity" value="Send" type="button" class="btn btn-success" />
                        </div>
                    </div>

                    </form>
                
            </div>
        </div>
    </div>

    <?php } ?>

</div>

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" style="z-index:10 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h2 id="titleModal">Form</h2>
            </div>
            <div class="modal-body" id="contentModal">

                

            </div>
            <div class="modal-footer modal-col-orange">

                <button id="btn_batal" class="btn btn-default waves-effect" data-dismiss="modal" type="button">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    no = 2;

    $(document).ready(function () {

        // console.log(document.getElementsByClassName("actionBar"));
        // document.getElementsByClassName("actionBar")[0].setAttribute("class", "hidden");

        // Stages action
        $('#wizard').smartWizard({
            'selected' : <?php echo $rec->pipeline-1; ?>,
            'enableAllSteps' : true,
            'keyNavigation' : false,
            includeFinishButton : false,
            'enableFinishButton' : false,
            'labelFinish' : '<span class="fa fa-save"></span> Process',
            // 'labelNext' : 'Next <span class="fa fa-arrow-right"></span> ',
            // 'labelPrevious' : '<span class="fa fa-arrow-left"></span> Previous',
            toolbarSettings: {
                showNextButton: false,
                showPreviousButton: false,
            },
            // 'onFinish' : function(obj, context){
                
            //     $.ajax({
            //         type:"POST",
            //         url:"<?php echo base_url().'opportunities/process_stage'; ?>",
            //         data:{ stages_id : context.fromStep, customer_id : <?php echo $rec->id; ?> },
            //         dataType: 'json',
            //         success: function (data) {

            //             if(data.success)
            //             {
            //                 document.getElementById('stage_name').value = data.stage;
            //                 document.getElementById('workflow_id').value = context.fromStep;

            //                 swal("Success!", "Stage Changes Successfully", "success");
            //             }
            //             else
            //             {
            //                 swal("Failed!", "Stage Changes Failed", "error");
            //             }
            //         }
            //     });
            // }
        });

    });

    function saveactivity()
    {

        $.ajax({
            type:"POST",
            url:"<?php echo base_url().'opportunities/insert_activity'; ?>",
            data: $('#form_activity').serialize() ,
            dataType: 'json',
            beforeSend: function() {

                document.getElementById('btnsaveactivity').disabled=true;

            },
            success: function (data) {

                if(data.success)
                {
                    if(data.result!=null)
                    {
                        if(document.getElementById('emptyactivity'))
                            document.getElementById('emptyactivity').style.display = 'none';

                        if(data.result.activitytype_id!='1') // jika bukan activity call
                        {
                            $("#list_activity ul li:eq(0)").before('<li>\n' +
                                '                            <div class="block">\n' +
                                '                                        <div class="block_content">\n' +
                                '                                <h2 class="title">\n' +
                                '                                    <a>' + data.result.type_name + '</a>\n' +
                                '                                            </h2>\n' +
                                '                                  <div class="byline">\n' +
                                '                                    <span>' + data.result.waktu + '</span>, stage : <a>' + data.result.stage_name + '</a>\n' +
                                '                                  </div>\n' +
                                '                                        <p class="excerpt">\n' +
                                '                                            ' + data.result.message + '\n' +
                                '                                        </p>\n' +
                                '                                  </div>\n' +
                                '                            </div>\n' +
                                '                        </li>');
                        }
                        else // jika activity call
                        {
                            $("#list_activity ul li:eq(0)").before('<li>\n' +
                                '                            <div class="block">\n' +
                                '                                        <div class="block_content">\n' +
                                '                                <h2 class="title">\n' +
                                '                                    <a>' + data.result.type_name + '</a>\n' +
                                '                                            </h2>\n' +
                                '                                  <div class="byline">\n' +
                                '                                    <span>' + data.result.waktu + '</span>, stage : <a>' + data.result.stage_name + '</a>\n' +
                                '                                  </div>\n' +
                                '                                        <p class="excerpt">\n' +
                                '                                            ' + data.result.message + '\n' +
                                '                                        </p>\n' +
                                '                                        <hr />\n' +
                                '                                        <span>Telp No. : '  + data.result.telephone + '</span><br />\n' +
                                '                                        <span>Date : '  + data.result.waktu_tlpn + '</span><br />\n' +
                                '                                        <span>ISP : '  + data.result.isp + '</span><br />\n' +
                                '                                        <span>Bandwith : '  + data.result.bandwith + '</span><br />\n' +
                                '                                        <span>Location : '  + data.result.location + '</span><br />\n' +
                                '                                        <span>Budget : '  + data.result.budget + '</span><br />\n' +
                                '                                  </div>\n' +
                                '                            </div>\n' +
                                '                        </li>');
                        }

                        swal("Success!", "Insert New Activity Successfully", "success");
                    }
                    else
                    {
                        swal("Failed!", "Can't load new activity.", "error");
                    }

                    document.getElementById('subject').value = '';
                    document.getElementById('message').value = '';
                }
                else
                {
                    swal("Failed!", "Insert New Activity Failed", "error");
                }

                document.getElementById('btnsaveactivity').disabled=false;
            }
        });
    }

    function chooseSubject(val)
    {
        if(val=="1")
        {
            $(".call").show();
        }
        else
        {
            $(".call").hide();
        }
    }

    var activeActivity = 0;

    function toreply(activity_id)
    {
        document.getElementById('activity' + activity_id).style.backgroundColor = "#facda0";
        if(activeActivity!=0)
            document.getElementById('activity' + activeActivity).style.backgroundColor = "#ffffff";

        activeActivity = activity_id;
        
        document.getElementById('activity_id').value = activity_id;
        document.getElementById('activities').value = document.getElementById('type' + activity_id).innerHTML;
        document.getElementById('date').value = document.getElementById('date' + activity_id).innerHTML;
        document.getElementById('message').value = document.getElementById('message' + activity_id).innerHTML;
        
        document.getElementById('formreply').style.display = 'block';

    }

    function savereply()
    {

        $.ajax({
            type:"POST",
            url:"<?php echo base_url().'opportunities/insert_reply'; ?>",
            data: $('#form_activity').serialize() ,
            dataType: 'json',
            beforeSend: function() {

                document.getElementById('btnsaveactivity').disabled=true;

            },
            success: function (data) {

                if(data.success)
                {
                    if(data.result!=null)
                    {
                        $("#reply" + activeActivity).append(
                                                    '<div class="block_content">\n' +
                                                        '<h2 class="title">\n' +
                                                            '<a>Reply from Supervisor</a>\n' +
                                                        '</h2>\n' +
                                                        '<div class="byline">\n' +
                                                            '<span>' + data.result.waktu + '</span>\n' +
                                                        '</div>\n' +
                                                        '<p class="excerpt">' + data.result.message + '</p>\n' +
                                                    '</div>');
                    }

                    document.getElementById('activity_id').value = '';
                    document.getElementById('activities').value = '';
                    document.getElementById('date').value = '';
                    document.getElementById('message').value = '';
                    document.getElementById('reply').value = '';

                    document.getElementById('formreply').style.display = 'none';
                    $("#reply" + activeActivity).addClass("block");

                    swal("Success!", "Reply Activity Successfully", "success");
                }
                else
                {
                    swal("Failed!", "Reply Activity Failed", "error");
                }

                document.getElementById('btnsaveactivity').disabled=false;
            }
        });
    }

    var status = false;

    function formmodal(stage, stageName)
    {
        document.getElementById("modalStage").value = stage;

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'opportunities/generate_form'; ?>",
            data: {workflow_id: stage, customer_id : <?php echo $rec->id; ?>},
            success: function (form) {

                if(stage==1 || stage==6)
                {
                    updateStage();

                    if(status)
                        swal("Save Success!", 'Stages has changed', "success");
                    else
                        swal("Save Success!", 'Stages failed to change', "warning");
                }
                else
                {
                    document.getElementById("contentModal").innerHTML = form;
                    document.getElementById("titleModal").innerHTML = "Form " + stageName;

                    $('.single_date').daterangepicker({
                            singleDatePicker: true,
                            calender_style: "picker_1",
                            format: 'DD/MM/YYYY',
                        }, function (start, end, label) {
                            console.log(start.toISOString(), end.toISOString(), label);
                    });

                    if(stage==5)
                        no = document.getElementById('iter_bast').value;

                    $("#modalForm").modal({backdrop: 'static', keyboard: false});
                }
            },
            error: function (request, status, error) {

                document.getElementById("contentModal").innerHTML = request.responseText;

                $("#modalForm").modal({backdrop: 'static', keyboard: false});
            }
        });
    }

    function submitData(form)
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'opportunities/proses_'; ?>" + form,
            data: $('#form' + form).serialize() ,
            dataType: 'json',
            success: function (result) {

                if(result.success==true)
                {
                    // Update Stage jika stage dipilih beda dgn current
                    if(document.getElementById("modalStage").value != document.getElementById('workflow_id').value)
                    {
                        updateStage();

                        if(status)
                            swal("Save Success!", result.pesan + ', and stages has changed', "success");
                        else
                            swal("Save Success!", result.pesan + ', and stages failed to change', "warning");
                    }
                    else
                        swal("Save Success!", result.pesan, "success");

                    $("#modalForm").modal('hide');
                }
                else
                    swal("Save Failed!", result.pesan, "error");

            },
            error: function (request, status, error) {

                alert(request.responseText);
                $("#modalForm").modal('hide');
            }
        });

        return false;
    }

    function submitDataReport()
    {
        var form = $('#formreport')[0];
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'opportunities/proses_report'; ?>",
            data: data,
            dataType: 'json',
            enctype: 'multipart/form-data',
            processData: false,  
            contentType: false,
            cache: false,
            success: function (result) {

                if(result.success==true)
                {
                    // Update Stage jika stage dipilih beda dgn current
                    if(document.getElementById("modalStage").value != document.getElementById('workflow_id').value)
                    {
                        updateStage();

                        if(status)
                            swal("Save Success!", result.pesan + ', and stages has changed', "success");
                        else
                            swal("Save Success!", result.pesan + ', and stages failed to change', "warning");
                    }
                    else
                        swal("Save Success!", result.pesan, "success");

                    $("#modalForm").modal('hide');
                }
                else
                    swal("Save Failed!", result.pesan, "error");

            },
            error: function (request, status, error) {

                alert(request.responseText);
                $("#modalForm").modal('hide');
            }
        });

        return false;
    }
    
    function updateStage()
    {
        $.ajax({
            type:"POST",
            url:"<?php echo base_url().'opportunities/process_stage'; ?>",
            data:{ stages_id : document.getElementById("modalStage").value, customer_id : <?php echo $rec->id; ?> },
            dataType: 'json',
            async: false,
            success: function (data) {

                if(data.success)
                {
                    document.getElementById('stage_name').value = data.stage;
                    document.getElementById('workflow_id').value = document.getElementById("modalStage").value;

                    status = true;
                }
                else
                {
                    status = false;
                }
            }
        });
    }

    // BEGIN script input photo bast
    
    function add_bast()
    {
        var table = document.getElementById("tabel_bast");
        var row = table.insertRow(no);
        
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        
        cell1.innerHTML =   '<div class="item form-group">' +
                            '<div class="col-md-6 col-sm-6 col-xs-12"><input type="file" id="file_' + no + '" name="file_' + no + '" required="required" class="form-control">' +
                            '</div></div>';
        cell2.innerHTML =   '<span id="delete' + no + '"><button type="button" id="btnhapus_' + no + '" class="btn btn-sm bg-red waves-effect" onclick="remove_bast(' + (row.rowIndex) + ');"><i class="material-icons">delete</i></button></span>'

        no++;

        document.getElementById("jumlah_bast").value = (no-1);
    }
    
    function remove_bast(id)
    {
        if(document.getElementById("delete" + id))
        {
            document.getElementById("tabel_bast").deleteRow(id);

            no--;
        }
        
        for(iter=(id+1);iter<=(no+1);iter++)
        {
            if(document.getElementById("delete" + (iter)))
            {
                $("#file_" + iter).attr('id', "file_" + (iter-1)).attr('name', "file_" + (iter-1));
                $("#delete" + iter).attr('id', "delete" + (iter-1));
                $("#btnhapus_" + iter).attr('id', "btnhapus_" + (iter-1)).attr('onclick', "remove_bast(" + (iter-1) + ")");
            }
        }
        
        document.getElementById("jumlah_bast").value = (no-1);
    }

    function deleteBast(urut)
    {
        alert(urut);

        $.ajax({
            type:"POST",
            url:"<?php echo base_url().'opportunities/delete_bast'; ?>",
            data:{ nama_file : document.getElementById("filebast_" + urut).value, id : document.getElementById("id_bast_" + urut).value },
            dataType: 'json',
            success: function (data) {

                if(data.success)
                {
                    document.getElementById("exist_bast").deleteRow(urut);

                    iter=(urut+1);
                    while(document.getElementById("btnDeleteBast" + (iter)))
                    {
                        $("#filebast_" + iter).attr('id', "filebast_" + (iter-1)).attr('name', "filebast_" + (iter-1));
                        $("#id_bast_" + iter).attr('id', "id_bast_" + (iter-1)).attr('name', "id_bast_" + (iter-1));
                        $("#btnDeleteBast" + iter).attr('id', "btnDeleteBast" + (iter-1)).attr('onclick', "deleteBast(" + (iter-1) + ")");

                        iter++;
                    }
                    
                    swal("Delete BAST Success!", data.pesan, "success");
                }
                else
                    swal("Delete BAST Failed!", data.pesan, "error");
            }
        });
    }
    // END script input photo bast

</script>
