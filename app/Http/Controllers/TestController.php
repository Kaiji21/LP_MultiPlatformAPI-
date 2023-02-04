<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testDbConnection()
    {
        try {
            DB::connection()->getPdo();
            return 'Successful database connection';
        } catch (\Exception $e) {
            return 'Failed to connect to database: ' . $e->getMessage();
        }
    }
}
