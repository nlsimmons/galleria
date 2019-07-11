@extends('layouts.app')

@section('content')

@component('comps.albumview', [
    'album_slides' => $album_slides,
    'current_album' => $album_id,
])
@endcomponent

<div class="container-fluid">
    <div id="album-{{ $album_id }}-waterfall" class="waterfall album-waterfall">
        <input type="hidden" name="album_id" id="album_id" value="{{ $album_id }}">

        @foreach($album_waterfall as $column)
            <div class="waterfall-column">
                @foreach($column as $image)
                    <div class="waterfall-image">
                        <div class="image-wrapper">
                            <img src="{{ asset($image->url) }}">
                            <form class="image-control" method="post" action="/image/{{ $image->id }}">
                                @csrf
                                <input type="hidden" name="album" value="{{ $album_id }}">
                                <div class="button-wrapper">
                                    <button class="button-bare" title="Add" name="action" value="add">
                                        <i class="fas fa-plus-circle"></i>
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

{{-- <div class="modal" id="add-image-modal">
    <div class="modal-background"></div>
    @component('comps.upload', [
        'album' => $album_id,
    ])
    @endcomponent
</div>
<div id="add-image-button" class="items-centered">
    <i class="fas fa-plus-circle"></i>
</div> --}}

<label id="add-image-button" class="items-centered">
    <input type="file" class="hidden" id="add-image-simple" multiple>
    <i class="fas fa-plus-circle"></i>
</label>

@endsection