<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model{

	protected $table = 'Cards';

	protected $fillable = ['numCard', 'expiration'];

	public function user(){

		return $this->belongsTo(User::class);
	}
}