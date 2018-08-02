<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Car;
use App\Card;
use App\Ride;
use Illuminate\Support\Facades\DB;
use App\PassengerRide;
use App\User;

class PagesController extends Controller {

	public function getIndex(){
		$rides = DB::table('rides')->where('done', FALSE)->paginate(15);
		return view('home')->with('rides', $rides);
		
	}

	public function getSearch(){
		return view('ride.search');
	}

	public function getUpdate(){
	    return view('userupdate');
	}

	public function getOwnProfile(){
		$rides = DB::table('rides')->paginate(15);

		return view('myprofile')->with('rides', $rides);
	}

	public function getAccount(){
		$cars = Car::where('user_id', Auth::user()->id);
		$cards = Card::where('user_id', Auth::user()->id);  //Acá se van a cargar los models para el choicesForChanges*/
		return view('configurationaccount')->with('cars', $cars);
	}

	public function getResultRegister(){
		return view('resultregister');
	}
 		
 	public function showPassengers($idRide){
 		$ride = Ride::where('id', $idRide)->first();
 		$solicitudes = PassengerRide::where('ride_id', $idRide)->where('state', 'aceptado')->get();
 		$passengers = collect([]);
 		foreach ($solicitudes as $solicitud) {
 			$passengers->push(User::find($solicitud->user_id));
 		}
 		return view('ride.showPassengers')->with('passengers', $passengers)->with('ride', $ride);
 	}
}