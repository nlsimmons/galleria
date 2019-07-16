@extends('layouts.app')

@section('content')

<!--
	Tags at top of screen, filter by that
-->

<section class="section">
    <div class="container-fluid">
        <div id="welcome-waterfall" class="waterfall">

            @foreach($images->columns as $column)

                <div class="waterfall-column">

                    @foreach($column as $image)

                        <div class="waterfall-image">
                            <div class="image-wrapper">
                                <img src="{{ asset($image->uri(500) ?? '') }}" title="{{ $image->title ?? 'Untitled Image' }}" class="width-{{ $images->columns->count() }}-cols">
                            </div>

                        </div>

                    @endforeach

                </div>
            @endforeach

        </div>
    </div>
</section>

@endsection