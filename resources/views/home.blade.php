@extends('layouts.app')

@section('content')

<!--
    Todo:
    Scroll using arrow keys
    Customize background
-->

<div class="section">

    <div class="container-fluid">
        <h1 class="title is-1" style="text-align: center">All Photos</h1>

        @component('components.slideshow', [
            'id' => 'carousel-photos',
            'slides' => $slides,
            'options' => $options,
        ])
        @endcomponent

    </div>

</div>

@endsection
