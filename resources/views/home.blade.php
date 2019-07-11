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

<div class="container-fluid">
    <div id="home-waterfall" class="waterfall">

        @foreach($images->columns as $column)

            <div class="waterfall-column">

                @foreach($column as $image)

                    <div class="waterfall-image">
                        <div class="image-wrapper">
                            <img src="{{ asset($image->uri(1000) ?? '') }}">
                            <form class="image-control" method="post" action="/image/{{ $image->id }}">
                                @csrf
                                <input type="hidden" name="album" value="home">
                                <div class="button-wrapper">
                                    <button class="button-bare" title="Rotate Left" name="action" value="rotate-left">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                    <button class="button-bare" title="Rotate Right" name="action" value="rotate-right">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                    <button class="button-bare" title="Add Tag" name="action" value="tag">
                                        <i class="fas cs cs-tags"></i>
                                    </button>
                                    <button class="button-bare" title="Download" name="action" value="download">
                                        <i class="fas fa-arrow-alt-circle-down"></i>
                                    </button>
                                    <button class="button-bare" title="Delete" name="action" value="delete">
                                        <i class="fas fa-minus-circle"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>

                @endforeach

            </div>
        @endforeach

    </div>
</div>

@endsection
