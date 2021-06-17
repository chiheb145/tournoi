<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entraineurs extends Model
{
    protected $table = 'entraineurs';
    protected $fillable = [
        'first_name',
        'last_name',

    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
