<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject;

    class EnderecoPessoaJuridica extends Authenticatable implements JWTSubject
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'pessoa_juridica_id', 'cep', 'rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado'
        ];

        public function getJWTIdentifier()
        {
            return $this->getKey();
        }
        public function getJWTCustomClaims()
        {
            return [];
        }

        // relationships
        public function pessoaJuridica()
        {
            return $this->belongsTo('App\PessoaJuridica');
        }
    }
