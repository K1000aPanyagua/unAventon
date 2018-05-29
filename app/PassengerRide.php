<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRide extends Model{

	protected $table = 'user_ride';

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function rides(){
        return $this->belongsTo(Ride::class);
    }
}