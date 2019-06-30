@extends('layouts.app')

@section('content')

<div class="section">

    <p class="title is-2 has-text-centered">My Gallery</p>

</div>

<div class="section">

    @component('comps.album.new')
        <input type="file" multiple class="add-photo-input" name="images[]">
        <input type="hidden" name="album" value="new">
        <p class="title is-5 ">You have no images in your gallery. Click to add some.</p>
        <p class="is-size-4">¯\_(ツ)_/¯</p>
    @endcomponent

</div>

@endsection
