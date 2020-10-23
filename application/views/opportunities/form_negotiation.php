<?php if($this->session->flashdata('status')!=null) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
    </div>
<?php } ?>

<form id="formnegotiation" class="form-horizontal form-label-left" method="post" onsubmit="return submitData('negotiation')" > 

    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>" />

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bid_price">Bid Price *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="number" id="bid_price" name="bid_price" required="required" class="form-control" value="<?php echo set_value('bid_price', $r['bid_price']); ?>">
            <?php echo form_error('bid_price', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>

    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_offered">Product Offered *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- <textarea id="product_offered" name="product_offered" required="required" class="form-control"><?php echo set_value('product_offered', $r['product_offered']); ?></textarea> -->
            <select id="service" name="service" class="form-control select2 input" required="required" data-parsley-errors-container="#for_order_type" onchange="loadChildService(this.value)">
                <option></option>
                <?php foreach($product as $key => $val){ ?>
                <option value="<?php echo $val['ID_PRODUCT'] ?>" <?php if($val['ID_PRODUCT'] == $r['parent_id']) echo "selected"; ?>><?php echo $val['PRODUCT_NAME']?></option>
                <?php } ?>
            </select>
            <br/>

            <select id="service2" name="service2" class="form-control select2 input <?php if(empty($r)) echo "hidden"?>" required="required" data-parsley-errors-container="#for_order_type">
                <option></option>
                <?php if(!empty($r)) {
                    foreach ($r['list_product'] as $key => $value) { ?>
                    <option value="<?php echo $value['ID_PRODUCT'] ?>" <?php if($r['product_offered'] == $value['ID_PRODUCT']) echo "selected"; ?>><?php echo $value['PRODUCT_NAME']?></option>
                <?php } }  ?>
            </select>
            <?php echo form_error('product_offered', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_offered">Type Service *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <!-- <textarea id="product_offered" name="product_offered" required="required" class="form-control"><?php echo set_value('product_offered', $r['product_offered']); ?></textarea> -->
            <select id="order_type" name="order_type" class="form-control select2 input" required="required" data-parsley-errors-container="#for_order_type">
                <option></option>
                <option value="NEW LINK" <?php if($r['type_service'] == "NEW LINK") echo "selected"; ?>>NEW LINK</option>
                <option value="UPGRADE" <?php if($r['type_service'] == "UPGRADE") echo "selected"; ?>>UPGRADE</option>
                <option value="DOWNGRADE" <?php if($r['type_service'] == "DOWNGRADE") echo "selected"; ?>>DOWNGRADE</option>
                <option value="RELOKASI" <?php if($r['type_service'] == "RELOKASI") echo "selected"; ?>>RELOKASI</option>
            </select>
            <?php echo form_error('product_offered', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="asking_price">Asking Price *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="number" id="asking_price" name="asking_price" required="required" class="form-control" value="<?php echo set_value('asking_price', $r['asking_price']); ?>">
            <?php echo form_error('asking_price', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agreed_price">Agreed Price *
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="number" id="agreed_price" name="agreed_price" required="required" class="form-control" value="<?php echo set_value('agreed_price', $r['agreed_price']); ?>">
            <?php echo form_error('agreed_price', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea id="description" name="description" required="required" class="form-control"><?php echo set_value('description', $r['description']); ?></textarea>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input id="btnsavenegotiation" name="btnsave" value="Save" type="submit" class="btn btn-success"/>
        </div>
    </div>
</form>