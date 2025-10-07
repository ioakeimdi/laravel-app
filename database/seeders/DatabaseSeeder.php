<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
		// Add Roles
		$this->call(UserRolesSeeder::class);

		// Add first test user
		$this->call(UsersTableSeeder::class);

		// Add test users
		User::factory(50)->create();
    }
}
