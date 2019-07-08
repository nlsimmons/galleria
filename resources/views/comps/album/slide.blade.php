<div class="carousel-slide album-slide">
    @if ( $slide->id != 'loose' )
	<input type="text" id="album_{{ $slide->id }}_title" class="title slide-title"
        placeholder="Click to add a title"
        value="{{ $slide->title }}">
    @endif
	<a href="/album/{{ $slide->id }}/">
		@php $t = $slide->images()->count(); @endphp
	    @foreach($slide->images() as $image)
	    	@php $s = !isset($s) ? 1 : ++$s; @endphp
	        <div class="album-image-wrapper img-{{$s}}-of-{{$t}}">
	            <div class="album-image" style="background-image: url({{ $image instanceof \App\Image ? asset($image->url) : $image }})"></div>
	        </div>
	    @endforeach
	</a>

    <form class="buttons carousel-album-control" method="post" action="/album/{{ $slide->id }}">
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