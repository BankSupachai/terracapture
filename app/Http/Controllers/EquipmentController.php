<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;


class EquipmentController extends Controller
{

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $page = $this->$event($r);
        }

        return redirect($page);
    }


    public function index()
    {
        dd("mdfdfsdjfls");
    }






}
