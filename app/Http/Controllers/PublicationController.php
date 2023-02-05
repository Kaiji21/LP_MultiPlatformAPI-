<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function Get_Publication(){
         try{
        $Publication = DB::table('publication')
        ->join('employe','employe.idEmploye','=','publication.idEmploye')
        ->leftJoin('image_publication','image_publication.id_Publication','=',"publication.idEmploye")
        ->join('utilisateur','utilisateur.id_utlisateur','=','employe.id_utlisateur')
        ->select('employe.nomEmploye','publication.titre_publication','publication.contenu_publication','image_publication.photo')
        ->get();
        return response()->json([
            'status'=>200,
            'Publications'=>$Publication

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
