<div class="carousel-slide album-slide">
	<input type="text" id="album_{{ $slide->id }}_title" class="title slide-title"
        placeholder="Click to add a title"
        value="{{ $slide->title }}">
	<a href="/album/{{ $slide->id }}/">
		@php $t = $slide->images()->count(); @endphp
	    @foreach($slide->images() as $image)
	    	@php $s = !isset($s) ? 1 : ++$s; @endphp
	        <div class="album-image-wrapper img-{{$s}}-of-{{$t}}">
	            <div class="album-image" style="background-image: url({{ $image instanceof \App\Image ? asset($image->url) : $image }})"></div>
	        </div>
	    @endforeach
	</a>

	<div class="buttons carousel-album-control" style="z-index:999">
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
        {{-- <span class="button button-no-border" title="Add Person to Album">
            <span>add person to this album</span>
        </span> --}}
	</div>
</div>