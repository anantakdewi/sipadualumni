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

            <?php 

                if(!empty($queries)){

                    echo '<ul class="timeline">';

                    foreach($queries as $query){

                        if($query['status'] == 1){
    
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
            
                                    <h3 class="timeline-header bg-green">Permohonan diterima</h3>
            
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
                                <span class="bg-blue">'
                                . date('j M. Y', strtotime($query['created_at'])) .
                                '</span>
                            </li>
    
                            <li>
                                <!-- timeline icon -->
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
    
                                    <h3 class="timeline-header bg-blue">Permohonan sedang diproses</h3>
    
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
    
    
                        } else if($query['status'] == 4){
    
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
            
                                    <h3 class="timeline-header bg-green">Permohonan telah selesai</h3>
            
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

                <!-- timeline label terbaru end -->
            
        </div>
        <!-- ./box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>