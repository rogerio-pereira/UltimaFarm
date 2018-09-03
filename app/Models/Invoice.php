<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Sale.
 *
 * @package namespace App\Models;
 */
class Invoice extends Model implements Transformable
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
        'product_id',
        'value',
        'profitability',
        'deadline',
        'refundValue',
        'refunded',
        'token',
        'identify',
        'paymentId',
        'payerID',
        'status',
        'processed',
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
        'product_id',
        'value',
        'profitability',
        'deadline',
        'refundValue',
        'refunded',
        'token',
        'identify',
        'paymentId',
        'payerID',
        'status',
        'processed'
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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function comission()
    {
        return $this->hasOne(Comission::class, 'sale_id', 'id');
    }

    public function updatePaypalData($paymentId, $identify)
    {
        $this->paymentId = $paymentId;
        $this->identify = $identify;
        $this->save();

        //Grava Log
        Activity::all()->last();
    }

    public function updatePaypalDataReturn($token, $payerId, $status)
    {
        $this->token = $token;
        $this->payerId = $payerId;
        $this->status = $status;
        $this->save();

            //Grava Log
        Activity::all()->last();
    }
}
