<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class PropagandaUnidade extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unidade_id', 'estados_lateral', 'estados_topo', 'cidades_lateral', 'cidades_topo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function unidade()
    {
        return $this->belongsTo('App\Unidade');
    }

    protected $casts = [
            'estados_lateral' => 'array',
            'estados_topo' => 'array',
            'cidades_lateral' => 'array',
            'cidades_topo' => 'array',
        ];
}
