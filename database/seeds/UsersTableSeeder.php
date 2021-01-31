<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'user1',
                'email' => 'email1@example.com',
                'email_verified_at' => '2020-08-09 00:00:00',
                'password' => '$2y$10$3Umthps6ZyrxWRAwjzPyUOta54kXfwkwmy34.8uQw8O9OFOn8tCnS',
                'api_token' => 'ynlGN3MAfLdjeHGEjp9aIeSiBPZJKAaBnosAix1ZvZfm27hQN2YtfRxTFjkE',
            ],
            [
                'name' => 'user2',
                'email' => 'email2@example.com',
                'email_verified_at' => '2020-08-09 00:00:00',
                'password' => '$2y$10$xtLANf4bPTnwyahssBalL.MMDxG01DI1pUNhtZdt4n0NxwYPN2ETO',
                'api_token' => 'HCOqfYRpcpou389xVoAa0niVbcE51hWZs8HWSzgzYrFgeKHsXqQI0hTNY3fb',
            ],
        ];

        User::insert($users);
    }
}
