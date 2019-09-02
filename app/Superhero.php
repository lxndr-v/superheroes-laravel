<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Superhero extends Model
{
    //OneToMany implemintation
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function heropictures(){
        return $this->hasMany('App\Heropicture');
    }
        
}
