<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'image',
        'title',
        'description',
        'text',
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'id',
        'image',
        'title',
        'description',
        'text',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

}
