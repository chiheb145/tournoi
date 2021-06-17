<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipes extends Model
{
    protected $table = 'equipes';
    protected $fillable = [
        'name',
        'entraineur_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
