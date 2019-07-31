<div class="carousel" id="{{ $id }}">
	@foreach( $slides as $slide )
    	<input type="radio" id="{{ $slide->id }}"
    		class="carousel-activator"
    		name="activator-{{ $id }}"
    		{{ isset($current_album) && $current_album == $slide->id ? 'checked' : '' }}>
    @endforeach


    @foreach( $slides as $slide )
	   <div class="carousel-controls">
    		<label for="{{ $slide->previous }}" class="carousel-previous">
                <i class="fas fa-chevron-circle-left"></i>
            </label>
            <label for="{{ $slide->next }}" class="carousel-next">
                <i class="fas fa-chevron-circle-right"></i>
            </label>
	   </div>
    @endforeach

    <div class="carousel-track">
		{{ $slot }}
	</div>
</div>