<?php

use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->truncate();

        DB::table('blogs')->insert([
            [
                'author_id' => '1',
                'title' => 'Example Blog 1',
                'slug'=>'example-Blog-1',
                'body'=>'This is example post',
                'published_at'=> date('Y-m-d H:i:s',strtotime('+2 weeks'))
            ],
            [
                'author_id' => '2',
                'title' => 'Example Blog 2',
                'slug'=>'example-Blog-2',
                'body'=>'This is example post 2',
                'published_at'=> date('Y-m-d H:i:s',strtotime('+2 weeks'))
            ],
            [
                'author_id' => '3',
                'title' => 'Example Blog 3',
                'slug'=>'example-Blog-3',
                'body'=>'This is example post 3',
                'published_at'=> date('Y-m-d H:i:s',strtotime('+2 weeks'))
            ]
        ]);
    }
}
