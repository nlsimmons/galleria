@extends('layouts.app')

@section('content')

@component('comps.albumview', [
    'album_slides' => $album_slides,
])
@endcomponent

<section class="section">
    <div class="container-fluid" id="user-home">
        <Waterfall src="home" token="{{ $token }}"></Waterfall>
    </div>
</section>


@endsection
