$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('input').attr('autocomplete','off');
$("#otherid").click(function(){
    if(document.getElementById('otherid').checked) {
        $("#othermain").show();
        $("#othersub").show();
    } else {
        $("#othermain").hide();
        $("#othersub").hide();
    }
  });

document.getElementById("hn").addEventListener("keyup", function() {
    if (/^[a-zA-Z0-9-]+$/.test(this.value)) {
        // document.getElementById("show_lang_in_here").innerHTML = "English";
    } else {
        this.value = "";
}
});
document.getElementById("first_name").addEventListener("keyup", function() {
    if (/^[ a-zA-Zกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบป(--)ผฝพฟภมยรฤลฦวศษสหฬอฮฯะัาำิีึืฺุูเแโใไๅๆ็่้๊๋์]+$/.test(this.value)) {
        // document.getElementById("show_lang_in_here").innerHTML = "English";
    } else {
        console.log(':val',this.value);
        str = this.value;
        str = str.substring(0, str.length - 1);
        this.value = str;
}
});

document.getElementById("middlename").addEventListener("keyup", function() {
    if (/^[ a-zA-Zกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบป(--)ผฝพฟภมยรฤลฦวศษสหฬอฮฯะัาำิีึืฺุูเแโใไๅๆ็่้๊๋์]+$/.test(this.value)) {
        // document.getElementById("show_lang_in_here").innerHTML = "English";
    } else {
        console.log(':val',this.value);
        str = this.value;
        str = str.substring(0, str.length - 1);
        this.value = str;
}
});
document.getElementById("last_name").addEventListener("keyup", function() {
    if (/^[ a-zA-Zกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบป(--)ผฝพฟภมยรฤลฦวศษสหฬอฮฯะัาำิีึืฺุูเแโใไๅๆ็่้๊๋์]+$/.test(this.value)) {
        // document.getElementById("show_lang_in_here").innerHTML = "English";
    } else {
        str = this.value;
        str = str.substring(0, str.length - 1);
        this.value = str;
}
});


    $('input[type=text]').each(function() {
        if($(this).val() != '' && $(this).val() != null){
            $(this).css('background','#d2ebf6');
        }else{
            // $(this).val('Normal');
        }
    });


    $('select').each(function() {
        if($(this).val() != '' && $(this).val() != null){
            $(this).css('background','#d2ebf6');
        }else{
            // $(this).val('Normal');
        }
    });
    $('input[type=number]').each(function() {
        if($(this).val() != '' && $(this).val() != null){
            $(this).css('background','#d2ebf6');
        }else{
            // $(this).val('Normal');
        }
    });
    $('textarea').each(function() {
        if($(this).text() != '' && $(this).text() != null){
            $(this).css('background','#d2ebf6');
        }else{
            // $(this).val('Normal');
        }
    });

    $('.form-control').focusout(function(){
        var text_val = $(this).val();
        if(text_val !=null&& text_val != ''){
            $(this).css('background','#d2ebf6');
        }else{
            $(this).css('background','none');
        }
    });
