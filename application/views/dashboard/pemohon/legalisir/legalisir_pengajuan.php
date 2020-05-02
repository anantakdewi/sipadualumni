<div class="row">
<!-- <div class="alert alert-info text-center" style="margin-left:10px;margin-right:10px">Pengajuan Legalisir Ijazah dan Transkrip</div> -->
    <div class="col-md-6">

        <div class="box-body">

            <form action="<?php echo base_url('pemohon/legalisir/submit')?>" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label>Pengambilan Dokumen</label>
                  <select class="form-control" name="pengambilan_dokumen" id="pengambilan_dokumen">
                    <option selected hidden>Pilih Salah Satu</option>
                    <option value="1">Unduh pada sistem</option>
                    <option value="2">Ambil langsung ke kampus</option>
                    <option value="3">Ambil langsung diwakilkan</option>
                    <option value="4">Kirim melalui pos</option>
                  </select>
                </div>

                <div class="form-group">
                    <label>Alamat <sup class="text-danger">*diisi jika dikirim melalui pos</sup></label>
                    <input type="text" class="form-control" name="alamat" value="" id="alamat_pos">
                    <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>');?>
                </div>

                <div class="form-group">
                    <div class="col-md-5" style="padding-left:0px;padding-bottom:15px">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-control" id="provinsi">
                            <option value="bali">Bali</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="ntb">NTB</option>
                        </select>
                        <?php echo form_error('provinsi', '<small class="text-danger pl-3">', '</small>');?>
                    </div>

                    <div class="col-md-6">
                        <label>Kabupaten</label>
                        <select name="kabupaten" class="form-control" id="kabupaten">
                            <option value="bali">Bali</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="ntb">NTB</option>
                        </select>
                        <?php echo form_error('kabupaten', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="form-group">
                    <div class="col-md-5" style="padding-left:0px;padding-bottom:15px">
                        <label>Kode POS</label>
                        <input type="text" class="form-control" name="kode_pos" id="kode_pos">
                        <?php echo form_error('kode_pos', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                </div> 
                
                
                <div class="clearfix"></div>
                <div class="form-group">
                    <!-- <div class="col-md-" style="padding-left:0px;padding-bottom:15px"> -->
                        <label for="input_file">Unggah Surat Permohonan Legalisir</label>
                        <input type="file" name="surat_permohonan_legalisir" class="form-control">
                        <?php echo form_error('surat_permohonan_legalisir', '<small class="text-danger pl-3">', '</small>');?>
                    <!-- </div> -->
                </div>

                <?php 
                    if ($this->session->userdata('tahun_abdi') < 4) {
                        
                        echo('
                        <div class="form-group">
                            <!-- <div class="col-md-" style="padding-left:0px;padding-bottom:15px"> -->
                                <label>Unggah Surat Permohonan Izin Belajar disetujui Eselon II</label>
                                <input type="file" name="surat_izin_eselon_2" class="form-control">');
                        echo form_error('surat_izin_eselon_2', '<small class="text-danger pl-3">', '</small>');
                        echo(' <!-- </div> -->
                        </div>
                        ');
                        
                        echo('
                        <div class="form-group">
                            <!-- <div class="col-md-" style="padding-left:0px;padding-bottom:15px"> -->
                                <label>Unggah Surat Permohonan Izin Belajar disetujui Kepala Pusdiklat</label>
                                <input type="file" name="surat_izin_pusdiklat" class="form-control">
                        ');
                        echo form_error('surat_izin_pusdiklat', '<small class="text-danger pl-3">', '</small>'); 
                        echo(' <!-- </div> -->
                        </div>
                        ');
    
                    } else {
                        
                        echo('
                        <div class="form-group">
                            <!-- <div class="col-md-" style="padding-left:0px;padding-bottom:15px"> -->
                                <label>Unggah Bukti Pendaftaran ke Universitas Tujuan</label>
                                <input type="file" name="surat_bukti_daftar_univ" class="form-control"> ');
                        echo form_error('surat_bukti_daftar_univ', '<small class="text-danger pl-3">', '</small>'); 
                        echo (' <!-- </div> -->
                        </div>
                        ');
                    }
                ?>
                
                <div style="padding-top:15px;">
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-md btn-primary" value="Ajukan">
                    </div>
                </div>

            
            </form>

        </div>
        <!-- ./box-body -->

    </div>
    <!-- /.col -->

</div>