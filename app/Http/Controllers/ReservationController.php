<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function Addreservation(Request $request){
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
            $reservation->idCentre = $request->get('idcentre');
            $reservation->save();
            return response()->json([
                'status'=>200,
                'Message'=>'Reservation bien été ajouter',
                'Reservation ID'=> $reservation->id_Reservation

            ]);

        }
        catch(\Exception $e){
            return response()->json([
                'status'=>500,
                'Message'=>'Erreur: '.$e->getMessage()
               ]);
        }




    }
}
