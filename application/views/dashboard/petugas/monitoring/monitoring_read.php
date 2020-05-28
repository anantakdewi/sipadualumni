<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Legalisir</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <table class="table">

                                <tr>
                                    <td><b>Ananta Kusuma</b></td>
                                </tr>
                                <tr>
                                    <td>ananta.kusumadewi@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>19991230 202101 1 002</td>
                                </tr>
                                <tr>
                                    <td>BPS Kabupaten Badung</td>
                                </tr>
                                <tr>
                                    <td>Status permohonan saat ini adalah <b>menunggu konfirmasi petugas</b></td>
                                </tr>
                                <tr>
                                    <td><a href="<?php echo base_url('petugas/monitoring/surat') ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> Surat Permohonan</a></td>
                                </tr>

                            </table>
                            <label>Pilih Status Permohonan</label>
                            <select class="form-control">
                                <option>Permohonan diterima</option>
                                <option>Dokumen permohonan tidak lengkap</option>
                                <option>Dokumen sedang diproses</option>
                                <option>Dokumen selesai</option>
                                <option>Dokumen sedang dikirim</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Unggah Dokumen</label>
                            <input type="file" id="exampleInputFile">

                            <p class="help-block">Format file yang dapat diunggah hanya pdf dan doc.</p>
                        </div>
                        <div class="form-group">
                            <label>Nomor Resi</label>
                            <input type="text" class="form-control" placeholder="Ketik nomor resi pengiriman di sini..">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>