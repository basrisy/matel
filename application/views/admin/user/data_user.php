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
        <table id="tabledata" class="dt-responsive row-border nowrap display" style="width:100%">
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
                foreach($data->result() as $key) :
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
                    <td><?php if($key->status_aktif == 0 && $sisahari > 0) { echo "Aktif";} else if($key->status_aktif == 0 && $masaaktif < $sekarang) { echo "<a style='color: red;'>Habis Masa Aktif</a>";} else { echo "Tidak Aktif";} ?></td>
                    <td>
                        <a data-toggle="modal" data-target="#perpanjang<?=$key->id;?>" style="width: 70px" class="btn btn-xs btn-dark" title="Perbarui Masa Aktif"><i class="fa fa-clock-o"></i> Perbarui</a>
                        <a href="<?=base_url();?>user/blokir/<?=$key->id;?>" style="width: 70px" class="btn btn-xs btn-dark" title="Blokir User"><i class="fa fa-lock"></i> Blokir</a>
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

<!-- modal perbarui -->
<?php foreach($data->result() AS $key): 
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
        <form class="form-horizontal" action="<?php echo base_url('user/perbarui')?>" method="post" enctype="multipart/form-data" role="form">
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $key->id; ?>">
                <input type="hidden" name="nama" value="<?= $key->nama; ?>">
                    <input type="hidden" name="level_lama" value="<?php foreach($level->result() as $l){ if($key->level == $l->id){ echo $l->tipe; }}?>">
                <table class="table table-striped">
                    <tr>
                        <td style="width: 150px">Nama</td>
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
                    <tr>
                        <td>Tipe Akun</td>
                        <td>
                            <select name="level" class="form-control" autofocus/>
                                <option value="<?= $key->level; ?>" selected><?php foreach($level->result() as $l){ if($key->level == $l->id){ echo $l->tipe; }}?></option>
                                <?php foreach($level->result() as $row):?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->tipe;?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Atur Tanggal Berakhir</td>
                        <td>
                            <div class='input-group date datepicker'>
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                <input type='text' name="tgl_akhir" class="form-control" value="<?= date('Y-m-d', strtotime($key->berakhir_pada)); ?>"/>
                            </div>
                        </td>
                    </tr>
                </table>
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