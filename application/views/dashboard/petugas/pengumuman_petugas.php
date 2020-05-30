<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Buat Pengumuman Baru</h3>
                </div>
                <!-- /.box-header -->
                <form action="<?php echo base_url('petugas/dashboard/pengumuman/submit') ?>" method="post" enctype="multipart/form-data" >

                <div class="box-body">

                        <div class="form-group">
                            <input type="text" name="judul" class="form-control" placeholder="Judul pengumuman..">
                        </div>

                        <div class="form-group">
                            <textarea name="isi" id="compose-textarea" class="form-control" style="height: 300px"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile"></label>
                            <input type="file" name="files[]" id="exampleInputFile" class="form-control" multiple>
                            <p class="help-block">Ukuran file maksimal total 10MB.</p>
                            <?php echo form_error('files', '<small class="text-danger pl-3">', '</small>');?>
                        </div>

                </div>
                    <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Upload</button>
                    </div>
                </div>

                </form>
                
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->