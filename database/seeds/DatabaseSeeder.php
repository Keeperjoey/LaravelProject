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

        DB::table('roles')->insert([

            ['title' => 'Administrator', 'slug' => 'admin'],
            ['title' => 'Redactor', 'slug' => 'redac'],
            ['title' => 'User', 'slug' => 'user']

        ]);

        DB::table('users')->insert([

            ['username' => 'SuperJoey',
            'email' => 'joeyvenrooij@gmail.com',
            'password' => bcrypt('test12345'),
            'seen' => true,
            'role_id' => 1,
            'valid' => true,
            'confirmed' => true],

            ['username' => 'JustJoey',
            'email' => 'keeperjoey@gmail.com',
            'password' => bcrypt('test12345'),
            'seen' => true,
            'role_id' => 2,
            'valid' => true,
            'confirmed' => true],

            ['username' => 'ScrubJoey',
            'email' => 'keeperjoey@hotmail.com',
            'password' => bcrypt('test12345'),
            'seen' => false,
            'role_id' => 3,
            'valid' => false,
            'confirmed' => true]

        ]);



        DB::table('tags')->insert([

            ['tag' => 'Tag1'],
            ['tag' => 'Tag2'],
            ['tag' => 'Tag3'],
            ['tag' => 'Tag4']

        ]);



        DB::table('posts')->insert([
            ['title' => 'Post 1',
            'slug' => 'post-1',
            'summary' => 'blabla' . Lipsum::short()->html(2),
            'content' => Lipsum::medium()->link()->html(8),
            'active' => true,
            'user_id' => 1]

        ]);




        DB::table('post_tag')->insert([

            ['post_id' => 1, 'tag_id' => 1]
  
        ]);

        DB::table('comments')->insert([

            ['content' => Lipsum::medium()->text(3),
            'user_id' => 1,
            'post_id' => 1]


        ]);
    }
}
