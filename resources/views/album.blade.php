@extends('layouts.app')

@section('content')

@if( isset($album_slides) )
    @component('comps.albumview', [
        'album_slides' => $album_slides,
        'current_album' => $album->id,
    ]) @endcomponent
@endif

<div class="section">
    <div class="container-fluid">
        <div id="album-{{ $album->id }}-waterfall" class="waterfall album-waterfall">
            <input type="hidden" name="album_id" id="album_id" value="{{ $album->id }}">

            @foreach($album_waterfall->columns as $column)

                <div class="waterfall-column">

                    @foreach($column as $image)

                        <div class="waterfall-image">
                            <div class="image-wrapper">
                                <img src="{{ asset($image->uri(800) ?? '') }}" title="{{ $image->title ?? 'Untitled Image' }}" class="width-{{ $album_waterfall->columns->count() }}-cols">

                                @if( Auth::id() === $album->owner->id )
                                    <form class="image-control" method="post" action="/image/{{ $image->id }}">
                                        @csrf
                                        <input type="hidden" name="album" value="{{ $album->id }}">
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
                                            <button class="button-bare button-delete-image" title="Delete" name="action" value="delete">
                                                <i class="fas fa-minus-circle"></i>
                                            </button>
                                        </div>
                                    </form>
                                @endif
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
</div>

@if( Auth::id() === $album->owner->id )
    <label id="add-image-button" class="items-centered corner-fixed">
        <input type="file" class="hidden" id="add-image-simple" multiple>
        <i class="fas fa-plus-circle"></i>
    </label>
@endif

@endsection