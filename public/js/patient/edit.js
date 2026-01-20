$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('input[type=text]').each(function() {

    if($(this).val() != '' && $(this).val() != null){
        $(this).css('background','#d2ebf6');
    }else{
    }
});
$('select').each(function() {
    if($(this).val() != '' && $(this).val() != null){
        $(this).css('background','#d2ebf6');
    }else{
    }
});
$('input[type=number]').each(function() {
    if($(this).val() != '' && $(this).val() != null){
        $(this).css('background','#d2ebf6');
    }else{
    }
});
$('textarea').each(function() {
    if($(this).text() != '' && $(this).text() != null){
        $(this).css('background','#d2ebf6');
    }else{
    }
});
$('.form-control').focusout(function(){
    var text_val = $(this).val();
    if(text_val !=null&& text_val != ''){
        $(this).css('background','#d2ebf6');
    }else{
        $(this).css('background','none');
    }
})



$('#hn').keypress(function(e){

var chr = String.fromCharCode(e.which);
if ("></\\".indexOf(chr) >= 0)
return false;

});




$(document).ready(function() {
$('#step02').hide();
$('#step03').hide();
$('#step04').hide();
$('#headshow02').hide();
$('#headshow03').hide();
$("#othermain").hide();
$("#othersub").hide();
$("#video").hide();

$("#savestep01").click(function(){
  $('#step01').hide();
  $('#step02').show();
  $('#headshow01').hide();
  $('#headshow02').show();
});

$("#savestep02").click(function(){
  $('#step02').hide();
  $('#step03').show();
  $('#headshow02').hide();
  $('#headshow03').show();
});

$("#savestep03").click(function(){
  $('#step03').hide();
  $('#step04').show();
});
});



$("#otherid").click(function(){
if(document.getElementById('otherid').checked) {
    $("#othermain").show();
    $("#othersub").show();
} else {
    $("#othermain").hide();
    $("#othersub").hide();
}
});

$("#hn").click(function(){
    Swal.fire("ไม่สามารถแก้ไข HN ได้!", "ถ้าต้องการเเก้ไข HN กรุณาติดต่อ MedicaHealthcare", "warning");
});
