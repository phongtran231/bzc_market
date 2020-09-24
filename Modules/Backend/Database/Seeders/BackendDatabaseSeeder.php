<?php

namespace Modules\Backend\Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class BackendDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Admin::insert([
            'user_name' => 'admin',
            'password' => bcrypt(123),
        ]);

        Role::create([
            'name' => 'super-admin',
            'guard_name' => Admin::GUARD_NAME,
        ]);

        Admin::where('user_name', 'admin')->first()->assignRole('super-admin');
    }
}
