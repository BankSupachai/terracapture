





var KTBootstrapDatepicker = function () {

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
    var demos = function () {
     // minimum setup


     // enable clear button
     $('#kt_datepicker_3, #kt_datepicker_3_validate').datepicker({
      rtl: KTUtil.isRTL(),
      todayBtn: "linked",
      clearBtn: true,
      todayHighlight: true,
      templates: arrows
     });

     // enable clear button for modal demo
     $('.kt_datepicker_3_modal').datepicker({
      rtl: KTUtil.isRTL(),
      todayBtn: "linked",
      clearBtn: true,
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



   // Class definition

var KTAutosize = function () {

    // Private functions
    var demos = function () {
     // basic demo
     var demo1 = $('.kt_autosize_1');
     var demo2 = $('#kt_autosize_2');

     autosize(demo1);

     autosize(demo2);
     autosize.update(demo2);
    }

    return {
     // public functions
     init: function() {
      demos();
     }
    };
   }();

   jQuery(document).ready(function() {
    KTAutosize.init();
   });



   // Class definition

var KTBootstrapSelect = function () {

    // Private functions
    var demos = function () {
     // minimum setup
     $('.kt-selectpicker').selectpicker();
    }

    return {
     // public functions
     init: function() {
      demos();
     }
    };
   }();

   jQuery(document).ready(function() {
    KTBootstrapSelect.init();
   });
