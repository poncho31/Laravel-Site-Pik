<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class category extends Model
{
    protected $fillable =  ['name', 'project', 'section'];

    public function getAll()
    {
        return static::all();
    }

    public function find($id){
        return static::find($id);
    }

    // public function findBy($value){
    //     return DB::table("categories")->where($secCatPro);
    // }

    public function images()
    {
        return $this->hasMany('App\image');
    }
}
