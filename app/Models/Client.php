<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'telephone',
        'document',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'hashIndication',
        'indication_id',
        'created_at'
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 
        'user_id',
        'telephone',
        'document',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'hashIndication',
        'indication_id',
        'state',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'client_id', 'id');
    }

    public function comissions()
    {
        return $this->hasMany(Comission::class, 'client_id', 'id');
    }

    public function indication()
    {
        return $this->belongsTo(Client::class, 'indication_id', 'id');
    }

    public function toString()
    {
        $string =  '<strong>Nome:</strong> '.$this->user->name.'<br/>'
                    .'<strong>E-mail:</strong> '.$this->user->email.'<br/>'
                    .'<strong>Telefone:</strong> '.$this->telephone.'<br/>'
                    .'<strong>Documento:</strong> '.$this->document.'<br/>'
                    .'<strong>Endereço:</strong> ';

        $string .= $this->street.', '.$this->number;

        if(isset($this->complement))
            $string .= ' - '.$this->complement;

        $string .= '. '.$this->neighborhood.
                    '. '.$this->city.
                    ' - '.$this->state.
                    '. '.$this->zipcode;

        return $string;
    }

}
