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
        <form id="form-filter" class="form-horizontal">
            <div class="row">
                <div class="col-md-3 columns">
                    <label for="update_at">Tanggal</label>
                    <?php echo $form_update; ?>
                </div>
                <div class="col-md-2 columns">
                    <label for="leasing">Leasing</label>
                    <?php echo $form_leasing; ?>
                </div>
                <div class="col-md-2 columns">
                    <label for="cabang">Cabang</label>
                    <?php echo $form_cabang; ?>
                </div>
            </div><br />
            <div class="row">
                <div class="col-md-12 columns">
                    <button type="button" id="btn-filter" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                    <button type="button" id="btn-delete" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data Filter</button>
                    <button type="button" id="btn-reset" class="btn btn-default"><i class="fa fa-history"></i> Refresh</button>
                    <input type="button" id='delete_record' value='Hapus Data Cheklist' class="btn btn-dark pull-right">
                </div>
            </div><br />
        </form>
        <table id="table" class="dt-responsive row-border nowrap display" cellspacing="0"  style="width:100%">
            <thead>
                <tr>
                    <!-- <th><input type="checkbox" class="form-control check_all"/></th> -->
                    <th></th>
                    <th><input type="checkbox" class='checkall' id='checkall'></th>
                    <th>TGL UPDATE</th>
                    <th>LEASING</th>
                    <th>CABANG</th>
                    <th>PEMILIK</th>
                    <th>PLAT</th>
                    <th>MODEL</th>
                    <th>WARNA</th>
                    <th>SISA HUTANG</th>
                    <th>OVERDUE</th>
                    <th>NO RANGKA</th>                    
                    <th>NO MESIN</th>
                    <th>KET. DATA MASUK</th>
                    <th>CATATAN</th>
                    <?php if($admin == "1"){ echo "<th>OPSI</th>"; } ?>                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>