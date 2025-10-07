<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		// First user
		$user = User::firstOrCreate(
			// check unique
			[
				'email' => 'johnd@example.com',
				'username' => 'john'
			],
			// data
			[
				'name' => 'John Doe',
				'username' => 'john',
				'password' => Hash::make('123456'),
				'is_active' => 1,
			]
		);

		// Assign role
		if (!$user->roles()->where('dv_users_roles_id', 1)->exists()) {
			$user->roles()->attach([1]);
		}
    }
}
