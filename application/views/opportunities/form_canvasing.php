<?php if($this->session->flashdata('status')!=null) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
    </div>
<?php } ?>

<form id="formcanvasing" class="form-horizontal form-label-left" method="post" onsubmit="return submitData('canvasing')" > 

    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo set_value('customer_id', $r['id']); ?>" />
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="existing_conditions">Customer Name
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="customer_name" name="customer_name" required="required" class="form-control" maxlength="500" value="<?php echo set_value('customer_name', $r['name']); ?>">
            <?php echo form_error('customer_name', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person">Contact Person
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="contact_person" name="contact_person" required="required" class="form-control" maxlength="500" value="<?php echo set_value('contact_person', $r['pic']); ?>">
            <?php echo form_error('contact_person', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="existing_capacity">Contact Number
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <!--   <input type="text" id="telephone" name="telephone" class="form-control tagsinput" maxlength="500" value="<?php echo set_value('telephone', $r['contact_number']);?>"> -->
            <input type="text" id="telephone" name="telephone" class="form-control tagsinput" maxlength="500" value="085789999,4545454545">
            <?php echo form_error('telephone', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="email" id="email" name="email" class="form-control" maxlength="50" value="<?php echo set_value('email', $r['email']);?>">
            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="address" name="address" required="required" class="form-control"><?php echo set_value('address', $r['address']); ?></textarea>
            <?php echo form_error('address', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input id="btnsaveprospect" name="btnsave" value="Save" type="submit" class="btn btn-success"/>
        </div>
    </div>
</form>