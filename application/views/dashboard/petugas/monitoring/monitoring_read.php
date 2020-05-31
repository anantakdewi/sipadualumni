<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $permohonan['jenis_permohonan'] ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url('petugas/monitoring/read/post') ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <table class="table">

                                <tr>
                                    <td>Nama Pemohon</td>
                                    <td><b><?php echo $permohonan['nama']?></b></td>
                                </tr>
                                <tr>
                                    <td>Email Pemohon</td>
                                    <td><?php echo $permohonan['email']?></td>
                                </tr>
                                <tr>
                                    <td>NIP Pemohon</td>
                                    <td><?php echo maskNip($permohonan['nip'])?></td>
                                </tr>
                                <tr>
                                    <td>Instansi Pemohon</td>
                                    <td><?php echo $permohonan['instansi']?></td>
                                </tr>
                                
                                <?php if($permohonan['jenis_permohonan'] == 'Lainnya') : ?>

                                <tr>
                                    <td>Permohonan</td>
                                    <td><?php echo $permohonan['nama_permohonan']?></td>
                                </tr>

                                <?php elseif($permohonan['jenis_permohonan'] == "Pengambilan") : ?>

                                <tr>
                                    <td>Waktu Diambil</td>
                                    <td><b><?php echo date('j M Y', strtotime($permohonan['tgl_ambil'])) ?></b></td>
                                </tr>

                                <?php endif; ?>

                                <tr>
                                    <td>Status permohonan</td>
                                    <td><b><?php echo $permohonan['status']?></b></td>
                                </tr>

                                <?php foreach($surat as $s): ?>
                                <tr>
                                    <td><a href="<?php echo base_url('petugas/download/surat/') . $s['id_surat'] ?>" class="btn btn-success"><i class="fa fa-print"></i><?php echo $s['nama_surat']; ?></a></td>
                                </tr>
                                <?php endforeach; ?>

                            </table>

                            <!-- pass variable id_permohonan -->
                            <input type="hidden" name="id_permohonan" value="<?php echo $permohonan['id_permohonan'] ?>">
                            <input type="hidden" name="jenis_permohonan" value="<?php echo $permohonan['jenis_permohonan'] ?>">
                            <input type="hidden" name="id_user" value="<?php echo $permohonan['id_user'] ?>">
                            <input type="hidden" name="jenis_pengambilan" value="<?php echo $permohonan['jenis_pengambilan'] ?>">

                            <label>Pilih Status Permohonan</label>
                            <select class="form-control" name="status" id="statusPermohonan">
                                <?php if($permohonan['jenis_permohonan'] == 'Legalisir'): ?>

                                <option selected disabled hidden>Pilih salah satu</option>
                                <option value="2">Permohonan diterima</option>
                                <option value="3">Dokumen permohonan tidak lengkap</option>
                                <option value="4">Dokumen sedang diproses</option>
                                <option value="5">Dokumen selesai</option>
                                <option value="6">Dokumen sedang dikirim</option>

                                <?php elseif($permohonan['jenis_permohonan'] == 'Pengambilan'): ?>

                                <option selected disabled hidden>Pilih salah satu</option>
                                <option value="2">Permohonan diterima</option>
                                <option value="5">Dokumen selesai</option>

                                <?php elseif($permohonan['jenis_permohonan'] == 'Lainnya') : ?>

                                <option selected disabled hidden>Pilih salah satu</option>
                                <option value="2">Permohonan diterima</option>
                                <option value="3">Dokumen permohonan tidak lengkap</option>
                                <option value="5">Dokumen selesai</option>
                                
                                <?php endif; ?>
                            </select>
                        </div>

                        <?php if($permohonan['jenis_permohonan'] == "Legalisir"): ?>

                            <?php if($permohonan['jenis_pengambilan'] == "Unduh"): ?>
                            <div class="form-group">

                                <label for="exampleInputFile">Unggah Legalisir Ijazah</label>
                                <input type="file" name="legalisir" class="form-control">
                                <p class="help-block">Format file yang dapat diunggah hanya pdf dan doc.</p>

                            </div>

                            <div class="form-group">

                                <label for="exampleInputFile">Unggah Legalisir Transkrip Nilai</label>
                                <input type="file" name="transkrip" class="form-control">
                                <p class="help-block">Format file yang dapat diunggah hanya pdf dan doc.</p>

                            </div>
                            <?php endif ?>
                        
                            <?php if($permohonan['jenis_pengambilan'] == "POS"): ?>
                            <div class="form-group">

                                <label>Nomor Resi</label>
                                <input type="text" name="resi" class="form-control" placeholder="Ketik nomor resi pengiriman di sini..">

                            </div>
                            <?php endif; ?>

                        <?php elseif($permohonan['jenis_permohonan'] == "Lainnya"): ?>
                        <div class="form-group">

                            <label for="exampleInputFile">Unggah Dokumen</label>
                            <input type="file" name="dokumen" class="form-control">
                            <p class="help-block">Format file yang dapat diunggah hanya pdf dan doc.</p>

                        </div> 
                        <?php else : ?>

                        <?php endif; ?>

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