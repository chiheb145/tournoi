<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entraineurs extends Model
{
    protected $table = 'entraineurs';
    protected $fillable = [
        'first_name',
        'last_name',
        'is_affected',

    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function full_name()
    {
        //dd($this->attributes['first_name']);
        return @$this->attributes['first_name'] . ' ' . @$this->attributes['last_name'];
    }
}
