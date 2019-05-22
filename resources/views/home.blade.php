@extends('layouts.app')

@section('content')

<div class="section">

    <div class="container-fluid">
        <h1 class="title is-1">All Photos</h1>

        <div id="photos" style="display: flex">

            <img src="http://via.placeholder.com/800x600">
            <img src="http://via.placeholder.com/800x600">

        </div>

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
