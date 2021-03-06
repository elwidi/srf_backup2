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
                <h2>Detail</h2>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'supervisor'; ?>"><span class="fa fa-list"></span> List</button>
                    <button type="button" class="btn btn-success" onclick=location.href="<?php echo base_url().'supervisor/create'; ?>"><span class="fa fa-plus"></span> Create</button>
                    <button type="button" class="btn btn-warning" onclick=location.href="<?php echo base_url().'supervisor/edit/'.$rec->id; ?>"><span class="fa fa-pencil"></span> Edit</button>
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
                
                <form class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="name" value="<?php echo $rec->name; ?>" />
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="employee_no">Employee Number
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="employee_no" value="<?php echo $rec->employee_no; ?>" />
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="email" value="<?php echo $rec->email; ?>" />
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="acc">Number of Account
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="acc" name="acc" class="form-control" value="<?php echo $rec->acc; ?> Person" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cust">Number of Customer
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="cust" name="cust" class="form-control" value="<?php echo $rec->cust; ?> Person" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active">Active *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="active" id="active" class="form-control" value="<?php echo ($rec->active) ? 'Yes' : 'No' ?>" readonly />
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="button" class="btn btn-primary" onclick=location.href="<?php echo base_url().'supervisor'; ?>"><span class="fa fa-reply"></span> Back</button>
                    </div>
                </div>

                </form>
                
            </div>
        </div>
            
    </div>
</div>