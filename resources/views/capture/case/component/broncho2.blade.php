<style>
    .cnt {
        align-self: center;
    }
</style>
@php
    if (!function_exists('bronchogroup')) {
        function bronchogroup($case, $group, $name, $text)
        {
            $box = box(@$case->$name);
            $html = "<div class='cnt'>
                        <input $box
                            id      = '$name'
                            name    = '$name'
                            type    = 'checkbox'
                            class   = 'form-check-input  savejson ebush'
                            subis   = '$group'>&emsp;
                        <label for='$name'><b for='ebus'>$text</b></label>
                    </div>";
            return $html;
        }
    }

    if (!function_exists('bronchotext')) {
        function bronchotext($case, $group, $name, $text, $col)
        {
            $text = @$case->$name;
            $html = "

                    <div class='col-$col  cnt $group'>
                        <input
                            id      = '$name'
                            type    = 'text'
                            name    = '$name'
                            class   = 'form-control  savejson autotext mt-2'
                            value   = '$text'
                            autocomplete='off'
                        >
                    </div>

                    ";
            return $html;
        }
    }

    if (!function_exists('bronchobox')) {
        function bronchobox($case, $group, $name, $text)
        {
            $box = box(@$case->$name);
            $html = "<div class=' cnt text-nowrap $group'>
                        <input  type='checkbox' $box
                                class='form-check-input savejson'
                                id='$name'
                                name='$name'>
                        <label for='$name'>
                            <b for='$name'>&emsp;$text</b>
                        </label>
                    </div>";
            return $html;
        }
    }

    if (!function_exists('bronchoradiobox')) {
        function bronchoradiobox($case, $group, $name, $text, $value)
        {
            $box = box(@$case->$name);
            $checked = '';
            if (@$case->$name == $value) {
                $checked = 'checked';
            }

            $html = "<div class='cnt text-nowrap $group'>
                        <input  type='radio' $box
                                class='form-check-input saveradio'
                                id='$name$text'
                                name='$name'
                                value='$value'
                                $checked>

                        <label for='$name$text'>
                            <b for='$name'>&emsp;$value</b>
                        </label>
                    </div>";
            return $html;
        }
    }
@endphp
<link rel="stylesheet" href="{{ url('public/css/component/broncho.css') }}">
<div class="col-12">
    {!! editcard('broncho', 'broncho.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">

            <b>PROCEDURE (ICD-9)</b><br><br>
            <div class="row">
                <div class="col-1 text-nowrap cnt">
                    {!! bronchogroup($case, 'ebuss', 'ebus_box', 'EBUS') !!}
                </div>
                <div class="col-3 ebuss">
                    {!! bronchotext($case, 'ebuss', '', 'ebus', '', '', 12) !!}
                </div>

                <div class="col-1 ebuss cnt text-end">
                    Distance (cm)
                </div>
                <div class="col-3 ebuss">
                    {!! bronchotext($case, 'ebuss', '', 'ebus', '', '', 12) !!}
                </div>
                <div class="col-1 ebuss cnt text-end">
                    Time(min)
                </div>
                <div class="col-3 ebuss">
                    {!! bronchotext($case, 'ebuss', '', 'ebus', '', '', 12) !!}
                </div>



                <hr class="ebuss mt-2">
            </div>


        </div>
    </div>
</div>


<script>
    $('.ebush').click(function() {
        var is_class = $(this).attr('subis');
        if ($(this).prop("checked") == true) {
            $("." + is_class).show(500);
        } else {
            $("." + is_class).hide(500);
        }
    });

    check_on_show("{{ @$case->EBUS_TBNA_location }}", ".ebustbna");
    check_on_show("{{ @$case->ebus_box }}", ".ebuss");
    check_on_show("{{ @$case->ebus_guide_sheath_box }}", ".ebusg");
    check_on_show("{{ @$case->autofluoresence_box }}", ".autof");
    check_on_show("{{ @$case->virtual_bronchoscopy_box }}", ".vtlbr");
    check_on_show("{{ @$case->Bronchial_Washing_site_box }}", ".bcwa");
    check_on_show("{{ @$case->Bronchoalveolar_Lavage_site_box }}", ".bclvl");
    check_on_show("{{ @$case->TBLB_box }}", ".tblb");
    check_on_show("{{ @$case->Bronchial_biopsy_box }}", ".bcbp");
    check_on_show("{{ @$case->EBUS_TBNA_lymphnode_station }}", ".ebustatbna");
    check_on_show("{{ @$case->fluoroscopy_box }}", ".flu");
    check_on_show("{{ @$case->sqtna_box }}", ".sqtna");
    check_on_show("{{ @$case->cryop_group }}", ".cryna");
    check_on_show("{{ @$case->wang_needle_group }}", ".wnasna");




    check_on_show("{{ @$case->TBNA_box }}", ".tbnaa");
    check_on_show("{{ @$case->Bronchial_brush_box }}", ".bcba");
    check_on_show("{{ @$case->rigid_bronchoscope }}", ".rigid_b");
    check_on_show("{{ @$case->dilatation }}", ".dilatation");
    check_on_show("{{ @$case->dilatation_at }}", ".dilatation_at");
    check_on_show("{{ @$case->dilatation_at_02 }}", ".dilatation_at_02");
    check_on_show("{{ @$case->tumor_removal_at }}", ".tumor_removal_at");
    check_on_show("{{ @$case->body_removal_at }}", ".body_removal_at");
    check_on_show("{{ @$case->stent_placement }}", ".stent_placement");
    check_on_show("{{ @$case->endobronchial_block_at }}", ".endobronchial_block_at");
    check_on_show("{{ @$case->others_05 }}", ".others_05");

    function check_on_show(check, classname) {
        if (check == "false" || check == "" || check == null) {
            $(classname).hide();
        }
    }
</script>
