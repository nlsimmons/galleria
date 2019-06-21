@extends('layouts.app')

@section('content')

<div class="section">

    <div class="container-fluid">

        @component('comps.slideshow', [
            'id' => 'carousel-images',
            'slides' => $image_slides->slides->all(),
        ])

            @if( $image_slides->slides->count() > 1)
                @php
                $slides = $image_slides->slides;
                $add_slide = $slides->pop();
                @endphp

                @foreach($slides as $slide)
                    @component('comps.image.slide', ['slide' => $slide]) @endcomponent
                @endforeach
            @endif

            @component('comps.image.new')
            @endcomponent
        @endcomponent

    </div>

</div>

@endsection