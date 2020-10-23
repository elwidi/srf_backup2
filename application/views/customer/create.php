<div class="page-title">
    <div class="title_left">
        <h3><?php echo $title; ?></h3>
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
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer'; ?>">List</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>
                
                <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo base_url().'customer/create'; ?>">

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Company Name *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="name" name="name" required="required" class="form-control js-example-tags" onchange="newCust()">
                                <option value="0">-- Input Customer Name --</option>
                                <?php
                                if($cmbCustomer!=null) {
                                    foreach($cmbCustomer as $rec) {
                                        echo '<option value="'.$rec->id.'">'.$rec->name.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <!-- <input type="text" id="name" name="name" required="required" class="form-control" maxlength="200"> -->
                            <?php echo form_error('name', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Contact Person *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="pic" name="pic" required="required" class="form-control" maxlength="200">
                            <?php echo form_error('pic', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Contact Number *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="telephone" name="telephone" required="required" class="form-control tagsinput" maxlength="30">
                            <?php echo form_error('telephone', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" class="form-control" maxlength="50">
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Company Address *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="address" name="address" class="form-control" required=""></textarea>
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
                                foreach($cmbCategory as $rec) {
                                    echo '<option value="'.$rec->id.'" 
                                            '.( (set_value("customercategory_id")==$rec->customercategory_id) ? 'selected' : '').'>
                                            '.$rec->name.'</option>';
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
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer'; ?>"><span class="fa fa-reply"></span> Back</button>
                            <input id="btnsave" name="btnsave" value="Create" type="submit" class="btn btn-success" />
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

    function newCust()
    {
        val = $('#name').val();
        if(!isNaN(val))
        {
            alert('Please input other customer!');
            document.getElementById('btnsave').disabled = true;
        }
        else
        {
            document.getElementById('btnsave').disabled = false;
        }
    }
</script>