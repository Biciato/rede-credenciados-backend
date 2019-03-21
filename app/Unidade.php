<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject;

    class Unidade extends Authenticatable implements JWTSubject
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'pessoa_juridica_id', 'cnpj', 'razao_social', 'nome_fantasia', 'nome_contato', 'email', 'email2', 'tel', 'tel2', 'cel', 'cel2'
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

        public function atividade()
        {
            return $this->hasOne('App\AtividadeUnidade');
        }

        public function apresentacao()
        {
            return $this->hasOne('App\ApresentacaoUnidade');
        }

        public function endereco()
        {
            return $this->hasOne('App\EnderecoUnidade');
        }

        public function propaganda()
        {
            return $this->hasOne('App\PropagandaUnidade');
        }

        public function unidadeImg()
        {
            return $this->hasOne('App\UnidadeImg');
        }
    }
