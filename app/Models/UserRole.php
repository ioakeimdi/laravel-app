<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	protected $table = 'dv_users_roles';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'is_active',
    ];
	
	/**
	 * Users that are assigned to this role
	 */
    public function users()
	{
		return $this->belongsToMany(
			User::class,
			'dv_users_roles_has_dv_users',
			'dv_users_roles_id',
			'dv_users_id'
		);
	}
}
