@extends('layouts.app')

@section('content')

<album-view token="{{ $token }}"></album-view>

<section class="section">
    <div class="container-fluid" id="waterfall">
        <waterfall src="album/{{ $album_id }}" token="{{ $token }}" has_panel="true" album="{{ $album_id }}" />
    </div>
</section>

@endsection