<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model{

	protected $table = 'answers';

	protected $fillable = ['content'];

	public function user(){

		return $this->belongsTo(Comment::class);
	}

	public function ride(){
		return $this->belongsTo(Ride::class);
	}





