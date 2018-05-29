<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model{

	protected $table = 'answers';

	protected $fillable = ['content'];

	public function user(){

		return $this->belongsTo(User::class);
	}

	public function ride(){
		return $this->belongsTo(Ride::class);
	}

	public function comment(){
        return $this->belongsTo(Comment::class);
    }
}



