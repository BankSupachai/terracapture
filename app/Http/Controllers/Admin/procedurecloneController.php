<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\tb_diagnostic;
use App\Models\tb_mainpart;
use App\Models\tb_procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\Mongo;
use App\Models\Server;

class procedurecloneController extends Controller
{
    // public function __construct(Request $r){checklogin();}


    public function index(Request $request)
    {
    }

    public function ercp()
    {
        $a["code"] = '5111';
        $a["unit"] = null;
        $a["status"] = 'show';
        $a["bill"] = 'other';
        $a["price"] = '50000';

        $name[] = 'ERCP (Endoscopic retrograde cholangiopancreatogram)';
        $name[] = 'ERP (Endoscopic retrograde pancreatogram)';
        $name[] = 'ERC (Endoscopic retrograde cholangiogram)';
        $name[] = 'EST (Endoscopicsphincterotomy)';
        $name[] = 'EPBD (Endoscopic papillary balloon dilatation)';

        $name[] = 'EPLBD (Endoscopic papillary large balloon dilatation)';


        $name[] = 'NKP (Needle knife precut sphincterotomy)';

        $name[] = 'NKF (Needle knife precut fistulotomy)';
        $name[] = 'EPST (Endoscopic pancreatic sphincterotomy) at Major/Minor papilla';
        $name[] = 'Ampulloplasty';

        $name[] = 'Biliary plastic stenting (Unilateral/Bilateral/Triple branched)';
        $name[] = 'Biliary metalic stenting (Unilateral/SBS/SIS/Triple branched)';
        $name[] = 'ENGBD (Endoscopic naso-gallbladder drainage)';
        $name[] = 'ERGBD (Endoscopic retrograde gallbladder drainage)';
        $name[] = 'Stone extraction';
        $name[] = 'SpyDS';
        $name[] = 'Lithotripsy by BML/Basket';
        $name[] = 'EHL';
        $name[] = 'EUS-RV via';
        $name[] = 'EUS antegrade stenting';
        $name[] = 'EUS antegrade stone extraction';
        $name[] = 'EP (Endoscopic papillectomy)';
        foreach ($name as $key => $data) {
            # code...
            $a["name"] = $data;

            unset($a['extra']);
            unset($a['extra_text']);

            if ($data == 'EHL') {
                $a['extra'] = 1;
                $a['extra_text'] = 'shots';
            }

            if ($data == "EUS-RV via") {
                $a['extra'] = 1;
                $a['extra_text'] = '';
            }

            $arr["icd9"][$data] = array($a);
        }

        Mongo::table('tb_procedure')->where('code', 'gi003s2')->update($arr);



        $ercp = Mongo::table('tb_procedure')->where('code', 'gi003s2')->first();
        // dd($ercp);

    }




    public function create()
    {
    }


    public function store(Request $r)
    {
    }



    public function show($id)
    {
    }

    public function update(Request $r, $id)
    {
    }

    public function destroy($id, Request $r)
    {
    }
}
