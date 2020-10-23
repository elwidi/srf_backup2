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

                  <form id = "srf_form" method = "POST" action="<?php echo base_url().'customer/srf/1'?>">

                
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
                        <li>
                          <a href="#step-6">
                            <span class="step_no">6</span>
                            <span class="step_descr">Installation Information</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-7">
                            <span class="step_no">7</span>
                            <span class="step_descr">Detail of Service</span>
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
                                  <input type="hidden" name = "source" id = "source" value = "<?php echo $source ?>">
                                  <input type="text" id="input_date" name = "input_date" required="required" class="form-control col-md-7 col-xs-12 input" value = "<?php echo date('d/m/Y')?>" c>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">SRF Number
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="srf_number" name="srf_number" value = "<?php echo $srf_number?>" required="required" class="form-control col-md-7 col-xs-12 input" readonly = "true">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">PO Reference Number <span class="required" >*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="po_number" name="po_number" required="required" class="form-control js-example-tags input" data-parsley-errors-container="#for_po_number" data-parsley-error-message="Please select PO Number">
                                    <option value="">-- Select --</option>
                                    <?php foreach ($po as $key => $value) { ?>
                                      <option value="<?php echo $value->PO_NUMBER?>"><?php echo $value->PO_NUMBER." - ". $value->COMMENTS?></option>
                                    <? } ?>
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
                                    <?php foreach ($bp as $key => $value) { ?>
                                      <option value="<?php echo $value->BP_NO?>"><?php echo $value->BP_NO." - ". $value->TITLE?></option>
                                    <? } ?>
                                  </select>
                                  <span id = "for_bp_number"></span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Customer ID</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="customer_id" class="form-control col-md-7 col-xs-12" type="text" name="customer_id">
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
                                    <input type="text" id="user_id" name="user_id" required="required" class="form-control col-md-7 col-xs-12 input">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="user_name" name="user_name" required="required" class="form-control col-md-7 col-xs-12 input">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="user_position" class="form-control col-md-7 col-xs-12 input" type="text" name="user_position">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Department</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="user_department" class="form-control col-md-7 col-xs-12 input" type="text" name="user_department">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile Phone</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="user_mobile" class="form-control col-md-7 col-xs-12 input" type="text" name="user_mobile">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="user_email" class="form-control col-md-7 col-xs-12 input" type="text" name="user_email">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div id="step-3">
                        <div class="form-horizontal form-label-left form-step-3">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Customer Classification <span class="required">*</span> 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="customer_classification" name="customer_classification" class="form-control js-example-tags input" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_classification">
                                    <option value="">-- Select --</option>
                                    <option value="VVIP">VVIP</option>
                                    <option value="Platinum">Platinum</option>
                                    <option value="Gold">Gold</option>
                                    <option value="Silver">Silver</option>
                                    <option value="Bronze">Bronze</option>
                                </select>
                                <span id = "for_customer_classification"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Customer Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="customer_status" required name="customer_status" class="form-control js-example-tags input" data-parsley-errors-container="#for_customer_status" data-parsley-error-message="Please select a status">
                                    <option value="">-- Select --</option>
                                    <option value="Existing Customer" selected="">Existing Customer</option>
                                    <option value="New Customer">New Customer</option>
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
                                <option value="Personal">Personal</option>
                                <option value="Corporate">Corporate</option>
                              </select>
                              <span id = "for_customer_type"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Number of Node</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="number_of_node" name="number_of_node" class="form-control js-example-tags input">
                                    <option value="">-- Select --</option>
                                    <option value="Single Node">Single Node</option>
                                    <option value="Multi Node">Multi Node</option>
                                </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Scale of Customer User <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="scale" name="scale" required="required" class="form-control js-example-tags input" data-parsley-errors-container="#for_scale" data-parsley-error-message="Please select a scale">
                                    <option value="">-- Select --</option>
                                    <option value="< 5 person">< 5 person</option>
                                    <option value="6-20 person">6-20 person</option>
                                    <option value="21-100 person">21-100 person</option>
                                    <option value="> 100 person">> 100 person</option>
                                </select>
                                <span id = "for_scale"></span>
                            </div>
                          </div>
                          <div class="form-group"> 
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Coverage Status <span class="required">*</span>

                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <label class="control-label">
                                    <input type="radio" class = "flat input" value="in Coverage" id = "coverage_status" required="required" name="coverage_status" data-parsley-errors-container="#for_coverage_status"> in Coverage &nbsp; &nbsp; &nbsp; 
                                    <input type="radio" class = "flat" value="out of Coverage" name="coverage_status"> out of Coverage
                                </label>
                                <span id = "for_coverage_status"></span>
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
                                            <input id="company_name" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[name]" required="required" data-parsley-errors-container="#for_company_name" data-parsley-error-message="Please fill company name">
                                            <span id = "for_company_name"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Organization Level <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <select id="organization_level" name="company[organization_level]" required="required" class="form-control js-example-tags input company" data-parsley-errors-container="#for_organization_level" data-parsley-error-message="Please select a organization level">
                                                <option value="">-- Select --</option>
                                                <option value="Head Office">Head Office</option>
                                                <option value="Branch Office">Branch Office</option>
                                            </select>
                                            <span id = "for_organization_level"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Building Name</label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="building_name" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[building_name]">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <textarea id="company_address" name="company[address]" class="form-control input company" required="required" data-parsley-errors-container="#for_company_address" data-parsley-error-message="Please fill company address"></textarea>
                                            <span id = "for_company_address"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="company_subdistrict" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[subdistrict]" required="required" data-parsley-errors-container="#for_company_subdistrict" data-parsley-error-message="Please fill subdistrict">
                                            <span id = "for_company_subdistrict"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <input id="company_district" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[district]" required="required" data-parsley-errors-container="#for_company_district" data-parsley-error-message="Please fill district">
                                            <span id = "for_company_district"></span>
                                        </div>
                                    </div>
                                    
                                </div>
                              </div>

                              <div class="col-md-6 col-xs-12">
                                <div class="row">
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span></label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="company_city" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[city]" required="required" data-parsley-errors-container="#for_company_city" data-parsley-error-message="Please fill city">
                                          <span id = "for_company_city"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span></label>
                                      <div class="col-md-4 col-sm-2 col-xs-12">
                                          <input id="company_state" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[state]" required="required" data-parsley-errors-container="#for_company_state" data-parsley-error-message="Please fill state">
                                          <span id = "for_company_state"></span>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code <span class="required">*</span></label>
                                      <div class="col-md-3 col-sm-2 col-xs-12">
                                          <input id="company_zip_code" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[zip_code]" required="required" data-parsley-errors-container="#for_company_zip_code" data-parsley-error-message="Please fill zip_code">
                                          <span id = "for_company_zip_code"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP</label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="company_npwp" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[npwp]">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">SIUP</label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="company_siup" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[siup]">
                                      </div>
                                  </div>

                                  <div class="form-group">
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
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Phone <span class="required">*</span></label>
                                      <div class="col-md-9 col-sm-6 col-xs-12">
                                          <input id="company_phone" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[phones]" required="required" data-parsley-errors-container="#for_phone">
                                          <span id = "for_phone"></span>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax</label>
                                      <div class="col-md-3 col-sm-2 col-xs-12">
                                          <input id="company_fax" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[fax]">
                                      </div>
                                      <label class="control-label col-md-3 col-sm-2 col-xs-6">Web</label>
                                      <div class="col-md-3 col-sm-2 col-xs-12">
                                          <input id="company_web" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[web]">
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br/>

                            <div class = "row">
                              <div class="col-md-6 col-xs-12">
                                <h4><b>Commercial Contact Person</b></h4>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_commercial_name" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_name]" required="required" data-parsley-errors-container="#for_commercial_name">
                                        <span id = "for_commercial_name"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_commercial_email" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_email]" required="required" data-parsley-errors-container="#for_commercial_email">
                                        <span id = "for_commercial_email"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Job Function & Department <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_commercial_job" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_job]" required="required" data-parsley-errors-container="#for_commercial_job">
                                        <span id = "for_commercial_job"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Phone <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_commercial_phone" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_phone]" required="required" data-parsley-errors-container="#for_commercial_phone">
                                        <span id = "for_commercial_phone"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ext <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-2 col-xs-12">
                                        <input id="company_commercial_ext" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_ext]" required="required" data-parsley-errors-container="#for_commercial_ext">
                                        <span id = "for_commercial_ext"></span>

                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-6">Hp <span class="required">*</span></label>
                                    <div class="col-md-3 col-sm-2 col-xs-12">
                                        <input id="company_commercial_hp" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[commercial_hp]" required="required" data-parsley-errors-container="#for_commercial_hp">
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
                                        <input id="company_technical_name" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_name]" required="required" data-parsley-errors-container="#for_technical_name">
                                        <span id = "for_technical_name"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_technical_email" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_email]" required="required" data-parsley-errors-container="#for_technical_email">
                                        <span id = "for_technical_email"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Job Function & Department <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_technical_job" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_job]" required="required" data-parsley-errors-container="#for_technical_job">
                                        <span id = "for_technical_job"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Phone <span class="required">*</span></label>
                                    <div class="col-md-9 col-sm-6 col-xs-12">
                                        <input id="company_technical_phone" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_phone]" required="required" data-parsley-errors-container="#for_technical_phone">
                                        <span id = "for_technical_phone"></span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ext <span class="required">*</span></label>
                                    <div class="col-md-3 col-sm-2 col-xs-12">
                                        <input id="company_technical_ext" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_ext]" required="required" data-parsley-errors-container="#for_technical_ext">
                                        <span id = "for_technical_ext"></span>

                                    </div>
                                    <label class="control-label col-md-2 col-sm-2 col-xs-6">Hp <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-2 col-xs-12">
                                        <input id="company_technical_hp" class="form-control col-md-7 col-xs-12 input company" type="text" name="company[technical_hp]" required="required" data-parsley-errors-container="#for_technical_hp">
                                        <span id = "for_technical_hp"></span>

                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id = "personal">
                            <h4><b>Personal Customer Information</b></h4>
                            <div class="ln_solid"></div>
                            <div class="col-md-6 col-xs-12">
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_name" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[name]" required="required" data-parsley-errors-container="#for_personal_name">
                                      <span id = "for_personal_name"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Birthday <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_birthday" class="form-control col-md-7 col-xs-12 input person single_date" type="text" name="personal[birthday]" required="required" data-parsley-errors-container="#for_personal_birthday">
                                      <span id = "for_personal_birthday"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <textarea id="personal_address" name="personal[address]" class="form-control input person" required="required" data-parsley-errors-container="#for_personal_address" data-parsley-error-message="Please fill personal address"></textarea>
                                      <span id = "for_personal_address"></span>
                                  </div>
                              </div>

                              <!--mark!-->
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_subdistrict" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[subdistrict]" required="required" data-parsley-errors-container="#for_personal_subdistrict" data-parsley-error-message="Please fill subdistrict">
                                      <span id = "for_personal_subdistrict"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_district" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[district]" required="required" data-parsley-errors-container="#for_personal_district" data-parsley-error-message="Please fill district">
                                      <span id = "for_personal_district"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_city" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[city]" required="required" data-parsley-errors-container="#for_personal_city" data-parsley-error-message="Please fill city">
                                      <span id = "for_personal_city"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span></label>
                                  <div class="col-md-4 col-sm-2 col-xs-12">
                                      <input id="personal_state" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[state]" required="required" data-parsley-errors-container="#for_personal_state" data-parsley-error-message="Please fill state">
                                      <span id = "for_personal_state"></span>
                                  </div>
                                  <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code <span class="required">*</span></label>
                                  <div class="col-md-3 col-sm-2 col-xs-12">
                                      <input id="personal_zip_code" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[zip_code]" required="required" data-parsley-errors-container="#for_personal_zip_code" data-parsley-error-message="Please fill zip code">
                                      <span id = "for_personal_zip_code"></span>
                                  </div>
                              </div>

                            </div>

                            <div class="col-md-6 col-xs-12">
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <label class="control-label">
                                          <input type="radio" id = "gender" class = "flat input person" value="F" name="personal[gender]" required="required" data-parsley-errors-container="#for_gender"> Female &nbsp; &nbsp; &nbsp; 
                                          <input type="radio" class = "flat" value="M" name="personal[gender]"> Male
                                      </label>
                                      <span id = "for_gender"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nationality <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_nationality" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[nationality]" required="required" data-parsley-errors-container="#for_personal_nationality">
                                      <span id = "for_personal_nationality"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Personal ID <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_personid" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[personid]" required="required" data-parsley-errors-container="#for_personal_personid" data-parsley-error-message="Please fill personid">
                                      <span id = "for_personal_personid"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_npwp" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[npwp]" required="required" data-parsley-errors-container="#for_personal_npwp" data-parsley-error-message="Please fill npwp">
                                      <span id = "for_personal_npwp"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone </label>
                                  <div class="col-md-4 col-sm-2 col-xs-12">
                                      <input id="personal_phone" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[phone]">
                                  </div>
                                  <label class="control-label col-md-1 col-sm-2 col-xs-6">Mobile <span class="required">*</span></label>
                                  <div class="col-md-4 col-sm-2 col-xs-12">
                                      <input id="personal_mobile" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[mobile]" required="required" data-parsley-errors-container="#for_personal_mobile" data-parsley-error-message="Please fill mobile">
                                      <span id = "for_personal_mobile"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Profession <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <select id="personal_proffesion" name="personal[profession]" required="required" class="form-control js-example-tags input person" data-parsley-errors-container="#for_personal_proffesion">
                                          <option value="">-- Select --</option>
                                          <option value="Employee">Employee</option>
                                          <option value="Enterpreneur">Enterpreneur</option>
                                          <option value="Student">Student</option>
                                      </select>
                                      <span id = "for_personal_proffesion"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Building <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <select id="personal_bulding" name="personal[bulding]" required="required" class="form-control js-example-tags input person" data-parsley-errors-container="#for_personal_bulding">
                                          <option value="">-- Select --</option>
                                          <option value="Appartment">Appartment</option>
                                          <option value="Home">Home</option>
                                          <option value="Home Office">Home Office</option>
                                      </select>
                                      <span id = "for_personal_bulding"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Number of Floor <span class="required">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="personal_number_floor" class="form-control col-md-7 col-xs-12 input person" type="text" name="personal[number_floor]" required="required" data-parsley-errors-container="#for_personal_number_floor">
                                      <span id = "for_personal_number_floor"></span>
                                  </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div id="step-5">
                        <div class="form-horizontal form-label-left form-step-5">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Order <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="order_type" name="order_type" class="form-control js-example-tags input" required="required" data-parsley-errors-container="#for_order_type">
                                        <option value="">-- Select --</option>
                                        <option value="New">New</option>
                                        <option value="Upgrade">Upgrade</option>
                                        <option value="Downgrade">Downgrade</option>
                                        <option value="Relocation">Relocation</option>
                                        <option value="Dismantle">Dismantle</option>
                                    </select>
                                    <span id = "for_order_type"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Service Purpose <span class="required">*</span>
                                </label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <select id="service_purpose" name="service_purpose" class="form-control js-example-tags input" required="required" data-parsley-errors-container="#for_service_purpose">
                                        <option value="">-- Select --</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Temporary">Temporary</option>
                                    </select>
                                    <span id = "for_service_purpose"></span>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 temporary-service">
                                    <select id="temporary_service" name="temporary_service" class="form-control js-example-tags input">
                                        <option value="">-- Select --</option>
                                        <option value="BoD">BoD</option>
                                        <option value="PoC/Trial">PoC/Trial</option>
                                        <option value="Event">Event</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Service Status <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <label class="control-label">
                                        <input type="radio" id = "status_service" class = "flat input" value="Main Service" name="service_status" required="required" data-parsley-errors-container="#for_service_status"> Main Service &nbsp; &nbsp; &nbsp; 
                                        <input type="radio" class = "flat" value="Backup Service" name="service_status"> Backup Service
                                    </label>
                                    <span id = "for_service_status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Service <span class="required">*</span></label>

                                <?php foreach ($service_group as $key => $group) {?>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <?php foreach ($group as $idx => $sg) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id = "type_of_service" class = "sg group input" value="<?php echo $sg->id?>" name = "service_group[]" required>
                                                    <a class = "type_service" sg_id = "<?php echo $sg->id?>"><?php echo $sg->group_name ?></a>
                                                </label>
                                            </div>
                                        <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Service Owner <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                      <label class="control-label">
                                          <input type="radio" class = "flat" value="Moratelindo" name="service_owner" required="required" data-parsley-errors-container="#for_service_owner"> Moratelindo &nbsp; &nbsp; &nbsp; 
                                          <input type="radio" class = "flat" value="Partner" name="service_owner"> Partner
                                      </label>
                                      <span id = "for_service_owner"></span>
                                </div>
                                <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                                    <input type="radio" class = "flat" value="Moratelindo" name="service_owner"> Moratelindo <br/>
                                    <input type="radio" class = "flat" value="Partner" name="service_owner"> Partner <br/>
                                </div> -->
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Protocol Technology</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="protocol_technology" name="protocol_technology" class="form-control js-example-tags input">
                                        <option value="">-- Select --</option>
                                        <option value="SDH">SDH</option>
                                        <option value="EoSDH">EoSDH</option>
                                        <option value="Ethernet">Ethernet</option>
                                        <option value="IP">IP</option>
                                        <option value="Core">Core</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Connection Method</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="connection_method" name="connection_method" class="form-control js-example-tags input">
                                        <option value="">-- Select --</option>
                                        <option value="VLAN">VLAN</option>
                                        <option value="VPN">VPN</option>
                                        <option value="PPoE">PPoE</option>
                                        <option value="Trunk">Trunk</option>
                                        <option value="MPLS">MPLS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Media Delivery <span class="required">*</span>
                                </label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <select id="media_delivery" name="media_delivery" class="form-control js-example-tags input" required="required" data-parsley-errors-container="#for_media_delivery">
                                        <option value="">-- Select --</option>
                                        <option value="Radio">Radio</option>
                                        <option value="VSAT">VSAT</option>
                                        <option value="FO">FO</option>
                                    </select>
                                    <span id = "for_media_delivery"></span>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 media-fo">
                                    <select id="media_delivery_fo" name="media_delivery_fo" class="form-control js-example-tags input">
                                        <option value="">-- Select --</option>
                                        <option value="GPON">GPON</option>
                                        <option value="Non-GPON">Non-GPON</option>
                                        <option value="DWDM">DWDM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Interface Connection</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="interface_connection" name="interface_connection" class="form-control js-example-tags input">
                                        <option value="">-- Select --</option>
                                        <option value="UTP">UTP</option>
                                        <option value="Optical">Optical</option>
                                        <option value="E1">E1</option>
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">RFS Date <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="rfs_date" class="form-control col-md-7 col-xs-12 input single_date" type="text" name="rfs_date" required="required" data-parsley-errors-container="#for_rfs_date">
                                    <span id = "for_rfs_date"></span>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">End of Temporary Service <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="end_temp_service" class="form-control col-md-7 col-xs-12 input single_date" type="text" name="end_temp_service" required="required" data-parsley-errors-container="#for_temporary_service">
                                    <span id = "for_temporary_service"></span>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div id="step-6">
                        <div class="form-horizontal form-label-left form-step-6">
                            <h4><b>Interconnection Point</b></h4>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-3 col-xs-12" for="first-name">Address <span class="required ne_star">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="interconnection_point" name="installation[interconnection_point]" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">

                              <h4><b>Installation Site (Near End)</b></h4>
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site ID <span class="required ne_star">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="ne_site_id" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[ne_site_id]" required="required" data-parsley-errors-container="#for_ne_site_id">
                                      <span id = "for_ne_site_id"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required ne_star">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <textarea id="ne_address" name="installation[ne_address]" class="form-control near" required="required" data-parsley-errors-container="#for_ne_address"></textarea>
                                      <span id = "for_ne_address"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required ne_star">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="ne_subdistrict" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[ne_subdistrict]" required="required" data-parsley-errors-container="#for_ne_subdistrict">
                                      <span id = "for_ne_subdistrict"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required ne_star">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="ne_district" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[ne_district]" required="required" data-parsley-errors-container="#for_ne_district">
                                      <span id = "for_ne_district"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required ne_star">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="ne_city" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[ne_city]" required="required" data-parsley-errors-container="#for_ne_city">
                                      <span id = "for_ne_city"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required ne_star">*</span>
                                  </label>
                                  <div class="col-md-4 col-sm-2 col-xs-12">
                                      <input id="ne_state" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[ne_state]" required="required" data-parsley-errors-container="#for_ne_state">
                                      <span id = "for_ne_state"></span>
                                  </div>
                                  <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code <span class="required ne_star">*</span></label>
                                  <div class="col-md-3 col-sm-2 col-xs-12">
                                      <input id="ne_zip_code" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[ne_zip_code]" required="required" data-parsley-errors-container="#for_ne_zip_code">
                                      <span id = "for_ne_zip_code"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude <span class="required ne_star">*</span></label>
                                  <div class="col-md-4 col-sm-2 col-xs-12">
                                      <input id="ne_longitude" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[ne_longitude]" required="required" data-parsley-errors-container="#for_ne_longitude">
                                      <span id = "for_ne_longitude"></span>
                                  </div>
                                  <label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude <span class="required ne_star">*</span></label>
                                  <div class="col-md-3 col-sm-2 col-xs-12">
                                      <input id="ne_latitude" class="form-control col-md-7 col-xs-12 near" type="text" name="installation[ne_latitude]" required="required" data-parsley-errors-container="#for_ne_latitude">
                                      <span id = "for_ne_latitude"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Installation By<span class="required ne_star">*</span></label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <select id="ne_by" name="installation[ne_by]" class="form-control js-example-tags near" name="installation[ne_latitude]" required="required" data-parsley-errors-container="#for_ne_by">
                                          <option value="">-- Select --</option>
                                          <option value="MTI">MTI</option>
                                      </select>
                                      <span id = "for_ne_by"></span>
                                  </div>
                              </div>
                            </div>

                            <div class="col-md-6 col-xs-12">
                              <h4><b>Installation Site (Far End)</b></h4>
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Building Name <span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                       <input id="fe_building_name" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_building_name]" required="required" data-parsley-errors-container="#for_fe_building">
                                      <span id = "for_fe_building"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Floor <span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                       <input id="fe_floor" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_floor]" required="required" data-parsley-errors-container="#for_fe_floor">
                                      <span id = "for_fe_floor"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <textarea id="fe_address" name="installation[fe_address]" class="form-control" name="installation[fe_floor]" required="required" data-parsley-errors-container="#for_fe_address"></textarea>
                                      <span id = "for_fe_address"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub District <span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="fe_subdistrict" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_subdistrict]" required="required" data-parsley-errors-container="#for_fe_subdistrict">
                                      <span id = "for_fe_subdistrict"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">District <span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="fe_district" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_district]" required="required" data-parsley-errors-container="#for_fe_district">
                                      <span id = "for_fe_district"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">City <span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <input id="fe_city" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_city]" required="required" data-parsley-errors-container="#for_fe_city"> 
                                      <span id = "for_fe_city"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">State <span class="required">*</span>
                                  </label>
                                  <div class="col-md-4 col-sm-2 col-xs-12">
                                      <input id="fe_state" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_state]" required="required" data-parsley-errors-container="#for_fe_state">
                                      <span id = "for_fe_state"></span>
                                  </div>
                                  <label class="control-label col-md-2 col-sm-2 col-xs-6">ZIP Code <span class="required">*</span>
                                  </label>
                                  <div class="col-md-3 col-sm-2 col-xs-12">
                                      <input id="fe_zip_code" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_zip_code]" required="required" data-parsley-errors-container="#for_fe_zip_code">
                                      <span id = "for_fe_zip_code"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">FAT<span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <div class="input-group">
                                        <input type="text" class="form-control" name = "installation[olt_booked]" id = "fe_fat_name">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary open_map"><span class="fa fa-map-marker"></span></button>
                                        </span>
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Longitude <span class="required">*</span>
                                  </label>
                                  <div class="col-md-4 col-sm-2 col-xs-12">
                                      <input id="fe_longitude" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_longitude]" required="required" data-parsley-errors-container="#for_fe_longitude">
                                      <span id = "for_fe_longitude"></span>
                                  </div>
                                  <label class="control-label col-md-2 col-sm-2 col-xs-6">Latitude <span class="required">*</span>
                                  </label>
                                  <div class="col-md-3 col-sm-2 col-xs-12">
                                      <input id="fe_latitude" class="form-control col-md-7 col-xs-12 input" type="text" name="installation[fe_latitude]" required="required" data-parsley-errors-container="#for_fe_latitude">
                                      <span id = "for_fe_latitude"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Installation By <span class="required">*</span>
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <select id="fe_by" name="installation[fe_by]" class="form-control js-example-tags input" required="required" data-parsley-errors-container="#for_fe_by">
                                          <option value="">-- Select --</option>
                                          <option value="MTI">MTI</option>
                                      </select>
                                      <span id = "for_fe_by"></span>
                                  </div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div id="step-7">
                        <div class="form-horizontal form-label-left form-step-7">
                          <div class="row tab_step">
                          </div>
                          <label class="control-label">Notes</label>
                          <textarea id="notes" name="notes" class="form-control input"></textarea>
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
                    <td><?php echo $service['uom']?></td>
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
                <h4 class="modal-title" id="myModalLabel">Sevice Detail</h4>
            </div>
            <div class="modal-body">
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

