<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Role::class)->create();

      factory(App\Category::class, 4)->create();

      factory(App\User::class)->create();

        // $this->call(UsersTableSeeder::class);
    }
}
