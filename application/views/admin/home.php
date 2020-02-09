<div class="x_panel">
    <div class="x_title">
        <h2>USER TERDAFTAR</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
    <table id="tabledata" class="table table-striped table-bordered dt-responsive table-responsive nowrap">
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
                    <td><?php if($key->status_aktif == 0 && $sisahari > 1) { echo "Aktif";} else if($key->status_aktif == 0 && $masaaktif > $sekarang) { echo "<p style='color: red;'>Habis Masa Aktif</p>";} else if($sisahari > 1){ echo "<p style='color: red;'>User Blokir</p>";} else { echo "Tidak Aktif";} ?></td>
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