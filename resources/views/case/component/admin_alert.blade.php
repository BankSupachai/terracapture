@if (in_array(@uget('user_type'), ['admin']))
    <div class="col-12">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="row">
                    <div class="col-12" align="center">
                        <h1>
                            <font color="red">ไม่สามารถทำ Report ด้วยสิทธิ Admin</font>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
