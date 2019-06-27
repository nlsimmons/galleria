<div class="carousel-slide album-slide">

    <p class="title album-title not-editable">New Album</p>

    <div class="album_image_wrapper display_wrapper">
        <form method="post" action="{{ route('upload', ['album' => 'new']) }}" id="upload-image-no-album" enctype="multipart/form-data">
            @csrf
            <label class="add-photo-btn">
                <input type="file" multiple class="add-photo-input" name="images[]">
                <i class="fas fa-plus-circle"></i>
            </label>
        </form>
    </div>

</div>