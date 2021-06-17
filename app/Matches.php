<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';
    protected $fillable = [
        'tournoi_id',
        'equipe_1',
        'equipe_2',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
