@extends('layouts.app')

@section('content')

<div class="section is-paddingless">
    <div class="container">

        @component('comps.album.upload')
            <span id="dragndrop" class="disabled">
                <p>You have no images in your gallery.</p>
                <p>Click or drag some to upload.</p>
                <p class="fas fa-images is-size-1"></p>
            </span>
            <span id="no-dragndrop">
                <p>You have no images in your gallery.</p>
                <p>Click to add some.</p>
                <p class="fas fa-images is-size-1"></p>
            </span>
        @endcomponent

    </div>
</div>

@endsection
