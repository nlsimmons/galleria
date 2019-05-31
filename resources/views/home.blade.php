@extends('layouts.app')

@section('content')

<!--
    Todo:
    Make the carousel a component
    Apply scrolling somehow
    Also using arrow keys
    Upload

    Images:
    size: Thumbnail, Display, Full
    Clicking an image smoothly transitions to showing it in "Full"

    Customize background
-->

<div class="section">

    <div class="container-fluid">
        <h1 class="title is-1" style="text-align: center">All Photos</h1>

        @component('components.slideshow', [
            'id' => 'carousel-photos',
            'slides' => $slides
        ])
        @endcomponent

    </div>

</div>

@endsection
