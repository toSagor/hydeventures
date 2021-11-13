<script src="<?php echo baseUrl('admin/assets/js/jquery.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/bootstrap_min.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/date_picker.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/slimscroll.min.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/fastclick.min.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/app_min.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/jquery_data_table.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/data_table.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/bootstrap_data_table_responsive.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/input_mask.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/input_mask_date_extension.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/input_mask_extension.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/multiple_select_full_min.js'); ?>"></script>
<script src="<?php echo baseUrl('admin/assets/js/bootstrap-timepicker.min.js'); ?>"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script src="<?php echo baseUrl('admin/assets/kendo/js/kendo.web.min.js') ?>" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.date').datepicker({
            format: 'dd/mm/yyyy'
        });
        $("[data-mask]").inputmask();
        $(".select2").select2();
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
</script>