<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function Get_Categories(){
        try{
            $Categories = DB::table('categorie')
            ->select('categorie.*')
            ->get();
            return response()->json([
                'status'=>200,
                'Categories'=>$Categories

            ]);

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status'=>500,
                'Message'=>'Erreur: '.$e->getMessage()
            ]);
        }

    }
}
