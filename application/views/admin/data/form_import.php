
<div class="x_panel">
    <div class="x_title">
        <h2>IMPORT DATA KENDARAAN</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <h4>Pilih Cabang Dan Leasing</h4>
        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data" role="form">
            <div class="form-group">
                Cabang
                <select id="id_cabang" name="id_cabang" class="form-control required" required/>
                    <option value="" selected>-- Pilih Cabang --</option>
                    <?php foreach($cabang->result() as $row):?>
                    <option value="<?php echo $row->id_cabang;?>"><?php echo $row->cabang;?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                Nama Leasing
                <select id="id_leasing" name="id_leasing" class="form-control required" required/>
                    <option value="" selected>-- Pilih Leasing --</option>
                    <!-- <?php foreach($leasing->result() as $row):?>
                    <option value="<?php echo $row->id_leasing;?>"><?php echo $row->leasing;?></option>
                    <?php endforeach;?> -->
                </select>
            </div>
            <div class="ln_solid"></div>
            <div style="float:right">
                <button type="submit" class="btn btn-sm btn-success" name="submit" value="Submit"><i class="fa fa-save"></i> Pilih</button>
            </div>
        </form>
    </div>
</div>