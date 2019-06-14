<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $fillable =  ['name', 'content', 'image', 'imagePosition','user_id'];

    public function getAll()
    {
        return static::all();
    }

    public function find($id){
        return static::find($id);
    }
}
