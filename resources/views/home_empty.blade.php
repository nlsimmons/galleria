@extends('layouts.app')

@section('content')

<section class="section">
    <div class="container" style="display: flex;
                                  flex-direction: column;
                                  text-align: center;">
        <div style="margin: 50px 0;
                    font-size: 1.5rem">
            <p>Your gallery is empty.</p>
        </div>
        <div style="display: flex;
                    flex-direction: row;
                    justify-content: space-around;
                    align-items: baseline;
                    flex-wrap: wrap;">
            <form method="post" action="/album/new" style="width: 400px">
                @csrf
                <input type="hidden" id="api_token" value="{{ $token }}">
                <button class="button flex-vertical" type="submit" title="Create New Album"
                    style="font-size: 1em;
                           padding: 50px 30px;
                           width: 100%;">
                    <p>Get started by creating an album.</p>
                    <i class="far fa-images"></i>
                </button>
            </form>
            <div style="width: 400px">
                <label class="button flex-vertical" for="add-image-input"
                    style="font-size: 1em;
                           padding: 50px 30px;">
                    <p>Or just pick some photos to upload.</p>
                    <i class="far fa-image"></i>
                </label>
                <input type="file" class="hidden" id="add-image-input" multiple>
            </div>
        </div>
    </div>
</section>

@endsection
