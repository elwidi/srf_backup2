<?php if($this->session->flashdata('status')!=null) { ?>
    <div class="alert alert-<?php echo $this->session->flashdata('status'); ?> align-center text-center">
        <strong><?php echo $this->session->flashdata('pesan'); ?></strong>
    </div>
<?php } ?>

<form id="formreport" class="form-horizontal form-label-left" method="post" onsubmit="return submitDataReport()" > 

    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>" />
    <input type="hidden" id="iter_bast" value="<?php echo ($rbast!=null) ? '1' : '2'; ?>" />

    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="company_name">Date *
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" id="date" name="date" class="form-control col-md-7 col-xs-12 single_date" required="" value="<?php echo set_value('date', ($r['date']!=null) ? date('d/m/Y', strtotime($r['date'])) : date('d/m/Y') ); ?>" style="z-index: 9999 !important;"  />
            <?php echo form_error('date', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="pks">PKS *
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
        <?php echo ($r['date']!=null) ? '<label><a href="'.base_url().'data/pks/'.$r['pks'].'" target="_blank" title="PKS File">'.$r['pks'].'</a></label><br />' : ''; ?>
            <input type="file" id="pks" name="pks" <?php echo ($r['pks']!=null) ? '' : 'required="required"'; ?> class="form-control"> <?php echo ($r['pks']!=null) ? '<span style="color:orange;">leave blank if not changed.</span>' : ''; ?> (max : 3MB) 
            <input type="hidden" name="pks_old" id="pks_old" value="<?php echo $r['pks']; ?>" />
            <?php echo form_error('pks', '<span class="help-block" style="color: red">', '</span>'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">BAST <span class="required">*</span></label>
        <button type="button" class="btn btn-sm bg-green waves-effect" onclick="add_bast();">
            Add
        </button>
        
        <?php if($rbast!=null) { ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped" id="exist_bast" style="width: 100%;">
                <tbody>
                <?php
                $i = 0;
                foreach($rbast->result() as $rec)
                {
                ?>
                <tr>
                    <td>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="<?php echo base_url().'data/bast/'.$rec->file; ?>" target="_blank" title="Photo Bast"><?php echo $rec->file; ?></a>
                                <input type="hidden" id="filebast_<?php echo $i; ?>" name="filebast_<?php echo $i; ?>" value="<?php echo $rec->file; ?>" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="hidden" id="id_bast_<?php echo $i; ?>" name="id_bast_<?php echo $i; ?>" value="<?php echo $rec->id; ?>" />
                        <span><button id="btnDeleteBast<?php echo $i; ?>" type="button" class="btn btn-sm bg-red waves-effect" onclick="deleteBast(<?php echo $i; ?>);"><i class="material-icons">delete</i></button></span>
                    </td>
                </tr>
                <?php
                    $i++;
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php } ?>

        <input type="hidden" id="jumlah_bast" name="jumlah_bast" value="<?php echo ($rbast==null) ? '1' : '0'; ?>" />
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped" id="tabel_bast" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Upload Files (max : 1MB per file) (filetype : jpg|png|jpeg|gif)</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($rbast==null) { ?>
                    <tr>
                        <td>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="file_1" name="file_1" required="required" class="form-control">
                                    <?php echo form_error('file_1', '<span class="help-block" style="color: red">', '</span>'); ?>
                                </div>
                            </div>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input id="btnsavereport" name="btnsave" value="Save" type="submit" class="btn btn-success"/>
        </div>
    </div>
</form>