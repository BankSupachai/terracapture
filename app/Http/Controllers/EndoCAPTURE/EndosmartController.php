<?php
namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EndosmartController extends Controller
{

    public function index()
    {

        $data['columns'] = \DB::connection('sqlsrv')->getDatabaseName();
        $database_name = $data['columns'];
        $data['smart'] = DB::connection('sqlsrv')->select("SELECT TABLE_NAME FROM information_schema.tables");
        $data['have']  = DB::table('tb_endosmart')->count();
        foreach ($data['smart'] as $key => $value) {
            $d[] = $value->TABLE_NAME;
        }

        return view('EndoCAPTURE.Endosmart.index',$data);
    }

    public function store(Request $r)
    {
        if(isset($r->select)){
            $fill = DB::select("describe tb_endosmart");
            for($i=0;$i<count($fill);$i++){
                $medica[] = $fill[$i]->Field;
                if(str_contains($fill[$i]->Type, 'bit')){
                    $bit[] = $fill[$i]->Field;
                    $type[] = $fill[$i]->Type;

                }
            }

            if(isset($bit)&&isset($type)){
                for ($i=0; $i < count($bit) ; $i++) {
                    $column_name = $bit[$i];
                    $column_type = 'varchar(512)';
                    $alter_raw = "ALTER TABLE tb_endosmart MODIFY COLUMN $column_name $column_type NULL";
                    DB::statement($alter_raw);
                }
            }

            for($i=0;$i<count($r->select);$i++){
                $tb = $r->select[$i];

                $columns =  \Schema::connection('sqlsrv')->getColumnListing("$tb");

                if($columns[0] != 'CASE_ID'){
                    continue;
                }

                // ต้องมีการกันในกรณีที่มีการสร้าง field ซ้ำ!!! -> ถ้ามีการเช็ค diff ใหม่อีกรอบข้อมูลจะลงแค่ชุดแรกชุดเดียว
                $medica = $this->get_column_from_tb_endosmart();
                $diff = array_values(array_diff($columns, $medica));

                if(count($diff) > 0){
                    $this->create_new_field($diff, $tb);
                }

                $this->get_data_and_insert($tb);

            }
            return redirect()->back();
        }else{
            return redirect()->back();
        }


    }

    public function get_column_from_tb_endosmart(){
        $fill = DB::select("describe tb_endosmart");
        for($i=0;$i<count($fill);$i++){
            $medica[] = $fill[$i]->Field;
        }
        return $medica;
    }

    public function check_column_null($column_name){
        $not_null = [
            'ID', 'ANEST_', 'TPEUTIC_', 'COMPLICAT_', 'DX_GROUP', 'HISTO_'
        ];

        foreach ($not_null as $n) {
            if(str_contains($column_name, $n)){
                return 'NOT NULL';
            }
        }
        return 'NULL';
    }

    public function get_data_and_insert($tb){
        $sql = "SELECT  *  FROM $tb";
        $tb_get = DB::connection('sqlsrv')->select($sql);

        $i = [];
        foreach($tb_get as $col){
            $data = (array) $col;
            foreach($data as $key => $d){
                $i[$key] = $d;
            }

            $w[] = array('CASE_ID', $i['CASE_ID']);
            $check = DB::table('tb_endosmart')->where($w)->first();

            if($check == null){
                DB::table('tb_endosmart')->insert($i);
            } else {
                DB::table('tb_endosmart')->where($w)->update($i);
            }
            $w = [];
        }

    }

    public function create_new_field($diff, $tb){
        $matchs = join("','",$diff);
        $raw = "SELECT COLUMN_NAME, DATA_TYPE, COL_LENGTH('dbo.$tb', COLUMN_NAME) as COLUMN_LENGTH from INFORMATION_SCHEMA.COLUMNS where table_name = '$tb' and COLUMN_NAME in ('".$matchs."')";
        $get = DB::connection('sqlsrv')->select($raw);

        foreach($get as $g){
            $column_name = $g->COLUMN_NAME;
            $column_length = $g->COLUMN_LENGTH;
            $column_type = $g->DATA_TYPE;

            if($g->DATA_TYPE == 'nvarchar'){
                $column_length = ($g->COLUMN_LENGTH)/2;
                $column_type   = 'varchar';
            } else if($g->DATA_TYPE == 'bit'){
                $column_type   = 'smallint';
            }

            $is_null = $this->check_column_null($column_name);
            $default = '';
            if($is_null == 'NOT NULL'){
                $default = "DEFAULT 0";
                $is_null = 'NULL';
            }

            try {
                $add_raw = "ALTER TABLE tb_endosmart ADD $column_name $column_type(".$column_length.") $is_null $default;";
                DB::statement($add_raw);
            } catch(\Throwable $e){
                try {
                    $add_raw = "ALTER TABLE tb_endosmart ADD $column_name TEXT $is_null $default;";
                    DB::statement($add_raw);
                } catch(\Throwable $e) {
                    continue;
                }
            }

        }
    }
}
