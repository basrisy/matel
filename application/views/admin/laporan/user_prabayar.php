<div class="x_panel">
    <div class="x_title">
        <h2>LAPORAN USER PRABAYAR</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_conten">
        <form class="row" action="" method="post">
            <div class="col-md-3">
                <div class='input-group date datepicker'>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input id="tgl_mulai" placeholder="Dari Tanggal" type="text" class="form-control" name="tgl_mulai" value="<?= $tgl_mulai;?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class='input-group date datepicker'>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    <input id="tgl_akhir" placeholder="Sampai Tanggal" type="text" class="form-control " name="tgl_akhir" value="<?= $tgl_akhir;?>">
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" name="submit" value="Submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Cari</button>
            </div>
        </form>
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
        <center><h2>Periode <?= date('d M Y', strtotime($tgl_mulai)); ?> s/d <?= date('d M Y', strtotime($tgl_akhir)); ?></h2></center>
        <table class="dt-responsive stripe nowrap display" id="tabledata" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Aktivasi</th>
                    <th>Keterangan</th>
                    <th>Username (Email)</th>
                    <th>Nama</th>
                    <th>Kota</th>
                    <th>Nomor Telepon</th>
                    <th>Tipe Akun</th>
                    <th>Masa Aktif</th>
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
                    <td><?= date('d-m-Y h:i:s A', strtotime($key->time)); ?></td>
                    <td><?= $key->aksi; ?></td>
                    <td><?= $key->email; ?></td>
                    <td><?= $key->nama; ?></td>
                    <td><?php foreach($kota->result() as $k){ if($key->id_kabupaten == $k->ID){ echo $k->NAMA; }}?></td>
                    <td><?= $key->no_hp; ?></td>
                    <td><?= $key->level;?></td>
                    <td><?php if ($sisahari < 0) { echo "0 Hari"; } else { echo number_format($sisahari)." Hari"; }?></td>
                    <td><?= $key->alamat; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
