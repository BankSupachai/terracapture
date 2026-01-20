<?php

namespace App\Http\Controllers\MongoDB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;

class BackupController extends Controller
{

    private $host   = "localhost";
    private $dbname = "endoindex";

    public function index()
    {
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            $data[]    = $collection['name'];
        }
        asort($data);
        $view['alltable'] = $data;
        return view('mongodb.home.index', $view);
    }

    public function show($id)
    {
        switch ($id) {
            case "export":
                $this->export();
                break;
            case "import":
                $this->import();
                break;
        }
    }


    private function export()
    {
        $date = date('Ymd');
        $foldername = "D:\backupdb\\export$date";

        if (file_exists($foldername)) {
            return true;
        }

        $this->del7day();

        makedirfull($foldername);
        $alltable = $this->alltable();
        foreach ($alltable as $collection) {
            if(str_contains($collection, 'case') && @$collection."" != "tb_casetempout"){
                $output_file = "$foldername\\$collection.json";
                $command = 'D:\allindex\mongo\mongoexport.exe --host ' . $this->host . ' --db ' . $this->dbname . ' --collection ' . $collection . ' --out ' . $output_file;
                exec("{$command} 2>&1", $output, $return_var);
            }

        }
    }




    public function alltable()
    {
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            $data[]    = $collection['name'];
        }
        asort($data);
        return $data;
    }





    public function getAgeInDays($file) {
        return (time() - filemtime($file)) / 86400;
    }

    // ฟังก์ชันเพื่อการลบโฟลเดอร์และไฟล์ภายใน
    public function deleteFolder($folder) {
        if (is_dir($folder)) {
            $files = array_diff(scandir($folder), ['.', '..']);
            foreach ($files as $file) {
                $filePath = "$folder/$file";
                if (is_dir($filePath)) {
                    $this->deleteFolder($filePath);
                } else {
                    unlink($filePath);
                }
            }
            return rmdir($folder);
        } elseif (is_file($folder)) {
            return unlink($folder);
        }
        return false;
    }


    public function del7day() {
        // เส้นทางไปยังโฟลเดอร์ที่ต้องการตรวจสอบ
        $directory = 'D:/backupdb';

        // ตรวจสอบโฟลเดอร์และลบโฟลเดอร์ที่มีอายุเกิน 7 วัน
        $folders = array_diff(scandir($directory), ['.', '..']);
        foreach ($folders as $folder) {
            $folderPath = "$directory/$folder";
            if (is_dir($folderPath) && $this->getAgeInDays($folderPath) > 7) {
                $this->deleteFolder($folderPath);
            }
        }
    }




}
