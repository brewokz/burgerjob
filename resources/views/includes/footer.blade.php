<div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0.0
</div>
<strong>Copyright &copy; 2021 <a href="http://burger-job.test/">burger-job.test</a>.</strong> All rights reserved.
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $("#report1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#report1_wrapper .col-md-6:eq(0)');
        $("#report2").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#report2_wrapper .col-md-6:eq(0)');
        $("#report3").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#report3_wrapper .col-md-6:eq(0)');
        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "bInfo": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            //"paging": true,
            "lengthChange": false,
            "searching": false,
            //"ordering": true,
            //"info": true,
            "autoWidth": false,
            "responsive": true,
            "paging": false,
            "ordering": false,
            "info": false
        });
    });
</script>