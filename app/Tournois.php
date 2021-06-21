<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournois extends Model
{
    protected $table = 'tournois';
    use SoftDeletes;

    protected $fillable = [
        'name',
        'date_debut',
        'date_fin',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function list_matches()
    {
        return $this->hasMany('App\Matches', 'tournoi_id')->get();
    }
}
