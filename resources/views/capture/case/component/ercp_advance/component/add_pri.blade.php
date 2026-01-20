
@php


$previous_shape[] = 'Transampulla';
$previous_shape[] = 'Plastic (Christmas)';
$previous_shape[] = 'Plastic (Double Pigtail)';
$previous_shape[] = 'Plastic (Double Bend)';
$previous_shape[] = 'Plastic (Single Pigtail)';
$previous_shape[] = 'PTBD';
$previous_shape[] = 'SEMS (Non-cover)';
$previous_shape[] = 'SEMS (Bilateral Partial-cover)';
$previous_shape[] = 'SEMS (Single Partial-cover)';
$previous_shape[] = 'SEMS (Fully-cover)';
$previous_shape[] = 'Soehendra Dilator';



$previous_size[] = '3 fr';
$previous_size[] = '4 fr';
$previous_size[] = '5 fr';
$previous_size[] = '7 fr';
$previous_size[] = '8 fr (2.67 mm)';
$previous_size[] = '8.5 fr';
$previous_size[] = '10 fr (3.33 mm)';
$previous_size[] = '12 fr (4 mm)';
$previous_size[] = '14 fr (4.67 mm)';
$previous_size[] = '16 fr (5.33 mm)';
$previous_size[] = '18 fr (6 mm)';
$previous_size[] = '20 fr (6.67 mm)';
$previous_size[] = '22 fr (7.33 mm)';
$previous_size[] = '24 fr (8 mm)';
$previous_size[] = '26 fr (8.67 mm)';
$previous_size[] = '6 mm';
$previous_size[] = '8 mm';
$previous_size[] = '10 mm';
$previous_size[] = '15 mm';
$previous_size[] = '16 mm';
$previous_size[] = '20 mm';
$previous_size[] = '30 mm';


$previous_lenght[] = '1 cm';
$previous_lenght[] = '1.5 cm';
$previous_lenght[] = '2 cm';
$previous_lenght[] = '4 cm';
$previous_lenght[] = '5 cm';
$previous_lenght[] = '6 cm';
$previous_lenght[] = '7 cm';
$previous_lenght[] = '8 cm';
$previous_lenght[] = '9 cm';
$previous_lenght[] = '10 cm';
$previous_lenght[] = '12 cm';
$previous_lenght[] = '15 cm';
$previous_lenght[] = '20 cm';
$previous_lenght[] = 'NB';
$previous_lenght[] = 'PTBD';

$previous_location[] = 'CBD';
$previous_location[] = 'PD';

$previous_position[] = 'In Position';
$previous_position[] = 'Upward Migration';
$previous_position[] = 'Downward Migration';
$previous_position[] = 'Spontaneous Migration';

$previous_removal[] = 'None';
$previous_removal[] = 'Balloon';
$previous_removal[] = 'Basket';
$previous_removal[] = 'Biopsy Forcep';
$previous_removal[] = 'Grasping Forcep';
$previous_removal[] = 'Snare';
$previous_removal[] = 'Spyglass';
$previous_removal[] = 'Manual Remove';

$previous_outcome[] = 'None';
$previous_outcome[] = 'Success';
$previous_outcome[] = 'Fail';

@endphp

<div class="add_previousstent" style="display: none;">
    <div class="row  px-3 advance">
        <div class="row p-2">
            <div class="col-lg-9 ">
                <div class="row">
                    <div class="col-3">
                        {!! selectadvanced('previous_shape_g1', $previous_shape, $save ?? '') !!}
                    </div>
                    <div class="col-2">
                        {!! selectadvanced('previous_size_g1', $previous_size, $save ?? '') !!}
                    </div>
                    <div class="col-2">
                    {!! selectadvanced('previous_lenght_g1', $previous_lenght, $save ?? '') !!}
                    </div>
                    <div class="col-2">
                    {!! selectadvanced('previous_location_g1', $previous_location, $save ?? '') !!}
                    </div>
                    <div class="col-3">
                    {!! selectadvanced('previous_position_g1', $previous_position, $save ?? '') !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ">
                <div class="row">

                    <div class="col-4">
                    {!! selectadvanced('previous_removal_g1', $previous_removal, $save ?? '') !!}
                    </div>
                    <div class="col-4">
                    {!! selectadvanced('previous_outcome_g1', $previous_outcome, $save ?? '') !!}
                    </div>
                    <div class="col-3">
                        <input name="previous_txtpieces_g1[]" type="text" class="form-control">
                    </div>
                    <div class="col-1 align-self-center ">
                        <a type="button" class="btn-transparent btn-danger btn-cancel remove" ><i
                            class="ri-indeterminate-circle-fill ri-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
