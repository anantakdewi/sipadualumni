<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Pengambilan</h3>
                </br></br>Pemohon yang dapat mengajukan surat permohonan lainnya adalah alumni dengan masa penempatan minimal 4 tahun.
                </br>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>

                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?php echo base_url('pemohon/lainnya/submit') ?>" method="post" enctype="multipart/form-data">

                    <div class="form-inline text-center">

                        <div class="form-group" style="margin-right:10px">
                            <div class="radio-toolbar">
                                <input type="radio" id="button1" name="surat_lainnya" value="1">
                                <label for="button1">Surat Keterangan Akreditasi Prodi</label>
                            </div>
                        </div>

                        <div class="form-group" style="margin-right:5px">
                            <div class="radio-toolbar">
                                <input type="radio" id="button2" name="surat_lainnya" value="2">
                                <label for="button2">Surat Keterangan Penahanan Ijazah Asli</label>
                            </div>
                        </div>

                    </div>

                    <div class="form-inline text-center" style="margin-top:10px">

                        <div class="form-group" style="margin-right:10px">
                            <div class="radio-toolbar">
                                <input type="radio" id="button3" name="surat_lainnya" value="3">
                                <label for="button3">Surat Keterangan Lulus</label>
                            </div>
                        </div>

                        <div class="form-group" style="margin-right:5px">
                            <div class="radio-toolbar">
                                <input type="radio" id="button4" name="surat_lainnya" value="4">
                                <label for="button4">Surat Konversi Nilai Pendaftaran Universitas</label>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Permohonan Lainnya</label>
                        <sup class="text-danger">*Isikan disini jika tidak terdapat permohonan sesuai diatas</sup>
                        <input type="text" name="permohonan_lain" id="permohonan_lain" class="form-control">

                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group">
                        <!-- <div class="col-md-" style="padding-left:0px;padding-bottom:15px"> -->
                        <label for="input_file">Unggah Contoh Format Surat </label>
                        <sup class="text-danger">*Jika ingin memberi contoh format (Opsional)</sup>
                        <input type="file" name="format_surat" class="form-control">
                        <?php echo form_error('format_surat', '<small class="text-danger pl-3">', '</small>'); ?>
                        <!-- </div> -->
                    </div>

                    <div class="text-right">
                        <input type="submit" class="btn btn-primary" style="width:150px; margin-top:10px" value="Kirim">
                    </div>
                </form>
            </div>
            <!-- ./box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

</div>
<!-- /.row -->