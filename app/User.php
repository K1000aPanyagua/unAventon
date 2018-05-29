<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'pass', 'lastname', 'birthdate', 'gender', 'photo', 'telephone'];
    
    protected $hidden = [
        'pass', 'remember_token',];
    
    protected $table = 'users';

    public function car(){
        return $this->hasOne(Car::class)
    }

    public function rides(){
    	return $this->hasMany(Ride::class);
    }

     public function qualificationsAsPilot(){
    	return $this->hasMany(qualificationPilot::class);
    }

     public function qualificationsAsPassenger(){
    	return $this->hasMany(qualificationPassenger::class);
    }

     public function card(){
    	return $this->hasOne(Card::class);
    }

    public function Account(){
    	return $this->hasOne(Account::class);
    }

    public function comments(){
    	return $this->hasMany(Comment::class);
    }

    public function Answers(){
    	return $this->hasMany(Answer::class);
    }
}
