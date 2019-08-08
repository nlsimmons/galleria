@extends('layouts.app')

@section('content')

<album-view token="{{ $token }}">
	@csrf
</album-view>

<section class="section">
    <div class="container-fluid">
        <waterfall src="home" token="{{ $token }}" has_panel="true" editable="true" />
    </div>
</section>

@endsection
