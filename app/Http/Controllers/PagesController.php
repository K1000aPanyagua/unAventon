<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Car;
use App\Card;
use App\Ride;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller {

	public function getIndex(){
		$rides = DB::table('rides')->paginate(15);
		return view('home')->with('rides', $rides);
	}

	public function getSearch(){
		return view('ride.search');
	}

	public function getUpdate(){
	    return view('userupdate');
	}

	public function getOwnProfile(){
		return view('myprofile');
	}

	public function getAccount(){
		$cars = Car::where('user_id', Auth::user()->id);
		$cards = Card::where('user_id', Auth::user()->id);  //Acá se van a cargar los models para el choicesForChanges*/
		return view('configurationaccount')->with('cars', $cars);
	}

	public function getResultRegister(){
		return view('resultregister');
	}
 		
}