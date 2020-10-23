<?php if($this->session->userdata('status')!=null) { ?>
    <br />
    <div class="alert alert-<?php echo $this->session->userdata('status'); ?> alert-dismissible fade in  text-center" role="alert">
        <strong><?php echo $this->session->userdata('pesan'); ?></strong>
    </div>
    <?php
    $this->session->set_userdata('status', null);
}
?>

<div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
                <div class="icon"><i class="fa fa-cube"></i>
                </div>
                <div class="count"><?php echo isset($jml_keuangan) ? $jml_keuangan : 0; ?></div>

                <h3>Canvasing</h3>
                <p></p>
            </a>
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
                <div class="icon"><i class="fa fa-line-chart"></i>
                </div>
                <div class="count"><?php echo isset($jml_keuangan) ? $jml_keuangan : 0; ?></div>

                <h3>Prospect</h3>
                <p></p>
            
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
                <div class="icon"><i class="fa fa-edit"></i>
                </div>
                <div class="count"><?php echo isset($jml_keuangan) ? $jml_keuangan : 0; ?></div>

                <h3>Registration</h3>
                <p></p>
            
        </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
                <div class="icon"><i class="fa fa-flag-checkered"></i>
                </div>
                <div class="count"><?php echo isset($jml_keuangan) ? $jml_keuangan : 0; ?></div>

                <h3>Close</h3>
                <p></p>
        </div>
    </div>
</div>