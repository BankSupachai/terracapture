<style>
    #img_reload i{
        color: gray;
        cursor: pointer;
    }
    #img_reload i:hover{
        color: black;
    }
    .spinner:before {
        width: 14.5rem;
        height: 14.5rem;
        margin-top: 0;
    }

    .spinner{
        /* margin-left: 10em; */
    }
    .spinner:before {
        animation: animation-spinner 1s linear infinite;
    }
    #reload .modal-content{
        min-height: 18em;
        margin: auto;
        width: 18em;
        border-radius: 50%;
    }
    #text_reload{
        position: absolute;
        margin-top: 6.5em;
        margin-left: 5em;
        color: #007eff;
    }
</style>
<div class="modal fade" id="reload" tabindex="-1" role="dialog" aria-labelledby="reload_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <span id="text_reload">Loading...</span>
            <div class="spinner spinner-primary m-auto"></div>
        </div>
      </div>
    </div>
  </div>
