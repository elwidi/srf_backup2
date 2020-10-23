<link href="<?php echo base_url().'assets/gentelella/'; ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

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
                            <th>No. SRF</th>
                            <th>Customer Name</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>Status</th>
                            <th class=" no-link last"><span class="nobr">Detail</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($rec as $k => $row){ ?>
                        <tr>
                            <td><?php echo $no?></td>
                            <td><?php echo $row->srf_number?></td>
                            <td><?php echo $row->customer_name?></td>
                            <td><?php echo $row->name?></td>
                            <td><?php echo date('d M Y H:i:s', strtotime($row->created_date))?></td>
                            <td><span class="label label-info"><?php echo $row->status?></span></td>
                            <td class="a-center last text-center">
                                <a class="btn btn-xs btn-success" href="<?php echo base_url().'customer/view_srf/'.$row->id; ?>"><span class="fa fa-eye"></span> View</a>                             
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                </table>

            </div>
        </div>
            
    </div>
</div>