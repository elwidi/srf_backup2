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
                <h2>FAT List</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <table id="table_example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings text-center">
                            <th>Cluster</th>
                            <th>FAT Code</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Port Available</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
            
    </div>
</div>

<script>
    $(function() {
        var oTable = $('#table_example').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "/customer/datatable_fat",
            "aoColumns":[
            {
                "mData":"CLUSTER_NAME",
                "render": function ( mData, type,row, meta ) {
                  return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '">' + mData+'</a>';                             
                }
            },
            {
                "mData":"FAT_CODE",
                "render": function ( mData, type,row, meta ) {
                  return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '">' + mData+'</a>';                             
                }
            },
            {
                "mData":"LONGITUDE",
                "render": function ( mData, type,row, meta ) {
                  return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '">' + mData+'</a>';                             
                }
            },
            {
                "mData":"LATITUDE",
                "render": function ( mData, type,row, meta ) {
                  return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '">' + mData+'</a>';                             
                }
            },
            {
                "mData":"PORT_AVAILABLE",
                "render": function ( mData, type,row, meta ) {
                  return '<a class = "select_fat" cluster = "' + row.FAT_CODE + '">' + mData+'</a>';                             
                }
            }
            ],
            /*"columns" : [
            {"data" : "CLUSTER_NAME"},
            {"data" : "FAT_CODE"},
            {"data" : "LONGITUDE"},
            {"data" : "LATITUDE"},
            ],*/
            /*processing : true, 
            serverSide : true,
            sAjaxSource : {
            url : "/customer/datatable_project",
            type : "POST"
            },*/
            "oLanguage": {
              "sSearch": "Search :"
            },
            "aoColumnDefs": [
              {
                  'bSortable': false,
                  'aTargets': [0]
              } //disables sorting for column one
            ],
            'iDisplayLength': 10,
            "sPaginationType": "full_numbers",
            // "dom": 'T<"clear">lfrtip',
            "tableTools": {
              "sSwfPath": "<?php echo base_url('assets/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
            },
            fnDrawCallback: function () {
                    // cbtable();
            }
            });
            $("tfoot input").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
            oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
            });
            $("tfoot input").each(function (i) {
            asInitVals[i] = this.value;
            });
            $("tfoot input").focus(function () {
            if (this.className == "search_init") {
              this.className = "";
              this.value = "";
            }
            });
            $("tfoot input").blur(function (i) {
            if (this.value == "") {
              this.className = "search_init";
              this.value = asInitVals[$("tfoot input").index(this)];
            }
        });
    });
</script>