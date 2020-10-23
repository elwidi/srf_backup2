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
                <h2><?php echo $title; ?></h2>
                <div class="pull-right">
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>
                
                <form class="form-horizontal form-label-left" method="post" action="<?php echo base_url().'report/calllog'; ?>">

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pic">Date *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" style="width: 200px" name="date" id="date" class="form-control range_date" value="<?php echo ($date1!=null) ? date('m/d/Y', strtotime($date1)) :date('m/d/Y'); ?> - <?php echo ($date2!=null) ? date('m/d/Y', strtotime($date2)) :date('m/d/Y');; ?>" required />
                            </div>
                        </div>
                    </div>
                    <!-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supervisor">Supervisor *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="supervisor" name="supervisor" class="form-control show-tick select2_single" data-live-search="true" required="required" onchange="listSales(this.value)">
                                <option value="all">[ ALL ]</option>
                                <?php
                                if($this->session->userdata('leveluser_id')!=2) {
                                    echo '<option value="">-- Select Supervisor --</option>';
                                    foreach($cmbSupervisor as $rec) {
                                        echo '<option value="'.$rec->id.'" 
                                                '.( (set_value("supervisor")==$rec->id) ? 'selected' : '').'>
                                                '.$rec->name.'</option>';
                                    }
                                }
                                else
                                {
                                    echo '<option value="'.$this->session->userdata('employee_id').'">'.$this->session->userdata('user_name').'</option>';
                                }
                                ?>
                            </select>
                            <?php echo form_error('supervisor', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales">Sales *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="sales" name="sales" class="form-control show-tick select2_single" data-live-search="true" required="required">
                                <option value="">-- Select Sales --</option>
                                <?php 
                                if($cmbSales!=null) { 
                                    foreach($cmbSales as $rec) {
                                        echo '<option value="'.$rec->id.'" 
                                                '.( (set_value("sales")==$rec->id) ? 'selected' : '').'>
                                                '.$rec->name.'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('sales', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div> -->
                    
                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <input id="btnsubmit" name="btnsubmit" value="Generate" type="submit" class="btn btn-success" />
                        </div>
                    </div>
                </form>
                <hr />

                <div id="chart-call-log" style="height:400px"></div>

            </div>
        </div>
            
    </div>
</div>

<div class="modal" id="modalLoading" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 id="">Get Detail Data </h4>
            </div>
            
            <div class="modal-body">
                    <h1 class="text-center">Loading ....</h1>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" style="overflow-y: auto;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 id="titleModal"></h4>
            </div>
            
            <div class="modal-body">

                <div id="table-detail"></div>

                <div id="chart-detail"></div>

            <div class="modal-footer modal-col-orange">

                <button id="btn_batal" class="btn btn-warning" data-dismiss="modal" type="button">
                    Close
                </button>

            </div>

        </div>
    </div>
</div>

<script>
    
    Highcharts.chart('chart-call-log', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Sales Call Log at <?php echo $date1.' - '.$date2; ?>'
        },
        xAxis: {
            categories: [<?php echo ($label!=null) ? $label : ''; ?>]
        },
        yAxis: {
            title: {
                text: 'Number of Call'
            }
        },
        plotOptions: {
            series: {
                name: 'Call',
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            detailTim(this.category, '<?php echo $date1; ?>', '<?php echo $date2; ?>');
                        }
                    }
                }
            }
        },

        series: [{
            data: [<?php echo ($value!=null) ? $value : ''; ?>]
        }]
    });
    
    function detailTim(supervisor, date1, date2)
    {
        if(supervisor!='' && date1!='' && date2!='')
        {
            $("#modalLoading").modal({backdrop: 'static', keyboard: false});

            $.ajax({
                type:"POST",
                url:"<?php echo base_url().'report/calllog_detailtim'; ?>",
                data:{ supervisor : supervisor, date1 : date1, date2 : date2 },
                success: function (data) {

                    $("#modalDetail").modal({keyboard: false});

                    if(data!=null)
                    {
                        $('#chart-detail').html(data);
                    }
                    else
                    {
                        $('#chart-detail').html('');
                    }

                    $("#modalLoading").modal('toggle');
                }
            });
        }
    }

</script>