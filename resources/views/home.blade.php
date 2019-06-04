@extends('layouts.app')

@section('content')

<!--
    Todo:
    Scroll using arrow keys
    Customize background
    Mouseover / click photo:
        show title
        show description

    mouseover / click album
        show title
        show description
        show first 3? images

    side by side compare images
    color breakdown of album(s)

-->

<div class="section">

    <div class="container-fluid">
        <h1 class="title is-1" style="text-align: center">All Photos</h1>

        @component('components.slideshow', [
            'id' => 'carousel-images',
            'slides' => $images,
            'options' => [
                'buttons' => [
                    'delete', 'download', 'edit'
                ]
            ]
        ])
        @endcomponent

    </div>

</div>

<div class="section">

    <div class="container-fluid">
        <h1 class="title is-1" style="text-align: center">All Albums</h1>

        @component('components.slideshow', [
            'id' => 'carousel-albums',
            'slides' => $albums,
            'options' => [
                'buttons' => [

                ]
            ],
        ])
        @endcomponent

    </div>

</div>

@endsection
