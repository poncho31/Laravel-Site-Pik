<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    protected $fillable =  ['name'];

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
