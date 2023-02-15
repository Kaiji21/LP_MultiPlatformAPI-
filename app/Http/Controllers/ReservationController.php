<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Details_reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function Addreservation(Request $request){
        DB::beginTransaction();
        try{
            $reservation = new Reservation;
            $reservation->dateDebut_Reservation= $request->get('datedebut');
            $reservation->dateFin_Reservation= $request->get('datefin');
            $reservation->date_Reservation = Carbon::now();
            $reservation->type_Reservation = $request->get('type');
            $reservation->etats_Reservation = 'Pending';
            $reservation->personne_Invitee = $request->get('nbrinvitee');
            $reservation->description_Reservation = $request->get('description');
            $reservation->id_Organisme = $request->get('idorganisme');
            $reservation->save();
            $id_salles = explode(',', $request->input('id_sallesreserver'));
            foreach($id_salles as $id){
                $details_reservation = new Details_reservation;
                $details_reservation->id_salle=$id;
                $details_reservation->id_reservation=$reservation->id_Reservation;
                $details_reservation->save();
            }

            DB::commit();
            return response()->json([
                'status'=>200,
                'Message'=>'Reservation bien été ajouter',
                'Reservation ID'=> $reservation->id_Reservation

            ]);

        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status'=>500,
                'Message'=>'Erreur: '.$e->getMessage()
               ]);
        }




    }
}
