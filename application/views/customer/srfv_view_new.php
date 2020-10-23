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
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer'; ?>">List</button> &nbsp;
                    <?php if($srf->status == 'Submitted' && $this->session->userdata('id') == $srf->approver_id){?>
                    <button type="button" class="btn btn-success" id = "button_approval">Approve</button> &nbsp;
                    <button type="button" class="btn btn-danger" id = "button_reject">Reject</button> &nbsp;
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if($srf->status == 'Approved'){?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>This document has been approved by <?php echo $srf->approved_by_name?></strong> on <?php echo date('d F Y H:i', strtotime($srf->approval_date))?>
                </div>
                <?php } ?>
                <table class="" style="width: 100%;border:1px solid #000">
                    <thead class="">
                    <tr>
                        <td rowspan = '5' style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000;width: 300px;font-size: 11px;">PT. MORA TELEMATIKA INDONESIA <br/>
                        Grha 9  6th Floor  Jalan Penataran No. 9 <br/>
                        Jakarta Pusat 10320</td>
                        <td rowspan = '5' style="padding: 5px 10px;color:#000;text-align: center;font-weight:bold;border:1px solid #000;width: 300px;font-size: 20px;">SERVICE REQUEST FORM</td>
                        <td rowspan = '5' style="padding: 5px 10px;color:#000;text-align: center;font-weight:bold;border:1px solid #000;width: 380px;"><img src="<?php echo base_url()?>/assets/img/logo-moratel.png"></td>
                        <td style="padding: 5px 10px;width: 300px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000;">Input Date</td>
                        <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo date('d M Y', strtotime($srf->input_date))?></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000">SRF No.</td>
                        <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->srf_number ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000">PO Reference No.</td>
                        <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo !empty($srf->po_number)? $srf->po_number : '-' ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000">BP Reference No. </td>
                        <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo !empty($srf->bp_number)? $srf->bp_number : '-' ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000">Customer ID </td>
                        <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo !empty($srf->customer_id)? $srf->customer_id : '-' ?></td>
                    </tr>
                    <!-- <tr>                                    
                        <th colspan="6" style="padding: 8px 20px;background-color: rgb(191,191,191);color:#000;text-align: center;font-weight:bold;border:1px solid #000"><h2>PROJECT CHARTER</h2></th>
                    </tr> -->
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">REQUESTED BY :</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Employee ID</td>
                            <td style="padding: 5px 10px;color:#000;text-align: border:1px solid #000"><?php echo $srf->employee_no ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Department</td>
                            <td colspan= '4' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $user->department?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Name</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $user->fullname ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Supervisor Name</td>
                            <td colspan= '4' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $user->supervisor_name?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Positon Title</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $user->position_title ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Mobile Phone</td>
                            <td colspan= '4' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $user->mobile_number?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Level</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $user->level ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Email</td>
                            <td colspan= '4' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $user->email?></td>
                        </tr>
                        <tr>
                            <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">CUSTOMER CLASSIFICATION</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Customer Status</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->customer_status ?></td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Customer Classification</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->customer_classification?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Type of Customer</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->customer_type ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">SLA (CEM)</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $class_detail->sla_sales?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">MTT Respond</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000;width:150px;"><?php echo $class_detail->mttr?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Market Segment</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->market_segment ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Problem Notification</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $class_detail->problem_notification?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">MTT Update</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $class_detail->mttu?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Business Line</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->business_line ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Escalation Level</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000;width: 150px;"><?php echo $class_detail->escalation_level?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Reporting</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000;width: 100px;"><?php echo $class_detail->reporting?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Scale of Customer</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->scale ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Single Point of Contact</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $class_detail->single_point_of_contact?></td>
                            <td  style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Meeting</td>
                            <td colspan= '2'style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $class_detail->meeting?></td>
                        </tr>
                        <!-- Personal -->
                        <?php if($srf->customer_type == 'Corporate'){ ?>
                        <tr>
                            <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">CORPORATE CUSTOMER INFORMATION</td>
                        </tr>

                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Name of Company</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $customer->name ?></td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">NPWP Number</td>
                            <td colspan = "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $customer->npwp?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Organization Level</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $customer->organization_level ?></td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">SIUP Number</td>
                            <td colspan = "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $customer->siup?></td>
                        </tr>

                        <tr>
                            <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Director</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Name: </b><?php echo $customer->director_name ?></td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">Company Phone : <?php echo $customer->director_company_phone?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Ext: </b><?php echo $customer->director_ext?></td>
                            <td colspan = "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Hp : </b><?php echo $customer->director_hp?></td>
                        </tr>

                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Email : </b></td>
                            <td colspan = "5" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;background-color:rgb(69,90,100);"></td>
                        </tr>

                        <tr>
                            <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Commercial Contact Person</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Name: </b><?php echo $customer->commercial_pic_name ?></td>
                            <td colspan = "5" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;">Job Function - Department :<?php echo $customer->commercial_pic_job ?></td>
                        </tr>

                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Email : <?php echo $customer->commercial_pic_email ?></b></td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Company Phone :<?php echo $customer->commercial_pic_company_phone ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Ext: </b><?php echo $customer->commercial_pic_ext ?></td>
                            <td colspan = "5" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Hp : </b><?php echo $customer->commercial_pic_hp ?></td>
                        </tr> 
                        <!--Technical -->
                        <tr>
                            <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Technical Contact Person</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Name: </b><?php echo $customer->technical_pic_name ?></td>
                            <td colspan = "5" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;">Job Function - Department :<?php echo $customer->technical_pic_job ?></td>
                        </tr>

                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Email : <?php echo $customer->technical_pic_email ?></b></td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Company Phone :<?php echo $customer->technical_pic_company_phone ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Ext : </b><?php echo $customer->technical_pic_ext ?></td>
                            <td colspan = "5" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Hp : </b><?php echo $customer->technical_pic_hp ?></td>
                        </tr>
                        <?php } else {?>

                        <!-- Personal -->
                        <tr>
                            <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">PERSONAL CUSTOMER INFORMATION</td>
                        </tr>

                        <tr>
                            <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Contact Person</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Name: </b><?php echo $customer->name ?></td>
                            <td colspan = "4" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;">Personnal ID ( KTP/Kitas/Passport ) :<?php echo $customer->personal_id ?></td>
                        </tr> 
                        <tr>
                            <td colspan="2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Birthdate : <?php if($customer->birthday != '1970-01-01') echo $customer->birthday; else echo "-";?></td>
                            <td colspan = "4" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;">NPWP No :<?php echo $customer->npwp ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Gender : </b><?php if($customer->gender == 'M') echo "Laki-laki"; else echo "Perempuan";?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Nationality : </b><?php echo $customer->nationality ?></td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align:left;border:1px solid #000;"><b>Phone :</b><?php echo $customer->phone ?></td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align:left;border:1px solid #000;"><b>Mobile :</b><?php echo $customer->mobile ?></td>
                        </tr>
                        <?php } ?>
                        <!--Correspondence-->
                        <tr>
                            <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Correspondence Address </b></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->correspondence_building_name?></td>
                            <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Billing Address </b></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->billing_building_name?></td>
                        </tr>  
                        <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->correspondence_floor_block?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->billing_floor_block?></td>
                        </tr>
                        <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->correspondence_address?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->billing_address?></td>
                        </tr>
                        <!-- <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->correspondence_subdistrict?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->billing_subdistrict?></td>
                        </tr>
                        <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->correspondence_district?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->billing_district?></td>
                        </tr> -->
                        <!-- <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->correspondence_city?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->billing_city?></td>
                        </tr> -->
                        <!-- <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->correspondence_state?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->billing_state?></td>
                        </tr> -->
                        <!-- <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->correspondence_zip_code?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $srf->billing_zip_code?></td>
                        </tr> -->
                        

                        <?php foreach($services as $k => $r ){ ?>
                        <tr>
                            <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">INSTALLATION ADDRESS</td>
                        </tr>

                        <tr>
                            
                            <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Interconnection Point</td>
                            <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->interconnection_point?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                            <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->address?></td>
                        </tr>

                        <tr>
                           <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Rack ID</td>
                           <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->rack_id?></td>
                           </tr>
                        <tr>

                        <tr>
                            <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Moratelindo/Third Party Site </b></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b></b><?php echo $r->ne_site_id?></td>
                            <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Customer Site </b></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b></b><?php echo $r->fe_building_name?></td>
                        </tr>  
                        <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b></b><?php echo $r->ne_floor?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->fe_floor?></td>
                        </tr>
                        <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b></b><?php echo $r->ne_address?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->fe_address?></td>
                        </tr>
                        <!-- <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->ne_subdistrict?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->fe_subdistrict?></td>
                        </tr> -->
                        <!-- <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->ne_district?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->fe_district?></td>
                        </tr> -->
                        <!-- <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->ne_city?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->fe_city?></td>
                        </tr>
                        <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->ne_state?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->fe_state?></td>
                        </tr>
                        <tr>
                            
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->ne_zip_code?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>
                            <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->fe_zip_code?></td>
                        </tr> -->

                        <tr>
                            <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">SERVICE REQUEST</td>
                        </tr>

                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Classification</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->group_name ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Sub-Classification</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->product_subclassification?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Name</td>
                            <td colspan= '6' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->subservice_name ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Capacity / Bandwidth / Qty</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->capacity ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Unit of Measurement</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->uom?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Type of Order</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->type_of_order ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Billing Type</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->billing_type?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Status</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->service_status ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Owner</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->service_owner?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product SLA</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->sla ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">SLA Restitution</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->sla_restitution?></td>
                        </tr>

                         <tr>
                            <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Time of Service</b></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">RFS Date</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php if($r->rfs_date == '1970-01-01') echo "-"; else echo $r->rfs_date;?></td>
                            <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Duration of Contract Agreement</b></td>
                            <td colspan = "3" rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->duration_contract ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">End of Temporary Service :</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php if($r->end_temp_service == '1970-01-01') echo "-"; else echo $r->end_temp_service;?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Layer</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->service_layer ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Media Transmission</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->media?></td>
                        </tr>

                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Interface Connection</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->interface_connection ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Connection Methode</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->connection_method?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Protocol Technology</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->protocol_technology ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">CPE Equipment</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->cpe_equipment?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Link / System Protection</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Backbone</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->backbone_protection?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Access</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->access_protection ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> Lastmile</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->lastmile_protection ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Other Protection</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Equipment</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->equipment_protection?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Security</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->security_protection ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> Others</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->other_protection ?></td>
                        </tr>

                        <!-- <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Monitoring Tools</td>
                            <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->monitoring_tools ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Managed by</td>
                            <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->service_managed_by?></td>
                        </tr> -->
                        <tr>
                          <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Monitoring</td>
                          <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->monitoring_tools ?></td>
                          <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Managed by</td>
                          <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->service_managed_by?></td>
                          <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Item Code</b></td>
                          <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->item_code_desc?></td>
                          </tr>
                        <tr>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Management</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Billing Provide by</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->billing_by?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Lastmile Managed by</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->lastmile_by ?></td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> CPE Managed by</td>
                            <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><?php echo $r->cpe_by ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">ADDITIONAL NOTES</td>
                        </tr>
                        <tr>
                            <td colspan= '7' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000;height: 200px;"><?php echo $srf->notes?></td>
                        </tr>

                    </tbody>
                    
                </table>

                <!-- <table class="table table-bordered" style = "border:1px solid rgba(221,221,221,.78);">
                    <tr>
                        <td colspan="4" style="background: #BBDEFB;"><p><b><span class= "fa fa-pencil"></span> Notes</b></p></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo $srf->notes?></td>
                    </tr>
                </table> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Are you sure want to this SRF?</h4>
            </div>
            <form id = "approval_form" method="POST">
                <div class="modal-body">
                    <h4>Add some notes here</h4>
                    <input type="hidden" name="action_type" id = "action_type">
                    <input type="hidden" name="srf_id" value = "<?php echo $srf->srf_id?>">

                    <textarea name = "approval_notes" class="form-control"></textarea>               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Yes, Approve It</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#button_approval').click(function(){
            $('.bs-example-modal-sm').modal('show');
            $('#myModalLabel2').html('Are you sure want approve to this SRF?');
            $('#action_type').val('Approved');
        })

        $('#button_reject').click(function(){
            $('.bs-example-modal-sm').modal('show');
            $('#myModalLabel2').html('Are you sure want reject to this SRF?');
            $('#action_type').val('Rejected');
        })

        $('#approval_form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type : 'POST', 
                url : '/customer/srf_approval/',
                async : false, 
                data : form.serialize(),
                dataType : 'json', 
                success : function(res){
                  if(res.status == 200){
                    location.reload();
                  }
                }
            });

            console.log('submit'); 
        })
    })
</script>