@extends('layouts.app')

@section('content')

<div class="section is-paddingless">

        {{-- Async --}}
        {{-- <label for="images-new-album" class="images-input-label">
            <input type="file" multiple class="add-photo-input" name="images[]" id="images-new-album">
            <p class="title is-5">You have no images in your gallery. Click to add some.</p>
            <p class="is-size-4">¯\_(ツ)_/¯</p>
        </label> --}}
    <div class="container is-flex">
        <form method="post" action="{{ route('upload', ['album' => 'new']) }}" enctype="multipart/form-data" id="form-new-album">
            @csrf
            <label for="images-new-album" class="images-input-label">
                <input type="file" multiple class="add-photo-input" name="images[]" id="images-new-album">
                <p class="title is-5">You have no images in your gallery. Click to add some.</p>
                <p class="is-size-4">¯\_(ツ)_/¯</p>
            </label>
        </form>
    </div>
</div>

@endsection
