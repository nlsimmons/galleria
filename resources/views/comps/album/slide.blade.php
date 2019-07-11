<div class="carousel-slide">

	<a href="/album/{{ $slide->id }}" class="slide-content" title="{{ $slide->title ?? 'Untitled Album' }}">
        <div class="album-cover" style="background-image: url({{ asset($slide->cover_image)  }})"></div>
    </a>

</div>

{{-- @php $t = $slide->images()->count(); @endphp
@foreach($slide->images() as $image)
    @php $s = !isset($s) ? 1 : ++$s; @endphp
    <div class="album-image-wrapper img-{{$s}}-of-{{$t}}">
        <div class="album-image" style="background-image: url({{ $image instanceof \App\Image ? asset($image->url) : $image }})"></div>
    </div>
@endforeach --}}