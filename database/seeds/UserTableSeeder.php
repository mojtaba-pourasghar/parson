<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'name' => 'Bill',
                'email' => 'bill@gmail.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Mary',
                'email' => 'mary@gmail.com',
                'password' => bcrypt('123456')
            ]
        ]);
    }
}
