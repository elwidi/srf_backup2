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
                <h2>Upload File</h2>
                <div class="pull-right">
                    <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer'; ?>">List</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                
                <?php if($this->session->flashdata('status')!=null) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
                        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
                    </div>
                <?php } ?>
                
                <form class="form-horizontal form-label-left" novalidate method="post" enctype="multipart/form-data" action="<?php echo base_url().'customer/upload_po/'.$customer_id; ?>">

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Company Name *
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" class="form-control" disabled="">
                            <input type="hidden" id="customer_id" name="customer_id" class="form-control" value = "<?php echo $customer_id?>">
                            <?php echo form_error('name', '<span class="help-block" style="color: red">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File PO
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" name = "PO" data-edit="insertImage" />
                                <span class = "help-block hidden po_file"><span class = "fa fa-paperclip"></span><a class = "po_link" target="_blank"></a></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File KTP
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" name = "KTP" data-edit="insertImage" />
                                <span class = "help-block hidden ktp_file"><span class = "fa fa-paperclip"></span><a class = "ktp_link" target="_blank"></a></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File NPWP
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" name = "NPWP" data-edit="insertImage" />
                                <span class = "help-block hidden npwp_file"><span class = "fa fa-paperclip"></span><a class = "npwp_link" target="_blank"></a></span>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-default" onclick=location.href="<?php echo base_url().'customer'; ?>"><span class="fa fa-reply"></span> Back</button>
                            <input id="btnsave" name="btnsave" value="Save" type="submit" class="btn btn-success" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
            
    </div>
</div>

<script>
    $(function() {
        var customer_id = $('#customer_id').val();
        console.log(customer_id);
        $.ajax({
            url : '/customer/file',
            type : "POST", 
            dataType : "json", 
            data : {id : customer_id},
            async : false,
            success : function(res){
                if(res.status == '200'){
                    var data = res.data;
                    $('#name').val(data.name);
                    var file = data.file;
                    $.each(file, function(i, d){
                        var span = "."+ i.toLowerCase() + "_file";
                        var link = "."+ i.toLowerCase() + "_link";
                        $(span).removeClass('hidden');
                        $(link).attr("href", "<?php echo base_url()?>"+d.path+d.file);
                        $(link).html(d.file);
                    })

                }
            }

        })
    })
</script>