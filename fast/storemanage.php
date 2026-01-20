<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed"
    data-layout-style="default">

<head>
    <meta name="csrf-token" content="VyA002AcomMjMUK57FwZHKEhPJKntrw9ADXGG88X" />
    <meta charset="utf-8" />
    <title>EndoCapture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="http://localhost/endocapture/public/recorder/favicon.png" rel="shortcut icon">
    <script src="http://localhost/lumina/assets/js/layout.js"></script>
    <link href="http://localhost/lumina/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/public/recorder/small-scale.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://localhost/lumina/assets/css/sweetalert2.min.css">
</head>

<body id="body">
    <?php include("head.php"); ?>

    <style>
        .fs-14 {
            font-size: 14px;
        }
    </style>



    <div class="row ps-2">
        <div class="card ps-2 mt-3">
            <h4 class="mb-sm-0 m-4" ><b>Store Management</b></h4>
            <div class="row col-12 m-2 pt-3 ps-1">
                <div class="col-3">

                    <div>
                        <input type="text" class="form-control" placeholder="Search for equipment " id="seacrh_filter">
                    </div>
                </div>

                <div class="col-2">
                    <select class="form-select mb-3" aria-label="Default select example" id="select_filter" onchange="filterStatus()">
                        <option value="">ทั้งหมด</option>
                        <option value="Active">ใช้งาน</option>
                        <option value="Inactive">ไม่ใช้งาน</option>
                    </select>
                </div>
                <script>
                function filterStatus() {
                    var status = document.getElementById("select_filter").value;
                    var table = document.getElementById("table_store");
                    var tr = table.getElementsByTagName("tr");

                    for (var i = 0; i < tr.length; i++) {
                        var td = tr[i].getElementsByTagName("td")[3];
                        if (td) {
                            var txtValue = td.textContent || td.innerText;
                            txtValue = txtValue.trim(); // ลบช่องว่างหน้าและหลัง
                            if (status === "") {
                                tr[i].style.display = "";
                            } else if (txtValue === status) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
                </script>

                <div class="col-5 text-end">
                    <a href="{{ url('storemanage/create') }}" class="btn btn-soft-success waves-effect w-lg waves-light"
                        style="width: 260px">Insert
                        Equipment</a>
                </div>
            </div>

            <div class="row ps-4">
                <span>Summary Inventory : </span>
            </div>
            <div class="table-responsive table-card m-3">


                <table class="table table-nowrap table-striped-columns text-center mb-0 " >
                    <thead class="table-light">
                        <tr>

                            <th scope="col">No.</th>
                            <th scope="col" class="text-start">Equipment</th>
                            <th scope="col">Total quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody id="table_store">

                            <tr>

                                <td>{{ $count }}</td>
                                <td class="text-start">{{ $data->name }}</td>

                                <td>


                                </td>
                                <td>
                                        <span class="badge badge-soft-success">
                                            Active
                                        </span>

                                </td>
                                <td>
                                    <a href=""
                                        class="btn btn-sm w-sm btn-success">Edit</a>
                                </td>
                            </tr>




                    </tbody>
                </table>
            </div>

        </div>
        <div class="card">
            <div class="row">

                <div class="col-auto m-4 pt-1">
                    <span class="fs-16"> Last Updated</span>
                </div>
                <div class="col-3 m-4">
                    <div>
                        <input type="text" class="form-control" id="disabledInput" value="2024-08-27" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php"); ?>
</html>
<script>
    $(document).ready(function(){
      $("#seacrh_filter").on("keyup", function() {
        var value = $(this).val().toLowerCase();

        $("#table_store tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>

