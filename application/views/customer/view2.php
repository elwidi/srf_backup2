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
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer/data'; ?>"><span class="fa fa-list"></span> List</button>
                    <?php if($this->session->userdata('leveluser_id')==3) { ?>
                    <button type="button" class="btn btn-success" onclick=location.href="<?php echo base_url().'customer/create'; ?>"><span class="fa fa-plus"></span> Create</button>
                    <!-- <button type="button" class="btn btn-warning" onclick=location.href="<?php echo base_url().'customer/edit/'.$rec->id; ?>"><span class="fa fa-pencil"></span> Edit</button> -->
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
                <!-- <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_name">Supervisor
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="supervisor_name" name="supervisor_name" value="<?php echo $rec->supervisor_name; ?>" />
                    </div>
                </div> -->
                <?php } ?>
                
                <?php if($this->session->userdata('leveluser_id')==1 || $this->session->userdata('leveluser_id')==2) { ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="account_name">Account 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="account_name" name="account_name" value="<?php echo $rec->NAME_SALES; ?>" />
                    </div>
                </div>
                <?php } ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Segmen
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec->SEGMEN; ?>" readonly="">
                    </div>
                </div>
                    
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Company Name 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="customer_name" name="customer_name" value="<?php echo $rec->NAME_CUSTOMER; ?>" />
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Contact Person
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="pic" name="pic" value="<?php echo $rec->PIC; ?>" />
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Contact Number
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                        /*$telephone = '';
                        foreach($rec as $r) 
                        {
                            $telephone .= $r->number.', ';
                        }*/
                        ?>
                        <input type="text" id="telephone" name="telephone" class="form-control" value="<?php echo $rec->PICNUMBER; ?>" readonly="">
                    </div>
                </div>
                <!-- <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $rec->email; ?>" readonly="">
                    </div>
                </div> -->
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Company Address
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="address" name="address" class="form-control" readonly=""><?php echo $rec->ALAMAT_INSTALASI1; ?></textarea>
                    </div>
                </div>
                <!-- <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Category
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec->category_name; ?>" readonly="">
                    </div>
                </div> -->
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="service">Service
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="service" name="service" class="form-control" value="<?php echo $rec->PRODUCT_NAME; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_service">Type Service
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="type_service" name="type_service" class="form-control" value="<?php echo $rec->TYPE_SERVICE; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Koordinat Latitude
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec->KOORDINAT1; ?>" readonly="">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Koordinat Longitude
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec->KOORDINATLOT1; ?>" readonly="">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Lantai Ruang Terminasi
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo $rec->TERMINASI1; ?>" readonly="">
                    </div>
                </div>
                <?php //if($rec->id_product == 74){ ?>
                <?php //?>
                <!-- <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="file_po">File PO
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php if(isset($file['PO'])){ ?>
                        <a href = <?php echo base_url() . $file['PO']->path. $file['PO']->file ?> target = "_blank"><span class = "fa fa-paperclip"></span><?php echo $file['PO']->file?></a>
                        <?php } else { ?>
                        <p> No File</p>
                        <?php } ?>
                    </div>
                </div> -->
                <!-- <div class="item form-group">
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
                </div> -->
                <div class="ln_solid"></div>
                <!-- <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="button" class="btn btn-primary" onclick=location.href="<?php echo base_url().'customer'; ?>">Back</button>
                    </div>
                </div> -->

                </form>
                
            </div>
        </div>
            
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      
        <div class="x_panel">
            <div class="x_title">
                <h2>Menggunakan Tarikan Moratelindo</h2>
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
                    <div class="item form-group">
                        <h4>Network Proper
                        </h4>
                    </div>

                <?php //if($this->session->userdata('leveluser_id')==1) { ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_name">Jarak Tarikan Main Route
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="supervisor_name" name="supervisor_name" value="<?php if(!empty($presales)) echo $presales[0]->JARAK_MAIN_ROUTE_P?>" />
                    </div>
                </div>
                <?php //} ?>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">POP Tujuan
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php if(!empty($presales)) echo $presales[0]->POP_MAIN_ROUTE_P?>" readonly="">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_name">Jarak Tarikan Backup Route
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="supervisor_name" name="supervisor_name" value="<?php if(!empty($presales)) echo $presales[0]->JARAK_BACKUP_ROUTE_P?>" />
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">POP Tujuan
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php if(!empty($presales)) echo $presales[0]->POP_BACKUP_ROUTE_P?>" readonly="">
                    </div>
                </div>
                    
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Perangkat
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="customer_name" name="customer_name" value="<?php if(!empty($presales)) echo $presales[0]->PERANGKAT_P?>" />
                    </div>
                </div>
                <!-- <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Upload List Data
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="pic" name="pic" value="" />
                    </div>
                </div> -->

                <div class="item form-group">
                        <h4>Network On Budget
                        </h4>
                    </div>

                <?php //if($this->session->userdata('leveluser_id')==1) { ?>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor_name">Jarak Tarikan Main Route
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="supervisor_name" name="supervisor_name" value="<?php if(!empty($presales)) echo $presales[0]->JARAK_MAIN_ROUTE_B?>" />
                    </div>
                </div>
                <?php //} ?>
                
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">POP Tujuan
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="category_name" name="category_name" class="form-control" value="" readonly="<?php if(!empty($presales)) echo $presales[0]->POP_MAIN_ROUTE_B?>">
                    </div>
                </div>
                    
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Perangkat
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="customer_name" name="customer_name" value="<?php if(!empty($presales)) echo $presales[0]->PERANGKAT_B?>" />
                    </div>
                </div>
                <!-- <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Upload List Data
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" readonly="" id="pic" name="pic" value="" />
                    </div>
                </div> -->
                <div class="ln_solid"></div>
                <!-- <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="button" class="btn btn-primary" onclick=location.href="<?php echo base_url().'customer'; ?>">Back</button>
                    </div>
                </div> -->

                </form>
                
            </div>
        </div>
            
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      
        <div class="x_panel">
            <div class="x_title">
                <h2>Menggunakan Mitra Lastmile</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left">

                    <div class = "row">
                        <div class = "col-md-6 col-sm-12 col-xs-12">

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Nama Mitra Lastmile 1 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" readonly="" id="customer_name" name="customer_name" value="<?php if(!empty($presales)) echo $presales[0]->LASTMILE1?>" />
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Lastmile 1
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" readonly="" id="pic" name="pic" value="<?php if(!empty($presales)) echo $presales[0]->LASTMILEINFO1?>" />
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Biaya Bulanan
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="telephone" name="telephone" class="form-control" value="<?php if(!empty($presales)) echo $presales[0]->BIAYA_BULANAN1?>" readonly="">
                                    </div>
                                </div>
                                <!-- <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Kapasitas Lastmile 1
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="email" name="email" class="form-control" value="" readonly="<?php if(!empty($presales)) echo $presales[0]->BIAYA_BULANAN1?>">
                                    </div>
                                </div> -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Biaya Instalasi
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <!-- <textarea id="address" name="address" class="form-control" readonly=""></textarea> -->
                                        <input type="text" id="category_name" name="category_name" class="form-control" readonly="" value="<?php if(!empty($presales)) echo $presales[0]->BIAYA_INSTALASI1?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Delivery Time
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="category_name" name="category_name" class="form-control" readonly="" value="<?php if(!empty($presales)) echo $presales[0]->DELIVERY_TIME1?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="service">SLA
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="service" name="service" class="form-control" readonly="" value="<?php if(!empty($presales)) echo $presales[0]->SLA1?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_service">Interkoneksi
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="type_service" name="type_service" class="form-control" readonly="" value="<?php if(!empty($presales)) echo $presales[0]->INTERKONEKSI1?>">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Perangkat
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="address" name="address" class="form-control" readonly=""><?php if(!empty($presales)) echo $presales[0]->PERANGKAT1?></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class = "col-md-6 col-sm-12 col-xs-12">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Nama Mitra Lastmile 2 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" readonly="" id="customer_name" name="customer_name" value="<?php if(!empty($presales)) echo $presales[0]->LASTMILE2?>" />
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Lastmile 2
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" readonly="" id="pic" name="pic" value="<?php if(!empty($presales)) echo $presales[0]->LASTMILEINFO2?>" />
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Biaya Bulanan
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="telephone" name="telephone" class="form-control" value="<?php if(!empty($presales)) echo $presales[0]->BIAYA_BULANAN2?>" readonly="">
                                    </div>
                                </div>
                                <!-- <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Kapasitas Lastmile 2
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="email" name="email" class="form-control" value="" readonly="">
                                    </div>
                                </div> -->
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Biaya Instalasi
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php if(!empty($presales)) echo $presales[0]->BIAYA_INSTALASI2?>" readonly="">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Delivery Time
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="category_name" name="category_name" class="form-control" value="<?php if(!empty($presales)) echo $presales[0]->DELIVERY_TIME2?>" readonly="">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="service">SLA
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="service" name="service" class="form-control" value="<?php if(!empty($presales)) echo $presales[0]->SLA2?>" readonly="">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_service">Interkoneksi
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="type_service" name="type_service" class="form-control" value="<?php if(!empty($presales)) echo $presales[0]->INTERKONEKSI2?>" readonly="">
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_name">Perangkat
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="address" name="address" class="form-control" readonly=""><?php if(!empty($presales)) echo $presales[0]->PERANGKAT2?></textarea>

                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "col-md-12 col-sm-12 col-xs-12">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_name">Notes
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="address" name="address" class="form-control" readonly=""><?php if(!empty($presales)) echo $presales[0]->NOTE?></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
            
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      
        <div class="x_panel">
            <div class="x_title">
                <h2>Comment</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div>
                    <!-- <ul class="messages">
                        <?php foreach($comment as $idx => $row) {?>
                        <li>
                            <div class="message_wrapper">
                                <h4 class="heading"><?php echo $row->FULLNAME?></h4>
                                <span class="message"><?php echo $row->DATE?></span>
                                <span class="message"><?php echo $row->DATE?></span>
                            </div>
                        </li>
                        <?php } ?>
                    </ul> -->
                    <ul class="list-unstyled timeline widget">
                        <?php foreach($comment as $idx => $row) {?>
                        <li>
                            <div class="block">
                              <div class="block_content">
                                <h2 class="title"><?php echo $row->FULLNAME?></h2>
                                <div class="byline">
                                  <span><?php echo $row->DATE?></span>
                                </div>
                                <p class="excerpt"><?php echo $row->COMMENT?>
                                </p>
                              </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>

                </div>
                <form class="form-horizontal form-label-left" method="POST" action="<?php echo base_url().'customer/comment'; ?>">
                    <div class="item form-group">
                        <!-- <label class="control-label" for="supervisor_name">Supervisor
                        </label> -->
                        <!-- <div class="col-md-6">
                            <input type="hidden" name="id_presales" value="<?php echo $rec->id_customer_presales ?>">
                            <input type="hidden" name="id_customer" value="<?php echo $rec->id ?>">
                            <textarea type="text" class="form-control"  id="comment" name="comment"  placeholder = "Add comment" ></textarea>
                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 ">Write comment here</label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="hidden" name="id_presales" value="<?php echo $rec->ID_CUSTOMER ?>">
                                <!-- <input type="hidden" name="id_customer" value="<?php echo $rec->id ?>"> -->
                                <textarea class="resizable_textarea form-control" id="comment" name="comment"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-3 pull-right">
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </div>
                </form>           
            </div>
        </div>
            
    </div>
</div>