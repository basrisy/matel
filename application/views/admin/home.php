
<div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-gift"></i></div>
        <div class="count"><?= number_formation($user_prabayar);?></div>
        <h3>Aktivasi Prabayar</h3>
        <p>Periode 1 Bulan.</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-quote-left"></i></div>
        <div class="count"><?= number_formation($user_free);?></div>
        <h3>Aktivasi User Free</h3>
        <p>Periode 1 Bulan.</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-users"></i></div>
        <div class="count"><?= number_formation($jml_user);?></div>
        <h3>Jumlah User</h3>
        <p>Terdaftar & Blokir</p>
    </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-share-alt-square"></i></div>
        <div class="count"><?= number_formation($kendaraan);?></div>
        <h3>Jumlah Kendaraan</h3>
        <p>Data Masuk</p>
    </div>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>USER TERDAFTAR</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
    <table id="tabledata" class="dt-responsive row-border nowrap display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username (Email)</th>
                    <th>Nama</th>
                    <th>Kota</th>
                    <th>Nomor Telepon</th>
                    <th>Tipe Akun</th>
                    <th>Status</th>
                    <th>Masa Aktif</th>
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
                    <td><?php if($key->status_aktif == 0 && $sisahari > 1) { echo "Aktif";} else if($key->status_aktif == 0 && $masaaktif < $sekarang) { echo "<a style='color: red;'>Habis Masa Aktif</a>";} else if($key->status_aktif == 2){ echo "<a style='color: red;'>User Blokir</a>";} else { echo "Tidak Aktif";} ?></td>
                    <td><?php if ($masaberlaku/(24*60*60)<0) { echo "0 Hari"; } else { echo number_format($masaberlaku/(24*60*60))." Hari"; }?></td>
                    <td><?= date('d-m-Y h:i:s A', strtotime($key->terdaftar_pada)); ?></td>
                    <td><?= date('d-m-Y h:i:s A', strtotime($key->berakhir_pada)); ?></td>
                    <td><?= $key->alamat; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>