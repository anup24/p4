<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Text;
use Illuminate\Http\Request;
use Log;

class WikiTextsController extends Controller
{
    public function index()
    {
        $texts = Text::orderBy('header')->get();

        return view('texts.index')->with([
            'texts' => $texts,
        ]);
    }

    public function display(Request $request, $id)
    {
        $sameUser = false;
        $text = Text::find($id);

        $user = $request->user();
        if ($user != null && $text != null) {
            $text_user_id = $text->user_id;
            $curr_user_id = $user->id;

            if ($text_user_id == $curr_user_id) {
                $sameUser = true;
            }
        }
        if (!$text) {
            return redirect('/texts')->with(
                ['alert' => 'Wiki Text ' . $id . ' not found.']
            );
        }

        return view('texts.display')->with([
            'text' => $text,
            'tags' => $text->tags()->get(),
            'sameUser' => $sameUser,
        ]);
    }

    public function create(Request $request)
    {
        return view('texts.create')->with([
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
        # Save the text to the database
        $text = new Text();
        $text->header = $request->header;
        $text->contents = $request->contents;
        $text->user_id = $user->id;
        $text->save();
        $text->tags()->sync($request->input('tags'));

        return redirect('/texts')->with([
            'alert' => 'Your Text ' . $text->header . ' was added to WikiText.'
        ]);
    }

    public function edit($id)
    {
        # Get this text and eager load its tags
        $text = Text::with('tags')->find($id);
        # Handle the case where we can't find the given text
        if (!$text) {
            return redirect('/texts')->with(
                ['alert' => 'Text ' . $id . ' not found in WikiText.']
            );
        }

        # Show the text edit form
        return view('texts.edit')->with([
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
    * Asks user to confirm they actually want to delete the text
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
    * Actually deletes the text
    * DELETE /texts/{id}/delete
    */
    public function destroy($id)
    {
        $text = Text::find($id);
        # Before we delete the text we have to delete any tag associations
        $text->tags()->detach();
        $text->delete();

        return redirect('/texts')->with([
            'alert' => '“' . $text->header . '” was removed from WikiText.'
        ]);
    }

    public function tags()
    {
        $tags = Tag::orderBy('id')->get();

        return view('texts.tag')->with([
            'tags' => $tags,
        ]);
    }

    public function tag($id)
    {
        $tag = Tag::find($id);
        $texts = $tag->texts()->get();

        return view('texts.index')->with([
            'texts' => $texts,
        ]);
    }
}