<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Super admin",
            'email' => 'superAdminUser@email.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => "admin user",
            'email' => 'adminUser@email.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => "admin guest",
            'email' => 'guestUser@email.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
