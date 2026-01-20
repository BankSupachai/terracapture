<!-- Default Modals -->
<button hidden id="photopacs" type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal_pacs_photo">Standard Modal</button>
<div id="modal_pacs_photo" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach (isset($photo_pacs)?$photo_pacs:[] as $in=>$img)
                        <div class="col-3" data-filename="{{$img}}" data-index="{{@$in}}" onclick="check_pacs('{{@$in}}')">
                            <input id="pacs{{@$in}}" type="checkbox" data-filename="{{$img}}" class="form-check-input ck-pacimg">
                            <img src="http://pacs/{{@$date_pacs}}/{{@$case->case_hn}}/{{@$img}}" alt="" width="100" height="100">
                        </div>
                    @endforeach
                </div>
                <form action="{{url('procedure')}}" id="pacs_photo_form" method="post" hidden>
                    @csrf
                    <input type="hidden" name="event" value="get_pacs_photo">
                    <input type="hidden" name="pacs_photo" id="pacs_photo">
                    <input type="hidden" name="_id" value="{{@$cid}}">
                </form>
                
            </div>
            <div class="modal-footer">
                <button id="check_action" type="button" class="btn btn-light">Check/Uncheck all</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button id="confirm_pacs_photo" type="button" class="btn btn-primary" onclick="confirm_pacs_photo()">Confirm</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    function check_pacs(index) {
        let status  = $(`#pacs${index}`).is(':checked')
        let should_checked = false  
        if(!status){
            should_checked = true
        } 
        $(`#pacs${index}`).prop('checked', should_checked)
    }

    function confirm_pacs_photo(){
        let lg = $('.ck-pacimg').length
        let arr = []
        for (let i = 0; i < lg; i++) {
            let filename = $($('.ck-pacimg')[i]).data('filename')
            let is_checked = $($('.ck-pacimg')[i]).is(':checked')
            if(filename != '' && filename != undefined){
                if(is_checked){
                    arr.push(filename)
                }
            }            
        }
        $('#pacs_photo').val(JSON.stringify(arr))
        setTimeout(() => {
            $('#confirm_pacs_photo').prop('disabled', true)
            $('#pacs_photo_form').submit()

        }, 500);
    }

    
    $('#check_action').on('click', function () {
        for (let i = 0; i < $('.ck-pacimg').length; i++) {
            temp = !pacs_ck
            $($('.ck-pacimg')[i]).prop('checked', temp)  
        }
        pacs_ck = !pacs_ck
    })

    
</script>