<script>
    $(function() {
        $("#wizard").smartWizard({
          onLeaveStep :  function(obj, context){
            var curStep = context.fromStep,
                toStep = context.toStep;

            // if(curStep == 4){ // for development
            if(toStep == 7){
                var d = $('#subservice_form').serialize(); 
                $.ajax({
                  type : 'POST', 
                  url : '/customer/subservice',
                  async : false, 
                  data: d,
                  dataType : 'json', 
                  success : function(res){
                    var tabs = "";
                    $.each(res, function(index, block){
                      var column = '<div class="col-md-6 col-xs-12">';
                      $.each(block, function(key, group){
                        column += '<table class = "table table-bordered"';
                        column += '<tr>'
                        column += ' <th colspan="4">'+group[0].group_name+'</th>';
                        column += '</tr>';
                        column += '<tr>';
                        column += '<th></th>';
                        column += '<th>SO Name</th>';
                        column += '<th>Quantity</th>';
                        column += '<th>UoM</th>';
                        column += '</tr>';
                        $.each(group, function(idx, service){
                          column += '<tr>';
                          column += '<td><input type="checkbox" class = "sservice" value="'+service.id+'" name = "subservice['+service.id+'][id]" checked></td>';
                          column += '<td>'+service.subservice_name+'</td>';
                          column += '<td><input class="form-control col-md-2 col-xs-12 " type="text" name="subservice['+service.id+'][kapasitas]" value = "'+service.kapasitas+'"><input type="hidden" name="subservice['+service.id+'][group]" value="'+service.group+'"></td>';
                          column += '<td>'+service.uom+'</td>';
                          column += '</tr>';
                        })
                        column += '</table>';
                      })
                      column += '</div>';
                      tabs += column;
                    })

                    $(".tab_step").html(tabs);
                  }
                })
            }

            // return true;

            if(toStep < curStep){
                return true;
            } else {
              var content = ".form-step-"+curStep;
              var req = $(content).find('.input');
              var valid = 'true';
              $.each(req, function(i, elem){
                  var f = '#'+elem.id;
                  var y = $(f).parsley();
                  y.validate();
                  if(y.isValid() == false){
                    valid = 'false';
                  }
              })
              if(valid != 'false'){
                return true;
              }
              if(valid == 'true'){
                return true;
              }
            }
            // return true;
          }
        });

        $.ajax({
          type : 'GET', 
          url : '/account/emp_session',
          async : false, 
          dataType : 'json', 
          success : function(res){
            if(res.status === 200){
              var data = res.data;
              $('#user_id').val(data.employee_no);
              $('#user_name').val(data.name);
              $('#user_email').val(data.email);
            }
          }
        })
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


        $('#po_number').change(function(){
          var po_number = $(this).val();
          $.ajax({
            type : 'POST', 
            url : '/customer/get_po_price',
            async : false, 
            data : {number : po_number},
            dataType : 'json', 
            success : function(res){
              if(res.status == 200){
                $("#customer_classification").select2('val', res.data);
              }
            }
          })
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

            $("#map_frame").attr('src', 'http://sf.apps.moratelindo.co.id/map.php');
            //$("#map_frame").attr('src', 'http://sf.local.moratelindo.co.id/map.php');

            window.closeModal = function () {
                $('#mdmap').modal('hide');
                // window.location.reload();
            };
        });

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
              $('#company_address').val(dt.ADDRESS1);
              $('#company_city').val(dt.CITY);
              $('#company_state').val(dt.COUNTY);
              $('#company_zip_code').val(dt.POSTAL_CODE);
            }
          })
        }




        /*$("#map_frame").load(function() {
          var $c = $('#map_frame').contents();
          var $t = $c.find('button');

          console.log($t);

        });*/

        
    })

    
</script>
