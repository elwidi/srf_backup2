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
                    <?php if($this->session->userdata('leveluser_id')==3) { ?>
                    <button type="button" class="btn btn-success" onclick=location.href="<?php echo base_url().'customer/create'; ?>"><span class="fa fa-plus"></span> Create</button>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings text-center">
                            <th>No.</th>
                            <?php if($this->session->userdata('leveluser_id')==1) { ?>
                                <th>Supervisor</th>
                            <?php } ?>
                            <?php if($this->session->userdata('leveluser_id')!=3) { ?>
                                <th>Account</th>
                            <?php } ?>
                            <th>Company</th>
                            <th>Source</th>
                            <th>Contact Person</th>
                            <th>Contact Number</th>
                            <th class=" no-link last"><span class="nobr">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($rec!=null) {  ?>
                        
                            <?php $i = 1; ?>
                        
                            <?php foreach($rec as $r) {  ?>
                        
                                <tr class="<?php echo ($i%2==0) ? 'even' : 'odd'; ?> pointer">
                                    <td class="a-center "><?php echo $i; ?></td>
                                    <?php if($this->session->userdata('leveluser_id')==1) { ?>
                                        <td class=" "><?php echo $r->supervisor_name; ?></td>
                                    <?php } ?>
                                    <?php if($this->session->userdata('leveluser_id')!=3) { ?>
                                        <td class=" "><?php echo $r->account_name; ?></td>
                                    <?php } ?>
                                    <td class=" "><?php echo $r->customer_name; ?></td>
                                    <?php if (isset($r->PARTY_ID)){?>
                                    <td class=" ">Oracle</td>
                                    <?php } else { ?>
                                    <td class=" "></td>
                                    <?php } ?>
                                    <td class=" "><?php echo $r->pic; ?></td> 
                                    <td class=" "><?php echo $r->number; ?></td>
                                    <td class="a-center last text-center">
                                        <?php if (!isset($r->PARTY_ID)){?>
                                        <a class="btn btn-xs btn-info" href="<?php echo base_url().'customer/view/'.$r->id; ?>"><span class="fa fa-file"></span> View</a> 
                                        <?php if($this->session->userdata('leveluser_id')==3) { ?>
                                        <a class="btn btn-xs btn-warning" href="<?php echo base_url().'customer/edit/'.$r->id; ?>"><span class="fa fa-pencil"></span> Edit</a>
                                        <?php  } ?>
                                        <?php }?>
                                        <?php if($r->file_status == 1) { 
                                                if (!isset($r->PARTY_ID)){
                                            ?>
                                        <a class="btn btn-xs btn-success" href="<?php echo base_url().'customer/srfv2?id='.$r->id; ?>"><span class="fa fa-file"></span> SRF</a>
                                        <?php } else { ?>
                                        <a class="btn btn-xs btn-success" href="<?php echo base_url().'customer/srfv2?source=oracle&id='.$r->id; ?>"><span class="fa fa-file"></span> SRF</a>
                                        <?php }} else {?>
                                        <a class="btn btn-xs btn-success" href="<?php echo base_url().'customer/upload_po/'.$r->id; ?>"><span class="fa fa-arrow-up"></span> PO</a>
                                        <?php } ?>
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