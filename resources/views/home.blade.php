@extends('layouts.app')

@section('content')

@component('comps.albumview', [
    'album_slides' => $album_slides,
])
@endcomponent

<section class="section">
    <div class="container-fluid" id="waterfall">
        <Waterfall src="home" token="{{ $token }}" has_panel="true" editable="true" />
    </div>
</section>

@endsection
