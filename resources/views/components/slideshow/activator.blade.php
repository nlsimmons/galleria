@foreach($slides as $slide)
@php $first = isset($first) ? false : true; @endphp

	<input type="radio" id="{{ $slide->id }}" class="carousel-activator" name="activator_{{ $id }}" {{ $first ? 'checked' : '' }}>
	<div class="carousel-controls">
	    <label for="{{ $slide->previous }}" class="carousel-control carousel-control-backward"></label>
	    <label for="{{ $slide->next }}" class="carousel-control carousel-control-forward"></label>
	</div>

@endforeach