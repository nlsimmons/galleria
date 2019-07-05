<div class="carousel-slide image-slide">
	<input type="text" id="image{{ $slide->id }}_title" class="title slide-title"
        placeholder="Click to add a title"
        value="{{ $slide->title }}">

    <div class="slide-image-container">
        <img src="{{ asset($slide->url) }}">
    </div>

    <div class="modal-container">

        <div class="modal" id="modal_image_{{ $slide->id }}">
            <div class="modal-background"></div>
            <div class="expanded-image-container">
                <img class="expanded-image" src="{{ asset($slide->url) }}" class="full_img">
            </div>
        </div>

    </div>

	<form class="buttons carousel-image-control" method="post" action="/image/{{ $slide->id }}">
        <input type="hidden" name="album_id" value="{{ $album_id }}">
        @csrf
        <button class="button button-no-border" title="Add" name="action" value="add">
            <i class="fas fa-plus-circle"></i>
        </button>
        <button class="button button-no-border" title="Add Tag" name="action" value="tag">
            <i class="fas cs cs-tags"></i>
        </button>
        <button class="button button-no-border" title="Download" name="action" value="download">
            <i class="fas fa-arrow-alt-circle-down"></i>
        </button>
        <button class="button button-no-border" title="Delete" name="action" value="delete">
            <i class="fas fa-minus-circle"></i>
        </button>
	</form>
</div>

