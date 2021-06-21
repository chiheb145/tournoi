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
        'equipe_1',
        'equipe_2',
        'date',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
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
