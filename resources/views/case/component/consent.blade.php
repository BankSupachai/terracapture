<div class="col-12">
    {!! editcard('photo', 'photo.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h3 class="card-label">
                <u>CONSENT</u>
            </h3>
            <textarea name="consent" id="consent" rows="6" class="form-control autotext savejson">{{ @$case->consent }}</textarea>
        </div>
    </div>
</div>
