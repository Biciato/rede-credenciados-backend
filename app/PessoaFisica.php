<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject;

    class PessoaFisica extends Authenticatable implements JWTSubject
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'user_id', 'nome', 'rg', 'cpf', 'nascimento', 'sexo', 'email', 'email2', 'tel', 'tel2', 'cel', 'cel2'
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

        public function user()
        {
            return $this->belongsTo('App\User');
        }

        public function atividade()
        {
            return $this->hasOne('App\AtividadePessoaFisica');
        }

        public function apresentacao()
        {
            return $this->hasOne('App\ApresentacaoPessoaFisica');
        }

        public function endereco()
        {
            return $this->hasOne('App\EnderecoPessoaFisica');
        }

        public function pessoaFisicaImg() 
        {
            return $this->hasOne('App\PessoaFisicaImg');
        }
    }
