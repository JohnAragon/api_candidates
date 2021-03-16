<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable=[
    	'name','surname','email','phone','date_of_interview','qualification'
    ];

    public function scopeName($query, $name){
        if($name)
            return $query->where('name','LIKE',"%$name%");
    }

     public function scopeSurname($query, $surname){
        if($surname)
            return $query->where('surname','LIKE',"%$surname%");
    }

    public function scopeEmail($query, $email){
        if($email)
            return $query->where('email','LIKE',"%$email%");
    }

    public function scopeDateofInterview($query, $date_of_interview)
    {   
        if(($date_of_interview[0]) && ($date_of_interview[1]))
            return $query->where('date_of_interview','>=',$date_of_interview[0])
                      ->where('date_of_interview','<=',$date_of_interview[1]);   
    }

     public function scopeQualification($query, $qualification){
        if($qualification)
             return $query->where('qualification','LIKE',"%$qualification%");
    }
}
