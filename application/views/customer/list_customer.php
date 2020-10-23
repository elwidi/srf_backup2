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
                
                <table id="table_example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings text-center">
                          <th width = "5%"></th>
                          <th>Nama Sales</th>
                          <th>Nama Pelanggan</th>
                          <th>Segmen</th>
                          <th>Service</th>
                          <th>Type Service</th>
                          <th>Site A</th>
                          <th>Site B</th>
                          <th>Kapasitas</th>
                          <th>Revenue</th>
                          <th>Attach Sales</th>
                          <th>Attach Presales</th>
                          <th>Create Date</th>
                          <th>Update By</th>
                          <th>Update Date</th>
                          <th>Status</th>
                          <!-- <th data-hide="phone,tablet">3rd Party Recommendation</th> -->
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    <tfoot>
                        <tr class="headings text-center">
                            <th width = "5%"></th>
                            <th>Nama Sales</th>
                            <th>Nama Pelanggan</th>
                            <th>Segmen</th>
                            <th>Service</th>
                            <th>Type Service</th>
                            <th>Site A</th>
                            <th>Site B</th>
                            <th>Kapasitas</th>
                            <th>Revenue</th>
                            <th>Attach Sales</th>
                            <th>Attach Presales</th>
                            <th>Create Date</th>
                            <th>Update By</th>
                            <th>Update Date</th>
                            <th>Status</th>
                            <!-- <th data-hide="phone,tablet">3rd Party Recommendation</th> -->
                            <th>Action</th>
                          </tr>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
            
    </div>
</div>

