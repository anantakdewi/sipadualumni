<div class="row">

    <div class="col-md-7">
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
        <?php 

                if(!empty($queries)){

                    echo '<ul class="timeline">';

                    foreach($queries as $query){

                        if($query['status'] == 1){
    
                            echo('
    
                            <li class="time-label">
                                <span class="bg-light-blue">'
                                . date('j M. Y', strtotime($query['created_at'])) .
                                '</span>
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
        
                            ');
                        }
    
                        else if($query['status'] == 2){
                            echo('
                            
                            <li class="time-label">
                                <span class="bg-green">'
                                . date('j M. Y', strtotime($query['created_at'])) .
                                '</span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-green"></i>
                                <div class="timeline-item">
    
                                    <h3 class="timeline-header bg-green">Permohonan sedang diproses</h3>
    
                                    <div class="timeline-body">
                                        <!-- progress description -->
    
                                       Permohonan Sedang di proses
    
                                    </div>
                                </div>
                            </li>
                            
                            ');
                            
                        } else if($query['status'] == 3){
    
                            echo('
                            
                            <li class="time-label">
                                <span class="bg-red">'
                                . date('j M. Y', strtotime($query['created_at'])) .
                                '</span>
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
                                                    
                            ');
    
                            echo '</ul>';
                            
                        } else if($query['status'] == 4){
    
                            echo('
                            
                            <li class="time-label">
                                <span class="bg-light-blue">'
                                . date('j M. Y', strtotime($query['created_at'])) .
                                '</span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-light-blue"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-light-blue">Dokumen sedang di Proses</h3>
            
                                    <div class="timeline-body">
                                        <!-- progress description -->
            
                                        Komentar
            
                                    </div>
                                </div>
                            </li>
                                                    
                            ');
    
    
                        } else if($query['status'] == 5){
    
                            echo('
                            
                            <li class="time-label">
                                <span class="bg-green">'
                                . date('j M. Y', strtotime($query['created_at'])) .
                                '</span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-green"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-green">Dokumen Selesai</h3>
            
                                    <div class="timeline-body">
                                        <!-- progress description -->
            
                                        Komentar
            
                                    </div>
                                </div>
                            </li>
                                                    
                            ');
    
    
                        } else if($query['status'] == 6){
    
                            echo('
                            
                            <li class="time-label">
                                <span class="bg-light-blue">'
                                . date('j M. Y', strtotime($query['created_at'])) .
                                '</span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-light-blue"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-light-blue">Dokumen sedang dikirim</h3>
            
                                    <div class="timeline-body">
                                        <!-- progress description -->
            
                                        Komentar
            
                                    </div>
                                </div>
                            </li>
                                                    
                            ');
    
    
                        } else if($query['status'] == 7){
    
                            echo('
    
                            <li class="time-label">
                                <span class="bg-purple">'
                                . date('j M. Y', strtotime($query['created_at'])) .
                                '</span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-purple"></i>
                                <div class="timeline-item">
            
                                    <h3 class="timeline-header bg-purple">Permohonan telah selesai</h3>
            
                                    <div class="timeline-body">
                                       Permohonan telah dikirim melalui POS dengan Resi : 123810293103
                                    </div>
            
                                </div>
                            </li>
        
                            ');
                        }
                    }

                    echo '</ul>';
                    
                } else {

                    echo '<center><h2>Anda tidak memiliki permohonan aktif</h2></center>';

                }
            ?>
        </div>
        <!-- ./box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->


    <div class="col-md-5">
        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Pengumuman</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <!-- <ul class="products-list product-list-in-box"> -->
            <!-- list pengumunan start here -->
            <!-- <li class="item">
                <div class="product-img">
                <img src="<?php echo base_url()?>assets/dist/img/default-50x50.gif" alt="Product Image">
                </div>
                <div class="product-info">
                <a href="javascript:void(0)" class="product-title">Samsung TV
                    <span class="label label-warning pull-right">$1800</span></a>
                    <span class="product-description">
                        Samsung 32" 1080p 60Hz LED Smart HDTV.
                    </span>
                </div>
            </li> -->
            <!-- list pengumunan end here -->
 

            <!-- </ul> -->

            <h5 class="text-muted text-center">Tidak ada Pengumuman</h5>

        </div>
        <!-- ./box-body -->
        
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

</div>
    <!-- /.row -->