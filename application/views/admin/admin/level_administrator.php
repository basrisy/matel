<div class="x_panel">
    <div class="x_title">
        <h2>LEVEL ADMISTRATOR</h2>
        <div style="float:right">
            <a data-toggle="modal" data-target="#tambah" class="btn btn-sm btn-primary" title="Tambah"><i class="fa fa-plus-square"></i> Level</a>
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
        <table id="tabledata" class="dt-responsive row-border nowrap display" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 20px">#</th>
                    <th>Level</th>
                    <th style="width: 20px">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; 
                foreach($data->result() as $key) :
                ?>
                <tr>
                    <td><?= ++$no; ?></td>
                    <td><?= $key->nama; ?></td>
                    <td>
                        <a data-toggle="modal" data-target="#edit<?=$key->id;?>" class="btn btn-xs btn-warning" title="Edit Data"><i class="fa fa-pencil"></i> Edir</a>
                        <a href="<?=base_url();?>administrator/del_level/<?=$key->id;?>" class="btn btn-xs btn-danger" title="Hapus Data" onclick="return confirm('Yakin Ingin Menghapus Data ini ?')"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Level-->
<div id="tambah" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Tambah Level</h4>
                <div class="clearfix"></div>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('administrator/level')?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    Level Administrator
                    <div class="form-group">
                        <input type="text" style="text-transform:uppercase"  onkeyup="this.value = this.value.toUpperCase()" class="form-control" name="level" autofocus/>
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

<!-- Modal Edit Level-->
<?php foreach($data->result() AS $key): ?>
<div id="edit<?=$key->id;?>" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Edit Nama Level</h4>
            <div class="clearfix"></div>
        </div>
        <form class="form-horizontal" action="<?php echo base_url('administrator/edit_level')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
            <div class="form-group">
                Level Admin
                <input type="hidden" name="id" value="<?= $key->id; ?>">
                <input type="text" name="level" value="<?= $key->nama; ?>" style="text-transform:uppercase"  onkeyup="this.value = this.value.toUpperCase()" class="form-control">
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