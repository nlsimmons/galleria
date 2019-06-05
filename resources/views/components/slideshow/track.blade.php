@foreach( $slides as $slide )
    @if($slide->item instanceof Illuminate\Database\Eloquent\Model)

    <div class="carousel-slide carousel-slide-{{ $slide->id }}">

        <p class="title slide-title" contenteditable onfocusout="alert('potato')">{{ $slide->title }}</p>

        <a href="{{ $slide->url }}" class="slide-image-wrapper">
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

    @else

        @if($type == 'image')

            <div class="carousel-slide add-photo-slide">
                <span class="title">Add New</span>
                <form method="post" action="{{ route('upload') }}" id="upload-image-no-album" enctype="multipart/form-data">
                    @csrf
                    <label class="add-photo-btn">
                        <input type="file" multiple class="add-photo-input" name="image-no-album[]">
                        <i class="fas fa-plus-circle"></i>
                    </label>
                </form>
            </div>

        @elseif($type == 'album')

            <div class="carousel-slide add-photo-slide">
                <span class="title">Add New</span>
                <label class="add-photo-btn add-album">
                    {{-- <input type="file" multiple class="add-photo-input" name="image-no-album[]"> --}}
                    <i class="fas fa-plus-circle"></i>
                </label>
            </div>

        @endif

    @endif
@endforeach