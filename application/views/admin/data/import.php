<div class="x_panel">
    <div class="x_title">
        <h2>IMPORT DATA</h2>
        <div style="float:right">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div id="alerts">
            <?php if($this->session->flashdata('success')) {
                echo '<div class="alert alert-success alert-message">';
                echo $this->session->flashdata('success');
                echo '</div>';
            } ?>
            <?php if($this->session->flashdata('warning')) {
                echo '<div class="alert alert-warning alert-message">';
                echo $this->session->flashdata('warning');
                echo '</div>';
            } ?>
            <?php if($this->session->flashdata('danger')) {
                echo '<div class="alert alert-danger alert-message">';
                echo $this->session->flashdata('danger');
                echo '</div>';
            } ?>
        </div>
        <p>Untuk file importnya, silahkan download terlebih dahulu</p>
        <a href="<?=base_url();?>assets/file/DATA KENDARAAN - One Matel Indonesia.xlsx" class="btn btn-dark" title="Download File"><i class="glyphicon glyphicon-download-alt"></i> Download File</a>
        <div class="ln_solid"></div>
        <form method="post" action="<?php echo base_url("data/preview"); ?>" enctype="multipart/form-data">        
        <?php if(!empty($file)){ ?>
            <p>Terdapat File Import yang belum selesai..!</p>
            <a data-toggle="modal" data-target="#cekFileImport" class="btn btn-info btn-block" title="Cek File Import"><i class="fa fa-check"></i> Cek File Import</a>
        <?php } else { ?>
            <div class="input-group">
                <input type="file" name="uploadFile" class="form-control">
                <span class="input-group-btn">
                    <button name="preview" value="Preview" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-check"></i> Preview</button>
                </span>
            </div>
        <?php } ?>
        </form>
    </div>
</div>

<div id="cekFileImport" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Cek File Import</h4>
            <div class="clearfix"></div>
        </div>
            <div class="modal-body">
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <strong>Terdapat File Import</strong> yang belum selesai..!
            </div>
            </div>
            <div class="modal-footer">
                <a href="<?=base_url();?>data/preview2" class="btn btn-primary" title="Selesaikan"><i class="fa fa-check-square-o"></i> Selesaikan</a>
                <a href="<?=base_url();?>data/batal" class="btn btn-danger" title="Hapus/Batal"><i class="fa fa-times"></i> Hapus</a>
            </div>
        </form>
        </div>
    </div>
</div>