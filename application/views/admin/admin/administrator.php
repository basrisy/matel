<div class="x_panel">
    <div class="x_title">
        <h2>ADMISTRATOR</h2>
        <div style="float:right">
            <a data-toggle="modal" data-target="#tambah" class="btn btn-sm btn-primary" title="Tambah"><i class="fa fa-plus-square"></i> Operator</a>
            <a href="<?=base_url();?>administrator/level" class="btn btn-sm btn-dark" title="Tambah Level"><i class="fa fa-plus-square"></i> Level</a>
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
        <table id="tabledata" class="table table-striped table-bordered table-responsive nowrap">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th style="width: 20px">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0; 
                foreach($data->result() as $key) :
                ?>
                <tr>
                    <td><?= ++$no; ?></td>
                    <td><?= $key->username; ?></td>
                    <td><?= $key->nama; ?></td>
                    <td><?php foreach($level->result() as $l){ if($key->id_level == $l->id){ echo $l->nama; }}?></td>
                    <td>
                        <a data-toggle="modal" data-target="#edit<?=$key->id;?>" class="btn btn-xs btn-warning" title="Edit Data"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="<?=base_url();?>administrator/del_akun/<?=$key->id;?>" class="btn btn-xs btn-danger" title="Hapus Data" onclick="return confirm('Yakin Ingin Menghapus Data ini ?')"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="tambah" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">TAMBAH OPERATOR</h4>
                <div class="clearfix"></div>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('administrator/tambah_akun')?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">                                  
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12 control-label">Nama Lengkap</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input id="nama" type="text" class="form-control required" name="nama"  placeholder="Nama Lengkap" autofocus required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12 control-label">User Name</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input id="username" type="text" class="form-control required" name="username"  placeholder="User Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12 control-label">Password</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input id="password" name="password" type="password" class="password form-control required" placeholder="Password" required/>
                            <input type="checkbox" class="form-checkbox"> Show password
                            <p style="float:right" class="help-text red">* Minimal 5 karakter</p>
                        </div>                                      
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12 control-label">Level User</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <select id="level" name="level" class="form-control required" required/>
                                <option value="">--Pilih Level--</option>
                                <?php foreach($level->result() as $row):?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->nama;?></option>
                                <?php endforeach;?>
                            </select>
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

<!-- Modal Edit -->
<?php foreach($data->result() as $key) :?>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" id="edit<?=$key->id;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">EDIT PROFILE</h4>
                <div class="clearfix"></div>
            </div>
            <form class="form-horizontal" action="<?php echo base_url('administrator/edit_akun')?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body"> 
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Username
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" name="username" value="<?= $key->username; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Nama Lengkap
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="hidden"name="id" value="<?= $key->id; ?>">
                        <input type="text" class="form-control" name="nama" value="<?= $key->nama; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12 control-label">Level User</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <select id="level" name="level" class="form-control required" required/>
                                <option value="<?= $key->id_level; ?>" selected><?php foreach($level->result() as $l){ if($key->id_level == $l->id){ echo $l->nama; }}?></option>
                                <?php foreach($level->result() as $row):?>
                                <option value="<?php echo $row->id;?>"><?php echo $row->nama;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12 control-label">Password Lama</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input id="password" name="pass_lama" type="password" class="password form-control required" required/>
                        </div>                                      
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 col-xs-12 control-label">Password Baru</label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <input id="password" name="pass_baru" type="password" class="password form-control required" required/>
                            <input type="checkbox" class="form-checkbox"> Show password
                            <p style="float:right" class="help-text red">* Minimal 5 karakter</p>
                        </div>                                      
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Password Admin
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="password" class="form-control col-md-7 col-xs-12" name="password_admin">
                        <em class="help-text">* Masukkan Password ADMIN untuk konfirmasi perubahan</em>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" name="submit" value="Submit" type="submit"> Simpan Perubahan</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>