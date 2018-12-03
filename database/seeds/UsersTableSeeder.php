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

        'role_id' => 1,
        'is_active' => 1,
        'name'=> str_random(5),
        'email' => str_random(4).'@gmail.com',
        'password' => bcrypt('112233')

      ]);
    }
}
