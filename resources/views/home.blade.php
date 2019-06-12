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

<div class="section">

    <div class="container-fluid">
        {{-- <h1 class="title is-1" style="text-align: center">All Photos</h1> --}}

        @if(count($images) > 1)
        @component('components.slideshow', [
            'id' => 'carousel-images',
            'slides' => $images,
            'type' => 'image',
            'options' => [
                'buttons' => [
                    'delete', 'download', 'edit', 'tags', 'album'
                ]
            ]
        ])
        @endcomponent
        @else

        <div>
            <p>You have no images in your gallery yet. Click to add some.</p>
        </div>

        @endif

    </div>

</div>

<div class="section">

    <div class="container-fluid">
        {{-- <h1 class="title is-1" style="text-align: center">All Albums</h1> --}}

        {{-- @component('components.slideshow', [
            'id' => 'carousel-albums',
            'slides' => $albums,
            'type' => 'album',
            'options' => [
                'buttons' => [

                ]
            ],
        ])
        @endcomponent --}}

    </div>

</div>

@endsection
