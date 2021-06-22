<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matches extends Model
{
    protected $table = 'matches';
    use SoftDeletes;
    protected $fillable = [
        'tournoi_id',
        'equipe_one',
        'equipe_two',
        'date'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function equipe_one()
    {
        return $this->hasone('App\Equipes', 'id','equipe_one')->first();
    }
    public function equipe_two()
    {
        return $this->hasOne('App\Equipes', 'id','equipe_two')->first();
    }
}
