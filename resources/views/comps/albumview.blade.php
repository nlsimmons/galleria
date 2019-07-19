<div id="album-carousel" class="hero is-info active">

    <div class="container">

        @component('comps.slideshow', [
            'id' => 'carousel-albums',
            'slides' => $album_slides->slides->all(),
            'current_album' => $current_album ?? 0,
        ])

            @if( $album_slides->slides->count() > 1)
                @php
                $slides = $album_slides->slides;
                $add_slide = $slides->pop();
                @endphp

                @foreach($slides as $slide)
                    @component('comps.album.slide', ['slide' => $slide])
                        @if($slide->id == ($current_album ?? 0)) <div class="albumview-indicator"></div> @endif
                    @endcomponent
                @endforeach
            @endif

            @component('comps.album.new')
            @endcomponent

        @endcomponent
    </div>

    <div id="toggle-album-carousel">
        <i class="fas fa-angle-double-up"></i>
    </div>

</div>