$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $('[data-toggle="popover"]').popover()
});

function click_it(){

    // setInterval(function () {
        $(".count_img").click(function(){
            if($(this).attr('text_num')==null){
                $(this).addClass('img_border');
                $(".count_img").each(function() {
                    if($(this).attr('text_num')!=null && $(this).attr('text_num')!=''){
                        if($(this).attr('text_num')>number){
                            number = $(this).attr('text_num');
                        }
                    }
                });
                number++;
                var text_num = "<div class='top_num' text_num='"+number+"'>"+number+"</div>";
                $(this).before(text_num);
                $(this).attr('text_num',number);
            number = 0;
            }else{
                $(this).removeClass('img_border');

                var lock_num = $(this).attr('text_num');
                $(".top_num").each(function() {
                    if($(this).attr('text_num')==lock_num){
                        $(this).remove();
                    }
                });
                $(".count_img").each(function() {
                    if($(this).attr('text_num')==lock_num){
                        $(this).attr('text_num',null);
                    }
                    if($(this).attr('text_num')>lock_num){
                        var this_is = $(this).attr('text_num')-1;
                        $(this).attr('text_num',this_is);
                    }
                });
                $(".top_num").each(function() {
                    if($(this).attr('text_num')>lock_num){
                        num_save = $(this).attr('text_num');
                        num_new = num_save-1;
                        var text_num = "<div class='top_num' text_num='"+num_new+"'>"+num_new+"</div>";
                        $(this).before(text_num);
                        $(this).remove();
                    }
                });
            }
        });
    // }, 3000);
}
