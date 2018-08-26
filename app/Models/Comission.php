<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Comission.
 *
 * @package namespace App\Models;
 */
class Comission extends Model implements Transformable
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
        'client_id',
        'sale_id',
        'value',
        'deadline',
        'refunded',
        'created_at'
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 
        'client_id',
        'sale_id',
        'value',
        'deadline',
        'refunded',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deadline', 'created_at', 'deleted_at'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

}
