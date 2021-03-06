<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model{

	protected $table = 'cards';

	protected $fillable = ['numCard', 'expiration'];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function rides(){
        return $this->hasMany(Ride::class);
    }
}