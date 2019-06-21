<div class="carousel-slide image-slide">
	<input type="text" id="image{{ $slide->id }}_title" class="title slide-title"
        placeholder="Click to add a title"
        value="{{ $slide->title }}">

    <div>
        <img src="{{ asset($slide->url) }}">
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