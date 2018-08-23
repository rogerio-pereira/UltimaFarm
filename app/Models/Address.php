<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Address.
 *
 * @package namespace App\Models;
 */
class Address extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_category_id',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'address_category_id',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

    public function toString()
    {
        $address = $this->street.', '.$this->number;

        if(isset($this->complement))
            $address .= ' - '.$this->complement;

        $address .= '. '.$this->neighborhood.
                    '. '.$this->city.
                    ' - '.$this->state.
                    '. '.$this->zipcode;

        return $address;
    }

    public function category()
    {
         return $this->belongsTo(AddressCategory::class, 'address_category_id');
    }
}
