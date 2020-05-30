<div class="row">

    <div class="col-md-8">
        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Permohonan Aktif</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php if(sizeof($permohonan) != 0) :?>

            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Permohonan</th>
                  <th>Tanggal dibuat</th>
                  <th>Proggress</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <tr>
                    
                <?php if($permohonan['jenis_permohonan'] != "Lainnya") : ?>
                    <td><?php echo $permohonan['jenis_permohonan'] ?></td>
                <?php else : ?>
                    <td><?php echo $permohonan['nama_permohonan'] ?></td>
                <?php endif; ?>
                  <td><?php echo $permohonan['created_at'] ?></td>

                <?php if($permohonan['status'] == 1) : ?>
                  <td>Menunggu Konfirmasi Petugas</td>
                  <td><span class="label label-warning">Pending</span></td>
                <?php elseif($permohonan['status'] == 2) : ?>
                  <td>Permohonan sedang di proses</td>
                  <td><span class="label label-success">Proses</span></td>
                <?php elseif($permohonan['status'] == 3) : ?>
                  <td>Permohonan tidak lengkap!</td>
                  <td><span class="label label-danger">Ditolak</span></td>
                <?php elseif($permohonan['status'] == 4) : ?>
                  <td>Dokumen sedang di proses</td>
                  <td><span class="label label-success">Proses</span></td>
                <?php elseif($permohonan['status'] == 5) : ?>
                  <td>Dokumen selesai</td>
                  <td><span class="label label-success">Selesai</span></td>
                <?php elseif($permohonan['status'] == 6) : ?>
                  <td>Dokumen Dikirim melalui POS</td>
                  <td><span class="label label-success">Proses</span></td>
                <?php elseif($permohonan['status'] == 7) : ?>
                  <td>Permohonan Selesai Silahkan konfirmasi</td>
                  <td><span class="label label-success">Selesai</span></td>
                <?php endif; ?>
                  <td><a href="<?php echo base_url('pemohon/monitoring') ?>"><button class="btn btn-sm btn-primary">Detail</button></a></td>

                </tr>
              </table>
            </div>
            <?php else : ?>
            <h2 class="text-center">Anda tidak memiliki Permohonan Aktif</h2>
            <?php endif; ?>
        </div>
        <!-- ./box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->


    <div class="col-md-4">
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
            
            <?php if(!empty($pengumuman)) : ?>

                <?php echo $pengumuman['pengumuman'] ?>

                <?php if(sizeof($dokumen_pengumuman) != 0) : ?>

                    <?php foreach($dokumen_pengumuman as $dok) : ?>

                    <a href="<?php echo base_url($dok['path']) ?>"><button class="btn btn-primary">Dokumen Pengumuman</button></a>

                    <?php endforeach; ?>

                <?php endif; ?>

            <?php else : ?>

            <h5 class="text-muted text-center">Tidak ada Pengumuman</h5>

            <?php endif; ?>

        </div>
        <!-- ./box-body -->
        
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->

</div>
    <!-- /.row -->