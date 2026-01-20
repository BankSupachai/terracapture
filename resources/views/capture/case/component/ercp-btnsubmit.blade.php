<div class="col-12 py-2 text-center">

    {{-- <button class="btn btn-create-custom fs-16 fw-normal" ><i class="ri-dossier-fill"></i> Create Report</button> --}}
    <div style="font-weight: normal;">
        @if (getCONFIG('feature')->system_esign)
        <a type="submit" name="report" value="true" id="btn_save" class="btn btn-create-custom " >

            <span class="fs-18 p-2"> <i class="ri-dossier-fill"></i> &ensp; Create Report</span>
        </a>
        @else
        <a type="submit" id="btn_save_hide" name="report" value="true" class="btn btn-create-custom ">
            <span class="fs-18 p-2"> <i class="ri-dossier-fill"></i>&ensp; Create Report </span>
        </a>
        @endif
    </div>
</div>
