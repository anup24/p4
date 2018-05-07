<div class='details'>* Required fields</div>

<label for='header'>* Header</label>
<input type='text' name='header' id='header' value='{{ old('header', $text->header) }}'>
@include('modules.error-field', ['field' => 'header'])

<label for='content'>* Contents</label>
<input type='text' name='contents' id='contents' value='{{ old('contents', $text->contents) }}'>
@include('modules.error-field', ['field' => 'contents'])

<label>Tags</label>
@foreach($tagsForCheckboxes as $tagId => $tagName)
<ul class='tags'>
        <label>
            <input
                {{ (in_array($tagId, $tags)) ? 'checked' : '' }} type='checkbox' name='tags[]' value='{{ $tagId }}'> {{ $tagName }}
        </label>
</ul>
@endforeach