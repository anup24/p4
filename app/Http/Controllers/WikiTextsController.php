<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Text;
use App\User;
use App\Tag;

class WikiTextsController extends Controller
{
    public function index()
    {
        $texts = Text::orderBy('header')->get();
        # Query the database to get the last 3 texts added
        $newTexts = $texts->sortByDesc('created_at')->all();

        return view('texts.index')->with([
            'texts' => $texts,
            'newTexts' => $newTexts,
            'tagsForCheckboxes' => Tag::getForCheckboxes(),
            'usersForDropdown' => User::getForDropdown(),
            'tags' => [],
        ]);
    }

    public function display(Request $request, $id)
    {
        $flag = false;
        $text= Text::find($id);

        $user = $request->user();
        if($user != null && $text != null) {
            $text_user_id = $text->user_id;
            $curr_user_id = $user->id;

            if($text_user_id == $curr_user_id){
                $flag = true;
            }
        }
        if (!$text) {
            return redirect('/texts')->with(
                ['alert' => 'Wiki Text ' . $id . ' not found.']
            );
        }
        return view('texts.display')->with([
            'text' => $text,
            'flag' => $flag,
        ]);
    }

    public function create(Request $request)
    {
        return view('texts.create')->with([
            'usersForDropdown' => User::getForDropdown(),
            'tagsForCheckboxes' => Tag::getForCheckboxes(),
            'text' => new Text(),
            'tags' => [],
        ]);
    }
    /**
     * POST /texts
     */
    public function store(Request $request)
    {
        $user = $request->user();
        # Custom validation messages
        $messages = [
            'user.required' => 'The user field is required.',
        ];
        $this->validate($request, [
            'header' => 'required',
            'contents' => 'required',
        ], $messages);
        # Save the ad to the database
        $text = new Text();
        $text->header = $request->header;
        $text->contents = $request->contents;
        $text->user_id = $user->id;
        $text->save();
        $text->tags()->sync($request->input('tags'));

        return redirect('/texts')->with([
            'alert' => 'Your Text ' . $text->header . ' was added.'
        ]);
    }

    public function edit($id)
    {
        # Get this text and eager load its tags
        $text = Text::with('tags')->find($id);
        # Handle the case where we can't find the given text
        if (!$text) {
            return redirect('/texts')->with(
                ['alert' => 'WikiText ' . $id . ' not found.']
            );
        }
        # Show the text edit form
        return view('texts.edit')->with([
            'usersForDropdown' => User::getForDropdown(),
            'tagsForCheckboxes' => Tag::getForCheckboxes(),
            'tags' => $text->tags()->pluck('tags.id')->toArray(),
            'text' => $text
        ]);
    }
    /**
     * PUT /texts/{id}
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $messages = [
            'user_id.required' => 'The user field is required.',
        ];
        $this->validate($request, [
            'header' => 'required',
            'contents' => 'required',
        ], $messages);

        $text = Text::find($id);
        # Update data
        $text->header = $request->header;
        $text->user_id = $user->id;
        $text->contents = $request->contents;
        $text->tags()->sync($request->input('tags'));
        # Save edits
        $text->save();
        # Send the user back to the edit page in case they want to make more edits
        return redirect('/texts/' . $id . '/edit')->with([
            'alert' => 'Your changes were saved'
        ]);
    }
    /*
    * Asks user to confirm they actually want to delete the classified
    * GET /texts/{id}/delete
    */
    public function delete($id)
    {
        $text = Text::find($id);
        if (!$text) {
            return redirect('/texts')->with('alert', 'Text not found');
        }
        return view('texts.delete')->with([
            'text' => $text,
        ]);
    }
    /*
    * Actually deletes the classified
    * DELETE /texts/{id}/delete
    */
    public function destroy($id)
    {
        $text = Text::find($id);
        # Before we delete the text we have to delete any tag associations
        $text->tags()->detach();
        $text->delete();
        return redirect('/texts')->with([
            'alert' => '“' . $text->header . '” was removed.'
        ]);
    }

    public function search(Request $request)
    {
        $searchResults = [];
        # Store the searchTerm in a variable for easy access
        $searchTerm = $request->input('searchTerm', null);
        # Only try and search *if* there's a searchTerm
        if ($searchTerm) {
            # Nothing fancy here; just a built in PHP method
            $texts = Text::orderBy('header')->get();

            foreach ($texts as $header => $text) {
                # Case sensitive boolean check for a match
                if ($request->has('caseSensitive')) {
                    $match = $header == $searchTerm;
                    # Case insensitive boolean check for a match
                } else {
                    $match = strtolower($header) == strtolower($searchTerm);
                }
                # If it was a match, add it to our results
                if ($match) {
                    $searchResults[$header] = $text;
                }
            }
        }
        # Return the view, with the searchTerm *and* searchResults (if any)
        return view('texts.search')->with([
            'searchTerm' => $searchTerm,
            'caseSensitive' => $request->has('caseSensitive'),
            'searchResults' => $searchResults
        ]);
    }
}