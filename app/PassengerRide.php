<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PassengerRide extends Pivot{

	protected $table = 'user_ride';

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function rides(){
        return $this->belongsTo(Ride::class);
    }
}