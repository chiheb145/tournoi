<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipes_joueurs extends Model
{
    protected $table = 'equipes_joueurs';
    protected $fillable = [
        'joueur_id',
        'equipe_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
