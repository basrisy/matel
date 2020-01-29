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
        <a data-toggle="modal" data-target="#pilih" class="btn btn-success" title="Import Data"><i class="glyphicon glyphicon-import"></i> Pilih Cabang & Leasing</a>
        <div class="ln_solid"></div>
        <table class="table table-striped">
            <tr>
                <td style="width: 40px">Cabang</td>
                <td>: <?php echo $this->session->userdata('cabang'); ?></td>
            </tr>
            <tr>
                <td>Leasing</td>
                <td>: <?php echo $this->session->userdata('leasing'); ?></td>
            </tr>
        </table>
        <?php if ($this->session->userdata('cabang')) { ?>
        <form method="post" action="<?php echo base_url("data/preview"); ?>" enctype="multipart/form-data">
        <div class="input-group">
            <input type="file" name="uploadFile" class="form-control">
            <span class="input-group-btn">
                <button name="preview" value="Preview" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-check"></i> Preview</button>
            </span>
        </div>
        </form>
        <?php } ?>
    </div>
</div>

<!-- Import -->
<div id="pilih" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Import Data Kendaraan</h4>
            <div class="clearfix"></div>
        </div>
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
                <div class="form-group">
                    Cabang
                    <select id="id_cabang" name="id_cabang" class="form-control required" required/>
                        <option value="" selected>-- Pilih Cabang --</option>
                        <?php foreach($cabang->result() as $row):?>
                        <option value="<?php echo $row->id_cabang;?>"><?php echo $row->cabang;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    Nama Leasing
                    <select id="id_leasing" name="id_leasing" class="form-control required" required/>
                        <option value="" selected>-- Pilih Leasing --</option>
                        <!-- <?php foreach($leasing->result() as $row):?>
                        <option value="<?php echo $row->id_leasing;?>"><?php echo $row->leasing;?></option>
                        <?php endforeach;?> -->
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-success" name="submit" value="Submit" type="submit"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-history"></i> Batal</button>
            </div>
        </form>
        </div>
    </div>
</div>