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
                <h2>Data List</h2>
                <div class="pull-right">

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings text-center">
                            <th>No.</th>
                            <th>Account</th>
                            <th>Email</th>
                            <?php if($this->session->userdata('leveluser_id')==1) { ?>
                                <th>Supervisor</th>
                            <?php } ?>
                            <th>Customer</th>
                            <th>Active</th>
                            <th class=" no-link last"><span class="nobr">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($rec!=null) {  ?>
                        
                            <?php $i = 1; ?>
                        
                            <?php foreach($rec as $r) {  ?>
                        
                                <tr class="<?php echo ($i%2==0) ? 'even' : 'odd'; ?> pointer">
                                    <td class="a-center "><?php echo $i; ?></td>
                                    <td class=" "><?php echo $r->name; ?></td>
                                    <td class=" "><?php echo $r->email; ?></td>
                                    <?php if($this->session->userdata('leveluser_id')==1) { ?>
                                        <td class=" "><?php echo $r->supervisor_name; ?></td>
                                    <?php } ?>
                                    <td class=" "><?php echo $r->cust; ?></td>
                                    <td class=" "><?php echo ($r->active) ? 'Yes' : 'No'; ?></td>
                                    <td class="a-center last text-center">
                                        <a class="btn btn-xs btn-info" href="<?php echo base_url().'account/view/'.$r->id; ?>"><span class="fa fa-file"></span> View</a>
                                    </td>
                                </tr>
                                
                                <?php $i++; ?>
                            
                            <?php } ?>
                                
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
            
    </div>
</div>