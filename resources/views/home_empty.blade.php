@extends('layouts.app')

@section('content')

<section class="section">
    <div class="container" style="display: flex;
                                  flex-direction: column;
                                  text-align: center;
                                  font-size: 1.5em;">
        <div>
            <p>Your gallery is empty.</p>
        </div>
        <div style="display: flex;
                    flex-direction: row;
                    justify-content: space-around;
                    align-items: center;
                    margin-top: 100px;">
            <div>
                <form method="post" action="/album/new">
                    @csrf

                    <button type="submit" title="Create New Album">
                        <p>Get started by creating a new album.</p>
                        <i class="far fa-images"></i>
                    </button>
                </form>
            </div>
            <div>
                <label id="add-image-button">
                    <p>Or just start uploading some pictures.</p>
                    <input type="file" class="hidden" id="add-image-simple" multiple>
                    <i class="far fa-image"></i>
                </label>
            </div>
        </div>
    </div>
</section>

@endsection
