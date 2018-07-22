<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Permission extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = array('pivot');


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];

    /**
     * The attributes that should be hidden in permissions form.
     *
     * @var array
     */
    public $notShowPermissions = [
        'view-permissions',
        'create-permissions',
        'delete-permissions'
    ];

    /**
     * User's permission
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
