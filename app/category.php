<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable =  ['name', 'level', 'project'];

    public function getAll()
    {
        return static::all();
    }

    public function find($id){
        return static::find($id);
    }

    public function images()
    {
        return $this->hasMany('App\image');
    }
}
