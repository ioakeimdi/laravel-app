<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Technical Manager',
            'User and Subscription Manager',
            'Question/Answer Manager',
            'Content Manager',
            'Case Law / Legislation Manager',
            'Newsletter and News Manager',
        ];

		// Inser roles to db
		foreach ($roles as $roleName) {
			UserRole::firstOrCreate(
                ['name' => $roleName],
                ['is_active' => 1]
            );
        }
    }
}
