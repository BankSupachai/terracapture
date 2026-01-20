function readURL(input,selecter_number) {
    var selecter = selecter_number;
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
        $('.text-'+selecter+' .image-upload-wrap').hide();
        var show_type = "";
        if(input.files[0].type=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
            show_type = "<i class='fas fa-file-excel text-success'></i> "+input.files[0].name;
        }else{
            show_type = "<i class='far fa-window-close text-danger'></i> ไฟล์ไม่ถูกต้อง";
        }
        $('.text-'+selecter+' .file-upload-image').html(show_type);
        $('.text-'+selecter+' .file-upload-content').show();

        $('.text-'+selecter+' .image-title').html(input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);

    } else {
        removeUpload();
    }
}

function removeUpload(remove_select) {
        var remove = remove_select;
        $('.text-'+remove+' .file-upload-input').replaceWith($('.text-'+remove+' .file-upload-input').clone());
        $('.text-'+remove+' .file-upload-content').hide();
        $('.text-'+remove+' .image-upload-wrap').show();

    $('.text-'+remove+' .image-upload-wrap').bind('dragover', function () {
        $('.text-'+remove+' .image-upload-wrap').addClass('image-dropping');
    });
    $('.text-'+remove+' .image-upload-wrap').bind('dragleave', function () {
        $('.text-'+remove+' .image-upload-wrap').removeClass('image-dropping');
    });
}






// Class definition

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
