<div class="carousel-slide">

	<a href="/album/{{ $slide->id }}" class="slide-content" title="{{ $slide->title ?? 'Untitled Album' }}">
        <div class="album-cover" style="background-image: url({{ asset($slide->cover_image) }})"></div>
    </a>
    <form class="items-centered button-delete-album" action="/album/{{ $slide->id }}" method="post">
    	@csrf
    	<button type="submit" class="button-bare items-centered" title="Delete" name="action" value="delete">
    		<i class="fas fa-times-circle"></i>
    	</button>
    </form>

</div>