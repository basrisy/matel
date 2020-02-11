<div class="x_panel">
    <div class="x_title">
        <h2>DATA KENDARAAN</h2>
        <div style="float:right">
            <a href="<?=base_url();?>data/import" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i> Import File</a>
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
                    <th>#</th>
                    <th>PLAT</th>
                    <th>MODEL</th>
                    <th>WARNA</th>
                    <th>PEMILIK</th>
                    <th>SISA HUTANG</th>
                    <th>OVERDUE</th>
                    <th>NO RANGKA</th>                    
                    <th>NO MESIN</th>
                    <th>LEASING</th>
                    <th>CABANG</th>
                    <th>KET. DATA MASUK</th>
                    <th>CATATAN</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; 
                foreach($kendaraan->result() as $key) :
                ?>
                <tr>
                    <td><?= ++$no; ?></td>
                    <td><?= $key->plat; ?></td>
                    <td><?= $key->model; ?></td>
                    <td><?= $key->warna; ?></td>
                    <td><?= $key->pemilik; ?></td>
                    <td style="text-align:right"><?= number_format($key->sisa_hutang); ?></td>
                    <td><?= $key->overdue; ?></td>
                    <td><?= $key->no_rangka; ?></td>
                    <td><?= $key->no_mesin; ?></td>
                    <td><?= $key->leasing; ?></td>
                    <td><?= $key->cabang; ?></td>
                    <td><?= $key->ket_data_masuk; ?></td>
                    <td><?= $key->catatan; ?></td>
                    <td style="vertical-align:middle;text-align:center">
                        <a data-toggle="modal" data-target="#hapus<?=$key->id;?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fa fa-trash"></i> Hapus Data Ini</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Hapus Data -->
<?php foreach($kendaraan->result() as $key) :?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="hapus<?=$key->id;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Hapus Data Kendaraan</h4>
                <div class="clearfix"></div>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('data/hapus_kendaraan')?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $key->id; ?>">
                    <table class="table table-striped">
                        <tr>
                            <td style="width: 100px">Model</td>
                            <td>: <?= $key->model; ?></td>
                        </tr>
                        <tr>
                            <td>Plat</td>
                            <td>: <?= $key->plat; ?></td>
                        </tr>
                        <tr>
                            <td>Pemilik</td>
                            <td>: <?= $key->pemilik; ?></td>
                        </tr>
                        <tr>
                            <td>Sisa Hutang</td>
                            <td>: <?= number_format($key->sisa_hutang).",-"; ?></td>
                        </tr>
                        <tr>
                            <td>Overdue</td>
                            <td>: <?= $key->overdue; ?></td>
                        </tr>
                        <tr>
                            <td>Leasing</td>
                            <td>: <?= $key->leasing; ?></td>
                        </tr>
                        <tr>
                            <td>Cabang</td>
                            <td>: <?= $key->cabang; ?></td>
                        </tr>
                    </table>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Password Admin
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="password" class="form-control col-md-7 col-xs-12" name="password_admin">
                        <em class="help-text">* Masukkan Password <strong>admin</strong> untuk menghapus data.</em>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" name="submit" value="Submit" type="submit"><i class="fa fa-trash"></i> Hapus Data</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>