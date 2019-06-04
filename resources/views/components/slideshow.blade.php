<div class="carousel" id="{{ $id }}">

    @component('components.slideshow.activator', [
        'slides' => $slides,
        'id' => $id,
    ])
    @endcomponent

    <div class="carousel-mask carousel-mask-left"></div>
    <div class="carousel-track">

    @component('components.slideshow.track', [
        'slides' => $slides,
        'id' => $id,
        'buttons' => $options['buttons'],
    ])
    @endcomponent

    </div>
    <div class="carousel-mask carousel-mask-right"></div>

    <div class="carousel-indicators">

    @component('components.slideshow.indicator', [
        'slides' => $slides,
        'id' => $id
    ])
    @endcomponent

    </div>

</div>