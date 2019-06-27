<div class="carousel-slide image-slide">
	<input type="text" id="image{{ $slide->id }}_title" class="title slide-title"
        placeholder="Click to add a title"
        value="{{ $slide->title }}">

    <div>
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

	<div class="buttons carousel-image-control" style="z-index:999">
        <span class="button button-no-border" title="Add">
            <i class="fas fa-plus-circle"></i>
        </span>
        <span class="button button-no-border" title="Tags">
            <i class="fas cs cs-tags"></i>
        </span>
        <span class="button button-no-border" title="Download">
            <i class="fas fa-arrow-alt-circle-down"></i>
        </span>
        <span class="button button-no-border" title="Delete">
            <i class="fas fa-minus-circle"></i>
        </span>
	</div>
</div>

