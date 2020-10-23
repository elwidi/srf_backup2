<div class="page-title">
    <div class="title_left">
        <h3><?php echo $judul; ?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            
        </div>
    </div>
</div>
<div class="clearfix"></div>

<?php if($this->session->userdata('status')!=null) { ?>
    <div class="alert alert-<?php echo $this->session->userdata('status'); ?> alert-dismissible fade in  text-center" role="alert">
        <strong><?php echo $this->session->userdata('pesan'); ?></strong>
    </div>
    <?php
    $this->session->set_userdata('status', null);
}
?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      
        <div class="x_panel">
            <div class="x_title">
                <h2>Detail</h2>
                <div class="pull-right">
                    <?php if($this->uri->segment(1)!='profile') { ?>
                        <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'manager'; ?>"><span class="fa fa-list"></span> List</button>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                        <div class="avatar-view" title="Change the avatar">
                            <img src="<?php echo base_url(); ?>assets/gentelella/images/profile.png" alt="Avatar">
                        </div>
                    </div>
                
                    <h3><?php echo $rec->name; ?></h3>

                    <ul class="list-unstyled user_data">
                        <li>
                            <i class="fa fa-tag user-profile-icon"></i> Employee No. : <?php echo $rec->employee_no; ?>
                        </li>
                        <li>
                            <i class="fa fa-envelope user-profile-icon"></i> Email : <?php echo $rec->email; ?>
                        </li>
                        <li>
                            <i class="fa fa-group user-profile-icon"></i> Account : <?php echo $rec->acc; ?> Person
                        </li>
                        <li>
                            <i class="fa fa-male user-profile-icon"></i> Customer : <?php echo $rec->cust; ?> 
                        </li>
                        <li class="m-top-xs">
                            <i class="fa fa-fire user-profile-icon"></i> Active : <?php echo ($rec->active) ? 'Yes' : 'No' ?>
                        </li>
                    </ul>
                </div>
                
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Supervisor</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Sales</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Customer</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                <table class="data table table-striped no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Supervisor Name</th>
                                            <th>Email</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($recSpv!=null) {  ?>
                        
                                            <?php $i = 1; ?>

                                            <?php foreach($recSpv as $r) {  ?>

                                                <tr class="<?php echo ($i%2==0) ? 'even' : 'odd'; ?> pointer">
                                                    <td class="a-center "><?php echo $i; ?></td>
                                                    <td class=" ">
                                                        <a href="<?php echo base_url().'supervisor/view/'.$r->id; ?>" target="_blank" style="cursor: pointer;">
                                                            <?php echo $r->account_name; ?>
                                                        </a>
                                                    </td>
                                                    <td class=" "><?php echo $r->email; ?></td>
                                                    <td class=" "><?php echo ($r->active==true) ? 'Yes' : 'No'; ?></td>
                                                </tr>

                                                <?php $i++; ?>

                                            <?php } ?>

                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                <!-- start recent activity -->
                                <div class="dashboard-widget-content" id="list_activity">

                                    <table class="data table table-striped no-margin">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Sales Name</th>
                                                <th>Email</th>
                                                <th>Active</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($recSales!=null) {  ?>

                                                <?php $i = 1; ?>

                                                <?php foreach($recSales as $r) {  ?>

                                                    <tr class="<?php echo ($i%2==0) ? 'even' : 'odd'; ?> pointer">
                                                        <td class="a-center "><?php echo $i; ?></td>
                                                        <td class=" ">
                                                            <a href="<?php echo base_url().'supervisor/view/'.$r->id_supervisor; ?>" target="_blank" style="cursor: pointer;">
                                                                <?php echo $r->supervisor_name; ?>
                                                            </a>
                                                        </td>
                                                        <td class=" ">
                                                            <a href="<?php echo base_url().'account/view/'.$r->id; ?>" target="_blank" style="cursor: pointer;">
                                                                <?php echo $r->account_name; ?>
                                                            </a>
                                                        </td>
                                                        <td class=" "><?php echo $r->email; ?></td>
                                                        <td class=" "><?php echo ($r->active==true) ? 'Yes' : 'No'; ?></td>
                                                    </tr>

                                                    <?php $i++; ?>

                                                <?php } ?>

                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- end recent activity -->

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                                <!-- start recent activity -->
                                <div class="dashboard-widget-content" id="list_activity">

                                    <table class="data table table-striped no-margin">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Account</th>
                                                <th>Company Name</th>
                                                <th>Contact Person</th>
                                                <th>Contact Number</th>
                                                <th>Stage</th>
                                                <th>Insert Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($recCustomer!=null) {  ?>

                                                <?php $i = 1; ?>

                                                <?php foreach($recCustomer as $r) {  ?>

                                                    <tr class="<?php echo ($i%2==0) ? 'even' : 'odd'; ?> pointer">
                                                        <td class="a-center "><?php echo $i; ?></td>
                                                        <td class=" "><?php echo $r->account_name; ?></td>
                                                        <td class=" ">
                                                            <a href="<?php echo base_url().'customer/view/'.$r->id; ?>" target="_blank" style="cursor: pointer;">
                                                                <?php echo $r->customer_name; ?>
                                                            </a>
                                                        </td>
                                                        <td class=" "><?php echo $r->pic; ?></td>
                                                        <td class=" "><?php echo $r->telephone; ?></td>
                                                        <td class=" "><label class="label label-info"><?php echo $r->stage_name; ?></label></td>
                                                        <td class=" "><?php echo date('d-m-Y H:i:s', strtotime($r->created_date)); ?></td>
                                                    </tr>

                                                    <?php $i++; ?>

                                                <?php } ?>

                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- end recent activity -->

                            </div>
                        </div>
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-12 col-md-offset-3">
                        <?php if($this->uri->segment(1)=='profile') { ?>
                            <button type="button" class="btn btn-primary" onclick=location.href="<?php echo base_url().'profile/logout'; ?>"><span class="fa fa-sign-out"></span> Sign Out</button>
                        <?php } else { ?>    
                            <button type="button" class="btn btn-primary" onclick=location.href="<?php echo base_url().'manager'; ?>"><span class="fa fa-reply"></span> Back</button>
                            <?php } ?>    
                    </div>
                </div>
                
            </div>
        </div>
            
    </div>
</div>