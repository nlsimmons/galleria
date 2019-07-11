@extends('layouts.app')

@section('content')

<!--
    Todo:
    Scroll using arrow keys
    Customize background
    prevent reupload on refresh
    loading wheel
    css breakpoints

    photo buttons:
        delete /
        download /
        move to album
            on button hover show list of albums with tooltip album names
        edit ? what do, save this for later
        hide/show
        share
        add / remove tags
            Tags also show in description

    album buttons:
        delete
        hide/show
        add tags

    Photo
        Should maybe take up 1/3 of the screen? or 50%
            Could make this an editable option
        Click
            expand - show in modal
        Mouseover
            show description expanding from bottom
            show options
        Click title edit /

    Album
        mouseover
            show title
            show description
            show first 3? images
        click
            go to album page

    New album
        title
        images
        description (optional)
        tags (optional)
        btns create cancel


    side by side compare images
    color breakdown of album(s)

-->

@component('comps.albumview', [
    'album_slides' => $album_slides,
])
@endcomponent

<section class="section">

</section>

@endsection
