<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductSubcategory;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductCategory extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use LogsActivity;
    use CascadeSoftDeletes;

    protected $cascadeDeletes = [
        'subcategories',
    ];

    protected $fillable = [
        'title'
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 'title'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

    public function subcategories()
    {
        return $this->hasMany(ProductSubcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
