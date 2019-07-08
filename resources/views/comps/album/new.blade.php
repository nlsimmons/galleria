<div class="carousel-slide image-slide">

    @component('comps.album.upload')
        <span id="no-dragndrop" class="disabled">
            <p>Click to add a new album</p>
            <p class="fas fa-images is-size-1"></p>
        </span>
        <span id="dragndrop">
            <p>Click or drag to add a new album.</p>
            <p class="fas fa-images is-size-1"></p>
        </span>
    @endcomponent

    {{-- <p class="title image-title">New Album</p>

    <div class="image_wrapper display_wrapper">
        <form method="post" action="{{ route('upload', ['album' => 'new']) }}" enctype="multipart/form-data" id="form-album">
            @csrf
            <label class="add-photo-btn">
                <input type="file" multiple class="add-photo-input" name="images[]" id="images-album">
                <i class="fas fa-plus-circle"></i>
            </label>
        </form>
    </div> --}}

</div>