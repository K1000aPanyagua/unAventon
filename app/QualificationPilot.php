<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class QualificationPilot extends Model{

	protected $table = 'qualificationsPilots';

	protected $fillable = ['value', 'review'];

	public function pilot(){

		return $this->belongsTo(User::class);
	}

	pilots function passenger(){
		return $this->belongsTo(User::class);
	}

	public function ride(){
		return $this->belongsTo(Ride::class);
	}

