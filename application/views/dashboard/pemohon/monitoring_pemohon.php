<div class="row">

    <div class="col-md-12">
        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Progress Tracker Surat</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            
            <!-- Timeline dari atas ke bawah -->
            <?php if(sizeof($results) != 0) : ?>

                        <ul class="timeline">

                    <?php foreach($results as $result): ?>

                        <?php if($result['status'] == 1): ?>
    
                            <li class="time-label">
                                <span class="bg-light-blue">

                                <?php echo date('j M. Y', strtotime($result['created_at'])) ?>

                                </span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-light-blue"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-light-blue">Permohonan diterima</h3>
            
                                    <div class="timeline-body">
                                        Surat sudah diajukan
                                    </div>
            
                                </div>
                            </li>
    
                        <?php elseif($result['status'] == 2) : ?>
                            
                            <li class="time-label">
                                <span class="bg-green">

                                <?php echo date('j M. Y', strtotime($result['created_at'])) ?>

                                </span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-green"></i>
                                <div class="timeline-item">
    
                                    <h3 class="timeline-header bg-green">Permohonan sedang diproses</h3>
    
                                    <div class="timeline-body">
                                        <!-- progress description -->
    
                                       Permohonan Sedang di proses oleh petugas
    
                                    </div>
                                </div>
                            </li>
                            
                            
                        <?php elseif($result['status'] == 3) : ?>
                            
                            <li class="time-label">
                                <span class="bg-red">

                                <?php echo date('j M. Y', strtotime($result['created_at'])) ?>

                                </span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-red"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-red">Permohonan Bermasalah</h3>
            
                                    <div class="timeline-body">
                                        <!-- progress description -->
            
                                        Surat tidak Valid!
            
                                    </div>
                                </div>
                            </li>
                        </ul>
                            
                        <?php elseif($result['status'] == 4) : ?>

                            <li class="time-label">
                                <span class="bg-light-blue">

                                <?php echo date('j M. Y', strtotime($result['created_at'])) ?>

                                </span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-light-blue"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-light-blue">Dokumen sedang di Proses</h3>
            
                                    <div class="timeline-body">
                                        <!-- progress description -->
            
                                        Dokumen sedang di proses oleh petugas
            
                                    </div>
                                </div>
                            </li>

        
                        <?php elseif($result['status'] == 5) : ?>
    
                            <li class="time-label">
                                <span class="bg-green">

                                <?php echo date('j M. Y', strtotime($result['created_at'])) ?>

                                </span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-green"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-green">Dokumen Selesai</h3>
            
                                    <div class="timeline-body">
                                        <!-- progress description -->
                                        <?php if($result['jenis_pengambilan'] == "Unduh") : ?>
                                        
                                        <h4>Silahkan unduh Dokumen dengan tombol dibawah</h4>

                                            <?php foreach($dokumen as $dok) : ?>

                                            <a href="<?php echo base_url('pemohon/download/dokumen/') . $dok['id_dokumen'] ?>"><button class="btn btn-primary">Dokumen</button></a>

                                            <?php endforeach; ?>
                                        <?php else : ?>

                                            <p>Dokumen telah selesai dan siap ke tahap selanjutnya</p>

                                        <?php endif; ?>
            
                                    </div>
                                </div>
                            </li>

                        <?php elseif($result['status'] == 6) : ?>
                            
                            <li class="time-label">
                                <span class="bg-light-blue">
                                <?php echo date('j M. Y', strtotime($result['created_at'])) ?>
                                </span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-light-blue"></i>
                                <div class="timeline-item">
                                    <?php if($result['jenis_pengambilan'] == "POS") : ?>

                                    <h3 class="timeline-header bg-light-blue">Dokumen sedang dikirim</h3>
                                    <div class="timeline-body">
                                        <!-- progress description -->
                                        <p>Permohonan telah dikirim melalui POS dengan Resi :  <?php echo $resi ?></p>
                                         <?php if($result['statusNow'] == 6) : ?>
                                            <a href="<?php echo base_url('pemohon/konfirmasi/sampai/') . $result['id_permohonan'] ?>"><button class="btn btn-primary">Konfirmasi Sampai</button></a>
                                         <?php endif; ?>
                                    </div>

                                    <?php endif; ?>
                                </div>
                            </li>

    
    
                        <?php elseif($result['status'] == 7) : ?>

                            <li class="time-label">
                                <span class="bg-purple">
                                    <?php echo date('j M. Y', strtotime($result['created_at'])) ?>
                                </span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-purple"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-purple">Permohonan telah selesai</h3>
            
                                    <div class="timeline-body">
                                       <p>Silahkan Konfirmasi pada tombol dibawah untuk dapat melakukan permohonan kembali</p>
                                       <a href="<?php echo base_url('pemohon/konfirmasi/selesai/') . $result['id_permohonan'] ?>"><button class="btn btn-primary">Konfirmasi</button></a>
                                    </div>
            
                                </div>
                            </li>
        
                        <?php endif; ?>

                    <?php endforeach; ?>

                     </ul>
                    
            <?php else : ?>

                <center><h2>Anda tidak memiliki permohonan aktif</h2></center>  

            <?php endif; ?> 

                <!-- timeline label terbaru end -->
            
        </div>
        <!-- ./box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>