<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h5>Cholangiogram</h5>
            <h6>Please select to make a sentence</h6>
            <div class="row mt-3">
                <div class="col-xl-12">
                    <div class="row">
                        @include('case.component.ercp.cholangiogram_select')
                        @include('case.component.ercp.cholangiogram_dilator')
                        @include('case.component.ercp.cholangiogram_extractor')
                        @include('case.component.ercp.cholangiogram_endobiliary')
                        @include('case.component.ercp.cholangiogram_cbds')
                    </div>
                </div>
                <div class="col-xl-4"></div>
                <div class="col-xl-4 mt-3"> <hr></div>
                <div class="col-xl-4"></div>

            </div>
            <div class="row mt-3">
                <div class="col-6 pe-6">
                    <div class="row">
                    @include('case.component.ercp.cholangiogram_complete')

                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        @include('case.component.ercp.cholangiogram_textarea02')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
