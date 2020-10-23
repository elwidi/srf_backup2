<?php if($this->session->flashdata('status')!=null) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
    </div>
<?php } ?>

<form id="formregistration" class="form-horizontal form-label-left" method="post" onsubmit="return submitData('registration')" > 

    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>" />

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_name">Company Name *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="company_name" name="company_name" required="required" class="form-control" value="<?php echo set_value('company_name', $r['company_name']); ?>" maxlength="200">
            <?php echo form_error('company_name', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="address" name="address" required="required" class="form-control"><?php echo set_value('address', $r['address']); ?></textarea>
            <?php echo form_error('address', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="npwp">NPWP *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="npwp" name="npwp" required="required" class="form-control" value="<?php echo set_value('npwp', $r['npwp']); ?>" maxlength="20">
            <?php echo form_error('npwp', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic_signing">PIC Signing *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="pic_signing" name="pic_signing" required="required" class="form-control" value="<?php echo set_value('pic_signing', $r['pic_signing']); ?>" maxlength="200">
            <?php echo form_error('pic_signing', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input id="btnsaveregistration" name="btnsave" value="Save" type="submit" class="btn btn-success"/>
        </div>
    </div>
</form>