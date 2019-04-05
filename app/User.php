<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject;
    use Illuminate\Support\Facades\Hash;

    class User extends Authenticatable implements JWTSubject
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name', 'email', 'password', 'tipo_pessoa', 'email_verified_at'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];

        public function getJWTIdentifier()
        {
            return $this->getKey();
        }
        public function getJWTCustomClaims()
        {
            return [];
        }

        public function pessoaFisica()
        {
            return $this->hasOne('App\PessoaFisica');
        }

        public function pessoaJuridica()
        {
            return $this->hasOne('App\PessoaJuridica');
        }

        public function cotacaoLida()
        {
            return $this->hasMany('App\CotacaoLida');
        }

        public function setPasswordAttribute($value)
        {
            $this->attributes['password'] = Hash::make($value);
        }

        public function propaganda()
        {
            return $this->hasOne('App\PropagandaPessoaJuridica');
        }
    }
