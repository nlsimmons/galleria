@extends('layouts.app')

@section('content')

@php
$control_labels = [
    1 => [5, 2],
    2 => [1, 3],
    3 => [2, 4],
    4 => [3, 5],
    5 => [4, 1],
];
@endphp

<!--
    Todo:
    Make the carousel a component
    Use SASS
    Tie this to the DB
    Apply scrolling somehow
    Also using arrow keys

    Images:
    size: Thumbnail, Display, Full
    Clicking an image smoothly transitions to showing it in "Full"

    Customize background
-->

<style>

#photos-container {
    overflow-x: scroll;
}

#add-photo, .home-photo {
    width: 800px;
    height: 600px;
}

/** Carousel **/
.carousel {
    height: 600px;
    width: 800px;
    overflow: visible;
    text-align: center;
    position: relative;
    padding: 0;
    margin: auto;
}

.carousel-controls,
.carousel-activator {
    display: none;
}

@foreach( array_keys($control_labels) as $n )

.carousel-activator:nth-of-type({{ $n }}):checked ~ .carousel-track {
    -webkit-transform: translateX({{ ($n-1) * -100 }}%);
            transform: translateX({{ ($n-1) * -100 }}%);
}
.carousel-activator:nth-of-type({{ $n }}):checked ~ .carousel-slide:nth-of-type({{ $n }}) {
    transition: opacity 0.5s, -webkit-transform 0.5s;
    transition: opacity 0.5s, transform 0.5s;
    transition: opacity 0.5s, transform 0.5s, -webkit-transform 0.5s;
    top: 0;
    left: 0;
    right: 0;
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1);
}
.carousel-activator:nth-of-type({{ $n }}):checked ~ .carousel-controls:nth-of-type({{ $n }}) {
    display: block;
    opacity: 1;
}
.carousel-activator:nth-of-type({{ $n }}):checked ~ .carousel-indicators .carousel-indicator:nth-of-type({{ $n }}) {
    opacity: 1;
}
.carousel-activator:nth-of-type({{ $n }}):checked ~ .carousel-slide:nth-of-type({{ $n }}) {
    display: block;
    animation: showSlide 0.5s;
}
.carousel-track .carousel-slide:nth-of-type({{ $n }}) {
    -webkit-transform: translateX({{ ($n-1) * 100 }}%);
            transform: translateX({{ ($n-1) * 100 }}%);
}

@endforeach

.carousel-control {
    height: 30px;
    width: 30px;
    margin-top: -15px;
    top: 50%;
    position: absolute;
    display: block;
    cursor: pointer;
    border-width: 5px 5px 0 0;
    border-style: solid;
    border-color: black;
    opacity: 0.35;
    outline: 0;
    z-index: 3;
}
.carousel-control:hover {
    opacity: 1;
}
.carousel-control-backward {
    left: 10px;
    -webkit-transform: rotate(-135deg);
            transform: rotate(-135deg);
}
.carousel-control-forward {
    right: 10px;
    -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
}
.carousel-indicators {
    position: absolute;
    bottom: 20px;
    width: 100%;
    text-align: center;
}
.carousel-indicator {
    height: 15px;
    width: 15px;
    border-radius: 100%;
    display: inline-block;
    z-index: 2;
    cursor: pointer;
    background: #fafafa;
    opacity: 0.75;
}
.carousel-indicator:hover {
    opacity: 1;
}
.carousel-track {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    padding: 0;
    margin: 0;
    transition: -webkit-transform 0.5s ease 0s;
    transition: transform 0.5s ease 0s;
    transition: transform 0.5s ease 0s, -webkit-transform 0.5s ease 0s;
}
.carousel-track .carousel-slide {
    display: block;
    top: 0;
    left: 0;
    right: 0;
    opacity: 1;
}
.carousel-slide {
    height: 100%;
    position: absolute;
    opacity: 0;
}
.carousel-slide > * {
    padding: 5%;
}

.carousel-mask {
    height: 100%;
    position: absolute;
    width: calc(50vw - 400px);
    z-index: 999;
}
.carousel-mask-left {
    left: calc(400px - 50vw);
    background-image: linear-gradient(to left, rgba(255,0,0,0), rgb(255, 255, 255), rgb(255, 255, 255));
}
.carousel-mask-right {
    right: calc(400px - 50vw);
    background-image: linear-gradient(to right, rgba(255,0,0,0), rgb(255, 255, 255), rgb(255, 255, 255));
}

</style>

<div class="section">

    <div class="container-fluid">
        <h1 class="title is-1" style="text-align: center">All Photos</h1>

        <div class="carousel">

            @foreach( array_keys($control_labels) as $n )

            <input type="radio" id="{{ $n }}" class="carousel-activator" name="activator" {{ $n === 1 ? 'checked' : '' }}>
            <div class="carousel-controls">
                <label for="{{ $control_labels[$n][0] }}" class="carousel-control carousel-control-backward"></label>
                <label for="{{ $control_labels[$n][1] }}" class="carousel-control carousel-control-forward"></label>
            </div>

            @endforeach

            <div class="carousel-mask carousel-mask-left"></div>
            <div class="carousel-track">
                @foreach( $control_labels as $n )
                <div class="carousel-slide">
                    <img src="http://via.placeholder.com/800x600">
                </div>
                @endforeach
            </div>
            <div class="carousel-mask carousel-mask-right"></div>

            <div class="carousel-indicators">
                @foreach( array_keys($control_labels) as $n )
                <label for="{{ $n }}" class="carousel-indicator"></label>
                @endforeach
            </div>

        </div>

        {{-- <div id="photos-container">

            <div class="home-photo">
                <img src="http://via.placeholder.com/800x600">
            </div>
            <div class="home-photo">
                <img src="http://via.placeholder.com/800x600">
            </div>
            <div class="home-photo">
                <img src="http://via.placeholder.com/800x600">
            </div>
            <div class="home-photo">
                <img src="http://via.placeholder.com/800x600">
            </div>

            <div id="add-photo"></div>

        </div> --}}

    </div>

</div>

<div class="section">

    <div class="container-fluid">
        <h1 class="title is-1">Albums</h1>

        <div id="albums" style="display: flex">

            <img src="http://via.placeholder.com/800x600">
            <img src="http://via.placeholder.com/800x600">

        </div>
    </div>

</div>

@endsection
