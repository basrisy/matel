<div class="x_panel">
    <div class="x_title">
        <h2>IMPORT DATA KENDARAAN</h2>
        <div style="float: right">            
            <a href="<?=base_url();?>data/batal" type="submit" class="btn btn-default"><i class="fa fa-history"></i> Batal</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form action="<?php echo base_url('data/importFile')?>" enctype="multipart/form-data" method="post">
            <table id="preview" class="dt-responsive row-border nowrap display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PEMILIK</th>
                        <th>MODEL</th>
                        <th>NO RANGKA</th>              
                        <th>NO MESIN</th> 
                        <th>PLAT</th>
                        <th>LEASING</th>
                        <th>CABANG</th>
                        <th>WARNA</th>   
                        <th>TAHUN</th>
                        <th>BULAN UPDATE</th>
                        <th>OVERDUE</th>  
                        <th>SISA HUTANG</th>  
                        <th>CATATAN</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <p>Data Sama : <?= $ttl_sama; ?></p>
            <p>Data Tidak Lengkap : <?= $kosong; ?></p>
            <?php if($kosong < 1 ){ ?>
                <div class="ln_solid"></div>
                <a href="<?=base_url();?>data/importFile" class="btn btn-primary" title="Insert data"><i class="glyphicon glyphicon-import"></i> Insert</a>
                <a href="<?=base_url();?>data/importFileUpdate" class="btn btn-success" title="Insert dan Update data"><i class="glyphicon glyphicon-save-file"></i> Insert/Update</a>
            <?php } else { ?>                
                <p style='color: red;' >Note : Data UNIT/MODEL, NO.POLISI/PLAT dan LEASING harus terisi.</p>
            <?php }?>
        </form>
    </div>
</div>