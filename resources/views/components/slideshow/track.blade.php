@foreach( $slides as $slide )
@if($slide->item instanceof App\Image)

<div class="carousel-slide carousel-slide-{{ $slide->id }}">
    <a href="{{ $slide->url }}">
        <img class="slide-image" src="{{ asset($slide->display_url) }}">
    </a>

    @if( !empty($buttons) )
    <form class="box carousel-slide-control" name="slide-action" method="post">
        @csrf

        @if(in_array('delete', $buttons))
            <button class="button button-no-border" name="delete" title="Delete" value="{{ $slide->id }}">
                <i class="fas fa-minus-circle"></i>
            </button>
        @endif

        @if(in_array('download', $buttons))
            <a class="button button-no-border" name="download" title="Download"
                href="{{ $slide->download_link }}"
                value="{{ $slide->id }}">
                <i class="fas fa-arrow-alt-circle-down"></i>
            </a>
        @endif

        @if(in_array('edit', $buttons))
            <button class="button button-no-border" name="edit" title="Edit" value="{{ $slide->id }}">
                <i class="fas fa-edit-circle"></i>
            </button>
        @endif

    </form>
    @endif

</div>

@elseif($slide->item instanceof App\Album)

<div class="carousel-slide carousel-slide-{{ $slide->id }}">
    <a href="{{ $slide->url }}">
        <img class="slide-image" src="{{ asset($slide->display_url ) }}">
    </a>
    @if( @ $options['allow_delete'] )
    <form class="box carousel-slide-control" name="slide-action" method="post">
        @csrf
        <button class="button button-no-border" name="delete" title="Delete" value="{{ $slide->id }}">
            <i class="fas fa-minus-circle"></i>
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