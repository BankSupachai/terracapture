<div class="row m-0 mt-3">
    <div class="col-lg-12 pt-4">
        <div class="form-check mb-2">
            <input class="form-check-input save-json set-menu-checked" data-id="menu_pictures" type="checkbox" name="ck_pictures" id="ck_pictures" @if(@$json->ck_pictures!='false') checked @endif>
            <label class="form-check-label label-underline" for="ck_pictures">
                Photo
            </label>
        </div>
        <div class="w-100 set-menu-change {{data_check_active(@$json->ck_pictures,'auto')}}" id="menu_pictures">
            <div class="row">
                <input type="hidden" id="sort_img" value="{{$num_img}}">
                <div class="col-lg-12 card-graph">
                    <ul class="row mt-3 m-0 atb">

                        @if(count($images)>0)
                            @for ($i=0;$i<count($images);$i++)
                                <li class="col-3 img-numx">
                                    @if(isset($photo) && @$photo !='')
                                        @if(in_array($images[$i],$photo))
                                            @php
                                                for ($x=0;$x<count($photo);$x++){
                                                    if($photo[$x]==$images[$i]){
                                                        $key = $x;
                                                    }
                                                }
                                            @endphp
                                        @endif
                                    @endif
                                    <input type="checkbox" id="myimge{{$i}}" name="image[]" value="{{$images[$i]}}" class="ck-json-img"
                                        @if(isset($photo) && @$photo !='')
                                            @if(in_array($images[$i],$photo))
                                                checked
                                                data-num="{{$key+1}}"
                                            @endif
                                        @endif
                                    />



                                    <label for="myimge{{$i}}">
                                        <img src='{{picurl($images[$i])}}' class="img-fluid">
                                    </label>
                                    @php
                                        $name_img = "text_img[$image_name[$i]]";
                                    @endphp
                                    <input type="text" name="text_img[{{$image_name[$i]}}]" id="" class="form-control save-json {{data_check_bg(@$json->$name_img)}}" value="{{@$json->$name_img}}">
                                    @if(isset($photo) && @$photo !='')
                                        @if(in_array($images[$i],$photo))
                                            <div class="box-number" sub-num="{{$key+1}}">{{$key+1}}</div>
                                        @endif
                                    @endif
                                </li>
                            @endfor
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
