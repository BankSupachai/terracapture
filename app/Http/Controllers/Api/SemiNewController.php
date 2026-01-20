<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Mongo;

class SemiNewController extends Controller
{

    public function index(Request $r)
{
    $hn = $r->hn;
    $client = $this->show($hn);
    $server = connectweb("http://endoindex/endoindex/api/seminew/$hn");

    $servers = json_decode($server, true); // Ensure the JSON is decoded into an associative array

    $client_file = $this->flattenArray($client);
    $server_file = $this->flattenArray($servers);

    foreach ($client_file as $file) {
        
    }

}



public function flattenArray($array) {
    $result = [];

    foreach ($array as $element) {
        if (is_array($element)) {
            // Recursively flatten the nested array
            $result = array_merge($result, $this->flattenArray($element));
        } else {
            $result[] = $element;
        }
    }

    return $result;
}
        // dd($client , $servers);

        // Use a callback to reference the method in the current instance






    public function getFileDate($filePath) {

        if (file_exists($filePath)) {
            return date("F d Y H:i:s." , filemtime($filePath));
        } else {
            return null;
        }
    }

    public function create(){

    }



    public function store(Request $r)
    {


    }





    public function show($id)
    {
        $file =  $this->listFiles("D:\laragon\htdocs\store\\$id");
        return $file;

    }







    public function edit($id)
    {

    }

    public function listFiles($dir) {

        $arr = array();

        // Check if the directory exists
        if (!is_dir($dir)) {
            die("Invalid directory: $dir");
        }

        // Ensure the directory ends with a slash
        if (substr($dir, -1) !== '/') {
            $dir .= '/';
        }

        // Open the directory
        $handle = opendir($dir);
        if ($handle) {
            // Loop through each item in the directory
            while (($entry = readdir($handle)) !== false) {
                // Skip '.' and '..'
                if ($entry == '.' || $entry == '..') {
                    continue;
                }

                // Get the full path of the entry
                $fullPath = $dir . $entry;

                // If the entry is a directory, recursively list files
                if (is_dir($fullPath)) {
                    $arr[] = $this->listFiles($fullPath);
                } else {
                    // Print the full path of the file
                    $arr[] = $fullPath . PHP_EOL;
                    // echo $fullPath . PHP_EOL;
                }
            }

            // Close the directory handle
            closedir($handle);
        }
        return $arr;
    }

    // // Example usage
    // $directory = 'path/to/your/directory';
    // listFiles($directory);
}
