<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }

    public function filteredCars()
    {
        return $this->belongsToMany('App\Car')
        ->wherePivot('tag_id', $this->id)
        ->orderBy('updated_at', 'DESC');
    }


}