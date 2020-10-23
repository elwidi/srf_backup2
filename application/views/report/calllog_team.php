<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div style=" width: auto;overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
                    <div style="width:100%">
                
                    <div class="d-flex justify-content-between align-items-center pb-4">
                        <h4 class="card-title mb-0"></h4>
                        <div id="line-traffic-legend"></div>
                    </div>
                
                        <div id="chart-team" style="height:300px"></div>
                    </div>
                </div>
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

<script src="<?php echo base_url().'assets/plugins/highchart/'; ?>highcharts.js"></script>

<script>

    Highcharts.chart('chart-team', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo $title; ?> (<?php echo $date1.' - '.$date2; ?>)'
        },
        xAxis: {
            categories: [<?php echo ($label!=null) ? $label : ''; ?>]
        },
        yAxis: {
            title: {
                text: 'Number of Calllog'
            }
        },
        plotOptions: {
            series: {
                name: 'Call',
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            detailSales(this.category, '<?php echo $date1; ?>', '<?php echo $date2; ?>');
                        }
                    }
                }
            }
        },

        series: [{
            data: [<?php echo ($value!=null) ? $value : ''; ?>]
        }]
    });

    function detailSales(sales, date1, date2)
    {
        if(sales!='' && date1!='' && date2!='')
        {
            $("#modalLoading").modal({backdrop: 'static', keyboard: false});

            $.ajax({
                type:"POST",
                url:"<?php echo base_url().'report/calllog_detailsales'; ?>",
                data:{ sales : sales, date1 : date1, date2 : date2 },
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