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

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Data</h2>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'employee'; ?>">List</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>
                
                <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo base_url().'employee/create'; ?>">

                    <input type="hidden" id="name" name="name" value="<?php echo set_value('name') ?>" />

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_id">Employee Name *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="cmbemployee" name="cmbemployee" class="form-control show-tick select2_single" data-live-search="true" required="true" onchange="getDetail()">
                                <option value="">-- Select Employee --</option>
                                <?php
                                foreach($cmbEmployee as $rec) {
                                    echo '<option value="'.$rec->employee_id.'*'.$rec->employee_no.'*'.$rec->employee_name.'*'.$rec->email.'" 
                                            '.( (set_value("employee_uid")==$rec->employee_id) ? 'selected' : '').'>
                                            '.$rec->employee_name.'</option>';
                                }
                                ?>
                            </select>
                            <?php echo form_error('cmbemployee', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_uid">Employee UID *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="employee_uid" name="employee_uid" required="required" class="form-control" value="<?php echo set_value('employee_uid') ?>" readonly>
                            <?php echo form_error('employee_uid', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_no">Employee No. *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="employee_no" name="employee_no" required="required" class="form-control" maxlength="12" value="<?php echo set_value('employee_no') ?>" readonly>
                            <?php echo form_error('employee_no', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control" maxlength="50" value="<?php echo set_value('email') ?>" readonly>
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="leveluser_id">User level *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="leveluser_id" name="leveluser_id" class="form-control show-tick select2_single" data-live-search="true" required="true" onchange="getSupervisor(this.value)">
                                <?php
                                foreach($cmbLevel as $rec) {
                                    echo '<option value="'.$rec->id.'" '.( (set_value("leveluser_id")==$rec->id) ? 'selected' : '').'>'.$rec->name.'</option>';
                                }
                                ?>
                            </select>
                            <?php echo form_error('leveluser_id', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group" style="display: <?php echo (set_value("leveluser_id")==3) ? 'block' : 'none'; ?>;" id="cmb_supervisor">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_id">Supervisor *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="supervisor_id" name="supervisor_id" class="form-control show-tick select2_single" data-live-search="true" required="true">
                                <option value="">-- Select Supervisor --</option>
                                <?php
                                if($cmbSupervisor!=null) {
                                    foreach ($cmbSupervisor as $rec) {
                                        echo '<option value="' . $rec->id . '" ' . ((set_value("supervisor_id") == $rec->id) ? 'selected' : '') . '>'.$rec->name. '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('supervisor_id', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'employee'; ?>"><span class="fa fa-reply"></span> Back</button>
                            <input id="btnsave" name="btnsave" value="Create" type="submit" class="btn btn-success" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
            
    </div>
</div>

<script>
    function getDetail()
    {
        employee = document.getElementById('cmbemployee');

        if(employee.value != '')
        {
            tmp = employee.value.split('*');

            document.getElementById('employee_uid').value = tmp[0];
            document.getElementById('employee_no').value = tmp[1];
            document.getElementById('name').value = tmp[2];
            document.getElementById('email').value = tmp[3];
        }
    }

    function getSupervisor(val)
    {
        if(val!='' && val==3)
        {
            $.ajax({
                type:"POST",
                url:"<?php echo base_url().'employee/get_supervisor'; ?>",
                dataType: 'json',
                beforeSend: function() {

                    document.getElementById('cmb_supervisor').style.display = 'block';

                },
                success: function (data) {

                    $('#supervisor_id option[value!=""]').remove();

                    if(data.value!=null)
                    {
                        for(i=0;i<data.value.length;i++)
                        {
                            $('#supervisor_id').append('<option value="' + data.value[i] + '">' + data.text[i] + '</option>');
                        }

                        $('#supervisor_id').addClass('form-control');
                    }

                }
            });
        }
        else
        {
            document.getElementById('cmb_supervisor').style.display = 'none';
        }
    }
</script>