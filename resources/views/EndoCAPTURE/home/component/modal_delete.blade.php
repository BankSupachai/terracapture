
  <!-- Modal -->
  <div class="modal fade" id="modal_delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>Do you want to delete this case ?</h5>
            <br>
            <h5>HN :  <font color="red"><span id="span_hn"></span></font></h5>
            <h5>Procedure : <span id="span_procedure"></span></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">No, I don't</button>
          <form action="{{url('home')}}" method="post">
                @csrf
                <input type="hidden" name="event" value="delete_case">
                <input type="hidden" name="del_caseid" id="del_caseid">
                <button type="submit" class="btn btn-danger">Yes, I want to delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
