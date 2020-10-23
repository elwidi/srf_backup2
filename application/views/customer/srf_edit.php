<style type="text/css">
  .select2-container {
    min-width: 390px;
  }
  .required {
    color:#f44336;
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
<input type="hidden" name="party_id" value = "party_id"/>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      
        <div class="x_panel">
            <div class="x_title">
                <h2>Service Request Form</h2>
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

                  <form id = "srf_form" method = "POST" action="<?php echo base_url().'customer/srf_edit/1'?>">

                
                    <!-- Smart Wizard -->
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">Header</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">Requested By</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">Customer Classification</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">Customer Information</span>
                          </a>
                        </li>

                        <li>
                          <a href="#step-5">
                            <span class="step_no">5</span>
                            <span class="step_descr">Service Request</span>
                          </a>
                        </li>
                        <!-- <li>
                          <a href="#step-6">
                            <span class="step_no">6</span>
                            <span class="step_descr">Installation Information</span>
                          </a>
                        </li> -->
                        <li>
                          <a href="#step-6">
                            <span class="step_no">6</span>
                            <span class="step_descr">Additional Notes</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-7">
                            <span class="step_no">7</span>
                            <span class="step_descr">Preview</span>
                          </a>
                        </li>
                      </ul>
                      <div id="step-1">
                        <div class="form-horizontal form-label-left form-step-1"> 
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Input Date
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="hidden" name = "fcustomer_id" id = "fcustomer_id" value = "<?php echo $id ?>">
                                  <input type="hidden" name = "srf_id" id = "srf_id" value = "<?php echo $real_srf_id ?>">
                                  <input type="hidden" name = "customer_presales_id" id = "customer_presales_id" value = "<?php echo $customer_presales ?>">
                                  <input type="text" id="input_date" name = "input_date" required="required" class="form-control col-md-7 col-xs-12 input" value = "<?php echo date('d/m/Y', strtotime($srf->input_date))?>" c>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">SRF Number
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="srf_number" name="srf_number" value = "<?php echo $srf->srf_number?>" required="required" class="form-control col-md-7 col-xs-12 input" readonly = "true">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">PO Reference Number <span class="required" >*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="po_number" name="po_number" required="required" class="form-control js-example-tags input" data-parsley-errors-container="#for_po_number" data-parsley-error-message="Please select PO Number">
                                    <option value="">-- Select --</option>
                                    <?php foreach ($po as $key => $value) {
                                      $selected = "";
                                      if($srf->po_number == $value->PO_NUMBER) $selected = "selected";
                                     ?>
                                      <option value="<?php echo $value->PO_NUMBER?>" <?php echo $selected;?>><?php echo $value->PO_NUMBER." - ". $value->COMMENTS?></option>
                                    <?php } ?>
                                  </select>
                                  <span id = "for_po_number">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">BP Reference Number <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <!-- <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="bp_number"> -->
                                  <select id="bp_number" name="bp_number" required="required" class="form-control js-example-tags input" data-parsley-errors-container="#for_bp_number" data-parsley-error-message="Please select BP Number">
                                    <option value="">-- Select --</option>
                                    <?php foreach ($bp as $key => $value) { 
                                      $selected = "";
                                      if($srf->bp_number == $value->BP_NO) $selected = "selected";
                                      ?>
                                      <option value="<?php echo $value->BP_NO?>" <?php echo $selected;?>><?php echo $value->BP_NO." - ". $value->TITLE?></option>
                                    <?php } ?>
                                  </select>
                                  <span id = "for_bp_number"></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Customer ID</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="customer_id" class="form-control col-md-7 col-xs-12" type="text" name="customer_id" value = "<?php $srf->customer_id?>">
                                </div>
                              </div>
                            </div>
                      </div>
                      <div id="step-2">
                          <div class="form-horizontal form-label-left form-step-2">
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Employee No
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="user_id" name="user_id" required="required" class="form-control col-md-7 col-xs-12 input" value = "<?php echo $user->employee_no?>">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="user_name" name="user_name" required="required" class="form-control col-md-7 col-xs-12 input" value = "<?php echo $user->fullname?>">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="user_position" class="form-control col-md-7 col-xs-12 input" type="text" name="user_position" value = "<?php echo $user->position_title?>">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Department</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="user_department" class="form-control col-md-7 col-xs-12 input" type="text" name="user_department" value = "<?php echo $user->department?>">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile Phone</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="user_mobile" class="form-control col-md-7 col-xs-12 input" type="text" name="user_mobile" value = "<?php echo $user->mobile_number?>">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="user_email" class="form-control col-md-7 col-xs-12 input" type="text" name="user_email" value = "<?php echo $user->email?>">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div id="step-3">
                        <div class="form-horizontal form-label-left form-step-3">
                          <div class="row">
                            <div class="col-md-6 col-xs-12">
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Customer Status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="customer_status" required name="customer_status" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_status" data-parsley-error-message="Please select a status">
                                        <option value="">-- Select --</option>
                                        <option value="Existing Customer" <?php if($srf->customer_status == 'Existing Customer') echo "selected"?>>Existing Customer</option>
                                        <option value="New Customer" <?php if($srf->customer_status == 'New Customer') echo "selected"?>>New Customer</option>
                                    </select>
                                    <span id = "for_customer_status"></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Customer <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="customer_type" name="customer_type" required="required" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_type" data-parsley-error-message="Please select a type">
                                    <option value="">-- Select --</option>
                                    <option value="Personal" <?php if($srf->customer_type == 'Personal') echo "selected"?>>Personal</option>
                                    <option value="Corporate" <?php if($srf->customer_type == 'Corporate') echo "selected"?>>Corporate</option>
                                  </select>
                                  <span id = "for_customer_type"></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Market Segment <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="market_segment" required name="market_segment" class="form-control js-example-tags input" data-parsley-errors-container="#for_market_segmen" data-parsley-error-message="Please select a status">
                                        <option value="">-- Select --</option>
                                        <?php foreach($market_segment as $key => $value) { ?>
                                        <option value = "<?php echo $value->market_segment?>" <?php if($srf->market_segment == $value->market_segment) echo "selected"?>> <?php echo $value->market_segment?> </option>
                                        <?php } ?>
                                        <!-- <option value = "TELCO"> TELCO </option>
                                        <option value = "WHOLESALE"> WHOLESALE </option>
                                        <option value = "ENTERPRISE - GBO"> ENTERPRISE - GBO </option>
                                        <option value = "ENTERPRISE - REGIONAL 1"> ENTERPRISE - REGIONAL 1 </option>
                                        <option value = "ENTERPRISE - REGIONAL 2"> ENTERPRISE - REGIONAL 2 </option>
                                        <option value = "ENTERPRISE - EDUFM"> ENTERPRISE - EDUFM </option>
                                        <option value = "ENTERPRISE - MEDHOS"> ENTERPRISE - MEDHOS </option>
                                        <option value = "ENTERPRISE - SME (HRB)"> ENTERPRISE - SME (HRB) </option>
                                        <option value = "ENTERPRISE - SMB (FTTX)"> ENTERPRISE - SMB (FTTX) </option>
                                        <option value = "ENTERPRISE - VENUE (WiFi)"> ENTERPRISE - VENUE (WiFi) </option>
                                        <option value = "RETAIL"> RETAIL </option>
                                        <option value = "BUSINESS PARTNERSHIP"> BUSINESS PARTNERSHIP </option>
                                        <option value = "PRODUCT PARTNERSHIP"> PRODUCT PARTNERSHIP </option> -->
                                      </select>
                                    <span id = "for_market_segmen"></span>
                                </div>
                              </div>
                              <div class="form-group parent">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Business Line<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <!--  <select id="business_line" required name="business_line" class="form-control js-example-tags input possibly_other" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please select item">
                                        <option value="">-- Select --</option>
                                        <option value = "TELCO OPERATOR">TELCO OPERATOR</option>
                                        <option value = "ISP">ISP</option>
                                        <option value = "APARTMENT">APARTMENT</option>
                                        <option value = "BANKING, FINANCE, INSURRANCE">BANKING, FINANCE, INSURRANCE</option>
                                        <option value = "BOARDING HOUSE (Kost-Kostan)">BOARDING HOUSE (Kost-Kostan)</option>
                                        <option value = "BUMN">BUMN</option>
                                        <option value = "EDUCATION (FORMAL)">EDUCATION (FORMAL)</option>
                                        <option value = "EDUCATION (NON-FORMAL)">EDUCATION (NON-FORMAL)</option>
                                        <option value = "FACTORY">FACTORY</option>
                                        <option value = "FINTECH">FINTECH</option>
                                        <option value = "FOOD & BEVERAGES">FOOD & BEVERAGES</option>
                                        <option value = "GOVERNMENT (MINISTRY)">GOVERNMENT (MINISTRY)</option>
                                        <option value = "GOVERNMENT (NON-MINISTRY)">GOVERNMENT (NON-MINISTRY)</option>
                                        <option value = "HOSPITAL & HEALTH CARE">HOSPITAL & HEALTH CARE</option>
                                        <option value = "HOTEL">HOTEL</option>
                                        <option value = "MALL">MALL</option>
                                        <option value = "MANUFACTURE">MANUFACTURE</option>
                                        <option value = "MEDIA (NEWSPAPER)">MEDIA (NEWSPAPER)</option>
                                        <option value = "MEDIA (ONLINE)">MEDIA (ONLINE)</option>
                                        <option value = "MEDIA (OTHERS)">MEDIA (OTHERS)</option>
                                        <option value = "MEDIA (RADIO)">MEDIA (RADIO)</option>
                                        <option value = "MEDIA (TV)">MEDIA (TV)</option>
                                        <option value = "MICRO BUSINESS (UMKM)">MICRO BUSINESS (UMKM)</option>
                                        <option value = "MINING">MINING</option>
                                        <option value = "OFFICE BUILDING">OFFICE BUILDING</option>
                                        <option value = "OIL & GAS">OIL & GAS</option>
                                        <option value = "PUBLIC AREA">PUBLIC AREA</option>
                                        <option value = "RESIDENTIAL CLUSTER">RESIDENTIAL CLUSTER</option>
                                        <option value = "RESIDENTIAL NON-CLUSTER">RESIDENTIAL NON-CLUSTER</option>
                                        <option value = "SMALL MEDIUM ENTERPRISE">SMALL MEDIUM ENTERPRISE</option>
                                        <option value = "SUPERBLOCK">SUPERBLOCK</option>
                                        <option value = "TECHNOLOGIES">TECHNOLOGIES</option>
                                        <option value = "VENUE, EVENT HALL">VENUE, EVENT HALL</option>
                                        <option value = "OTHERS…">OTHERS…</option>
                                      </select> -->
                                      <!-- <br/><br/> -->
                                      <input type="text" id="" name="business_line2" class="form-control col-md-9 col-xs-12 other_input" value = "<?php echo $srf->business_line?>">
                                    <span id = "for_business_line" ></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Scale of Customer User <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <!-- <select id="scale" name="scale" required="required" class="form-control js-example-tags input" data-parsley-errors-container="#for_scale" data-parsley-error-message="Please select a scale">
                                        <option value="">-- Select --</option>
                                        <option value = "<50 User"> <50 User </option>
                                        <option value = "51 - 100 User"> 51 - 100 User </option>
                                        <option value = "100 - 500 User"> 100 - 500 User </option>
                                        <option value = "501 - 1000 User"> 501 - 1000 User </option>
                                        <option value = ">1000 User"> >1000 User </option>
                                    </select> -->
                                    <input type="text" id="" name="business_line2" class="form-control col-md-9 col-xs-12 other_input" value = "<?php echo $srf->scale?>">
                                    <span id = "for_scale"></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Customer Classification <span class="required">*</span> 
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <!-- <select id="customer_classification" name="customer_classification" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">
                                        <option value="">-- Select --</option>
                                        <option value="VVIP">VVIP</option>
                                        <option value="Platinum">Platinum</option>
                                        <option value="Gold">Gold</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Bronze">Bronze</option>
                                    </select> -->
                                    <input type="text" id="" name="business_line2" class="form-control col-md-9 col-xs-12 other_input" value = "<?php echo $srf->customer_classification?>">
                                    <span id = "for_customer_classification"></span>
                                </div>
                              </div>
                              <div class = "row">
                                <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">SLA (CEM)<span class="required">*</span> 
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input id="sla_cem" class="form-control col-md-7 col-xs-12 input" type="text" name = "sla_cem" value="<?php echo $class_detail->sla_sales?>" >
                                        <span id = "for_customer_classification"></span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">MTTRespond <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input id="mttr" class="form-control col-md-7 col-xs-12 input" type="text" name = "mttr" value = "<?php echo $class_detail->mttr?>">
                                        <span id = "for_customer_classification"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class = "row">
                                <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Problem Notification <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input id="problem_notif" class="form-control col-md-7 col-xs-12 input" type="text" name = "problem_notif" value = "<?php echo $class_detail->problem_notification?>">
                                        <span id = "for_customer_classification"></span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">MTTUpdate <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input id="mttu" class="form-control col-md-7 col-xs-12 input" type="text" name = "mtttu" value = "<?php echo $class_detail->mttu?>">
                                        <span id = "for_customer_classification"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class = "row">
                                <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Escalation Level <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input id="escalation" class="form-control col-md-7 col-xs-12 input" type="text" name = "escalation_level"  value = "<?php echo $class_detail->escalation_level?>">
                                        <span id = "for_customer_classification" ></span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Reporting <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input id="reporting" class="form-control col-md-7 col-xs-12 input" type="text" name = "reporting" value = "<?php echo $class_detail->reporting?>">
                                        <span id = "for_customer_classification" ></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class = "row">
                                <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Single Point of Contact <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input id="single_contact" class="form-control col-md-7 col-xs-12 input" type="text" name = "single_contact" value = "<?php echo $class_detail->single_point_of_contact?>">
                                        <span id = "for_customer_classification" ></span>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Meeting <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <input id="meeting" class="form-control col-md-7 col-xs-12 input" type="text" name = "meeting" value = "<?php echo $class_detail->meeting?>">
                                        <span id = "for_customer_classification"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="step-4">
                        <div class="form-horizontal form-label-right form-step-4">
                          <div id = "corporate">
                            <h4><b>Corporate Customer Information</b></h4>
                            <div class="ln_solid"></div>
                            <div class = "row">

                              <div class="col-md-6 col-xs-12">
                                <div class="row">
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name of Company <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="company_name" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[name]" required="required" data-parsley-errors-container="#for_company_name" data-parsley-error-message="Please fill company name" value="<?php if(!empty($customer['corporate'])) echo $customer['corporate']->name ?>">
                                            <span id = "for_company_name"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Organization Level <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <select id="organization_level" name="company[organization_level]" required="required" class="form-control js-example-tags input company" data-parsley-errors-container="#for_organization_level" data-parsley-error-message="Please select a organization level">
                                                <option value="">-- Select --</option>
                                                <option value="Head Office" <?php if(!empty($customer['corporate'])){ if($customer['corporate']->organization_level == 'Head Office') echo "selected"; }?>>Head Office</option>
                                                <option value="Branch Office" <?php if(!empty($customer['corporate'])){ if($customer['corporate']->organization_level == 'Branch Office') echo "selected"; }?>>Branch Office</option>
                                            </select>
                                            <span id = "for_organization_level"></span>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-6 col-xs-12">
                                <div class="row">
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP</label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="company_npwp" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[npwp]" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->npwp ?>">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">SIUP</label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="company_siup" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[siup]" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->siup ?>">
                                      </div>
                                  </div>

                                  <!-- <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Line of Bussiness <span class="required">*</span></label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="category" name="company[category]" required="required" class="form-control js-example-tags input company" data-parsley-errors-container="#for_category" data-parsley-error-message="Please select a organization level">
                                              <option value="">-- Select --</option>
                                              <option value="Gov, Mining, Oil & Gas">Gov, Mining, Oil & Gas</option>
                                              <option value="Wholesaler">Wholesaler</option>
                                              <option value="Banking & Financing">Banking & Financing</option>
                                              <option value="Property">Property</option>
                                              <option value="Telecommunication">Telecommunication</option>
                                              <option value="Education">Education</option>
                                              <option value="Media & Hospitality">Media & Hospitality</option>
                                          </select>
                                          <span id = "for_category"></span>
                                      </div>
                                  </div> -->
                                </div>
                              </div>
                            </div>
                            <br/>
                            <h4><b>Director</b></h4>
                            <div class="ln_solid"></div>
                            <div class = "row">
                              <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="director_name" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[director_name]" required="required" data-parsley-errors-container="#for_director_name" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->director_name ?>">
                                        <span id = "for_director_name"></span>
                                    </div>
                                </div>

                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_director_email" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[director_email]" required="required" data-parsley-errors-container="#for_director_email" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->director_email ?>">
                                        <span id = "for_director_email"></span>
                                    </div>
                                </div>
                              </div>


                              <div class="col-md-6 col-xs-12">
                                

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Phone <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_director_phone" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[director_phone]" required="required" data-parsley-errors-container="#for_director_phone" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->director_company_phone ?>"> 
                                        <span id = "for_director_phone"></span>
                                    </div>
                                </div>
                                


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ext <span class="required">*</span></label>
                                    <div class="col-md-3 col-sm-2 col-xs-12">
                                        <input id="company_director_ext" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[director_ext]" required="required" data-parsley-errors-container="#for_director_ext" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->director_ext ?>">
                                        <span id = "for_director_ext"></span>

                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-6">Hp</label>
                                    <div class="col-md-4 col-sm-2 col-xs-12">
                                        <input id="company_director_hp" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[director_hp]" data-parsley-errors-container="#for_director_hp" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->director_hp ?>">
                                        <span id = "for_director_hp"></span>

                                    </div>
                                </div>
                              </div>
                            </div>

                            <div class = "row">
                              <div class="col-md-6 col-xs-12">
                                <h4><b>Commercial Contact Person</b></h4>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_commercial_name" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_name]" required="required" data-parsley-errors-container="#for_commercial_name" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->commercial_pic_name ?>">
                                        <span id = "for_commercial_name"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_commercial_email" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_email]" required="required" data-parsley-errors-container="#for_commercial_email" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->commercial_pic_email ?>">
                                        <span id = "for_commercial_email"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Job Function & Department <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_commercial_job" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_job]" required="required" data-parsley-errors-container="#for_commercial_job" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->commercial_pic_job ?>">
                                        <span id = "for_commercial_job"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Phone <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_commercial_phone" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_phone]" required="required" data-parsley-errors-container="#for_commercial_phone"  value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->commercial_pic_company_phone ?>">
                                        <span id = "for_commercial_phone"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ext <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-2 col-xs-12">
                                        <input id="company_commercial_ext" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_ext]" required="required" data-parsley-errors-container="#for_commercial_ext" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->commercial_pic_ext ?>">
                                        <span id = "for_commercial_ext"></span>

                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-6">Hp <span class="required">*</span></label>
                                    <div class="col-md-3 col-sm-2 col-xs-12">
                                        <input id="company_commercial_hp" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_hp]" required="required" data-parsley-errors-container="#for_commercial_hp" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->commercial_pic_hp ?>">
                                        <span id = "for_commercial_hp"></span>

                                    </div>
                                </div>
                              </div>


                              <div class="col-md-6 col-xs-12">
                                <h4><b>Technical Contact Person</b></h4>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_technical_name" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_name]" required="required" data-parsley-errors-container="#for_technical_name" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->technical_pic_name ?>">
                                        <span id = "for_technical_name"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_technical_email" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_email]" required="required" data-parsley-errors-container="#for_technical_email" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->technical_pic_email ?>">
                                        <span id = "for_technical_email"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Job Function & Department <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_technical_job" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_job]" required="required" data-parsley-errors-container="#for_technical_job" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->technical_pic_job ?>">
                                        <span id = "for_technical_job"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Phone <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_technical_phone" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_phone]" required="required" data-parsley-errors-container="#for_technical_phone" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->technical_pic_company_phone ?>">
                                        <span id = "for_technical_phone"></span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ext <span class="required">*</span></label>
                                    <div class="col-md-3 col-sm-2 col-xs-12">
                                        <input id="company_technical_ext" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_ext]" required="required" data-parsley-errors-container="#for_technical_ext" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->technical_pic_ext ?>">
                                        <span id = "for_technical_ext"></span>

                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-6">Hp <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-2 col-xs-12">
                                        <input id="company_technical_hp" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_hp]" required="required" data-parsley-errors-container="#for_technical_hp" value = "<?php if(!empty($customer['corporate'])) echo $customer['corporate']->technical_pic_hp ?>">
                                        <span id = "for_technical_hp"></span>

                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class = "row">
                                <div class="col-md-6 col-xs-12 dda">
                                  <h4><b>Correspondence Addres</b></h4>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Building Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                         <input id="c_building_name_c" class="form-control col-md-7 col-xs-12 company input" type="text" name="c_correspondence[building_name]" data-parsley-errors-container="#for_c_building_name_c" required="required" value = "<?php echo $srf->correspondence_building_name ?>">
                                        <span id = "for_c_building_name_c"></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                           <input id="c_floor_c" class="form-control col-md-7 col-xs-12 company input" type="text" name="c_correspondence[floor]" data-parsley-errors-container="#correspondence_floor_c_c" required="required" value = "<?php echo $srf->correspondence_floor_block ?>">
                                          <span id = "correspondence_floor_c_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <textarea id="c_address_c" name="c_correspondence[address]" class="form-control company input" required="required" data-parsley-errors-container= "#for_c_address_c" required="required"><?php echo $srf->correspondence_address ?></textarea>
                                          <span id = "for_c_address_c"></span>
                                      </div>
                                  </div>
                                  <!-- <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="city_c2" class="form-control city_text" type="hidden" name="c_correspondence[city]"> 
                                          <select id="city_c_c" required="required" class="form-control js-example-tags input company city" data-parsley-errors-container="#for_city_c_c">
                                            <option value="">-- Select --</option>
                                            <?php foreach($province as $k => $r){ ?>
                                            <option value="<?php echo $r['id'].'#'.$r['name'] ?>"><?php echo $r['name']?></option>
                                            <?php } ?>
                                          </select>
                                          <span id = "for_city_c_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="district_c_c" class="form-control col-md-7 col-xs-12 input district_text" type="hidden" name="c_correspondence[district]" >
                                          <select id="district_c2_c" class="form-control js-example-tags input company district" data-parsley-errors-container="#for_district_c_c" required="required">
                                            <option value="">-- Select --</option>
                                          </select>
                                          <span id = "for_district_c_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="subdistrict_c_c" class="form-control js-example-tags input company subdistrict" required = "required" data-parsley-errors-container="#for_fe_subdistrict_c_c" name="c_correspondence[subdistrict]">
                                            <option value="">-- Select --</option>
                                          </select>
                                          <span id = "for_fe_subdistrict_c_c"></span>
                                      </div>
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span>
                                      </label>
                                      <div class="col-md-4 col-sm-2 col-xs-12">
                                          <input id="state_c_c" class="form-control col-md-7 col-xs-12 input company" type="text" name="c_correspondence[state]" data-parsley-errors-container="#for_state_c_c" required="required">
                                          <span id = "for_state_c_c"></span>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code 
                                      </label>
                                      <div class="col-md-3 col-sm-2 col-xs-12">
                                          <input id="zip_code_c_c" class="form-control col-md-7 col-xs-12 input company" type="text" name="c_correspondence[zip_code]" data-parsley-errors-container="#for_zip_code_c_c">
                                          <span id = "for_zip_code_c_c"></span>
                                      </div>
                                  </div> -->
                                </div>

                                <div class="col-md-6 col-xs-12 dda">
                                  <h4><b>Billing Address</b></h4>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Building Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                         <input id="building_name_b_c" class="form-control col-md-7 col-xs-12 input company" type="text" name="c_billing[building_name]" data-parsley-errors-container="#building_name_b_c" value = "<?php echo $srf->billing_building_name ?>">
                                        <span id = "building_name_b_c"></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                           <input id="floor_b_c" class="form-control col-md-7 col-xs-12 input company" type="text" name="c_billing[floor]" data-parsley-errors-container="#for_floor_b_c" value = "<?php echo $srf->billing_floor_block ?>">
                                          <span id = "for_floor_b_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <textarea id="address_b_c" name="c_billing[address]" class="form-control input company" data-parsley-errors-container="#for_address_b_c"><?php echo $srf->billing_address ?></textarea>
                                          <span id = "for_address_b_c"></span>
                                      </div>
                                  </div>
                                  <!-- <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="city_b_c" class="form-control col-md-7 col-xs-12 city_text" type="hidden" name="c_billing[city]" data-parsley-errors-container=""> 
                                          <select id="city_b_c2" required="required" class="form-control js-example-tags input company city" data-parsley-errors-container="#for_city_b_c">
                                            <option value="">-- Select --</option>
                                            <?php foreach($province as $k => $r){ ?>
                                            <option value="<?php echo $r['id'].'#'.$r['name'] ?>"><?php echo $r['name']?></option>
                                            <?php } ?>
                                          </select>
                                          <span id = "for_city_b_c"></span> 
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="district_b_c_h" class="form-control col-md-7 col-xs-12 district_text" type="hidden" name="c_billing[district]">
                                          <select id="district_b_c" required="required" class="form-control js-example-tags input company district" data-parsley-errors-container="#for_district_b_c">
                                            <option value="">-- Select --</option>
                                          </select>
                                          <span id = "for_district_b_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="subdistrict_b_2" required="required" class="form-control js-example-tags input company subdistrict" data-parsley-errors-container="#for_subdistrict_b_c" name="c_billing[subdistrict]" required="required">
                                            <option value="">-- Select --</option>
                                          </select>
                                          <span id = "for_subdistrict_b_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">State
                                      </label>
                                      <div class="col-md-4 col-sm-2 col-xs-12">
                                          <input id="state_b_c" class="form-control col-md-7 col-xs-12 input company" type="text" name="c_billing[state]" data-parsley-errors-container="#for_state_b_c">
                                          <span id = "for_state_b_c"></span>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code
                                      </label>
                                      <div class="col-md-3 col-sm-2 col-xs-12">
                                          <input id="zip_code_b_c" class="form-control col-md-7 col-xs-12 input company" type="text" name="c_billing[zip_code]" data-parsley-errors-container="#for_zip_code_b_c">
                                          <span id = "for_zip_code_b_c"></span>
                                      </div>
                                  </div> -->
                                </div>
                              
                              </div>
                          </div>
                          <div id = "personal">
                            <h4><b>Personal Customer Information</b></h4>
                            <div class="ln_solid"></div>
                            <div class="row">
                              <div class="col-md-6 col-xs-12 dda">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="personal_name" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[name]" required="required" data-parsley-errors-container="#for_personal_name" value="<?php if(!empty($customer['personal'])) echo $customer['personal']->name ?>">
                                        <span id = "for_personal_name"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday</label>   
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="personal_birthday" class="form-control col-md-7 col-xs-12 input person single_date" type="text" name="personal[birthday]" data-parsley-errors-container="#for_personal_birthday" value="<?php if(!empty($customer['personal'])) echo $customer['personal']->birthday ?>">
                                        <span id = "for_personal_birthday"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <textarea id="personal_address" name="personal[address]" class="form-control input person" required="required" data-parsley-errors-container="#for_personal_address" data-parsley-error-message="Please fill personal address"><?php if(!empty($customer['personal'])) echo $customer['personal']->address ?></textarea>
                                        <span id = "for_personal_address"></span>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="personal_city" class="form-control col-md-7 col-xs-12 person city_text" type="hidden" name="personal[city]">
                                        <select id="personal_city2" required="required" class="form-control js-example-tags input person city" data-parsley-errors-container="#for_personal_city" data-parsley-error-message="Please fill city">
                                          <option value="">-- Select --</option>
                                          <?php foreach($province as $k => $r){ ?>
                                          <option value="<?php echo $r['id'].'#'.$r['name'] ?>"><?php echo $r['name']?></option>
                                          <?php } ?>
                                        </select>
                                        <span id = "for_personal_city"></span>
                                    </div>
                                </div> -->

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="personal_district" class="form-control col-md-7 col-xs-12 district_text person" type="hidden" name="personal[district]">
                                        <select id="personal_district2" required="required" class="form-control js-example-tags input person district" data-parsley-errors-container="#for_personal_district" data-parsley-error-message="Please fill district">
                                          <option value="">-- Select --</option>
                                        </select>
                                        <span id = "for_personal_district"></span>
                                    </div>
                                </div> -->
                                <!--mark!-->
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Subdistrict <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <select id="personal_subdistrict" required="required" class="form-control js-example-tags input person subdistrict" data-parsley-errors-container="#for_personal_subdistrict" data-parsley-error-message="Please fill district" name="personal[subdistrict]">
                                          <option value="">-- Select --</option>
                                        </select>
                                        <span id = "for_personal_subdistrict"></span>
                                    </div>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-2 col-xs-12">
                                        <input id="personal_state" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[state]" required="required" data-parsley-errors-container="#for_personal_state" data-parsley-error-message="Please fill state">
                                        <span id = "for_personal_state"></span>
                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code </label>
                                    <div class="col-md-3 col-sm-2 col-xs-12">
                                        <input id="personal_zip_code" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[zip_code]" data-parsley-errors-container="#for_personal_zip_code" data-parsley-error-message="Please fill zip code">
                                        <span id = "for_personal_zip_code"></span>
                                    </div>
                                </div> -->


                              </div>

                              <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <label class="control-label">
                                            <input type="radio" <?php if(!empty($customer['personal'])) { if($customer['personal']->gender == 'F') echo "checked"; } ?> id = "gender" class = "flat input person" value="F" name="personal[gender]" required="required" data-parsley-errors-container="#for_gender"> Female &nbsp; &nbsp; &nbsp; 
                                            <input type="radio" class = "flat" value="M" name="personal[gender]" <?php if(!empty($customer['personal'])) { if($customer['personal']->gender == 'M') echo "checked"; } ?>> Male
                                        </label>
                                        <span id = "for_gender"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nationality <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="personal_nationality" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[nationality]" required="required" data-parsley-errors-container="#for_personal_nationality" value = "<?php if(!empty($customer['personal'])) echo $customer['personal']->nationality ?>">
                                        <span id = "for_personal_nationality"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Personal ID <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="personal_personid" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[personid]" required="required" data-parsley-errors-container="#for_personal_personid" data-parsley-error-message="Please fill personid" value = "<?php if(!empty($customer['personal'])) echo $customer['personal']->personal_id ?>">
                                        <span id = "for_personal_personid"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="personal_npwp" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[npwp]" required="required" data-parsley-errors-container="#for_personal_npwp" data-parsley-error-message="Please fill npwp" value = "<?php if(!empty($customer['personal'])) echo $customer['personal']->npwp ?>">
                                        <span id = "for_personal_npwp"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone </label>
                                    <div class="col-md-4 col-sm-2 col-xs-12">
                                        <input id="personal_phone" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[phone]" value = "<?php if(!empty($customer['personal'])) echo $customer['personal']->phone ?>">
                                    </div>
                                    <label class="control-label col-md-1 col-sm-2 col-xs-6">Mobile <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-2 col-xs-12">
                                        <input id="personal_mobile" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[mobile]" required="required" data-parsley-errors-container="#for_personal_mobile" data-parsley-error-message="Please fill mobile"  value = "<?php if(!empty($customer['personal'])) echo $customer['personal']->mobile ?>">
                                        <span id = "for_personal_mobile"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Profession <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <select id="personal_proffesion" name="personal[profession]" required="required" class="form-control js-example-tags input person" data-parsley-errors-container="#for_personal_proffesion">
                                            <option value="">-- Select --</option>
                                            <option value="Employee" <?php if(!empty($customer['personal'])) { if($customer['personal']->profession == 'Employee') echo "selected"; } ?>>Employee</option>
                                            <option value="Enterpreneur" <?php if(!empty($customer['personal'])) { if($customer['personal']->profession == 'Enterpreneur') echo "selected"; } ?>>Enterpreneur</option>
                                            <option value="Student" <?php if(!empty($customer['personal'])) { if($customer['personal']->profession == 'Student') echo "selected"; } ?>>Student</option>
                                        </select>
                                        <span id = "for_personal_proffesion"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Building <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <select id="personal_bulding" name="personal[bulding]" required="required" class="form-control js-example-tags input person" data-parsley-errors-container="#for_personal_bulding">
                                            <option value="">-- Select --</option>
                                            <option value="Appartment" <?php if(!empty($customer['personal'])) { if($customer['personal']->building_type == 'Appartment') echo "selected"; } ?>>Appartment</option>
                                            <option value="Home" <?php if(!empty($customer['personal'])) { if($customer['personal']->building_type == 'Home') echo "selected"; } ?>>Home</option>
                                            <option value="Home Office" <?php if(!empty($customer['personal'])) { if($customer['personal']->building_type == 'Home Office') echo "selected"; } ?>>Home Office</option>
                                        </select>
                                        <span id = "for_personal_bulding"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Number of Floor <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="personal_number_floor" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[number_floor]" required="required" data-parsley-errors-container="#for_personal_number_floor" value = "<?php if(!empty($customer['personal'])) echo $customer['personal']->number_of_floor ?>">
                                        <span id = "for_personal_number_floor"></span>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <br/>
                            <div class = "row">
                                <div class="col-md-6 col-xs-12 dda">
                                  <h4><b>Correspondence Addres</b></h4>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Building Name <span class="required">*</span></label>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                         <input id="building_name_c" class="form-control col-md-7 col-xs-12 input person" type="text" name="p_correspondence[building_name]" required="required" data-parsley-errors-container="#for_c_building_name" value = "<?php echo $srf->correspondence_building_name ?>">
                                        <span id = "for_c_building_name"></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                           <input id="floor_c" class="form-control col-md-7 col-xs-12 input person" type="text" name="p_correspondence[floor]" required="required" data-parsley-errors-container="#correspondence_floor"  value = "<?php echo $srf->correspondence_floor_block ?>">
                                          <span id = "correspondence_floor"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <textarea id="address_c" name="p_correspondence[address]" class="form-control" required="required" data-parsley-errors-container="#for_address_c" ><?php echo $srf->correspondence_address ?></textarea>
                                          <span id = "for_address_c"></span>
                                      </div>
                                  </div>
                                  <!-- <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="city_c" class="form-control col-md-7 col-xs-12 city_text" type="hidden" name="p_correspondence[city]"> 
                                          <select id="city_c2" required="required" class="form-control js-example-tags input person city" data-parsley-errors-container="#for_personal_city" data-parsley-error-message="Please fill city">
                                            <option value="">-- Select --</option>
                                            <?php foreach($province as $k => $r){ ?>
                                            <option value="<?php echo $r['id'].'#'.$r['name'] ?>"><?php echo $r['name']?></option>
                                            <?php } ?>
                                          </select>
                                          <span id = "for_city_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="district_c" class="form-control col-md-7 col-xs-12 district_text" type="hidden" name="p_correspondence[district]">
                                          <select id="district_c2" required="required" class="form-control js-example-tags input person district" data-parsley-errors-container="#for_district_c" data-parsley-error-message="Please fill city">
                                            <option value="">-- Select --</option>
                                          </select>
                                          <span id = "for_district_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="subdistrict_c" required="required" class="form-control js-example-tags input person subdistrict" data-parsley-errors-container="#for_fe_subdistrict_c" data-parsley-error-message="Please fill city" name="p_correspondence[subdistrict]">
                                            <option value="">-- Select --</option>
                                          </select>
                                          <span id = "for_fe_subdistrict_c"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-4 col-sm-2 col-xs-12">
                                          <input id="state_c" class="form-control col-md-7 col-xs-12 input person" type="text" name="p_correspondence[state]" required="required" data-parsley-errors-container="#for_state_c">
                                          <span id = "for_state_c"></span>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code
                                      </label>
                                      <div class="col-md-3 col-sm-2 col-xs-12">
                                          <input id="zip_code_c" class="form-control col-md-7 col-xs-12 input person" type="text" name="p_correspondence[zip_code]" data-parsley-errors-container="#for_zip_code_c">
                                          <span id = "for_zip_code_c"></span>
                                      </div>
                                  </div> -->
                                </div>

                                <div class="col-md-6 col-xs-12 dda">
                                  <h4><b>Billing Address</b></h4>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Building Name <span class="required">*</span></label>
                                    </label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                         <input id="building_name_b" class="form-control col-md-7 col-xs-12 input person" type="text" name="p_billing[building_name]" required="required" data-parsley-errors-container="#building_name_b">
                                        <span id = "building_name_b"><?php echo $srf->billing_building_name ?></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                           <input id="floor_b" class="form-control col-md-7 col-xs-12 input person" type="text" name="p_billing[floor]" required="required" data-parsley-errors-container="#for_floor_b" value = 
                                           "<?php echo $srf->billing_floor_block ?>">
                                          <span id = "for_floor_b"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <textarea id="address_b" name="p_billing[address]" class="form-control input person" required="required" data-parsley-errors-container="#for_address_b"><?php echo $srf->billing_address ?></textarea>
                                          <span id = "for_address_b"></span>
                                      </div>
                                  </div>
                                  <!-- <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="city_b" class="form-control col-md-7 col-xs-12 city_text" type="hidden" name="p_billing[city]">
                                          <select id="city_b2" required="required" class="form-control js-example-tags input person city" data-parsley-errors-container="#for_city_b" data-parsley-error-message="Please fill city">
                                            <option value="">-- Select --</option>
                                            <?php foreach($province as $k => $r){ ?>
                                            <option value="<?php echo $r['id'].'#'.$r['name'] ?>"><?php echo $r['name']?></option>
                                            <?php } ?>
                                          </select>
                                          <span id = "for_city_b"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="district_b" class="form-control col-md-7 col-xs-12 district_text" type="hidden" name="p_billing[district]">
                                          <select id="district_b2" required="required" class="form-control js-example-tags input person district" data-parsley-errors-container="#for_district_b" data-parsley-error-message="Please fill district">
                                            <option value="">-- Select --</option>
                                          </select>
                                          <span id = "for_district_b"></span>
                                      </div>
                                  </div> -->
                                  <!-- <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                         <select id="subdistrict_b" required="required" class="form-control js-example-tags input person subdistrict" name="p_billing[subdistrict]" data-parsley-errors-container="#for_subdistrict_b" data-parsley-error-message="Please fill district">
                                            <option value="">-- Select --</option>
                                          </select>
                                          <span id = "for_subdistrict_b"></span>
                                      </div>
                                  </div> -->
                                  <!-- <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span></label>
                                      </label>
                                      <div class="col-md-4 col-sm-2 col-xs-12">
                                          <input id="state_b" class="form-control col-md-7 col-xs-12 input person" type="text" name="p_billing[state]" required="required" data-parsley-errors-container="#for_state_b">
                                          <span id = "for_state_b"></span>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code
                                      </label>
                                      <div class="col-md-3 col-sm-2 col-xs-12">
                                          <input id="zip_code_b" class="form-control col-md-7 col-xs-12 input person" type="text" name="p_billing[zip_code]" data-parsley-errors-container="#for_zip_code_b">
                                          <span id = "for_zip_code_b"></span>
                                      </div>
                                  </div> -->
                                </div>
                              
                            </div>
                          </div>

                        </div>
                      </div>
                      <div id="step-5">
                        <div class="form-horizontal form-label-left form-step-5">
                          <!-- <button type = "button" class="btn btn-primary" id = "add_row_service"> Add Service</button> -->
                          
                            <div class = "services" style="height: 800px;">
                            <?php foreach ($services as $key => $value) { ?>
                            <div class="row panel_service">
                              <div class="x_panel ">
                                <div class="x_title">
                                  <h2>Service Request</h2>
                                  <ul class="nav navbar-right panel_toolbox">
                                    <li><!-- <a class="close-link"><i class="fa fa-close"></i></a> -->
                                    </li>
                                  </ul>
                                  <div class="clearfix"></div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Classification <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input type = "hidden" name = "mservice[0][service_id]" value = "<?php echo $value->mservice_id?>">
                                          <select id="product_class0" name="mservice[<?php echo $key?>][product_classification]" class="form-control js-example-tags input product_class" class="form-control js-example-tags input" rowidf = "0" readonly>
                                              <option value="">-- Select --</option>
                                              <?php foreach($service_group as $i => $sg) {?>
                                              <option value="<?php echo $sg->id?>" <?php if($value->service_group_id == $sg->id) echo "selected" ?>><?php echo $sg->group_name?></option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Sub Classification <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="product_subclassification0" name="mservice[<?php echo $key?>][product_subclassification]" class="form-control js-example-tags input subclass_product" data-parsley-errors-container="#for_customer_classification" readonly>
                                            <option value = "<?php echo $value->product_subclassification?>" selected> <?php echo $value->product_subclassification?> </option>
                                              <!-- <option value="">-- Select --</option>
                                              <option value = "INTERNATIONAL LINK"> INTERNATIONAL LINK </option>
                                              <option value = "DOMESTIC LINK"> DOMESTIC LINK </option>
                                              <option value = "IP TRANSIT"> IP TRANSIT </option>
                                              <option value = "BURSTABLE INTERNET"> BURSTABLE INTERNET </option>
                                              <option value = "DEDICATED INTERNET"> DEDICATED INTERNET </option>
                                              <option value = "INTERNET EXCHANGE"> INTERNET EXCHANGE </option>
                                              <option value = "CO-LOCATION"> CO-LOCATION </option>
                                              <option value = "HOSTING & CLOUD"> HOSTING & CLOUD </option>
                                              <option value = "MANAGED SERVICE"> MANAGED SERVICE </option>
                                              <option value = "ICT"> ICT </option>
                                              <option value = "Non-ICT"> Non-ICT </option> -->

                                          </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <select id="product_name0" name="mservice[<?php echo $key?>][product_name]" class="form-control js-example-tags input" class="form-control js-example-tags input" style="width: 960px;" readonly>
                                          <option value="">-- Select --</option>
                                          <option value = "<?php echo $value->service_id?>" selected> <?php echo $value->subservice_name?> </option>
                                      </select>
                                  </div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Capacity / Bandwidth / Qty <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="capacity0" class="form-control col-md-7 col-xs-12 input" type="text" name="mservice[<?php echo $key?>][capacity]" required="required" data-parsley-errors-container="#for_rfs_date" value = "<?php echo $value->capacity?>" readonly>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit of Measurement <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="uom0" name="mservice[<?php echo $key?>][uom]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="" <?php if($value->uom == '-- Select --') echo "selected" ?>>-- Select --</option>
                                              <option value ="Core" <?php if($value->uom == 'Core') echo "selected" ?>>Core</option>
                                              <option value ="Kbps" <?php if($value->uom == 'Kbps') echo "selected" ?>>Kbps</option>
                                              <option value ="Mbps" <?php if($value->uom == 'Mbps') echo "selected" ?>>Mbps</option>
                                              <option value ="Gbps" <?php if($value->uom == 'Gbps') echo "selected" ?>>Gbps</option>
                                              <option value ="KB" <?php if($value->uom == 'KB') echo "selected" ?>>KB</option>
                                              <option value ="MB" <?php if($value->uom == 'MB') echo "selected" ?>>MB</option>
                                              <option value ="GB" <?php if($value->uom == 'GB') echo "selected" ?>>GB</option>
                                              <option value ="TB" <?php if($value->uom == 'TB') echo "selected" ?>>TB</option>
                                              <option value ="Account" <?php if($value->uom == 'Account') echo "selected" ?>>Account</option>
                                              <option value ="License" <?php if($value->uom == 'License') echo "selected" ?>>License</option>
                                              <option value ="Rack" <?php if($value->uom == 'Rack') echo "selected" ?>>Rack</option>
                                              <option value ="U" <?php if($value->uom == 'U') echo "selected" ?>>U</option>
                                              <option value ="Tower" <?php if($value->uom == 'Tower') echo "selected" ?>>Tower</option>
                                              <option value ="Node" <?php if($value->uom == 'Node') echo "selected" ?>>Node</option>
                                              <option value ="M2" <?php if($value->uom == 'M2') echo "selected" ?>>M2</option>
                                              <option value ="Km" <?php if($value->uom == 'Km') echo "selected" ?>>Km</option>
                                              <option value ="MHz" <?php if($value->uom == 'MHz') echo "selected" ?>>MHz</option>
                                              <option value ="GHz" <?php if($value->uom == 'GHz') echo "selected" ?>>GHz</option>
                                              <option value ="Ampere" <?php if($value->uom == 'Ampere') echo "selected" ?>>Ampere</option>
                                              <option value ="IP" <?php if($value->uom == 'IP') echo "selected" ?>>IP</option>
                                              <option value ="AS Number" <?php if($value->uom == 'AS Numbe') echo "selected" ?>>AS Number</option>
                                              <option value ="Number" <?php if($value->uom == 'Number') echo "selected" ?>>Number</option>
                                              <option value ="Extention" <?php if($value->uom == 'Extentio') echo "selected" ?>>Extention</option>
                                              <option value ="Domain" <?php if($value->uom == 'Domain') echo "selected" ?>>Domain</option>
                                              <option value ="STB" <?php if($value->uom == 'STB') echo "selected" ?>>STB</option>
                                              <option value ="Router" <?php if($value->uom == 'Router') echo "selected" ?>>Router</option>
                                              <option value ="Access Point" <?php if($value->uom == 'Access Point') echo "selected" ?>>Access Point</option>
                                              <option value ="Person" <?php if($value->uom == 'Person') echo "selected" ?>>Person</option>
                                              <option value ="Day" <?php if($value->uom == 'Day') echo "selected" ?>>Day</option>
                                              <option value ="Week" <?php if($value->uom == 'Week') echo "selected" ?>>Week</option>
                                              <option value ="Month" <?php if($value->uom == 'Month') echo "selected" ?>>Month</option>
                                              <option value ="Lumpsum" <?php if($value->uom == 'Lumpsum') echo "selected" ?>>Lumpsum</option>

                                          </select>
                                          <span id = "for_customer_classification"></span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Order <span class="required">*</span> 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="type_order0" name="mservice[<?php echo $key?>]['type_order']" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="" >-- Select --</option>
                                              <option value = "NEW" <?php if($value->type_of_order == 'NEW') echo "selected" ?>>NEW</option>
                                              <option value = "UPGRADE" <?php if($value->type_of_order == 'UPGRADE') echo "selected" ?>>UPGRADE</option>
                                              <option value = "DOWNGRADE" <?php if($value->type_of_order == 'DOWNGRADE') echo "selected" ?>>DOWNGRADE</option>
                                              <option value = "RELOCATION" <?php if($value->type_of_order == 'RELOCATION') echo "selected" ?>>RELOCATION</option>
                                              <option value = "DISMANTLE" <?php if($value->type_of_order == 'DISMANTLE') echo "selected" ?>>DISMANTLE</option>
                                          </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Billing Type <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="billing_type0" name="mservice[<?php echo $key?>][billing_type]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="">-- Select --</option>
                                              <option value ="Charged" <?php if($value->billing_type == 'Charged') echo "selected" ?>>Charged</option>
                                              <option value ="No Charged" <?php if($value->billing_type == 'No Charged') echo "selected" ?>>No Charged</option>
                                          </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Service <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="type_service0" name="mservice[<?php echo $key?>][type_service]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="">-- Select --</option>
                                              <option value = "PERMANENT" <?php if($value->type_service == 'PERMANENT') echo "selected" ?>>PERMANENT</option>
                                              <option value = "TEMPORARY" <?php if($value->type_service == 'TEMPORARY') echo "selected" ?>>TEMPORARY</option>
                                          </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Purpose <span class="required">*</span> 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="service_purpose0" name="mservice[<?php echo $key?>][service_purpose]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="">-- Select --</option>
                                              <option value = "FIXED RECURRING SERVICE" <?php if($value->service_purpose == 'FIXED RECURRING SERVICE') echo "selected" ?>> FIXED RECURRING SERVICE </option>
                                              <option value = "BANDWIDTH ON DEMAND" <?php if($value->service_purpose == 'BANDWIDTH ON DEMAND') echo "selected" ?>> BANDWIDTH ON DEMAND </option>
                                              <option value = "EVENT" <?php if($value->service_purpose == 'EVENT') echo "selected" ?>> EVENT </option>
                                              <option value = "POC" <?php if($value->service_purpose == 'POC') echo "selected" ?>> POC </option>
                                              <option value = "TEMPORARY TRIAL" <?php if($value->service_purpose == 'TEMPORARY TRIAL') echo "selected" ?>> TEMPORARY TRIAL </option>
                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Status <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="service_status0" name="mservice[<?php echo $key?>][service_status]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="">-- Select --</option>
                                              <option value = "MAIN SERVICE" <?php if($value->service_status == 'MAIN SERVICE') echo "selected" ?>>MAIN SERVICE</option>
                                              <option value = "BACK-UP SERVICE" <?php if($value->service_status == 'BACK-UP SERVICE') echo "selected" ?>>BACK-UP SERVICE</option>
                                              <option value = "2nd BACK-UP SERVICE" <?php if($value->service_status == '2nd BACK-UP SERVICE') echo "selected" ?>>2nd BACK-UP SERVICE</option>

                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Owner <span class="required">*</span> 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="service_owner0" name="mservice[<?php echo $key?>][service_owner]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="">-- Select --</option>
                                              <option value = "MORATELINDO" <?php if($value->service_owner == 'MORATELINDO') echo "selected" ?>> MORATELINDO </option>
                                              <option value = "3rd PARTY" <?php if($value->service_owner == '3rd PARTY') echo "selected" ?>> 3rd PARTY </option>
                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product SLA <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="product_sla0" name="mservice[<?php echo $key?>][product_sla]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="">-- Select --</option>
                                              <option value = "95%" <?php if($value->sla = '95%') echo "selected"; ?>> 95%</option>
                                              <option value = "95.50%" <?php if($value->sla = '95.50%') echo "selected"; ?>> 95.50%</option>
                                              <option value = "96%" <?php if($value->sla = '96%') echo "selected"; ?>> 96%</option>
                                              <option value = "96.50%" <?php if($value->sla = '96.50%') echo "selected"; ?>> 96.50%</option>
                                              <option value = "97%" <?php if($value->sla = '97%') echo "selected"; ?>> 97%</option>
                                              <option value = "97.50%" <?php if($value->sla = '97.50%') echo "selected"; ?>> 97.50%</option>
                                              <option value = "98%" <?php if($value->sla = '98%') echo "selected"; ?>> 98%</option>
                                              <option value = "98.50%" <?php if($value->sla = '98.50%') echo "selected"; ?>> 98.50%</option>
                                              <option value = "99%" <?php if($value->sla = '99%') echo "selected"; ?>> 99%</option>
                                              <option value = "99.50%" <?php if($value->sla = '99.50%') echo "selected"; ?>> 99.50%</option>
                                              <option value = "99.60%" <?php if($value->sla = '99.60%') echo "selected"; ?>> 99.60%</option>
                                              <option value = "99.70%" <?php if($value->sla = '99.70%') echo "selected"; ?>> 99.70%</option>
                                              <option value = "99.80%" <?php if($value->sla = '99.80%') echo "selected"; ?>> 99.80%</option>
                                              <option value = "99.85%" <?php if($value->sla = '99.85%') echo "selected"; ?>> 99.85%</option>
                                              <option value = "99.90%" <?php if($value->sla = '99.90%') echo "selected"; ?>> 99.90%</option>
                                              <option value = "99.95%" <?php if($value->sla = '99.95%') echo "selected"; ?>> 99.95%</option>
                                              <option value = "99.97%" <?php if($value->sla = '99.97%') echo "selected"; ?>> 99.97%</option>
                                              <option value = "99.98%" <?php if($value->sla = '99.98%') echo "selected"; ?>> 99.98%</option>
                                              <option value = "99.99%" <?php if($value->sla = '99.99%') echo "selected"; ?>> 99.99%</option>
                                              <option value = "99.999%" <?php if($value->sla = '99.999%') echo "selected"; ?>> 99.999%</option>
                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SLA Restitution <span class="required">*</span>
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="sla_restitution0" name="mservice[<?php echo $key?>][sla_restitution]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" readonly>
                                              <option value="">-- Select --</option>
                                              <option value = "APPLIED" <?php if($value->sla_restitution = 'APPLIED') echo "selected"; ?>>APPLIED</option>
                                              <option value = "NOT APPLIED" <?php if($value->sla_restitution = 'NOT APPLIED') echo "selected"; ?>>NOT APPLIED</option>
                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">RFS Date <span class="required">*</span>
                                      </label>
                                      <div class="col-md-3 col-sm-6 col-xs-12">
                                          <input id="rfs_date0" class="form-control col-md-7 col-xs-12 input single_date" type="text" name="mservice[<?php echo $key?>][rfs_date]" required="required" data-parsley-errors-container="#for_rfs_date" value = "<?php echo $value->rfs_date?>" readonly>
                                      </div>
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">End of Temporary Service 
                                      </label>
                                      <div class="col-md-3 col-sm-6 col-xs-12">
                                          <input id="end_temporary0" class="form-control col-md-7 col-xs-12 input single_date" type="text" name="mservice[<?php echo $key?>][end_temporary]" data-parsley-errors-container="#for_rfs_date" value = "<?php echo $value->end_temp_service?>" readonly>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Duration of Contract Agreement <span class="required">*</span>
                                      </label>
                                      <div class="col-md-6 col-sm-4 col-xs-12">
                                          <!-- <select id="duration_contract" name="mservice[<?php echo $key?>][duration_contract]" class="form-control input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">
                                              <option value="">-- Select --</option>
                                              <option value = "1">1</option>
                                              <option value = "2">2</option>
                                              <option value = "3">3</option>
                                              <option value = "4">4</option>
                                              <option value = "5">5</option>
                                              <option value = "6">6</option>
                                              <option value = "7">7</option>
                                              <option value = "8">8</option>
                                              <option value = "9">9</option>
                                              <option value = "10">10</option>
                                              <option value = "11">11</option>
                                              <option value = "12">12</option>
                                              <option value = "13">13</option>
                                              <option value = "14">14</option>
                                              <option value = "15">15</option>
                                              <option value = "16">16</option>
                                              <option value = "17">17</option>
                                              <option value = "18">18</option>
                                              <option value = "19">19</option>
                                              <option value = "20">20</option>

                                          </select> -->
                                          <input id="duration_contract" name="mservice[<?php echo $key?>][duration_contract]" class="form-control input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification" value = "<?php echo $value->duration_contract?>" readonly>
                                      </div>
                                      <!-- <div class="col-md-3 col-sm-4 col-xs-12">
                                          <select id="contract_uom0" name="mservice[<?php echo $key?>][contract_uom]" class="form-control input" data-parsley-errors-container="#for_customer_classification">
                                              <option value="">-- Select --</option>
                                              <option value = "day">day</option>
                                              <option value = "week">week</option>
                                              <option value = "month">month</option>
                                              <option value = "year">year</option>
                                          </select>
                                      </div> -->
                                    </div>
                                  </div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Layer 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="service_layer0" name="mservice[<?php echo $key?>][service_layer]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">
                                              <option value="">-- Select --</option>
                                              <option value = "1">1</option>
                                              <option value = "2">2</option>
                                              <option value = "3">3</option>
                                              <option value = "4">4</option>
                                              <option value = "5">5</option>
                                              <option value = "6">6</option>
                                              <option value = "7">7</option>
                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Media Transmission 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="media0" name="mservice[<?php echo $key?>][media]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">
                                              <option value="">-- Select --</option>
                                              <option value = "FIBER OPTIC">FIBER OPTIC</option>
                                              <option value = "COAXIAL">COAXIAL</option>
                                              <option value = "TWISTED PAIR (ETH/UTP)">TWISTED PAIR (ETH/UTP)</option>
                                              <option value = "RADIO MICROWAVE">RADIO MICROWAVE</option>
                                              <option value = "VSAT">VSAT</option>
                                              <option value = "WiFi">WiFi</option>
                                              <option value = "BLUETOOTH">BLUETOOTH</option>
                                              <option value = "ZIGBEE">ZIGBEE</option>
                                              <option value = "3G">3G</option>
                                              <option value = "4G/LTE">4G/LTE</option>
                                              <option value = "5G">5G</option>

                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Interface Connection
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="interface0" name="mservice[<?php echo $key?>][interface]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">
                                              <option value="">-- Select --</option>
                                              <option value = "HDMI"> HDMI </option>
                                              <option value = "RJ11"> RJ11 </option>
                                              <option value = "RJ45"> RJ45 </option>
                                              <option value = "RS232"> RS232 </option>
                                              <option value = "SC,LC,FC (PATCHCORD)"> SC,LC,FC (PATCHCORD) </option>
                                              <option value = "SFP, SFP+, XFP (OPTICAL)"> SFP, SFP+, XFP (OPTICAL) </option>
                                              <option value = "T1/E1"> T1/E1 </option>
                                              <option value = "USB"> USB </option>
                                              <option value = "WEB SERVICE"> WEB SERVICE </option>
                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Connection Methode 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="connection_method0" name="mservice[<?php echo $key?>][connection_method]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">
                                              <option value="">-- Select --</option>
                                              <option value = "MPLS">MPLS</option>
                                              <option value = "PPPOE">PPPOE</option>
                                              <option value = "TRUNK">TRUNK</option>
                                              <option value = "VLAN">VLAN</option>
                                              <option value = "VPN">VPN</option>
                                              <option value = "BGP">BGP</option>
                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class = "row">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Protocol Technology
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12 parent">
                                          <select id="protocol_technology0" name="mservice[<?php echo $key?>][protocol_technology]" class="form-control js-example-tags input possibly_other" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">
                                              <option value = "">-- Select --</option>
                                              <option value = "DWDM">DWDM</option>
                                              <option value = "SDH">SDH</option>
                                              <option value = "EoSDH">EoSDH</option>
                                              <option value = "METRO-E">METRO-E</option>
                                              <option value = "IP">IP</option>
                                              <option value = "GPON">GPON</option>
                                              <option value = "OTHERS…">OTHERS…</option>
                                          </select><br/><br/>
                                          <input type="text" id="" style = "width: 250px;" name="mservice[<?php echo $key?>][protocol_technology2]" class="form-control col-md-9 col-xs-12 other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CPE Equipment 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12 parent">
                                          <select id="cpe_equipment0" name="mservice[<?php echo $key?>][cpe_equipment]" class="form-control js-example-tags input possibly_other" data-parsley-errors-container="#for_customer_classification">
                                              <option value="">-- Select --</option>
                                              <option value = "STB">STB</option>
                                              <option value = "CCTV / IP-CAMERA">CCTV / IP-CAMERA</option>
                                              <option value = "FIXED PHONE">FIXED PHONE</option>
                                              <option value = "IP-PBX">IP-PBX</option>
                                              <option value = "MINI HEADEND">MINI HEADEND</option>
                                              <option value = "ACCESS POINT">ACCESS POINT</option>
                                              <option value = "ONT">ONT</option>
                                              <option value = "ROUTER">ROUTER</option>
                                              <option value = "MINI PC">MINI PC</option>
                                              <option value = "FIREWALL">FIREWALL</option>
                                              <option value = "OTHERS…">OTHERS…</option>
                                          </select><br/><br/>
                                          <input type="text" id="" style = "width: 250px;" name="mservice[<?php echo $key?>][cpe_equipment2]" class="form-control col-md-9 col-xs-12 other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">
                                          
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                
                                <div class = "row">
                                    <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Backbone Protection 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12">
                                          <select id="backbone_protection0" name="mservice[<?php echo $key?>][backbone_protection]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "ASON - SBR">ASON - SBR</option>
                                              <option value = "ASON - SNCP">ASON - SNCP</option>
                                              <option value = "SINGLE LINK">SINGLE LINK</option>
                                              <option value = "DOUBLE LINK">DOUBLE LINK</option>
                                              <option value = "TRIPLE LINK">TRIPLE LINK</option>
                                              <option value = "3rd PARTY LINK">3rd PARTY LINK</option>
                                              <option value = "NO PROTECTION">NO PROTECTION</option>
                                          </select>
                                          
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Access Protection 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12">
                                          <select id="access_protection0" name="mservice[<?php echo $key?>][access_protection]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "SINGLE LINK">SINGLE LINK</option>
                                              <option value = "DOUBLE LINK">DOUBLE LINK</option>
                                              <option value = "TRIPLE LINK">TRIPLE LINK</option>
                                              <option value = "3rd PARTY LINK">3rd PARTY LINK</option>
                                              <option value = "NO PROTECTION">NO PROTECTION</option>
                                          </select>
                                          
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Lastmile Protection 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12">
                                          <select id="lastmile_protection0" name="mservice[<?php echo $key?>][lastmile_protection]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "SINGLE LINK"> SINGLE LINK</option>
                                              <option value = "DOUBLE LINK"> DOUBLE LINK</option>
                                              <option value = "TRIPLE LINK"> TRIPLE LINK</option>
                                              <option value = "3rd PARTY LINK"> 3rd PARTY LINK</option>
                                              <option value = "NO PROTECTION"> NO PROTECTION</option>

                                          </select>
                                          
                                      </div>

                                    </div>
              
                                </div>
                                <div class = "row">
                                    <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Equipment Protection 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12 parent">
                                          <select id="equipment_protection0" name="mservice[<?php echo $key?>][equipment_protection]" class="form-control input possibly_other" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "ACTIVE-ACTIVE REDUNDANT">ACTIVE-ACTIVE REDUNDANT</option>
                                              <option value = "ACTIVE-PASSIVE REDUNDANT">ACTIVE-PASSIVE REDUNDANT</option>
                                              <option value = "NO PROTECTION">NO PROTECTION</option>
                                              <option value = "OTHERS…">OTHERS…</option>
                                          </select><br/>
                                          <input type="text" id="" style = "width: 150px;" name="mservice[<?php echo $key?>][equipment_protection2]" class="form-control col-md-9 col-xs-12 other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">
                                          
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Security Protection 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12 parent">
                                          <select id="security_protection0" name="mservice[<?php echo $key?>][security_protection]" class="form-control input possibly_other" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "ANTI VIRUS">ANTI VIRUS</option>
                                              <option value = "FIREWALL">FIREWALL</option>
                                              <option value = "DDOS">DDOS</option>
                                              <option value = "ENCRYPTION">ENCRYPTION</option>
                                              <option value = "NO PROTECTION">NO PROTECTION</option>
                                              <option value = "OTHERS…">OTHERS…</option>
                                          </select><br/>
                                          <input type="text" id="" style = "width: 150px;" name="mservice[<?php echo $key?>][security_protection2]" class="form-control col-md-9 col-xs-12 other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Other Protection 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12 parent">
                                          <select id="other_protection0" name="mservice[<?php echo $key?>][other_protection]" class="form-control input possibly_other" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "LIGHTENING ARRESTER">LIGHTENING ARRESTER</option>
                                              <option value = "DRC">DRC</option>
                                              <option value = "REMOTE HAND">REMOTE HAND</option>
                                              <option value = "CLOUD BACK-UP">CLOUD BACK-UP</option>
                                              <option value = "NO PROTECTION">NO PROTECTION</option>
                                              <option value = "OTHERS…">OTHERS…</option>
                                          </select><br/>
                                          <input type="text" id="" style = "width: 150px;" name="mservice[<?php echo $key?>][other_protection2]" class="form-control col-md-9 col-xs-12 other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">
                                      </div>
                                    </div>
                                </div>
                                <div class = "row">
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Monitoring Tools 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12 parent">
                                          <select id="monitoring_tools0" name="mservice[<?php echo $key?>][monitoring_tools]" class="form-control input possibly_other" data-parsley-errors-container="#for_customer_classification">
                                              <option value="">-- Select --</option>
                                              <option value = "MRTG">MRTG</option>
                                              <option value = "MRTG & PRTG">MRTG & PRTG</option>
                                              <option value = "LOOKING GLASS">LOOKING GLASS</option>
                                              <option value = "OXYGEN SELFCARE">OXYGEN SELFCARE</option>
                                              <option value = "NOT AVAILABLE">NOT AVAILABLE</option>
                                              <option value = "OTHERS…">OTHERS…</option>
                                          </select><br/><br/>
                                          <input type="text" id="" style = "width: 300px;" name="mservice[<?php echo $key?>][monitoring_tools2]" class="form-control col-md-9 col-xs-12 other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">
                                          
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Managed By 
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <select id="service_managed0" name="mservice[<?php echo $key?>][service_managed]" class="form-control input" data-parsley-errors-container="#for_customer_classification">
                                              <option value = "MORATELINDO">MORATELINDO</option>
                                              <option value = "CUSTOMER">CUSTOMER</option>
                                              <option value = "3rd PARTY">3rd PARTY</option>
                                          </select>
                                          
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Item Code
                                      </label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <div class="input-group">
                                            <input type="hidden" name = "mservice[<?php echo $key?>][item_code]" id = "itemcode0">
                                            <input type="text" class="form-control" name = "mservice[<?php echo $key?>][item_code_desc]" id = "itemcode_desc0">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary item_code_list"><span class="fa fa-list"></span></button>
                                            </span>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class = "row">
                                    <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Billing Provided By 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12">
                                          <select id="billing_by0" name="mservice[<?php echo $key?>][billing_by]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "MORATELINDO" >MORATELINDO</option>
                                              <option value = "CUSTOMER" >CUSTOMER</option>
                                              <option value = "BUILDING MANAGEMENT" >BUILDING MANAGEMENT</option>
                                          </select>
                                          
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Lastmile Managed By 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12">
                                          <select id="lastmile_by0" name="mservice[<?php echo $key?>][lastmile_by]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "MORATELINDO" >MORATELINDO</option>
                                              <option value = "CUSTOMER" >CUSTOMER</option>
                                              <option value = "BUILDING MANAGEMENT" >BUILDING MANAGEMENT</option>

                                          </select>
                                          
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">CPE Managed By 
                                      </label>
                                      <div class="col-md-2 col-sm-6 col-xs-12">
                                          <select id="cpe_by0" name="mservice[<?php echo $key?>][cpe_by]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">
                                              <option value="">-- Select --</option>
                                              <option value = "MORATELINDO" >MORATELINDO</option>
                                              <option value = "CUSTOMER" >CUSTOMER</option>
                                              <option value = "BUILDING MANAGEMENT" >BUILDING MANAGEMENT</option>
                                          </select>
                                          
                                      </div>

                                    </div>
              
                                </div>
                                <h4><b>Installation Address</b></h4>
                                <div class="ln_solid"></div>
                                <div class = "row">
                                  <div class="col-md-6 col-xs-12 dda">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Interconnection Point <span class="required">*</span></label>
                                            <div class="col-md-9 col-sm-6 col-xs-12">
                                              <input type = "hidden" name = "installation[<?php echo $key?>][installation_id]" value = "<?php echo $value->address_id?>" >
                                                <select id="interconnection0" name="installation[<?php echo $key?>][interconnection_point]"  class="form-control js-example-tags input" readonly>
                                                    <option value="">-- Select --</option>
                                                    <option value = "MTI DATA CENTER" <?php if($value->interconnection_point == 'MTI DATA CENTER') echo "selected";?>>MTI DATA CENTER</option>
                                                    <option value = "MTI POP" <?php if($value->interconnection_point == 'MTI POP') echo "selected";?>>MTI POP</option>
                                                    <option value = "MTI TOWER" <?php if($value->interconnection_point == 'MTI TOWER') echo "selected";?>>MTI TOWER</option>
                                                    <option value = "MTI CLOUD" <?php if($value->interconnection_point == 'MTI CLOUD') echo "selected";?>>MTI CLOUD</option>
                                                    <option value = "3rd PARTY DATA CENTER" <?php if($value->interconnection_point == '3rd PARTY DATA CENTER') echo "selected";?>>3rd PARTY DATA CENTER</option>
                                                    <option value = "3RD PARTY POP" <?php if($value->interconnection_point == '3RD PARTY POP') echo "selected";?>>3RD PARTY POP</option>
                                                    <option value = "3rd PARTY TOWER" <?php if($value->interconnection_point == '3rd PARTY TOWER') echo "selected";?>>3rd PARTY TOWER</option>
                                                    <option value = "3rd PARTY CLOUD" <?php if($value->interconnection_point == '3rd PARTY CLOUD') echo "selected";?>>3rd PARTY CLOUD</option>
                                                    <option value = "CUSTOMER DATA CENTER" <?php if($value->interconnection_point == 'CUSTOMER DATA CENTER') echo "selected";?>>CUSTOMER DATA CENTER</option>
                                                    <option value = "CUSTOMER POP" <?php if($value->interconnection_point == 'CUSTOMER POP') echo "selected";?>>CUSTOMER POP</option>
                                                    <option value = "CUSTOMER TOWER" <?php if($value->interconnection_point == 'CUSTOMER TOWER') echo "selected";?>>CUSTOMER TOWER</option>
                                                    <option value = "CUSTOMER CLOUD" <?php if($value->interconnection_point == 'CUSTOMER CLOUD') echo "selected";?>>CUSTOMER CLOUD</option>
                                                    <option value = "CUSTOMER PREMISE" <?php if($value->interconnection_point == 'CUSTOMER PREMISE') echo "selected";?>>CUSTOMER PREMISE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>

                                    <h4><b>Moratelindo/Third Party Site</b></h4>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site ID / Building Name 
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="ne_site_id0" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[<?php echo $key?>][ne_site_id]" data-parsley-errors-container="#for_ne_site_id" value = "<?php echo $value->ne_site_id?>" readonly>
                                            <span id = "for_ne_site_id"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor/Block 
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="ne_floor0" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[<?php echo $key?>][ne_floor]" data-parsley-errors-container="#for_ne_floor" value = "<?php echo $value->ne_floor?>" readonly>
                                            <span id = "for_ne_floor"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address 
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <textarea id="ne_address0" name="installation[<?php echo $key?>][ne_address]" class="form-control near" data-parsley-errors-container="#for_ne_address" value = "" readonly><?php echo $value->ne_address?></textarea>
                                            <span id = "for_ne_address"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude</label>
                                        <div class="col-md-4 col-sm-2 col-xs-12">
                                            <input id="ne_longitude" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[<?php echo $key?>][ne_longitude]" data-parsley-errors-container="#for_ne_longitude" value = "<?php echo $value->ne_latitude?>" readonly>
                                            <span id = "for_ne_longitude"></span>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude <span class="required">*</span></label>
                                        <div class="col-md-3 col-sm-2 col-xs-12">
                                            <input id="ne_latitude" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[<?php echo $key?>][ne_latitude]" data-parsley-errors-container="#for_ne_latitude" value = "<?php echo $value->ne_longitude?>" readonly>
                                            <span id = "for_ne_latitude"></span>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6 col-xs-12 dda">
                                    <div class="row">
                                      <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address/Site Name  <span class="required">*</span></label>
                                            <div class="col-md-9 col-sm-6 col-xs-12">
                                                <input id="ip_address0" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[<?php echo $key?>][interconnection_address]" required="required" data-parsley-errors-container="#for_company_name" data-parsley-error-message="Please fill company name" value = "<?php echo $value->address?>" readonly>
                                                <span id = "for_company_name"></span>
                                            </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Rack ID</label>
                                            <div class="col-md-9 col-sm-6 col-xs-12">
                                                <input id="rack_id0" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[<?php echo $key?>][rack_id]" data-parsley-errors-container="#for_company_name" data-parsley-error-message="Please fill company name" value = "<?php echo $value->rack_id?>" readonly>
                                                <span id = "for_company_name"></span>
                                            </div>
                                      </div>
                                    </div>
                                    <h4><b>Customer Site</b></h4>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site ID / Building Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                             <input id="fe_building_name0" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[<?php echo $key?>][fe_building_name]" data-parsley-errors-container="#for_fe_building" required="required" value = "<?php echo $value->fe_building_name?>" readonly>
                                            <span id = "for_fe_building"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor/Block <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                             <input id="fe_floor0" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[<?php echo $key?>][fe_floor]" data-parsley-errors-container="#for_fe_floor" required="required" value = "<?php echo $value->fe_floor?>" readonly>
                                            <span id = "for_fe_floor"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <textarea id="fe_address" name="installation[<?php echo $key?>][fe_address]0" class="form-control" name="installation[<?php echo $key?>][fe_floor]" data-parsley-errors-container="#for_fe_address" required="required" readonly><?php echo $value->fe_floor?></textarea>
                                            <span id = "for_fe_address"></span>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="fe_city0" class="form-control col-md-7 col-xs-12 city_text" type="hidden" name="installation[<?php echo $key?>][fe_city]" data-parsley-errors-container="#for_fe_city"> 
                                            <select id="fe_city02" class="form-control js-example-tags input city" data-parsley-errors-container="#for_fe_city" data-parsley-error-message="Please fill city" required="required">
                                              <option value="">-- Select --</option>
                                              <?php foreach($province as $k => $r){ ?>
                                              <option value="<?php echo $r['id'].'#'.$r['name'] ?>"><?php echo $r['name']?></option>
                                              <?php } ?>
                                            </select>
                                            <span id = "for_fe_city"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="fe_district0" class="form-control col-md-7 col-xs-12 district_text" type="hidden" name="installation[<?php echo $key?>][fe_district]" data-parsley-errors-container="#for_fe_district">
                                            <select id="fe_district2_0" class="form-control js-example-tags input district" data-parsley-errors-container="#for_fe_district" data-parsley-error-message="Please fill city" required="required">
                                              <option value="">-- Select --</option>
                                            </select>
                                            <span id = "for_fe_district"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <select id="fe_subdistrict0" class="form-control js-example-tags input near subdistrict" name="installation[<?php echo $key?>][fe_subdistrict]" data-parsley-errors-container="#for_fe_subdistrict" data-parsley-error-message="Please fill city" required="required">
                                              <option value="">-- Select --</option>
                                            </select>
                                            <span id = "for_fe_subdistrict"></span>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span>
                                        </label>
                                        <div class="col-md-4 col-sm-2 col-xs-12">
                                            <input id="fe_state0" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[<?php echo $key?>][fe_state]" data-parsley-errors-container="#for_fe_state" required="required">
                                            <span id = "for_fe_state"></span>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code 
                                        </label>
                                        <div class="col-md-3 col-sm-2 col-xs-12">
                                            <input id="fe_zip_code0" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[<?php echo $key?>][fe_zip_code]" data-parsley-errors-container="#for_fe_zip_code">
                                            <span id = "for_fe_zip_code"></span>
                                        </div>
                                    </div>-->

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">FAT <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <div class="input-group">
                                              <input type="text" class="form-control" name = "installation[<?php echo $key?>][olt_booked]" id = "fe_fat_name0" value = "<?php echo $value->olt_coordinate?>" readonly>
                                              <span class="input-group-btn" readonly>
                                                  <button type="button" class="btn btn-primary open_list"><span class="fa fa-list"></span></button>
                                                  <button type="button" class="btn btn-primary open_map" row = "0"><span class="fa fa-map-marker"></span></button>
                                              </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude
                                        </label>
                                        <div class="col-md-4 col-sm-2 col-xs-12">
                                            <input id="fe_longitude0" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[<?php echo $key?>][fe_longitude]" data-parsley-errors-container="#for_fe_longitude" value = "<?php echo $value->fe_longitude?>" readonly>
                                            <span id = "for_fe_longitude"></span>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude
                                        </label>
                                        <div class="col-md-3 col-sm-2 col-xs-12">
                                            <input id="fe_latitude0" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[<?php echo $key?>][fe_latitude]" data-parsley-errors-container="#for_fe_latitude" value = "<?php echo $value->fe_latitude?>" readonly>
                                            <span id = "for_fe_latitude"></span>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                          </div>
                        
                          
                        </div>
                      </div>
                      <!-- <div id="step-6">
                        <div class="form-horizontal form-label-left form-step-6">
                          <button type = "button" class="btn btn-primary" id = "add_row_address"> Add Address</button>
                          <div class = "addresses" style="height: 1600px;">
                            <div class="row panel_address">
                              <div class="x_panel ">
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <div id="step-6">
                        <div class="form-horizontal form-label-left form-step-6">
                          <div class="row tab_step">
                          </div>
                          <label class="control-label">Notes</label>
                          <textarea id="notes" name="notes" class="form-control input"><?php echo $srf->notes;?></textarea>
                        </div>
                      </div>

                      <div id="step-7">
                        <div class="form-horizontal form-label-left form-step-7">
                          <div class="row tab_step">
                          </div>
                          <table class="" style="width: 1100px;border:1px solid #000">
                            <thead class="">
                            <tr>
                                <td rowspan = '5' style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000;width: 200px;font-size: 11px;">PT. MORA TELEMATIKA INDONESIA <br/>
                                Grha 9  6th Floor  Jalan Penataran No. 9 <br/>
                                Jakarta Pusat 10320</td>
                                <td rowspan = '5' style="padding: 5px 10px;color:#000;text-align: center;font-weight:bold;border:1px solid #000;width: 200px;font-size: 20px;">SERVICE REQUEST FORM</td>
                                <td rowspan = '5' style="padding: 5px 10px;color:#000;text-align: center;font-weight:bold;border:1px solid #000;width: 180px;"><img src="<?php echo base_url()?>/assets/img/logo-moratel.png"></td>
                                <td style="padding: 5px 10px;width: 200px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000;">Input Date</td>
                                <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_input_date"></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px 10px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000">SRF No.</td>
                                <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_srf_no"></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px 10px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000">PO Reference No.</td>
                                <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_po_num"></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px 10px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000">BP Reference No. </td>
                                <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_bp_num"></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px 10px;color:#000;background-color: rgb(255,255,0);text-align: left;font-weight:bold;border:1px solid #000">Customer ID </td>
                                <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_cust_id"></td>
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
                                    <td style="padding: 5px 10px;color:#000;text-align: border:1px solid #000"><span id = "prv_emp_id"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Department</td>
                                    <td colspan= '4' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_emp_dept"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Name</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_emp_name"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Supervisor Name</td>
                                    <td colspan= '4' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_emp_spv"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Positon Title</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_emp_position"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Mobile Phone</td>
                                    <td colspan= '4' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_emp_phone"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Level</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_emp_level"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Email</td>
                                    <td colspan= '4' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_emp_email"></span></td>
                                </tr>
                                <tr>
                                    <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">CUSTOMER CLASSIFICATION</td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Customer Status</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_customer_status"></span></td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Customer Classification</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_customer_class"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Type of Customer</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_type_customer"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">SLA (CEM)</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_sla"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">MTT Respond</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000;width:150px;"><span id = "prv_mttr"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Market Segment</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_market_segment"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Problem Notification</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_problem_notif"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">MTT Update</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_mttu"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Business Line</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_business_line"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Escalation Level</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000;width: 150px;"><span id = "prv_escallation"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Reporting</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000;width: 100px;"><span id = "prv_reporting"></span></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Scale of Customer</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_scale_customer"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Single Point of Contact</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_pof"></span></td>
                                    <td  style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Meeting</td>
                                    <td colspan= '2'style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_meeting"></span></td>
                                </tr>
                                <!-- Personal -->
                                <?php //if($customer_type = 'Corporate'){ ?>
                                <tr class = "prv_corporate">
                                    <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">CORPORATE CUSTOMER INFORMATION</td>
                                </tr>

                                <tr class = "prv_corporate">
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Name of Company</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_comp_name"></span></td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">NPWP Number</td>
                                    <td colspan = "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_comp_npwp"></span></td>
                                </tr>
                                <tr class = "prv_corporate">
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Organization Level</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_comp_org"></span></td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">SIUP Number</td>
                                    <td colspan = "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_comp_siup"></span></td>
                                </tr>

                                <tr class = "prv_corporate">
                                    <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Director</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Name: </b><span id = "prv_director_name"></span></td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Company Phone : </b><span id = "prv_director_phone"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Ext: </b><span id = "prv_director_ext"></span></td>
                                    <td colspan = "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Hp : </b><span id = "prv_director_hp"></span></td>
                                </tr>

                                <tr class = "prv_corporate">
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Email : </b><span id = "prv_director_email"></span></td>
                                    <td colspan = "5" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;background-color:rgb(69,90,100);"></td>
                                </tr>

                                <tr class = "prv_corporate">
                                    <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Commercial Contact Person</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Name: </b><span id = "prv_comm_name"></span></td>
                                    <td colspan = "5" style="padding: 5px 10px;color:#000;text-align:left;border:1px solid #000;"><b>Job Function - Department :</b><span id = "prv_comm_job"></span></td>
                                </tr>

                                <tr class = "prv_corporate">
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Email : </b><span id = "prv_comm_email"></span></td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Company Phone : </b><span id = "prv_comm_phone"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Ext: </b><span id = "prv_comm_ext"></span></td>
                                    <td colspan = "5" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Hp : </b><span id = "prv_comm_hp"></span></td>
                                </tr> 
                                <!--Technical -->
                                <tr class = "prv_corporate">
                                    <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Technical Contact Person</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Name: </b><span id = "prv_tech_name"></span></td>
                                    <td colspan = "5" style="padding: 5px 10px;color:#000;text-align:left;border:1px solid #000;"><b>Job Function - Department :</b><span id = "prv_tech_job"></span></td>
                                </tr>

                                <tr class = "prv_corporate">
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Email :</b>  <span id = "prv_tech_email"></span> </td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Company Phone : </b><span id = "prv_tech_phone"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Ext : </b><span id = "prv_tech_ext"></span></td>
                                    <td colspan = "5" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Hp : </b> <span id = "prv_tech_hp"></span></td>
                                </tr>
                                <?php //} else {?>

                                <!-- Personal -->
                                <tr class = "prv_personal">
                                    <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">PERSONAL CUSTOMER INFORMATION</td>
                                </tr>

                                <tr class = "prv_personal">
                                    <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Contact Person</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b>Name: </b><span id = "prv_p_name"></span></td>
                                    <td colspan = "4" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;">Personal ID ( KTP/Kitas/Passport ) : <span id = "prv_p_id"></span></td>
                                </tr> 
                                <tr class = "prv_personal">
                                    <td colspan="2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Birthdate : <span id = "prv_p_birthdate"></span></td>
                                    <td colspan = "4" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;">NPWP No : <span id = "prv_p_npwp"></span></td>
                                </tr>
                                <tr class = "prv_personal">
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Gender : <span id = "prv_p_gender"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Nationality : <span id = "prv_p_nationality"></span></td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;">Phone : <span id = "prv_p_phone"></span></td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;">Mobile : <span id = "prv_p_mobile"></span></td>
                                </tr>
                                <?php //} ?>
                                <!--Correspondence-->
                                <tr>
                                    <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Correspondence Address </b></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"> <span id = "prv_c_building"></span></td>
                                    <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Billing Address </b></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_b_building"></span></td>
                                </tr>  
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_c_floor"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_b_floor"></span></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_c_address"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_b_address"></span></td>
                                </tr>
                                <!-- <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_c_subdistrict"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_b_subdistrict"></span></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_c_district"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_b_district"></span></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_c_city"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_b_city"></span></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_c_state"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_b_state"></span></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_c_zipcode"></span></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><span id = "prv_b_zipcode"></span></td>
                                </tr> -->
                            </tbody>
                            <tbody class="table_service">
                                <tr>
                                    <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">INSTALLATION ADDRESS</td>
                                </tr>

                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Interconnection Point</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                                    <td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>

                                <tr>
                                    <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Near End (Moratelindo/Third Party Site) </b></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b></b></td>
                                    <td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Far End (Customer Site) </b></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b></b></td>
                                </tr>  
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b></b></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"><b></b></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <!-- <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr> -->
                                <!-- <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>
                                    <td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr> -->

                            
                                <tr>
                                    <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">SERVICE REQUEST</td>
                                </tr>

                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Classification</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Sub-Classification</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Name</td>
                                    <td colspan= '6' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Capacity / Bandwidth / Qty</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Unit of Measurement</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Type of Order</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Billing Type</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Status</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Owner</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product SLA</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">SLA Restitution</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>

                                 <tr>
                                    <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Time of Service</b></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">RFS Date</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Duration of Contract Agreement</b></td>
                                    <td colspan = "3" rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">End of Temporary Service :</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Layer</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Media Transmission</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>

                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Interface Connection</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Connection Methode</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Protocol Technology</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">CPE Equipment</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Link / System Protection</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Backbone</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Access</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> Lastmile</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Other Protection</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Equipment</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Security</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> Others</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>

                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Monitoring Tools</td>
                                    <td colspan= '2' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Managed by</td>
                                    <td colspan= '3' style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Management</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Billing Provide by</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Lastmile Managed by</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> CPE Managed by</td>
                                    <td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000"></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan= '7' style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">ADDITIONAL NOTES</td>
                                </tr>
                                <tr>
                                    <td colspan= '7' style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000;height: 200px;"><span id = "prv_notes"></span></td>
                                </tr>

                            </tbody>
                            
                        </table>
                        </div>
                      </div>
                    <!-- End SmartWizard Content -->
                  </form>
            </div>
        </div>
            
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id = "mdtest" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Sevice Detail</h4>
            </div>
            <div class="modal-body">
              <form id = "subservice_form">
              <?php foreach($type_service as $key => $grup){ ?>
                <table class = "table hidden service_table" id = "sg-<?php echo $grup[0]['group_id']?>">
                  <tr>
                    <td>SO Name</td>
                    <td>Capacity/Quantity</td>
                    <td>UoM</td>
                  </tr>
                  <?php foreach($grup as $idx => $service){ ?>
                  <tr>
                    <td><label><input type="checkbox" class = "group_<?php echo $service['group_id'] ?>" value="<?php echo $service['id']?>" name = "subservice[<?php echo $service['id']?>][id]"> <?php echo $service['subservice_name']?></label></td>
                    <td><input class="form-control col-md-2 col-xs-12 kapasitas_<?php echo $service['group_id'] ?>" type="text" name="subservice[<?php echo $service['id']?>][kapasitas]"><input type="hidden" name="subservice[<?php echo $service['id']?>][group]" value="<?php echo $service['group_id']?>"></td>
                    <td><select class="form-control js-example-tags near" name="subservice[<?php echo $service['id']?>][uom]" required="required" >
                        <option value="">-- Select --</option>
                        <option value = "Core">Core</option>
                        <option value = "Kbps">Kbps</option>
                        <option value = "Mbps">Mbps</option>
                        <option value = "Gbps">Gbps</option>
                        <option value = "KB">KB</option>
                        <option value = "MB">MB</option>
                        <option value = "GB">GB</option>
                        <option value = "TB">TB</option>
                        <option value = "Account">Account</option>
                        <option value = "License">License</option>
                        <option value = "Rack">Rack</option>
                        <option value = "U">U</option>
                        <option value = "Tower">Tower</option>
                        <option value = "Node">Node</option>
                        <option value = "M2">M2</option>
                        <option value = "Km">Km</option>
                        <option value = "MHz">MHz</option>
                        <option value = "GHz">GHz</option>
                        <option value = "Ampere">Ampere</option>
                        <option value = "IP">IP</option>
                        <option value = "AS Number">AS Number</option>
                        <option value = "Number">Number</option>
                        <option value = "Extention">Extention</option>
                        <option value = "Domain">Domain</option>
                        <option value = "STB">STB</option>
                        <option value = "Router">Router</option>
                        <option value = "Access Point">Access Point</option>
                        <option value = "Person">Person</option>
                        <option value = "Day">Day</option>
                        <option value = "Week">Week</option>
                        <option value = "Month">Month</option>
                        <option value = "Lumpsum">Lumpsum</option>
                      </select></td>
                  </tr>
                  <?php } ?>
                </table>
              <?php } ?>
              </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="asdf">Save changes</button>
            </div> -->
            </form>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id = "mdmap" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" id="closeu" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Service Detail</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" id="mindex_acc">
              <input type="hidden" id="temp_fat_name">
              <input type="hidden" id="temp_fat_long">
              <input type="hidden" id="temp_fat_lat">
                <iframe id = "map_frame" height="1000" width="100%"></iframe>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="asdf">Save changes</button>
            </div> -->
            </form>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id = "mdlist" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height: 700px;">

            <div class="modal-header">
                <button type="button" class="close" id="closeu" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">List FAT</h4>
            </div>
            <div class="modal-body">
               
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id = "item_list_modal" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height: 700px;">

            <div class="modal-header">
                <button type="button" class="close" id="closeu" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">List Item Code</h4>
            </div>
            <div class="modal-body">
               
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        /*$("#wizard").smartWizard({
          onLeaveStep :  function(obj, context){
            var curStep = context.fromStep,
                toStep = context.toStep;
            return true;
          }
        });*/
        // $("#wizard").smartWizard({});

        $("#wizard").smartWizard({
          onLeaveStep :  function(obj, context){
            var curStep = context.fromStep,
                toStep = context.toStep;

                // return true;

            // if(curStep == 4){ // for development
            // if(toStep == 7){
            //     var d = $('#srf_form').serialize(); 
            //     $.ajax({
            //       type : 'POST', 
            //       url : '/customer/preview',
            //       async : false, 
            //       data: d,
            //       dataType : 'json', 
            //       success : function(res){
            //         var tabs = "";
            //         $('#prv_input_date').html(res.input_date);
            //         $('#prv_srf_no').html(res.srf_number);
            //         $('#prv_po_num').html(res.po_number);
            //         $('#prv_bp_num').html(res.bp_number);
            //         $('#prv_cust_id').html(res.customer_id);
            //         $('#prv_emp_id').html(res.user_id);
            //         $('#prv_emp_dept').html(res.user_department);
            //         $('#prv_emp_name').html(res.user_name);
            //         $('#prv_emp_spv').html(res.user.supervisor_name);
            //         $('#prv_emp_level').html(res.user.level);
            //         $('#prv_emp_email').html(res.user_email);
            //         $('#prv_emp_position').html(res.user_position);
            //         $('#prv_emp_phone').html(res.user_mobile);
            //         $('#prv_customer_status').html(res.customer_status);
            //         $('#prv_type_customer').html(res.customer_type);
            //         $('#prv_market_segment').html(res.market_segment);

            //         $('#prv_business_line').html(res.business_line);
            //         if(res.business_line == 'OTHERS…'){
            //           $('#prv_business_line').html(res.business_line2);
            //         }
            //         $('#prv_scale_customer').html(res.scale);
            //         $('#prv_customer_class').html(res.customer_classification);
            //         $('#prv_sla').html(res.sla_cem);
            //         $('#prv_mttr').html(res.mttr);
            //         $('#prv_mttu').html(res.mtttu);
            //         $('#prv_problem_notif').html(res.problem_notif);
            //         $('#prv_escallation').html(res.escalation_level);
            //         $('#prv_reporting').html(res.reporting);
            //         $('#prv_pof').html(res.single_contact);
            //         $('#prv_meeting').html(res.meeting);

            //         if(res.customer_type == 'Personal'){
            //           var cor = res.p_correspondence;
            //           var bil = res.p_billing;
            //           $('.prv_corporate').hide();
            //           $('.prv_personal').show();

            //           $('#prv_p_name').html(res.personal.name);
            //           $('#prv_p_birthdate').html(res.personal.birthday);
            //           if(res.personal.gender == 'F'){
            //             res.personal.gender = 'Female';
            //           } else {
            //             res.personal.gender = 'Male'
            //           }
            //           $('#prv_p_gender').html(res.personal.gender);
            //           $('#prv_p_nationality').html(res.personal.nationality);
            //           $('#prv_p_id').html(res.personal.personid);
            //           $('#prv_p_npwp').html(res.personal.npwp);
            //           $('#prv_p_mobile').html(res.personal.mobile);
            //           $('#prv_p_phone').html(res.personal.phone);

                      
            //         } else {
            //           var cor = res.c_correspondence;
            //           var bil = res.c_billing;

            //           var comp = res.company;

            //           $('.prv_corporate').show();
            //           $('.prv_personal').hide();

            //           $('#prv_comp_name').html(comp.name);
            //           $('#prv_comp_org').html(comp.organization_level);
            //           $('#prv_comp_npwp').html(comp.npwp);
            //           $('#prv_comp_siup').html(comp.siup);

            //           $('#prv_director_name').html(comp.director_name);
            //           $('#prv_director_phone').html(comp.director_phone);
            //           $('#prv_director_ext').html(comp.director_ext);
            //           $('#prv_director_email').html(comp.director_email);
            //           $('#prv_director_hp').html(comp.director_hp);

            //           $('#prv_tech_name').html(comp.technical_name);
            //           $('#prv_tech_email').html(comp.technical_email);
            //           $('#prv_tech_job').html(comp.technical_job);
            //           $('#prv_tech_phone').html(comp.technical_phone);
            //           $('#prv_tech_ext').html(comp.technical_ext);
            //           $('#prv_tech_hp').html(comp.technical_hp);

            //           $('#prv_comm_name').html(comp.commercial_name);
            //           $('#prv_comm_email').html(comp.commercial_email);
            //           $('#prv_comm_job').html(comp.commercial_job);
            //           $('#prv_comm_phone').html(comp.commercial_phone);
            //           $('#prv_comm_ext').html(comp.commercial_ext);
            //           $('#prv_comm_hp').html(comp.commercial_hp);

            //         }

            //         $('#prv_c_building').html(cor.building_name);
            //         $('#prv_c_floor').html(cor.floor);
            //         $('#prv_c_address').html(cor.address);
            //         $('#prv_c_city').html(cor.city);
            //         $('#prv_c_district').html(cor.district);
            //         $('#prv_c_subdistrict').html(cor.subdistrict);
            //         $('#prv_c_state').html(cor.state);
            //         $('#prv_c_zipcode').html(cor.zip_code);

            //         $('#prv_b_building').html(bil.building_name);
            //         $('#prv_b_floor').html(bil.floor);
            //         $('#prv_b_address').html(bil.address);
            //         $('#prv_b_city').html(bil.city);
            //         $('#prv_b_district').html(bil.district);
            //         $('#prv_b_subdistrict').html(bil.subdistrict);
            //         $('#prv_b_state').html(bil.state);
            //         $('#prv_b_zipcode').html(bil.zip_code);

            //         console.log('mapping '+ res.mapping.length);

            //         if(res.mapping.length > 0){
            //           $('.table_service tr').remove();
            //           var row = ''; 

                      // $.each(res.mapping, function(i, e){
                      //   var ins = e.installation;
                      //   if(ins.interconnection_point != ""){
                      //       row +='<tr>'+
                      //       '<td colspan= "7" style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">INSTALLATION ADDRESS</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       '<td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Interconnection Point</td>'+
                      //       '<td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.interconnection_point+'</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>'+
                      //       '<td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.interconnection_address+'</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       // '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;background-color:rgb(69,90,100);"></td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Rack ID</td>'+
                      //       '<td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.rack_id+'</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       '<td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Near End (Moratelindo/Third Party Site) </b></td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_site_id+'</td>'+
                      //       '<td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Far End (Customer Site) </b></td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>'+
                      //       '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_building_name+'</td>'+
                      //       '</tr>  '+
                      //       '<tr>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_floor+'</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>'+
                      //       '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_floor+'</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_address+'</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>'+
                      //       '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_address+'</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_subdistrict+'</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>'+
                      //       '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_subdistrict+'</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_district+'</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>'+
                      //       '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_district+'</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_city+'</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>'+
                      //       '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_city+'</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_state+'</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>'+
                      //       '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_state+'</td>'+
                      //       '</tr>'+
                      //       '<tr>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_zip_code+'</td>'+
                      //       '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>'+
                      //       '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_zip_code+'</td>'+
                      //       '</tr>';
                      //   }
                        
                      //   $.each(e.service, function(k, j){
                      //     if(j.protocol_technology == 'OTHERS…'){
                      //       j.protocol_technology = j.protocol_technology2;
                      //     }
                      //     if(j.cpe_equipment == 'OTHERS…'){
                      //       j.cpe_equipment = j.cpe_equipment2;
                      //     }
                      //     if(j.equipment_protection == 'OTHERS…'){
                      //       j.equipment_protection = j.equipment_protection2;
                      //     }
                      //     if(j.security_protection == 'OTHERS…'){
                      //       j.security_protection = j.security_protection2;
                      //     }
                      //     if(j.other_protection == 'OTHERS…'){
                      //       j.other_protection = j.other_protection2;
                      //     }
                      //     if(j.monitoring_tools == 'OTHERS…'){
                      //       j.monitoring_tools = j.monitoring_tools2;
                      //     } 

                      //     row += '<tr>'+
                      //     '<td colspan= "7" style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">SERVICE REQUEST</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Classification</td>'+
                      //     '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.classification_name+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Sub-Classification</td>'+
                      //     '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.product_subclassification+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Name</td>'+
                      //     '<td colspan= "6" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.product+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Capacity / Bandwidth / Qty</td>'+
                      //     '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.capacity+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Unit of Measurement</td>'+
                      //     '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.uom+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Type of Order</td>'+
                      //     '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.type_service+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Billing Type</td>'+
                      //     '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.billing_type+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Status</td>'+
                      //     '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.service_status+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Owner</td>'+
                      //     '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.service_owner+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product SLA</td>'+
                      //     '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.product_sla+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">SLA Restitution</td>'+
                      //     '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.sla_restitution+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Time of Service</b></td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">RFS Date</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.rfs_date+'</td>'+
                      //     '<td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Duration of Contract Agreement</b></td>'+
                      //     '<td colspan = "3" rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.duration_contract+' '+j.contract_uom+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">End of Temporary Service :</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.end_temporary+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Layer</td>'+
                      //     '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.service_layer+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Media Transmission</td>'+
                      //     '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.media+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Interface Connection</td>'+
                      //     '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.interface+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Connection Methode</td>'+
                      //     '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.connection_method+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Protocol Technology</td>'+
                      //     '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.protocol_technology+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">CPE Equipment</td>'+
                      //     '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.cpe_equipment+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Link / System Protection</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Backbone</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.backbone_protection+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Access</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.access_protection+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> Lastmile</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.lastmile_protection+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Other Protection</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Equipment</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.equipment_protection+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Security</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.security_protection+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> Others</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.other_protection+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Monitoring</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.monitoring_tools+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Managed by</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.service_managed+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Item Code</b></td>'+
                      //     '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.item_code_desc+'</td>'+
                      //     '</tr>'+
                      //     '<tr>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Management</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Billing Provide by</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.billing_by+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Lastmile Managed by</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.lastmile_by+'</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> CPE Managed by</td>'+
                      //     '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.cpe_by+'</td>'+
                      //     '</tr>';
                      //   })

                      // })
            //           $('.table_service').append(row);
            //         }

            //         $("#prv_notes").html(res.notes);

            //         // $('#prv_emp_level').html(res.);
            //         // $.each(res, function(index, block){
            //         //   var column = '<div class="col-md-6 col-xs-12">';
            //         //   $.each(block, function(key, group){
            //         //     column += '<table class = "table table-bordered"';
            //         //     column += '<tr>'
            //         //     column += ' <th colspan="4">'+group[0].group_name+'</th>';
            //         //     column += '</tr>';
            //         //     column += '<tr>';
            //         //     column += '<th></th>';
            //         //     column += '<th>SO Name</th>';
            //         //     column += '<th>Quantity</th>';
            //         //     column += '<th>UoM</th>';
            //         //     column += '</tr>';
            //         //     $.each(group, function(idx, service){
            //         //       column += '<tr>';
            //         //       column += '<td><input type="checkbox" class = "sservice" value="'+service.id+'" name = "subservice['+service.id+'][id]" checked></td>';
            //         //       column += '<td>'+service.subservice_name+'</td>';
            //         //       column += '<td><input class="form-control col-md-2 col-xs-12 " type="text" name="subservice['+service.id+'][kapasitas]" value = "'+service.kapasitas+'"><input type="hidden" name="subservice['+service.id+'][group]" value="'+service.group+'"></td>';
            //         //       // column += '<td>'+service.uom+'</td>';
            //         //       column += '<td><input class="form-control col-md-2 col-xs-12 " type="text" name="subservice['+service.id+'][uom]" value = "'+service.uom+'"></td>';
            //         //       column += '</tr>';
            //         //     })
            //         //     column += '</table>';
            //         //   })
            //         //   column += '</div>';
            //         //   tabs += column;
            //         // })

            //         // $(".tab_step").html(tabs);
            //       }
            //     })
            // }

            if(toStep == 7){
              var d = $('#srf_form').serialize(); 
              $.ajax({
                  type : 'POST', 
                  url : '/customer/preview',
                  async : false, 
                  data: d,
                  dataType : 'json', 
                  success : function(res){
                    $('#prv_input_date').html(res.input_date);
                    $('#prv_srf_no').html(res.srf_number);
                    $('#prv_po_num').html(res.po_number);
                    $('#prv_bp_num').html(res.bp_number);
                    $('#prv_cust_id').html(res.customer_id);
                    $('#prv_emp_id').html(res.user_id);
                    $('#prv_emp_dept').html(res.user_department);
                    $('#prv_emp_name').html(res.user_name);
                    $('#prv_emp_spv').html(res.user.supervisor_name);
                    $('#prv_emp_level').html(res.user.level);
                    $('#prv_emp_email').html(res.user_email);
                    $('#prv_emp_position').html(res.user_position);
                    $('#prv_emp_phone').html(res.user_mobile);
                    $('#prv_customer_status').html(res.customer_status);
                    $('#prv_type_customer').html(res.customer_type);
                    $('#prv_market_segment').html(res.market_segment);

                    $('#prv_business_line').html(res.business_line);
                    if(res.business_line == 'OTHERS…'){
                      $('#prv_business_line').html(res.business_line2);
                    }
                    $('#prv_scale_customer').html(res.scale);
                    $('#prv_customer_class').html(res.customer_classification);
                    $('#prv_sla').html(res.sla_cem);
                    $('#prv_mttr').html(res.mttr);
                    $('#prv_mttu').html(res.mtttu);
                    $('#prv_problem_notif').html(res.problem_notif);
                    $('#prv_escallation').html(res.escalation_level);
                    $('#prv_reporting').html(res.reporting);
                    $('#prv_pof').html(res.single_contact);
                    $('#prv_meeting').html(res.meeting);

                    if(res.customer_type == 'Personal'){
                      var cor = res.p_correspondence;
                      var bil = res.p_billing;
                      $('.prv_corporate').hide();
                      $('.prv_personal').show();

                      $('#prv_p_name').html(res.personal.name);
                      $('#prv_p_birthdate').html(res.personal.birthday);
                      if(res.personal.gender == 'F'){
                        res.personal.gender = 'Female';
                      } else {
                        res.personal.gender = 'Male'
                      }
                      $('#prv_p_gender').html(res.personal.gender);
                      $('#prv_p_nationality').html(res.personal.nationality);
                      $('#prv_p_id').html(res.personal.personid);
                      $('#prv_p_npwp').html(res.personal.npwp);
                      $('#prv_p_mobile').html(res.personal.mobile);
                      $('#prv_p_phone').html(res.personal.phone);

                      
                    } else {
                      var cor = res.c_correspondence;
                      var bil = res.c_billing;

                      var comp = res.company;

                      $('.prv_corporate').show();
                      $('.prv_personal').hide();

                      $('#prv_comp_name').html(comp.name);
                      $('#prv_comp_org').html(comp.organization_level);
                      $('#prv_comp_npwp').html(comp.npwp);
                      $('#prv_comp_siup').html(comp.siup);

                      $('#prv_director_name').html(comp.director_name);
                      $('#prv_director_phone').html(comp.director_phone);
                      $('#prv_director_ext').html(comp.director_ext);
                      $('#prv_director_email').html(comp.director_email);
                      $('#prv_director_hp').html(comp.director_hp);

                      $('#prv_tech_name').html(comp.technical_name);
                      $('#prv_tech_email').html(comp.technical_email);
                      $('#prv_tech_job').html(comp.technical_job);
                      $('#prv_tech_phone').html(comp.technical_phone);
                      $('#prv_tech_ext').html(comp.technical_ext);
                      $('#prv_tech_hp').html(comp.technical_hp);

                      $('#prv_comm_name').html(comp.commercial_name);
                      $('#prv_comm_email').html(comp.commercial_email);
                      $('#prv_comm_job').html(comp.commercial_job);
                      $('#prv_comm_phone').html(comp.commercial_phone);
                      $('#prv_comm_ext').html(comp.commercial_ext);
                      $('#prv_comm_hp').html(comp.commercial_hp);

                    }

                    $('#prv_c_building').html(cor.building_name);
                    $('#prv_c_floor').html(cor.floor);
                    $('#prv_c_address').html(cor.address);
                    $('#prv_c_city').html(cor.city);
                   /* $('#prv_c_district').html(cor.district);
                    $('#prv_c_subdistrict').html(cor.subdistrict);
                    $('#prv_c_state').html(cor.state);
                    $('#prv_c_zipcode').html(cor.zip_code);*/

                    $('#prv_b_building').html(bil.building_name);
                    $('#prv_b_floor').html(bil.floor);
                    $('#prv_b_address').html(bil.address);
                    /*$('#prv_b_city').html(bil.city);
                    $('#prv_b_district').html(bil.district);
                    $('#prv_b_subdistrict').html(bil.subdistrict);
                    $('#prv_b_state').html(bil.state);
                    $('#prv_b_zipcode').html(bil.zip_code);*/

                    if(res.mapping.length > 0){
                      $('.table_service tr').remove();
                      var row = ''; 

                      $.each(res.mapping, function(i, e){
                          var ins = e.installation;

                          console.log(ins);
                          if(ins.interconnection_point != ""){
                              row +='<tr>'+
                              '<td colspan= "7" style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">INSTALLATION ADDRESS</td>'+
                              '</tr>'+
                              '<tr>'+
                              '<td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Interconnection Point</td>'+
                              '<td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.interconnection_point+'</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>'+
                              '<td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.interconnection_address+'</td>'+
                              '</tr>'+
                              '<tr>'+
                              // '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align:left;font-weight:bold;border:1px solid #000;background-color:rgb(69,90,100);"></td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Rack ID</td>'+
                              '<td colspan = "4" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.rack_id+'</td>'+
                              '</tr>'+
                              '<tr>'+
                              '<td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Near End (Moratelindo/Third Party Site) </b></td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_site_id+'</td>'+
                              '<td rowspan = "3" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Far End (Customer Site) </b></td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Building Name</td>'+
                              '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_building_name+'</td>'+
                              '</tr>  '+
                              '<tr>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_floor+'</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Floor/Block</td>'+
                              '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_floor+'</td>'+
                              '</tr>'+
                              '<tr>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_address+'</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Address</td>'+
                              '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_address+'</td>'+
                              '</tr>';
                              /*'<tr>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_subdistrict+'</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Subdistrict</td>'+
                              '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_subdistrict+'</td>'+
                              '</tr>'+
                              '<tr>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_district+'</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">District</td>'+
                              '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_district+'</td>'+
                              '</tr>'+
                              '<tr>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_city+'</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">City</td>'+
                              '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_city+'</td>'+
                              '</tr>'+
                              '<tr>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_state+'</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">State</td>'+
                              '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_state+'</td>'+
                              '</tr>'+
                              '<tr>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.ne_zip_code+'</td>'+
                              '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Zip Code</td>'+
                              '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+ins.fe_zip_code+'</td>'+*/
                              // '</tr>';
                          }
                          
                          console.log(e.service.length);

                          $.each(e.service, function(k, j){
                            if(j.protocol_technology == 'OTHERS…'){
                              j.protocol_technology = j.protocol_technology2;
                            }
                            if(j.cpe_equipment == 'OTHERS…'){
                              j.cpe_equipment = j.cpe_equipment2;
                            }
                            if(j.equipment_protection == 'OTHERS…'){
                              j.equipment_protection = j.equipment_protection2;
                            }
                            if(j.security_protection == 'OTHERS…'){
                              j.security_protection = j.security_protection2;
                            }
                            if(j.other_protection == 'OTHERS…'){
                              j.other_protection = j.other_protection2;
                            }
                            if(j.monitoring_tools == 'OTHERS…'){
                              j.monitoring_tools = j.monitoring_tools2;
                            } 

                            row += '<tr>'+
                            '<td colspan= "7" style="padding: 5px 10px;background-color: rgb(60,93,141);color:#ffffff;text-align: left;font-weight:bold;border:1px solid #000">SERVICE REQUEST</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Classification</td>'+
                            '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.classification_name+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Sub-Classification</td>'+
                            '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.product_subclassification+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product Name</td>'+
                            '<td colspan= "6" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.product+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Capacity / Bandwidth / Qty</td>'+
                            '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.capacity+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Unit of Measurement</td>'+
                            '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.uom+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Type of Order</td>'+
                            '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.type_service+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Billing Type</td>'+
                            '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.billing_type+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Status</td>'+
                            '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.service_status+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Owner</td>'+
                            '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.service_owner+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Product SLA</td>'+
                            '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.product_sla+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">SLA Restitution</td>'+
                            '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.sla_restitution+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Time of Service</b></td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">RFS Date</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.rfs_date+'</td>'+
                            '<td rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Duration of Contract Agreement</b></td>'+
                            '<td colspan = "3" rowspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.duration_contract+' '+j.contract_uom+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">End of Temporary Service :</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.end_temporary+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Layer</td>'+
                            '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.service_layer+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Media Transmission</td>'+
                            '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.media+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Interface Connection</td>'+
                            '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.interface+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Connection Methode</td>'+
                            '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.connection_method+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Protocol Technology</td>'+
                            '<td colspan= "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.protocol_technology+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">CPE Equipment</td>'+
                            '<td colspan= "3" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.cpe_equipment+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Link / System Protection</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Backbone</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.backbone_protection+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Access</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.access_protection+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> Lastmile</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.lastmile_protection+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Other Protection</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Equipment</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.equipment_protection+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Security</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.security_protection+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> Others</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.other_protection+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Monitoring</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.monitoring_tools+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Managed by</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.service_managed+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"><b>Item Code</b></td>'+
                            '<td colspan = "2" style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.item_code_desc+'</td>'+
                            '</tr>'+
                            '<tr>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Service Management</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Billing Provide by</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.billing_by+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000">Lastmile Managed by</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.lastmile_by+'</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;font-weight:bold;border:1px solid #000"> CPE Managed by</td>'+
                            '<td style="padding: 5px 10px;color:#000;text-align: left;border:1px solid #000">'+j.cpe_by+'</td>'+
                            '</tr>';
                          })

                          $('.table_service').append(row);

                      })
                    }
                    $("#prv_notes").html(res.notes);
                  }
              });
            }

            return true;

            // if(toStep < curStep){
            //     return true;
            // } else {
            //   var content = ".form-step-"+curStep;
            //   var req = $(content).find('.input');
            //   var valid = 'true';
            //   $.each(req, function(i, elem){
            //       var f = '#'+elem.id;
            //       var y = $(f).parsley();
            //       y.validate();
            //       if(y.isValid() == false){
            //         console.log('f '+f);
            //         console.log(y.isValid());
            //         valid = 'false';
            //       }
            //   })
            //   if(valid != 'false'){
            //     return true;
            //   }
            //   if(valid == 'true'){
            //     return true;
            //   }
            // }
          }
        });

        $('#personal').hide();

        $('#customer_type').change(function(){
            var customer_type = $(this).val();
            if(customer_type == 'Corporate'){
                $('#corporate').show();
                $('#personal').hide();
                $(".person").removeClass('input');
                $(".company").removeClass('input');
                $(".company").addClass('input');
            } else {
                $('#corporate').hide();
                $('#personal').show();
                $(".person").removeClass('input');
                $(".company").removeClass('input');
                $(".person").addClass('input');
            }
        })
        $('.temporary-service').hide();
        $('#service_purpose').change(function(){
          if($(this).val() == 'Temporary'){
            $('.temporary-service').show();
          } else {
            $('.temporary-service').hide();
          }
        })
        $('.media-fo').hide();
        $('#media_delivery').change(function(){
          if($(this).val() == 'FO'){
            $('.media-fo').show();
          } else {
            $('.media-fo').hide();
          }
        })

        $('.city').change(function(e){
          var isi = $(this).val();
          isi = isi.split('#');
          var $otherInput = $(this).closest('.dda').find('.district');
          var $textInput = $(this).closest('.form-group').find('.city_text');
          $textInput.val(isi[1]);
          var opt = '<option value="">-- Select --</option>';
          $otherInput.find('option').remove();
          console.log($otherInput);
          $.ajax({
            type : 'GET', 
            url : '/customer/kecamatan/'+isi[0],
            async : false, 
            dataType : 'json', 
            success : function(res){
              if(res.status == 200){
                dt = res.data;
                $.each(dt, function(i, r){
                  opt += '<option value="'+r.id+'#'+r.name+'">'+r.name+'</option>';
                })
              }
            }
          });
          $otherInput.append(opt);
        })

        $('.possibly_other').change(function(){
          var v = $(this).val();
          var $otherInput = $(this).closest('.parent').find('.other_input');
          if(v == 'OTHERS…'){
            $($otherInput).removeClass('hidden');
            $($otherInput).prop('required',true);
          } else {
            $($otherInput).addClass('hidden');
            $($otherInput).prop('required',false);
          }
        })

        // $('.select2').select2({
        //   // theme: 'bootstrap4',
        //   ajax: {
        //     url: "/customer/itemCodeAjax",
        //     dataType: 'json',
        //     type: 'POST',
        //     data: function (params) {
        //       var query = {
        //         search: params.term,
        //         page: params.page || 1
        //       }

        //       // Query parameters will be ?search=[term]&page=[page]
        //       return query;
        //     },
        //     processResults: function (data, params) {
        //         params.page = params.page || 1;
        //         console.log(params.page);


        //         return {
        //             results: data.results,
        //             pagination: {
        //                 more: (params.page * 10) < data.total_count
        //             }
        //         };
        //     }
        //   }
        // });



        $('.district').change(function(e){
          var isi = $(this).val();
          isi = isi.split('#');
          var $otherInput = $(this).closest('.dda').find('.subdistrict');
          var $textInput = $(this).closest('.form-group').find('.district_text');
          $textInput.val(isi[1]);
          var opt = '<option value="">-- Select --</option>';
          $otherInput.find('option').remove();
          // console.log($otherInput);
          $.ajax({
            type : 'GET', 
            url : '/customer/kelurahan/'+isi[0],
            async : false, 
            dataType : 'json', 
            success : function(res){
              if(res.status == 200){
                dt = res.data;
                $.each(dt, function(i, r){
                  opt += '<option value="'+r.name+'">'+r.name+'</option>';
                })
              }
            }
          });
          $otherInput.append(opt);
        })

        $('#customer_classification').change(function(){
          var cust_class = $(this).val();
          $.ajax({
            type : 'POST', 
            url : '/customer/classification',
            async : false, 
            data : {cust_class : cust_class},
            dataType : 'json', 
            success : function(res){
              if(res.status == 200){
                dt = res.data;
                $('#sla_cem').val(dt.sla_sales);
                $('#mttr').val(dt.mttr);
                $('#problem_notif').val(dt.problem_notification);
                $('#mttu').val(dt.mttu);
                $('#escalation').val(dt.escalation_level);
                $('#reporting').val(dt.reporting);
                $('#single_contact').val(dt.single_point_of_contact);
                $('#meeting').val(dt.meeting);
              }

            }
          })
        })

        $('.product_class').change(function(){
          // console.log(this)
          var index = $(this).attr('rowidf'),
              pdn = '#product_name'+index,
              sbc = '#product_subclassification'+index;

          $(pdn).val(null).trigger('change');
          $(pdn).find('option').remove();

          $(sbc).val(null).trigger('change');
          $(sbc).find('option').remove();

          var opt = product_load($(this).val());
          var opt2 = subclass_load($(this).val());
          $(pdn).append(opt);
          $(sbc).append(opt2);

        })

        function product_load(r){
          // console.log(r)

          var opt = '<option value = "">-- Select --</option>';
          $.ajax({
            type : 'POST', 
            url : '/customer/product_name',
            async : false, 
            data : {service_group_id : r},
            dataType : 'json', 
            success : function(res){
              if(res.status == 200){
                $.each(res.data, function(i, dt){
                  opt += '<option value = "'+dt.id+'">'+dt.subservice_name+'</option>';
                })
              }

            }
          })

          return opt;

        }


        function subclass_load(r){
          // console.log(r)

          var opt = '<option value = "">-- Select --</option>';
          $.ajax({
            type : 'POST', 
            url : '/customer/product_subclass',
            async : false, 
            data : {service_group_id : r},
            dataType : 'json', 
            success : function(res){
              if(res.status == 200){
                $.each(res.data, function(i, dt){
                  opt += '<option value = "'+dt.subservice_name+'">'+dt.subservice_name+'</option>';
                })
              }

            }
          })

          return opt;

        }

        var product_class = "";

        $.ajax({
            type : 'GET', 
            url : '/customer/product_class',
            async : false, 
            dataType : 'json', 
            success : function(res){
              if(res.status == 200){
                $.each(res.data, function(i, dt){
                  product_class += '<option value = "'+dt.id+'">'+dt.group_name+'</option>';
                })

                console.log(product_class);

              }

            }
          })

        var kab="";
        $.ajax({
          type : 'GET', 
          url : '/customer/cityAjax',
          async : false, 
          dataType : 'json', 
          success : function(res){
              $.each(res, function(i, dt){
                kab += '<option value = "'+dt.id+'#'+dt.name+'">'+dt.name+'</option>';
              })
          }
        })

        var row = 1;

        $('#add_row_service').click(function(e){
          e.preventDefault();
          console.log(product_class);
          console.log(kab);
          // var rows = '<div class="row"> <div class="x_panel"> halo assalamualaikum</div></div>';
          var rows = '<div class="row panel_service">'+
            '<div class="x_title">'+
            '<h2>Service Request</h2>'+
            '<ul class="nav navbar-right panel_toolbox">'+
            '<li><a class="close-link"><i class="fa fa-close"></i></a>'+
            '</li>'+
            '</ul>'+
            '<div class="clearfix"></div>'+
            '</div>'+
            '<div class="x_panel ">'+
            '<div class = "row">'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Classification'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="product_class'+1+'" name="mservice['+row+'][product_classification]" class="form-control js-example-tags input product_class" class="form-control js-example-tags input" rowidf = "'+row+'">'+
            '<option value="">-- Select --</option>'+
            product_class +
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Sub Classification'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="product_subclassification'+row+'" name="mservice['+row+'][product_subclassification]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            // '<option value = "INTERNATIONAL LINK"> INTERNATIONAL LINK </option>'+
            // '<option value = "DOMESTIC LINK"> DOMESTIC LINK </option>'+
            // '<option value = "IP TRANSIT"> IP TRANSIT </option>'+
            // '<option value = "BURSTABLE INTERNET"> BURSTABLE INTERNET </option>'+
            // '<option value = "DEDICATED INTERNET"> DEDICATED INTERNET </option>'+
            // '<option value = "INTERNET EXCHANGE"> INTERNET EXCHANGE </option>'+
            // '<option value = "CO-LOCATION"> CO-LOCATION </option>'+
            // '<option value = "HOSTING & CLOUD"> HOSTING & CLOUD </option>'+
            // '<option value = "MANAGED SERVICE"> MANAGED SERVICE </option>'+
            // '<option value = "ICT"> ICT </option>'+
            // '<option value = "Non-ICT"> Non-ICT </option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Product Name '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="product_name'+row+'" name="mservice['+row+'][product_name]" class="form-control js-example-tags input" class="form-control js-example-tags input" style="width: 960px;">'+
            '<option value="">-- Select --</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '<div class = "row">'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Capacity / Bandwidth / Qty '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="capacity'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="mservice['+row+'][capacity]" required="required" data-parsley-errors-container="#for_rfs_date">'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit of Measurement'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="uom'+row+'" name="mservice['+row+'][uom]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value ="Core">Core</option>'+
            '<option value ="Kbps">Kbps</option>'+
            '<option value ="Mbps">Mbps</option>'+
            '<option value ="Gbps">Gbps</option>'+
            '<option value ="KB">KB</option>'+
            '<option value ="MB">MB</option>'+
            '<option value ="GB">GB</option>'+
            '<option value ="TB">TB</option>'+
            '<option value ="Account">Account</option>'+
            '<option value ="License">License</option>'+
            '<option value ="Rack">Rack</option>'+
            '<option value ="U">U</option>'+
            '<option value ="Tower">Tower</option>'+
            '<option value ="Node">Node</option>'+
            '<option value ="M2">M2</option>'+
            '<option value ="Km">Km</option>'+
            '<option value ="MHz">MHz</option>'+
            '<option value ="GHz">GHz</option>'+
            '<option value ="Ampere">Ampere</option>'+
            '<option value ="IP">IP</option>'+
            '<option value ="AS Number">AS Number</option>'+
            '<option value ="Number">Number</option>'+
            '<option value ="Extention">Extention</option>'+
            '<option value ="Domain">Domain</option>'+
            '<option value ="STB">STB</option>'+
            '<option value ="Router">Router</option>'+
            '<option value ="Access Point">Access Point</option>'+
            '<option value ="Person">Person</option>'+
            '<option value ="Day">Day</option>'+
            '<option value ="Week">Week</option>'+
            '<option value ="Month">Month</option>'+
            '<option value ="Lumpsum">Lumpsum</option>'+
            '</select>'+
            '<span id = "for_customer_classification"></span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class = "row">'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Order '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="type_order'+row+'" name="mservice['+row+'][type_order]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "NEW">NEW</option>'+
            '<option value = "UPGRADE">UPGRADE</option>'+
            '<option value = "DOWNGRADE">DOWNGRADE</option>'+
            '<option value = "RELOCATION">RELOCATION</option>'+
            '<option value = "DISMANTLE">DISMANTLE</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Billing Type '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="billing_type'+row+'" name="mservice['+row+'][billing_type]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value ="Charged">Charged</option>'+
            '<option value ="No Charged">No Charged</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class = "row">'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Service '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="type_service'+row+'" name="mservice['+row+'][type_service]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "PERMANENT">PERMANENT</option>'+
            '<option value = "TEMPORARY">TEMPORARY</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Purpose '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="service_purpose'+row+'" name="mservice['+row+'][service_purpose]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "FIXED RECURRING SERVICE"> FIXED RECURRING SERVICE </option>'+
            '<option value = "BANDWIDTH ON DEMAND"> BANDWIDTH ON DEMAND </option>'+
            '<option value = "EVENT"> EVENT </option>'+
            '<option value = "POC"> POC </option>'+
            '<option value = "TEMPORARY TRIAL"> TEMPORARY TRIAL </option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class = "row">'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Status '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="service_status'+row+'" name="mservice['+row+'][service_status]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "MAIN SERVICE">MAIN SERVICE</option>'+
            '<option value = "BACK-UP SERVICE">BACK-UP SERVICE</option>'+
            '<option value = "2nd BACK-UP SERVICE">2nd BACK-UP SERVICE</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Owner '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="service_owner'+row+'" name="mservice['+row+'][service_owner]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "MORATELINDO"> MORATELINDO </option>'+
            '<option value = "3rd PARTY"> 3rd PARTY </option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class = "row">'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product SLA '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="product_sla'+row+'" name="mservice['+row+'][product_sla]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "95%"> 95%</option>'+
            '<option value = "95.50%"> 95.50%</option>'+
            '<option value = "96%"> 96%</option>'+
            '<option value = "96.50%"> 96.50%</option>'+
            '<option value = "97%"> 97%</option>'+
            '<option value = "97.50%"> 97.50%</option>'+
            '<option value = "98%"> 98%</option>'+
            '<option value = "98.50%"> 98.50%</option>'+
            '<option value = "99%"> 99%</option>'+
            '<option value = "99.50%"> 99.50%</option>'+
            '<option value = "99.60%"> 99.60%</option>'+
            '<option value = "99.70%"> 99.70%</option>'+
            '<option value = "99.80%"> 99.80%</option>'+
            '<option value = "99.85%"> 99.85%</option>'+
            '<option value = "99.90%"> 99.90%</option>'+
            '<option value = "99.95%"> 99.95%</option>'+
            '<option value = "99.97%"> 99.97%</option>'+
            '<option value = "99.98%"> 99.98%</option>'+
            '<option value = "99.99%"> 99.99%</option>'+
            '<option value = "99.999%"> 99.999%</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SLA Restitution '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="sla_restitution'+row+'" name="mservice['+row+'][sla_restitution]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "APPLIED">APPLIED</option>'+
            '<option value = "NOT APPLIED">NOT APPLIED</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class = "row">'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">RFS Date '+
            '</label>'+
            '<div class="col-md-3 col-sm-6 col-xs-12">'+
            '<input id="rfs_date'+row+'" class="form-control col-md-7 col-xs-12 input single_date" type="text" name="mservice['+row+'][rfs_date]" required="required" data-parsley-errors-container="#for_rfs_date">'+
            '</div>'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">End of Temporary Service '+
            '</label>'+
            '<div class="col-md-3 col-sm-6 col-xs-12">'+
            '<input id="end_temporary'+row+'" class="form-control col-md-7 col-xs-12 input single_date" type="text" name="mservice['+row+'][end_temporary]" required="required" data-parsley-errors-container="#for_rfs_date">'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Duration of Contract Agreement '+
            // '</label>'+
            // '<div class="col-md-6 col-sm-6 col-xs-12">'+
            // '<select id="duration_contract" name="mservice['+row+'][duration_contract]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "1">1</option>'+
            // '<option value = "2">2</option>'+
            // '<option value = "3">3</option>'+
            // '<option value = "4">4</option>'+
            // '<option value = "5">5</option>'+
            // '<option value = "6">6</option>'+
            // '<option value = "7">7</option>'+
            // '<option value = "8">8</option>'+
            // '<option value = "9">9</option>'+
            // '<option value = "10">10</option>'+
            // '<option value = "11">11</option>'+
            // '<option value = "12">12</option>'+
            // '<option value = "13">13</option>'+
            // '<option value = "14">14</option>'+
            // '<option value = "15">15</option>'+
            // '<option value = "16">16</option>'+
            // '<option value = "17">17</option>'+
            // '<option value = "18">18</option>'+
            // '<option value = "19">19</option>'+
            // '<option value = "20">20</option>'+
            // '</select>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Duration of Contract Agreement '+
            '</label>'+
            '<div class="col-md-3 col-sm-4 col-xs-12">'+
            '<select id="duration_contract'+row+'" name="mservice['+row+'][duration_contract]" class="form-control input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "1">1</option>'+
            '<option value = "2">2</option>'+
            '<option value = "3">3</option>'+
            '<option value = "4">4</option>'+
            '<option value = "5">5</option>'+
            '<option value = "6">6</option>'+
            '<option value = "7">7</option>'+
            '<option value = "8">8</option>'+
            '<option value = "9">9</option>'+
            '<option value = "10">10</option>'+
            '<option value = "11">11</option>'+
            '<option value = "12">12</option>'+
            '<option value = "13">13</option>'+
            '<option value = "14">14</option>'+
            '<option value = "15">15</option>'+
            '<option value = "16">16</option>'+
            '<option value = "17">17</option>'+
            '<option value = "18">18</option>'+
            '<option value = "19">19</option>'+
            '<option value = "20">20</option>'+
            '</select>'+
            '</div>'+
            '<div class="col-md-3 col-sm-4 col-xs-12">'+
            '<select id="contract_uom'+row+'" name="mservice['+row+'][contract_uom]" class="form-control input" data-parsley-errors-container="#for_customer_classification">'+
            '<option value="">-- Select --</option>'+
            '<option value = "day">day</option>'+
            '<option value = "week">week</option>'+
            '<option value = "month">month</option>'+
            '<option value = "year">year</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            // '<div class = "row">'+
            // '<div class="col-md-6 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Layer '+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12">'+
            // '<select id="service_layer'+row+'" name="mservice['+row+'][service_layer]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "1">1</option>'+
            // '<option value = "2">2</option>'+
            // '<option value = "3">3</option>'+
            // '<option value = "4">4</option>'+
            // '<option value = "5">5</option>'+
            // '<option value = "6">6</option>'+
            // '<option value = "7">7</option>'+
            // '</select>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class="col-md-6 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Media Transmission '+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12">'+
            // '<select id="media'+row+'" name="mservice['+row+'][media]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "FIBER OPTIC">FIBER OPTIC</option>'+
            // '<option value = "COAXIAL">COAXIAL</option>'+
            // '<option value = "TWISTED PAIR (ETH/UTP)">TWISTED PAIR (ETH/UTP)</option>'+
            // '<option value = "RADIO MICROWAVE">RADIO MICROWAVE</option>'+
            // '<option value = "VSAT">VSAT</option>'+
            // '<option value = "WiFi">WiFi</option>'+
            // '<option value = "BLUETOOTH">BLUETOOTH</option>'+
            // '<option value = "ZIGBEE">ZIGBEE</option>'+
            // '<option value = "3G">3G</option>'+
            // '<option value = "4G/LTE">4G/LTE</option>'+
            // '<option value = "5G">5G</option>'+
            // '</select>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class = "row">'+
            // '<div class="col-md-6 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Interface Connection'+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12">'+
            // '<select id="interface'+row+'" name="mservice['+row+'][interface]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "HDMI"> HDMI </option>'+
            // '<option value = "RJ11"> RJ11 </option>'+
            // '<option value = "RJ45"> RJ45 </option>'+
            // '<option value = "RS232"> RS232 </option>'+
            // '<option value = "SC,LC,FC (PATCHCORD)"> SC,LC,FC (PATCHCORD) </option>'+
            // '<option value = "SFP, SFP+, XFP (OPTICAL)"> SFP, SFP+, XFP (OPTICAL) </option>'+
            // '<option value = "T1/E1"> T1/E1 </option>'+
            // '<option value = "USB"> USB </option>'+
            // '<option value = "WEB SERVICE"> WEB SERVICE </option>'+
            // '</select>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class="col-md-6 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Connection Methode '+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12">'+
            // '<select id="connection_method'+row+'" name="mservice['+row+'][connection_method]" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "MPLS">MPLS</option>'+
            // '<option value = "PPPOE">PPPOE</option>'+
            // '<option value = "TRUNK">TRUNK</option>'+
            // '<option value = "VLAN">VLAN</option>'+
            // '<option value = "VPN">VPN</option>'+
            // '<option value = "BGP">BGP</option>'+
            // '</select>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class = "row">'+
            // '<div class="col-md-6 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Protocol Technology'+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12 parent">'+
            // '<select id="protocol_technology'+row+'" name="mservice['+row+'][protocol_technology]" class="form-control js-example-tags input possibly_other" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value = "DWDM">DWDM</option>'+
            // '<option value = "SDH">SDH</option>'+
            // '<option value = "EoSDH">EoSDH</option>'+
            // '<option value = "METRO-E">METRO-E</option>'+
            // '<option value = "IP">IP</option>'+
            // '<option value = "GPON">GPON</option>'+
            // '<option value = "OTHERS…">OTHERS…</option>'+
            // '</select><br/><br/>'+
            // '<input type="text" id="protocol_technology2_'+row+'" style = "width: 250px;" name="mservice['+row+'][protocol_technology2]" class="form-control col-md-9 col-xs-12 input other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class="col-md-6 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CPE Equipment '+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12 parent">'+
            // '<select id="cpe_equipment'+row+'" name="mservice['+row+'][cpe_equipment]" class="form-control js-example-tags input possibly_other" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "STB">STB</option>'+
            // '<option value = "CCTV / IP-CAMERA">CCTV / IP-CAMERA</option>'+
            // '<option value = "FIXED PHONE">FIXED PHONE</option>'+
            // '<option value = "IP-PBX">IP-PBX</option>'+
            // '<option value = "MINI HEADEND">MINI HEADEND</option>'+
            // '<option value = "ACCESS POINT">ACCESS POINT</option>'+
            // '<option value = "ONT">ONT</option>'+
            // '<option value = "ROUTER">ROUTER</option>'+
            // '<option value = "MINI PC">MINI PC</option>'+
            // '<option value = "FIREWALL">FIREWALL</option>'+
            // '<option value = "OTHERS…">OTHERS…</option>'+
            // '</select>'+
            // '<br/><br/>'+
            // '<input type="text" id="cpe_equipment2_'+row+'" style = "width: 250px;" name="mservice['+row+'][cpe_equipment2]" class="form-control col-md-9 col-xs-12 input other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class = "row">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Backbone Protection '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12">'+
            // '<select id="backbone_protection'+row+'" name="mservice['+row+'][backbone_protection]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "ASON - SBR">ASON - SBR</option>'+
            // '<option value = "ASON - SNCP">ASON - SNCP</option>'+
            // '<option value = "SINGLE LINK">SINGLE LINK</option>'+
            // '<option value = "DOUBLE LINK">DOUBLE LINK</option>'+
            // '<option value = "TRIPLE LINK">TRIPLE LINK</option>'+
            // '<option value = "3rd PARTY LINK">3rd PARTY LINK</option>'+
            // '<option value = "NO PROTECTION">NO PROTECTION</option>'+
            // '</select>'+
            // '</div>'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Access Protection '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12">'+
            // '<select id="access_protection'+row+'" name="mservice['+row+'][access_protection]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "SINGLE LINK">SINGLE LINK</option>'+
            // '<option value = "DOUBLE LINK">DOUBLE LINK</option>'+
            // '<option value = "TRIPLE LINK">TRIPLE LINK</option>'+
            // '<option value = "3rd PARTY LINK">3rd PARTY LINK</option>'+
            // '<option value = "NO PROTECTION">NO PROTECTION</option>'+
            // '</select>'+
            // '</div>'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Lastmile Protection '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12">'+
            // '<select id="lastmile_protection'+row+'" name="mservice['+row+'][lastmile_protection]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "SINGLE LINK"> SINGLE LINK</option>'+
            // '<option value = "DOUBLE LINK"> DOUBLE LINK</option>'+
            // '<option value = "TRIPLE LINK"> TRIPLE LINK</option>'+
            // '<option value = "3rd PARTY LINK"> 3rd PARTY LINK</option>'+
            // '<option value = "NO PROTECTION"> NO PROTECTION</option>'+
            // '</select>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class = "row">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Equipment Protection '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12 parent">'+
            // '<select id="equipment_protection'+row+'" name="mservice['+row+'][equipment_protection]" class="form-control input possibly_other" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "ACTIVE-ACTIVE REDUNDANT">ACTIVE-ACTIVE REDUNDANT</option>'+
            // '<option value = "ACTIVE-PASSIVE REDUNDANT">ACTIVE-PASSIVE REDUNDANT</option>'+
            // '<option value = "NO PROTECTION">NO PROTECTION</option>'+
            // '<option value = "OTHERS…">OTHERS…</option>'+
            // '</select>'+
            // '<br/>' +
            // '<input type="text" id="equipment_protection2_'+row+'" style = "width: 150px;" name="mservice['+row+'][equipment_protection2]" class="form-control col-md-9 col-xs-12 input other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">'+
            // '</div>'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Security Protection '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12 parent">'+
            // '<select id="security_protection'+row+'" name="mservice['+row+'][security_protection]" class="form-control input possibly_other" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "ANTI VIRUS">ANTI VIRUS</option>'+
            // '<option value = "FIREWALL">FIREWALL</option>'+
            // '<option value = "DDOS">DDOS</option>'+
            // '<option value = "ENCRYPTION">ENCRYPTION</option>'+
            // '<option value = "NO PROTECTION">NO PROTECTION</option>'+
            // '<option value = "OTHERS…">OTHERS…</option>'+
            // '</select>'+
            // '<br/>'+
            // '<input type="text" id="security_protection2_'+row+'" style = "width: 150px;" name="mservice['+row+'][security_protection2]" class="form-control col-md-9 col-xs-12 input other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">'+
            // '</div>'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Other Protection '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12 parent">'+
            // '<select id="other_protection'+row+'" name="mservice['+row+'][other_protection]" class="form-control input possibly_other" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "LIGHTENING ARRESTER">LIGHTENING ARRESTER</option>'+
            // '<option value = "DRC">DRC</option>'+
            // '<option value = "REMOTE HAND">REMOTE HAND</option>'+
            // '<option value = "CLOUD BACK-UP">CLOUD BACK-UP</option>'+
            // '<option value = "NO PROTECTION">NO PROTECTION</option>'+
            // '<option value = "OTHERS…">OTHERS…</option>'+
            // '</select>'+
            // '<br/>'+
            // '<input type="text" id="other_protection2_'+row+'" style = "width: 150px;" name="mservice['+row+'][other_protection2]" class="form-control col-md-9 col-xs-12 input other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class = "row">'+
            // '<div class="col-md-4 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Monitoring Tools '+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12 parent">'+
            // '<select id="monitoring_tools'+row+'" name="mservice['+row+'][monitoring_tools]" class="form-control input possibly_other" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "MRTG">MRTG</option>'+
            // '<option value = "MRTG & PRTG">MRTG & PRTG</option>'+
            // '<option value = "LOOKING GLASS">LOOKING GLASS</option>'+
            // '<option value = "OXYGEN SELFCARE">OXYGEN SELFCARE</option>'+
            // '<option value = "NOT AVAILABLE">NOT AVAILABLE</option>'+
            // '<option value = "OTHERS…">OTHERS…</option>'+
            // '</select>'+
            // '<br/><br/>'+
            // '<input type="text" id="monitoring_tools2_'+row+'" style = "width: 300px;" name="mservice['+row+'][monitoring_tools2]" class="form-control col-md-9 col-xs-12 input other_input hidden" placeholder = "Please input here" data-parsley-errors-container="#for_business_line" data-parsley-error-message="Please input field">'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class="col-md-4 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Managed By '+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12">'+
            // '<select id="service_managed'+row+'" name="mservice['+row+'][service_managed]" class="form-control input" data-parsley-errors-container="#for_customer_classification">'+
            // '<option value = "MORATELINDO">MORATELINDO</option>'+
            // '<option value = "CUSTOMER">CUSTOMER</option>'+
            // '<option value = "3rd PARTY">3rd PARTY</option>'+
            // '</select>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class="col-md-4 col-sm-6 col-xs-12">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Item Code'+
            // '</label>'+
            // '<div class="col-md-9 col-sm-6 col-xs-12">'+
            // '<div class="input-group">'+
            // '<input type="hidden" name = "mservice['+row+'][item_code]" id = "itemcode'+row+'">'+
            // '<input type="text" class="form-control" name = "mservice['+row+'][item_code_desc]" id = "itemcode_desc'+row+'">'+
            // '<span class="input-group-btn">'+
            // '<button type="button" class="btn btn-primary item_code_list" row = "'+row+'"><span class="fa fa-list"></span></button>'+
            // '</span>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            // '<div class = "row">'+
            // '<div class="form-group">'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Billing Provided By '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12">'+
            // '<select id="billing_by'+row+'" name="mservice['+row+'][billing_by]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "MORATELINDO" >MORATELINDO</option>'+
            // '<option value = "CUSTOMER" >CUSTOMER</option>'+
            // '<option value = "BUILDING MANAGEMENT" >BUILDING MANAGEMENT</option>'+
            // '</select>'+
            // '</div>'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Lastmile Managed By '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12">'+
            // '<select id="lastmile_by'+row+'" name="mservice['+row+'][lastmile_by]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "MORATELINDO" >MORATELINDO</option>'+
            // '<option value = "CUSTOMER" >CUSTOMER</option>'+
            // '<option value = "BUILDING MANAGEMENT" >BUILDING MANAGEMENT</option>'+
            // '</select>'+
            // '</div>'+
            // '<label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">CPE Managed By '+
            // '</label>'+
            // '<div class="col-md-2 col-sm-6 col-xs-12">'+
            // '<select id="cpe_by'+row+'" name="mservice['+row+'][cpe_by]" class="form-control input" data-parsley-errors-container="#for_customer_classification" style="width: 150px;">'+
            // '<option value="">-- Select --</option>'+
            // '<option value = "MORATELINDO" >MORATELINDO</option>'+
            // '<option value = "CUSTOMER" >CUSTOMER</option>'+
            // '<option value = "BUILDING MANAGEMENT" >BUILDING MANAGEMENT</option>'+
            // '</select>'+
            // '</div>'+
            // '</div>'+
            // '</div>'+
            '<h4><b>Installation Address</b></h4>'+
            '<div class="ln_solid"></div>'+
            '<div class = "row">'+
            '<div class="col-md-6 col-xs-12 dda">'+
            '<div class="row">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Interconnection Point</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="interconnection'+row+'" name="installation['+row+'][interconnection_point]"  class="form-control js-example-tags input" >'+
            '<option value="">-- Select --</option>'+
            '<option value = "MTI DATA CENTER">MTI DATA CENTER</option>'+
            '<option value = "MTI POP">MTI POP</option>'+
            '<option value = "MTI TOWER">MTI TOWER</option>'+
            '<option value = "MTI CLOUD">MTI CLOUD</option>'+
            '<option value = "3rd PARTY DATA CENTER">3rd PARTY DATA CENTER</option>'+
            '<option value = "3RD PARTY POP">3RD PARTY POP</option>'+
            '<option value = "3rd PARTY TOWER">3rd PARTY TOWER</option>'+
            '<option value = "3rd PARTY CLOUD">3rd PARTY CLOUD</option>'+
            '<option value = "CUSTOMER DATA CENTER">CUSTOMER DATA CENTER</option>'+
            '<option value = "CUSTOMER POP">CUSTOMER POP</option>'+
            '<option value = "CUSTOMER TOWER">CUSTOMER TOWER</option>'+
            '<option value = "CUSTOMER CLOUD">CUSTOMER CLOUD</option>'+
            '<option value = "CUSTOMER PREMISE">CUSTOMER PREMISE</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<br/><br/>'+
            '<h4><b>Near End (Moratelindo/Third Party Site)</b></h4>'+
            '<div class="ln_solid"></div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site ID / Building Name'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_site_id'+row+'" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row+'][ne_site_id]" required="required" data-parsley-errors-container="#for_ne_site_id">'+
            '<span id = "for_ne_site_id"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor/Block'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_floor'+row+'" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row+'][ne_floor]" required="required" data-parsley-errors-container="#for_ne_site_id">'+
            '<span id = "for_ne_site_id"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<textarea id="ne_address'+row+'" name="installation['+row+'][ne_address]" class="form-control near" required="required" data-parsley-errors-container="#for_ne_address"></textarea>'+
            '<span id = "for_ne_address"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required ne_star">*</span>'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_city" class="form-control col-md-7 col-xs-12 near city_text" type="hidden" name="installation['+row+'][ne_city]" required="required" data-parsley-errors-container="#for_ne_city">'+
            '<select id="ne_city'+row+'" required="required" class="form-control js-example-tags input near city" data-parsley-errors-container="#for_ne_city" data-parsley-error-message="Please fill city" required="required">'+
            '<option value="">-- Select --</option>'+
            kab +
            '</select>' +
            '<span id = "for_ne_city"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required ne_star">*</span>'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_subdistrict" class="form-control col-md-7 col-xs-12 near district_text" type="hidden" name="installation['+row+'][ne_district]" required="required" data-parsley-errors-container="#for_ne_subdistrict">'+
            '<select id="ne_subdistrict'+row+'" required="required" class="form-control js-example-tags input near district" data-parsley-errors-container="#for_ne_subdistrict" data-parsley-error-message="Please fill district" required="required">'+
            '<option value="">-- Select --</option>'+
            '</select>' +
            '<span id = "for_ne_subdistrict"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required ne_star">*</span>'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            // '<input id="ne_district" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row+'][ne_district]" required="required" data-parsley-errors-container="#for_ne_district">'+
            '<select id="ne_subdistrict'+row+'" required="required" class="form-control js-example-tags input near subdistrict" data-parsley-errors-container="#for_ne_district" data-parsley-error-message="Please fill district" required="required" name="installation['+row+'][ne_subdistrict]">'+
            '<option value="">-- Select --</option>'+
            '</select>' +
            '<span id = "for_ne_district"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required ne_star">*</span>'+
            '</label>'+
            '<div class="col-md-4 col-sm-2 col-xs-12">'+
            '<input id="ne_state" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row+'][ne_state]" required="required" data-parsley-errors-container="#for_ne_state">'+
            '<span id = "for_ne_state"></span>'+
            '</div>'+
            '<label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code <span class="required ne_star">*</span></label>'+
            '<div class="col-md-3 col-sm-2 col-xs-12">'+
            '<input id="ne_zip_code" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row+'][ne_zip_code]" data-parsley-errors-container="#for_ne_zip_code">'+
            '<span id = "for_ne_zip_code"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude <span class="required ne_star">*</span></label>'+
            '<div class="col-md-4 col-sm-2 col-xs-12">'+
            '<input id="ne_longitude" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row+'][ne_longitude]" required="required" data-parsley-errors-container="#for_ne_longitude">'+
            '<span id = "for_ne_longitude"></span>'+
            '</div>'+
            '<label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude <span class="required ne_star">*</span></label>'+
            '<div class="col-md-3 col-sm-2 col-xs-12">'+
            '<input id="ne_latitude" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row+'][ne_latitude]" required="required" data-parsley-errors-container="#for_ne_latitude">'+
            '<span id = "for_ne_latitude"></span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-xs-12 dda">'+
            '<div class="row">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ip_address'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][interconnection_address]" required="required" data-parsley-errors-container="#for_company_name" data-parsley-error-message="Please fill company name">'+
            '<span id = "for_company_name"></span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="row">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Rack ID</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="rack_id'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][rack_id]" required="required" data-parsley-errors-container="#for_company_name" data-parsley-error-message="Please fill company name">'+
            '<span id = "for_company_name"></span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<h4><b>Far End (Customer Site)</b></h4>'+
            '<div class="ln_solid"></div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site ID / Building Name'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_building_name'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][fe_building_name]" data-parsley-errors-container="#for_fe_building">'+
            '<span id = "for_fe_building"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor/Block'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_floor'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][fe_floor]" data-parsley-errors-container="#for_fe_floor">'+
            '<span id = "for_fe_floor"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<textarea id="fe_address" name="installation['+row+'][fe_address]'+row+'" class="form-control" name="installation['+row+'][fe_floor]" data-parsley-errors-container="#for_fe_address"></textarea>'+
            '<span id = "for_fe_address"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">City'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_city'+row+'" class="form-control col-md-7 col-xs-12 city_text" type="hidden" name="installation['+row+'][fe_city]" data-parsley-errors-container="#for_fe_city"> '+
            '<select id="fe_city_select'+row+'" required="required" class="form-control js-example-tags input near city" data-parsley-errors-container="#for_ne_city" data-parsley-error-message="Please fill city" required="required">'+
            '<option value="">-- Select --</option>'+
            kab +
            '</select>' +
            '<span id = "for_fe_city"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">District'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_district'+row+'" class="form-control col-md-7 col-xs-12 input district_text" type="hidden" name="installation['+row+'][fe_district]" data-parsley-errors-container="#for_fe_district">'+
            '<select id="fe_district_select_'+row+'" required="required" class="form-control js-example-tags input near district" data-parsley-errors-container="#for_fe_district" data-parsley-error-message="Please fill city" required="required">'+
            '<option value="">-- Select --</option>'+
            '</select>' +
            '<span id = "for_fe_district"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            // '<input id="fe_subdistrict'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][fe_subdistrict]" data-parsley-errors-container="#for_fe_subdistrict">'+
            '<select id="fe_subdistrict'+row+'" required="required" name="installation['+row+'][fe_subdistrict]" class="form-control js-example-tags input near subdistrict" data-parsley-errors-container="#for_fe_subdistrict" data-parsley-error-message="Please fill city" required="required">'+
            '<option value="">-- Select --</option>'+
            '</select>' +
            '<span id = "for_fe_subdistrict"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">State'+
            '</label>'+
            '<div class="col-md-4 col-sm-2 col-xs-12">'+
            '<input id="fe_state'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][fe_state]" data-parsley-errors-container="#for_fe_state">'+
            '<span id = "for_fe_state"></span>'+
            '</div>'+
            '<label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code'+
            '</label>'+
            '<div class="col-md-3 col-sm-2 col-xs-12">'+
            '<input id="fe_zip_code'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][fe_zip_code]" data-parsley-errors-container="#for_fe_zip_code">'+
            '<span id = "for_fe_zip_code"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">FAT'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<div class="input-group">'+
            '<input type="text" class="form-control" name = "installation['+row+'][olt_booked]" id = "fe_fat_name'+row+'">'+
            '<span class="input-group-btn">'+
            '<button type="button" class="btn btn-primary open_list" row = "'+row+'"><span class="fa fa-list"></span></button>'+
            '<button type="button" class="btn btn-primary open_map" row = "'+row+'"><span class="fa fa-map-marker"></span></button>'+
            '</span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude'+
            '</label>'+
            '<div class="col-md-4 col-sm-2 col-xs-12">'+
            '<input id="fe_longitude'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][fe_longitude]" data-parsley-errors-container="#for_fe_longitude">'+
            '<span id = "for_fe_longitude"></span>'+
            '</div>'+
            '<label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude'+
            '</label>'+
            '<div class="col-md-3 col-sm-2 col-xs-12">'+
            '<input id="fe_latitude'+row+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row+'][fe_latitude]" data-parsley-errors-container="#for_fe_latitude">'+
            '<span id = "for_fe_latitude"></span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>';
          // console.log(rows);
          $('.services').append(rows);

          $(".js-example-tags").select2({
            tags: true
          });

          $('.single_date').daterangepicker({
                  singleDatePicker: true,
                  calender_style: "picker_1",
                  format: 'DD/MM/YYYY',
              }, function (start, end, label) {
                  console.log(start.toISOString(), end.toISOString(), label);
          });

          $('.close-link').click(function(){
            $(this).parent().parent().parent().parent().remove();
          })

          row++;

          $('.product_class').change(function(){
            // console.log(this)
            // var index = $(this).attr('rowidf'),
            //     pdn = '#product_name'+index;

            // $(pdn).val(null).trigger('change');
            // $(pdn).find('option').remove();

            // var opt = product_load($(this).val());
            // $(pdn).append(opt);


            var index = $(this).attr('rowidf'),
              pdn = '#product_name'+index,
              sbc = '#product_subclassification'+index;

            $(pdn).val(null).trigger('change');
            $(pdn).find('option').remove();

            $(sbc).val(null).trigger('change');
            $(sbc).find('option').remove();

            var opt = product_load($(this).val());
            var opt2 = subclass_load($(this).val());
            $(pdn).append(opt);
            $(sbc).append(opt2);
          })

          $('.open_map').click(function(){
              $('#mdmap').modal('show');
              $('#mindex_acc').val($(this).attr('row'));
              // console.log($(this).attr('row'));
              $("#map_frame").attr('src', 'http://sf.apps.moratelindo.co.id/map2.php');
              // $("#map_frame").attr('src', 'http://sf.local.moratelindo.co.id/map.php');

              window.closeModal = function () {
                  $('#mdmap').modal('hide');
                  // window.location.reload();
              };

              // $('#temp_fat_name').change(function(e){
              //   console.log('achieved');
              // })
          });


          $('.open_list').click(function(){
              $('#mdlist').modal('show');
              var e = "";
              // var table = $('#table_example').dataTable();
              // table.destroy();
              // $('#table_example').remove();
              var indexs = $(this).attr('row');

              console.log(indexs);
              
              var table = "";
              table += '<table id="table_example" class="table table-striped table-bordered">';
              table += '<thead>';
              table += '<tr>';
              table += '<th>Cluster</th>';
              table += '<th>FAT Code</th>';
              table += '<th>Longitude</th>';
              table += '<th>Latitude</th>';
              table += '<th>Port Available</th>';
              table += '</tr>';
              table += '</thead>';
              table += '<tbody>';
              table += '</tbody>';
              table += '</table>';

              $("#mdlist .modal-body").append(table);

              var oTable = $('#table_example').dataTable({
                  "bProcessing": true,
                  "bServerSide": true,
                  "sAjaxSource": "/customer/datatable_fat",
                  "aoColumns":[
                    {
                        "mData":"CLUSTER_NAME",
                        "render": function ( mData, type,row, meta ) {
                          return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" row = "'+indexs+'" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                        }
                    },
                    {
                        "mData":"FAT_CODE",
                        "render": function ( mData, type,row, meta ) {
                          return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" row = "'+indexs+'" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                        }
                    },
                    {
                        "mData":"LONGITUDE",
                        "render": function ( mData, type,row, meta ) {
                          return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" row = "'+indexs+'" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                        }
                    },
                    {
                        "mData":"LATITUDE",
                        "render": function ( mData, type,row, meta ) {
                          return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" row = "'+indexs+'" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                        }
                    },
                    {
                        "mData":"PORT_AVAILABLE",
                        "render": function ( mData, type,row, meta ) {
                          return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" row = "'+indexs+'">' + mData+'</a>';                             
                        }
                    }
                  ],
                  /*"columns" : [
                    {"data" : "CLUSTER_NAME"},
                    {"data" : "FAT_CODE"},
                    {"data" : "LONGITUDE"},
                    {"data" : "LATITUDE"},
                  ],*/
                  /*processing : true, 
                  serverSide : true,
                  sAjaxSource : {
                    url : "/customer/datatable_project",
                    type : "POST"
                  },*/
                  "oLanguage": {
                      "sSearch": "Search :"
                  },
                  "aoColumnDefs": [
                      {
                          'bSortable': false,
                          'aTargets': [0]
                      } //disables sorting for column one
                  ],
                  'iDisplayLength': 10,
                  "sPaginationType": "full_numbers",
                  // "dom": 'T<"clear">lfrtip',
                  "tableTools": {
                      "sSwfPath": "<?php echo base_url('assets/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                  },
                  fnDrawCallback: function () {
                    cbtable();
                  }
              });
              $("tfoot input").keyup(function () {
                  /* Filter on the column based on the index of this element's parent <th> */
                  oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
              });
              $("tfoot input").each(function (i) {
                  asInitVals[i] = this.value;
              });
              $("tfoot input").focus(function () {
                  if (this.className == "search_init") {
                      this.className = "";
                      this.value = "";
                  }
              });
              $("tfoot input").blur(function (i) {
                  if (this.value == "") {
                      this.className = "search_init";
                      this.value = asInitVals[$("tfoot input").index(this)];
                  }
              });

              function cbtable(){
                $('.select_fat').click(function(){
                  var t = $(this).attr('cluster');
                  var y = $(this).attr('row');
                  var long = $(this).attr('long');
                  var lat = $(this).attr('latitude');
                  var g = '#fe_fat_name'+y;
                  var h = '#fe_latitude'+y;
                  var i = '#fe_longitude'+y;
                  $(g).val(t);
                  $(h).val(lat);
                  $(i).val(long);
                  $('#mdlist').modal('toggle');
                })
              }
          });

          $('.item_code_list').click(function(){
              // console.log('halo polisi');
              $('#item_list_modal').modal('show');
              var idx = $(this).attr('row');
              var e = "";
              var table = "";
              table += '<table id="table_example2" class="table table-striped table-bordered">';
              table += '<thead>';
              table += '<tr>';
              table += '<th>Item Code</th>';
              table += '<th>Description</th>';
              table += '</tr>';
              table += '</thead>';
              table += '<tbody>';
              table += '</tbody>';
              table += '</table>';

              $("#item_list_modal .modal-body").append(table);

              var oTable = $('#table_example2').dataTable({
                  "bProcessing": true,
                  "bServerSide": true,
                  "sAjaxSource": "/customer/datatable_item_code",
                  "aoColumns":[
                    {
                        "mData":"ITEM_CODE",
                        "render": function ( mData, type,row, meta ) {
                          return '<a class = "select_item" item_code = "' + row.ITEM_CODE + '" desc = "' + row.DESCRIPTION + '" row = "'+idx+'">' + mData+'</a>';                             
                        }
                    },
                    {
                        "mData":"DESCRIPTION",
                        "render": function ( mData, type,row, meta ) {
                          return '<a class = "select_item" item_code = "' + row.ITEM_CODE + '" desc = "' + row.DESCRIPTION + '" row = "'+idx+'">' + mData+'</a>';                             
                        }
                    },
                  ],
                  "oLanguage": {
                      "sSearch": "Search :"
                  },
                  "aoColumnDefs": [
                      {
                          'bSortable': false,
                          'aTargets': [0]
                      } //disables sorting for column one
                  ],
                  'iDisplayLength': 10,
                  "sPaginationType": "full_numbers",
                  // "dom": 'T<"clear">lfrtip',
                  "tableTools": {
                      "sSwfPath": "<?php echo base_url('assets/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                  },
                  fnDrawCallback: function () {
                    cbtable();
                  }
              });
              $("tfoot input").keyup(function () {
                  /* Filter on the column based on the index of this element's parent <th> */
                  oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
              });
              $("tfoot input").each(function (i) {
                  asInitVals[i] = this.value;
              });
              $("tfoot input").focus(function () {
                  if (this.className == "search_init") {
                      this.className = "";
                      this.value = "";
                  }
              });
              $("tfoot input").blur(function (i) {
                  if (this.value == "") {
                      this.className = "search_init";
                      this.value = asInitVals[$("tfoot input").index(this)];
                  }
              });

              function cbtable(){
                $('.select_item').click(function(){
                  var t = $(this).attr('item_code'),
                      u = $(this).attr('desc'),
                      ic = "#itemcode"+$(this).attr('row'),
                      icd = "#itemcode_desc"+$(this).attr('row');
                  // console.log(t);
                  // console.log(u);
                  $(icd).val(u);
                  $(ic).val(t);
                  $('#item_list_modal').modal('toggle');
                })
              }
          })

          $('#item_list_modal').on('hidden.bs.modal', function () {
            var table = $('#table_example2').dataTable();
            table.remove();
            $('#table_example2_wrapper').remove();
            $('#table_example2').remove();
          })

          $('#mdlist').on('hidden.bs.modal', function () {
            var table = $('#table_example').dataTable();
            table.remove();
            $('#table_example_wrapper').remove();
            $('#table_example').remove();
          })

          $('#mdmap').on('hidden.bs.modal', function () {
            var e = $('#map_frame').contents().find('#book_olt');

            var d = e.val();

            $("#olt_booked").val(d);
          })

          $('.possibly_other').change(function(){
            var v = $(this).val();
            var $otherInput = $(this).closest('.parent').find('.other_input');
            if(v == 'OTHERS…'){
              $($otherInput).removeClass('hidden');
              $($otherInput).prop('required',true);
            } else {
              $($otherInput).addClass('hidden');
              $($otherInput).prop('required',false);
            }
          })

          $('.city').change(function(e){
            var isi = $(this).val();
            isi = isi.split('#');
            var $otherInput = $(this).closest('.dda').find('.district');
            var $textInput = $(this).closest('.form-group').find('.city_text');
            $textInput.val(isi[1]);
            var opt = '<option value="">-- Select --</option>';
            $otherInput.find('option').remove();
            console.log($otherInput);
            $.ajax({
              type : 'GET', 
              url : '/customer/kecamatan/'+isi[0],
              async : false, 
              dataType : 'json', 
              success : function(res){
                if(res.status == 200){
                  dt = res.data;
                  $.each(dt, function(i, r){
                    opt += '<option value="'+r.id+'#'+r.name+'">'+r.name+'</option>';
                  })
                }
              }
            });
            $otherInput.append(opt);
          })

          $('.district').change(function(e){
            var isi = $(this).val();
            isi = isi.split('#');
            var $otherInput = $(this).closest('.dda').find('.subdistrict');
            var $textInput = $(this).closest('.form-group').find('.district_text');
            $textInput.val(isi[1]);
            var opt = '<option value="">-- Select --</option>';
            $otherInput.find('option').remove();
            // console.log($otherInput);
            $.ajax({
              type : 'GET', 
              url : '/customer/kelurahan/'+isi[0],
              async : false, 
              dataType : 'json', 
              success : function(res){
                if(res.status == 200){
                  dt = res.data;
                  $.each(dt, function(i, r){
                    opt += '<option value="'+r.name+'">'+r.name+'</option>';
                  })
                }
              }
            });
            $otherInput.append(opt);
          })

            row++;

          })
          
        var row_addr = 1;
        $('#add_row_address').click(function(e){
          var addr = '<div class="row panel_address">'+
            '<div class="x_panel ">'+
            '<div class = "row">'+
            '<div class="col-md-6 col-xs-12">'+
            '<div class="row">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Interconnection Point</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<select id="interconnection'+row_addr+'" name="installation['+row_addr+'][interconnection_point]"  class="form-control js-example-tags input" >'+
            '<option value="">-- Select --</option>'+
            '<option value = "MTI DATA CENTER">MTI DATA CENTER</option>'+
            '<option value = "MTI POP">MTI POP</option>'+
            '<option value = "MTI TOWER">MTI TOWER</option>'+
            '<option value = "MTI CLOUD">MTI CLOUD</option>'+
            '<option value = "3rd PARTY DATA CENTER">3rd PARTY DATA CENTER</option>'+
            '<option value = "3RD PARTY POP">3RD PARTY POP</option>'+
            '<option value = "3rd PARTY TOWER">3rd PARTY TOWER</option>'+
            '<option value = "3rd PARTY CLOUD">3rd PARTY CLOUD</option>'+
            '<option value = "CUSTOMER DATA CENTER">CUSTOMER DATA CENTER</option>'+
            '<option value = "CUSTOMER POP">CUSTOMER POP</option>'+
            '<option value = "CUSTOMER TOWER">CUSTOMER TOWER</option>'+
            '<option value = "CUSTOMER CLOUD">CUSTOMER CLOUD</option>'+
            '<option value = "CUSTOMER PREMISE">CUSTOMER PREMISE</option>'+
            '</select>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<h4><b>Installation Site (Near End)</b></h4>'+
            '<div class="ln_solid"></div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site ID / Building Name'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_site_id'+row_addr+'" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_site_id]" required="'+'required" data-parsley-errors-container="#for_ne_site_id">'+
            '<span id = "for_ne_site_id"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor/Block'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_floor'+row_addr+'" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_floor]" required="required" data-parsley-errors-container="#for_ne_site_id">'+
            '<span id = "for_ne_site_id"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<textarea id="ne_address'+row_addr+'" name="installation['+row_addr+'][ne_address]" class="form-control near" required="required" '+'data-parsley-errors-container="#for_ne_address"></textarea>'+
            '<span id = "for_ne_address"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_subdistrict" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_subdistrict]" required="required" data-parsley-errors-container="#for_ne_subdistrict">'+
            '<span id = "for_ne_subdistrict"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">District '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_district" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_district]" required="'+'required" data-parsley-errors-container="#for_ne_district">'+
            '<span id = "for_ne_district"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">City '+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ne_city" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_city]" required="required" '+'data-parsley-errors-container="#for_ne_city">'+
            '<span id = "for_ne_city"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">State '+
            '</label>'+
            '<div class="col-md-4 col-sm-2 col-xs-12">'+
            '<input id="ne_state" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_state]" required="required"'+ 'data-parsley-errors-container="#for_ne_state">'+
            '<span id = "for_ne_state"></span>'+
            '</div>'+
            '<label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code </label>'+
            '<div class="col-md-3 col-sm-2 col-xs-12">'+
            '<input id="ne_zip_code" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_zip_code]" data-parsley-errors-container="#for_ne_zip_code">'+
            '<span id = "for_ne_zip_code"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude </label>'+
            '<div class="col-md-4 col-sm-2 col-xs-12">'+
            '<input id="ne_longitude" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_longitude]" required="'+'required" data-parsley-errors-container="#for_ne_longitude">'+
            '<span id = "for_ne_longitude"></span>'+
            '</div>'+
            '<label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude </label>'+
            '<div class="col-md-3 col-sm-2 col-xs-12">'+
            '<input id="ne_latitude" class="form-control col-md-7 col-xs-12 near" type="text" name="installation['+row_addr+'][ne_latitude]" required="'+'required" data-parsley-errors-container="#for_ne_latitude">'+
            '<span id = "for_ne_latitude"></span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6 col-xs-12">'+
            '<div class="row">'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="ip_address'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][interconnection_address]" '+'required="required" data-parsley-errors-container="#for_company_name" data-parsley-error-message="Please fill company name">'+
            '<span id = "for_company_name"></span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<h4><b>Far End (Customer Site)</b></h4>'+
            '<div class="ln_solid"></div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site ID / Building Name'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_building_name'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_building_name]" '+'data-parsley-errors-container="#for_fe_building">'+
            '<span id = "for_fe_building"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor/Block'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_floor'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_floor]" '+'data-parsley-errors-container="#for_fe_floor">'+
            '<span id = "for_fe_floor"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<textarea id="fe_address" name="installation['+row_addr+'][fe_address]'+row_addr+'" class="form-control" name="installation['+row_addr+'][fe_floor]" '+'data-parsley-errors-container="#for_fe_address"></textarea>'+
            '<span id = "for_fe_address"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_subdistrict'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_subdistrict]" '+'data-parsley-errors-container="#for_fe_subdistrict">'+
            '<span id = "for_fe_subdistrict"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">District'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_district'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_district]" '+'data-parsley-errors-container="#for_fe_district">'+
            '<span id = "for_fe_district"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">City'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<input id="fe_city'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_city]" '+'data-parsley-errors-container="#for_fe_city"> '+
            '<span id = "for_fe_city"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">State'+
            '</label>'+
            '<div class="col-md-4 col-sm-2 col-xs-12">'+
            '<input id="fe_state'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_state]" '+'data-parsley-errors-container="#for_fe_state">'+
            '<span id = "for_fe_state"></span>'+
            '</div>'+
            '<label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code'+
            '</label>'+
            '<div class="col-md-3 col-sm-2 col-xs-12">'+
            '<input id="fe_zip_code'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_zip_code]" '+'data-parsley-errors-container="#for_fe_zip_code">'+
            '<span id = "for_fe_zip_code"></span>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">FAT'+
            '</label>'+
            '<div class="col-md-9 col-sm-6 col-xs-12">'+
            '<div class="input-group">'+
            '<input type="text" class="form-control" name = "installation['+row_addr+'][olt_booked]" id = "fe_fat_name">'+
            '<span class="input-group-btn">'+
            '<button type="button" class="btn btn-primary open_map"><span class="fa fa-map-marker"></span></button>'+
            '</span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude'+
            '</label>'+
            '<div class="col-md-4 col-sm-2 col-xs-12">'+
            '<input id="fe_longitude'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_longitude]" '+'data-parsley-errors-container="#for_fe_longitude">'+
            '<span id = "for_fe_longitude"></span>'+
            '</div>'+
            '<label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude'+
            '</label>'+
            '<div class="col-md-3 col-sm-2 col-xs-12">'+
            '<input id="fe_latitude'+row_addr+'" class="form-control col-md-7 col-xs-12 input" type="text" name="installation['+row_addr+'][fe_latitude]" '+'data-parsley-errors-container="#for_fe_latitude">'+
            '<span id = "for_fe_latitude"></span>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>';
          row_addr ++;
          $('.addresses').append(addr);
        })

        $('input[name="subservice[18][id]"]').change(function(){
          var ischecked= $(this).is(':checked');
          nearEnd(ischecked);
        })

        $('input[name="service_group[]"]').change(function(){
          var g = $(this).val();

          if(g == 5){
            var ischecked= $(this).is(':checked');

            if(!ischecked){
              nearEnd(ischecked);
            }
          }
          
        })
        $('.ne_star').hide();
        function nearEnd(check){
          $(".near").removeClass('input');
          $(".ne_star").hide();
          if(check){
              $(".near").addClass('input');
              $(".ne_star").show();
          } else {
              $(".near").removeClass('input');
              $(".ne_star").hide();
          }
        }
        $('.sg').change(function(){
          var ischecked= $(this).is(':checked');
          var grup = ".group_"+$(this).attr('value');
          var kapasitas = ".kapasitas_"+$(this).attr('value');
          if(!ischecked){
            $(grup).prop('checked', false);
            $(kapasitas).value('');

          }
        })
        $('.type_service').click(function(){
          $('#mdtest').modal('show');
          $('.service_table').addClass('hidden');
          var sgId = $(this).attr('sg_id');
          var tab = "#sg-"+sgId;
          
          $(tab).removeClass('hidden');

          var $chbox = $(this).parent().find('input[type="checkbox"]');
          $chbox.prop('checked', false);
          var sgId = $(this).attr('sg_id');
        })

        $('.open_map').click(function(){
            $('#mdmap').modal('show');

            // $("#map_frame").attr('src', 'http://sf.apps.moratelindo.co.id/map.php');
            $("#map_frame").attr('src', 'http://sf.apps.moratelindo.co.id/map2.php');
            $('#mindex_acc').val($(this).attr('row'))
            // console.log($(this).attr('mindex'));

            window.closeModal = function () {
                $('#mdmap').modal('hide');
                // window.location.reload();
            };

            // $('#temp_fat_name').change(function(e){
            //   console.log('achieved');
            // })

            $("#temp_fat_name").on("input", function(){
                console.log($(this).val())
                // Print entered value in a div box
              // $("#result").text($(this).val());
             });
        });

        // $("#temp_fat_name").on("input", function(){
        //     console.log($(this).val())
        //     // Print entered value in a div box
        //   // $("#result").text($(this).val());
        //  });

        $('.open_list').click(function(){
            $('#mdlist').modal('show');
            var e = "";
            var table = "";
            table += '<table id="table_example" class="table table-striped table-bordered">';
            table += '<thead>';
            table += '<tr>';
            table += '<th>Cluster Name</th>';
            table += '<th>FAT Code</th>';
            table += '<th>Longitude</th>';
            table += '<th>Latitude</th>';
            table += '<th>Port Available</th>';
            table += '</tr>';
            table += '</thead>';
            table += '<tbody>';
            table += '</tbody>';
            table += '</table>';

            $("#mdlist .modal-body").append(table);

            var oTable = $('#table_example').dataTable({
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "/customer/datatable_fat",
                "aoColumns":[
                  {
                      "mData":"CLUSTER_NAME",
                      "render": function ( mData, type,row, meta ) {
                        return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                      }
                  },
                  {
                      "mData":"FAT_CODE",
                      "render": function ( mData, type,row, meta ) {
                        return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                      }
                  },
                  {
                      "mData":"LONGITUDE",
                      "render": function ( mData, type,row, meta ) {
                        return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                      }
                  },
                  {
                      "mData":"LATITUDE",
                      "render": function ( mData, type,row, meta ) {
                        return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                      }
                  },
                  {
                      "mData":"PORT_AVAILABLE",
                      "render": function ( mData, type,row, meta ) {
                        return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '" long = "'+row.LONGITUDE+'" latitude = "'+row.LATITUDE+'">' + mData+'</a>';                             
                      }
                  }
                ],
                "oLanguage": {
                    "sSearch": "Search :"
                },
                "aoColumnDefs": [
                    {
                        'bSortable': false,
                        'aTargets': [0]
                    } //disables sorting for column one
                ],
                'iDisplayLength': 10,
                "sPaginationType": "full_numbers",
                // "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url('assets/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                },
                fnDrawCallback: function () {
                  cbtable();
                }
            });
            $("tfoot input").keyup(function () {
                /* Filter on the column based on the index of this element's parent <th> */
                oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
            });
            $("tfoot input").each(function (i) {
                asInitVals[i] = this.value;
            });
            $("tfoot input").focus(function () {
                if (this.className == "search_init") {
                    this.className = "";
                    this.value = "";
                }
            });
            $("tfoot input").blur(function (i) {
                if (this.value == "") {
                    this.className = "search_init";
                    this.value = asInitVals[$("tfoot input").index(this)];
                }
            });

            function cbtable(){
              $('.select_fat').click(function(){
                var t = $(this).attr('cluster');
                var long = $(this).attr('long');
                var lat = $(this).attr('latitude');

                $("#fe_fat_name0").val(t);
                $("#fe_latitude0").val(lat);
                $("#fe_longitude0").val(long);
                $('#mdlist').modal('toggle');
              })
            }
        });

        $('#mdlist').on('hidden.bs.modal', function () {
          var table = $('#table_example').dataTable();
          table.remove();
          $('#table_example_wrapper').remove();
          $('#table_example').remove();
        })

        $('#mdmap').on('hidden.bs.modal', function () {
          var e = $('#map_frame').contents().find('#book_olt');

          var d = e.val();

          $("#olt_booked").val(d);
        })

        var source = $("#source").val();

        if(source == 'oracle'){
          var fc = $('#fcustomer_id').val();
          $.ajax({
            type : 'POST', 
            url : '/customer/orc_detail',
            data : {party_id : fc},
            async : false, 
            dataType : 'json', 
            success : function(res){
              var dt = res.data;
              $('#customer_id').val(fc);

              $('#customer_type').val('Corporate');

              if(res.data.PARTY_TYPE == 'ORGANIZATION'){
                $('#corporate').show();
                $('#personal').hide();
                $(".person").removeClass('input');
                $(".company").removeClass('input');
                $(".company").addClass('input');
              } else {
                $('#corporate').hide();
                $('#personal').show();
                $(".person").removeClass('input');
                $(".company").removeClass('input');
                $(".person").addClass('input');
              }

              $('#company_name').val(dt.PARTY_NAME);
              /*$('#c_building_name_c').val(dt.ADDRESS1);
              $('#building_name_b_c').val(dt.ADDRESS1);*/
              $('#c_address_c').val(dt.ADDRESS1);
              $('#address_b_c').val(dt.ADDRESS1);
              $('#address_c').val(dt.ADDRESS1);
              $('#address_b').val(dt.ADDRESS1);
              // building_name_b_c
              // $('#city_c_c').select2(dt.CITY);
              // $("#city_c_c").val(dt.CITY).trigger("change");
              $('#state_c_c').val(dt.COUNTY);
              $('#zip_code_c_c').val(dt.POSTAL_CODE);
            }
          })
        }

        $('.item_code_list').click(function(){
              // console.log('halo polisi');
            $('#item_list_modal').modal('show');
            var e = "";
            var table = "";
            table += '<table id="table_example2" class="table table-striped table-bordered">';
            table += '<thead>';
            table += '<tr>';
            table += '<th>Item Code</th>';
            table += '<th>Description</th>';
            table += '</tr>';
            table += '</thead>';
            table += '<tbody>';
            table += '</tbody>';
            table += '</table>';

            $("#item_list_modal .modal-body").append(table);

            var oTable = $('#table_example2').dataTable({
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "/customer/datatable_item_code",
                "aoColumns":[
                  {
                      "mData":"ITEM_CODE",
                      "render": function ( mData, type,row, meta ) {
                        return '<a class = "select_item" item_code = "' + row.ITEM_CODE + '" desc = "' + row.DESCRIPTION + '">' + mData+'</a>';                             
                      }
                  },
                  {
                      "mData":"DESCRIPTION",
                      "render": function ( mData, type,row, meta ) {
                        return '<a class = "select_item" item_code = "' + row.ITEM_CODE + '" desc = "' + row.DESCRIPTION + '">' + mData+'</a>';                             
                      }
                  },
                ],
                "oLanguage": {
                    "sSearch": "Search :"
                },
                "aoColumnDefs": [
                    {
                        'bSortable': false,
                        'aTargets': [0]
                    } //disables sorting for column one
                ],
                'iDisplayLength': 10,
                "sPaginationType": "full_numbers",
                // "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo base_url('assets/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                },
                fnDrawCallback: function () {
                  cbtable();
                }
            });
            $("tfoot input").keyup(function () {
                /* Filter on the column based on the index of this element's parent <th> */
                oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
            });
            $("tfoot input").each(function (i) {
                asInitVals[i] = this.value;
            });
            $("tfoot input").focus(function () {
                if (this.className == "search_init") {
                    this.className = "";
                    this.value = "";
                }
            });
            $("tfoot input").blur(function (i) {
                if (this.value == "") {
                    this.className = "search_init";
                    this.value = asInitVals[$("tfoot input").index(this)];
                }
            });

            function cbtable(){
              $('.select_item').click(function(){
                var t = $(this).attr('item_code'),
                    u = $(this).attr('desc');
                // console.log(t);
                // console.log(u);
                $("#itemcode_desc0").val(u);
                $("#itemcode0").val(t);
                $('#item_list_modal').modal('toggle');
              })
            }
        })

        $('#item_list_modal').on('hidden.bs.modal', function () {
          var table = $('#table_example2').dataTable();
          table.remove();
          $('#table_example2_wrapper').remove();
          $('#table_example2').remove();
        })

        var source = $("#source").val();

        if(source == 'presales'){
          var fc = $('#customer_presales_id').val();
          $.ajax({
            type : 'POST', 
            url : '/customer/customer_presales',
            data : {customer_id : fc},
            async : false, 
            dataType : 'json', 
            success : function(res){
              /*var dt = res.data;
              $('#customer_id').val(fc);

              $('#customer_type').val('Corporate');

              if(res.data.PARTY_TYPE == 'ORGANIZATION'){
                $('#corporate').show();
                $('#personal').hide();
                $(".person").removeClass('input');
                $(".company").removeClass('input');
                $(".company").addClass('input');
              } else {
                $('#corporate').hide();
                $('#personal').show();
                $(".person").removeClass('input');
                $(".company").removeClass('input');
                $(".person").addClass('input');
              }*/

              // $('#company_name').val(dt.PARTY_NAME);
              // /*$('#c_building_name_c').val(dt.ADDRESS1);
              // $('#building_name_b_c').val(dt.ADDRESS1);*/
              // $('#c_address_c').val(dt.ADDRESS1);
              // $('#address_b_c').val(dt.ADDRESS1);
              // $('#address_c').val(dt.ADDRESS1);
              // $('#address_b').val(dt.ADDRESS1);
              // // building_name_b_c
              // // $('#city_c_c').select2(dt.CITY);
              // // $("#city_c_c").val(dt.CITY).trigger("change");
              // $('#state_c_c').val(dt.COUNTY);
              // $('#zip_code_c_c').val(dt.POSTAL_CODE);
              if(res.status == 200){
                dt = res.data;
                $('#company_name').val(dt.NAME_CUSTOMER);
                $('#c_address_c').val(dt.ALAMAT_INSTALASI1);
                $('#address_b_c').val(dt.ALAMAT_INSTALASI1);
              }
            }
          })
        }
    })

    
</script>
