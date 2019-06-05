<div class="carousel" id="carousel-{{ $id }}">

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
        'type' => $type,
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

<div class="modal" id="modal-{{ $id }}">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">This is a modal</p>
        </header>
        <section class="modal-card-body">

        </section>
        <footer class="modal-card-foot">
            <button class="button">Submit</button>
        </footer>
    </div>

</div>