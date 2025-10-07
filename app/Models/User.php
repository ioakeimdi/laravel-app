<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserRole;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
	
	public $timestamps = false;
	
	protected $table = 'dv_users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
		'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

	/**
	 * Roles that belong to the user
	 */
	public function roles()
	{
		return $this->belongsToMany(
			UserRole::class,
			'dv_users_roles_has_dv_users',
			'dv_users_id',
			'dv_users_roles_id'
		);
	}
}
