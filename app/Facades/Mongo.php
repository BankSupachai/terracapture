<?php

namespace App\Facades;
use Illuminate\Support\Facades\DB;

class Mongo extends DB
{
    protected $connection = 'mongodb';

}
