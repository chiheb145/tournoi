<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joueurs extends Model
{
    protected $table = 'joueurs';
    protected $fillable = [
        'first_name',
        'last_name',
        'equipe_id',

    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
