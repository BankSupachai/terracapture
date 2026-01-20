$(document).ready(function() {
    $("#datepicker").datepicker({
        format: 'yyyy-mm-dd'
    });
    $("#datepicker").on("change", function() {
        var fromdate = $(this).val();
    });

    $("#datepicker2").datepicker({
        format: 'yyyy-mm-dd'
    });
    $("#datepicker2").on("change", function() {
        var fromdate = $(this).val();
    });
});
$("#date_start,#date_end").datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true
});
$("#date_start,#date_end").on("change", function() {
    var fromdate = $(this).val();
});
var KTBootstrapDatepicker = function() {

    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }

    // Private functions
    var demos = function() {
        // minimum setup


        // enable clear button for modal demo
        $('#kt_datepicker_3_modal').datepicker({
            rtl: KTUtil.isRTL(),
            todayBtn: "linked",
            clearBtn: true,
            todayHighlight: true,
            templates: arrows
        });



        // range picker
        $('#kt_datepicker_5').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            templates: arrows
        });

    }

    return {
        // public functions
        init: function() {
            demos();
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapDatepicker.init();
});
