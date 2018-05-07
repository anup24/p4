<?php

use Illuminate\Database\Seeder;
use App\Text;
use App\User;

class WikiTextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $texts = [
            ['My Text 1', 'ABCDE 12345', 'abc@xyz.com'],
            ['My Text 2', 'AAA BBB CCC', 'lmn@xyz.com'],
            ['My Text 3', 'AAA FFF CCC', 'ccc@xyz.com'],
            ['My Text 4', 'CCC BBB EEE', 'rrr@xyz.com'],
            ['My Text 5', 'WWW BBB QQQ', 'pqr@xyz.com'],
        ];

        $count = count($texts);

        foreach ($texts as $key => $textData) {
            # Find that user in the users table
            $email = $textData[2];
            $user_id = User::where('email', '=', $email)->pluck('id')->first();

            $text = new Text();
            $text->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $text->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
            $text->header = $textData[0];
            $text->contents = $textData[1];
            $text->user_id = $user_id;

            $text->save();
            $count--;
        }
    }
}
