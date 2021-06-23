window._ = require("lodash");

try {
    window.Popper = require("popper.js").default;
    window.$ = window.jQuery = require("jquery");

    // require("bootstrap");
    require("bootstrap/dist/js/bootstrap.bundle");
} catch (e) {}

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// Table
require("datatables.net-bs4");
require("datatables.net-responsive-bs4");
require('datatables.net-buttons');
require('datatables.net-buttons/js/buttons.html5.min.js');
require('datatables.net-buttons/js/buttons.colVis.min.js');
require('datatables.net-buttons/js/buttons.flash.min.js');
// require('datatables.net-buttons/js/buttons.print.min.js');
require("datatables.net-buttons-bs4");
// require("jszip/dist/jszip.min.js");
// require("pdfmake/build/pdfmake.min.js");
// require("pdfmake/build/vfs_fonts");
$("#alltbl").DataTable({
    responsive: true,
});

$("#reporttbl").DataTable({
    "responsive": true,
    "lengthChange": false, 
    "autoWidth": false,
    "buttons": [
        { extend: 'copy', className: 'btn btn-sm btn-dark mr-1' },
        { extend: 'csv', className: 'btn btn-sm btn-dark mr-1' },
        { extend: 'colvis', className: 'btn btn-sm btn-dark' },
    ]
}).buttons().container().appendTo('#reporttbl_wrapper .col-md-6:eq(0)');

// Upload name 
import bsCustomFileInput from "bs-custom-file-input";
bsCustomFileInput.init();

// Select2
require("select2/dist/js/select2.min.js");
$(".select2").select2({
    theme: "bootstrap4",
    allowClear: true,
    placeholder: "Please select a product"
});

// Date Picker
require("moment/dist/moment.js");
require("daterangepicker/daterangepicker.js");
$('#reportDate').daterangepicker({
    autoUpdateInput: true,
    locale: {
        cancelLabel: 'Clear',
        format: 'YYYY-MM-DD'
    }
});
$('#reportDate').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
});
