<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Organisme;

class UserController extends Controller
{
    public function Login(Request $request){
        try{
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
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status'=>500,
                'Message'=>'Erreur: '.$e->getMessage()
            ]);
        }




    }
    public function AddUtilisateur(Request $request){
        DB::beginTransaction();

        try {
            $user = new Utilisateur;
            $user->mot_de_passe = $request->input('password');
            $user->adresse = $request->input('address');
            $user->email_utilisateur = $request->input('email');
            $user->tele_utilisateur = $request->input('phone');
            $user->etat_utilisateur = $request->input('state');
            $user->ip_utilisateur = $request->ip();
            $user->token = Str::random(100);
            $user->save();
            $id_user = $user->id_utilisateur;
            $Organisme = Organisme::where('code_Organisme',$request->input('code_organisme'))
            ->update(["id_utlisateur" =>$id_user] );
            DB::commit();

            return response()->json([
                'status'=>200,
                'Message'=>'Utilisateur Bien éte ajouter et bien affecté a lorganisme',
                'Organisme'=>$Organisme,
                'Id_user'=>$id_user

            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status'=>500,
                'Message'=>'Erreur: '.$e->getMessage()
            ]);
        }
    }

}
