<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // I use migration for creating initial data. Because when you use seeder, you can use one seeder multiple times,
        // but you can use migration only once. That's way I create initial data with migration.
        $adminRole = Role::create(['name' => \App\Enums\RolesEnum::ADMIN->value]);
        Role::create(['name' => \App\Enums\RolesEnum::EMPLOYEE->value]);
        Role::create(['name' => \App\Enums\RolesEnum::ORGANIZATION->value]);

        $admin = \App\Models\User::factory()->create([
            'email' => 'admin@gmail.com'
        ]);
        $admin->assignRole($adminRole);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
