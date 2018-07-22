<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model{

	protected $table = 'cars';

	protected $fillable = ['license','brand','model','year','kind','places', 'color', 'numSeats'];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function rides(){
        return $this->hasMany(Ride::class);
    }
}