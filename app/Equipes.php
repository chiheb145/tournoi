<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipes extends Model
{
    protected $table = 'equipes';
    use SoftDeletes;
    protected $fillable = [
        'name',
        'antraineur_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function entraineur()
    {
        return $this->hasone('App\Entraineurs', 'id','antraineur_id')->first();
    }
    public function joueurs()
    {
        return $this->belongsToMany('App\Joueurs', 'equipes_joueurs', 'equipe_id', 'joueur_id', 'id', 'id')->withPivot('id')->get();
    }
    public function has_matche($date)
    {
        $has_matche = false;
        $all_matches = Matches::where('date', $date)->get();
        foreach ($all_matches as $matche) {
            if ($matche->equipe_one == $this->id || $matche->equipe_two == $this->id) {
                $has_matche = true;
            }
        }
        return $has_matche;

    }

}
