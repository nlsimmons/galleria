<div class="carousel-slide album-slide">

    <p class="title album-title not-editable">Add New</p>

    <div class="album_image_wrapper display_wrapper">
        <form method="post" action="{{ route('upload') }}" id="upload-image-no-album" enctype="multipart/form-data">
            @csrf
            <label class="add-photo-btn">
                <input type="file" multiple class="add-photo-input" name="image-no-album[]">
                <i class="fas fa-plus-circle"></i>
            </label>
        </form>
    </div>

</div>