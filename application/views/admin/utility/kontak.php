<div class="x_panel">
    <div class="x_title">
        <h2>KONTAK</h2>
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
        <?php foreach($data->result() AS $key): ?>
            <div class="col-lg-1 col-sm-1 col-xs-12">
                <img src="<?= base_url(); ?>assets/image/<?= $key->icon; ?>" style="width:50%">
            </div>
            <div class="col-lg-1 col-sm-1 col-xs-12">
                <p><?= $key->tipe; ?></p>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <p><?= $key->direct; ?></p>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <p><?= $key->pesan; ?></p>
            </div>
            <div class="col-lg-1 col-sm-1 col-xs-12">
            <a data-toggle="modal" data-target="#update<?=$key->id;?>" class="btn btn-sm btn-success" title="Update"><i class="fa fa-pencil"></i> Update</a>
            </div>
        <?php endforeach; ?>
        <h3>Note:</h3>
        <p>- Nomor WhatsApp harus menggunakan <b>62</b></p>
    </div>
</div>

<!-- modal terima -->
<?php foreach($data->result() AS $key): ?>
<div id="update<?=$key->id;?>" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Update Data <?= $key->tipe; ?></h4>
                <div class="clearfix"></div>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('utility/set_kontak')?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $key->id; ?>">
                    <div class="form-group">
                        <input type='text' name="direct" value="<?= $key->direct; ?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        Pesan
                        <div class="form-group">
                            <textarea type='text' name="pesan" class="form-control"><?= $key->pesan; ?></textarea>
                        </div>
                    </div>
                    <?php if($key->tipe == 'wa') { ?>
                        <h3>Note:</h3>
                        <p>- Nomor WhatsApp harus menggunakan <b>62</b></p>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" name="submit" value="Submit" type="submit"> Simpan&nbsp;</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>