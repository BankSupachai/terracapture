
<div class="col-12">
    @php
        // $text = get_total_str(@$case->complete_cholangiogram_other);
        $text = @$case->complete_cholangiogram_other;
        if(!isset($text) || @$text."" == ""){
            $text = "Free text";
        }
    @endphp
    <textarea id="complete_cholangiogram_other" subgroup="" class="form-control savejson_edit" name="complete_cholangiogram_other" rows="12" cols="50">{{@$text}}</textarea>
</div>



