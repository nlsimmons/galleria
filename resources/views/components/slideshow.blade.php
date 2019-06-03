<div class="carousel" id="{{ $id }}">

    @foreach( $slides as $img )
    @php
        $first = isset($first) ? false : true;
    @endphp

    <input type="radio" id="{{ $img->id }}" class="carousel-activator" name="activator_{{ $id }}" {{ $first ? 'checked' : '' }}>
    <div class="carousel-controls">
        <label for="{{ $img->previous }}" class="carousel-control carousel-control-backward"></label>
        <label for="{{ $img->next }}" class="carousel-control carousel-control-forward"></label>
    </div>

    @endforeach

    <div class="carousel-mask carousel-mask-left"></div>
    <div class="carousel-track">
        @foreach( $slides as $img )
        @if($img instanceof App\Image)

        <div class="carousel-slide carousel-slide-{{ $img->id }}">
            <a href="{{ $img->url }}">
                <img class="slide-image" src="{{ asset($img->display_url) }}">
            </a>
            @if( @ $options['allow_delete'] )
            <form class="box carousel-slide-control" name="slide-action" method="post">
                @csrf
                <button class="button button-no-border" name="delete" title="Delete" value="{{ $img->id }}">
                    <i class="fas fa-minus-circle"></i>
                </button>
                <a class="button button-no-border" name="download" title="Download"
                    href="{{ $img->download_link() }}"
                    value="{{ $img->id }}">
                    <i class="fas fa-arrow-alt-circle-down"></i>
                </a>
                <button class="button button-no-border" name="edit" title="Edit" value="{{ $img->id }}">
                    <i class="fas fa-edit-circle"></i>
                </button>
            </form>
            @endif
        </div>

        @else

        <div class="carousel-slide add-photo-slide">
            <form method="post" action="{{ route('upload') }}" id="upload-image-no-album" enctype="multipart/form-data">
                @csrf
                <label class="add-photo-btn">
                    <input type="file" multiple class="add-photo-input" name="image-no-album[]">
                    <i class="fas fa-plus-circle"></i>
                </label>
            </form>
        </div>

        @endif
        @endforeach
    </div>
    <div class="carousel-mask carousel-mask-right"></div>

    <div class="carousel-indicators">
        @foreach( $slides as $img )

        <label for="{{ $img->id }}" class="carousel-indicator"></label>

        @endforeach
    </div>

</div>