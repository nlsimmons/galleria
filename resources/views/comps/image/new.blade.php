<div class="carousel-slide image-slide">

    <p class="title image-title not-editable">Add Image</p>

    <div class="image_wrapper display_wrapper">
        <form method="post" action="{{ route('upload', ['album' => $id]) }}" enctype="multipart/form-data">
            @csrf
            <label class="add-photo-btn">
                <input type="file" multiple class="add-photo-input">
                <i class="fas fa-plus-circle"></i>
            </label>
        </form>
    </div>

</div>