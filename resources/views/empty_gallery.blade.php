@extends('layouts.app')

@section('content')

<div class="section">

    <p class="title is-2 has-text-centered">My Gallery</p>

</div>

<div class="section">

    <div class="container has-text-centered">

        <form method="post" action="{{ route('upload') }}" id="upload-image-no-album" enctype="multipart/form-data">
            <label class="has-pointer">
                @csrf
                <input type="file" multiple class="add-photo-input" name="images[]">
                <input type="hidden" name="album" value="new">
                <p class="title is-5 ">You have no images in your gallery. Click to add some.</p>
                <p class="is-size-4">¯\_(ツ)_/¯</p>
            </label>
        </form>

    </div>

</div>

@endsection
