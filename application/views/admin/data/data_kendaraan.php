<div class="x_panel">
    <div class="x_title">
        <h2>DATA KENDARAAN</h2>
        <div style="float:right">
            <a href="<?php echo base_url();?>data/import" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i> Import File</a>
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
        <table id="table" class="dt-responsive row-border nowrap display" style="width:100%">
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
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Hapus Data -->
<?php foreach($kendaraan as $key) :?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="hapus<?php echo $key->ID;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Hapus Data Kendaraan</h4>
                <div class="clearfix"></div>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('data/hapus_kendaraan')?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $key->ID; ?>">
                    <table class="table table-striped">
                        <tr>
                            <td style="width: 100px">Model</td>
                            <td>: <?php echo $key->MODEL; ?></td>
                        </tr>
                        <tr>
                            <td>Plat</td>
                            <td>: <?php echo $key->NO_POL; ?></td>
                        </tr>
                        <tr>
                            <td>Pemilik</td>
                            <td>: <?php echo $key->KONSUMEN; ?></td>
                        </tr>
                        <tr>
                            <td>Sisa Hutang</td>
                            <td>: <?php echo number_format($key->SISA_HUTANG).",-"; ?></td>
                        </tr>
                        <tr>
                            <td>Overdue</td>
                            <td>: <?php echo $key->OD; ?></td>
                        </tr>
                        <tr>
                            <td>Leasing</td>
                            <td>: <?php echo $key->LEASING; ?></td>
                        </tr>
                        <tr>
                            <td>Cabang</td>
                            <td>: <?php echo $key->CABANG; ?></td>
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

<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        //datatables

    });
</script>