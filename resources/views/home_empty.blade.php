@extends('layouts.app')

@section('content')

<div class="section is-paddingless">

    {{-- Async --}}
    {{-- <label for="images-new-album" class="images-input-label">
        <input type="file" multiple class="add-photo-input" name="images[]" id="images-new-album">
        <p class="title is-5">You have no images in your gallery. Click to add some.</p>
        <p class="is-size-4">¯\_(ツ)_/¯</p>
    </label> --}}
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

        {{-- <form method="post" action="{{ route('upload', ['album' => 'new']) }}" enctype="multipart/form-data" id="form-new-album">
            @csrf
            <label for="images-new-album" class="images-input-label">
                <input type="file" multiple class="add-photo-input" name="images[]" id="images-new-album">
                <p class="title is-5">You have no images in your gallery. Click to add some.</p>
                <p class="is-size-4">¯\_(ツ)_/¯</p>
            </label>
        </form> --}}
    </div>
</div>

@endsection
