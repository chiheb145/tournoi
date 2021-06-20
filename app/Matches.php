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
    public function equipe_1()
    {
        return $this->hasone('App\Equipes', 'id','equipe_1')->first();
    }
    public function equipe_2()
    {
        return $this->hasOne('App\Equipes', 'id','equipe_2')->first();
    }
}
