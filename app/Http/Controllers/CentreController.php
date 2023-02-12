<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CentreController extends Controller
{
    public function Getcentres(){
        try{
            $centers = DB::table('centre')
            ->leftJoin('image_centre','image_centre.idCentre','=','centre.idCentre')
            ->leftJoin('salle','salle.idCentre','=','centre.idCentre')
            ->where('centre_archivee',0)
            ->select('salle.*','image_centre.Imageblob','centre.*')
            ->get();
            foreach ($centers as &$center) {
                $center->Imageblob = base64_encode($center->Imageblob);
            }

            return response()->json([
                'status'=>200,
                'Centres'=>$centers

            ]);

        }
        catch (\Exception $e) {
            return response()->json([
                'status'=>500,
                'Message'=>'Erreur: '.$e->getMessage()
            ]);
        }

    }

}
