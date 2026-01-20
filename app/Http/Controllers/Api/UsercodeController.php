<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Mongo;
use Illuminate\Http\Request;

class UsercodeController extends Controller
{
    public function checkDoctorCode(Request $request)
    {
        $userCode = $request->input('user_code');

        $exists = \App\Models\Mongo::table('users')
            ->where('user_code', $userCode)
            ->exists();

        return response()->json(['exists' => $exists]);
    }
}
