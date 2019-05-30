@extends('layouts.app')

@section('content')

<!--
    Todo:
    Make the carousel a component
    Apply scrolling somehow
    Also using arrow keys
    Upload

    Images:
    size: Thumbnail, Display, Full
    Clicking an image smoothly transitions to showing it in "Full"

    Customize background
-->

<div class="section">

    <div class="container-fluid">
        <h1 class="title is-1" style="text-align: center">All Photos</h1>

        <div class="carousel">

            @foreach( $slides as $img )

            <input type="radio" id="{{ $img->id }}" class="carousel-activator" name="activator" {{ $img->id === 1 ? 'checked' : '' }}>
            <div class="carousel-controls">
                <label for="{{ $img->previous }}" class="carousel-control carousel-control-backward"></label>
                <label for="{{ $img->next }}" class="carousel-control carousel-control-forward"></label>
            </div>

            @endforeach

            <div class="carousel-mask carousel-mask-left"></div>
            <div class="carousel-track">
                @foreach( $slides as $img )
                @if($img instanceof App\Image)

                <div class="carousel-slide">
                    <a href="{{ $img->url }}">
                        <img class="slide-image" src="{{ asset($img->display_url) }}">
                    </a>
                </div>

                @else

                <div class="carousel-slide add-photo-slide">
                    <form method="post" action="{{ route('upload') }}" id="upload-image-no-album" enctype="multipart/form-data">
                        @csrf
                        <label class="add-photo-btn">
                            <input type="file" multiple class="add-photo-input" name="image-no-album">
                            <i class="fas fa-plus-circle"></i>
                        </label>
                    </form>
                </div>

                @endif
                @endforeach
            </div>
            <div class="carousel-mask carousel-mask-right"></div>

            <div class="carousel-indicators">
                @foreach( $slides as $img )

                <label for="{{ $img->id }}" class="carousel-indicator"></label>

                @endforeach
            </div>

        </div>

    </div>

</div>

@endsection
