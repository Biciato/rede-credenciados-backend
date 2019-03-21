<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class PropagandaPessoaJuridica extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pessoa_juridica_id', 'estados_lateral', 'estados_topo', 'cidades_lateral', 'cidades_topo'
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

    public function pessoaJuridica()
    {
        return $this->belongsTo('App\PessoaJuridica');
    }

    protected $casts = [
            'estados_lateral' => 'array',
            'estados_topo' => 'array',
            'cidades_lateral' => 'array',
            'cidades_topo' => 'array',
        ];
}
