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
                <h2>Edit Data</h2>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer'; ?>"><span class="fa fa-list"></span> List</button>
                    <?php if($this->session->userdata('leveluser_id')==3) { ?>
                    <button type="button" class="btn btn-success" onclick=location.href="<?php echo base_url().'customer/create'; ?>"><span class="fa fa-plus"></span> Create</button>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>
                
                <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo base_url().'customer/edit/'.$rec[0]->id; ?>">

                    <?php if($this->session->userdata('leveluser_id')==1) { ?>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_name">Supervisor
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" readonly="" id="supervisor_name" name="supervisor_name" value="<?php echo $rec[0]->supervisor_name; ?>" />
                        </div>
                    </div>
                    <?php } ?>

                    <?php if($this->session->userdata('leveluser_id')==2) { ?>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="account_name">Account 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" readonly="" id="account_name" name="account_name" value="<?php echo $rec[0]->account_name; ?>" />
                        </div>
                    </div>
                    <?php } ?>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Company Name *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" id="name" name="name" maxlength="200" value="<?php echo $rec[0]->customer_name; ?>" />
                            <?php echo form_error('name', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Contact Person *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="pic" name="pic" required="required" class="form-control" maxlength="200" value="<?php echo $rec[0]->pic; ?>">
                            <?php echo form_error('pic', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Contact Number *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php
                            $telephone = '';
                            foreach($rec as $r) 
                            {
                                $telephone .= $r->number.',';
                            }
                            ?>
                            <input type="text" id="telephone" name="telephone" required="required" class="form-control tagsinput" maxlength="30" value="<?php echo $telephone; ?>">
                            <?php echo form_error('telephone', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control" maxlength="50" value="<?php echo $rec[0]->email; ?>">
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Company Address *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="address" name="address" class="form-control" required=""><?php echo $rec[0]->address ?></textarea>
                            <?php echo form_error('address', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customercategory_id">Category *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="customercategory_id" name="customercategory_id" class="form-control show-tick select2_single" data-live-search="true" required="true" onchange="newcategory(this.value)">
                                <option value="">-- Select Category --</option>
                                <?php
                                foreach($cmbCategory as $r) {
                                    echo '<option value="'.$r->id.'" '.( ($rec[0]->customercategory_id==$r->id) ? 'selected' : '').'>'.$r->name.'</option>';
                                }
                                ?>
                                <option value="-">-- Other --</option>
                            </select>
                            <?php echo form_error('customercategory_id', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group" style="display: none;" id="input_category">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">New Category *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="category_name" name="category_name" class="form-control" maxlength="100">
                            <?php echo form_error('category_name', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="created_date">Created Date
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="created_date" name="created_date" readonly="" class="form-control" value="<?php echo $rec[0]->created_date; ?>">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer/view/'.$rec[0]->id; ?>">Back</button>
                            <input id="btnsave" name="btnsave" value="Update" type="submit" class="btn btn-success" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
            
    </div>
</div>

<script>
    function newcategory(val)
    {
        if(val=='-')
        {
            document.getElementById('input_category').style.display = 'block';
            document.getElementById('category_name').required = true;
        }
        else
        {
            document.getElementById('input_category').style.display = 'none';
            document.getElementById('category_name').required = false;
        }

    }
</script>