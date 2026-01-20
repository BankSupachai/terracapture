@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')
<link rel="stylesheet" href="{{url("public/css/endo/vdo_library.css")}}">
@endsection




@section('modal')

@endsection



@section('content')
@php
    $name_vdo[1] = "Upper GI Endoscopy, EGD - PreOp Surgery Patient Education - Engagement";
    $name_user[1] = "นพ.สดายุ ทำงานหนัก";
    $name_view[1] = "45k views | 4 years ago";
    $detail_vdo[1] = "Female, 42 Yrs";
    $comment_vdo[1] = "Endoscopic ultrasound is an endoscopy procedure using a special endoscope with ultrasound capability. It is used for the purpose of evaluating internal organs of the chest and abdomen, along with the lining of the gastrointestinal tract. ";

    $name_vdo[2] = "Upper GI Endoscopy Procedure in the ED";
    $name_user[2] = "นพ.สดายุ ไผ่ล้อม";
    $name_view[2] = "4k views | 5 years ago";
    $detail_vdo[2] = "Male, 50 Yrs";
    $comment_vdo[2] = "Here we see ultrasound images of the pancreas. Use of the echoendoscope allows for visualization of the pancreas within close approximation of the stomach wall particularly the tissue and ductal structures.";

    $name_vdo[3] = "Preparing for an Upper GI Endoscopy - from the American Gastroenterological Association";
    $name_user[3] = "นพ.สดายุ ทำงานหนัก";
    $name_view[3] = "564 views | 5 month ago";
    $detail_vdo[3] = "Male, 42 Yrs";
    $comment_vdo[3] = "Here, a needle is passed through the stomach wall into a pancreatic pseudocyst, followed by a wire through the needle. The newly created cyst-gastrostomy tract is then dilated with a balloon.";

    $name_vdo[4] = "Upper Gastrointestinal Endoscopy: Examination Technique and Standard Findings";
    $name_user[4] = "นพ.สดายุ ทำงานหนัก";
    $name_view[4] = "456 views | 3 month ago";
    $detail_vdo[4] = "Male, 78 Yrs";
    $comment_vdo[4] = "This medical animation illustrates the use of endoscopic ultrasound (EUS) at Cincinnati Children’s, to evaluate intra-abdominal organs and the lining of the gastrointestinal tract. EUS is an advanced endoscopy procedure that uses a flexible, lighted tube with ultrasound capability. The specialized echoendoscope can also be used to obtain biopsies of internal abdominal organs or masses, and perform endoscopic treatment of pancreatic and abdominal fluid collections.";

    $name_vdo[5] = "Upper GI Endoscopy Procedure in the ED";
    $name_user[5] = "นพ.สดายุ ทำงานหนัก";
    $name_view[5] = "150 views | 2 week ago";
    $detail_vdo[5] = "Female, 28 Yrs";
    $comment_vdo[5] = "A larger, lumen apposing metal stent may be used for walled off necrosis.Cincinnati Children’s provides endoscopic ultrasound and other advanced endoscopic procedures to patients of all ages.";

    $name_vdo[6] = "Upper Gastrointestinal Endoscopy: Examination Technique and Standard Findings";
    $name_user[6] = "นพ.สดายุ ทำงานหนัก";
    $name_view[6] = "43 views | 5 month ago";
    $detail_vdo[6] = "Male, 86 Yrs";
    $comment_vdo[6] = "Plastic stents are placed to keep this tract open and allow the cyst fluid to drain into the stomach.  These will be removed in a few months when the pseudocyst has resolved.";


    $this_vdo = "<div class='embed-responsive embed-responsive-16by9'><iframe class='embed-responsive-item' src='.../public/image/demo_img)/Vdo.mp4' allowfullscreen></iframe></div>";
@endphp
<div class="row m-0">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-8"><input type="text" name="" class="form-control" id="" placeholder="Name, Tag, Detail, Procedure..."></div>
                    <div class="col-lg-4"><button class="btn btn-success w-100"><i class="flaticon2-search-1 icon-md"></i> Search</button></div>
                </div>
                <div class="row ">
                    <div class="table-responsive ht-70 mt-5">
                        <table class="table table-borderless table-hover">
                            @for($i=1;$i<7;$i++)
                            <tr class="menu_vdo" name_vdo="{{$name_vdo[$i]}}" name_user="{{$name_user[$i]}}" name_view="{{$name_view[$i]}}" detail_vdo="{{$detail_vdo[$i]}}" comment_vdo="{{$comment_vdo[$i]}}" vdo_show="{{$this_vdo}}">
                                <td class="w-40"><img src="{{url('public/image/demo_img')}}/img{{$i}}.jpg" alt="" srcset="" class="img-thumbnail"></td>
                                <td class="w-60">
                                    <h2>{{$name_vdo[$i]}}</h2>
                                    <br>
                                    <k style="font-size: medium;">{{$name_user[$i]}}<br>
                                    {{$name_view[$i]}}</k>
                                </td>
                            </tr>
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body">
                <div class="embed-responsive embed-responsive-16by9" id="show_mp4">
                    <iframe class="embed-responsive-item" src="{{url('public/image/demo_img')}}/Vdo.mp4" allowfullscreen></iframe>
                </div>
                <br>
                <h1><div id="name_vdo"></div></h1>
                <k style="font-size: medium;">
                <div id="name_user"></div>
                <div id="name_view"></div><br>
                <div id="detail_vdo"></div>
                <div id="comment_vdo"></div>
                </k>
            </div>
        </div>
    </div>
</div>

@endsection



@section('script')
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $(".menu_vdo").click(function(){
        $(".menu_vdo").css('background','');
        $(this).css('background','#E4E6EF');
    });
    $("#show_mp4").hide();

    $(".menu_vdo").click(function(){
        $("#show_mp4").hide();
        var vdo_show = $(this).attr('vdo_show');
        var name_vdo = $(this).attr('name_vdo');
        var name_user = $(this).attr('name_user');
        var name_view = $(this).attr('name_view');
        var detail_vdo = $(this).attr('detail_vdo');
        var comment_vdo = $(this).attr('comment_vdo');

        $("#show_mp4").show(100);
        $("#name_vdo").html(name_vdo);
        $("#name_user").html(name_user);
        $("#name_view").html(name_view);
        $("#detail_vdo").html("Patient Detail : "+detail_vdo);
        $("#comment_vdo").html(comment_vdo);

    });
</script>

@endsection
