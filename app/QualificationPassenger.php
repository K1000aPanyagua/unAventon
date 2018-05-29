<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class QualificationPassenger extends Model{

    protected $table = 'QualificationsPassengers';

    protected $fillable = ['value', 'review'];

    public function pilot(){
        return $this->belongsTo(User::class);
    }

    public function passenger(){
        return $this->belongsTo(User::class);
    }

    public function ride(){
        return $this->belongsTo(Ride::class);
    }

