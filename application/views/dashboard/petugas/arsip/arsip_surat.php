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
                                <form action="" method="POST">
                                    <div class="input-group input-group-sm col-md-4">
                                        <input type="text" class="form-control" placeholder="ketik di sini.." name="cari_dok" autocomplete="off" autofocus>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-flat">Cari</button>
                                        </span>
                                    </div>
                                </form>
                                <p class="margin"></p>
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
                                        <?php $i = 1; ?>
                                        <!--biar urut -->
                                        <tr>
                                            <th><?php $i++; ?></th>
                                            <td>Surat Akreditasi Prodi</td>
                                            <td>Ananta Kusuma</td>
                                            <td>
                                                <!-- belum buat controller -->
                                                <a href="<?php echo base_url('petugas/arsip/save') ?>" button type="button" class="btn btn-block btn-info btn-xs" style="width: 75px">Print</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>