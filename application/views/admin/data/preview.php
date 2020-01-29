<div class="x_panel">
    <div class="x_title">
        <h2>IMPORT DATA KENDARAAN</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <table class="table table-striped">
            <tr>
                <td style="width: 40px">Cabang</td>
                <td>: <?php echo $this->session->userdata('cabang'); ?></td>
            </tr>
            <tr>
                <td>Leasing</td>
                <td>: <?php echo $this->session->userdata('leasing'); ?></td>
            </tr>
        </table>
        <form action="<?php echo base_url('data/importFile')?>" enctype="multipart/form-data" method="post">
        <button name="submit" value="Submit" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i> Import File</button>
        <a href="<?=base_url();?>data/batal" type="submit" class="btn btn-dark"><i class="fa fa-history"></i> Batal</a>
        <div class="ln_solid"></div>
            <table id="tabledata" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PEMILIK</th>
                        <th>MODEL</th>
                        <th>NO RANGKA</th>              
                        <th>NO MESIN</th> 
                        <th>PLAT</th>
                        <th>OVERDUE</th>     
                        <th>WARNA</th>   
                        <th>TAHUN</th>
                        <th>BULAN UPDATE</th>
                        <th>CATATAN</th>
                        <th>SISA HUTANG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0; 
                    $flag = true;
                    $i=0; 
                    foreach ($allDataInSheet as $value) { 
                        if($flag) {
                            $flag = false;
                            continue;
                        }
                    ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $inserdata[$i]['`KONSUMEN`'] = $value['A']; ?></td>
                        <td><?= $inserdata[$i]['`UNIT`'] = $value['B']; ?></td>
                        <td><?= $inserdata[$i]['`NO_RANGKA`'] = $value['C']; ?></td>
                        <td><?= $inserdata[$i]['`NO_MESIN`'] = $value['D']; ?></td>
                        <td><?= $inserdata[$i]['`NO_POL`'] = $value['E']; ?></td>
                        <td><?= $inserdata[$i]['`OD`'] = $value['F']; ?></td>
                        <td><?= $inserdata[$i]['`WARNA`'] = $value['G']; ?></td>
                        <td><?= $inserdata[$i]['`TAHUN`'] = $value['H']; ?></td>
                        <td><?= $inserdata[$i]['`BULAN_UPDATE`'] = $value['I']; ?></td>
                        <td><?= $inserdata[$i]['`CATATAN`'] = $value['J']; ?></td>
                        <td style="text-align:right"><?= $inserdata[$i]['`SISA_HUTANG`'] = $value['K']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
</div>