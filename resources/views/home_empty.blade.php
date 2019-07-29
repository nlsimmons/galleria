@extends('layouts.app')

@section('content')

<section class="section">
    <div class="container flex-vertical">
        <div class="empty-container-header">
            <p>Your gallery is empty.</p>
        </div>
        <div class="empty-container">
            <form method="post" action="/album/new">
                @csrf
                <input type="hidden" id="api_token" value="{{ $token }}">
                <button class="button flex-vertical" id="add-album" type="submit" title="Create New Album">
                    <p>Get started by creating an album.</p>
                    <i class="far fa-images"></i>
                </button>
            </form>
            <div>
                <label class="button flex-vertical" id="add-images" for="add-image-input">
                    <p>Or just pick some photos to upload.</p>
                    <i class="far fa-image"></i>
                </label>
                <input type="file" class="hidden" id="add-image-input" multiple>
            </div>
        </div>
    </div>
</section>

@endsection
