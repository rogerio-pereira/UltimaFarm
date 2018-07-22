<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements Transformable
{
    use TransformableTrait;
    use Notifiable;
    use SoftDeletes;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'name', 
        'email',  
        'role',
        'active'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'id', 'author_id');
    }

    /**
     * User's permission
     * @return [Collection][Permission] User's Permission
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function permissionsArray()
    {
        $permissions = array();

        foreach($this->permissions as $permission) {
            $permissions[] = $permission;
        }

        return $permissions;
    }


    /**
     * Check if user has permission
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission($permissions)
    {        
        return $this->permissions->contains($permissions);
    }
}
