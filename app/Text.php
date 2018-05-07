<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    public function user()
    {
        # WikiText belongs to user
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\User');
    }
    public function tags()
    {
        # With timestamps() will ensure the pivot table has its created_at/updated_at fields automatically maintained
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public static function dump($texts = null)
    {
        # Empty array that will hold all text data
        $data = [];

        if (is_null($texts)) {
            # Query for all the classifieds
            $texts = self::all();
        }
        # Load the data array with the classified info we want
        foreach ($texts as $text) {
            $data[] = $text->header . ' by ' . $text->user;
        }
        dump($data);
    }
}