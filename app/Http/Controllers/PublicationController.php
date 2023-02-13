<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function Get_Publication(){
         try{
        $Publications = DB::table('publication')
        ->join('employe','employe.idEmploye','=','publication.idEmploye')
        ->leftJoin('image_publication','image_publication.id_Publication','=',"publication.id_publication")
        ->select('employe.nomEmploye','publication.titre_publication','publication.contenu_publication','publication.date_publication','image_publication.photo')
        ->get();
        foreach ($Publications as &$Publication) {
            $Publication->photo = base64_encode($Publication->photo);
        }
        return response()->json([
            'status'=>200,
            'Publications'=>$Publications

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
