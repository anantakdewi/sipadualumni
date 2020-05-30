<!-- Main content petugas/arsip/arsip_surat.php VIEWS -->
<section class="content">
    <div class="row">

        <!-- /KONTEN -->
        <div class="col">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-header with-border">
                        <h3 class="box-title">Surat</h3>
                        <p class="help-block">Masukkan jenis surat pada kolom pencarian di bawah ini</p>
                    </div>

                    <div class="container">
                        <div class="row ">
                            <div class="col-md-10">
                                <form action="<?php echo base_url('petugas/arsip/cari') ?>" method="POST">
                                    <div class="input-group input-group-sm col-md-4">
                                        <input type="text" class="form-control" placeholder="ketik di sini.." name="cari_dok" autocomplete="off" autofocus>
                                        <span class="input-group-btn">
                                            <input type="submit" class="btn btn-info btn-flat" value="Cari">
                                        </span>
                                    </div>
                                </form>
                                <p class="margin"></p>

                                <?php if(sizeof($surat) != 0) : ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px">No</th>
                                            <th scope="col">Jenis Surat</th>
                                            <!-- Nama surat yang di permohonan Lainnya , nama_permohonan di tabel permohonan -->
                                            <th scope="col">Nama Pemohon</th>
                                            <!-- nama pemohon -->
                                            <th scope="col">Keterangan</th>
                                            <!-- buat langsung munculin print/save, kayak di tombol download surat-surat kelengkapan permohonan legalisir -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach($surat as $s) : ?>
                                        <!--biar urut -->
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $s['nama_surat'] ?></td>
                                            <td><?php echo $s['pemohon'] ?></td>
                                            <td>
                                                <!-- belum buat controller -->
                                                <a href="<?php echo base_url('petugas/arsip/save/') . $s['id_dokumen'] ?>" button type="button" class="btn btn-block btn-info btn-xs" style="width: 75px">Print</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>