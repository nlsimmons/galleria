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
        <div id="uploads__container">
            <input type="text" id="upload-title" class="title slide-title" placeholder="Click to add a title">
            <form method="post" action="" enctype="multipart/form-data" id="uploads__initial" class="draggable">
                <label for="images-new-album" class="upload-label">
                    <span id="no-dragndrop" class="disabled">
                        <p>You have no images in your gallery.</p>
                        <p>Click or drag some to upload.</p>
                        <p class="fas fa-images is-size-1"></p>
                    </span>
                    <span id="dragndrop">
                        <p>You have no images in your gallery.</p>
                        <p>Click to add some.</p>
                        <p class="fas fa-images is-size-1"></p>
                    </span>
                </label>
                <input type="file" multiple name="images[]" class="hidden" id="images-new-album">
            </form>
            <div id="uploads__staging" class="draggable">
                <div class="upload-label-container">
                    <label for="images-new-album" class="upload-label">
                        <p>Click or drag to upload more images.</p>
                    </label>
                </div>
            </div>
        </div>
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
