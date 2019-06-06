<div class="waterfall columns">

    @foreach( $slide_columns as $c => $column )

    <div class="column" id="col-{{ $c+1 }}">

        @foreach($column as $img)

        <div class="display_wrapper" id="display_{{ $img->id }}">
            <img src="{{ asset($img->display_url) }}" class="display_img">
        </div>
        <div class="modal" id="modal_{{ $img->id }}">
            <div class="modal-background"></div>
            <div class="expanded-image-container">
                <img class="expanded-image" src="{{ asset($img->url) }}" class="full_img">
            </div>
        </div>

        @endforeach

    </div>

    @endforeach

</div>