<script type="text/javascript">
    $(function() {

        $('#table_example tfoot th').each( function () {
            var title = $(this).text();

            $(this).html( '<input type="text" style="width: 60px;" />' );
        } );

        var table = $('#table_example').DataTable( {
            "autoWidth": false,
            "serverSide": true,
            "ajax": {
              "url": "<?php echo base_url(); ?>index.php/customer/datatable_customer",
              "type": "POST"
            },
            "columnDefs": [
              {
                render: function (data, type, row) {
                    return '';
                },
                orderable: true,
                visible : false,
                targets: 0
              },
              {
                render: function (data, type, row) {
                  var dis = " <div class = 'text-wrap width-200'>"+row["NAME_SALES"]+"";
                  if(row["COMMENTSUM"]==0){
                    dis += "</div>";
                  }
                  else {
                    dis += "<div class = 'text-wrap width-200'>&nbsp;&nbsp;<a href='/index.php/customer/viewpresales/"+row['ID_CUSTOMER']+"' class='dropdown-toggle'><i class='entypo-mail'></i></a> </div>";
                  }

                  return dis;

                },
                orderable: true,
                targets: 1
              },
              {
                render: function (data, type, row) {
                  return '<div class = "text-wrap width-200">' + row["NAME_CUSTOMER"] + '</div>';
                },
                orderable: true,
                targets: 2
              },
              {
                render: function (data, type, row) {
                  return '<div class = "text-wrap width-100">' + row["SEGMEN"] + '</div>';
                },
                orderable: true,
                visible : false,
                targets: 3
              },
              {
                render: function (data, type, row) {
                  if(row["PRODUCT_NAME"] != "" && row["PRODUCT_NAME"] != null){
                    return "<div class = 'text-wrap width-100'>" + row["PRODUCT_NAME"] + "</div>";
                  }
                  else{
                    return "<div class = 'text-wrap width-100'>";
                  }
                  },
                orderable: true,
                targets: 4
              },
              {
                render: function (data, type, row) {
                  if(row["TYPE_SERVICE"] != "" && row["TYPE_SERVICE"] != "null"){
                    return "<div class = 'text-wrap width-100'>" + row["TYPE_SERVICE"] + "</div>";
                  }
                  else{
                    return "<div class = 'text-wrap width-100'>";
                  }
                },
                orderable: true,
                targets: 5
              },
              {
                render: function (data, type, row) {
                  return '<div class = "text-wrap width-100">'+row["ALAMAT_INSTALASI1"]+'</div>';
                },
                orderable: true,
                targets: 6
              },
              {
                render: function (data, type, row) {
                  return '<div class = "text-wrap width-100">'+row["ALAMAT_INSTALASI2"]+'</div>';
                },
                orderable: true,
                targets: 7
              },
              {
                render: function (data, type, row) {
                  return '<div class = "text-wrap width-100">'+row["MIX"]+'&nbsp;'+row["KAPASITAS"]+'&nbsp;'+row["SATUAN"]+'</div>';
                },
                orderable: true,
                targets: 8
              },
              {
                render: function (data, type, row) {
                  return '<div class = "text-wrap width-200">Rp.&nbsp;'+row["BUDGET"]+'</td>';
                },
                orderable: true,
                visible : false,
                targets: 9
              },
              {
                render: function (data, type, row) {
                  if(row["FILENAME"] != "" && row["FILENAME"] != null) {
                    return "<div class = 'text-wrap width-200'><a href='/files/" + row["FILENAME"] + "'><i class='entypo-attach'></i>" + row["FILENAME"] + "</a></div>";
                  } else {
                    return "<p class='center'></p>";
                  }
                },
                orderable: true,
                visible : false,
                targets: 10
              },
              {
                render: function (data, type, row) {
                  var ret = "<div class = 'text-wrap width-200'>";
                  if(row["FILENAME_PRESALES"] !== "" && row["FILENAME_PRESALES"] != null){
                    ret += "<a href='/files/presales/"+row["FILENAME_PRESALES"]+"'><i class='entypo-attach'></i>"+row["FILENAME_PRESALES"]+"</a><br/>";
                  }
                  if(row["FILENAME_BUDGET"] !== "" && row["FILENAME_BUDGET"] != null){
                    ret += "<a href='/files/presales/"+row["FILENAME_BUDGET"]+"'><i class='entypo-attach'></i>"+row["FILENAME_BUDGET"]+"</a><br/>";
                  }
                  if(row["FILENAME_PROPER"] !== "" && row["FILENAME_PROPER"] != null){
                    ret += "<a href='/files/presales/"+row["FILENAME_PROPER"]+"'><i class='entypo-attach'></i>"+row["FILENAME_PROPER"]+"</a>";
                  }
                  ret += "</div>";

                  return ret;
                  /*else{
                    return "<div class = 'text-wrap width-200'>";
                  }*/
                },
                orderable: true,
                visible: false,
                targets: 11
              },
              {
                render: function (data, type, row) {
                  return "<div class = 'text-wrap width-200'>"+row["TGL_INPUT"]+"</td>";
                },
                orderable: true,
                targets: 12
              },
              {
                render: function (data, type, row) {
                  return "<div class = 'text-wrap width-100'>"+row["USER_UPDATE"]+"</td>";
                },
                orderable: true,
                targets: 13
              },
              {
                render: function (data, type, row) {
                  if(row["UPDATE_DATE"] != '0000-00-00'){
                    return "<div class = 'text-wrap width-100'>"+row["UPDATE_DATE"]+"</td>";
                  }else{
                    return "<div class = 'text-wrap width-100'></td>";
                  }
                },
                orderable: true,
                targets: 14
              },
              {
                render: function (data, type, row) {
                  if(row["PROGRESS"]==1){
                    var dis = "<div class = 'text-wrap width-200'>";
                    dis += "<div class='label label-info'>OPEN</div>";
                    dis += "</div>";
                  }
                  else if (row["PROGRESS"]==3)
                  {
                    var dis = "<div class = 'text-wrap width-200'>";
                    dis += "<div class='label label-danger'>OVER SLA</div>";
                    dis += "</div>";

                  }
                  else {
                    var dis = "<div class = 'text-wrap width-200'>";
                    dis += "<div class='label label-success'>CLOSED</div>";
                    dis += "</div>";

                  }

                  return dis;
                },
                orderable: true,
                targets: 15
              },
              {
                render: function (data, type, row) {
                    var dis = "<div class = 'text-wrap width-200'><a href='/index.php/customer/view_srf/"+row["ID_CUSTOMER"]+"' class='btn btn-default btn-sm btn-icon icon-left'><i class='entypo-flow-branch'></i>View</a><br/><a href='/index.php/customer/srfv2?source=presales&customer_id="+row["ID_CUSTOMER"]+"' class='btn btn-default btn-sm btn-icon icon-left'><i class='entypo-flow-branch'></i>SRF</a></div>";
                    return dis;
                },
                orderable: true,
                targets: 16
              },
            ],
            "pagingType": "full_numbers",
            "order": [[ 0, "desc" ]],
            "columns": [
              { data : "NAME_CUSTOMER"},
              { data : "SERVICE"},
              { data : "ID_PRODUCT"},
              { data : "NAME_SALES"},
              { data : "SEGMEN"},
              { data : "PRODUCT_NAME"},
              { data : "TYPE_SERVICE"},
              { data : "ALAMAT_INSTALASI1"},
              { data : "ALAMAT_INSTALASI2"},
              { data : "MIX"},
              { data : "FILENAME"},
              { data : "FILENAME_PRESALES"},
              { data : "UPDATE_DATE"},
              { data : "PROGRESS"},
              { data : "STATUS"},
              { data : "ID_CUSTOMER"},
            ],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      //      "scrollY": 10,
            initComplete: function ()
            {
              var r = $('#table-3 tfoot tr');
              r.find('th').each(function(){
                $(this).css('padding', 8);
                $(this).css('width', 50);
              });
              $('#table-3 thead').append(r);
              $('#search_0').css('text-align', 'center');
            },

            fnDrawCallback: function () {
                // prospectCB();
              }        
            });
          
          $('#table_example tfoot tr').appendTo('#table_example thead');
            table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
              if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
              }
            });
          });

          })
        
</script>