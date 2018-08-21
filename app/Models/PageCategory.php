<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class PageCategory.
 *
 * @package namespace App\Models;
 */
class PageCategory extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'title'
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 'title',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

}
