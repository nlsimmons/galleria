<div class="carousel-slide image-slide">

    <div id="uploads__container">
        {{-- <input type="text" id="upload-title" class="title slide-title frame-element" placeholder="Click to add a title"> --}}
        <form method="post" enctype="multipart/form-data" id="uploads__initial" class="draggable">
            <label for="new-image" class="upload-label">
                <span id="no-dragndrop" class="disabled">
                    <p>Click to add a new image to this album.</p>
                    <p class="fas fa-images is-size-1"></p>
                </span>
                <span id="dragndrop">
                    <p>Click or drag to add a new image to this album.</p>
                    <p class="fas fa-images is-size-1"></p>
                </span>
            </label>
            <input type="file" multiple name="images[]" class="hidden" id="new-image">
        </form>
        <div id="uploads__staging" class="draggable">
            <div class="upload-label-container">
                <label for="new-image" class="upload-label">
                    <p>Click or drag to upload a new image to this album.</p>
                </label>
            </div>
        </div>
        <div class="frame-element upload-button-container">
            <button type="button" class="button is-dark" id="upload-image-button">Upload</button>
        </div>
    </div>

</div>