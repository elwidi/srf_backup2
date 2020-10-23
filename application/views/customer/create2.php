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
                
                <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo base_url().'customer/prospect'; ?>" enctype="multipart/form-data">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Segmen *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" id = "customer_id" name = "customer_id" value = "<?php echo $id; ?>">
                            <input type="hidden" id = "presales_customer_customer_id" name = "presales_customer_customer_id">
                            <select id="segmen" name="segmen" class="form-control input" required="required" data-parsley-errors-container="#for_order_type">
                                <option value="">-- Select --</option>
                                <?php foreach ($segmen as $key => $value) { ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Area
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <!-- <input type="text" id="area" name="area" required="required" class="form-control" maxlength="200"> -->
                            <select id="area" name="area" class="form-control js-example-tags input" required="required" data-parsley-errors-container="#for_order_type">
                                <option value="">-- Select --</option>
                                <?php foreach ($kab as $key => $value) { ?>
                                <option value="<?php echo $value['name'] ?>"><?php echo $value['name'] ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('area', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>

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
                            <?php echo form_error('name', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>


                    <!-- <div class="item form-group">
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
                    </div> -->
                    <div class="item form-group" style="display: none;" id="input_category">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">New Category *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="category_name" name="category_name" class="form-control" maxlength="100">
                            <?php echo form_error('category_name', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Service *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="service" name="service" required="required" class="form-control select2">
                                <option value="0"></option>
                                <optgroup label="IP Transit Internasional (IX)">
                                <?php foreach($product as $row){if($row->PARENT_ID=='1'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup>
                                <optgroup label="IP Transit Domestic (IIX)">
                                <?php foreach($product as $row){if($row->PARENT_ID=='2'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup> 
                                <optgroup label="Internasional Link">
                                <?php foreach($product as $row){if($row->PARENT_ID=='3'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup> 
                                <optgroup label="Domestic Link">
                                <?php foreach($product as $row){if($row->PARENT_ID=='4'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup> 
                                <optgroup label="Internet Exchange">
                                <?php foreach($product as $row){if($row->PARENT_ID=='5'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup> 
                                <optgroup label="NDC  (Collocation)">
                                <?php foreach($product as $row){if($row->PARENT_ID=='6'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup> 
                                <optgroup label="Additional Product">
                                <?php foreach($product as $row){if($row->PARENT_ID=='7'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup> 
                                <optgroup label="Oxygen">
                                <?php foreach($product as $row){if($row->PARENT_ID=='8'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup> 
                                <optgroup label="BTS Backhaul - Tower">
                                <?php foreach($product as $row){if($row->PARENT_ID=='9'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup>
                                <optgroup label="New Product">
                                <?php foreach($product as $row){if($row->PARENT_ID=='10'){echo "<option value=".$row->ID_PRODUCT.">".$row->PRODUCT_NAME."</option>";}}?>
                                </optgroup> 
                            </select>
                            <!-- <input type="text" id="name" name="name" required="required" class="form-control" maxlength="200"> -->
                            <?php echo form_error('name', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Type Service *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="type_service" name="type_service" class="form-control select2 input"  data-parsley-errors-container="#for_order_type">
                            <option></option>
                            <option value="NEW LINK">NEW LINK</option>
                            <option value="UPGRADE">UPGRADE</option>
                            <option value="DOWNGRADE">DOWNGRADE</option>
                            
                            <option value="RELOKASI">RELOKASI</option>
                            </select>
                            <span id = "for_order_type"></span>
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
                    <!-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Contact Number *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="telephone" name="telephone" required="required" class="form-control tagsinput" maxlength="30">
                            <?php echo form_error('telephone', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div> -->
                    <!-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="email" id="email" name="email" required="required" class="form-control" maxlength="50">
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div> -->
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Company Address *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="address" name="address" class="form-control" required=""></textarea>
                            <?php echo form_error('address', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Koordinat Latitude *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="latitude" name="latitude" class="form-control" maxlength="50" required="">
                            <span class="description text-danger">Format Decimal (-6.17540016).</span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Koordinat Longitude *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="longitude" name="longitude" class="form-control" maxlength="50" required="">
                            <span class="description text-danger">Format Decimal (106.82706955).</span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Lantai Ruang Terminasi
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="ruang_terminasi" name="ruang_terminasi" required="required" class="form-control" maxlength="50">
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>

                    <div id = "akses">
                        <div class="form-group">                  
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Alamat Instalasi Sebelumnya</label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control" id="field-ta" data-validate="required" data-message-required="This is custom message for required field." placeholder="Textarea" name="instalasiB" id="instalasiB"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Koordinat *</label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="mask form-control" name="koordinatB" id="koordinatB" />
                                <span class="description text-danger">Format Decimal (-6.17540016, 106.82706955).</span>      
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Lantai ruang terminasi</label>

                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-validate="required" data-message-required="This is custom message for required field." name="ruangB" id="ruangB" />

                            </div>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Kapasitas
                        </label>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <select name="mix" id="mix" class="form-control" data-allow-clear="true" data-placeholder="Select ..." onChange="kapasitasset(this.value);">
                                <option></option>
                                <option value="MIX">MIX</option>
                                <option value="IX">IX</option>
                                <option value="IIX">IIX</option>
                                <option value="LL">LL / Metro</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="number" id="kapasitas" name="kapasitas" class="form-control" data-validate="required" data-message-required="This is custom message for required field." /> <!-- data-mask="decimal" -->
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <select name="satuan" id="satuan" class="form-control" data-allow-clear="true" data-placeholder="Select ...">
                                <option></option>

                                <option value="Kbps">Kbps</option>
                                <option value="Mbps">Mbps</option>
                                <option value="GbPS">Gbps</option>
                                <option value="E1">E1</option>
                                <option value="VC3">VC3</option>
                                <option value="STM">STM</option>
                                <option value="Rack">Rack</option>
                                <option value="Core">Core</option>
                                <option value="1U">1U</option>
                                <option value="2U">2U</option>
                        
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">
                        </label>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <select name="mix1" id="mix1" class="form-control" data-allow-clear="true" data-placeholder="Select ..." onChange="kapasitasset1(this.value);">
                                <option></option>
                                <option value="MIX">MIX</option>
                                <option value="IX">IX</option>
                                <option value="IIX">IIX</option>
                                <option value="LL">LL / Metro</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="number" id="kapasitas1" name="kapasitas1" class="form-control" data-validate="required" data-message-required="This is custom message for required field." /> <!-- data-mask="decimal" -->
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <select name="satuan1" id="satuan1" class="form-control" data-allow-clear="true" data-placeholder="Select ...">
                                <option></option>

                                <option value="Kbps">Kbps</option>
                                <option value="Mbps">Mbps</option>
                                <option value="GbPS">Gbps</option>
                                <option value="E1">E1</option>
                                <option value="VC3">VC3</option>
                                <option value="STM">STM</option>
                                <option value="Rack">Rack</option>
                                <option value="Core">Core</option>
                                <option value="1U">1U</option>
                                <option value="2U">2U</option>
                        
                            </select>
                        </div>
                    </div>
                    <!-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">
                        </label>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <input type="text" id="ruang_terminasi" name="ruang_terminasi" required="required" class="form-control" maxlength="50">
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <select id="order_type" name="order_type" class="form-control input" required="required" data-parsley-errors-container="#for_order_type">
                            <option></option>
                            <option value="NEW LINK">NEW LINK</option>
                            <option value="UPGRADE">UPGRADE</option>
                            <option value="DOWNGRADE">DOWNGRADE</option>
                            
                            <option value="RELOKASI">RELOKASI</option>
                            </select>
                            <span id = "for_order_type"></span>
                        </div>
                         <div class="col-md-2 col-sm-6 col-xs-12">
                            <input type="text" id="ruang_terminasi" name="ruang_terminasi" required="required" class="form-control" maxlength="50">
                        </div>
                    </div> -->

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Interface *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="interface" name="interface" required="required" class="form-control" maxlength="50">
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Media
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="media" name="media" class="form-control input" data-parsley-errors-container="#for_order_type">
                                <option></option>

                                <option value="FO">FO</option>
                                <option value="Wireless">Wireless</option>
                                <option value="VSAT IP">VSAT IP</option>
                                <option value="VSAT SCPC">VSAT SCPC</option>

                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Existing Provider
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="existing_provider" name="existing_provider" required="required" class="form-control" maxlength="50">
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Budget
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="budget" name="budget" required="required" class="form-control" maxlength="50">
                            <?php echo form_error('email', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Upload List Data
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" data-role="magic-overlay" data-target="#" name = "list_data" />
                                <span class = "help-block hidden po_file"><span class = "fa fa-paperclip"></span><a class = "po_link" target="_blank"></a></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Notes
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="notes" name="notes" class="form-control" required=""></textarea>
                            <?php echo form_error('address', '<span class="help-block" style="color: red">', '</span>'); ?>
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
    $(document).ready(function() {
        $('#akses').hide(); 

        var customer_id = $('#customer_id').val();

        $.ajax({
            type : 'GET', 
            url : '/customer/customer_detail/'+customer_id,
            async : false, 
            dataType : 'json', 
            success : function(res){
              if(res.status == 200){
                var presales = res.data.presales;
                console.log(presales.SEGMEN);
                $("#segmen").val(presales.SEGMEN).trigger('change');
              }
            }
        });

        console.log(customer_id);       
    })
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

    $('#service').change(function(e){
        e.preventDefault();
        if($(this).val() == 74){
            console.log('show');
            $('#akses').show();
        } else {
            console.log('hides');
            $('#akses').hide();
        }
    })
</script>