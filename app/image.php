<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'description', 'user_id',
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\category');
    }

    public function getAll()
    {
        return static::all();
    }

    public function find($id){
        return static::find($id);
    }
}
