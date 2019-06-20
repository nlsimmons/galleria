@foreach( $albums as $album )
@php $first = isset($first) ? false : true; @endphp

    <input type="radio" id="{{ $album->id }}" class="carousel-activator" name="activator_{{ $id }}" {{ $first ? 'checked' : '' }}>

@endforeach

@if(count($albums) > 1)

<div class="carousel-indicators">

    @foreach( $albums as $album )

        <label for="{{ $album->id }}" class="carousel-indicator"></label>

    @endforeach

</div>

@endif

{{-- ........................................ --}}

<div class="carousel-track">

    @foreach( $albums as $album )

        <div class="album-slide">
            @foreach($album->images as $image)
                <div class="album-image-wrapper">
                    <div class="album-image" style="background-image: url({{ asset($image->url) }})"></div>
                </div>
            @endforeach
        </div>


        @break

        @if( !( $album->item instanceof Illuminate\Database\Eloquent\Model ) )



            {{-- @if($type == 'image')

                <div class="carousel-album add-photo-album">
                    <span class="title">Add New</span>
                    <form method="post" action="{{ route('upload') }}" id="upload-image-no-album" enctype="multipart/form-data">
                        @csrf
                        <label class="add-photo-btn">

                            <i class="fas fa-plus-circle"></i>
                        </label>
                    </form>
                </div>

            @elseif($type == 'album')

                <div class="carousel-album add-photo-album">
                    <span class="title">Add New</span>
                    <label class="add-photo-btn add-album">
                        <input type="file" multiple class="add-photo-input" name="image-no-album[]">
                        <i class="fas fa-plus-circle"></i>
                    </label>
                </div>

            @endif --}}


        @else

            <div class="carousel-album">

                <input type="text" id="album_{{ $album->id }}_title" class="title album-title"
                    placeholder="Click to add a title"
                    value="{{ $album->title }}">

                {{-- <p  contenteditable class="title album-title {{ $album->title ? '' : 'placeholder'  }}">
                    {{ $album->title ?: 'Click to add a title' }}
                </p> --}}

                <div class="album_image_wrapper display_wrapper" id="display_album_{{ $album->id }}">
                    <img class="display_image" src="{{ asset($album->url) }}">
                </div>

            </div>

        @endif

    @endforeach

</div>

<div class="carousel-buttons">

@foreach($albums as $album)
    @if( $album->item instanceof Illuminate\Database\Eloquent\Model && !empty($buttons) )
        <form class="box carousel-album-control" name="album-action" method="post">
            @csrf

            @if(in_array('delete', $buttons))
                <button class="button button-no-border" name="delete" title="Delete"
                    value="{{ $album->id }}">
                    <i class="fas fa-minus-circle"></i>
                </button>
            @endif

            @if(in_array('download', $buttons))
                <a class="button button-no-border" name="download" title="Download"
                   href="{{ $album->download_link }}"
                   value="{{ $album->id }}">
                    <i class="fas fa-arrow-alt-circle-down"></i>
                </a>
            @endif

            @if(in_array('edit', $buttons))
                <button class="button button-no-border" name="edit" title="Edit"
                    value="{{ $album->id }}">
                    <i class="fas cs cs-edit-circle"></i>
                </button>
            @endif

            @if(in_array('tags', $buttons))
                <span class="button button-no-border" title="Add Tags">
                    <i class="fas cs cs-tags"></i>
                </span>
            @endif

            @if(in_array('album', $buttons))
                <span class="button button-no-border" title="Add to Album">
                    <i class="fas cs cs-album"></i>
                </span>
            @endif

        </form>
    @endif
@endforeach

</div>
