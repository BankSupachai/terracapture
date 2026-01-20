$(function() {
    $('.table-responsive').responsiveTable({
        addDisplayAllBtn: 'btn btn-secondary'
    });
});
var wi = $(window).width();
if(wi<500){
    $('#remove-scroll').hide();
}else{
    $('.list-inline').hide();
}

$("#openpage").click(function(){
    $("#remove-scroll").toggle();
});
$("button").click(function(){
    $("button").removeClass("active");
    $(this).addClass("active");
});


$("#tab5").trigger( "click" );

$("#tab5").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
    $("#showtab5").show();
});

$("#tab6").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab7").hide();
    $("#showtab6").show();
});

$("#tab7").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").show();
});

$("#tab1").click(function(){
    $("#showtab1").show();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
});

$("#tab2").click(function(){
    $("#showtab1").hide();
    $("#showtab2").show();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
});

$("#tab3").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").show();
    $("#showtab4").hide();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
});

$("#tab4").click(function(){
    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").show();
    $("#showtab5").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
});

    $("#showtab1").hide();
    $("#showtab2").hide();
    $("#showtab3").hide();
    $("#showtab4").hide();
    $("#showtab6").hide();
    $("#showtab7").hide();
