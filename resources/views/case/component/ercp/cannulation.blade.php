<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h5>Cannulation</h5>
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-5 ">
                            @include('case.component.ercp.cannu_cbd')
                            @include('case.component.ercp.cannu_CBDSuccess')
                            @include('case.component.ercp.cannu_CBDby')
                            @include('case.component.ercp.cannu_CBDtechnique')


                        </div>
                        <div class="col-1"></div>
                        <div class="col-6">
                            <div class="row">
                                @include('case.component.ercp.cannu_guidewire')
                                @include('case.component.ercp.cannu_guidewireinfo')
                                @include('case.component.ercp.cannu_bile')
                                @include('case.component.ercp.cannu_contrast')
                                @include('case.component.ercp.cannu_stent')

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
