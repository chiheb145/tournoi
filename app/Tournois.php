<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournois extends Model
{
    protected $table = 'tournois';
    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
