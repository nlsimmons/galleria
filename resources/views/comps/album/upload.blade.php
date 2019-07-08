<div id="uploads__container">
    <input type="text" id="upload-title" class="title slide-title frame-element" placeholder="Click to add a title">
    <form method="post" enctype="multipart/form-data" id="uploads__initial" class="draggable">
        <label for="images-new-album" class="upload-label">
            {{ $slot }}
        </label>
        <input type="file" multiple name="images[]" class="hidden" id="images-new-album">
    </form>
    <div id="uploads__staging" class="draggable">
        <div class="upload-label-container">
            <label for="images-new-album" class="upload-label">
                <p>Click or drag to upload more images.</p>
            </label>
        </div>
    </div>
    <div class="frame-element upload-button-container">
        <button type="button" class="button is-dark" id="upload-button">Upload</button>
    </div>
</div>