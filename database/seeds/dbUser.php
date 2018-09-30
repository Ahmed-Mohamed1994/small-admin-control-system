<?php

use Illuminate\Database\Seeder;

class dbUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'phone' => '01125252525',
            'type' => 'ADMIN',
            'active' => 1,
            'group_id' => null
        ]);
    }
}
