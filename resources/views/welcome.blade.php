@extends('layouts.app')

@section('content')

<section class="section">

	<div class="container-fluid">
        @component('components.waterfall', [
            'id' => 'carousel-photos',
            'slide_columns' => $slide_columns
        ])
        @endcomponent

    </div>

</section>

<section class="section">

	<ul class="container">
		<h3 class="title">Todo</h3>
		<li>&nbsp;</li>
		<li>Buttons:</li>
		<li>&nbsp;</li>
		<li>Delete</li>
		<li>Download</li>
		<li>Move to Album</li>
		<li>Edit</li>
		<li>Make Private/Public</li>
		<li>Share</li>
		<li>&nbsp;</li>
		<li>Clicking on picture expands it to fill screen</li>
		<li>Fillable title over slide</li>
		<li>Mouseover shows fillable description</li>
		<li>Host on heroku</li>
		<li>Loading wheel</li>
		<li>Prevent reupload on refresh</li>
		<li>CSS Breakpoints</li>
	</ul>

</section>

@endsection