@extends('layouts.app')

@section('content')

@component('comps.albumview', [
    'album_slides' => $album_slides,
])
@endcomponent

<section class="section">
    <div class="container-fluid">
        <div id="home-waterfall" class="waterfall">

            @foreach($images->columns as $column)

                <div class="waterfall-column">

                    @foreach($column as $image)

                        <div class="waterfall-image">
                            <div class="image-wrapper">
                                <a href="{{ url( $image->album_link() ) }}" target="_blank">
                                    <img src="{{ asset($image->uri(1000) ?? '') }}" title="{{ $image->title ?? 'Untitled Image' }}" class="width-{{ $images->columns->count() }}-cols">
                                </a>
                                <form class="image-control" method="post" action="/image/{{ $image->id }}">
                                    @csrf
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
                            </div>
                        </div>

                    @endforeach

                </div>
            @endforeach

        </div>
    </div>
</section>


@endsection
