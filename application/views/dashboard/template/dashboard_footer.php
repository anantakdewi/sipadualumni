</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

 
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>

<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
</script>


<!-- script untuk legalisir pengajuan -->
<script>
    $('#pengambilan_dokumen').on('change', function(){
        if ($(this).val() != '4'){
          $("#alamat_pos").prop("disabled", true);
          $("#provinsi").prop("disabled", true);
          $("#kabupaten").prop("disabled", true);
          $("#kode_pos").prop("disabled", true);
        } else {
          $("#alamat_pos").prop("disabled", false);
          $("#provinsi").prop("disabled", false);
          $("#kabupaten").prop("disabled", false);
          $("#kode_pos").prop("disabled", false);
        }
    });
</script>


<!-- Script untuk pengambilan pengajuan -->
<script>
$(function () {
  var dNow = new Date();
  var dateStart = new Date(dNow.setDate(dNow.getDate() + 7));

  $("#datepickerPengambilan").datepicker({
    dateFormat: 'yy-mm-dd ',
    startDate : dateStart,
    autoclose : true,
    daysOfWeekDisabled: [0, 6]
  })

});

</script>



</body>
</html>
