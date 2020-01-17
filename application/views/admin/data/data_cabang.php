<div class="x_panel">
    <div class="x_title">
        <h2>DATA CABANG</h2>
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
        <table id="tabledata" class="table table-striped table-bordered table-responsive nowrap">
            <thead>
                <tr>
                    <th style="vertical-align:middle;width:20px">#</th>
                    <th style="vertical-align:middle;width:50px">ID Cabang</th>
                    <th>Nama Cabang</th>
                    <th style="vertical-align:middle;text-align:center;width:30px">Tindakan</th>
                </tr>
            </thead>
            <tbody>
            <?php $no = 0; 
            foreach($cabang->result() as $key) :
            ?>
                <tr>
                    <td><?= ++$no; ?></td>
                    <td><b><?= $key->id_cabang; ?></b></td>
                    <td><?= $key->cabang; ?></td>
                    <td style="vertical-align:middle;text-align:center">
                        <a data-toggle="modal" data-target="#edit<?=$key->id_cabang;?>" class="btn btn-xs btn-warning" title="Perbarui"><i class="fa fa-edit"></i> Edit</a>
                        <a href="<?=base_url();?>data/hapus_cabang/<?=$key->id_cabang;?>" class="btn btn-xs btn-danger" title="Hapus" onclick="return confirm('Yakin Ingin Menghapus Data ini ?')"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit-->
<?php foreach($cabang->result() AS $key): ?>
<div id="edit<?=$key->id_cabang;?>" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Edit Cabang</h4>
            <div class="clearfix"></div>
        </div>
        <form class="form-horizontal" action="<?php echo base_url('data/edit_cabang')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
            <div class="form-group">
                Nama Cabang
                <input type="hidden" name="id" value="<?= $key->id_cabang; ?>">
                <input type="text" name="cabang" value="<?= $key->cabang; ?>" style="text-transform:uppercase"  onkeyup="this.value = this.value.toUpperCase()" class="form-control">
            </div>
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