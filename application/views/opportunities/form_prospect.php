<?php if($this->session->flashdata('status')!=null) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
    </div>
<?php } ?>

<form id="formprospect" class="form-horizontal form-label-left" method="post" onsubmit="return submitData('prospect')" > 

    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>" />
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="existing_conditions">Existing Conditions *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="existing_conditions" name="existing_conditions" required="required" class="form-control"><?php echo set_value('existing_conditions', $r['existing_conditions']); ?></textarea>
            <?php echo form_error('existing_conditions', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="existing_provider">Existing Provider *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="existing_provider" name="existing_provider" required="required" class="form-control" maxlength="500" value="<?php echo set_value('existing_provider', $r['existing_provider']); ?>">
            <?php echo form_error('existing_provider', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="existing_capacity">Existing Capacity *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="existing_capacity" name="existing_capacity" required="required" class="form-control"><?php echo set_value('existing_capacity', $r['existing_capacity']); ?></textarea>
            <?php echo form_error('existing_capacity', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="needs_plan">Needs Plan *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="needs_plan" name="needs_plan" required="required" class="form-control"><?php echo set_value('needs_plan', $r['needs_plan']); ?></textarea>
            <?php echo form_error('needs_plan', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget">Budget *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="number" id="budget" name="budget" required="required" class="form-control" value="<?php echo set_value('budget', $r['budget']); ?>">
            <?php echo form_error('budget', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input id="btnsaveprospect" name="btnsave" value="Save" type="submit" class="btn btn-success"/>
        </div>
    </div>
</form>