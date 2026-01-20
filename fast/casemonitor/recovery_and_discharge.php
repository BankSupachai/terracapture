
<div class="col-lg-12 p-0">
    <div class="card mb-0 mt-2">
        <div class="card-body m-0 px-0">
            <div class="row m-0">
                <div class="col-lg-12 ">
                    <div class="h5 fw-head-dark ms-4 mb-3">Recovery and Discharge ()</div>
                </div>
                <div class="col-lg-12 p-0 m-0">
                    <div class="table-responsive">
                        <table class="table table-borderless recovery">
                            <tr class="bg-light" style="color: #9599AD;">
                                <td></td>
                                <td></td>
                                <td>HN</td>
                                <td>Patient name</td>
                                <td>Endoscopist</td>
                                <td>Procedure</td>
                                <td>Complication</td>
                                <td>Status</td>
                                <td>Discharged to</td>
                                <td></td>
                                <td></td>
                            </tr>

                                    <tr style="border-bottom: 1px solid #E9EBEC;">
                                        <td class="text-nowrap">
                                            <button class="btn btn-ghost-light btn-icon qr_create" hn="{{ @$hn }}">
                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                            </button>
                                            <b class="callQueue  ri-volume-up-line text-primary ri-lg"
                                                queue="{{ @$data->queue }}"></b>
                                            <span class=" ms-3">

                                            </span>
                                        </td>
                                        <td class="can-search"><span
                                                class="badge badge-outline-case">{{ @$data->timevisit }}</span></td>
                                        <td class="can-search">{{ @$data->hn }}</td>
                                        <td class="can-search">{{ @$patientname }}</td>
                                        <td class="can-search">{{ @$data->physician }}</td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                                <span class="badge-soft-success  p-1">Discharged</span>

                                                <span class="badge-soft-secondary  p-1">Recovery</span>

                                        </td>
                                        <td>
                                            <span style="text-transform: capitalize;">

                                            </span>
                                        </td>
                                        <td style="">

                                                    <button type="button" caseuniq=""
                                                        class="btn btn-primary btn-label waves-effect right waves-light btn_modal_discharged text-nowrap"><i
                                                            class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i>
                                                        Send to Discharge</button>

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

                                        </td>
                                    </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


