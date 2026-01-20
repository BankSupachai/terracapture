<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-12 mb-3">
                    <h4>Pre-Procedure</h4>
                    <span class="text-muted">Please fill in the field then click “Create Report”</span>
                </div>
                {{-- <div class="col-xl-12">
                    <div class="row">
                        <div class="col-6">
                            @include('case.component.sub.anesthesia')
                            @include('case.component.sub.medication')
                        </div>
                        <div class="col-6">
                            @include('case.component.ercp.position')
                            @include('case.component.ercp.scope_position')
                        </div>
                    </div>
                </div>

                <div class="col-3">&nbsp;</div>
                <div class="col-6"><hr></div>
                <div class="col-3">&nbsp;</div> --}}

                <div class="col-xl-6">
                    <div class="row">
                        @include('case.component.ercp.indication')
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="row">
                        @include('case.component.ercp.indication_text')
                    </div>
                </div>

{{--
                <div class="col-xl-6">
                    <div class="row">
                        @include('case.component.ercp.finding_typeofmajor')
                        @include('case.component.ercp.finding_Infundibulum')
                        @include('case.component.ercp.finding_transverse')
                        @include('case.component.ercp.finding_diverticulum')
                        @include('case.component.ercp.finding_periampullary')

                    </div>
                </div> --}}



            </div>
        </div>
    </div>
</div>


