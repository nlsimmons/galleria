<div class="carousel" id="{{ $id }}">
	@foreach( $slides as $slide )
		@php $first = isset($first) ? false : true; @endphp
    	<input type="radio" id="{{ $slide->id }}" class="carousel-activator" name="activator-{{ $id }}" {{ $first ? 'checked' : '' }}>
    @endforeach

	{{-- <div class="carousel-indicators">
		@foreach( $slides as $slide )
    		<label for="{{ $slide->id }}" class="carousel-indicator"></label>
    	@endforeach
	</div> --}}

    <div class="carousel-track">
		{{ $slot }}
	</div>
<div>