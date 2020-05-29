<!-- Main content petugas/arsip/arsip_surat.php VIEWS -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Arsip</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class=""><a href="<?php echo base_url('petugas/arsip') ?>"><i class="fa fa-inbox"></i>Ijazah dan Transkrip
                                <span class="label label-primary pull-right"></span></a></li>
                        <li><a href="<?php echo base_url('petugas/arsip/surat') ?>"><i class="fa fa-file-text-o"></i>Surat</a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>

            <!-- /.box -->
        </div>
        <!-- /KONTEN -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-header with-border">
                        <h3 class="box-title">Surat</h3>
                        <p class="help-block">Masukkan jenis surat pada kolom pencarian di bawah ini</p>
                    </div>

                    <div class="container">
                        <div class="row ">
                            <div class="col-md-8">
                                <form action="" method="POST">
                                    <div class="input-group input-group-sm col-md-6">
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
                                            <th style="width: 15px">No</th>
                                            <th scope="col">Jenis Surat</th>
                                            <!-- Nama surat yang di permohonan Lainnya , nama_permohonan di tabel permohonan -->
                                            <th scope="col">Nama Pemohon</th>
                                            <!-- nama pemohon -->
                                            <th scope="col">Keterangan</th>
                                            <!-- buat langsung munculin print -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <!--biar urut -->
                                        <tr>
                                            <th><?php $i++; ?></th>
                                            <td>Ananta Kusuma</td>
                                            <td>Surat Akreditasi Prodi</td>
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