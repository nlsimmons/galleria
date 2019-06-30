@extends('layouts.app')

@section('content')

<section class="hero is-primary">
    <div class="hero-body">
        <div class="container">
            <h3 class="title">Here should be a mini slideshow of other albums</h3>
        </div>
    </div>
</section>

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

            @component('comps.image.new', ['id' => $id])
            @endcomponent
        @endcomponent

    </div>

</div>

@endsection