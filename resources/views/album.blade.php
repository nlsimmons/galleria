@extends('layouts.app')

@section('content')

@component('comps.albumview', [
    'album_slides' => $album_slides,
])
@endcomponent

<section class="section">
    <div class="container-fluid" id="waterfall">
        <Waterfall src="album/{{ $album_id }}" token="{{ $token }}" has_panel="true" album="{{ $album_id }}" />
    </div>
</section>

@endsection