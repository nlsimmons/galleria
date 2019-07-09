@extends('layouts.app')

@section('content')

<!--
	Tags at top of screen, filter by that
-->

<section class="section">

	<div class="container-fluid">
        @component('comps.waterfall', [
            'id' => 'carousel-photos',
            'slide_columns' => $slide_columns
        ])
        @endcomponent
    </div>

</section>

@endsection