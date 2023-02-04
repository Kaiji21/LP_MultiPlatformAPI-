<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Login(Request $request){
        $Utilisateur = DB::table('utilisateur')
        ->where('email_utilisateur',$request->get('Login'))
        ->where('mot_de_passe',$request->get('Password'))
        ->select('utilisateur.*')
        ->first();

        if (empty($Utilisateur)){
            return response()->json([
                'Status'=>200,
                'message'=>'Makayn ta user b had lmo3tayat'
            ]);
        }
        else{
            return response()->json([
                'Status'=>200,
                'message'=>'Kayn had luser',
                'Utilisateur'=>$Utilisateur

            ]);
        }



    }
}
