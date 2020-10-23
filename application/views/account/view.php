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
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'account'; ?>"><span class="fa fa-list"></span> List</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                        <div class="avatar-view" title="Change the avatar">
                            <img src="<?php echo ($this->session->userdata('foto')!='') ? $this->session->userdata('foto') : base_url().'assets/gentelella/images/profile.png'; ?>" alt="Avatar">
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
                            <i class="fa fa-user user-profile-icon"></i> Supervisor : <?php echo $rec->supervisor_name; ?>
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
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Customers</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Recent Activity</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                <!-- start user projects -->
                                <table class="data table table-striped no-margin">
                                    <thead>
                                        <tr>
                                            <th>#</th>
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
                                <!-- end user projects -->

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                <!-- start recent activity -->
                                <div class="dashboard-widget-content" id="list_activity">

                                    <?php if($recActivity!=null) { ?>

                                    <ul class="list-unstyled timeline widget">
                                        <?php foreach($recActivity as $rA) { ?>
                                        <li>
                                            <div class="block">
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a><?php echo $rA->type_name; ?></a>
                                                    </h2>
                                                    <div class="byline">
                                                        <span><?php echo date('d-m-Y H:i:s', strtotime($rA->created_date)); ?></span>, (customer : <a><?php echo $rA->customer_name; ?></a>) (stage : <a><?php echo $rA->stage_name; ?></a>)
                                                    </div>
                                                    <p class="excerpt">
                                                        <?php echo $rA->message; ?>
                                                    </p>
                                                    <?php if($rA->activitytype_id==1) { ?>
                                                    <hr />
                                                    <span>Telp No. : <?php echo $rA->telephone; ?> </span><br />
                                                    <span>Date : <?php echo $rA->telephone_date; ?></span><br />
                                                    <span>ISP : <?php echo $rA->isp; ?></span><br />
                                                    <span>Bandwith : <?php echo $rA->bandwith; ?></span><br />
                                                    <span>Location : <?php echo $rA->location; ?></span><br />
                                                    <span>Budget : <?php echo $rA->budget; ?></span><br />
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </li>
                                        <?php } ?>
                                    </ul>

                                    <?php } else { ?>

                                        <div class="alert alert-warning text-center" id="emptyactivity">No Recent Activity</div>

                                        <ul class="list-unstyled timeline widget">
                                            <li></li>
                                        </ul>

                                    <?php } ?>

                                </div>
                                <!-- end recent activity -->

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk </p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
            
    </div>
</div>