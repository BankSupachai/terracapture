<!DOCTYPE html>
<html lang="th" class="isDesktop" style="display: none">
    <head>
        <meta charSet="utf-8"/>
		<script src="{{url("public/js/jquery-1.11.1.min.js")}}"></script>
        <script src="{{url("public/js//tableToExcel.js")}}"></script>
        {{-- <script src="https://unpkg.com/jspdf@2.5.1/dist/jspdf.es.min.js"></script> --}}
        {{-- <script src="https://unpkg.com/jspdf-autotable@3.5.28/dist/jspdf.plugin.autotable.js"></script> --}}
        <link href="{{asset('public/css/bootstrap.min.css')}}"                             rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/font-awesome.min.css')}}"                          rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/images/favicon.png')}}"
                                     rel="shortcut icon">
        <link rel="stylesheet" href="{{url("public/css/endo/excel01.css")}}">
    </head>
<style>
</style>
<div class="row" style="width: 100%;">
    <div class="col-12" style="padding: 2em;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4 text-left"><button onclick="window.history.back()" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i> Back</button></div>
                    <div class="col-4 text-center"><button id="btnExport" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</button></div>
                    <div class="col-4">
                        <select name="perpage" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="card-body pt-2">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table2excel">
                        <tr class="bg-dark text-light">
                            @foreach (isset($head)?$head:[] as $h)
                            @php
                                $default = ['anesthesia', 'medication', 'finding', 'diagnostic', 'procedure_sub'];
                            @endphp
                                <th colspan="@if(in_array($h, $default)) 5 @else 1 @endif">
                                    @php
                                        if($h == 'procedurename'){
                                            $h = 'procedure';
                                        } else if($h == 'diagnostic') {
                                            $h = 'icd10';
                                        } else if($h == 'procedure_sub') {
                                            $h = 'icd9';
                                        }
                                    @endphp
                                    {{@$h}}
                                </th>
                            @endforeach
                        </tr>

                        @foreach (isset($case)?$case:[] as $c)    
                        @php
                            $test = [];
                            $c = (array) $c;
                        @endphp
                            <tr>
                                @foreach (isset($head)?$head:[] as $h)
                                    @php
                                        if($h == 'finding'){
                                            $h = 'mainpart';
                                        }
                                        $one_col    = ['case_id', 'hn', 'procedurename'];
                                        $length_col = in_array($h, $one_col) ? 1 : 5;
                                    @endphp
                                    @php
                                        $value = "";
                                        $is_null = true;
                                        if(isset($c[$h])){
                                            $type = gettype($c[$h]);

                                            if($type == 'array'){
                                                $value = json_encode($c[$h]);
                                                $test[] = $value;
                                                // $value = $c[$h];
                                            } else if($type == 'object'){
                                                $value = strval($c[$h]);
                                            } else {
                                                $value = $c[$h];
                                            }
                                        }
                                    @endphp
                                    @if ($length_col == 1 )
                                        <td class="head_{{@$h}}">{{@$value}}</td>
                                    @elseif($length_col == 5 && $type == 'array')
                                            @php
                                                $value = json_decode($value, true);
                                                $count = 0;
                                                if(is_array($value)){
                                                    $is_null = false;
                                                } 
                                            @endphp
                                            @if ($is_null == false)
                                                @if (count($value) > 0)
                                                    @foreach (isset($value)?$value:[] as $key=>$data)
                                                        @php
                                                            if($count > 4){
                                                                continue;
                                                            }
                                                        @endphp
                                                        <td class="head_{{@$h}}">
                                                            @php
                                                                $data = json_encode($data);
                                                            @endphp
                                                            <div class="nest-cell">{{@$key}}:{{@$data}}</div>
                                                        </td>
                                                        @php
                                                            $count += 1;
                                                        @endphp
                                                    @endforeach
                                                    @if (count($value) != 5 && ($length_col == 5) || $is_null == true)
                                                        @for ($i = 0; $i < 5 - count($value); $i++)
                                                            <td>-</td>
                                                        @endfor
                                                    @endif
                                                @elseif(count($value) == 0)
                                                    @for ($i = 0; $i < 5 ; $i++)
                                                        <td>-</td>
                                                    @endfor
                                                    
                                                @endif
                                                
                                            @else
                                                @for ($i = 0; $i < 5 ; $i++)
                                                    <td>-</td>
                                                @endfor
                                            @endif
                                    @elseif($length_col == 5 && $type != 'array'  )
                                        @for ($i = 0; $i < 5 ; $i++)
                                            <td>-</td>
                                        @endfor
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{-- <div class="row">
                    <div class="col-12 text-center">{{ $case->appends($_GET)->render() }}</div>
                </div> --}}
            </div>
        </div>
    </div>
</div>




</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
<script>

$(document).ready(function(){

    if('{{$ext}}' == 'xlsx'){
        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: `{{$filename}}.{{$ext}}`, // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }

        });
    } else if('{{$ext}}' == 'csv'){
        export2csv()
    } else {
        export2pdf()
    }

    setTimeout(() => {

        window.close() ;
    }, 100);

    function export2csv() {
        let data = "";
        const tableData = [];
        const rows = document.querySelectorAll("table tr");
        for (const row of rows) {
            const rowData = [];
            for (const [index, column] of row.querySelectorAll("th, td").entries()) {
            // To retain the commas in the "Description" column, we can enclose those fields in quotation marks.
            if ((index + 1) % 3 === 0) {
                rowData.push('"' + column.innerText + '"');
            } else {
                rowData.push(column.innerText);
            }
            }
            tableData.push(rowData.join(","));
        }
        data += tableData.join("\n");
        const a = document.createElement("a");
        a.href = URL.createObjectURL(new Blob([data], { type: "text/csv" }));
        a.setAttribute("download", "data.csv");
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    function export2pdf(){
        var doc = new jsPDF('l')
        doc.autoTable({
            html: '#table2excel',
            // split overflowing columns into pages
            horizontalPageBreak: true,
            // repeat this column in split pages
            horizontalPageBreakRepeat: 'HN',
            theme : 'plain'
        })
        doc.save('table.pdf')
    }



});



    $(function() {
        $("dddbutton").click(function(){
        $("#table2excel").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name"
        });
         });
    });
</script>
<script>

