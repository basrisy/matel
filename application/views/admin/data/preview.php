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
            <table id="tabledata" class="dt-responsive row-border nowrap display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PEMILIK</th>
                        <th>MODEL</th>
                        <th>NO RANGKA</th>              
                        <th>NO MESIN</th> 
                        <th>PLAT</th>
                        <th>LEASING</th> 
                        <th>WARNA</th>   
                        <th>TAHUN</th>
                        <th>BULAN UPDATE</th>
                        <th>OVERDUE</th>    
                        <th>CATATAN</th>
                        <th>SISA HUTANG</th>
                        <th>CABANG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no=0; 
                        $kosong = 0;
                        foreach ($data_temp as $key) : 

                        $unit = ($key->UNIT)? "" : " style='background: #EABBB0;'";
                        $no_pol = ($key->NO_POL)? "" : " style='background: #EABBB0;'";
                        $leasing = ($key->LEASING)? "" : " style='background: #EABBB0;'";
                        // $dataSama = ($data_sama)? : " style='background: #fff968;'";
                        if($unit || $no_pol || $leasing){
                            $kosong++;
                        }
                    ?>
                    <tr>
                        <td><?php echo ++$no; ?></td>
                        <td><?php echo $key->KONSUMEN; ?></td>
                        <td <?= $unit; ?>><?php echo $key->UNIT; ?></td>
                        <td><?php echo $key->NO_RANGKA; ?></td>
                        <td><?php echo $key->NO_MESIN; ?></td>
                        <td <?= $no_pol; ?>><?php echo $key->NO_POL; ?></td>
                        <td <?= $leasing; ?>><?php echo $key->LEASING; ?></td>
                        <td><?php echo $key->WARNA; ?></td>
                        <td><?php echo $key->TAHUN; ?></td>
                        <td><?php echo $key->BULAN_UPDATE; ?></td>
                        <td><?php echo $key->OD; ?></td>
                        <td><?php echo $key->CATATAN; ?></td>
                        <td style="text-align:right"><?php echo number_format($key->SISA_HUTANG); ?></td>
                        <td><?php echo $key->CABANG; ?></td>
                    </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <p>Data Sama : <?= $ttl_sama-$kosong; ?></p>
            <p>Data Tidak Lengkap : <?= $kosong; ?></p>
            <?php if($kosong <= 0 ){ ?>
                <p style='color: red;' >Note : Data UNIT, NO.POLISI dan LEASING harus terisi.</p>
                <div class="ln_solid"></div>
                <a href="<?=base_url();?>data/importFile" class="btn btn-primary" title="Insert data"><i class="glyphicon glyphicon-import"></i> Insert</a>
                <a href="<?=base_url();?>data/importFileUpdate" class="btn btn-success" title="Insert dan Update data"><i class="glyphicon glyphicon-save-file"></i> Insert/Update</a>
            <?php } ?>
        </form>
    </div>
</div>