<div class="x_panel">
    <div class="x_title">
        <h2>DAFTAR LEASING</h2>
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
                    <th>Leasing</th>
                    <th>Cabang</th>
                    <th style="vertical-align:middle;text-align:center;width:30px">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; 
                foreach($leasing->result() as $key) :
                ?>
                <tr>
                    <td><?= ++$no; ?></td>
                    <td><b><?= $key->leasing; ?></b></td>
                    <td><?php foreach($cabang->result() as $k){ if($key->id_cabang == $k->id_cabang){ echo $k->cabang; }}?></td>
                    <td style="vertical-align:middle;text-align:center">
                        <a data-toggle="modal" data-target="#edit<?=$key->id_leasing;?>" class="btn btn-xs btn-warning" title="Perbarui"><i class="fa fa-edit"></i> Edit</a>
                        <a href="<?=base_url();?>data/hapus_leasing/<?=$key->id_leasing;?>" class="btn btn-xs btn-danger" title="Hapus" onclick="return confirm('Yakin Ingin Menghapus Data ini ?')"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Edit-->
<?php foreach($leasing->result() AS $key): ?>
<div id="edit<?=$key->id_leasing;?>" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Edit Leasing</h4>
            <div class="clearfix"></div>
        </div>
        <form class="form-horizontal" action="<?php echo base_url('data/edit_leasing')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
                <div class="form-group">
                    Nama Cabang
                    <input type="hidden" name="id" value="<?= $key->id_leasing; ?>">
                    <input type="text" name="leasing" value="<?= $key->leasing; ?>" style="text-transform:uppercase"  onkeyup="this.value = this.value.toUpperCase()" class="form-control">
                </div>
                <div class="form-group">
                    Cabang
                    <select id="id_cabang" name="id_cabang" class="form-control required" required/>
                        <option value="<?= $key->id_cabang; ?>" selected><?php foreach($cabang->result() as $k){ if($key->id_cabang == $k->id_cabang){ echo $k->cabang; }}?></option>
                        <?php foreach($cabang->result() as $row):?>
                        <option value="<?php echo $row->id_cabang;?>"><?php echo $row->cabang;?></option>
                        <?php endforeach;?>
                    </select>
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