<div class="carousel-slide">

	<a href="/album/{{ $slide->id }}" class="slide-content" title="{{ $slide->title ?? 'Untitled Album' }}">
        <div class="album-cover" style="background-image: url({{ asset($slide->cover_image) }})"></div>
    </a>
    <style>
    .click-menu {
        color: black;
        cursor: pointer;
        position: absolute;
        top: 15px;
        right: 30px;
    }
    .click-menu > * {
        display: none;
        position: absolute;
        font-size: 1.25em;
    }
    .menu-toggle.active ~ .click-menu-items {
        display: block;
    }
    .menu-toggle:hover {
        background: rgba(0,0,0,.3);
        border-radius: 100%;
    }
    .click-menu .menu-toggle {
        display: block;
    }
    .click-menu-items {
        position: absolute;
        left: 28px;
        top: -12px;
        border: 1px solid black;
        border-radius: 10px;
        padding: 10px;
        font-size: .9rem;
        background: lightgray;
    }
    .click-menu-item:not(:last-of-type) {
        border-bottom: 1px solid black;
    }
    .click-menu-items::before {
        content: "";
        position: absolute;
        right: 100%;
        pointer-events: none;
        border-style: solid;
        border-width: 10px;
        border-color: transparent
                      black
                      transparent
                      transparent;
    }
    .click-menu-item {
        padding: 5px;
        width: 175px;
    }
    </style>
    <div class="click-menu">
        <i class="menu-toggle fas fa-bars"></i>
        <ul class="click-menu-items">
            <li class="click-menu-item">Change album title</li>
            <li class="click-menu-item">Delete this album</li>
            <li class="click-menu-item">Change cover photo</li>
        </ul>
    </div>
    {{-- <form class="items-centered button-delete-album" action="/album/{{ $slide->id }}" method="post">
    	@csrf
        @method('delete')
    	<button type="submit" class="button-bare items-centered" title="Delete" name="action" value="delete">
    		<i class="fas fa-times-circle"></i>
    	</button>
    </form> --}}
    {{ $slot }}
</div>