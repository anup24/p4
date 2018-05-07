<?php
use Illuminate\Database\Seeder;
use App\Text;
use App\Tag;

class TextTagTableSeeder extends Seeder
{
    public function run()
    {
        # First, create an array of all the texts we want to associate tags with
        $texts = [
            'My Text 1' => ['misc', 'temp', 'code'],
            'My Text 2' => ['to-do', 'notes', 'misc'],
            'My Text 3' => ['to-do', 'temp', 'code'],
            'My Text 4' => ['notes', 'misc', 'temp', 'code'],
            'My Text 5' => ['to-do', 'notes', 'code']
        ];

        # Now loop through the above array, creating a new pivot for each text to tag
        foreach ($texts as $header => $tags) {
            # First get the text
            $text = Text::where('header', 'like', $header)->first();

            # Now loop through each tag for this text, adding the pivot
            foreach ($tags as $tagName) {
                $tag = Tag::where('name', 'LIKE', $tagName)->first();

                # Connect this tag to this text
                $text->tags()->save($tag);
            }
        }
    }
}