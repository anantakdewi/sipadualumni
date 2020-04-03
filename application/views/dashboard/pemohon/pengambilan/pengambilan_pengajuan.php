<div class="row">
<!-- <div class="alert alert-info text-center" style="margin-left:10px;margin-right:10px">Pengajuan Legalisir Ijazah dan Transkrip</div> -->
    <div class="col-md-6">

        <div class="box-body">

            <form action="#" method="post">
                
                <div class="form-group">
                  <label>Pengambilan Dokumen</label>
                  <select class="form-control" name="pengambilan_dokumen">
                    <option value="1">Kirim POS</option>
                    <option value="2">GOJEK</option>
                    <option value="3">NITIP GAN</option>
                  </select>
                </div>

                <div class="form-group">
                    <label>Waktu Pengambilan</label>
                    <div class="form-group has-feedback">
                <!-- <div class="input-group date"> -->
                    <input type="text" name="tahun_penempatan" class="form-control" id="datepicker" placeholder="Tahun Pengangkatan" value="<?php echo set_value('tgl_tempat')?>">
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                    <?php echo form_error('tahun_penempatan', '<small class="text-danger pl-3">', '</small>');?>
                <!-- </div> -->
                <!-- /.input group -->
                    </div>
                </div>

                <div class="text-center">
                    <div class="form-group">
                        <input type="submit" class="btn btn-md btn-primary" value="Ajukan">
                    </div>
                </div>

            
            </form>

        </div>
        <!-- ./box-body -->

    </div>
    <!-- /.col -->

</div>