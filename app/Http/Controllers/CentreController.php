<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CentreController extends Controller
{
    public function Getcentres(){
        try{
            $centers = DB::table('centre')
            ->where('centre_archivee',0)
            ->select('centre.*')
            ->get();

            return response()->json([
                'status'=>200,
                'Centres'=>$centers

            ]);

        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status'=>500,
                'Message'=>'Erreur: '.$e->getMessage()
            ]);
        }

    }

}
