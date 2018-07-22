<?php

namespace App\Models;

use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'product_category_id',
        'product_subcategory_id',
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 
        'name',
        'price',
        'quantity',
        'product_category_id',
        'product_subcategory_id',

    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'product_category_id');
    }

    public function subcategory()
    {
        return $this->hasOne(ProductSubcategory::class, 'id', 'product_subcategory_id');
    }
}
