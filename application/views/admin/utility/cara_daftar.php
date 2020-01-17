
<div class="x_panel">
    <div class="x_title">
        <h2>CARA DAFTAR</h2>
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

        <?php foreach($cara_daftar->result() as $key) : ?>
        <form class="form" action="" method="post" enctype="multipart/form-data" role="form">
            <input id="id" name="id" type="hidden" value="<?php echo $key->id;?>">
            <textarea name="cara_daftar" class="ckeditor" id="ckedtor"><?php echo $key->konten;?></textarea>
        
            <div class="ln_solid"></div>
            <div class="form-group">
                <button class="btn btn-primary" name="submit" value="Submit" type="submit"><i class="fa fa-save"></i> Simpan&nbsp;</button>
                <a href="<?= base_url(); ?>utility" type="button" class="btn btn-dark"> Batal</a>
            </div>
        </form>
        <?php endforeach; ?>
    </div>
</div>