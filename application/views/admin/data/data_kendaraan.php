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
                    <?php if($admin == "1"){ echo "<th>OPSI</th>"; } ?>                    
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>