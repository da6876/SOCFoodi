
<!-- container-scroller -->
<!-- base:js -->
<script src="admin/vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="admin/js/template.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- End plugin js for this page -->
<script src="admin/vendors/chart.js/Chart.min.js"></script>
<script src="admin/vendors/progressbar.js/progressbar.min.js"></script>
<script src="admin/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
<script src="admin/vendors/justgage/raphael-2.1.4.min.js"></script>
<script src="admin/vendors/justgage/justgage.js"></script>
<script src="admin/js/jquery.cookie.js" type="text/javascript"></script>
<!-- Custom js for this page-->
<script src="admin/js/dashboard.js"></script>
<!-- End custom js for this page-->

<script src="admin/js/jquery.dataTables.js"></script>
<script src="admin/js/dataTables.bootstrap4.js"></script>
<script>
    (function($) {
        'use strict';
        $(function() {
            $('#order-listing').DataTable({
                "aLengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    search: ""
                }
            });
            $('#order-listing').each(function() {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });
        });
    })(jQuery);
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="admin/js/dropify.min.js"></script>
<script src="admin/js/dropify.js"></script>