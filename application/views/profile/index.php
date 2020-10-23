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
                <h2>Edit Data</h2>
                <div class="pull-right">
                    
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
                
                <?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>

                <form class="form-horizontal form-label-left" novalidate method="post" action="<?php echo base_url().'profile'; ?>">

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="old">Old Password *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="old" name="old" class="form-control" maxlength="50" required="">
                            <?php echo form_error('old', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="password" name="password" class="form-control" maxlength="50" required="">
                            <?php echo form_error('password', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="confirm">Confirm Password *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" id="confirm" name="confirm" class="form-control" maxlength="50">
                            <?php echo form_error('confirm', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="btnsave" name="btnsave" value="Update" type="submit" class="btn btn-success" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
            
    </div>
</div>