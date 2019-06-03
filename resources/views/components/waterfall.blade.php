<div class="waterfall columns">

    @foreach( $slide_columns as $c => $column )

    <div class="column" id="col-{{ $c+1 }}">

        @foreach($column as $img)

        <div class="display_wrapper">
            <img src="{{ $img->display_url }}" class="display_img" id="display_{{ $img->id }}">
            <div class="full_image_container" id="container_{{ $img->id }}">
                <img src="{{ $img->url }}" class="full_img">
            </div>
        </div>

        @endforeach

    </div>

    @endforeach

</div>