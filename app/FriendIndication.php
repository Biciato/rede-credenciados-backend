<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class FriendIndication extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quem_indicou', 'indicado', 'forma_indicacao', 'bairro',
        'cidade', 'estado'
    ];
}
