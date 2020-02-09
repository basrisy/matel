<div class="x_panel">
    <div class="x_title">
        <h2>USER TERDAFTAR</h2>
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
        <table id="tabledata" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username (Email)</th>
                    <th>Nama</th>
                    <th>Kota</th>
                    <th>Nomor Telepon</th>
                    <th>Tipe Akun</th>
                    <th>Masa Aktif</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                    <th>Terdaftar Pada</th>
                    <th>Tanggal Berakhir</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; 
                foreach($user_terdaftar->result() as $key) :
                    $masaaktif = $key->berakhir_pada;
                    $sekarang = date('d-m-Y h:i:s A');
                    $masaberlaku = strtotime($masaaktif) - strtotime($sekarang);
                    $sisahari = $masaberlaku/(24*60*60);
                ?>
                <tr>
                    <td><?= ++$no; ?></td>
                    <td><?= $key->email; ?></td>
                    <td><?= $key->nama; ?></td>
                    <td><?php foreach($kota->result() as $k){ if($key->id_kabupaten == $k->ID){ echo $k->NAMA; }}?></td>
                    <td><?= $key->no_hp; ?></td>
                    <td><?php foreach($level->result() as $l){ if($key->level == $l->id){ echo $l->tipe; }}?></td>
                    <td><?php if ($sisahari < 0) { echo "0 Hari"; } else { echo number_format($sisahari)." Hari"; }?></td>     
                    <td><?php if($key->status_aktif == 0 && $sisahari > 1) { echo "Aktif";} else if($key->status_aktif == 0 && $masaaktif > $sekarang) { echo "<p style='color: red;'>Habis Masa Aktif</p>";} else if($sisahari > 1){ echo "<p style='color: red;'>User Blokir</p>";} else { echo "Tidak Aktif";} ?></td>
                    <td>
                    <?php if($key->status_aktif == 1 && $sisahari < 1 ){ ?>
                        <a data-toggle="modal" data-target="#terima<?=$key->id;?>" style="width: 70px" class="btn btn-xs btn-primary" title="Terima"><i class="fa fa-check-square-o"></i> Terima</a>
                        <a href="<?=base_url();?>user/hapus_user/<?=$key->id;?>" style="width: 70px" class="btn btn-xs btn-danger" title="Tolak"><i class="fa fa-times"></i> Tolak</a>
                    <?php } ?>
                    <?php if($key->status_aktif == 0 ){ ?>
                        <a data-toggle="modal" data-target="#perpanjang<?=$key->id;?>" style="width: 70px" class="btn btn-xs btn-dark" title="Perbarui Masa Aktif"><i class="fa fa-clock-o"></i> Perbarui</a>
                        <a href="<?=base_url();?>user/status/<?=$key->id;?>" style="width: 70px" class="btn btn-xs btn-dark" title="Blokir User"><i class="fa fa-lock"></i> Blokir</a>
                    <?php } else if($key->status_aktif == 1 && $sisahari > 1){ ?>
                        <a data-toggle="modal" data-target="#perpanjang<?=$key->id;?>" style="width: 70px" class="btn btn-xs btn-dark" title="Aktifkan"><i class="fa fa-unlock"></i> Aktifkan</a>
                        <a href="<?=base_url();?>user/hapus_user/<?=$key->id;?>" style="width: 70px" class="btn btn-xs btn-danger" title="Hapus" onclick="return confirm('Yakin Ingin Menghapus Data ini ?')"><i class="fa fa-trash"></i> Hapus</a>
                    <?php } ?>
                    </td>
                    <td><?= date('d-m-Y h:i:s A', strtotime($key->terdaftar_pada)); ?></td>
                    <td><?= date('d-m-Y h:i:s A', strtotime($key->berakhir_pada)); ?></td>
                    <td><?= $key->alamat; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- modal terima -->
<?php foreach($user_terdaftar->result() AS $key): ?>
<div id="terima<?=$key->id;?>" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered"  role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Aktivasi User</h4>
            <div class="clearfix"></div>
        </div>
        <form class="form-horizontal" action="<?php echo base_url('user/set_terima')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $key->id; ?>">
                <table class="table table-striped">
                    <tr>
                        <td style="width: 30px">Nama</td>
                        <td>: <?= $key->nama; ?></td>
                    </tr>
                    <tr>
                        <td>Username/Email</td>
                        <td>: <?= $key->email; ?></td>
                    </tr>
                    <tr>
                        <td>Terdaftar Pada</td>
                        <td>: <?= date('d-m-Y h:i:s A', strtotime($key->terdaftar_pada)); ?></td>
                    </tr>
                </table>
                <div class="form-group">
                    Tipe Akun
                    <select name="level" class="form-control" autofocus/>
                        <option value="<?= $key->level; ?>" selected><?php foreach($level->result() as $l){ if($key->level == $l->id){ echo $l->tipe; }}?></option>
                        <?php foreach($level->result() as $row):?>
                        <option value="<?php echo $row->id;?>"><?php echo $row->tipe;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    Atur Tanggal Berakhir
                    <div class="form-group">
                        <div class='input-group date datepicker'>
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input type='text' name="tgl_akhir" class="form-control"/>
                        </div>
                    </div>
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

<!-- modal perbarui -->
<?php foreach($user_terdaftar->result() AS $key): 
    $masaaktif = $key->berakhir_pada;
    $sekarang = date('d-m-Y h:i:s A');
    $masaberlaku = strtotime($masaaktif) - strtotime($sekarang);
    $sisahari = $masaberlaku/(24*60*60);
?>
<div id="perpanjang<?=$key->id;?>" class="modal fade" data-backdrop="false" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered"  role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Perpanjang Masa Aktif</h4>
            <div class="clearfix"></div>
        </div>
        <form class="form-horizontal" action="<?php echo base_url('user/set_terima')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $key->id; ?>">
                <table class="table table-striped">
                    <tr>
                        <td style="width: 30px">Nama</td>
                        <td>: <?= $key->nama; ?></td>
                    </tr>
                    <tr>
                        <td>Username/Email</td>
                        <td>: <?= $key->email; ?></td>
                    </tr>
                    <tr>
                        <td>Terdaftar Pada</td>
                        <td>: <?= date('d-m-Y h:i:s A', strtotime($key->terdaftar_pada)); ?></td>
                    </tr>
                    <tr>
                        <td>Masa Aktif</td>
                        <td>: <?php if ($sisahari < 0) { echo "0 Hari"; } else { echo number_format($sisahari)." Hari"; }?></td>
                    </tr>
                </table>
                <div class="form-group">
                    Tipe Akun
                    <select name="level" class="form-control" autofocus/>
                        <option value="<?= $key->level; ?>" selected><?php foreach($level->result() as $l){ if($key->level == $l->id){ echo $l->tipe; }}?></option>
                        <?php foreach($level->result() as $row):?>
                        <option value="<?php echo $row->id;?>"><?php echo $row->tipe;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    Atur Tanggal Berakhir
                    <div class="form-group">
                        <div class='input-group date datepicker'>
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input type='text' name="tgl_akhir" class="form-control" value="<?= date('Y-m-d', strtotime($key->berakhir_pada)); ?>"/>
                        </div>
                    </div>
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