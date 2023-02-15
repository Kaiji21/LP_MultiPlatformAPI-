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
            foreach ($centers as &$center) {
                $images = DB::table('image_centre')
                    ->where('idCentre', $center->idCentre)
                    ->get();
                $salles = DB::table('salle')
                    ->leftjoin("image_salle",'image_salle.id_Salle','=','salle.id_Salle')
                    ->where('idCentre',$center->idCentre)
                    ->select('salle.*','image_salle.image')
                    ->get();
                    foreach ($salles as &$salle) {
                        $salle->image = base64_encode($salle->image);
                    }
                $center->salles = $salles;
                $center->images = [];
                foreach ($images as $image_centre) {
                    $center->images[] = base64_encode($image_centre->Imageblob);
                }

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
