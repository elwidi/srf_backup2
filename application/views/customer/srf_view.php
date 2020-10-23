<style type="text/css">
  .select2-container {
    min-width: 390px;
  }
  .required {
    color:#f44336;
  }
  .service {
    font-size:100%;
  }
</style>

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
                <h2>View</h2>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer'; ?>">List</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-framed" style = "border:1px solid rgba(221,221,221,.78);">
                    <tr>
                        <td colspan="2"><label class="control-label">SRF Number</label></td>
                        <td colspan="2"><?php echo $srf->srf_number ?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Input Date</label></td>
                        <td><?php echo date('d M Y', strtotime($srf->input_date))?></td>
                        <td><label class="control-label">Customer ID</label></td>
                        <td><?php echo !empty($srf->customer_id)? $srf->customer_id : '-' ?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">PO Number</label></td>
                        <td><?php echo !empty($srf->po_number)? $srf->po_number : '-' ?></td>
                        <td><label class="control-label">BP Number</label></td>
                        <td><?php echo !empty($srf->bp_number)? $srf->bp_number : '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><h4><b><span class= "fa fa-paper-plane"></span> Requested By</b></h4></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Employee No</label></td>
                        <td><?php echo $srf->employee_no ?></td>
                        <td><label class="control-label">Name</label></td>
                        <td><?php echo $srf->name ?></td>
                    </tr> 
                    <tr>
                        <td><label class="control-label">Position</label></td>
                        <td></td>
                        <td><label class="control-label">Departemen</label></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Mobile Phone</label></td>
                        <td></td>
                        <td><label class="control-label">Email</label></td>
                        <td><?php echo $srf->email ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><h4><b><span class= "fa fa-star"></span> Customer Classification</b></h4></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Customer Classification</label></td>
                        <td><?php echo $srf->customer_classification ?></td>
                        <td><label class="control-label">Customer Status</label></td>
                        <td><?php echo $srf->customer_status ?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Customer Type</label></td>
                        <td><?php echo $srf->customer_type ?></td>
                        <td><label class="control-label">Number of Node</label></td>
                        <td><?php echo $srf->number_of_node ?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Scale</label></td>
                        <td><?php echo $srf->scale ?></td>
                        <td><label class="control-label">Coverage Status</label></td>
                        <td><?php echo $srf->coverage_status ?></td>
                    </tr> 
                    <?php if($srf->customer_type == 'Personal') { ?>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><h4><b><span class = "fa fa-user"></span> Personal Customer Information</b></h4></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Name</label></td>
                        <td><?php echo $srf->customer_name ?></td>
                        <td><label class="control-label">Birthday</label></td>
                        <td><?php echo date('d M Y', strtotime($customer->birthday)) ?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Gender</label></td>
                        <td><?php echo ($customer->gender == 'F')? "Female" : "Male" ?></td>
                        <td><label class="control-label">Nationality</label></td>
                        <td><?php echo $customer->nationality ?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Phone</label></td>
                        <td><?php echo $customer->phone?></td>
                        <td><label class="control-label">Mobile</label></td>
                        <td><?php echo $customer->mobile?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Personal ID</label></td>
                        <td><?php echo $customer->personal_id?></td>
                        <td><label class="control-label">NPWP</label></td>
                        <td><?php echo $customer->npwp?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Address</label></td>
                        <td colspan="3"><?php echo $customer->address?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Subdistrict</label></td>
                        <td><?php echo $customer->subdistrict?></td>
                        <td><label class="control-label">District</label></td>
                        <td><?php echo $customer->district?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">City</label></td>
                        <td><?php echo $customer->city?></td>
                        <td><label class="control-label">State</label></td>
                        <td><?php echo $customer->state?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Zip Code</label></td>
                        <td><?php echo $customer->zip_code?></td>
                        <td><label class="control-label">Profession</label></td>
                        <td><?php echo $customer->profession?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Type of Building</label></td>
                        <td><?php echo $customer->building_type?></td>
                        <td><label class="control-label">Number of Floor</label></td>
                        <td><?php echo $customer->number_of_floor?></td>
                    </tr>
                    <?php } else { ?>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><h4><b><span class= "fa fa-building"></span> Corporate Customer Information</b></h4></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Name of Company</label></td>
                        <td><?php echo $srf->customer_name?></td>
                        <td><label class="control-label">Organization Level</label></td>
                        <td><?php echo $customer->organization_level?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Address</label></td>
                        <td colspan="3"><?php echo $customer->address?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Subdistrict</label></td>
                        <td><?php echo $customer->subdistrict?></td>
                        <td><label class="control-label">District</label></td>
                        <td><?php echo $customer->district?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">City</label></td>
                        <td><?php echo $customer->city?></td>
                        <td><label class="control-label">State</label></td>
                        <td><?php echo $customer->state?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Zip Code</label></td>
                        <td><?php echo $customer->zip_code?></td>
                        <td><label class="control-label">Compay Phone</label></td>
                        <td><?php echo $customer->company_phone?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Fax</label></td>
                        <td><?php echo $customer->fax?></td>
                        <td><label class="control-label">Web</label></td>
                        <td><?php echo $customer->web?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><p><b><span class= "fa fa-credit-card"></span> Commercial Contact Person</b></p></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Name</label></td>
                        <td><?php echo $customer->commercial_pic_name?></td>
                        <td><label class="control-label">Email</label></td>
                        <td><?php echo $customer->commercial_pic_email?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Job Function - Department</label></td>
                        <td><?php echo $customer->commercial_pic_job?></td>
                        <td><label class="control-label">Mobile</label></td>
                        <td><?php echo $customer->commercial_pic_hp?></td>
                    </tr>

                    <tr>
                        <td><label class="control-label">Company Phone</label></td>
                        <td><?php echo $customer->technical_pic_company_phone?></td>
                        <td><label class="control-label">Ext</label></td>
                        <td><?php echo $customer->technical_pic_ext?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><p><b><span class= "fa fa-wrench"></span> Technical Contact Person</b></p></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Name</label></td>
                        <td><?php echo $customer->technical_pic_name?></td>
                        <td><label class="control-label">Email</label></td>
                        <td><?php echo $customer->technical_pic_email?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Job Function - Department</label></td>
                        <td><?php echo $customer->technical_pic_job?></td>
                        <td><label class="control-label">Mobile</label></td>
                        <td><?php echo $customer->technical_pic_hp?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Company Phone</label></td>
                        <td><?php echo $customer->technical_pic_company_phone?></td>
                        <td><label class="control-label">Ext</label></td>
                        <td><?php echo $customer->technical_pic_ext?></td>
                    </tr>               
                    <?php } ?>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><h4><b><span class= "fa fa-cogs"></span> Service Request</b></h4></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Type of Order</label></td>
                        <td><?php echo $srf->type_of_order?></td>
                        <td><label class="control-label">Type of Service Purpose</label></td>
                        <td><?php echo ($srf->service_purpose == 'Temporary' )? $srf->service_purpose.", ".$srf->temporary_service : $srf->service_purpose?></td>
                    </tr>
                    <tr>
                        <?php if($srf->service_status == '')?>
                        <td><label class="control-label">Service Status</label></td>
                        <td><?php echo $srf->service_status?></td>
                        <td><label class="control-label">Service Owner</label></td>
                        <td><?php echo $srf->service_purpose?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Service Group</label></td>
                        <td colspan="3">
                            <?php foreach($service_group as $key => $v) { ?>
                            <label class="label label-success service"><?php echo $v->group_name?></label>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Protocol Technology</label></td>
                        <td><?php echo $srf->protocol?></td>
                        <td><label class="control-label">Connection Method</label></td>
                        <td><?php echo $srf->connection_method?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Media</label></td>
                        <td><?php echo ($srf->media == 'FO' )? $srf->media.", ".$srf->media_detail : $srf->media?></td>
                        <td><label class="control-label">Interface</label></td>
                        <td><?php echo $srf->interface?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">RFS Date</label></td>
                        <td><?php echo !empty($srf->rfs_date)? date('d-m-Y', strtotime($srf->rfs_date)) : '-'?></td>
                        <td><label class="control-label">End of Temporary Service</label></td>
                        <td><?php echo $srf->end_temp_service !== '0000-00-00'? date('d-m-Y', strtotime($srf->end_temp_service)) : '-'?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><h4><b><span class= "fa fa-map-marker"></span> Installation Information</b></h4></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Interconnection Point</label></td>
                        <td colspan="3"><?php echo $installation->interconnection_point?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><p><b><span class= "fa fa-flag"></span> Near End</b></p></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Site ID</label></td>
                        <td><?php echo $installation->ne_site_id?></td>
                        <td><label class="control-label">Installation By</label></td>
                        <td><?php echo $installation->ne_by?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Address</label></td>
                        <td colspan="3"><?php echo $installation->ne_address?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Subdistrict</label></td>
                        <td><?php echo $installation->ne_subdistrict?></td>
                        <td><label class="control-label">District</label></td>
                        <td><?php echo $installation->ne_district?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">City</label></td>
                        <td><?php echo $installation->ne_city?></td>
                        <td><label class="control-label">State : <?php echo $installation->ne_state?></label></td>
                        <td><label class="control-label">Zip Code : <?php echo $installation->ne_zip_code?></label></td>
                    </tr>
                    <tr>
                        <td colspan="4"><p><b><span class= "fa fa-flag-o"></span> Far End (Customer Premise)</b></p></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Building Name</label></td>
                        <td><?php echo $installation->fe_building_name?></td>
                        <td><label class="control-label">Floor</label></td>
                        <td><?php echo $installation->fe_floor?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Address</label></td>
                        <td colspan="3"><?php echo $installation->fe_address?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Subdistrict</label></td>
                        <td><?php echo $installation->fe_subdistrict?></td>
                        <td><label class="control-label">District</label></td>
                        <td><?php echo $installation->fe_district?></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">City</label></td>
                        <td><?php echo $installation->fe_city?></td>
                        <td><label class="control-label">State : <?php echo $installation->fe_state?></label></td>
                        <td><label class="control-label">Zip Code : <?php echo $installation->fe_zip_code?></label></td>
                    </tr>
                    <tr>
                        <td><label class="control-label">Longitude : <?php echo $installation->fe_state?></label></td>
                        <td><label class="control-label">Latitude : <?php echo $installation->fe_zip_code?></label></td>
                        <td><label class="control-label">Installation By</label></td>
                        <td><?php echo $installation->fe_by?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><h4><b><span class= "fa fa-check-square"></span> Detail of Service</b></h4></td>
                    </tr>
                </table>
                <div class="col-md-6">
                    <?php foreach($service[0] as $idx => $srv) {?>
                    <table class="table table-bordered" style = "border:1px solid rgba(221,221,221,.78);">
                        <tr>
                            <td colspan="3" style="background: #C8E6C9;"><h5><b><?php echo $srv[0]->group_name?></b></h5></td>
                        </tr>
                        <tr>
                            <td>SO Name</td>
                            <td>Capacity/Quantity</td>
                            <td>UoM</td>
                        </tr>
                        <?php foreach ($srv as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value->subservice_name ?></td>
                            <td><?php echo $value->capacity ?></td>
                            <td><?php echo $value->uom ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php } ?>
                </div>
                <?php if(isset($service[1])){?>
                <div class="col-md-6">
                    <?php foreach($service[1] as $idx => $srv) {?>
                    <table class="table table-bordered" style = "border:1px solid rgba(221,221,221,.78);">
                        <tr>
                            <td colspan="3" style="background: #C8E6C9;"><h5><b><?php echo $srv[0]->group_name?></b></h5></td>
                        </tr>
                        <tr>
                            <td>SO Name</td>
                            <td>Capacity/Quantity</td>
                            <td>UoM</td>
                        </tr>
                        <?php foreach ($srv as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value->subservice_name ?></td>
                            <td><?php echo $value->capacity ?></td>
                            <td><?php echo $value->uom ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php } ?>
                </div>
                <?php } ?>

                <table class="table table-bordered" style = "border:1px solid rgba(221,221,221,.78);">
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><p><b><span class= "fa fa-pencil"></span> Notes</b></p></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo $srf->notes?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
</script>