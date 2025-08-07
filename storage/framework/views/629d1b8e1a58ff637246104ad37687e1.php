<body>


   <!-- BEGIN: Vendor JS -->
<script src="<?php echo e(asset('js-files/vendors.min.js')); ?>"></script>
<!-- END: Vendor JS -->

<!-- BEGIN: Page Vendor JS -->

<script src="<?php echo e(asset('js-files/toastr.min.js')); ?>"></script>
<!-- END: Page Vendor JS -->

<!-- BEGIN: Theme JS -->
<script src="<?php echo e(asset('js-files/app-menu.js')); ?>"></script>
<script src="<?php echo e(asset('js-files/app.js')); ?>"></script>
<!-- END: Theme JS -->



<!-- BEGIN: Vendor JS -->
<script src="<?php echo e(asset('app-assets/vendors/js/vendors.min.js')); ?>"></script>
<!-- END: Vendor JS -->

<!-- BEGIN: Page Vendor JS -->
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')); ?>"></script>
<!-- END: Page Vendor JS -->

<!-- BEGIN: Theme JS -->
<script src="<?php echo e(asset('app-assets/js/core/app-menu.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/core/app.js')); ?>"></script>
<!-- END: Theme JS -->

<!-- BEGIN: Page JS -->
<script src="<?php echo e(asset('app-assets/js/scripts/tables/table-datatables-basic.js')); ?>"></script>
<!-- END: Page JS -->


    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    <script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            responsive: true,
            scrollX: true // Fix overflow issues
        });
        feather.replace(); // ensure icons load
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




</body><?php /**PATH C:\xampp\htdocs\CRM-1\resources\views/js.blade.php ENDPATH**/ ?>