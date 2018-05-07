<?php
use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $tags = ['to-do', 'notes', 'misc', 'temp', 'code'];
        foreach ($tags as $tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}