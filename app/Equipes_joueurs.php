<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipes_joueurs extends Model
{
    protected $table = 'equipes_joueurs';
    use SoftDeletes;
    protected $fillable = [
        'equipe_id',
        'joueur_id',
        'is_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
