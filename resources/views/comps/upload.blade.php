<div id="uploads__container">
    <form method="post" enctype="multipart/form-data" id="uploads__initial" class="draggable">
        <input type="hidden" name="album" id="album" value="{{ $album ?? 'new' }}">
        <label for="new-image" class="upload-label">
            <p id="dragndrop">Click or drag to upload a new image.</p>
            <p id="no-dragndrop">Click or drag to upload a new image.</p>
        </label>
        <input type="file" multiple name="images[]" class="hidden" id="new-image">
    </form>
    <div id="uploads__staging" class="draggable">
        <input type="text" id="upload-title" class="title frame-element" placeholder="Click to add a title">
        <div id="upload-images"></div>
        <div class="upload-label-container">
            <label for="images-new-album" class="upload-label">
                <p>Click or drag to upload more images.</p>
            </label>
        </div>
    </div>
    {{-- <div class="frame-element upload-button-container">
        <button type="button" class="button is-dark" id="upload-album-button">Upload</button>
    </div> --}}
</div>