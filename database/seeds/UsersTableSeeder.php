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
        # Array of author data to add
        $users = [
            ['Def', 'Abc', 'abc@xyz.com', 'pass1'],
            ['Ddd', 'Lmn', 'lmn@xyz.com', 'pass2'],
            ['XYZ', 'Ccc', 'ccc@xyz.com', 'pass3'],
            ['J.K.', 'Rrr', 'rrr@xyz.com', 'pass4'],
            ['Watson', 'Pqr', 'pqr@xyz.com', 'pass5']
        ];
        $count = count($users);
        # Loop through each author, adding them to the database
        foreach ($users as $userData) {
            $user = new User();
            $user->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $user->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $user->first_name = $userData[0];
            $user->last_name = $userData[1];
            $user->email = $userData[2];
            $user->password = $userData[3];
            $user->save();
            $count--;
        }
    }
}
