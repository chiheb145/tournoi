<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Joueurs extends Model
{
    protected $table = 'joueurs';
    use SoftDeletes;
    protected $fillable = [
        'first_name',
        'last_name',
        'is_affected',

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function full_name()
    {
        //dd($this->attributes['first_name']);
        return @$this->attributes['first_name'] . ' ' . @$this->attributes['last_name'];
    }
    public function equipe(){

        $equipe_joueur = Equipes_joueurs::where('joueur_id', $this->id)->latest()->first();
        if ($equipe_joueur) {
            $equipe = Equipes::find($equipe_joueur->equipe_id);
        } else {
            $equipe = null;
        }
        return $equipe;
    }
}
