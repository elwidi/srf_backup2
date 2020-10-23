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
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <?php if($this->session->userdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->userdata('status'); ?> alert-dismissible fade in  text-center" role="alert">
                        <strong><?php echo $this->session->userdata('pesan'); ?></strong>
                    </div>
                    <?php
                    $this->session->set_userdata('status', null);
                }
                ?>

                <?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>
                
                <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo base_url().'changesession'; ?>">

                    <input type="hidden" id="id" name="id" />
                    <input type="hidden" id="leveluser_id" name="leveluser_id" />
                    <input type="hidden" id="active" name="active" />
                    <input type="hidden" id="employee_id" name="employee_id" />

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_id">Select User *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="cmbemployee" name="cmbemployee" class="form-control show-tick select2_single" data-live-search="true" required="true" onchange="getDetail()">
                                <option value="">-- Select User --</option>
                                <?php
                                foreach($cmbEmployee as $rec) {
                                    echo '<option value="'.$rec->user_id.'*'.$rec->employee_uid.'*'.$rec->name.'*'.$rec->leveluser_id.'*'.$rec->level_name.'*'.$rec->email.'*'.$rec->active.'*'.$rec->employee_no.'*'.$rec->id.'" >'.$rec->name.'</option>';
                                }
                                ?>
                            </select>
                            <?php echo form_error('cmbemployee', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_uid">Employee UID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="employee_uid" name="employee_uid" required="required" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_no">Employee No.
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="employee_no" name="employee_no" required="required" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Employee Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" required="required" class="form-control"  readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level_name">Level
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="level_name" name="level_name" required="required" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="btnsave" name="btnsave" value="Login" type="submit" class="btn btn-success" />
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

            document.getElementById('id').value = tmp[0];
            document.getElementById('employee_uid').value = tmp[1];
            document.getElementById('name').value = tmp[2];
            document.getElementById('leveluser_id').value = tmp[3];
            document.getElementById('level_name').value = tmp[4];
            document.getElementById('email').value = tmp[5];
            document.getElementById('active').value = tmp[6];
            document.getElementById('employee_no').value = tmp[7];
            document.getElementById('employee_id').value = tmp[8];
        }
    }

</script>