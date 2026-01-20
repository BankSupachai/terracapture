<div id="modal_bostun" class="modal-lg  modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content " style="border-color: #245788;">
            <div class="modal-header pb-1" style="background-color: #245788; " >
                <h4 class="modal-title " id="myModalLabel" style="color: white; margin-top:-10px; " >Example Score</h4>
                <button type="button" class=" btn fs-18" data-bs-dismiss="modal" aria-label="Close"
                    style="color:#ffffff; margin-top:-10px;">X</button>
            </div>
            <div class="">
                <table class="table table-bordered" style="border-color: #00000040;">
                    <thead>
                        <h5 class="fs-15 pt-3 ps-4 pb-2"><b>Segmental Score</b></h5>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="{{ asset('public/image/1.png') }}" alt="" class="img-fluid"
                                    style="max-width: 140px;"></td>
                            <td><img src="{{ asset('public/image/2.png') }}" alt="" class="img-fluid"
                                    style="max-width: 140px;"></td>
                            <td><img src="{{ asset('public/image/3.png') }}" alt="" class="img-fluid"
                                    style="max-width: 140px;"></td>
                            <td><img src="{{ asset('public/image/4.png') }}" alt="" class="img-fluid"
                                    style="max-width: 120px;"></td>
                            <td><img src="{{ asset('public/image/5.png') }}" alt="" class="img-fluid"
                                    style="max-width: 140px;"></td>
                        </tr>
                        <tr>
                            <td class="center" style="background-color: #0AB39C2D;"><b>0</b></td>
                            <td class="center" style="background-color: #0AB39C2D;"><b>1</b></td>
                            <td class="center" style="background-color: #0AB39C2D;"><b>2</b></td>
                            <td class="center" style="background-color: #0AB39C2D;"><b>3</b></td>
                            <td class="center" style="background-color: #0AB39C2D;"><b>4</b></td>
                        </tr>
                        <tr>
                            <td style="padding-left:45px;">• Irremovable <br>
                                • Heavy <br>
                                • Hard Stools</td>
                            <td style="padding-left:40px;">• Semi-solid<br>
                                • Only partially <br>&nbsp; removable stools
                            </td>
                            <td style="padding-left:35px;">• Brown liquid <br>
                                • Removable semi- <br>&nbsp;&nbsp;solid stools
                            <td style="padding-left:30px;">• Clear liquid
                            <td style="padding-left:25px;">• Empty and Clean
                        </tr>
                        <tr>
                            <td colspan="5">
                                <h5 class="fs-15 pt-1 ps-3"><b>Grade</b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td class="center" style="background-color: #0AB39C2D;"><b>D</b></td>
                            <td class="center" style="background-color: #0AB39C2D;"><b>C</b></td>
                        <td class="center" style="background-color: #0AB39C2D;"><b>B</b></td>
                            <td colspan="2" class="center " style="background-color: #0AB39C2D;"><b>A</b></td>
                        </tr>
                        <tr>
                            <td class="center">1 or more segments scored 0</td>
                            <td class="center">1 or more segments scored 1</td>
                            <td class="center">1 or more segments scored 2</td>
                            <td class="center" colspan="2">All segments scored 3 or 4</td>

                        </tr>
                    </tbody>
                </table>
                <div class="row g-0" style="margin-top:-16px;">
                    <div class="col-5 ">
                        <button type="button" class="btn w-100 fs-18"
                            style="background-color:#F065482D; color:#F06548; border-radius: 0;"
                            data-bs-dismiss="modal"><b>FAILURE</b></button>
                    </div>
                    <div class="col-7">
                        <button type="button" class="btn w-100 fs-18"
                            style="background-color:#2457882D; color:#245788; border-radius: 0;"><b>SUCCESS</b></button>
                    </div>
                </div>
            </div>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
