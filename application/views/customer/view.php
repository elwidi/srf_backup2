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

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      
        <div class="x_panel">
            <div class="x_title">
                <h2>Detail</h2>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer'; ?>"><span class="fa fa-list"></span> List</button>
                    <?php if($this->session->userdata('leveluser_id')==3) { ?>
                    <button type="button" class="btn btn-success" onclick=location.href="<?php echo base_url().'customer/create'; ?>"><span class="fa fa-plus"></span> Create</button>
                    <button type="button" class="btn btn-warning" onclick=location.href="<?php echo base_url().'customer/edit/'.$rec[0]->id; ?>"><span class="fa fa-pencil"></span> Edit</button>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <?php if($this->session->userdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->userdata('status'); ?> alert-dismissible fade in  text-center" role="alert">
                        <strong><?php echo $this->session->userdata('pesan'); ?></strong>
                    </div>
                <?php 
                        $this->session->set_userdata('status', null);
                    }
                ?>
                
                <form class="form-horizontal form-label-left">

                <?php if($this->session->userdata('leveluser_id')==1) { ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_name">Supervisor
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="supervisor_name" name="supervisor_name" value="<?php echo $rec[0]->supervisor_name; ?>" />
                    </div>
                </div>
                <?php } ?>
                
                <?php if($this->session->userdata('leveluser_id')==1 || $this->session->userdata('leveluser_id')==2) { ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="account_name">Account 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="account_name" name="account_name" value="<?php echo $rec[0]->account_name; ?>" />
                    </div>
                </div>
                <?php } ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Segmen
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec[0]->segmen; ?>" readonly="">
                    </div>
                </div>
                    
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Company Name 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="customer_name" name="customer_name" value="<?php echo $rec[0]->customer_name; ?>" />
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Contact Person
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="pic" name="pic" value="<?php echo $rec[0]->pic; ?>" />
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Contact Number
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                        $telephone = '';
                        foreach($rec as $r) 
                        {
                            $telephone .= $r->number.', ';
                        }
                        ?>
                        <input type="text" id="telephone" name="telephone" class="form-control" value="<?php echo $telephone; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $rec[0]->email; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Company Address
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="address" name="address" class="form-control" readonly=""><?php echo $rec[0]->address; ?></textarea>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Category
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec[0]->category_name; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="service">Service
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="service" name="service" class="form-control" value="<?php echo $rec[0]->service; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_service">Type Service
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="type_service" name="type_service" class="form-control" value="<?php echo $rec[0]->type_service; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Koordinat Latitude
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec[0]->koordinat_lat; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Koordinat Longitude
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec[0]->koordinat_long; ?>" readonly="">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Lantai Ruang Terminasi
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec[0]->terminasi; ?>" readonly="">
                    </div>
                </div>
                <?php if($rec[0]->id_product == 74){ ?>
                <?php } ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file_po">File PO
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php if(isset($file['PO'])){ ?>
                        <a href = <?php echo base_url() . $file['PO']->path. $file['PO']->file ?> target = "_blank"><span class = "fa fa-paperclip"></span><?php echo $file['PO']->file?></a>
                        <?php } else { ?>
                        <p> No File</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file_ktp">File KTP
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php if(isset($file['KTP'])){ ?>
                        <a href = <?php echo base_url() . $file['KTP']->path. $file['KTP']->file ?> target = "_blank"><?php echo $file['KTP']->file?></a>
                        <?php } else { ?>
                        <p> No File</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file_npwp">File NPWP
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                       <?php if(isset($file['NPWP'])){ ?>
                        <a href = <?php echo base_url() . $file['NPWP']->path. $file['NPWP']->file ?> target = "_blank"><?php echo $file['NPWP']->file?></a>
                        <?php } else { ?>
                        <p> No File</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="button" class="btn btn-primary" onclick=location.href="<?php echo base_url().'customer'; ?>">Back</button>
                    </div>
                </div>

                </form>
                
            </div>
        </div>
            
    </div>
</div>