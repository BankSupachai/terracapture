<div class="col-4">
    Success CBD Cannulation&nbsp;&nbsp; &nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-12">
        <input type="radio" {{ checkradio($case, 'canusuccess_other', 'Success at 1st attempt') }}
            name="Success CBD Cannulation"
            class="form-check-input radiosave ck-no radioother"
            other="canusuccess_other"
            subgroup="successcbdcannu"
            datagroup="SuccessCBDCannulation"
            id="{{ md5('Success CBD Cannulation Success at 1st attempt') }}"
            value="Success at 1st attempt">
        <label class="ms-4" for="{{ md5('Success CBD Cannulation Success at 1st attempt') }}">&nbsp;Success at 1st
            attempt</label>
    </div>
    <div class="col-12">
        <div class="row mb-2">
            <div class="col-auto align-self-center">
                @php
                    $havesuccess_other = ' ';
                    if(isset($case->canusuccess_other)){
                        try{
                            if (preg_match('/\b(\d+)\b/', $case->canusuccess_other, $matches)) {
                                $havesuccess_other = $matches[1]; 
                            }
                        } catch(\Exception $e) {}
                    }
                @endphp
                <input
                type="radio"
                subgroup="successcbdcannu"
                @if(str_contains(@$case->canusuccess_other, $havesuccess_other)) checked @endif
                {{-- {{ checkradio($case, 'canusuccess_other', 'Success at') }} --}}

                    name="Success CBD Cannulation"
                    class="form-check-input radiosave ck-successcbdcannu radioother"
                    other="canusuccess_other"
                    datagroup="SuccessCBDCannulation"
                    subgroup="successcbdcannu" id="{{ md5('Success at') }}"
                    value="Success at"
                    >
                <label class="ms-4" for="{{ md5('Success at') }}">&nbsp;Success at</label>
            </div>
            <div class="col-3">
                
                <select
                name="select_successcbd"
                datagroup="SuccessCBDCannulation"
                radiootherval="{{ md5('Success at') }}"
                subgroup="successcbdcannu"
                class="form-select ck-select radiosave savejson_edit ck-radio ck-successcbdcannu-input"
                >
                    <option value="">Select</option>
                    <option value="2" @if(@$havesuccess_other == '2') selected @endif>2</option>
                    <option value="3" @if(@$havesuccess_other == '3') selected @endif>3</option>
                    <option value="4" @if(@$havesuccess_other == '4') selected @endif>4</option>
                </select>
            </div>
            <div class="col-2 align-self-center" radioothervalend="{{ md5('Success at') }}">attempts</div>
        </div>
    </div>
    <div class="col-12">
        <input type="radio" {{ checkradio($case, 'canusuccess_other', 'Success more than 5 attempts, more than 5 mins') }}
            name="Success CBD Cannulation"
            subgroup="successcbdcannu"
            class="form-check-input radiosave ck-no radioother" other="canusuccess_other"
            datagroup="SuccessCBDCannulation"
            id="{{ md5('Success CBD Cannulation Success more than 5 attempts, more than 5 mins') }}"
            value="Success more than 5 attempts, more than 5 mins">
        <label class="ms-4"
            for="{{ md5('Success CBD Cannulation Success more than 5 attempts, more than 5 mins') }}">&nbsp;Success more
            than 5 attempts, more than 5 mins</label>
    </div>
    <div class="col-12">
        <input type="radio" {{ checkradio($case, 'canusuccess_other', 'Success more than 10 attempts, more than 10 mins') }}
            name="Success CBD Cannulation"
            subgroup="successcbdcannu"
            class="form-check-input radiosave ck-no radioother" other="canusuccess_other"
            datagroup="SuccessCBDCannulation"id="{{ md5('Success CBD Cannulation Success more than 10 attempts, more than 10 mins') }}"
            value="Success more than 10 attempts, more than 10 mins">
        <label class="ms-4"
            for="{{ md5('Success CBD Cannulation Success more than 10 attempts, more than 10 mins') }}">&nbsp;Success
            more than 10 attempts, more than 10 mins</label>
    </div>

    <div class="col-12">
        <input class="form-control autotext savejson" id="canusuccess_other" placeholder="Detail" type="text"
            autocomplete="off" value="{{ @$case->canusuccess_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>
