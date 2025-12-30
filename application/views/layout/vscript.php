<!-- jQuery -->
<script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="<?= base_url('assets') ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- pace-progress -->
<script src="<?= base_url('assets') ?>/plugins/pace-progress/pace.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url('assets') ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('assets') ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Page specific script -->
<script>
  $(function() {
    // Summernote
    $('#summernote').summernote()

    //swal
    var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    //bs-csfile
    bsCustomFileInput.init();
    //Date picker
    $('#reservationdate').datetimepicker({
      format: 'YYYY-MM-DD'
    });
    //Time picker
    $('#reservationtime').datetimepicker({
      format: 'HH:mm:ss',
      defaultDate: moment().startOf('day') // Atur default waktu ke '00:00:00'      
    }).on('dp.show', function() {
        var input = $(this).find('input');
        if (!input.val()) {
            input.val('00:00:00'); // Setel default waktu jika tidak ada nilai
        }
    });
    //Datatable
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "columnDefs": [{
        "className": "dt-head-center",
        "targets": "_all"
      }],
      "buttons": ["copy", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
