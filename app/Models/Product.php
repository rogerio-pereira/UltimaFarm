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
        'deadline',
        'profitability',
        'commission'
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
        'deadline',
        'profitability',
        'commission'

    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'client_id', 'id');
    }

    public function toString()
    {
        return  '<strong>Nome:</strong> '.$this->name.'<br/>'.
                '<strong>Valor:</strong> R$ '.number_format($this->price, 2, ',', '.').'<br/>'.
                '<strong>Prazo de recuperação:</strong> '.$this->deadline.' meses <br/>'.
                '<strong>Rentabilidade:</strong> '.$this->profitability.' %';

    }
}
