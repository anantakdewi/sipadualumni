<div class="row">
<!-- <div class="alert alert-info text-center" style="margin-left:10px;margin-right:10px">Pengajuan Legalisir Ijazah dan Transkrip</div> -->
    <div class="col-md-6">

        <div class="box-body">

            <form action="<?php echo base_url('pemohon/pengambilan/submit');?>" method="post">
                
                <div class="form-group">
                  <label>Pengambilan Dokumen</label>
                  <select class="form-control" name="pengambilan_dokumen" id="pengambilan_dokumen">
                    <option hidden selected disabled>Pilih Salah Satu</option>
                    <option value="2">Ambil langsung ke kampus</option>
                    <option value="3">Ambil langsung diwakilkan</option>
                  </select>
                  <?php echo form_error('pengambilan_dokumen', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="form-group">
                    <label>Waktu Pengambilan</label>
                    <div class="form-group has-feedback">
                <!-- <div class="input-group date"> -->
                    <input type="text" name="tgl_pengambilan" class="form-control" id="datepickerPengambilan" placeholder="Taggal Pengambilan" value="<?php echo set_value('tgl_pengambilan')?>" autocomplete="off">
                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                    <?php echo form_error('tgl_pengambilan', '<small class="text-danger pl-3">', '</small>');?>
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