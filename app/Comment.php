<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model{

    protected $table = 'comments';

    protected $fillable = ['content'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ride(){
        return $this->belongsTo(Ride::class);
    }
    
	public function answer(){
		return $this->hasOne(Answer::class);
	}
}