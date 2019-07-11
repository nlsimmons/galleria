<div class="carousel-slide">

    <form method="post" action="/album/new">
        @csrf
        <button type="submit">+</button>
    </form>
    {{-- <a class="slide-content" href="/album/new"
        style="background:black"></a> --}}

    {{-- @component('comps.album.upload')
        <span id="no-dragndrop" class="disabled">
            <p>Click to add a new album</p>
            <p class="fas fa-images"></p>
        </span>
        <span id="dragndrop">
            <p>Click or drag to add a new album.</p>
            <p class="fas fa-images"></p>
        </span>
    @endcomponent --}}

</div>