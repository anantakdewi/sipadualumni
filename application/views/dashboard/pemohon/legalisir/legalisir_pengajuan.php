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
                    <label>Alamat <sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="alamat" value="">
                </div>

                <div class="form-group">
                    <div class="col-md-5" style="padding-left:0px;padding-bottom:15px">
                        <label>Provinsi</label>
                        <select name="provinsi" class="form-control">
                            <option value="bali">Bali</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="ntb">NTB</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Kabupaten</label>
                        <select name="provinsi" class="form-control">
                            <option value="bali">Bali</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="ntb">NTB</option>
                        </select>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="form-group">
                    <div class="col-md-5" style="padding-left:0px;padding-bottom:15px">
                        <label>Kode POS</label>
                        <input type="text" class="form-control" name="kode_pos" >
                    </div>
                </div> 
                
                
                <div class="clearfix"></div>
                <div class="form-group">
                    <!-- <div class="col-md-" style="padding-left:0px;padding-bottom:15px"> -->
                        <label for="input_file">Unggah Surat Permohonan Legalisir</label>
                        <input type="file" name="surat_permohonan_legalisir" class="form-control">
                    <!-- </div> -->
                </div>


                <div class="form-group">
                    <!-- <div class="col-md-" style="padding-left:0px;padding-bottom:15px"> -->
                        <label>Bukti Pendaftaran Universitas Tujuan</label>
                        <input type="file" name="surat_pendaftaran_univ" class="form-control">
                    <!-- </div> -->
                </div>

                <div class="form-group">
                    <!-- <div class="col-md-" style="padding-left:0px;padding-bottom:15px"> -->
                        <label>Bukti Pendaftaran Universitas Tujuan</label>
                        <input type="file" name="surat_pendaftaran_univ" class="form-control">
                    <!-- </div> -->
                </div>
                
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