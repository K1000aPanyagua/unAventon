<?php

namespace App\Http\Controllers;

class PagesController extends Controller {

	public function getIndex(){
		return view('home');
	}

	public function getSearch(){
		return view('search');
	}

	public function getOwnProfile(){
		return view('myprofile');
	}
 		
}