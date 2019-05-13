<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject;

    class PessoaJuridica extends Authenticatable implements JWTSubject
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'user_id', 'cnpj', 'razao_social', 'nome_fantasia', 'nome_contato', 'email', 'email2', 'tel', 'tel2', 'cel', 'cel2'
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
        public function user()
        {
            return $this->belongsTo('App\User');
        }

        public function atividade()
        {
            return $this->hasOne('App\AtividadePessoaJuridica');
        }

        public function apresentacao()
        {
            return $this->hasOne('App\ApresentacaoPessoaJuridica');
        }

        public function endereco()
        {
            return $this->hasOne('App\EnderecoPessoaJuridica');
        }

        public function unidades()
        {
            return $this->hasMany('App\Unidade');
        }

        public function propaganda()
        {
            return $this->hasOne('App\PropagandaPessoaJuridica');
        }
    }
