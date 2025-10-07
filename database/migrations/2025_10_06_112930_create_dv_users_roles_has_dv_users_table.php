<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dv_users_roles_has_dv_users', function (Blueprint $table) {
            $table->unsignedBigInteger('dv_users_roles_id');
            $table->unsignedInteger('dv_users_id');
            $table->primary(['dv_users_roles_id', 'dv_users_id']);
			
            $table->foreign('dv_users_roles_id')
                  ->references('id')->on('dv_users_roles')
                  ->onDelete('cascade');

            $table->foreign('dv_users_id')
                  ->references('id')->on('dv_users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dv_users_roles_has_dv_users');
    }
};
