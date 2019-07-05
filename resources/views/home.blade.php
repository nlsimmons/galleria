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

<style>

.images-input-label {
    cursor: pointer;
}

</style>

<div class="section is-paddingless">

    @if( count($album_slides->slides) > 1 )

        @component('comps.slideshow', [
            'id' => 'carousel-albums',
            'slides' => $album_slides->slides->all(),
        ])

            @if( $album_slides->slides->count() > 1)
                @php
                $slides = $album_slides->slides;
                $add_slide = $slides->pop();
                @endphp

                @foreach($slides as $slide)
                    @component('comps.album.slide', ['slide' => $slide]) @endcomponent
                @endforeach
            @endif

            @component('comps.album.new')
            @endcomponent

        @endcomponent

    @else

    <div class="container">
        {{-- Async --}}
        {{-- <label for="images-new-album" class="images-input-label">
            <input type="file" multiple class="add-photo-input" name="images[]" id="images-new-album">
            <p class="title is-5">You have no images in your gallery. Click to add some.</p>
            <p class="is-size-4">¯\_(ツ)_/¯</p>
        </label> --}}
        <form method="post" action="{{ route('upload', ['album' => 'new']) }}" enctype="multipart/form-data" id="form-new-album">
            @csrf
            <label for="images-new-album" class="images-input-label">
                <input type="file" multiple class="add-photo-input" name="images[]" id="images-new-album">
                <p class="title is-5">You have no images in your gallery. Click to add some.</p>
                <p class="is-size-4">¯\_(ツ)_/¯</p>
            </label>
        </form>
    </div>

    @endif

</div>

{{-- <div class="modal" id="images-new-album-modal">
    <div class="modal-background"></div>

    <div class="modal-content">
        <div class="box" id="images-uploading"></div>
    </div>

</div> --}}

<style>

</style>

@endsection
