

$('.scroll_slider .next span').click(function(){
var x=$(this).parents('.scroll_slider').find('.main ul') ;
var marginRight= x.css('marginRight');
var b=parseFloat(marginRight);



if(b == 0){
    x.animate({'marginRight':'-100px'},800)

}
else{
    x.animate({'marginRight':'+=100px'},800)
}


});





$('.scroll_slider .prev span').click(function(){

var x=$(this).parents('.scroll_slider').find('.main ul') ;
var marginRIght= x.css('marginRight');
var a=parseFloat(marginRIght);
if(a <= -100){
   x.animate({'marginRight':'0px'},800)

}
else{
   x.animate({'marginRight':'-=100px'},800)
}
})


