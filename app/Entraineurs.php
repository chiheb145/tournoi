<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entraineurs extends Model
{
    protected $table = 'entraineurs';
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

        $equipe = Equipes::where('antraineur_id', $this->id)->first();
        if (!$equipe ) {
            $equipe = null;
        }
        return $equipe;
    }
}
