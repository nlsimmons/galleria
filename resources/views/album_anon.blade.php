@extends('layouts.app')

@section('content')

<section class="section">
    <div class="container-fluid" id="waterfall">
        <waterfall src="album/{{ $album_id }}" album="{{ $album_id }}" />
    </div>
</section>

@endsection