$(".selectpicker").change(function(){
    var data_color = $(this).attr("data-color");
    if($(this).val()=='1'){
        $(".border"+data_color).addClass("border-red");
    }else{
        $(".border"+data_color).removeClass("border-red");
    }
})
