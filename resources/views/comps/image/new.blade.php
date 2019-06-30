<div class="carousel-slide image-slide">

    <p class="title image-title not-editable">Add Image</p>

    <div class="image_wrapper display_wrapper">
        <form method="post" action="{{ route('upload', ['album' => $id]) }}" enctype="multipart/form-data" id="form-album">
            @csrf
            <label class="add-photo-btn">
                <input type="file" multiple class="add-photo-input" name="images[]" id="images-album">
                <i class="fas fa-plus-circle"></i>
            </label>
        </form>
    </div>

</div>