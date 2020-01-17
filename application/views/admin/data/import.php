<div class="x_panel">
    <div class="x_title">
        <h2>IMPORT DATA</h2>
        <div class="clearfix"></div>
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
    </div>
    <div class="x_content">
        <a href="<?=base_url();?>assets/file/FORMAT FILE IMPORT.xlsx" class="btn btn-dark" title="Import Data"><i class="glyphicon glyphicon-download-alt"></i> Download File</a>
        <div class="ln_solid"></div>
        <form method="post" action="<?php echo base_url("data/importFile"); ?>" enctype="multipart/form-data">
        <div class="input-group">
            <input type="file" name="uploadFile" class="form-control">
            <span class="input-group-btn">
                <button name="submit" value="Upload" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i> Import File</button>
            </span>
        </div>
        </form>
    </div>
</div>
