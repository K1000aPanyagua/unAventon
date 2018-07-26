<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model{

	protected $table = 'rides';
	protected $dates = ['endDate', 'departDate'];
	protected $fillable = ['origin', 'destination', 'duration', 'amount', 'remarks', 'departDate', 'departHour'];

	public function pilot(){
		return $this->belongsTo(User::class);
	}

	public function Passenger(){
		return $this->hasMany(PassengerRide::class);
	}

	public function car(){
		return $this->belongsTo(Car::class);
	}

	public function account(){
		return $this->belongsTo(Account::class);
	}

	public function card(){
		return $this->belongsTo(Card::class);
	}

	public function comments(){
    	return $this->hasMany(Comment::class);
	}    
    
     public function answers(){
    	return $this->hasMany(Answer::class);
	}   

    public function qualificationsAsPilot(){
    	return $this->hasMany(QualificationPilot::class);
    }
    
    public function qualificationsAsPassenger(){
    	return $this->hasMany(QualificationPassenger::class);
    }
}





