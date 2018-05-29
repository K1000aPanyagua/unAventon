<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model{

	protected $table = 'accounts';

	protected $fillable = ['numAccount'];

	public function user(){

		return $this->belongsTo(User::class);
	}
}