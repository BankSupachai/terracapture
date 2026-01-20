<div class="col-lg-12 p-0">
    <div class="card mb-0 mt-2">
        <div class="card-body m-0 px-0">
            <div class="row m-0">
                <div class="col-lg-12 ">
                    <div class="h5 fw-head-dark ms-4 mb-3">Holding ()</div>
                </div>
                <div class="col-lg-12 m-0 px-0 ">
                    <div class="">
                        <table class="table table-borderless holding">
                            <tr class="bg-light" style="color: #9599AD;">
                                <td></td>
                                <td></td>
                                <td>HN</td>
                                <td>Patient name</td>
                                <td>Endoscopist</td>
                                <td>Procedure</td>
                                <td>Room</td>
                                <td>Waiting Location</td>
                                <td>Description</td>
                                <td></td>

                            </tr>




                                    <tr style="border-bottom: 1px solid #E9EBEC;">
                                        <td class="text-nowrap">
                                            <button class="btn btn-ghost-light btn-icon qr_create modalqr"
                                                hn="">
                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                            </button>
                                            <b class="callQueue  ri-volume-up-line text-primary ri-lg"
                                                queue=""></b>
                                            <span class=" ms-3">

                                            </span>
                                        </td>
                                        <td><span class="badge badge-outline-case"></span></td>
                                        <td></td>
                                        <td style="color:#245788;"></td>
                                        <td></td>


                                        <td>

                                        </td>
                                        <td class="can-not-search">
                                            <select class=" w-75 room_select form-select"
                                                data-choies hn="">
                                                <option value="0">เลือก</option>

                                                        <option value="" selected>
                                                            </option>

                                            </select>
                                        </td>
                                        <td class="can-not-search">
                                            <select class=" w-75 location_select form-select"
                                                hn="">


                                                        <option value="" selected>
                                                            </option>

                                            </select>
                                        </td>
                                        <td class="can-not-search">
                                            <div class="need-hidden">
                                                <input class="need-hidden" type="text" id="Holding_"
                                                    value="" hidden>
                                                <input class="need-hidden" type="text"
                                                    id="Holding_app" value=""

                                                    hidden>

                                            </div>
                                            <input type="text" class="form form-control" onchange="save_description('Holding', '', this.value, '')"
                                                value="">
                                        </td>
                                        <td class="text-end can-not-search">
                                            <div class="btn-group" role="group">
                                                <i class="ri-edit-box-fill ri-lg " data-bs-toggle="dropdown"></i>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            onclick="edit_case('')">Edit
                                                            List</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            onclick="hide_case('')">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div>
                        </div>

                        </td>

                        </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
