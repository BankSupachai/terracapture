@php
$date_prepare = date("Y-m-d H:i:s   ");

@endphp
<style>

</style>
<div class="row justify-content-end m-0" style="background: #ffffff;">
<div class="col-2 fw-bold">
Time Stamp
</div>
<div class="col-3">
<span>{{@$date_prepare }}</span>
</div>
<div class="row justify-content-end mt-2 m-0">
<div class="col-2 fw-bold">
    Appointed By
</div>
<div class="col-3">
    <select name="" id="" class="form-select">
        @foreach ($nurse as $nursedata)
        <option value="{{ $nursedata['id'] }}">{{ $nursedata['user_prefix'] }}
            {{ $nursedata['user_firstname'] }} {{ $nursedata['user_lastname'] }}
        </option>
        @endforeach
    </select>
</div>

</div>
<div class="row justify-content-end m-0 pb-2">
<div class="col-2">
</div>
<div class="col-3">
    <div class="row mt-2">
        <div class="col-6">
            <button class="btn btn-danger text-nowrap"> Save & Send message</button>
        </div>
        <div class="col-6">
            <button class="btn btn-success w-100">Save & Print</button>
        </div>
    </div>
</div>

</div>
</div>
