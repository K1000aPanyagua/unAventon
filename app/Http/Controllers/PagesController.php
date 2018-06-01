<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Car;
class PagesController extends Controller {

	public function getIndex(){
		return view('home');
	}

	public function getSearch(){
		return view('search');
	}

	public function getUpdate(){
	    return view('userupdate');
	}

	public function getOwnProfile(){
		return view('myprofile');
	}

	public function getAccount(){
		$cars = Car::where('user_id', Auth::user()->id)->get();  //Acá se van a cargar los models para el choicesForChanges
		return view('configurationaccount')->with('cars', $cars);
	}

	public function getResultRegister(){
		return view('resultregister');
	}
 		
}