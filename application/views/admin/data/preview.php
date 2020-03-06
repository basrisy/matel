<div class="x_panel">
    <div class="x_title">
        <h2>IMPORT DATA KENDARAAN</h2>
        <div style="float: right">            
            <a href="<?=base_url();?>data/batal" type="submit" class="btn btn-default"><i class="fa fa-history"></i> Batal</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <!-- <table class="table table-striped">
            <tr>
                <td style="width: 40px">Cabang</td>
                <td>: <?php echo $this->session->userdata('cabang'); ?></td>
            </tr>
            <tr>
                <td>Leasing</td>
                <td>: <?php echo $this->session->userdata('leasing'); ?></td>
            </tr>
        </table> -->
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
                        $flag = true;
                        $kosong = 0;
                        $duplikat = true;
                        foreach ($allDataInSheet as $value) { 
                        if($flag) {
                            $flag = false;
                            continue;
                        }
                        $unit = ($value['B'])? "" : " style='background: #EABBB0;'";
                        $no_pol = ($value['E'])? "" : " style='background: #EABBB0;'";
                        $leasing = ($value['L'])? "" : " style='background: #EABBB0;'";
                        if($unit || $no_pol || $leasing){
                            $kosong++;
                        }
                    ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $value['A']; ?></td>
                        <td <?= $unit; ?>><?= $value['B']; ?></td>
                        <td><?= $value['C']; ?></td>
                        <td><?= $value['D']; ?></td>
                        <td <?= $no_pol; ?>><?= $value['E']; ?></td>
                        <td <?= $leasing; ?>><?= $value['L']; ?></td>
                        <td><?= $value['G']; ?></td>
                        <td><?= $value['H']; ?></td>
                        <td><?= $value['I']; ?></td>
                        <td><?= $value['F']; ?></td>
                        <td><?= $value['J']; ?></td>
                        <td style="text-align:right"><?=number_format($value['K']); ?></td>
                        <td><?= $value['M']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if($kosong > 0 ){ ?>                
            <?php echo "<div style='color: red;'> Data belum lengkap, Ada <b>$kosong</b> data yang belum diisi.</div> <p>Data UNIT, NO.POLISI dan LEASING harus terisi.</p>"; ?>
            <?php } else { ?>
            <div class="ln_solid"></div>
            <button name="submit" value="Submit" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i> Import File</button>
            <?php } ?>
        </form>
    </div>
</div>