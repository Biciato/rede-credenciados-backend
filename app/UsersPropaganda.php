<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject;
    use Illuminate\Support\Facades\Hash;

    class UsersPropaganda extends Authenticatable implements JWTSubject
    {
        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'nome', 'email', 'tel', 'cep', 'rua', 'numero', 'complemento',
            'bairro', 'cidade', 'estado'
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
        public function propaganda()
        {
            return $this->hasOne('App\PropagandaUser');
        }
    }
